<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Reporte General Beneficiarios Programas')
@section('content')

<div class="" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/reportegeneralprogramas.js'); ?>"></script>
<script src="{{ mix('services/reportegeneralservices.js') }}"></script>
<script src="{{ mix('controllers/reportegeneralprogramascontrollers.js') }}"></script>
@endsection
@stop
