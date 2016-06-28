@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
              @if(isset($entidad_nit))
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => ['upent',$entidad_nit]]) !!}
              @else
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'entidad']) !!}
              @endif
                <div class="box-header">
                  <i class="fa fa-cogs"></i>
                  <h3 class="box-title">Parámetros Básicos</h3>
                  @if(isset($entidad_nit))
                  {{--*/ $noment = $entidad_nom /*--}}
                  {{--*/ $codent = $entidad_nit /*--}}
                  {{--*/ $estent = $entidad_est /*--}}
                  {{--*/ $dirent = $entidad_dir /*--}}
                  {{--*/ $telent = $entidad_tel /*--}}
                  {{--*/ $celent = $entidad_cel /*--}}
                  {{--*/ $conent = $entidad_con /*--}}
                  {{--*/ $vencim = $entidad_ven /*--}}
                  {{--*/ $paisent= $entidad_pai /*--}}
                  {{--*/ $dptoent= $entidad_dep /*--}}
                  {{--*/ $ciuent = $entidad_ciu /*--}}
                  @else
                  {{--*/ $noment = old('noment') /*--}}
                  {{--*/ $codent = old('nit') /*--}}
                  {{--*/ $estent = 1 /*--}}
                  {{--*/ $dirent = old('dirent') /*--}}
                  {{--*/ $telent = old('telent') /*--}}
                  {{--*/ $celent = old('celent') /*--}}
                  {{--*/ $conent = old('conent') /*--}}
                  {{--*/ $vencim = old('vencim') /*--}}
                  {{--*/ $paisent= 0  /*--}}
                  {{--*/ $dptoent= 0  /*--}}
                  {{--*/ $ciuent = 0 /*--}}
                  @endif
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logodeco.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <span class="name">
                        Registro de Clientes
                      </span>
                      
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                           
                           <div class="form-group">
                                <label class="col-md-4 control-label">Nombre del Cliente:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="noment" type="text" style="width:320px;" class="form-control input-sm" name="noment"   value="{{$noment}}" >
                                </div>
                                 
                            </div>


                           <div class="form-group">
                                <label class="col-md-4 control-label">Estado:</label>
                                <div class="input-group input-group-sm">                                 
                                  <select name="estado" id="estado" class="form-control">
                                    @if($estent)
                                    <option value="0">Inactivo</option>
                                    <option value="1" selected>Activo</option>
                                    @else
                                    <option value="0" selected>Inactivo</option>
                                    <option value="1">Activo</option>
                                    @endif
                                  </select>   
                                </div>
                                 
                            </div> 

                            <div class="form-group">
                                <label class="col-md-4 control-label">Identificación:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="nit" type="number"  class="form-control input-sm" name="nit" value="{{$codent}}" >               
                                    
                                </div>
                                 
                            </div> 

                             <div class="form-group" style="padding-left: 0%; ">
                                  <label class="col-md-2 control-label" style="text-align: center; ">Ubicación:</label>
                                  @inject('ubi','App\Http\Controllers\UbiController')
                                  <div class="col-md-3"> 
                                    <select id="pais" name="pais" class="form-control"  onchange="cargarSelect('pais','depto','1',''); " >
                                         @if($paisent==0)
                                          <option value="0" selected>pais</option>
                                             @else
                                                <option value="0">pais</option>
                                         @endif
                                        @foreach ($ubi->list_pais() as $pais) 
                                            @if($pais->id==$paisent)
                                            <option value="{{$pais->id}}" selected>{{$pais->pai_nombre}}</option>
                                            @else
                                            <option value="{{$pais->id}}">{{$pais->pai_nombre}}</option>
                                            @endif
   
                                        @endforeach
                                      </select>
                                  </div>
                                  <div class="col-md-3"> 
                                    <select id="depto" name="depto" class="form-control" onchange="cargarSelect('depto','ciudad','2','');">
                                      @if($dptoent==0)
                                      <option value="0">Depto</option>
                                      @else
                                      @foreach($ubi->listdepto($emple_pais) as $depto)
                                      @if($depto->dep_codigo == $dptoent)
                                      <option value="{{$depto->dep_codigo}}" selected>{{$depto->dep_nombre}}</option>
                                      @else
                                      <option value="{{$depto->dep_codigo}}" >{{$depto->dep_nombre}}</option>
                                      @endif
                                      @endforeach
                                      @endif
                                    </select>
                                  </div>
                                  <div class="col-md-3"> 
                                    <select id="ciudad" name="ciudad" class="form-control">
                                      @if($ciuent==0)
                                      <option value="0">Ciudad</option>
                                      @else
                                      @foreach($ubi->listciudad(dptoent) as $ciudad)
                                      @if($ciudad->cod_ciudad == $ciuent)
                                      <option value="{{$ciudad->cod_ciudad}}" selected>{{$ciudad->nom_ciudad}}</option>
                                      @else
                                      <option value="{{$ciudad->cod_ciudad}}">{{$ciudad->nom_ciudad}}</option>
                                      @endif
                                      @endforeach
                                      @endif
                                    </select>
                                  </div>
                                </div>  

                            <div class="form-group">
                                <label class="col-md-4 control-label">Dirección:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="dirent" type="text" style="width:320px;" class="form-control input-sm" name="dirent" value="{{$dirent}}" >               
                                    
                                </div>
                                 
                            </div>  

                            <div class="form-group">
                                <label class="col-md-4 control-label">Teléfono:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="telent" type="text"  class="form-control input-sm" name="telent" value="{{$telent}}" >               
                                    
                                </div>
                                 
                            </div>    

                            <div class="form-group">
                                <label class="col-md-4 control-label">Celular:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="celent" type="number"  class="form-control input-sm" name="celent" value="{{$telent}}" >               
                                    
                                </div>
                                 
                            </div>   

                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre del Contacto:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="conent" type="text" style="width:320px;"  class="form-control input-sm" name="conent" value="{{$conent}}" >               
                                    
                                </div>
                                 
                            </div>  

                            <div class="form-group">
                                <label class="col-md-4 control-label">Vencimiento Factura:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="vencim" type="number" style="width:70px;" class="form-control input-sm" name="vencim" value="{{$vencim}}" > <label class="col-md-1 control-label" style="padding-left:3px;">Días:</label>              
                                    
                                </div>
                                 
                            </div> 

                                     
                      </div>
                        
                    </div><!-- /.attachment -->
                  </div><!-- /.item -->
                  <!-- chat item -->
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="input-group-btn" align="right">
                  <button  type="submit" class="btn btn-primary btn-flat">Guardar</button>
                </div>
              </div>
               {!! Form::close() !!}
              </div><!-- /.box (chat box) -->

          @include('config/listentidad')

              </section>
          <!-- Fin del componente -->
          {{--*/ $ent = 1 /*--}}
          @include('config/browseprod')
@endsection



