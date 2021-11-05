<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::query()
            ->when(request('sort'), function ($query, $sort) {
                $direction = request('direction');
                return match ($sort) {
                    'title' => $query->orderBy('title', $direction),
                    'status' => $query->sortByStatus($direction),
                    'activity' => $query->sortByActivity($direction)
                };
                // you can use switch too
                // switch ($sort) {
                //     case 'title':
                //         return $query->orderBy('title', $direction);
                //     case 'status':
                //         return $query->sortByStatus($direction);
                //     case 'activity':
                //         return $query->sortByActivity($direction);
                // }
            })
            ->paginate(10);

        return view('videos', compact('videos'));
    }
}
