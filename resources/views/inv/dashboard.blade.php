@extends('layout')
@section('content')
<div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Bodegas</span>
                  <span class="info-box-number"><a style="color:black;" href="{{route('infopago')}}">Creación de Bodegas</a></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-suitcase"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Cartera</span>
                  <span class="info-box-number"><a style="color:black;" href="{{route('infoedad')}}">Cartera por edades</a></span></a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Facturación</span>
                  <span class="info-box-number"><a style="color:black;" href="{{route('inforad')}}">Facturas por Radicar</a></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

             <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-info-circle"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Facturación</span>
                  <span class="info-box-number"><a style="color:black;" href="{{route('inforango')}}">Rango de Facturas</a></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
  </div><!-- /.row -->
          
@endsection



