<?php

namespace App\Http\Controllers\User;

//use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios=User::all();
        return $this->showAll($usuarios);
        //return response()->json(['data'=>$usuarios],200);
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
        $campos['password']= Hash::make($request->password);
        $reglas=['name'=>'required','last_name'=>'required','email'=>'required|email|unique:users','password'=>'required|confirmed','address'=>'required','latitud'=>'required','longitud'=>'required','type'=>'required','neighborhood'=>'required','city_id'=>'required'];

        $this->validate($request, $reglas);

        $usuario=[
         'name'=>$request->name,
         'last_name'=>$request->last_name,
         'email'=>$request->email,
         'password'=>Hash::make($request->password),
         'phone'=>$request->phone,
         'rol_id'=>$request->rol_id
        ];

        $usuario= User::create($usuario);
        $usuario->id;
        $punto=$request->latitud.' '.$request->longitud;
        //   $sector_id=$this->buscarSector($punto,$request->city_id);

        return $this->showOne($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user, 200);
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
        $usuario=User::findOrFail($id);
        $usuario->delete();
        return $this->showOne($usuario, 201);
    }

    public function buscarSector($punto, $city_id)
    {
        //  $punto=$this->puntoCoordenadas($punto);

        $sectores=Sector::where('city_id', $city_id)->get();

        foreach ($sectores as $sector) {
            $poligono=explode(",", $sector->polygon);
            $ubicacion=$this->pointInPolygon($punto, $poligono);
        }
        dd($ubicacion);
        return $this->showAll($sectores);


        dd($sectores);
        dd($punto);
    }




    public function pointInPolygon($point, $polygon, $pointOnVertex = true)
    {
        //$this->pointOnVertex = $pointOnVertex;

        // Transformar la cadena de coordenadas en matrices con valores "x" e "y"
        //   $point = $this->pointStringToCoordinates($point);
        $vertices = array();

        foreach ($polygon as $vertex) {
            $vertices[] = $this->pointStringToCoordinates($vertex);
        }

        // Checar si el punto se encuentra exactamente en un vértice
        if ($pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return "vertex";
            dd('vertes');
        }

        // Checar si el punto está adentro del poligono o en el borde
        $intersections = 0;
        $vertices_count = count($vertices);
        dd($vertices);
        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1];
            $vertex2 = $vertices[$i];

            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) {
                // Checar si el punto está en un segmento horizontal
                return "boundary";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) {
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
                if ($xinters == $point['x']) { // Checar si el punto está en un segmento (otro que horizontal)
                    return "boundary";
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++;
                }
            }
        }
        // Si el número de intersecciones es impar, el punto está dentro del poligono.
        if ($intersections % 2 != 0) {
            return "inside";
        } else {
            return "outside";
        }
    }

    public function pointOnVertex($point, $vertices)
    {
        foreach ($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
    }

    public function pointStringToCoordinates($pointString)
    {
        $coordinates = explode(" ", $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }
}
