<?php
function autoVer($url)
{
  $path = pathinfo($url);
  $ver = '?v='.filemtime($_SERVER['DOCUMENT_ROOT'].$url);
  return $path['dirname'].'/'.$path['basename'].$ver;
}
?>
@extends('angular.frontend.master')
@section('title', 'Reporte por Comuna')
@section('content')

<div class="container" >
     <ng-view></ng-view>
 </div>

@section('js')

<script src="<?php echo autoVer('/angularApp/localizacion.js'); ?>"></script>

        @foreach($ngServices as $service)
            <script src="{{$service}}"></script>
        @endforeach
<script src="{{ mix('controllers/localizacioncontrollers.js') }}"></script>
@endsection
@stop