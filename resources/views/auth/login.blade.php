@extends('master')

@section('content')
<div class="row">
    {!! Form::open(['route' => 'doLogin']) !!}
        <fieldset class="fieldset">
            <label>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </label>
        
            <label>
                Password
                <input type="password" name="password" id="password">
            </label>
        
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        
            <button type="submit" class="button">Login</button>
        </fieldset>
    {!! Form::close() !!}
</div>
@endsection