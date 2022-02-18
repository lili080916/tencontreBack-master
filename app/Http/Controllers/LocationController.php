<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Image;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::paginate(9);
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all();

        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'location' => ['required'],
            'email' => ['unique:users'],
            'country' => ['required'],
        ]);

        $data = $request->all();

        if($request->file('logo') != null && $request->file('logo') != '') {

            // ruta de las imagenes guardadas
            $ruta = public_path().'/uploads/locations/';

            // recogida del form
            $imagenOriginal = $request->file('logo');

            // crear instancia de imagen
            $imagen = Image::make($imagenOriginal);

            // generar un nombre aleatorio para la imagen
            $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();

            $imagen->resize(300,300);

            // guardar imagen
            // save( [ruta], [calidad])
            $imagen->save($ruta . $temp_name, 100);

            $img = $temp_name;
        }
        else{
            $img = 'unknown.png';
        }

        $data['logo'] = $img;
        $location = Location::create($data);

        return redirect()->route('admin.locations.index')->with('msg' ,'Successfull');
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
        $location = Location::findOrFail($id);

        return view('locations.edit', compact('location'));
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
        $this->validate(request(), [
            'location' => ['required'],
            'email' => ['unique:users'],
            'country' => ['required'],
        ]);

        $location = Location::findOrFail($id);

        $data = $request->all();

        if($request->file('logo') != null && $request->file('logo') != '') {

            // ruta de las imagenes guardadas
            $ruta = public_path().'/uploads/locations/';

            // recogida del form
            $imagenOriginal = $request->file('logo');

            // crear instancia de imagen
            $imagen = Image::make($imagenOriginal);

            // generar un nombre aleatorio para la imagen
            $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();

            $imagen->resize(300,300);

            // guardar imagen
            // save( [ruta], [calidad])
            $imagen->save($ruta . $temp_name, 100);

            $img = $temp_name;
        }
        else{
            $img = 'unknown.png';
        }

        $data['logo'] = $img;

        $location->update($data);

        return redirect()->route('admin.locations.index')->with('msg' ,'Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        $location->delete();

        return back()->with('msg', 'Successfull');
    }

    // generar random
    protected function random_string()
    {
        $key = '';
        $keys = array_merge( range('a','z'), range(0,9) );

        for($i=0; $i<10; $i++)
        {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    /*******************************
    *   APi                        *
    ********************************/

    //  Location list
    public function allLocation()
    {
        $locations = Location::all();

        return response(['data' => $locations], 200);
    }
}
