<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AlreadyLoggedIn;
use App\Models\Customer;
use Illuminate\Contracts\Session\Session;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;






class CustomAuthController extends Controller
{
    // Login and Register
    

    public function registration(){
        return view('auth.registration');
    }

    public function registerUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:customers,customerEmail',
            'password'=>'required|min:6|max:12',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required'
        ]);

        $cusName = $request->name;
        $cusEmail = $request->email;
        $cusPass = $request->password;
        $cusPhone = $request->phone;
        $cusAdd = $request->address;
        $gender=$request->gender;

        $user = new Customer();
        $user->customerName = $cusName;
        $user->customerEmail = $cusEmail;
        $user->customerPhone = $cusPhone;
        $user->customerAddress = $cusAdd;
        $user->customerGender = $gender;
        $user->customerPass = $cusPass;
        $res = $user->save();

        if($res){
            return redirect()->back()->with('success','you have registered successfully');
        }else{
            return redirect()->back()->with('fail','Something wrong');
        }

    }
    
    public function loginUser(Request $request){
        $request->validate([
            
            'email'=>'required|email',
            'password'=>'required|min:6|max:12'
            
        ]);

        $user = Customer::where('customerEmail','=',$request->email)->first();

        if($user){
            if($request->password==$user->customerPass){
                $request->session()->put('loginId',$user->customerID);
                return redirect('dashboard');
            }else{
                return back()->with('fail','Password not matched.');
            }
        }else{
            return back()->with('fail','This email is not registered');
        }
    }

    

    public function logout(){
        if (session()->has('loginId')){
        session()->pull('loginId');
           return redirect('/login');
        }
    }

    // public function logout(Request $request){
    //     AlreadyLoggedIn::logout();
    //     return redirect('/login');
    // }

}
