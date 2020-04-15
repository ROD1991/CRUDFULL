<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimiento;
use Illuminate\Support\Facades\DB;


use Carbon\Carbon;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $movimiento = Movimiento::where('id', 'desc')->paginate(3);
        }
        else{
            $movimiento = Movimiento::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(5);
        }
        

        return [
            'pagination' => [
                'total'        => $movimiento->total(),
                'current_page' => $movimiento->currentPage(),
                'per_page'     => $movimiento->perPage(),
                'last_page'    => $movimiento->lastPage(),
                'from'         => $movimiento->firstItem(),
                'to'           => $movimiento->lastItem(),
            ],
            'movimiento' => $movimiento
        ];
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

    public function listarPdf(Request $request,$buscar)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            
        }
        else{
            $movimiento = Movimiento::where( 'regis','=',$buscar)->orderBy('id', 'desc')->get();
        }


    $pdf = \PDF::loadView('pdf.movipdf',['movimiento'=>$movimiento]);
    return $pdf->download('movimiento.pdf');
    }
    
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $movimiento = new Movimiento ();
        $movimiento->regis = $request->regis;
        $movimiento->fecha = $request->fecha;
        $movimiento->rut = $request->rut;
        $movimiento->personal = $request->personal;
        $movimiento->condicion = '1';
        $movimiento->estado = 'disponible';
        $movimiento->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
      
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
    public function update(Request $request)
    {

       if (!$request->ajax()) return redirect('/');
       $movimiento =  Movimiento::findOrFail($request->id);
       $movimiento->regis = $request->regis;
        $movimiento->fecha = $request->fecha;
        $movimiento->rut = $request->rut;
        $movimiento->personal = $request->personal;
        $movimiento->condicion = '1';
        $movimiento->estado = $request->estado;
       $movimiento->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $movimiento =  Movimiento::findOrFail($request->id);
        $movimiento->condicion = '0';
       $movimiento->save();
    }
    public function activar(Request $request)
    {
       
       if (!$request->ajax()) return redirect('/');
       $movimiento =  Movimiento::findOrFail($request->id);
       $movimiento->condicion = '1';
       $movimiento->save();
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
}
