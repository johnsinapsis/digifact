<!--listado facturas -->
              <div id="list_fact" class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  @if(isset($listfac))
                  <h3 class="box-title">Facturas resultado de la búsqueda</h3>
                  @else
                  <h3 class="box-title">Ultimas facturas liquidadas</h3>
                  @endif
                  <div class="box-tools pull-right">
                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
                     @if(isset($listfac))
                     @foreach($listfac as $fact)
                       <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;">Factura: <strong>{{$fact->numfac}}</strong>. Nit: {{$fact->COD_ENT}}. {{$fact->NOM_ENT}}. Total: $ {{number_format($fact->total,2)}}</span>
                      <!-- Emphasis label -->
                     @if($fact->estfac==1)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Facturada</small>
                      @else
                        @if($fact->estfac==2)
                        <small class="label label-info"><i class="fa fa-thumbs-o-down"></i> Radicada</small>
                        @else
                          @if($fact->estfac==3)
                          <small class="label label-warning"><i class="fa fa-thumbs-o-down"></i> Pagada</small>
                          @else
                          <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Anulada</small>
                          @endif
                        @endif
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <!-- <a href="{{route('ref',['numfac'=>$fact->numfac,'resol' => $fact->idsel])}}"><i class="fa fa-share"></i></a> -->
                        <a href="{{route('pdffact',['numfac'=>$fact->numfac,'resol' => $fact->idsel])}}" target="_blank"><i class="fa fa-television"></i></a>
                      </div>
                    </li>
                     @endforeach
                     
                     @else
                     @inject('fact','App\Http\Controllers\FactController')
                     @foreach ($fact->toplist2() as $fact)
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                      <!-- todo text -->
                      <span class="text" style="font-size: 12px;">Factura: <strong>{{$fact->numfac}}</strong>. Nit: {{$fact->COD_ENT}}. {{$fact->NOM_ENT}}. Total: $ {{number_format($fact->total)}}</span>
                      <!-- Emphasis label -->
                     @if($fact->estfac)
                      <small class="label label-success"><i class="fa fa-thumbs-up"></i> Activo</small>
                      @else
                      <small class="label label-danger"><i class="fa fa-thumbs-o-down"></i> Inactivo</small>
                      @endif
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        @if($fact->estfac)
                        <a href="{{route('pdffact',['numfac'=>$fact->numfac,'resol' => $fact->resol])}}" target="_blank"><i class="fa fa-television"></i></a>

                        @else
                        <a href="{{route('ref',['numfac'=>$fact->numfac,'resol' => $fact->resol])}}"><i class="fa fa-share"></i></a>
                        <a href="{{route('pdffact',['numfac'=>$fact->numfac,'resol' => $fact->idsel])}}" target="_blank"><i class="fa fa-television"></i></a>
                        @endif
                      </div>
                    </li>
                    @endforeach  
                    @endif    
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->