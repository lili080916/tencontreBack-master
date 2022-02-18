<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Found;
use App\Product;
use App\User;

use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource in map.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMap()
    {
        $timeLast = $this->_lastHours(24);

        setlocale(LC_ALL,"es_ES"); 
        \Carbon\Carbon::setLocale('es'); 

        $data = array();
        $prod = array();
        
        $locations = Found::where('status', '!=', 'Disabled')
                    ->where('last', '>=', $timeLast)
                    ->groupBy('longitude', 'latitude')
                    ->get();

        foreach ($locations as $key => $location) {

            $longitude = $location->longitude;
            $latitude = $location->latitude;
            $quantity = '';
            $last = '';
            $id = '';
            $found_id = '';
            $category_id = '';
            $product = '';
            $brand = '';

            $products = Found::where('status', '!=', 'Disabled')
                    ->where('last', '>=', $timeLast)
                    ->where('longitude', $location->longitude)
                    ->where('latitude', $location->latitude)
                    ->get();
            
            foreach ($products as $key => $product) {

                $found_id = $product->id;
                $last = Carbon::parse($product->last)->diffForHumans();
                $quantity = $product->quantity;
                $id = $product->product->id;
                $category_id = $product->product->category_id;
                $name = $product->product->product;
                $brand = $product->product->brand;

                $newProduct = array(
                        'id' => $id,
                        'product' => $name,
                        'category_id' => $category_id,
                        'quantity' => $quantity,
                        'found_id' => $found_id,
                        'last' => $last,
                        'brand' => $brand
                    );
                
                array_push($prod, $newProduct);
            }

            $location['products'] = $prod;
            $prod = array();

            array_push($data, $location);

        }
        // return response(['data' => $data], 200);

        $reports = $data;
        // dd($reports);
        return view('reports.map', compact('reports'));
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
        $report = Report::findOrFail($id);

        return view('reports.edit', compact('report'));
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
        $data = $request->all();
        
        $report = Report::findOrFail($id);
        $found = Found::findOrFail($report->found_id);

        $found->update($data);

        return back()->with('msg', 'Successfull');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $found = Found::findOrFail($report->found_id);

        $report->delete();
        $found->delete();

        return back()->with('msg', 'Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiDestroy(Request $request)
    {
        $ids = $request->input('reports');

        foreach ($ids as $key => $id) {

            $found = Found::findOrFail($id['id']);

            $found->delete();
        }

        return redirect()->route('admin.reports.index')->with('msg' ,'Successfull');
        // return back()->with('msg', 'Successfull');
    }

    /**
     * last hours
     */
    public function _lastHours($hour = 24)
    {
        $fecha = date('Y-m-d H:m');
        $nuevafecha = strtotime ( '-'.$hour.' hour' , strtotime ( $fecha ) ) ;
        $timeLast = date ( 'Y-m-d' , $nuevafecha );
		
		return $timeLast;
    }

    /**
     * calculate distance
     */
    function _distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'm', $decimals = 2) {
        // Cálculo de la distancia en grados
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
    
        // Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
        switch($unit) {
            case 'm':
                $distance = ($degrees * 111.13384) * 1000; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
                break;
            case 'km':
                $distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
                break;
            case 'nmi':
                $distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
        }
        return round($distance, $decimals);
    }

    /*******************************
    *   APi                        *
    ********************************/
}
