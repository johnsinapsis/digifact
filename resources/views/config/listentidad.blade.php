<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($entidad_id))
                  <h3 class="box-title">Resultado de la búsqueda</h3>
                  @else
                  <h3 class="box-title">Listado de Clientes</h3>
                  @inject('ent','App\Http\Controllers\EntityController')   
                     
                  @endif
                  <div class="box-tools pull-right">
                    @if(!isset($entidad_id))
                    {!!$ent->index()->render()!!}
                    @endif
                  </div>
                </div><!-- /.box-header -->
                <br>
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($entidad_id))
                     
                       <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$entidad_nom}}</strong>. Nit:  {{$entidad_nit}}. Tel: {{$entidad_tel}}. Cel: {{$entidad_cel}}. Contacto: {{$entidad_con}}. Vencimiento Factura: {{$entidad_ven}} días </span>
                      <!-- Emphasis label -->
                     @if($entidad_est)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="{{route('editent',['id'=>$entidad_id])}}"><i class="fa fa-share"></i></a>
                       
                      </div>
                    </li>
                     
                     
                     @else
                     
                     @foreach ($ent->index() as $ent)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;"> <strong>{{$ent->NOM_ENT}}</strong>. Nit:  {{$ent->COD_ENT}}. Tel: {{$ent->TEL_ENT}}. Cel: {{$ent->CEL_ENT}}. Contacto: {{$ent->CON_ENT}}. Vencimiento Factura: {{$ent->VEN_ENT}} días</span>
                      <!-- Emphasis label -->
                     @if($ent->EST_ENT==1)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                       
                        
                        <a href="{{route('editent',['id'=>$ent->COD_ENT])}}"><i class="fa fa-share"></i></a>
                        
                        
                      </div>
                    </li>
                    @endforeach  
                    @endif    
                  </ul>
                </div><!-- /.box-body -->
                
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->