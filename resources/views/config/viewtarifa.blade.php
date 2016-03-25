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
              {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'tarifas']) !!}
              @endif
                <div class="box-header">
                  <i class="fa fa-cogs"></i>
                  <h3 class="box-title">Parámetros Básicos</h3>
                 
                </div>
                <div class="box-body chat" id="chat-box" >
                  <!-- chat item -->
                  <div class="item">
                    {!! Html::image('dist/img/logodigi.png', "User image", array('class' => 'online')) !!}
                    <p class="message">
                      <span class="name">
                        Registro de Tarifas
                      </span>
                      
                    </p>
                    <div class="attachment">
                      <div id="formresol">
                        
                          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                           
                           <div class="form-group">
                                <label class="col-md-4 control-label">Cliente:</label>
                                <div class="input-group input-group-sm">                                 
                                    <input id="entidadf" type="text" class="form-control input-sm" name="entidadf"/>
                                    <input type="hidden" name="ident" id="ident" value="0"> 
                                </div>
                                 
                            </div>



                            <div class="form-group">
                                <label class="col-md-4 control-label" style="display:none;" id="labtar">Servicio:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="sertar" type="text"  class="form-control input-sm" name="sertar" style="display:none;" /> 
                                   <input type="hidden" name="idser" id="idser" value="0">              
                                </div>
                                 
                            </div>   

                             

                            <div class="form-group">
                                <label class="col-md-4 control-label" style="display:none;"  id="labval">Valor:</label>
                                <div class="input-group input-group-sm">  
                                   <input id="valser" type="number" style="display:none;"   class="form-control input-sm" name="valser" value="" >               
                                    
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

          @include('config/listtarifas')

              </section>
          <!-- Fin del componente -->
          {{--*/ $tar = 1 /*--}}
          @include('config/browseprod')
          @include('config/copiaprecio')
@endsection



