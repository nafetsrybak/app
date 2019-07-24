@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
                <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
                <script>paypal.Buttons().render('body');</script>
            </div>
        </div>
    </div>
</div>
@endsection
