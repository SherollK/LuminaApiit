<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreEventsRequest;
// use App\Http\Requests\UpdateEventsRequest;
use App\Models\Events;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if(!$user)
        {
            $events = Events::all();
        }

        else{
            $categoryIds = $user->categories->pluck('id');


            $events = Events::whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })->get();

        }



        return view('events.index',
            [
                'categories' => Category::all(),
                'events' => $events,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Events $events)
    {
        //
        return view(
            'events.show',
            [
                'events' => $events
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventsRequest $request, Events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $events)
    {
        //
    }
}
