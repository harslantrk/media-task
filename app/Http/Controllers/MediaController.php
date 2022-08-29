<?php

namespace App\Http\Controllers;

use App\Http\Interface\MediaInterface;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Category;
use Auth;

class MediaController extends Controller implements MediaInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $medias = Media::where('user_id', $user->id)->get();
        $categories = Category::where('user_id', $user->id)->orderBy('rank')->get();
        return view('media.list', ['medias' => $medias, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $new = new Media();
        $new->user_id = $user->id;
        $new->name = $data['form-name'];
        $new->category_id = $data['form-category'];
        $new->description = $data['form-description'];
        $new->source = $data['form-source'];
        $new->save();

        return redirect('/media');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $media = Media::where(["id" => $id, "user_id" => $user->id])->first();
        $result = $media;
        $result['category_name'] = $media->category->name;
        $result = json_encode($result);
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $new = Media::where(['user_id' => $user->id, 'id' => $data['form-id']])->first();
        $new->name = $data['form-name'];
        $new->category_id = $data['form-category'];
        $new->description = $data['form-description'];
        $new->source = $data['form-source'];
        $new->save();

        return redirect('/media');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        Media::where(['id' => $id, 'user_id' => $user->id])->delete();

        return redirect('/media');
    }
}
