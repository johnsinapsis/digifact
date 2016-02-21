<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use App\FacturaCab;
use App\FacturaDet;
use App\TmpFact;
use App\Configuracion;
use App\Entidad;
use App\Resolucion;
use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EntityController;

use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class FactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View('liq.viewliq');
    }

    /**
     * valida el formulario y anula factura
     *
     * @return Response
     */
    public function validanu(Request $request)
    {
        //$date = Carbon::now()->format('Y-m-d');
        $v = \Validator::make($request->all(),[
            'numfac' => 'required|numeric|exists:factura_cab,numfac',
            'motianu' => 'required|numeric|exists:motivo_anu,id'
            ]);
         if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            
            $factura = FacturaCab::select('estfac')
                                ->where('numfac',$request->get('numfac'))
                              ->first();
            if(($factura->estfac==0)||($factura->estfac==3)){
              return redirect()->back()->withInput()->withErrors('Estado de Factura no válido');
            }
            else{
            FacturaCab::where('numfac',$request->get('numfac'))
                    ->update([ 
                                'estfac' => '0',
                                'motianu'=> $request->get('motianu'),
                                'obseanu'=> $request->get('observ'),
                                'usuanu' => Auth::user()->id,
                                'fecanu' => Carbon::now()->format('Y-m-d')
                        ]);
           return View('liq.viewanu')->with('mensaje','Factura Anulada Satisfactoriamente');
         }
        }
    }



     /**
     * valida el formulario y radica
     *
     * @return Response
     */
    public function validrad(Request $request)
    {
        $factura = FacturaCab::select('fecfac')
                             ->where('numfac',$request->get('numfac'))
                             ->first();
        if($factura)
        $fecha = $factura->fecfac;
        else
        $fecha = Carbon::now()->format('Y-m-d');
        $date = Carbon::createFromFormat('Y-m-d',$fecha);
        $date = $date->subDay();
        $mensaje = [
            'fecha.after' => 'La fecha debe ser superior o igual a la fecha de la factura (:date)',
            'numfac.exists' => 'El numero de factura no se encuentra en estado Facturado'
        ];
        $v = \Validator::make($request->all(),[
            'numfac' => 'required|numeric|exists:factura_cab,numfac,estfac,1',
            'fecha' => 'required|date|after:'.$date
            ],$mensaje);
         if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            
            FacturaCab::where('numfac',$request->get('numfac'))
                    ->update([ 
                                'estfac' => '2',
                                'fecrad'=> $request->get('fecha'),
                                'usurad'=> Auth::user()->id
                        ]);
           return View('liq.viewrad')->with('mensaje','Factura Radicada Satisfactoriamente');
        }
    }

    
    public function queryrango(Request $request){
      $mensaje = [
            'numfac.exists' => 'El numero de factura no existe',
            'numfac2.exists' => 'El numero de factura no existe',
        ];
        $v = \Validator::make($request->all(),[
            'numfac' => 'required|numeric|exists:factura_cab,numfac',
            'numfac2' => 'required|numeric|exists:factura_cab,numfac'
            ],$mensaje);
         if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{

            $facini = $request->get('numfac');
            $facfin = $request->get('numfac2');

            $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->whereBetween('factura_cab.numfac', [$facini, $facfin])
                           ->groupBy('factura_cab.numfac','fecfac','cod_ent')
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
            $numreg = count($listfac); 
        $numreg ++;
        $rango = "A1:F".$numreg;

        Excel::create('Facturas por radicar', function($excel) use ($listfac,$rango) {
 
            $excel->sheet('Facturas', function($sheet) use ($listfac,$rango) {
 
                //$products = Product::all();
 
                $sheet->fromArray($listfac);

                // Set black background
                $sheet->row(1, function($row) {

                 // call cell manipulation methods
                        $row->setBackground('#45A9E3');

                });

                // Set border for range
                $sheet->setBorder($rango, 'thin');

                $sheet->setAutoFilter();
 
            });
        })->export('xls');

        }

    }

     public function queryrad()
    {
      $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->where('estfac','1')
                           ->groupBy('factura_cab.numfac','fecfac','cod_ent')
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
      //dd($listfac);

        $numreg = count($listfac); 
        $numreg ++;
        $rango = "A1:F".$numreg;

        Excel::create('Facturas por radicar', function($excel) use ($listfac,$rango) {
 
            $excel->sheet('Facturas', function($sheet) use ($listfac,$rango) {
 
                //$products = Product::all();
 
                $sheet->fromArray($listfac);

                // Set black background
                $sheet->row(1, function($row) {

                 // call cell manipulation methods
                        $row->setBackground('#45A9E3');

                });

                // Set border for range
                $sheet->setBorder($rango, 'thin');

                $sheet->setAutoFilter();
 
            });
        })->export('xls');
    }

    /**
     * muestra la previsualización de la factura.
     *
     * @return Response
     */
    public function preview(Request $request)
    {
        if($request->ajax()){
            $idserv = $request->get('idserv');
            $cant = $request->get('cantidad');
            $valuni = $request->get('valuni');
            $i=0;
             TmpFact::where('id', '>','0')
                      ->delete();

            while($i < count($idserv))
            {
             $tmp = new TmpFact([
                'idserv'  => $idserv[$i],
                'cantserv'=> $cant[$i],
                'valserv' => $valuni[$i],
                ]);
             $i++;
             $tmp->save();
            }
            
            //return View('config.viewconfig');
           /*return response()->json([
             "mensaje" =>  $request->all() 
            ]);*/
            //$result[0] = array('value' => 'consulta salud', 'id' => '18');
            //return response()->json($result);
          return response()->json(["mensaje" => "listo"]);
        }
    }

     /**
     * muestra listado de facturas según criterio de búsqueda.
     *
     * @return Response
     */
    public function queryFact(Request $request)
    {
            $factura = $request->get('numfac');
            $fecini = $request->get('fecini');
            $fecfin = $request->get('fecfin');
            $ident = $request->get('ident');
            $estado = $request->get('estado');

            $raw = "";

            $filtro[0] = "";
            $campo[0] = "";
            if(($fecini!="")&&($fecfin!=""))
                $fecha = 2;
            if(($fecini!="")&&($fecfin==""))
                $fecha = 1;
            if(($fecini=="")&&($fecfin==""))
                $fecha = 0;
            if($factura!="")
                $fact = 1;
            else
                $fact = 0;
            if($fact == 1)
                $raw = "factura_cab.numfac = ".$factura;

            if($ident!=0)
                $entidad = 1;
            else
                $entidad = 0;
            $i=0;
            if($fact==1){
                $campo[$i]="factura_cab.numfac";
                $filtro[$i]= $factura;
                $i++;
            }
            if($fecha==1){
                $campo[$i]="fecfac";
                $filtro[$i]= $fecha;
                $i++;
            }
            if($entidad==1){
                if($raw != "")
                    $raw.=" and ";
                $raw.=" factura_cab.cod_ent = ".$ident;
                $campo[$i]="factura_cab.cod_ent";
                $filtro[$i]= $ident;
                $i++;
            }
            if($estado!=4)
            {
                if($raw != "")
                    $raw.=" and ";
                $raw.="estfac = ".$estado;
            }
            if($fecha==2)
                $fecfac = $fecha[0];
            
            if(($estado!=4)&&($fecha==2)){
                $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->whereBetween('fecfac',[$fecini,$fecfin])
                           ->whereRaw($raw)
                           ->groupBy('factura_cab.numfac','fecfac','cod_ent')
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
            }
            if(($estado!=4)&&($fecha==1)){

                $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->where('fecfac',$fecini)
                           ->whereRaw($raw)
                           ->groupBy('factura_cab.numfac','fecfac','cod_ent')
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->get();
            }

            if(($estado!=4)&&($fecha==0)){

                $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->whereRaw($raw)
                           ->groupBy('factura_cab.numfac','fecfac','cod_ent')
                           ->orderBy('factura_cab.numfac', 'desc')
                           ->take(20)
                           ->get();
            }

            if(($fact==1)&&($fecha==2)&&($entidad==1)&&($estado==4)){
            $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->where('numfac',$factura)
                           ->whereBetween('fecfac',[$fecini,$fecfin])
                           ->where('factura_cab.cod_ent',$ident)
                           ->groupBy('numfac','fecfac','cod_ent')
                           ->orderBy('numfac', 'desc')
                           ->get();
            }
            if(($fact==1)&&($fecha==2)&&($entidad==0)&&($estado==4)){
            $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->where('numfac',$factura)
                           ->whereBetween('fecfac',[$fecini,$fecfin])
                           ->groupBy('numfac','fecfac','cod_ent')
                           ->orderBy('numfac', 'desc')
                           ->get();
            }
            if(($fact==0)&&($fecha==2)&&($entidad==1)&&($estado==4)){
            $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->whereBetween('fecfac',[$fecini,$fecfin])
                           ->where('entidades.COD_ENT',$ident)
                           ->groupBy('numfac','fecfac','cod_ent')
                           ->orderBy('numfac', 'desc')
                           ->get();
            }
            if(($fact==0)&&($fecha==2)&&($entidad==0)&&($estado==4)){
            $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->whereBetween('fecfac',[$fecini,$fecfin])
                           //->whereBetween('fecfac',['2015-11-24','2015-12-10'])
                           ->groupBy('factura_cab.numfac','fecfac','factura_cab.cod_ent')
                           ->orderBy('numfac', 'desc')
                           ->paginate(5);
                           $listfac->setPath('imp/pag');
            }
            if(($fact==1)&&($fecha==1)&&($entidad==1)&&($estado==4)){
            $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->where('numfac',$factura)
                           ->where('fecfac',$fecini)
                           ->where('factura_cab.cod_ent',$ident)
                           ->groupBy('numfac','fecfac','cod_ent')
                           ->orderBy('numfac', 'desc')
                           ->get();
            }
            if((($fact==1)&&($fecha==1)&&($entidad==0))||(($fact==0)&&($fecha==1)&&($entidad==1))||(($fact==1)&&($fecha==0)&&($entidad==1))&&($estado==4)){
            $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->where($filtro[0])
                           ->where($filtro[1])
                           ->groupBy('numfac','fecfac','cod_ent')
                           ->orderBy('numfac', 'desc')
                           ->get();
            }
            if(($fact==1)&&($fecha==0)&&($entidad==0)||($fact==0)&&($fecha==1)&&($entidad==0)||($fact==0)&&($fecha==0)&&($entidad==1)){
            $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->where($campo[0],$filtro[0])
                           ->groupBy('numfac','fecfac','cod_ent')
                           ->orderBy('numfac', 'desc')
                           ->get();
            }
            

            return view('liq.viewimp', compact('listfac'));

    }


    
    /**
     * consulta una factura que este anulada para refacturar
     *
     * @param  Request  $request
     * @return Response
     */
    public function refact($numfac)
    {
        $info = FacturaCab::join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                            ->select('numfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT')
                            ->where('numfac',$numfac)->first();
      return view('liq.viewliq', compact('info'));                    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            //dd(Auth::user());
            
            $fecha = $request->get('fecha');
            $ident = $request->get('ident');
            $idserv = $request->get('idserv');
            $cant = $request->get('cantidad');
            $valuni = $request->get('valuni');
            
            $resol = Resolucion:: select('act_consec') 
                               ->where('estado',true)
                               ->first();
            $numfac = $resol->act_consec;
            //$result = array('numfac' => $numfac, 'fecha' => $fecha);
            DB::transaction(function () use ($numfac, $fecha,$ident,$idserv,$cant,$valuni) {
            $cab = new FacturaCab([
                    'numfac' => $numfac,
                    'fecfac' => $fecha,
                    'cod_ent'=> $ident,
                    'estfac' => '1',
                    'usufac' => Auth::user()->id
                    ]);
            $cab->save();
            $i=0;
             while($i < count($idserv))
            {
                $det = new FacturaDet([
                'numfac'  => $numfac,
                'idserv'  => $idserv[$i],
                'cantserv'=> $cant[$i],
                'valserv' => $valuni[$i],
                ]);
                $i++;
                $det->save();
            }

            Resolucion::where('estado', true)
                    ->update(['act_consec' => $numfac+1]);
               
                });

            return response()->json(["numfac" => $numfac]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id,$fecha)
    {
        $config = Configuracion:: where('estado','1')
                            ->first();
        $entidad = Entidad::where('COD_ENT',$id)
                            ->first();
        //$dv = EntityController::calcularDV($id);
        $obj =  new EntityController();
        $dv = $obj->calcularDV($id);
        $date = Carbon::createFromFormat('Y-m-d',$fecha);
        $fecven = Carbon::createFromFormat('Y-m-d',$fecha);
        $fecven = $fecven->addDays(30);
        $date = $date->format('d-m-Y');
        $fecven = $fecven->format('d-m-Y');
         $view = View('pdf.pdfconfig',[
        'id'=> $id,
        'nom_factura' => $config->nom_factura,
        'logotipo' => $config->logotipo,
        'nit_factura' => $config->nit_factura,
        'tip_factura' => $config->tip_factura,
        'dir_factura' => $config->dir_factura,
        'tel_factura' => $config->tel_factura,
        'mailfactura' => $config->mailfactura,
        'web_factura' => $config->web_factura,
        'nota_factura'=> $config->nota_factura,
        'fec_exp'     => $date,
        'fec_ven'     => $fecven,
        'nom_ent'     => $entidad->NOM_ENT,
        'nit_ent'     => $id,
        'dv'          => $dv,
        'dir_ent'     => $entidad->DIR_ENT,
        'tel_ent'     => $entidad->TEL_ENT
        ]);
         $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('previa.pdf');
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function pdfshow($numfac)
    {
        
        //consultar id y fecha    
        $factura = FacturaCab::select('cod_ent','fecfac','estfac')
                             ->where('numfac',$numfac)
                             ->first();
        $id = $factura->cod_ent;
        $fecha = $factura->fecfac;
        $config = Configuracion:: where('estado','1')
                            ->first();
        $entidad = Entidad::where('COD_ENT',$id)
                            ->first();
        //$dv = EntityController::calcularDV($id);
        $obj =  new EntityController();
        $dv = $obj->calcularDV($id);
        $date = Carbon::createFromFormat('Y-m-d',$fecha);
        $fecven = Carbon::createFromFormat('Y-m-d',$fecha);
        $fecven = $fecven->addDays(30);
        $date = $date->format('d-m-Y');
        $fecven = $fecven->format('d-m-Y');
         $view = View('pdf.pdfconfig',[
        'id'=> $id,
        'nom_factura' => $config->nom_factura,
        'logotipo' => $config->logotipo,
        'nit_factura' => $config->nit_factura,
        'tip_factura' => $config->tip_factura,
        'dir_factura' => $config->dir_factura,
        'tel_factura' => $config->tel_factura,
        'mailfactura' => $config->mailfactura,
        'web_factura' => $config->web_factura,
        'nota_factura'=> $config->nota_factura,
        'fec_exp'     => $date,
        'fec_ven'     => $fecven,
        'nom_ent'     => $entidad->NOM_ENT,
        'nit_ent'     => $id,
        'dv'          => $dv,
        'dir_ent'     => $entidad->DIR_ENT,
        'tel_ent'     => $entidad->TEL_ENT,
        'numfac'      => $numfac,
        'estfac'      => $factura->estfac
        ]);
         $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream($numfac.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function listtmp()
    {
       $detser =  TmpFact::join('servicios', 'servicios.COD_SER', '=', 'tmpfact.idserv')
                ->select('cantserv','NOM_SER', 'valserv' )
                ->get();

        return $detser; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function listser($numfac)
    {
       $detser =  FacturaDet::join('servicios', 'servicios.COD_SER', '=', 'factura_det.idserv')
                ->select('idserv','cantserv','NOM_SER', 'valserv' )
                ->where('numfac',$numfac)
                ->get();

        return $detser; 
    }


    /**
     * Muestra las 5 ultimas facturas liquidadas
     *
     * @param  int  $id
     * @return Response
     */
    public function toplist()
    {
       $listfac = FacturaCab::join('factura_det', 'factura_cab.numfac', '=', 'factura_det.numfac')
                           ->join('entidades','entidades.COD_ENT','=','factura_cab.cod_ent')
                           ->select('factura_cab.numfac as numfac','fecfac', 'factura_cab.cod_ent as COD_ENT','NOM_ENT', 'estfac',DB::raw('sum(cantserv*valserv) as total'))
                           ->groupBy('numfac','fecfac','cod_ent')
                           ->orderBy('numfac', 'desc')
                           ->take(10)
                           ->get();

        return $listfac; 
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        //
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