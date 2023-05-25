@extends('product.layout.template')

@section('body')
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">OTP Validation</h4>
        @if($validate['code'] == 200)
            {{$resp[$validate['code']]}}
        @elseif($validate['code'] == 203 || $validate['code'] == 404)
            {{$resp[$validate['code']]}}
            @if(isset($validate['resendId']))
                <form class="needs-validation" action="{{route('validateOtp')}}" method="post" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="otp">Enter OTP</label>
                            <input type="text" class="form-control" name="otp" id="otp" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Enter OTP.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    {!! csrf_field() !!}
                    <input id="uniqueId" name="uniqueId" type="hidden" value="{{$validate['resendId']}}">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Retry</button>
                </form>
            @endif
        @else
            {{$resp[$validate['code']]}}
        @endif
    </div>
@endsection