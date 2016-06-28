<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Previa</title>
    {!! Html::style('dist/css/pdfFact.css') !!}

</head>
<body>
  <div class="marcagua"></div>

  <div>
    {!! Html::image('imagenes/membrete.png', "User image", array('class' => 'marcborde')) !!}
</div> 
<div class="clearfix">

   {!! Html::image('imagenes/'.$logotipo, "User image", array('class' => 'logo')) !!}

   <div class="numfact">
       <h4 align="center">
           DOCUMENTO EQUIVALENTE <br>
           <strong>FACTURA DE VENTA</strong>
       </h4>
   </div>
   <div class="divnum">
      @inject('resolucion','App\Http\Controllers\ResulController')
      @if (isset($numfac))
      <h3 style="margin-top:6px;" align="center">Nº&#32;&#32;&#32;{{$resolucion->resActiva($resol)->prefijo}} {{$numfac}}</h3>
      @else
      <h3 style="margin-top:6px;" align="center">Nº&#32;&#32;&#32;{{$resolucion->resActiva($resol)->prefijo}} XXXX</h3>
      @endif
  </div>
  <div class="cabfact">
   <table class="fecha">
       <tr><td colspan="3" class="titfec" align="center"><strong>FECHA DE EXPEDICION</strong></td></tr>
       <tr>
           @if (isset($fec_exp))
           <td WIDTH="25">{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_exp)->format('d')}}</td>
           <td WIDTH="25">{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_exp)->format('m')}}</td>
           <td WIDTH="35" >{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_exp)->format('Y')}}</td>
           @else
           <td WIDTH="25">DD</td>
           <td WIDTH="25">MM</td>
           <td WIDTH="35">AA</td>
           @endif
       </tr>
   </table>
   <table class="fecven">
       <tr><td colspan="3" class="titfec" align="center"><strong>FECHA DE VENCIMIENTO</strong></td></tr>
       <tr>
           @if (isset($fec_ven))
           <td WIDTH="25">{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_ven)->format('d')}}</td>
           <td WIDTH="25">{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_ven)->format('m')}}</td>
           <td WIDTH="35" >{{Carbon\Carbon::createFromFormat('d-m-Y',$fec_ven)->format('Y')}}</td>
           @else
           <td WIDTH="25">DD</td>
           <td WIDTH="25">MM</td>
           <td WIDTH="35" >AA</td>
           @endif
       </tr>
   </table>
   <div class="resol">
       AUTORIZA RESOL. DIAN <br>

       IBAGUÉ No. {{$resolucion->resActiva($resol)->num_resol}} <br>
       FECHA: {{Carbon\Carbon::createFromFormat('Y-m-d',$resolucion->resActiva($resol)->fec_resol)->format('Y/m/d')}}
       DEL No. {{$resolucion->resActiva($resol)->ini_consec}} AL No. {{$resolucion->resActiva($resol)->fin_consec}} <br>
   </div>

   <div class="cliente">Cliente:</div>
   @if (isset($nom_ent))
   <div class="nomcli">{{$nom_ent}}</div>
   @else
   <div class="nomcli"></div>
   @endif
   <div class="nit">Nit:</div>
   @if (isset($nit_ent))
   <div class="nomnit">{{$nit_ent."-".$dv}}</div>
   @else
   <div class="nomnit"></div>
   @endif
   <div class="dir">Dirección:</div>
   @if (isset($dir_ent))
   <div class="nomdir">{{$dir_ent}}</div>
   @else
   <div class="nomdir"></div>
   @endif
   <div class="tel">Tel.:</div>
   @if (isset($tel_ent))
   <div class="nomtel">{{$tel_ent}}</div>
   @else
   <div class="nomtel"></div>
   @endif
   <div class="pag">Forma de Pago:</div>
   <div class="nompag"></div>
</div>

@if($resolucion->resActiva($resol)->tipo_fac=='SERVICIO')
<div class="detfact2">
  @else
  <div class="detfact">
      @endif
      @if($resolucion->resActiva($resol)->tipo_fac=='SERVICIO')
      <table class="detalle">
          <tr>
           <td width="50" align="center" class="titdet"><strong>CANTIDAD</strong></td> 
           <td width="250" align="center" class="titdet"><strong>DESCRIPCIÓN DEL SERVICIO</strong></td> 
           <td width="90" align="center" class="titdet"><strong>V/R. UNITARIO</strong></td> 
           <td width="90" align="center" class="titdet"><strong>VALOR TOTAL</strong></td>
       </tr>
       <tr>
          <td style="height:516px; "></td> <td ></td> <td></td> <td></td>
      </tr>
  </table>
  @else
  <table class="detalle">
      <tr>
       <td width="40" align="center" class="titdet" rowspan="2"><strong>COD</strong></td> 
       <td width="150" align="center" class="titdet" rowspan="2"><strong>PRODUCTO</strong></td>
       <td width="30" align="center" class="titdet" rowspan="2"><strong>CANT.</strong></td>  
       <td width="70" align="center" class="titdet" rowspan="2"><strong>V/R. UNIT.</strong></td> 
       <td width="80" align="center" class="titdet" colspan="2"><strong>IVA</strong></td>

       <td width="90" align="center" class="titdet" rowspan="2"><strong>VALOR TOTAL</strong></td>
   </tr>
   <tr>

      <td width="20" class="titdet" align="center">%</td>
      <td class="titdet" align="center">Valor</td>


  </tr>
  <tr>
      <td style="height:490px;"></td> <td ></td> <td></td> <td></td><td></td><td></td>
      <td></td>
  </tr>
</table>
@endif
@if($resolucion->resActiva($resol)->tipo_fac=='SERVICIO')
<table class="detaserv" border="0";>
  {{--*/ $tot = 0 /*--}}
  {{--*/ $iva = 0 /*--}}
  @if (isset($tel_ent))
  @inject('detser','App\Http\Controllers\FactController')

  @if(isset($numfac))
  @foreach ($detser->listpro($numfac,$resol,$nit_ent) as $detalle)
  <tr>
     <td align="center" width="49">{{$detalle->cantprod}}</td>
     <td align="left" width="230">{{$detalle->NOM_PRO}}</td>
     <td align="right" width="85">{{number_format($detalle->valprod,2)}}</td>
     <td align="right" width="85">{{number_format($detalle->valprod * $detalle->cantprod,2)}}</td>
 </tr>
 {{--*/ $tot = $tot + ($detalle->valprod * $detalle->cantprod) /*--}}
 {{--*/ $iva = $iva + ($detalle->valiva) /*--}}
 @endforeach
 @else
 @foreach ($detser->listtmp($nit_ent) as $detalle)
 <tr>
  <td align="right" width="49">{{$detalle->cantprod}}</td>
  <td align="left" width="230">{{$detalle->NOM_PRO}}</td>
  <td align="right" width="85">{{number_format($detalle->valprod,2)}}</td>
  <td align="right" width="85">{{number_format($detalle->valprod * $detalle->cantprod,2)}}</td>
</tr>
{{--*/ $tot = $tot + ($detalle->valprod * $detalle->cantprod) /*--}}
{{--*/ $iva = $iva + ($detalle->valiva) /*--}}
@endforeach
@endif
@endif
</table>
@else
<table class="detaprod" border="0";>
  {{--*/ $tot = 0 /*--}}
  {{--*/ $iva = 0 /*--}}
  @if (isset($tel_ent))
  @inject('detprod','App\Http\Controllers\FactController')

  @if(isset($numfac))
  @foreach ($detprod->listpro($numfac,$resol,$nit_ent) as $detalle)
  <tr>
      <td align="center" width="35">{{$detalle->ABBR}}</td>
      <td align="left" width="120">&nbsp;{{$detalle->NOM_PRO}}</td>
      <td align="center" width="30">{{$detalle->cantprod}}</td>
      <td align="right" width="58">{{number_format($detalle->valprod,0)}}&nbsp;&nbsp;</td>
      <td align="center" width="30">{{$detalle->VAL_IVA}}</td>
      <td align="right" width="30">{{number_format($detalle->valiva,0)}}</td>
      <td align="right" width="75">{{number_format($detalle->valprod * $detalle->cantprod,0)}}&nbsp;</td>
  </tr>
  {{--*/ $tot = $tot + ($detalle->valprod * $detalle->cantprod) /*--}}
  {{--*/ $iva = $iva + ($detalle->valiva) /*--}}
  @endforeach
  @else
  @foreach ($detprod->listtmp($nit_ent) as $detalle)
  <tr>
      <td align="right" width="35">{{$detalle->ABBR}}</td>
      <td align="left" width="120">{{$detalle->NOM_PRO}}</td>
      <td align="right" width="30">{{$detalle->cantprod}}</td>
      <td align="right" width="60">{{number_format($detalle->valprod,2)}}</td>
      <td align="right" width="30">{{$detalle->VAL_IVA}}</td>
      <td align="right" width="35">{{number_format($detalle->valiva,2)}}</td>
      <td align="right" width="75">{{number_format($detalle->valprod * $detalle->cantprod,2)}}</td>
  </tr>
  {{--*/ $tot = $tot + ($detalle->valprod * $detalle->cantprod) /*--}}
  {{--*/ $iva = $iva + ($detalle->valiva) /*--}}
  @endforeach
  @endif
  @endif
</table>
@endif

</div>

<div class="titsub" ><h3 align="center"><strong>SUBTOTAL</strong></h3></div>
<div class="titiva" ><h3 align="center"><strong>IVA</strong></h3></div>

<div class="tittot" style="page-break-after: avoid;"><h3 align="center"><strong>TOTAL</strong></h3></div>
@if(($resolucion->resActiva($resol)->tipo_fac=='PRODUCTO')||($resolucion->resActiva($resol)->tipo_fac=='SERVICIO'))
<div class="valsub">
  <table>
      <tr>
          <td><h3>$</h3></td>
          <td><div class="divsub"><span class="valtotal">{{number_format($tot,2)}}</span></div></td>
      </tr>
  </table>
</div>

<div class="valiva">
  <table>
      <tr>
          <td><h3>$</h3></td>
          <td><div class="diviva"><span class="valtotal">{{number_format($iva,2)}}</span></div></td>
      </tr>
  </table>
</div>
@else
@inject('factiva','App\Http\Controllers\IvaController')
{{--*/ $factor = $factiva->show()->valiva/100 /*--}}
{{--*/ $iva = $tot * $factor /*--}}
<div class="valsub">
  <table>
      <tr>
          <td><h3>$</h3></td>
          <td><div class="divsub"><span class="valtotal">{{number_format($tot,2)}}</span></div></td>
      </tr>
  </table>
</div>

<div class="valiva">
  <table>
      <tr>
          <td><h3>$</h3></td>
          <td><div class="diviva"><span class="valtotal">{{number_format($iva,2)}}</span></div></td>
      </tr>
  </table>
</div>
@endif
<div class="valtot">
  <table>
      <tr>
          <td><h3>$</h3></td>
          <td>
            <div class="divtot">
                <span class="valtotal">{{number_format($tot+$iva,2)}}</span>
            </div>
        </td>
    </tr>
</table>
</div>

</div>
@if (isset($numfac))
@if($estfac==0)
<div class="anu">
 {!! Html::image("imagenes/anulada.png", "Fact Anulada", array('class' => 'anu')) !!}
</div>
@endif
@endif
<div class="notafact">NOTA: {{$nota_factura}}</div>
<div class="nomrad">
 <table width="350">
     <tr>
         <td class="titnom">Nombre:</td>
         <td width="310"><div class="divnomrad"></div></td>
     </tr>
 </table>
</div>
<div class="fecrad">
 <table width="350">
     <tr>
         <td width="57"class="titnom">Fecha recibido:</td>
         <td width="350"><div class="divfecrad"></div></td>
     </tr>
 </table>
</div>
<div class="apprad">
 <table width="350">
     <tr>
         <td width="30"class="titnom">Aceptado:</td>
         <td width="300"><div class="divapprad"></div></td>
     </tr>
 </table>
</div>
<div class="sello">EQUIPOS DIGITALES HC S.A.S..</div> 
<footer>        
   <strong>Este documento se asimila para todos sus efectos legales a una letra de cambio (Art. 774 y sgtes., del C.de Cio.) y causará intereses por mora al maximo permitido por la ley.</strong> <br>
   Aceptada esta factura de venta el Comprador declara haber recibido real y materialmente las mercancias y/o servicios facturados. Esta factura es un titulo valor y no se aceptan reclamos ni devoluciones después de 10 días de aceptada (ley 1231 de julio 17 de 2008). La firma de una persona distinta al comprador implica que está autorizada tácita y expresamente por el mismo para firmar en su nombre y el comprador asi lo acepta y se hace responsable de la deuda contraída por la presente.
</footer> 
</body>

</html>