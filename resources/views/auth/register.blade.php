
@extends('layouts.login')

@section('title')
   register

@stop

@section('content')
    <!-- row -->
    <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url('{{ asset('assets/images/register-bg.jpg') }}'); ">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 offset-lg-1 col-md-6 login-fancy-bg bg parallax" style="background-image:url('{{ asset('assets/images/register-inner-bg.jpg') }}'); ">
                    <div class="login-fancy">
                        <h2 class="text-white mb-20">Hello world!</h2>
                        <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose responsive template along with powerful features.</p>
                        <ul class="list-unstyled pos-bot pb-30">
                            <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
                            <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 bg-white">
                    <div class="login-fancy pb-40 clearfix">
                        <h3 class="mb-30">Signup</h3>
                    <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="section-field mb-20 ">
                                <label class="mb-10" for="fname">name* </label>
                                <input id="fname" class="web form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                        <div class="section-field mb-20">
                            <label class="mb-10" for="email">Email* </label>
                            <input type="email" placeholder="Email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror


                        </div>
                        <div class="section-field mb-20">
                            <label class="mb-10" for="password">Password* </label>
                            <input class="Password form-control" id="password" type="password" placeholder="Password"  value="{{ old('password') }}" name="password">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror


                        </div>

                        <div class="section-field mb-20">
                            <label class="mb-10" for="password">Confirm Password</label>
                            <input class="Password form-control" id="password-confirm" type="password" placeholder="Confirm Password"  value="{{ old('password') }}" name="password_confirmation">
                        </div>
                        <button  class="button" type="submit">
                            <span>Signup</span>
                            <i class="fa fa-check"></i>
                        </button>

                    </form>
                        <p class="mt-20 mb-0">Don't have an account? <a href="{{route('login')}}"> Create one here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- row closed -->
@endsection

