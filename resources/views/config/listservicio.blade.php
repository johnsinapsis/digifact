<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($servicio_id))
                  <h3 class="box-title">Resultado de la búsqueda</h3>
                  @else
                  <h3 class="box-title">Listado de servicios</h3>
                  @inject('serv','App\Http\Controllers\ServicioController')   
                     
                  @endif
                  <div class="box-tools pull-right">
                    @if(!isset($servicio_id))
                    {!!$serv->index()->render()!!}
                    @endif
                  </div>
                </div><!-- /.box-header -->
                <br>
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($servicio_id))
                     
                       <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$servicio_nom}}</strong>. Código:  {{$servicio_abr}}.</span>
                      <!-- Emphasis label -->
                     @if($servicio_est)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="{{route('editserv',['id'=>$servicio_id])}}"><i class="fa fa-share"></i></a>
                       
                      </div>
                    </li>
                     
                     
                     @else
                     
                     @foreach ($serv->index() as $serv)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$serv->NOM_SER}}</strong>. Código:  {{$serv->ABBR}}.</span>
                      <!-- Emphasis label -->
                     @if($serv->EST_SER==1)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                       
                        <!-- <a href="{{route('pdffact',['numfac'=>$serv->numfac])}}" target="_blank"><i class="fa fa-television"></i></a> -->
                        
                        <a href="{{route('editserv',['id'=>$serv->COD_SER])}}"><i class="fa fa-share"></i></a>
                        
                        
                      </div>
                    </li>
                    @endforeach  
                    @endif    
                  </ul>
                </div><!-- /.box-body -->
                
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->