<?php

namespace App\Http\Controllers;

use App\Entidad;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ent = Entidad::orderBy('NOM_ENT')
                        ->paginate(5);
        return $ent;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
         $v = \Validator::make($request->all(), [
             'noment' => 'required',
             'nit' => 'required|numeric',
             'dirent' => 'required',
             'telent' => 'required'
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $ent = new Entidad([
                    'COD_ENT' => $request->get('nit'),
                    'NOM_ENT' => $request->get('noment'),
                    'DIR_ENT' => $request->get('dirent'),
                    'TEL_ENT' => $request->get('telent'),
                    'CEL_ENT' => $request->get('celent'),
                    'CON_ENT' => $request->get('conent'),
                    'EST_ENT' => $request->get('estado'),
                ]);
            $ent->save();
            return View('config.viewentidad')->with('mensaje','Cliente Registrado Satisfactoriamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->get('ident');
        $ent = Entidad:: where('COD_ENT',$id)
                            ->first();
        //dd($request);
        $view = View('config.viewentidad',[
            'entidad_nit' => $ent->COD_ENT,
            'entidad_nom' => $ent->NOM_ENT,
            'entidad_est' => $ent->EST_ENT,
            'entidad_dir' => $ent->DIR_ENT,
            'entidad_tel' => $ent->TEL_ENT,
            'entidad_cel' => $ent->CEL_ENT,
            'entidad_con' => $ent->CON_ENT,
            ]);
        return $view;
    }

    /**
     * calcula el digito de verificación de un nit
     *
     * @param  int  $id
     * @return Response
     */
    public function calcularDV($nit)
    {
        if (! is_numeric($nit)) {
        return false;
    }
 
    $arr = array(1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19, 
    8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71);
    $x = 0;
    $y = 0;
    $z = strlen($nit);
    $dv = '';
    
    for ($i=0; $i<$z; $i++) {
        $y = substr($nit, $i, 1);
        $x += ($y*$arr[$z-$i]);
    }
    
    $y = $x%11;
    
    if ($y > 1) {
        $dv = 11-$y;
        return $dv;
    } else {
        $dv = $y;
        return $dv;
    }
    
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $ent = Entidad:: where('COD_ENT',$id)
                            ->first();
        //return View('config.viewproducto');
        $view = View('config.viewentidad',[
            'entidad_nit' => $ent->COD_ENT,
            'entidad_nom' => $ent->NOM_ENT,
            'entidad_est' => $ent->EST_ENT,
            'entidad_dir' => $ent->DIR_ENT,
            'entidad_tel' => $ent->TEL_ENT,
            'entidad_cel' => $ent->CEL_ENT,
            'entidad_con' => $ent->CON_ENT,
            ]);
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $v = \Validator::make($request->all(), [
             'noment' => 'required',
             'nit' => 'required|numeric',
             'dirent' => 'required',
             'telent' => 'required'
            ]);
          if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            Entidad::where('COD_ENT', $id)
                    ->update([
                    'COD_ENT' => $request->get('nit'),
                    'NOM_ENT' => $request->get('noment'),
                    'DIR_ENT' => $request->get('dirent'),
                    'TEL_ENT' => $request->get('telent'),
                    'CEL_ENT' => $request->get('celent'),
                    'CON_ENT' => $request->get('conent'),
                    'EST_ENT' => $request->get('estado'),
                        ]); 
            return View('config.viewentidad')->with('mensaje','Cliente Actualizado Satisfactoriamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
