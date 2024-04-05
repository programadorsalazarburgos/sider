<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Disciplinas Programa')
@section('content')

<div class="" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="<?php echo autoVer('/angularApp/disciplinas.js'); ?>"></script>
<script src="{{ mix('services/prdisciplinasservices.js') }}"></script>
<script src="{{ mix('controllers/prdisciplinascontrollers.js') }}"></script>
@endsection
@stop
