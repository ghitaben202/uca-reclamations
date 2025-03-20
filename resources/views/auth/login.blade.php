@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Connexion') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email_personnel" class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email_personnel" id="email_personnel" class="form-control" value="{{ old('email_personnel') }}" required autofocus>
                            @error('email_personnel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                            <input type="password" name="mot_de_passe" id="password" class="form-control " required autocomplete="current-password">
                            @error('mot_de_passe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">{{ __('Se connecter') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection