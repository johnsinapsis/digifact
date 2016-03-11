  <section class="col-lg-5 connectedSortable">
               <!-- Map box -->
              <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">
                 
                  <i class="fa fa-television"></i>
                  <h3 class="box-title">
                    @if (isset($idsel))
                    Resolución {{$prefijo}} {{$numressel}}
                    
                    @endif
                  </h3>
                </div>
                <div class="box-body">
                  <div  style="height: 250px; width: 100%;">
                     @if (isset($idsel))
                    expedida el  {{Carbon\Carbon::createFromFormat('Y-m-d',$fecsel)->format('d/m/Y')}}. Consecutivos
                    del {{$inisel}} al {{$finsel}} 
                    <div class="jumbotron" style = "height:240px; background-color:black;" align="center">
                      <h4><strong>Consecutivo Actual</strong></h4>
                      <h1><strong>{{$actsel}}</strong></h1> <strong> Faltan {{$finsel-$actsel+1}} facturas </strong>
                    </div>
                    
                    @endif
                  </div>
                </div><!-- /.box-body-->
                <div class="box-footer no-border bg-light-blue-gradient">
                 
                </div>
              </div>
              <!-- /.box -->
   </section>