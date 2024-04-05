<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Grupos')
@section('content')

<div class="" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/grupos.js'); ?>"></script>
<script src="{{ mix('services/gruposervices.js') }}"></script>
<script src="{{ mix('controllers/grupocontrollers.js') }}"></script>
@endsection
@stop
