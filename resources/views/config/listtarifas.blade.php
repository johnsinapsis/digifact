<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($tar))
                  <h3 class="box-title">Resultado de la búsqueda</h3>
                  @else
                  <h3 class="box-title">Listado de Tarifas</h3>
                  @inject('tarif','App\Http\Controllers\TarifaController')   
                     
                  @endif
                  <div class="box-tools pull-right">
                    @if(isset($tar))
                    {!!$tar->render()!!}
                    @else
                    {!!$tarif->index()->render()!!}
                    @endif
                  </div>
                </div><!-- /.box-header -->
                <br>
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($tar))
                      @foreach ($tar as $tar)
                       <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$tar->NOM_ENT}}</strong>. <strong>{{$tar->NOM_SER}}</strong>. Valor:  {{$tar->VAL_SER}}.  </span>
                      <!-- Emphasis label -->
                     
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="javascript:delete_tarifa('{{$tar->COD_ENT}}','{{$tar->COD_SER}}')"><i class="fa fa-trash"></i></a>
                        
                      </div>
                    </li>
                     
                     @endforeach 
                     @else
                     
                     @foreach ($tarif->index() as $tar)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$tar->NOM_ENT}}</strong>. <strong>{{$tar->NOM_SER}}</strong>. Valor:  {{$tar->VAL_SER}}.  </span>
                      <!-- Emphasis label -->
                    
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                       
                        
                        <a href="javascript:delete_tarifa('{{$tar->COD_ENT}}','{{$tar->COD_SER}}')"><i class="fa fa-trash"></i></a>
                        
                        
                      </div>
                    </li>
                    @endforeach  
                    @endif    
                  </ul>
                </div><!-- /.box-body -->
                
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->