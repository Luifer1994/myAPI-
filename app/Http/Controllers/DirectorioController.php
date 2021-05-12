<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDirectorioRequest;
use App\Http\Requests\UpdateDirectorioRequest;
use App\Models\Directorio;
use Directory;
use Illuminate\Http\Request;

class DirectorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  GET
    public function index(Request $request)
    {
        if ($request->has('txtBuscar'))
        {
            $directorios = Directorio::where('nombre', 'like', '%'.$request->txtBuscar.'%')
            ->orWhere('telefono', 'like', '%'.$request->txtBuscar.'%')
            ->orWhere('direccion', 'like', '%'.$request->txtBuscar.'%')
            ->get();
        }
        else {
            $directorios = Directorio::all();
        }
        return $directorios;
    }

    private function subirArchivo($file)
    {
        $nombreArchivo = time(). '.'. $file->getClientOriginalExtension();
        $file->move(public_path('fotografias'), $nombreArchivo);
        return $nombreArchivo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST
    public function store(CreateDirectorioRequest $request)
    {
        $imput = $request->all();
        if($request->has('foto'))
            $input['foto'] = $request->file('foto')->store('imagenes/directorio/','public');
        Directorio::create($imput);
        return response()->json([
            'res' => true,
            'message'=> 'Registro exitoso',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Directorio $directorio)
    {
        return $directorio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //PUT
    public function update(UpdateDirectorioRequest $request, Directorio $directorio)
    {
        $input = $request->all();

        $directorio->update($input);
        return response()->json([
            'res' => true,
            'message'=> 'Registro Actualizado con exitoso',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $directorio = Directorio::find($id);
        $directorio->delete();
        return response()->json([
            'res' => true,
            'message'=> 'Registro Eliminado con exitoso',
        ],200);
    }
}
