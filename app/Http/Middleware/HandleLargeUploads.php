<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleLargeUploads
{
    public function handle(Request $request, Closure $next)
    {
        $maxSize = 500 * 1024 * 1024; // 500MB

        if ($request->server('CONTENT_LENGTH') > $maxSize) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['file' => 'Upload size exceeds maximum limit of 500MB']);
        }

        return $next($request);
    }
}