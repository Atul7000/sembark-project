<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::where('user_id', auth()->id())->paginate(10);
        return view('urls.index', compact('urls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url',
        ]);

        // $existing = Url::where('long_url', $request->long_url)->where('client_id', auth()->user()->client_id)->first();
        // if ($existing) {
        //     return redirect()->back()->with('info', 'Short URL already exists: ' . $existing->short_url);
        // }

        $shortUrl = Str::random(6);

        $url = Url::create([
            'client_id' => auth()->user()->client_id ?? 1,
            'user_id' => auth()->id() ?? 1,
            'long_url' => $request->long_url,
            'short_url' => $shortUrl,
            'generated_by' => 'manual',
        ]);

        return redirect()->back()->with('success', 'Short URL created: ' . $url->short_url);
    }
}
