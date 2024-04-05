<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Usuarios')
@section('content')

<div class="" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/usuarios.js'); ?>"></script>
<script src="{{ mix('services/usuarioservices.js') }}"></script>
<script src="{{ mix('controllers/usuariocontrollers.js') }}"></script>
<script src="{{ mix('controllers/personalcontrollers.js') }}"></script>
@endsection
@stop
