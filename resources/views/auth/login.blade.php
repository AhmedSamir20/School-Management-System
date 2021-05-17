
@extends('layouts.login')

@section('title')
    register

@stop

@section('content')
    <!-- row -->
    <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url('{{ asset('assets/images/login-bg.jpg') }}'); ">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">
                <div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-image:url('{{ asset('assets/images/login-inner-bg.jpg') }}'); ">
                    <div class="login-fancy">
                        <h2 class="text-white mb-20">Hello world!</h2>
                        <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose responsive template along with powerful features.</p>
                        <ul class="list-unstyled  pos-bot pb-30">
                            <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
                            <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 bg-white">
                    <div class="login-fancy pb-40 clearfix">
                        <h3 class="mb-30">Sign In To Admin</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="section-field mb-20">
                            <label class="mb-10" for="name">User name* </label>
                            <input  class="web form-control" type="email" placeholder="User name"  name="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="section-field mb-20">
                            <label class="mb-10" for="Password">Password* </label>
                            <input id="Password" class="Password form-control" type="password" placeholder="Password" name="password">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="section-field">
                            <div class="remember-checkbox mb-30">
                                <input type="checkbox" class="form-control"  name="remember" {{ old('remember') ? 'checked' : '' }} id="remember" />
                                <label for="remember"> Remember me</label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="float-right">
                                        Forgot Password?
                                    </a>

                                @endif

                            </div>
                        </div>
                        <button type="submit" class="button">
                            <span>Log in</span>
                            <i class="fa fa-check"></i>
                        </button>
                </form>
                        <p class="mt-20 mb-0">Don't have an account? <a href="{{route('register')}}"> Create one here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- row closed -->
@endsection

