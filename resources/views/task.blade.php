@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Система учета задач') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Добро пожаловать, ').Auth::user()->name.' '.Auth::user()->patronymic }}
                </div>
            </div>
        </div>
    </div>
</div>

<div id="reactContent" data='{{ Auth()->id() }}'></div>
@endsection
