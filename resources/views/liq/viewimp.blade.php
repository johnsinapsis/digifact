@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
           
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'url' => 'imp']) !!}
               <!-- {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'imp']) !!}
                        -->
        
                <div class="box-header">
                  <i class="fa fa-print"></i>
                  <h3 class="box-title">Impresión</h3>
                  
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logodigi.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <a href="#" class="name">
                        Consulta de Facturas
                      </a>
                      
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" id="select" value="0">
                           
                           <div class="form-group">
                               
                                <label class="col-md-4 control-label">Número de Factura:</label>
                                <div class="input-group col-md-8">                                 
                                    <input id="numfac" type="number" class="form-control input-sm" name="numfac"   style="width:130px" />
                                    <label class="col-md-1 control-label" style="margin-left:10px; padding-left:3px;">
                                   <!-- <input id="fact" type="checkbox" onclick="queryfact('1');" class=""  name="fact" >   -->  
                                   </label>
                                   
                                </div>
                               
                            
                                 
                            </div>


                           <div class="form-group">
                            
                                <label class="col-md-4 control-label">Fecha Inicial:</label>
                                <div class="input-group col-md-8">                                 
                                  <input id="fecini" type="date" class="form-control input-sm" name="fecini" min="2015-09-07" max="{{Carbon\Carbon::now()->format('Y-m-d')}}" value=""  style="width:130px;" disabled/> 
                                  <label class="col-md-1 control-label" style="margin-left:10px; padding-left:3px;">
                                <input type="checkbox" name="inifec" onclick="queryfact('2');" id="inifec">
                                 </label>   
                                </div>
                                
                            </div>   

                             <div class="form-group">
                              
                                <label class="col-md-4 control-label">Fecha Final:</label>
                                <div class="input-group col-md-8">                                 
                                  <input id="fecfin" type="date" onfocus="fecmin()" class="form-control input-sm" name="fecfin" min="2015-09-07" max="{{Carbon\Carbon::now()->format('Y-m-d')}}" value="" style="width:130px;" disabled/> 
                                   <label class="col-md-1 control-label" style="margin-left:10px; padding-left:3px;">
                                  <input type="checkbox" name="finfec"  onclick="queryfact('3');" id="finfec"> 
                                  </label>  
                                </div>
                                 
                            </div>    

                            <div class="form-group">
                                
                                <label class="col-md-4 control-label">Entidad:</label>
                                <div class="input-group col-md-8">                                 
                                    <input id="entidad" type="text" class="form-control input-sm" name="entidad"  style="width:230px"/>
                                    <input type="hidden" name="ident" id="ident" value="0"> 
                                    <label class="col-md-1 control-label" style="margin-left:10px; padding-left:3px;">
                                    <!-- <input type="checkbox" name="enti"  onclick="queryfact('4');" id="enti"> -->
                                  </label>
                                </div>
                                 
                            </div>  

                            <div class="form-group">
                                
                               <label class="col-md-4 control-label">Estado:</label>
                                <div class="input-group col-md-8">                                 
                                      <input type="radio" class="" name="estado"  value="4" checked/>Todas 
                                      <input type="radio" class="" name="estado"  value="0"/>Anuladas 
                                      <input type="radio" class="" name="estado"  value="1"/>Facturadas 
                                      <input type="radio" class="" name="estado"  value="2"/>Radicadas 
                                      <input type="radio" class="" name="estado"  value="3"/>Pagadas 
                                     <!--  <label>
                                       <input type="radio" class="form-control" name="estado"  value="0" />
                                     Anuladas
                                     </label>
                                                                         
                                     <label>
                                       <input type="radio" class="form-control" name="estado"  value="1" />
                                     Facturadas
                                     </label> -->
                                   
                                </div>
                                 
                            </div>         
                            
                      </div>
                        
                    </div><!-- /.attachment -->
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="input-group-btn" align="right">
                  <!-- <button  type="submit" class="btn btn-primary btn-flat">Buscar</button> -->
                  
                  <button id="buscaFact" type="submit"  class="btn btn-primary btn-flat" >Buscar</button>
                </div>
              </div>
               {!! Form::close() !!}
              </div><!-- /.box (chat box) -->


              <!-- <div class="box-footer">
                @if(isset($listfac))
                  <table border="1">
                    <tr>
                      <th>Factura</th>
                      <th>Fecha</th>
                    </tr>
                    @foreach($listfac as $listf)
                      <tr>
                        <td>{{ $listf->numfac }}</td>
                        <td>{{ $listf->fecfac }}</td>
                      </tr>
                    @endforeach
                  </table>
                @endif
              </div> -->


              <!--ültimas facturas -->
              @include('liq/listfact')

              </section>
          <!-- Fin del componente -->
          @inject('resolucion','App\Http\Controllers\ResulController')
          @include('resol/actresol')
@endsection



