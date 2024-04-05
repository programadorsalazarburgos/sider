<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Titulos')
@section('content')

<div class="container" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/universidades.js'); ?>"></script>
<script src="{{ mix('services/universidadesservices.js') }}"></script>
<script src="{{ mix('controllers/universidadescontrollers.js') }}"></script>
@endsection
@stop
