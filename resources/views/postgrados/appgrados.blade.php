@extends('angular.frontend.master')
@section('title', 'Grados')
@section('content')

<div class="container" >
     <ng-view></ng-view>
 </div>

@section('js')
<script src="{{asset("angularApp/grados.js")}}"></script>

        @foreach($ngServices as $service)
            <script src="{{$service}}"></script>
        @endforeach
        @foreach($ngControllers as $controller)
            <script src="{{$controller}}"></script>
        @endforeach

@endsection
@stop
