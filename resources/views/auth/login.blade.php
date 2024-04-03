@extends('layouts.app')
@section('content')

<div id="login-page" class="row">
            <div class="col s12 card-panel z-depth-4">
                @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach($errors->all() as $error)
                          <li>{{$error}}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
              <form class="login-form" method="POST" action="{{ route('login') }}" name="login-form" id="user-login-form">
                        {{ csrf_field() }}

                                
                    <div class="row">
                        <div class="input-field col s12 center">
                            <img src="{{ asset('sider/images/logo/logo-alcaldia.png') }}" alt="" class="responsive-img valign profile-image-login">
                        <p class="center login-form-text">Ingreso Sistema de Gestión Sider</p>
                 
                            <div id="card-alert" class="card red lighten-5">
                              
                                <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
             

                        </div>
                    </div>

                <div class="form-group{{ $errors->has('numero_documento') ? ' has-error' : '' }}">
                <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-5">person_outline</i>
                            <input id="numero_documento" name="numero_documento" type="text" placeholder="Ej. Documento"  required autofocus>
                            @if ($errors->has('numero_documento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numero_documento') }}</strong>
                                    </span>
                                @endif
                            <label for="numero_documento" class="center-align">Usuario</label>
                        </div>
                    </div>
                </div>



    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix pt-5">lock_outline</i>
                            <input id="password" name="password" type="password" placeholder="Ej. ******" required>
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            <label for="password">Contraseña</label>
                        </div>
                    </div>
                </div>
                   <div class="form-group">
                          
                    <div class="row">
                        <div class="col s12 m12 l12 ml-2 mt-3">
                            <input type="checkbox" id="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                            <label for="remember-me">Recuérdame</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect #01579b light-blue darken-4 waves-light col s12">Iniciar sesión</button>
                        </div>
                    </div>
                    <div class="row">
                        {{--  <div class="input-field col s6 m6 l6">
                            <p class="margin right-align medium-small" ><a href="{{ route('password.request') }}">Recordar contraseña?</a></p>
                        </div>
                        <div class="input-field col s4 m4 l4">
                        <p class="margin right-align medium-small" ><a href="{{url('/admin/postpersonal#/admin/postpersonal/create')}}">Registrese</a></p>
                        </div>  --}}
                        {{--  <div class="input-field col s6 m6 l6">
                                <a href="{{url('/')}}" class="right">
                                    <i class="material-icons left">keyboard_arrow_left</i>
                                    Atras
                                </a>
                        </div>  --}}
                        <select size="1" name="links" onchange="window.location.href=this.value;">
                                <option value="" disabled selected>Seleccione Programa Registrarse</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/caliacoge')}}">Cali Incluye</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/calintegra')}}">In Cali</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/canasyganas')}}">Mas vitales</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/carrerasycaminatas')}}">Rutas de vida</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/cuerpoyespiritu')}}">Cali en forma</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/deporteasociado')}}">Team Cali</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/deporteescolar')}}">Mas recreo</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/viactiva')}}">Ciclo Vida</option>
                                <option value="{{url('/admin/postpersonal#/admin/postpersonal/viveelparque')}}">Cali juega</option>
                        </select>
                        
                    </div>

                </form>

    
            </div>
        </div>


@endsection
