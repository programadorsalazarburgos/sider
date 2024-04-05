<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Grupos Programas')
@section('content')

<div class="">
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/gruposprogramas.js'); ?>"></script>
<script src="{{ mix('services/grupoprogramasservices.js') }}"></script>
<script src="{{ mix('controllers/grupoprogramascontrollers.js') }}"></script>
@endsection
@stop
