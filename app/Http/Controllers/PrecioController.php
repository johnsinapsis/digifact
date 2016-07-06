<?php

namespace App\Http\Controllers;

use DB;

use App\Precio;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd("hola");
        $prec = Precio:: select('productos.COD_PRO','entidades.COD_ENT','NOM_ENT','NOM_PRO','VAL_PRO','VAL_IVA')
                        ->join('productos','productos.COD_PRO','=','precios.COD_PRO')
                        ->join('entidades','entidades.COD_ENT','=','precios.COD_ENT')
                        ->orderBy('NOM_ENT')
                        ->orderBy('NOM_PRO')
                        ->paginate(5);
        //dd($prec);
        return $prec;
    }


    public function link_postdelete()
    {
        return View('config.viewprecio')->with('mensaje','Precio eliminado Satisfactoriamente');
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

    public function copiaprec(Request $request)
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
           
            DB::insert("insert into precios 
                            select COD_PRO, '$destiny',VAL_PRO ,VAL_IVA from precios where COD_ENT = '$origin' 
                                   and COD_PRO not in (select COD_PRO from precios where COD_ENT = '$destiny') ");

            return View('config.viewprecio')->with('mensaje2','Copia Realizada Satisfactoriamente');
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
             'idprod' => 'required|exists:productos,COD_PRO',
             'valpro' => 'required|numeric',
             'valiva' => 'required|numeric|between:0,100'
            ],$mensaje);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $serv = new Precio([
                    'COD_ENT' => $request->get('ident'),
                    'COD_PRO' => $request->get('idprod'),
                    'VAL_PRO' => $request->get('valpro'),
                    'VAL_IVA' => $request->get('valiva'),
                ]);
            $serv->save();
            return View('config.viewprecio')->with('mensaje','Precio Registrado Satisfactoriamente');
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
        $prec = Precio:: select('productos.COD_PRO','entidades.COD_ENT','NOM_ENT','NOM_PRO','VAL_PRO','VAL_IVA')
                        ->join('productos','productos.COD_PRO','=','precios.COD_PRO')
                        ->join('entidades','entidades.COD_ENT','=','precios.COD_ENT')
                            ->where('precios.COD_ENT',$id)
                            ->orderBy('NOM_PRO')
                            ->paginate(5);
        //dd(compact('prec'));
        $view = View('config.viewprecio', compact('prec'));
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
        $idprod = $request->get('codpro');
        Precio::where('COD_ENT',$ident)
              ->where('COD_PRO',$idprod)
              ->delete();
        return response()->json(array('mensaje'=>'PRecio eliminado Satisfactoriamente'));
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
