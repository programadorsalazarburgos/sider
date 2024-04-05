<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Lugares de Atención')
@section('content')

<div class="" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/lugares.js'); ?>"></script>
<script src="{{ mix('services/lugaresservices.js') }}"></script>
<script src="{{ mix('controllers/lugarescontrollers.js') }}"></script>
@endsection
@stop
