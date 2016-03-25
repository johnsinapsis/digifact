  <section class="col-lg-5 connectedSortable">
               <!-- Map box -->
              <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                 
                  <i class="fa fa-television"></i>
                  <h3 class="box-title">
                    @if (isset($pre))
                    Copia de Precios
                    @endif
                    @if (isset($tar))
                    Copia de Tarifas
                    @endif
                   
                  </h3>
                </div>
                <div class="box-body">
                  <div  style="height: 250px; width: 100%;">
                     
                    Escriba en cada autocompletar
                    <!-- formulario para los servicios -->
                    
                    <div class="jumbotron" style = "height:240px; background-color:#9752B0;" align="center">
                      @include('partials/errors')
                      @include('partials/success')
                      @include('partials/msg-ok2')
                      @if (isset($pre))
                      {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'copiaprec']) !!}
                      @endif
                      @if (isset($tar))
                      {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'copiatar']) !!}
                      @endif
                      <div id="formresol">
                        <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                                
                                <label class="col-md-6 control-label">Cliente Origen:</label>
                                
                                <div class="input-group col-md-8">                                 
                                    <input id="entidadd" type="text" class="form-control input-sm" name="entidadd"  style="width:230px"/>
                                    <input type="hidden" name="ident3" id="ident3" value="0"> 
                                    
                                </div>
                                <br>
                                <label class="col-md-6 control-label">Cliente Destino:</label>

                                <div class="input-group col-md-8">                                 
                                    <input id="entidadc" type="text" class="form-control input-sm" name="entidadc"  style="width:230px"/>
                                    <input type="hidden" name="ident2" id="ident2" value="0"> 
                                    
                                </div>
                                <br>
                                <div class="input-group-btn" >
                                <button  type="submit" class="btn btn-primary btn-flat">Copiar</button>
                                </div>
                                 
                            </div> 
                      </div>  
                      {!! Form::close() !!}
                    </div>
                    
                    

                    <!-- fin formulario para los servicios -->

                   

                    

                  </div>
                </div><!-- /.box-body-->
                <div class="box-footer no-border bg-light-blue-gradient">
                 
                </div>
              </div>
              <!-- /.box -->
   </section>