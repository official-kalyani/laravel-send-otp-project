@extends('product.layout.template')

@section('body')
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">OTP Validation</h4>

        <form class="card p-2" action="{{route('validateOtp')}}" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="otp" id="otp" placeholder="" value="" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </div>
            <div>Expire In <span id="timer"></span></div>
            {!! csrf_field() !!}
            <input id="uniqueId" name="uniqueId" type="hidden" value="{{$uniqueId}}">
        </form>
        <form class="needs-validation" action="{{route('resendOtp')}}" method="post" novalidate>
            {!! csrf_field() !!}
            <input id="uniqueId" name="uniqueId" type="hidden" value="{{$uniqueId}}">
            <button class="btn btn-success" type="submit">Resend OTP</button>
        </form>
    </div>
@endsection

@section('timer-script')
    <script src="{{ asset('js/app.js')}}"></script>
@endsection