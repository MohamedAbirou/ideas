@extends('layout.layout')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6">
                <form class="form mt-5" action="{{ route('login') }}" method="post">
                    @csrf
                    @method('POST')

                    <h3 class="text-center">Login</h3>
                    <div class="form-group">
                        <label for="email">Email:</label><br>
                        <input type="email" name="email" id="email" class="form-control">
                        @error('email')
                            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="remember-me"></label><br>
                        <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
                    </div>
                    <div class="text-right mt-2">
                        <a href="/register">Register here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
