<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Recipe::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'recipe_name' => 'required',

        ]);

        return Recipe::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = Recipe::find($id);
        if ($list->id == Auth::user()->id) {
            return $list;
        } else {
            return response()->json([
                "message" => "not correct user"
            ], 401);
        }
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Recipe::destroy($id);
    }

    /**
     * Search function
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($recipe_name)
    {
        return Recipe::where('title', 'like', '%' . $recipe_name . '%')->get();
    }
}
