<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(){
        $cat = Category::get();
        $Manu = Manufacturer::get();
        $data = Product::get();
        // $data['products'] = Product::paginate(3);
        

        return view('FrontEnd.home',compact('Manu','data','cat'));
    }

    public function showCustomer(){
        $cat = Category::get();
        $Manu = Manufacturer::get();
        $data = Product::get();
        

        return view('FrontEnd.customerHome',compact('Manu','data','cat'));
    }

    // public function catShow($categoryID){
    //     $product = Product::get();
    //     $category = Category::where('categoryID','=',$categoryID)->first();
    //     $manufacturer = Manufacturer::get();
    //     return view('categoryFrontEnd',compact('product','category','manufacturer'));
    // }

    public function customerDetails(){
        $cusData = array();
        if(session()->has('loginId')){
            $cusData = Customer::where('customerID','=',session()->get('loginId'))->first();
        }
        $cat = Category::get();
        $Manu = Manufacturer::get();

        return view('FrontEnd.accountDetails',compact('cusData','cat','Manu'));
    }

    

    
}
