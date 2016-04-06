<html lang="en">
   <head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resol</title>
    {!! Html::style('dist/css/selResol.css') !!}
    {!! Html::style('bootstrap/css/bootstrap.min.css')!!}
    {!! Html::style('dist/css/awesome/font-awesome.min.css')!!}
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    {!! Html::style('dist/css/ionicons/css/ionicons.min.css')!!}
    {!! Html::style('dist/css/AdminLTE.min.css') !!}
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {!! Html::style('dist/css/skins/_all-skins.min.css') !!}
       
  </head>
 <body>
      
     <div class="clearfix">
	 
	 {!! Html::image('imagenes/'.$logotipo, "User image", array('class' => 'logo')) !!}
     	
     	</div>
    <section class="col-lg-7 connectedSortable" style="margin-left:20%;">
        <div class="box box-success">
            @include('partials/errors')
              @include('partials/success')
              @include('partials/msg-ok')
              
            @if(isset($liqui))
            {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'resoliq']) !!}
            @endif
            @if(isset($anu))
            {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'resoanu']) !!}
            @endif
            @if(isset($rad))
            {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => 'resolrad']) !!}
            @else
            {!! Form::open(['class' => 'form-horizontal', 'role' => 'form','method' => 'POST','route' => ['pdfview',$id], 'files' => true]) !!}
            @endif
                <div class="box-header">
                  <i class="fa fa-cogs"></i>
                  <h3 class="box-title">Seleccionar Resolución</h3>      
                </div>
                <div class="box-body chat" id="chat-box" >
                    <div class="item">
                        {!! Html::image('dist/img/logodigi.png', "User image", array('class' => 'online')) !!}
                        <p class="message">
                            <a href="#" class="name">
                                Configurar parámetros iniciales
                            </a> 
                        </p>
                        <div class="attachment">
                            <div id="formresol">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">No. de Resolución:</label>
                                    <div class="input-group input-group-sm">
                                        @inject('resolucion','App\Http\Controllers\ResulController')
                                        <select name="resol" id="resol" class="form-control">
                                            <option value="0">Seleccione una resolución</option>
                                            @foreach ($resolucion->listar() as $resol)
                                            <option value="{{$resol->id}}"> {{$resol->num_resol}}  del {{$resol->prefijo}} {{$resol->ini_consec}} al {{$resol->prefijo}} {{$resol->fin_consec}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                    <div class="box-footer">
                                        <div class="input-group-btn" align="center">
                                           <button  type="submit" class="btn btn-primary btn-flat">Aceptar</button>
                                         </div>
                                     </div>
                            </div>
                        </div>
                    </div>  
                </div>

            {!! Form::close() !!}
         </div>   
      </section>  
    <!-- jQuery 2.1.4 -->
    {!! Html::script('plugins/jQuery/jQuery-2.1.4.min.js') !!}
    <!-- jQuery UI 1.11.4 -->
    <!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>--> 
    {!! Html::script('plugins/jQuery/jquery-ui.min.js') !!}    
    {!! Html::script('bootstrap/js/bootstrap.min.js') !!}
 </body>


</html>