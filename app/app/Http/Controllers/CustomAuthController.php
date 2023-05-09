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
