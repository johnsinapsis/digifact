  <section class="col-lg-5 connectedSortable">
               <!-- Map box -->
              <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                 
                  <i class="fa fa-television"></i>
                  <h3 class="box-title">
                    @if (isset($prod))
                    Búsqueda rápida de productos
                    @endif
                  </h3>
                </div>
                <div class="box-body">
                  <div  style="height: 250px; width: 100%;">
                     @if (isset($prod))
                    Escriba en el autoompletar y seleccione
                    @endif
                    @if (isset($prod))
                    <div class="jumbotron" style = "height:240px; background-color:gray;" align="center">
                      {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'buscaprod']) !!}
                      <div id="formresol">
                        <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                                
                                <label class="col-md-6 control-label">Nombre del producto:</label>
                                <br><br>
                                <div class="input-group col-md-8">                                 
                                    <input id="producto" type="text" class="form-control input-sm" name="producto"  style="width:230px"/>
                                    <input type="hidden" name="idprod" id="idprod" value="0"> 
                                    
                                </div>
                                <br>
                                <div class="input-group-btn" >
                                <button  type="submit" class="btn btn-primary btn-flat">Buscar</button>
                                </div>
                                 
                            </div> 
                      </div>  
                      {!! Form::close() !!}
                    </div>
                    
                    @endif
                  </div>
                </div><!-- /.box-body-->
                <div class="box-footer no-border bg-light-blue-gradient">
                 
                </div>
              </div>
              <!-- /.box -->
   </section>