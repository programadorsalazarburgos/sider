<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Reporte Beneficiarios Detallado')
@section('content')

<div class="" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/reportedetalladoprogramas.js'); ?>"></script>
        @foreach($ngServices as $service)
            <script src="{{$service}}"></script>
        @endforeach
<script src="{{ mix('controllers/reportedetalladoprogramacontrollers.js') }}"></script>
@endsection
@stop
