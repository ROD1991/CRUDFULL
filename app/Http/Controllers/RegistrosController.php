<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registros;

class RegistrosController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $registros = Registros::where('id', 'desc')->paginate(3);
        }
        else{
            $registros = Registros::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(5);
        }
        

        return [
            'pagination' => [
                'total'        => $registros->total(),
                'current_page' => $registros->currentPage(),
                'per_page'     => $registros->perPage(),
                'last_page'    => $registros->lastPage(),
                'from'         => $registros->firstItem(),
                'to'           => $registros->lastItem(),
            ],
            'registros' => $registros
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $registros = new Registros ();
       $registros->codigo_expediente = $request->codigo_expediente;
       $registros->fecha = $request->fecha;
       $registros->rut = $request->rut;
       $registros->movimiento = $request->movimiento;
       $registros->save();
    }
    public function update(Request $request)
    {

       if (!$request->ajax()) return redirect('/');
       $expediente =  Registros::findOrFail($request->id);
       $expediente->codigo_expediente = $request->codigo_expediente;
       $expediente->usuario = $request->usuario;
       $expediente->condicion = '1';
       $expediente->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       $expediente =  Registros::findOrFail($request->id);
       $expediente->condicion = '0';
       $expediente->save();
    }
    public function activar(Request $request)
    {
       
       if (!$request->ajax()) return redirect('/');
       $expediente =  Registros::findOrFail($request->id);
       $expediente->condicion = '1';
       $expediente->save();
    }


}
