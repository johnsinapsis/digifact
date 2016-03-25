<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($prec))
                  <h3 class="box-title">Resultado de la búsqueda</h3>
                  @else
                  <h3 class="box-title">Listado de Precios</h3>
                  @inject('pre','App\Http\Controllers\PrecioController')   
                     
                  @endif
                  <div class="box-tools pull-right">
                    @if(isset($prec))
                    {!!$prec->render()!!}
                    @else
                    {!!$pre->index()->render()!!}
                    @endif
                  </div>
                </div><!-- /.box-header -->
                <br>
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($prec))
                      @foreach ($prec as $pre)
                       <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$pre->NOM_ENT}}</strong>. <strong>{{$pre->NOM_PRO}}</strong>. Valor:  {{$pre->VAL_PRO}}. IVA: {{$pre->VAL_IVA}}%. </span>
                      <!-- Emphasis label -->
                     
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="javascript:delete_precio('{{$pre->COD_ENT}}','{{$pre->COD_PRO}}')"><i class="fa fa-trash"></i></a>
                        
                      </div>
                    </li>
                     
                     @endforeach 
                     @else
                     
                     @foreach ($pre->index() as $pre)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$pre->NOM_ENT}}</strong>. <strong>{{$pre->NOM_PRO}}</strong>. Valor:  {{$pre->VAL_PRO}}. IVA: {{$pre->VAL_IVA}}%. </span>
                      <!-- Emphasis label -->
                    
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                       
                        
                        <a href="javascript:delete_precio('{{$pre->COD_ENT}}','{{$pre->COD_PRO}}')"><i class="fa fa-trash"></i></a>
                        
                        
                      </div>
                    </li>
                    @endforeach  
                    @endif    
                  </ul>
                </div><!-- /.box-body -->
                
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->