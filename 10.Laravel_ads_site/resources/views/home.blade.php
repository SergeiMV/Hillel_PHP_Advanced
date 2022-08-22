@extends('layouts.app')

@section('title')
    <title>Home</title>
@endsection

@section('aside')
    @parent
    @auth
        <h1> Hello {{ \Illuminate\Support\Facades\Auth::user()->username }}</h1>
        <a href="{{ route('ads.edit') }}" type="submit" class="btn btn-outline-primary">Create ad</a>
	<a href="{{ route('users.logout') }}" type="submit" class="btn btn-outline-primary">LogOut</a>
    @endauth
    @guest
        <div class="tabContent">
        <h1>Sign In / Sign Up</h1>
            <form method="post" action="{{ route('users.login') }}">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username"  value="{{ old('username') }}" >
                    <label for="username">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
		</div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email"  value="{{ old('email') }}" required>
                    <label for="email">Email</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-primary">Submit</button>
                @csrf
            </form>   
        </div>
    @endguest

@endsection
