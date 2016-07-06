@extends('layout')
@section('content')
<!-- Inicio del componente -->
          <section class="col-lg-7 connectedSortable">
            <div class="box box-success">
              @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
              
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'fabrica']) !!}
              
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
                  @else
                  {{--*/ $noment = "" /*--}}
                  {{--*/ $codent = "" /*--}}
                  {{--*/ $estent = 1 /*--}}
                  {{--*/ $dirent = "" /*--}}
                  {{--*/ $telent = "" /*--}}
                  {{--*/ $celent = "" /*--}}
                  {{--*/ $conent = "" /*--}}
                  @endif
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logodeco.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <span class="name">
                        Registro de Insumos requeridos para Fabricación
                      </span>
                      
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                           
                           <div class="form-group">
                                <label class="col-md-4 control-label">Producto:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="productoc" type="text" class="form-control input-sm" name="productoc"/>
                                    <input type="hidden" name="idprodc" id="idprodc" value="0"> 
                                </div>
                                 
                            </div>



                            <div class="form-group">
                                <label class="col-md-4 control-label" style="display:none;" id="labinsu">Insumo:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="prodinsu" type="text"  class="form-control input-sm" name="prodinsu" style="display:none;" /> 
                                   <input type="hidden" name="idinsu" id="idinsu" value="0">              
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

          @include('config/listprodinsumo')

              </section>
          <!-- Fin del componente -->
          {{--*/ $fab = 1 /*--}}
          @include('config/browseprod')
         
@endsection
