<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Beneficiarios')
@section('content')

<div class="container" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/beneficiarios.js'); ?>"></script>
<script src="{{ mix('services/reportegeneralservices.js') }}"></script>
<script src="{{ mix('controllers/beneficiariocontrollers.js') }}"></script>
@endsection
@stop
<!--Beneficiarios-->