<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($prec))
                  <h3 class="box-title">Resultado de la búsqueda</h3>
                  @else
                  <h3 class="box-title">Listado de Insumos requeridos para Fabricar Productos</h3>
                  @inject('fabrica','App\Http\Controllers\FabricaController')   
                     
                  @endif
                  <div class="box-tools pull-right">
                       <!-- Temporalmente sin uso-->
                  </div>
                </div><!-- /.box-header -->
                <br>
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($fabri))
                      @foreach ($fabri as $fab)
                       <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$fab->producto}}</strong>. <strong>{{$fab->insumo}}</strong>.  </span>
                      <!-- Emphasis label -->
                     
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="javascript:delete_fabrica('{{$fab->idprod}}','{{$fab->idinsumo}}')"><i class="fa fa-trash"></i></a>
                        
                      </div>
                    </li>
                     
                     @endforeach 
                     @else
                     
                     @foreach ($fabrica->index() as $fabri)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$fabri->producto}}</strong>. <strong>{{$fabri->insumo}}</strong>. </span>
                      <!-- Emphasis label -->
                    
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                       
                        
                        <a href="javascript:delete_fabrica('{{$fabri->idprod}}','{{$fabri->idinsumo}}')"><i class="fa fa-trash"></i></a>
                        
                        
                      </div>
                    </li>
                    @endforeach  
                    @endif    
                  </ul>
                </div><!-- /.box-body -->
                
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->