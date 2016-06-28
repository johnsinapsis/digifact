<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UbiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }
	
	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list_pais()
    {
        $listpais = DB::table('par_pais')->select('id','pai_nombre')->orderBy('pai_nombre')->get();
		return $listpais;
    }

	
	/**
     * Display the specified resource.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function list_depto(Request $request)
    {
        if($request->ajax()){
		 $pais = $request->get('cod');
		 $listdepto = DB::table('par_departamento')->select('dep_codigo','dep_nombre')
		               ->where('pai_id',$pais)
		               ->orderBy('dep_nombre')->get();
		 return response()->json($listdepto);
		}
    }
	
	public function listdepto($pais)
    {
		
		 $listdepto = DB::table('par_departamento')->select('dep_codigo','dep_nombre')
		               ->where('pai_id',$pais)
		               ->orderBy('dep_nombre')->get();
		 return $listdepto;
    }
	
	/**
     * Display the specified resource.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function list_ciudad(Request $request)
    {
        if($request->ajax()){
		 $depto = $request->get('cod');
		 $listciudad = DB::table('par_ciudad')->select('cod_ciudad','nom_ciudad')
		               ->where('cod_depto',$depto)
		               ->orderBy('nom_ciudad')->get();
		 return response()->json($listciudad);
		}
    }
	
	public function listciudad($depto)
    {  
		 $listciudad = DB::table('par_ciudad')->select('cod_ciudad','nom_ciudad')
		               ->where('cod_depto',$depto)
		               ->orderBy('nom_ciudad')->get();
		 return $listciudad;	
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
