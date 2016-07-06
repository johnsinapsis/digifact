<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($producto_id))
                  <h3 class="box-title">Resultado de la búsqueda</h3>
                  @else
                  <h3 class="box-title">Listado de productos</h3>
                  @inject('prod','App\Http\Controllers\ProductoController')   
                     
                  @endif
                  <div class="box-tools pull-right">
                    @if(!isset($producto_id))
                    {!!$prod->index()->render()!!}
                    @endif
                  </div>
                </div><!-- /.box-header -->
                <br>
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($producto_id))
                     
                       <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$producto_nom}}</strong>. 
                      ({{$producto_med}})
                      Código:  {{$producto_abr}}.
                      @if($producto_tip==1)
                       Producto Terminado
                       @else
                       Insumos
                       @endif
                      </span>
                      </span>
                      <!-- Emphasis label -->
                     @if($producto_est)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="{{route('editprod',['id'=>$producto_id])}}"><i class="fa fa-share"></i></a>
                       
                      </div>
                    </li>
                     
                     
                     @else
                     
                     @foreach ($prod->index() as $prod)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$prod->NOM_PRO}}</strong>. 
                      ({{$prod->nombre}})
                      Código:  {{$prod->ABBR}}. 
                       @if($prod->TIP_PRO==1)
                       Producto Terminado
                       @else
                       Insumos
                       @endif
                      </span>
                      <!-- Emphasis label -->
                     @if($prod->EST_PRO==1)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                       
                        <!-- <a href="{{route('pdffact',['numfac'=>$prod->numfac])}}" target="_blank"><i class="fa fa-television"></i></a> -->
                        
                        <a href="{{route('editprod',['id'=>$prod->COD_PRO])}}"><i class="fa fa-share"></i></a>
                        
                        
                      </div>
                    </li>
                    @endforeach  
                    @endif    
                  </ul>
                </div><!-- /.box-body -->
                
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->