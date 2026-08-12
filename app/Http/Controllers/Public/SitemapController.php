<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap.xml for search engine indexing
     */
    public function index(): Response
    {
        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'loc' => route('produk'),
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '0.9'
            ],
            [
                'loc' => route('outlet'),
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ],
            [
                'loc' => route('tentang'),
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
        ];

        // Fetch active products if product details routes are added later
        try {
            $latestProduct = Product::where('is_active', true)->latest('updated_at')->first();
            if ($latestProduct && isset($latestProduct->updated_at)) {
                $urls[1]['lastmod'] = $latestProduct->updated_at->format('Y-m-d');
            }
        } catch (\Exception $e) {
            // Fallback gracefully if database not yet populated
        }

        $xml = view('public.sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
