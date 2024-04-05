<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Inicio')
@section('content')

<div class="container" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/sider.js'); ?>"></script>
<script src="{{ mix('services/siderservices.js') }}"></script>
<script src="{{ mix('controllers/sidercontrollers.js') }}"></script>

@endsection
@stop
