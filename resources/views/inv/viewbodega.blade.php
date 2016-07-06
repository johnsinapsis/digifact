@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
              @if(isset($producto_id))
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => ['upprod',$producto_id]]) !!}
              @else
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'producto']) !!}
              @endif
                <div class="box-header">
                  <i class="fa fa-cogs"></i>
                  <h3 class="box-title">Parámetros Básicos</h3>
                  @if(isset($producto_id))
                  {{--*/ $nomprod = $producto_nom /*--}}
                  {{--*/ $codprod = $producto_id /*--}}
                  {{--*/ $estprod = $producto_est /*--}}
                  {{--*/ $abrprod = $producto_abr /*--}}
                  {{--*/ $tipoprod = $producto_tip /*--}}
                  {{--*/ $uniprod = $producto_uni /*--}}
                  {{--*/ $minprod = $producto_min /*--}}
                  {{--*/ $maxprod = $producto_max /*--}}
                  @else
                  {{--*/ $nomprod = "" /*--}}
                  {{--*/ $codprod = "" /*--}}
                  {{--*/ $estprod = 1 /*--}}
                  {{--*/ $abrprod = "" /*--}}
                  {{--*/ $tipoprod = 1 /*--}}
                  {{--*/ $uniprod = 1 /*--}}
                  {{--*/ $minprod = "" /*--}}
                  {{--*/ $maxprod = "" /*--}}
                  @endif
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logodeco.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <span class="name">
                        Registro de Productos
                      </span>
                      
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                           
                           <div class="form-group">
                                <label class="col-md-4 control-label">Código:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="abrprod" type="text" style="width:70px;" class="form-control input-sm" name="abrprod"   value="{{$abrprod}}" >               
                                    
                                </div>
                                 
                            </div>    


                           <div class="form-group">
                                <label class="col-md-4 control-label">Nombre del Producto:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="nomprod" type="text" class="form-control input-sm" name="nomprod"   value="{{$nomprod}}" >
                                </div>
                                 
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Estado:</label>
                                <div class="input-group input-group-sm">                                 
                                  <select name="estado" id="estado" class="form-control">
                                    @if($estprod)
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
                                <label class="col-md-4 control-label">Tipo de Producto:</label>
                                <div class="input-group input-group-sm">                                 
                                  <select name="tipo" id="tipo" class="form-control">
                                    @if($tipoprod==1)
                                    <option value="1" selected>Producto Terminado</option>
                                    <option value="2">Insumos</option>
                                    @else
                                    <option value="0">Inactivo</option>
                                    <option value="1" selected>Activo</option>
                                    @endif
                                  </select>   
                                </div>
                                 
                            </div> 

                              {{--*/ $selected = "" /*--}}
                            <div class="form-group">
                                <label class="col-md-4 control-label">Unidad:</label>
                                <div class="input-group input-group-sm"> 
                                   @inject('unidad','App\Http\Controllers\UnimedidaController')                               
                                  <select name="unidad" id="unidad" class="form-control">
                                    @foreach ($unidad->list_medidas() as $uni)
                                      @if($uniprod == $uni->id)
                                      {{--*/ $selected = "selected" /*--}}
                                      @endif
                                      <option value="{{$uni->id}}" {{$selected}}>{{$uni->nombre}}</option>
                                      {{--*/ $selected = "" /*--}}
                                    @endforeach
                                  </select>   
                                </div>
                                 
                            </div> 

                            <div class="form-group">
                                <label class="col-md-4 control-label">Stock Mínimo:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="minimo" type="number" class="form-control input-sm" name="minimo"   value="{{$minprod}}" >
                                </div>
                                 
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Stock Máximo:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="maximo" type="number" class="form-control input-sm" name="maximo"   value="{{$maxprod}}" >
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

          @include('config/listproducto')

              </section>
          <!-- Fin del componente -->
          {{--*/ $prod = 1 /*--}}
          @include('config/browseprod')
@endsection



