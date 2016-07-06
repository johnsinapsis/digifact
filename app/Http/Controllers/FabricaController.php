<?php

namespace App\Http\Controllers;

use App\Fabrica;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class FabricaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "select prod_insumo.idprod, prod_insumo.idinsumo, a.NOM_PRO as producto, b.NOM_PRO as insumo
                from prod_insumo 
                inner join productos a on a.COD_PRO = prod_insumo.idprod
                inner join productos b on b.COD_PRO = prod_insumo.idinsumo
                order by 1,2 limit 10";
        $fabri = DB::select($sql);
        return $fabri;
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
        //dd($request->get('idprodc'));
        $mensaje = [
            'idprodc.exist' => 'No existe el producto',
            'idinsu.exist' => 'No existe el producto',
        ];
         $v = \Validator::make($request->all(), [
             'idinsu'  => 'required|exists:productos,COD_PRO',
             'idprodc' => 'required|exists:productos,COD_PRO',
            ],$mensaje);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $serv = new Fabrica([
                    'idprod' => $request->get('idprodc'),
                    'idinsumo' => $request->get('idinsu'),
                ]);
            $serv->save();
            return View('config.viewprodInsumo')->with('mensaje','Relación Producto / Insumo Registrado Satisfactoriamente');
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
        $id = $request->get('idprod');
        $sql = "select prod_insumo.idprod, prod_insumo.idinsumo, a.NOM_PRO as producto, b.NOM_PRO as insumo
                from prod_insumo 
                inner join productos a on a.COD_PRO = prod_insumo.idprod
                inner join productos b on b.COD_PRO = prod_insumo.idinsumo 
                where prod_insumo.idprod = ".$id."
                order by 1,2 ";
        $fabri = DB::select($sql);
        //dd(compact('fabri'));
        $view = View('config.viewprodInsumo', compact('fabri'));
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
        //dd($request->get('idinsu'));
        $idprod = $request->get('idprodc');
        $idinsumo = $request->get('idinsu');
        Fabrica::where('idprod',$idprod)
              ->where('idinsumo',$idinsumo)
              ->delete();
        return response()->json(array('mensaje'=>'Producto / Insumo eliminado Satisfactoriamente'));
        }
    }

    public function link_postdelete()
    {
        return View('config.viewprodInsumo')->with('mensaje','Producto / Insumo eliminado Satisfactoriamente');
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
