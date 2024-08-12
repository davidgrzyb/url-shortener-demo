<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'links' => auth()->user()
                ->links()
                ->withCount('redirects')
                ->latest()
                ->paginate(5),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'target' => ['required'],
        ]);

        $url = filter_var($request->target, FILTER_SANITIZE_URL);

        do {
            $slug = strtolower(Str::random(6));
        } while (Link::where('slug', $slug)->exists());

        auth()->user()->links()->create([
            'slug' => $slug,
            'target' => $url,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(Link $link)
    {
        abort_if(! auth()->user()->is($link->user), 403);

        DB::transaction(function () use ($link) {
            $link->redirects()->delete();
            $link->delete();
        });

        return redirect()->route('dashboard');
    }
}
