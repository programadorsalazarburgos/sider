<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Soporte')
@section('content')

<div class="container" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/soporte.js'); ?>"></script>
<script src="{{ mix('controllers/usuariocontrollers.js') }}"></script>
@endsection
@stop
