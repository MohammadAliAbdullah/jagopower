<style type="text/css">
    /*#logout{*/
    /*    background: none;*/
    /*    border: none;*/
    /*    color: white;*/
    /*    cursor: pointer;*/
    /*    position: relative;*/
    /*    top: 0px;*/
    /*    left: 12px;*/
    /*}*/
</style>
<div class="my-a-area">
    <div class="my-head">
        <h5>My Account</h5>
    </div>
    <div class="head-text-area">
        <ul>
{{--            <li>--}}
{{--                <a href="{{ route('mypanel.mwallet.index') }}">My Wallet Balance</a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('mypanel.profile.index') }}">Account Information</a>
            </li>
{{--            <li>--}}
{{--                <a href="{{ route('mypanel.maddress.index') }}">Address Book</a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('mypanel.morder.index') }}">My Order</a>
            </li>
{{--            <li>--}}
{{--                <a href="{{ route('mypanel.mreview.index') }}">Product Review</a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('mypanel.password.index') }}">Chnage Password</a>
            </li>
{{--            <li>--}}
{{--                <form action="{{ route('mypanel.elogout') }}" method="post">--}}
{{--                    @csrf--}}
{{--                    <button value="logout" id="logout" type="submit">logout</button>--}}
{{--                </form>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>