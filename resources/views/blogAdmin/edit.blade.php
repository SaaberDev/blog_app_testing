<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit {{ $post->title }}
            </h2>

            <div>
                <x-button
                    :href="action([\App\Http\Controllers\BlogPostAdminController::class, 'create'])"
                    class="mr-2"
                >
                    New
                </x-button>

                <x-button
                    :href="action([\App\Http\Controllers\BlogPostController::class, 'show'], $post->slug)"
                    target="_blank" rel="noopener noreferrer"
                    color="blue"
                >
                    Show
                </x-button>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form
            action="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'update'], $post->slug) }}"
            method="post"
        >
            @if ($errors->any())
                <div class="text-red-800">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-4 gap-4 gap-x-8">
                @csrf()

                <div class="grid grid-cols-4 col-span-4 gap-x-8 gap-y-4 bg-white shadow rounded p-8">
                    <div class="col-span-2 flex">
                        <label class="font-bold mr-2 py-2" for="title">Title</label>
                        <input class="px-3 py-2 rounded-sm flex-grow" type="text" name="title" id="title" value="{!! $post->title !!}">
                    </div>

                    <div class="col-span-2 flex">
                        <label class="font-bold mr-2 py-2" for="author">Author</label>
                        <input class="px-3 py-2 rounded-sm flex-grow" type="text" name="author" id="author" value="{!! $post->author !!}">
                    </div>

                    <div class="col-span-2 flex">
                        <label class="font-bold mr-2 py-2" for="date">Date</label>
                        <input class="px-3 py-2 rounded-sm flex-grow" type="date" name="date" id="date" value="{!! $post->date->format('Y-m-d') !!}">
                    </div>
                </div>

                <div class="grid grid-cols-4 col-span-4 gap-x-8 bg-white shadow rounded p-8">
                    <div class="col-span-4 flex">
                        <label class="font-bold mr-2 py-2" for="body">Body</label>

                        <textarea class="px-3 py-2 rounded-sm flex-grow" name="body" id="body" rows="20">{{ $post->body }}</textarea>

                        <div class="
                            dropzone
                            fixed bg-blue-100
                            shadow-lg
                            top-0 left-0 right-0 bottom-0 border-dashed border-4 border-blue-700
                            flex items-center justify-center
                            opacity-90
                            rounded
                            m-4
                            hidden
                        ">
                            <span class="text-2xl text-blue-800 font-mono font-bold">drop</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-4 flex justify-end">
                    @if(!$post->isPublished())
                        <x-button class="mr-2" color="blue" name="publish">Save & Publish</x-button>
                    @endif

                    <x-button>Save</x-button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-4 gap-4 gap-x-8 mt-8">
            @csrf()

            <div class="grid grid-cols-2 col-span-4 gap-16 gap-x-8 bg-white shadow rounded p-8 border-red-300 border-2 bg-red-200">
                <div>
                    <h2 class="font-bold text-xl text-red-900">
                        Slug
                    </h2>

                    <p>
                        Changing a post's slug might have unforeseen side-effects when already published.
                        We'll automatically add a redirect from the old to new slug, in order to prevent any issues.
                    </p>
                </div>

                <div class="flex items-center justify-end">
                    <form
                        action="{{ action(\App\Http\Controllers\UpdatePostSlugController::class, $post->slug) }}"
                        method="post"
                        class="flex flex-grow"
                    >
                        @csrf()

                        <input class="px-3 py-2 mr-2 rounded-sm flex-grow" type="text" name="slug" id="slug" value="{!! $post->slug !!}">

                        <x-button color="red">Update Slug</x-button>
                    </form>
                </div>

                <div>
                    <h2 class="font-bold text-xl text-red-900">
                        Delete
                    </h2>

                    <p>
                        Think twice before deleting a post, this cannot be undone!
                    </p>
                </div>

                <div class="flex items-center justify-end">
                    <form
                        action="{{ action(\App\Http\Controllers\DeletePostController::class, $post->slug) }}"
                        method="post"
                        class="flex flex-grow justify-end"
                    >
                        @csrf()

                        <x-button color="red">Delete Post</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const editor = document.querySelector('#body');
        const body = document.querySelector('body');
        const dropzone = document.querySelector('.dropzone');

        const stopEvent = function (e) {
            e.preventDefault()
            e.stopPropagation()
        }

        const showDropzone = function() {
            dropzone.classList.remove('hidden');
        }

        const hideDropzone = function() {
            dropzone.classList.add('hidden');
        }

        body.addEventListener('dragenter', function (e) {
            stopEvent(e);

            showDropzone();
        });

        body.addEventListener('dragover', function (e) {
            stopEvent(e);
        });

        body.addEventListener('drop', function (e) {
            stopEvent(e);

            insertAtCursor(editor, '[…]');

            uploadFile(e.dataTransfer.files[0]);
        });

        function uploadFile(file) {
            let url = '{{ action(\App\Http\Controllers\UploadController::class) }}';

            let xhr = new XMLHttpRequest();

            xhr.open('POST', url, true);

            xhr.addEventListener('readystatechange', function (e) {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    editor.value = editor.value.replace('[…]', '![](' + xhr.responseText + ')');

                    hideDropzone();
                } else if (xhr.readyState === 4 && xhr.status !== 200) {
                    hideDropzone();
                }
            });

            let formData = new FormData();

            formData.append('file', file);

            xhr.send(formData);
        }

        function insertAtCursor(textArea, value) {
            const startPos = textArea.selectionStart;
            const endPos = textArea.selectionEnd;

            textArea.value = textArea.value.substring(0, startPos)
                + value
                + textArea.value.substring(endPos, textArea.value.length);
        }
    </script>
</x-app-layout>
