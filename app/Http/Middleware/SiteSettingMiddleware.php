<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class SiteSettingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = SiteSetting::all()->pluck('data','name')->toArray();
        $categories = Category::whereStatus('1')->with('subcategory')->withCount('product_relation')->get();
        view()->share(['settings'=>$settings,'categories'=>$categories]);

        return $next($request);
    }
}
