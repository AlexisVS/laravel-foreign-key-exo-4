<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = new Photo();
        $photo->img_src = $request->file("img_src")->hashName();
        $photo->push();
        Storage::put('/public/img', $request->file("img_src"));

        $store = new Album;
        $store->name = $request->name;
        $store->author = $request->author;
        $store->photo_id = $photo->id;
        $store->push();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view("pages.photo.edit", compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $album->name = $request->name;
        $album->author = $request->author;

        Storage::delete("/public/img/" . $album->photo->img_src);
        Storage::put("/public/img", $request->file('img_src'));

        $album->photo->img_src = $request->file('img_src')->hashName();

        $album->push();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        Storage::delete("/public/img/" . $album->photo->img_src);
        $album->delete();
        Photo::find($album->id)->delete();
        return redirect('/');
    }
}
