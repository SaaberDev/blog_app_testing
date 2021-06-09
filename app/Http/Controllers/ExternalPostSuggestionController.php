<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExternalPostSuggestionRequest;
use App\Models\Enums\ExternalPostStatus;
use App\Models\ExternalPost;

class ExternalPostSuggestionController
{
    public function __invoke(ExternalPostSuggestionRequest $request)
    {
        $validated = $request->validated();

        ExternalPost::create([
            'title' => $validated['title'],
            'url' => $validated['url'],
            'domain' => str_replace('www.', '', parse_url($validated['url'], PHP_URL_HOST)),
            'date' => now(),
            'status' => ExternalPostStatus::PENDING(),
        ]);

        return redirect()->action([BlogPostController::class, 'index']);
    }
}
