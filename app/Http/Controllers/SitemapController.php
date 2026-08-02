<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            url('/'),
            url('/hakkimizda'),
            url('/hizmetlerimiz'),
            url('/iletisim'),
            url('/projeler'),
            url('/blog'),
        ];

        // Add dynamic projects
        $projects = Project::where('is_active', true)->get();
        foreach ($projects as $project) {
            $urls[] = url('/proje/' . $project->slug);
        }

        // Add dynamic blogs
        $blogs = Blog::where('is_active', true)->get();
        foreach ($blogs as $blog) {
            $urls[] = url('/blog/' . $blog->slug);
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $url . '</loc>';
            $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
