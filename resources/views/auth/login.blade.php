@extends('layouts.frontend', ['title' => trans('adminlte.auth.login.title'), 'class' => 'homepage', 'header' => false])

@section('content')
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <div class="auth-form col-md-6 col-sm-12">
                    <div class="d-flex align-items-left justify-content-left mb-3 mb-lg-4">
                        <img class="img-h75 mb-0" src="{{ asset('images/logo.png') }}" alt="@lang('adminlte.auth.login.title')">
                    </div>
                    <h2 class="text-primary font-weight-600 mb-3">
                        @lang('adminlte.auth.login.title')
                    </h2>
                    <p class="font-weight-500 lead font-17">
                        @lang('adminlte.auth.login.info')
                    </p>

                    {{ BsForm::resource('customers')->post(route('login')) }}
                        {{ BsForm::email('email') }}
                        {{ BsForm::password('password') }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">
                                        @lang('adminlte.auth.login.remember')
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">
                                        @lang('adminlte.auth.login.submit')
                                    </button>

                                    <small class="mt-3 d-block">
                                        @if(Route::has('password.request'))
                                            <a class="btn btn-link btn-sm" href="{{ route('password.request') }}">
                                                @lang('adminlte.auth.forget.title')
                                            </a>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    {{ BsForm::close() }}
                </div>
                <div class="col-12 pb-5"></div>
            </div>
        </div>
    </section>
    <aside class="sidebar col-lg-6 col-md-6 col-sm-12 d-none d-md-block">
        <ul class="list-unstyled pl-0 pl-md-5">
            @foreach(trans('frontend.features') as $feature)
                <li class="media mb-54">
                    <div class="bg-white rounded mr-3 p-3">
                        <img src="{{ $feature['icon'] }}" class="img-fluid" alt="{{ $feature['title'] }}">
                    </div>
                    <div class="media-body font-weight-500 text-light">
                        <h5 class="mt-0 mb-2 text-white font-weight-600">{{ $feature['title'] }}</h5>
                        {{ $feature['description'] }}
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>
@endsection
