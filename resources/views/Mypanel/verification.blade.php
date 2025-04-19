@php
    use App\Models\Customer;
    $user = Auth::guard('mypanel')->user()->id;
    $profile=Customer::where('id', $user)->first();
@endphp
@if($profile->status=='Active')
{{--<div class="row">--}}
{{--    <div class="col-md-12">--}}
{{--        <div class="hello-omor">--}}
{{--            <p>Hello ! <b>{{ $profile->name }}</b> Your account not verified, Please verify your account <a href="">Click to Verify</a> .</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endif