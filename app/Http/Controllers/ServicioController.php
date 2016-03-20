<?php

namespace App\Http\Controllers;

use App\Servicio;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serv = Servicio::orderBy('NOM_SER')
                        ->paginate(5);
        return $serv;
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
             'nomserv' => 'required'
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $serv = new Servicio([
                    'NOM_SER' => $request->get('nomserv'),
                    'EST_SER' => $request->get('estado'),
                    'TIP_SER' => '1',
                    'ABBR' => $request->get('abrserv'),
                ]);
            $serv->save();
            return View('config.viewservicio')->with('mensaje','Servicio Registrado Satisfactoriamente');
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
        $id = $request->get('idserv');
        $config = Servicio:: where('COD_SER',$id)
                            ->first();
        //return View('config.viewproducto');
        $view = View('config.viewservicio',[
            'servicio_id'=>   $config->COD_SER,
            'servicio_nom' => $config->NOM_SER,
            'servicio_est' => $config->EST_SER,
            'servicio_abr' => $config->ABBR,
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
         $serv = Servicio:: where('COD_SER',$id)
                            ->first();
        //return View('config.viewproducto');
        $view = View('config.viewservicio',[
            'servicio_id'  => $serv->COD_SER,
            'servicio_nom' => $serv->NOM_SER,
            'servicio_est' => $serv->EST_SER,
            'servicio_abr' => $serv->ABBR,
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
             'nomserv' => 'required'
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            Servicio::where('COD_SER', $id)
                    ->update([
                    'NOM_SER' => $request->get('nomserv'),
                    'EST_SER' => $request->get('estado'),
                    'TIP_SER' => '1',
                    'ABBR' => $request->get('abrserv'),
                        ]); 
            return View('config.viewservicio')->with('mensaje','Servicio Actualizado Satisfactoriamente');
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
