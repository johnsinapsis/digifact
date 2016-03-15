<?php

namespace App\Http\Controllers;

use App\Producto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prod = Producto::orderBy('NOM_PRO')
                        ->paginate(5);
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
             'nomprod' => 'required'
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $prod = new Producto([
                    'NOM_PRO' => $request->get('nomprod'),
                    'EST_PRO' => $request->get('estado'),
                    'TIP_PRO' => '1',
                    'ABBR' => $request->get('abrprod'),
                ]);
            $prod->save();
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
        $config = Producto:: where('COD_PRO',$id)
                            ->first();
        //return View('config.viewproducto');
        $view = View('config.viewproducto',[
            'producto_id'=> $config->COD_PRO,
            'producto_nom' => $config->NOM_PRO,
            'producto_est' => $config->EST_PRO,
            'producto_abr' => $config->ABBR,
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
        $prod = Producto:: where('COD_PRO',$id)
                            ->first();
        //return View('config.viewproducto');
        $view = View('config.viewproducto',[
            'producto_id'=> $prod->COD_PRO,
            'producto_nom' => $prod->NOM_PRO,
            'producto_est' => $prod->EST_PRO,
            'producto_abr' => $prod->ABBR,
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
             'nomprod' => 'required'
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
                    'TIP_PRO' => '1',
                    'ABBR' => $request->get('abrprod'),
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
