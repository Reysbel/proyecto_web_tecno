<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;

class PageViewCounter
{
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('get')) {
            $pageUrl = $request->fullUrl();
            $pageView = PageView::firstOrCreate(['page_url' => $pageUrl]);
            $pageView->increment('views');
        }

        return $next($request);
    }
}
