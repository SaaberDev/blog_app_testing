<button class="{{ $isLiked ? 'font-bold text-yellow-400' : 'underline hover:no-underline' }}" wire:click="like">👍 {{ $post->likes }}</button>
