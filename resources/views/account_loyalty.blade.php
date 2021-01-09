@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                Ваш бонус {{ $bonus }}
                <withdraw-bonus></withdraw-bonus>
            </div>
        </div>
    </div>
@endsection
