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

    public function showCart(){
        return view('cart');
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
    public function productDetails($productID){
        $cat = Category::get();
        $Manu = Manufacturer::get();
        $product = Product::where('productID',$productID)->first();
        return view('productDetails',compact('product','Manu','cat'));
    }

    public function accountShow(){
        $cat = Category::get();
        $Manu = Manufacturer::get();
        $product = Product::get();
        // $data['products'] = Product::paginate(3);
        $data = array();
        if(session()->has('loginId')){
            $data = Customer::where('customerID','=',session()->get('loginId'))->first();
        }
        
        return view('customerPage',compact('Manu','product','cat','data'));
    }

    
}
