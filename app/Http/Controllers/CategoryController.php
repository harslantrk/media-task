<?php

namespace App\Http\Controllers;

use App\Http\Interface\CategoryInterface;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller implements CategoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $all = Category::where('user_id', $user->id)->orderBy('rank')->get();
        return view('category.list', ['categories' => $all]);
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

        $new = new Category();
        $new->user_id = $user->id;
        $new->name = $data['form-name'];
        $new->rank = $data['form-rank'];
        $new->save();

        return redirect('/category');
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
        $category = Category::where(["id" => $id, "user_id" => $user->id])->first();
        $category = json_encode($category);
        return $category;
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

        $new = Category::where(['user_id' => $user->id, 'id' => $data['form-id']])->first();
        $new->name = $data['form-name'];
        $new->rank = $data['form-rank'];
        $new->save();

        return redirect('/category');
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
        Category::where(['id' => $id, 'user_id' => $user->id])->delete();

        return redirect('/category');
    }
}
