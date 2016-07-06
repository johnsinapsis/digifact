 @inject('menu','App\Http\Controllers\MenuController')
 @if($menu->box('19',Auth::user()->role)>0) 
  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-navy">
                <div class="inner">
                  <h3>Inventarios</h3>
                  <p>General</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-albums-outline"></i>
                </div>
                <a href="{{route('inventarios')}}" class="small-box-footer">Gestionar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
 @endif