@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="bonus_info"> Ваш бонус {{ $bonus }}</div>
                <withdraw-bonus></withdraw-bonus>
            </div>
        </div>
    </div>
@endsection
