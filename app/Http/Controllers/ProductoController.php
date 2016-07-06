<?php

namespace App\Http\Controllers;

use App\Producto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Database\Schema\Blueprint;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Schema;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prod = Producto::select('COD_PRO','NOM_PRO','EST_PRO','TIP_PRO','ABBR','nombre','MIN_PRO','MAX_PRO')
                        ->join('par_unimedida','id','=','UNI_PRO')
                        ->orderBy('NOM_PRO')
                        ->paginate(5);
        $prod->setPath(route('producto'));
        return $prod;
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
        $v = \Validator::make($request->all(), [
             'nomprod' => 'required',
             'minimo' =>  'numeric',
             'maximo' =>  'numeric',
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $prod = new Producto([
                    'NOM_PRO' => $request->get('nomprod'),
                    'EST_PRO' => $request->get('estado'),
                    'TIP_PRO' => $request->get('tipo'),
                    'ABBR' => $request->get('abrprod'),
                    'UNI_PRO' => $request->get('unidad'),
                    'MIN_PRO' => $request->get('minimo')+0,
                    'MAX_PRO' => $request->get('maximo')+0,
                ]);
            $prod->save();

            $sel = Producto::max('COD_PRO');

            Schema::create('kd'.$sel,function(Blueprint $table){
            $table->increments('id');
            $table->date('fecha');
            $table->integer('idbodega')->unsigned();
            $table->integer('tipo')->unsigned();
            $table->decimal('cant',5,2);
            $table->decimal('valor',8,2);
       });

            return View('config.viewproducto')->with('mensaje','Producto Registrado Satisfactoriamente');
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
        $config = Producto:: select('COD_PRO','NOM_PRO','EST_PRO','TIP_PRO','ABBR','UNI_PRO','nombre as UNI_NOM','MIN_PRO','MAX_PRO')
                            ->join('par_unimedida','id','=','UNI_PRO')
                            ->where('COD_PRO',$id)
                            ->first();
        //return View('config.viewproducto');
        $view = View('config.viewproducto',[
            'producto_id'=> $config->COD_PRO,
            'producto_nom' => $config->NOM_PRO,
            'producto_est' => $config->EST_PRO,
            'producto_abr' => $config->ABBR,
            'producto_tip' => $config->TIP_PRO,
            'producto_uni' => $config->UNI_PRO,
            'producto_med' => $config->UNI_NOM,
            'producto_min' => $config->MIN_PRO,
            'producto_max' => $config->MAX_PRO,
            ]);
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
        $prod = Producto:: select('COD_PRO','NOM_PRO','EST_PRO','TIP_PRO','ABBR','UNI_PRO','nombre as UNI_NOM','MIN_PRO','MAX_PRO')
                          ->join('par_unimedida','id','=','UNI_PRO')
                          ->where('COD_PRO',$id)
                          ->first();
        //return View('config.viewproducto');
        $view = View('config.viewproducto',[
            'producto_id'=> $prod->COD_PRO,
            'producto_nom' => $prod->NOM_PRO,
            'producto_est' => $prod->EST_PRO,
            'producto_abr' => $prod->ABBR,
            'producto_tip' => $prod->TIP_PRO,
            'producto_uni' => $prod->UNI_PRO,
            'producto_med' => $prod->UNI_NOM,
            'producto_min' => $prod->MIN_PRO,
            'producto_max' => $prod->MAX_PRO,
            ]);
        return $view;
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
        $v = \Validator::make($request->all(), [
             'nomprod' => 'required',
             'minimo' =>  'numeric',
             'maximo' =>  'numeric',
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            Producto::where('COD_PRO', $id)
                    ->update([
                    'NOM_PRO' => $request->get('nomprod'),
                    'EST_PRO' => $request->get('estado'),
                    'TIP_PRO' => $request->get('tipo'),
                    'ABBR' => $request->get('abrprod'),
                    'UNI_PRO' => $request->get('unidad'),
                    'MIN_PRO' => $request->get('minimo')+0,
                    'MAX_PRO' => $request->get('maximo')+0,
                        ]); 

            return View('config.viewproducto')->with('mensaje','Producto Actualizado Satisfactoriamente');
            
        }
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
