@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <br>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
                <br>
                <form action="{{ route('dashboard') }}" method="GET">
                    @csrf
                    <button type="submit">Press here to go to dashboard</button>
                </form>
                <br>
                <form action="{{ route('index') }}" method="GET">
                    @csrf
                    <button type="submit">Press here to go to form template</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
