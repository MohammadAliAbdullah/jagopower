<?php
namespace App\Http\Controllers\Mypanel\Auth;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login',[
            'title' => 'Login',
            'loginRoute' => 'login',
            'forgotPasswordRoute' => 'password.request',
        ]);
    }

    /**
     * Login the admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {

        //$this->validator($request);
        if(is_numeric($request->email)) {
            //dd($request);
            $userdata = array(
                'phone' => $request->email,
                'password' => $request->password,
                //'status' => 'Active',
            );
            if (Auth::guard('mypanel')->attempt($userdata)) {
                    if (!empty(Cart::gettotal())) {
                        return redirect()->intended(route('cart.list'))->with('status', 'You are Logged in as mypanel!');
                    }
                    return redirect()->intended(route('home.index'))->with('status', 'You are Logged in as mypanel!');
                } else {
                    //dd($request->all());
                    return redirect()->route('mypanel.mypanel.login')->with('error', 'Email-Address And Password Are Wrong.');
                }
        }else{
            $userdata = array(
                'email' => $request->email,
                'password' => $request->password,
                //'status' => 'Active',
            );
            if(Auth::guard('mypanel')->attempt($userdata)){
                //dd(Cart::gettotal());
                if(!empty(session('link'))){
                //if(!empty(Cart::gettotal())){
                    return redirect(session('link'));
                    //return redirect()->intended(route('cart.list'))->with('status','You are Logged in as mypanel!');
                }
                return redirect()->intended(route('home.index'))->with('status','You are Logged in as mypanel!');
            }else{
                //dd($request->all());
                return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
            }

        }


        //if(Auth::guard('mypanel')->attempt($userdata),$request->filled('remember')){

    }
    public function generateOTP(){
        $otp = mt_rand(10000,99999);
        return $otp;
    }

    public function register_user(Request $request)
    {
        //dd($request->checkd);
        if($request->checked=='on'){
            $validated = $request->validate([
                'name'    => 'required',
                //'email'    => 'email',
                'phone' => 'required',
                //'password' => 'required'
            ]);
        }else{
            $validated = $request->validate([
                'name'    => 'required',
                'email'    => 'required',
                'phone' => 'required',
                //'password' => 'required',
            ]);
        }
        $validated['password']=Hash::make($request->password);
        $validated['virification']=$this->generateOTP();
        $validated['status'] = "Pending";
        //dd($validated);
        $exists = Customer::where("email", $request->email)->first();
        $existsphone = Customer::where("phone", $request->phone)->first();
        if ($exists) {
            return redirect()->route('mypanel.mypanel.login')->with('error','Email already exists!');
        }elseif($existsphone){
            return redirect()->route('mypanel.mypanel.login')->with('error','Phone already exists!');
        }else{
            $user_id=Customer::create($validated);
            $data['customer_id']=$user_id->id;
            $data['holding_balance']=0;
            $data['cashback_balance']=0;
            $data['giftcard_balance']=0;
            $data['current_balance']=0;
            Wallet::create($data);
            //dd($user_id);
            return redirect()->route('mypanel.mypanel.login')->with('status','Your Registration is Sucessfully! Please login now!');
        }

    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {

        Auth::guard('mypanel')->logout();
        return redirect()
            ->route('home.index')
            ->with('status','Admin has been logged out!');
    }

    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:customers|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed(){
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }
}
