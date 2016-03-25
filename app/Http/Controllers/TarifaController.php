<?php

namespace App\Http\Controllers;

use DB;

use App\Tarifa;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tar = Tarifa:: select('servicios.COD_SER','entidades.COD_ENT','NOM_ENT','NOM_SER','VAL_SER')
                        ->join('servicios','servicios.COD_SER','=','tarifas.COD_SER')
                        ->join('entidades','entidades.COD_ENT','=','tarifas.COD_ENT')
                        ->orderBy('NOM_ENT')
                        ->orderBy('NOM_SER')
                        ->paginate(5);
        return $tar;
    }

    public function link_postdelete()
    {
        return View('config.viewtarifa')->with('mensaje','Tarifa eliminada Satisfactoriamente');
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

    public function copiatar(Request $request)
    {
        $origin = $request->get('ident3')."";
        $destiny = $request->get('ident2');
        //dd($origin."--".$destiny);
        $mensaje = [
            'ident3.exist' => 'No existe el cliente',
            'ident2.exist' => 'No existe el cliente',
            'ident2.not_in' => 'EL lugar de destino no puede ser igual al de origen',
        ];
        $v = \Validator::make($request->all(), [
             'ident3'  => 'required|exists:entidades,COD_ENT',
             'ident2'  => 'required|exists:entidades,COD_ENT|not_in:'.$origin,       
            ],$mensaje);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
           
            DB::insert("insert into tarifas 
                            select COD_SER, '$destiny',VAL_SER from tarifas where COD_ENT = '$origin' 
                                   and COD_SER not in (select COD_SER from tarifas where COD_ENT = '$destiny') ");

            return View('config.viewtarifa')->with('mensaje2','Copia Realizada Satisfactoriamente');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensaje = [
            'ident.exist' => 'No existe el cliente',
            'valiva.between' => 'El IVA es un valor entre 0 y 100'
        ];
         $v = \Validator::make($request->all(), [
             'ident'  => 'required|exists:entidades,COD_ENT',
             'idser' => 'required|exists:servicios,COD_SER',
             'valser' => 'required|numeric',
             
            ],$mensaje);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $serv = new Tarifa([
                    'COD_ENT' => $request->get('ident'),
                    'COD_SER' => $request->get('idser'),
                    'VAL_SER' => $request->get('valser'),
                ]);
            $serv->save();
            return View('config.viewprecio')->with('mensaje','Tarifa Registrada Satisfactoriamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->get('ident4');
        $tar = Tarifa:: select('servicios.COD_SER','entidades.COD_ENT','NOM_ENT','NOM_SER','VAL_SER')
                        ->join('servicios','servicios.COD_SER','=','tarifas.COD_SER')
                        ->join('entidades','entidades.COD_ENT','=','tarifas.COD_ENT')
                            ->where('tarifas.COD_ENT',$id)
                            ->orderBy('NOM_SER')
                         ->paginate(5);
        //dd(compact('tar'));
        $view = View('config.viewtarifa', compact('tar'));
        return $view;
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

    public function delete(Request $request)
    {
        if($request->ajax()){
        $ident = $request->get('codent');
        $idser = $request->get('codser');
        Tarifa::where('COD_ENT',$ident)
              ->where('COD_SER',$idser)
              ->delete();
        return response()->json(array('mensaje'=>'Tarifa eliminada Satisfactoriamente'));
        }
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
}
