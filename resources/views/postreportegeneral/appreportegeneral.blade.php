<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Reporte General Beneficiarios')
@section('content')

<div class="" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/reportegeneral.js'); ?>"></script>
<script src="{{ mix('services/reportegeneralservices.js') }}"></script>
<script src="{{ mix('controllers/reportegeneralcontrollers.js') }}"></script>
@endsection
@stop
