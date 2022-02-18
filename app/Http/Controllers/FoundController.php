<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Found;
use App\Report;
use App\User;
use App\Product;
use Image;
use Carbon\Carbon;
// use Vinkla\Pusher\Facades\Pusher as LaravelPusher;
// use Pusher\Laravel\Facades\Pusher;

use RedisManager;
// use Illuminate\Support\Facades\Redis;

class FoundController extends Controller
{
    // protected $redis;

    // function __construct()
    // {
    //     $this->redis = RedisManager::connection();
    // }

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

    //  Found Search
    public function getFoundSearch(Request $request)
    {
        $timeLast = $this->_lastHours(24);

        setlocale(LC_ALL,"es_ES"); 
        \Carbon\Carbon::setLocale('es'); 

        $data = array();
        $prod = array();

        $locations = Found::whereIn('product_id', $request->input('product_id'))
                ->where('status', '!=', 'Disabled')
                ->where('last', '>=', $timeLast)
                ->groupBy('longitude', 'latitude')
                // ->distinct()
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
            // $location['distance'] = $this->_distanceCalculation($location->latitude, $location->longitude, $request->input('latitude'), $request->input('longitude'), 'km', 2);
            $prod = array();

            array_push($data, $location);
        }

        return response(['data' => $data], 200);
    }

    public function getFoundSearchList(Request $request)
    {
        $timeLast = $this->_lastHours(24);

        setlocale(LC_ALL,"es_ES"); 
        \Carbon\Carbon::setLocale('es'); 

        $data = array();
        $prod = array();

        $locations = Found::whereIn('product_id', $request->input('product_id'))
                ->where('status', '!=', 'Disabled')
                ->where('last', '>=', $timeLast)
                ->groupBy('longitude', 'latitude')
                // ->distinct()
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
            $location['distance'] = $this->_distanceCalculation($location->latitude, $location->longitude, $request->input('latitude'), $request->input('longitude'), 'km', 2);
            $prod = array();

            array_push($data, $location);
        }

        return response(['data' => $data], 200);
    }

    // all found last hours
    public function getFoundAll()
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
        return response(['data' => $data], 200);
    }

    // list found by users
    public function getFoundList(Request $request)
    {
        $timeLast = $this->_lastHours(24);
        
        $data = Found::join('reports', 'reports.found_id', '=', 'founds.found_id')
                    ->where('reports.user_id', '!=', $request->user()->id)
                    ->where('status', '!=', 'Disabled')
                    ->where('last', '>=', $timeLast)
                    ->get();

        return response(['data' => $data], 200);
    }

    // get found by ID
    public function getFoundById(Request $request)
    {
        $found = Found::where('id', $request->input('found_id'))->first();

        return response(['data' => $found], 200);
    }

    // get found by Locations
    public function getFoundByLocation(Request $request)
    {
        setlocale(LC_ALL,"es_ES"); 
        \Carbon\Carbon::setLocale('es'); 
        
        $timeLast = $this->_lastHours(24);
        $data;
        $prod = array();
        $location;
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $quantity = '';
        $last = '';
        $id = '';
        $name = '';
        $found_id = '';
        $category_id = '';
        $product = '';
        $brand = '';

        $found = Found::where('longitude', $request->input('longitude'))
                    ->where('latitude', $request->input('latitude'))
                    ->where('status', '!=', 'Disabled')
                    ->where('last', '>=', $timeLast)
                    ->get();

        if($found->isEmpty()) return response(['data' => 'Not Found'], 404);

        foreach ($found as $key => $product) {

            if ($product->image != NULL && $product->image != '') {
                $data = $product;
            }

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

        $data['products'] = $prod;

        //array_push($data, $location);

        return response(['data' => $data], 200);
    }

    public function getFoundByLocationDistance(Request $request)
    {
        setlocale(LC_ALL,"es_ES"); 
        \Carbon\Carbon::setLocale('es'); 
        
        $timeLast = $this->_lastHours(24);
        $data;
        $prod = array();
        $location;
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $quantity = '';
        $last = '';
        $id = '';
        $name = '';
        $found_id = '';
        $category_id = '';
        $product = '';
        $brand = '';

        $found = Found::where('longitude', $request->input('longitude'))
                    ->where('latitude', $request->input('latitude'))
                    ->where('status', '!=', 'Disabled')
                    ->where('last', '>=', $timeLast)
                    ->get();

        if($found->isEmpty()) return response(['data' => 'Not Found'], 404);

        foreach ($found as $key => $product) {

            if ($product->image != NULL && $product->image != '') {
                $data = $product;
            }

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

        $data['products'] = $prod;
        $data['distance'] = $this->_distanceCalculation($data->latitude, $data->longitude, $request->input('user_latitude'), $request->input('user_longitude'), 'km', 2);

        //array_push($data, $location);

        return response(['data' => $data], 200);
    }

    public function saveAddFoundOld(Request $request)
    {
        
        //$this->validate($request, Found::rules());
		
		$data = $request->all();
		$img;
        $products = mb_split(',', $request->input('products'));
        $timeLast = $this->_lastHours(24);
		
		 //return response(['data' => $products], 201);
		
		if($request->file('photo') != null && $request->file('photo') != '') {
			  
          // ruta de las imagenes guardadas
          $ruta = public_path().'/uploads/products/';
		
          // recogida del form
          $imagenOriginal = $request->file('photo');
			
          // crear instancia de imagen
          $imagen = Image::make($imagenOriginal);

          // generar un nombre aleatorio para la imagen
          $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();

          $imagen->resize(200,300);

          // guardar imagen
          // save( [ruta], [calidad])
          $imagen->save($ruta . $temp_name, 100);

          $img = $temp_name;
        }
        else{
            $img = 'unknown.png';
        }
		
        /**
         * search same found by location and product.
         * if exist update atribute last and quantity
         * else insert found new
         */  

        foreach ($products as $key => $product) {
            $founds = Found::where('status', '!=', 'Disabled')
                        ->where('product_id', '=', (int)$product)
                        ->where('last', '>=', $timeLast)
                        ->get();
            $exist = false;
			
            $foundID;

            foreach ($founds as $key => $found) {
                
                $distance = $this->_distanceCalculation($found->latitude, $found->longitude, $request->input('latitude'), $request->input('longitude'), 'm', 2);

                if($distance < 50) {

                    if($img != 'unknown.png') {
                        $found->image = $img;
                    }

                    $found->quantity = $found->quantity + 1;
                    $found->last = date('Y-m-d H:m:i');
                    $found->status = 'Active';
                    $found->save();
                    $exist = true;
                    $foundID = $found->id;

                    break;
                }
            }

            /**
             * save e new report by user and found
             */
            if (!$exist) {
                $found = Found::create([
                    'product_id' => $product,
                    'longitude' => $request->input('longitude'),
                    'latitude' => $request->input('latitude'),
                    'quantity' => 1,
                    'status' => 'Active',
                    'image' => $img,
                    'description' => $request->input('description'),
                    'first' => date('Y-m-d H:m:i'),
                    'last' => date('Y-m-d H:m:i'),
                ]);

                $foundID = $found->id;
            }
            $report = Report::create([
                'found_id' => $foundID,
                'user_id' => $request->user()->id,
            ]);
        }

        // LaravelPusher::trigger('chat_channel', 'chat_saved', ['message' => $finalData]);
        // Pusher::trigger('selfcars-staging', 'chat_saved', ['message' => $finalData->chat]);

        // event(new ChatConversation($chatText));

        // pusher
        // event(new ChatConversation($finalData));

        $redis = RedisManager::connection();
        $redis->publish('message', json_encode(['data' => 'test']));

        return response(['data' => 'success'], 201);
    }

    public function saveUpdateFound(Request $request)
    {
        $found = Found::where('id', $request->input('id'))->first();

        $data = $request->all();

        $found->update($data);

        return response(['data' => $found], 200);
    }

    public function deleteFound(Request $request)
    {
        $found = Found::where('id', $request->input('id'))->first();

        $response = $found;
        $data['is_deleted'] = 1;
        $found->update($data);

        return response(['data' => $response], 201);
    }

    /**
     * test save
     */
    public function saveAddFound(Request $request)
    {
        
        //$this->validate($request, Found::rules());
		
		$data = $request->all();
        $img;
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        
        $latitudeRelative;
        $longitudeRelative;
        $disMin = 50;

        $products = mb_split(',', $request->input('products'));
        $timeLast = $this->_lastHours(24);
		
		 //return response(['data' => $products], 201);
		
		if($request->file('photo') != null && $request->file('photo') != '') {
			  
          // ruta de las imagenes guardadas
          $ruta = public_path().'/uploads/products/';
		
          // recogida del form
          $imagenOriginal = $request->file('photo');
			
          // crear instancia de imagen
          $imagen = Image::make($imagenOriginal);

          // generar un nombre aleatorio para la imagen
          $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();

          $imagen->resize(200,300);

          // guardar imagen
          // save( [ruta], [calidad])
          $imagen->save($ruta . $temp_name, 100);

          $img = $temp_name;
        }
        else{
            $img = 'unknown.png';
        }

        /**
         * take location for report
         */

        $locations = Found::where('status', '!=', 'Disabled')
                    ->where('last', '>=', $timeLast)
                    ->groupBy('longitude', 'latitude')
                    ->get();

        /**
         * loop for location 
         */

        foreach ($locations as $key => $location) {
            $distance = $this->_distanceCalculation($location->latitude, $location->longitude, $request->input('latitude'), $request->input('longitude'), 'm', 2);

            if($distance < $disMin) {

                $disMin = $distance;

                $latitude = $location->latitude;
                $longitude = $location->longitude;
            }
        }
		
        /**
         * search same found by location and product.
         * if exist update atribute last and quantity
         * else insert found new
         */  

        foreach ($products as $key => $product) {
            $found = Found::where('status', '!=', 'Disabled')
                        ->where('product_id', '=', (int)$product)
                        ->where('latitude', $latitude)
                        ->where('longitude', $longitude)
                        ->where('last', '>=', $timeLast)
                        ->first();

            $foundID;

            // foreach ($founds as $key => $found) {
                
            //     $distance = $this->_distanceCalculation($latitude, $longitude, $request->input('latitude'), $request->input('longitude'), 'm', 2);

            //     if($distance < 50) {

            //         if($img != 'unknown.png') {
            //             $found->image = $img;
            //         }

            //         $found->quantity = $found->quantity + 1;
            //         $found->last = date('Y-m-d H:m:i');
            //         $found->status = 'Active';
            //         $found->save();
            //         $exist = true;
            //         $foundID = $found->id;

            //         break;
            //     }
            // }

            /**
             * save e new report by user and found
             */
            if($found) {
                if($img != 'unknown.png') {
                    $found->image = $img;
                }

                $found->quantity = $found->quantity + 1;
                $found->last = date('Y-m-d H:m:i');
                $found->status = 'Active';
                $found->save();
                $foundID = $found->id;
            }
            else {
                $found = Found::create([
                    'product_id' => $product,
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'quantity' => 1,
                    'status' => 'Active',
                    'image' => $img,
                    'description' => $request->input('description'),
                    'first' => date('Y-m-d H:m:i'),
                    'last' => date('Y-m-d H:m:i'),
                ]);

                $foundID = $found->id;
            }
            $report = Report::create([
                'found_id' => $foundID,
                'user_id' => $request->user()->id,
            ]);
        }

        $redis = RedisManager::connection();
        $redis->publish('message', json_encode(['data' => 'test']));

        return response(['data' => 'success'], 201);
    }
    
    
    // delete found by Locations
    public function deleteFoundByLocation(Request $request)
    {
        $timeLast = $this->_lastHours(24);


        $allow_access = User::where('id', $request->user()->id)->first();
        if(!$allow_access->admin) return response(['data' => 'Allow access'], 403);

        $found = Found::where('longitude', $request->input('longitude'))
                    ->where('latitude', $request->input('latitude'))
                    ->where('status', '!=', 'Disabled')
                    ->where('last', '>=', $timeLast)
                    ->delete();

        return response(['data' => 'success'], 201);
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

    /**
     * test LRedis
     */

    protected function testRedist()
    {
        $redis = RedisManager::connection();
        $redis->publish('message', json_encode(['data' => 'success']));

        // LaravelPusher::trigger('chat_channel', 'chat_saved', ['message' => 'Hola']);
        // Pusher::trigger('selfcars-staging', 'chat_saved', ['message' => 'Kami']);

        // event(new ChatConversation($chatText));

        // pusher
        // event(new ChatConversation($finalData));
        return response(['data' => 'success'], 200);
    }
}
