<?php
 function autoVer($url)
 {
   $path = pathinfo($url);
   $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
   return $path['dirname'].'/'.$path['basename'].$ver;
 }
 ?>
@extends('angular.frontend.master')
@section('title', 'Roles y Permisos')
@section('content')

<div class="container" >
     <ng-view></ng-view>
 </div>
 
@section('js')
<script src="<?php echo autoVer('/angularApp/roles.js'); ?>"></script>
<script src="{{ mix('services/rolesservices.js') }}"></script>
<script src="{{ mix('controllers/rolescontrollers.js') }}"></script>
@endsection
@stop
