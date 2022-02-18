<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;

class FavoriteController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*******************************
    *   APi                        *
    ********************************/

    //  Favorite list
    public function getFavoriteList(Request $request)
    {
        return response(['data' => Favorite::where('user_id', $request->user()->id)->where('is_deleted', 0)->get()], 200);

    }

    // get Favorite by ID
    public function getFavoriteById(Request $request)
    {
        $favorite = Favorite::where('id', $request->user()->id)->first();

        return response(['data' => $favorite], 200);
    }

    // add Favorite
    public function saveAddFavorite(Request $request)
    {
        // $this->validate($request, Favorite::rules());
        $data = $request->all();

        $data['is_deleted'] = 0;
        $data['user_id'] = $request->user()->id;

        $favorite = Favorite::create($data);

        $addData = Favorite::where('user_id', $request->user()->id)->get();

        return response(['data' => $addData], 201);
    }

    // delete Favorite
    public function deleteFavorite(Request $request)
    {
        $favorite = Favorite::where('user_id', $request->user()->id)
                    ->where('longitude', $request->input('longitude'))
                    ->where('latitude', $request->input('latitude'))
					->where('is_deleted', 0)
                    ->first();
        $response = $favorite;
        $data['is_deleted'] = 1;
        $favorite->update($data);

        return response(['data' => $response], 201);
    }
}
