<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Manufacturer;

class AdminController extends Controller
{
    public function login(){
        return view('auth.adlogin');
    }
   

    public function loginAdmin(Request $request){
        $request->validate([
            
            'email'=>'required|email',
            'password'=>'required'
            
        ]);

        $Admin = Admin::where('adEmail','=',$request->email)->first();
        $User = Customer::where('customerEmail','=',$request->email)->first();

        if($Admin){
            if($request->password==$Admin->adPassword){
                $request->session()->put('loginId',$Admin->adminID);
                return redirect('addashboard');
            }else{
                return back()->with('fail','Password not matched.');
            }
        }else if($User){
            if($request->password==$User->customerPass){
                $request->session()->put('loginId',$User->customerID);
                return redirect('customerHome');
            }else{
                return back()->with('fail','Password not matched.');
            }
        }
        else{
            return back()->with('fail','This email is not have');
        } 
    }

    public function addashboard(){
        $admin = Admin::get();
        $data = array();
        if(session()->has('loginId')){
            $data = Admin::where('adminID','=',session()->get('loginId'))->first();
        }
        return view('addashboard',compact('data','admin'));
    }

    public function logout(){
        if (session()->has('loginId')){
        session()->pull('loginId');
           return redirect('/adLogin');
        }
    }

    // PRODUCT LIST

    public function showProduct(){
        $product = Product::get();
        $category = Category::get();
        $manufacturer = Manufacturer::get();
        $data = array();
        if(session()->has('loginId')){
            $data = Admin::where('adminID','=',session()->get('loginId'))->first();
        }
        //return $data;
        return view('product-list',compact('product','data','category','manufacturer'));
    }
    public function addProduct(){

        $category = Category::get();
        $manufacturer = Manufacturer::get();
        $data = array();
        if(session()->has('loginId')){
            $data = Admin::where('adminID','=',session()->get('loginId'))->first();
        }
        return view('add-product',compact('category','manufacturer','data'));
    }

    public function saveProduct(Request $request){

        $request->validate([
            'name' => 'required',
            'id' => 'required',
            'price' => 'required',
            
            'warranty' => 'required',
            'manufacturerID' => 'required',
            'image' => 'required',
            
            'categoryID' => 'required',
        ]);
       
       
        
        $productID = $request->id;
        $productName = $request -> name;
        $productPrice = $request->price;
        $productDetails = $request->details;
        $prowarranty = $request->warranty;
        $manufacturerID = $request->manufacturerID;
        $proImage = $request->file('image')->getClientOriginalName();
        
        
        // $proImage = $request->file('proImage');
        
        $request->image->move(public_path('image'),$proImage);
        
        $categoryID = $request->categoryID;
        
        $pro = new Product();
        $pro->productID= $productID;
        $pro->productName = $productName;
        $pro->productPrice = $productPrice;
        $pro->productDetails = $productDetails;
        $pro->prowarranty = $prowarranty;
        $pro->manufacturerID = $manufacturerID;
        $pro->proImage = $proImage;
        $pro->categoryID = $categoryID;

        $pro->save();
        
        
        
        return redirect()->back()->with('success','Product Added Successfully');
    }

    public function editProduct($productID){
        $product = Product::where('productID','=',$productID)->first();
        $category = Category::get();
        $manufacturer = Manufacturer::get();
        $data = array();
        if(session()->has('loginId')){
            $data = Admin::where('adminID','=',session()->get('loginId'))->first();
        }
        return view('edit-product',compact('product','category','manufacturer','data'));
    }
    
    public function updateProduct(Request $request){
        // $request->validate([
        //     'name' => 'required',
            
        //     'price' => 'required',
            
        //     'warranty' => 'required',
        //     'manufacturerID' => 'required',
        //     'image' => 'required',
            
        //     'categoryID' => 'required',
        // ]);

        $productID = $request->id;
        $productName = $request -> name;
        $productPrice = $request->price;

        $productDetails = $request->details;

        $prowarranty = $request->warranty;
        $manufacturerID = $request->manufacturerID;
        $proImage = $request->file('image')->getClientOriginalName();
        $request->image->move(public_path('image'),$proImage);
        $categoryID = $request->categoryID;

        
        

        Product::where('productID','=',$productID)->update([
            'productID'=>$productID,
            'productName'=>$productName,
            'productDetails'=>$productDetails,
            'manufacturerID'=>$manufacturerID,
            'productPrice'=>$productPrice,
            'prowarranty'=>$prowarranty,
            'proImage'=>$proImage,
            'categoryID' => $categoryID
        ]);
        
        return redirect()->back()->with('success','Product Updated Successfully');
    }

    

    public function deleteProduct($productID){
        Product::where('productID','=',$productID)->delete();
        return redirect()->back()->with('success','Product Detele Successfully');
    }


    // Manufacturer
    public function manushow(){
        
            $manufacturer = Manufacturer::get();
            $data = array();
            if(session()->has('loginId')){
                $data = Admin::where('adminID','=',session()->get('loginId'))->first();
            }
            //return $data;
            return view('manufacturer-list',compact('manufacturer','data'));
        
    }

    public function addManufacturer(){

        $manufacturer = Manufacturer::get();
        
        $data = array();
        if(session()->has('loginId')){
            $data = Admin::where('adminID','=',session()->get('loginId'))->first();
        }
        return view('add-manufacturer',compact('manufacturer','data'));
    }
    public function saveManu(Request $request){

        $request->validate([
            'name' => 'required',
            'id' => 'required',
        ]);
       
       
        
        $manuID = $request->id;
        $manuName = $request -> name;
        $manuLogo = $request->file('logo')->getClientOriginalName();;
        $request->logo->move(public_path('image'),$manuLogo);
        
        $manu = new Manufacturer();
        $manu->manufacturerID=$manuID;
        $manu->manufacturerName  = $manuName;
        $manu->manufacturerLogo=$manuLogo;

        $manu->save();
        
        
        
        return redirect()->back()->with('success','Manufacturer Added Successfully');
    }

    public function editManufacturer($manufacturerID){
        $manufacturer = Manufacturer::where('manufacturerID','=',$manufacturerID)->first();
        $data = array();
        if(session()->has('loginId')){
            $data = Admin::where('adminID','=',session()->get('loginId'))->first();
        }
        
        return view('edit-manufacturer',compact('manufacturer','data'));
    }

    public function updateManufacturer(Request $request){
        $manuID = $request->id;
        $manuName = $request->name;
        $manuImage = $request->file('logo')->getClientOriginalName();
        $request->logo->move(public_path('image'),$manuImage);

        Manufacturer::where('manufacturerID','=',$manuID)->update([
            'manufacturerID' => $manuID,
            'manufacturerName' => $manuName,
            'manufacturerLogo' => $manuImage
        ]);
        return redirect()->back()->with('success','Manufacturer Updated Successfully');
    }

    public function delete($manuID){
        Manufacturer::where('manufacturerID','=',$manuID)->delete();
        return redirect()->back()->with('success','Manufacturer Detele Successfully');
    }
    //Category
    public function catShow(){
        
        $category = Category::get();
        $data = array();
        if(session()->has('loginId')){
            $data = Admin::where('adminID','=',session()->get('loginId'))->first();
        }
        //return $data;
        return view('categoryFrontEnd',compact('category','data'));
    
    }

public function addCategory(){

    $category = Category::get();
    
    $data = array();
    if(session()->has('loginId')){
        $data = Admin::where('adminID','=',session()->get('loginId'))->first();
    }
    return view('add-category',compact('category','data'));
}
public function saveCat(Request $request){

    $request->validate([
        'name' => 'required',
        'id' => 'required',
    ]);
   
   
    
    $catID = $request->id;
    $catName = $request -> name;
    $catDetails = $request->details;
    
    
    $cat = new Category();
    $cat->categoryID=$catID;
    $cat->catName  = $catName;
    $cat->catDescriptions=$catDetails;

    $cat->save();
    
    
    
    return redirect()->back()->with('success','Cateogry Added Successfully');
}

public function editCategory($categoryID){
    $category = Category::where('categoryID','=',$categoryID)->first();
    $data = array();
    if(session()->has('loginId')){
        $data = Admin::where('adminID','=',session()->get('loginId'))->first();
    }
    
    return view('edit-category',compact('category','data'));
}

public function updateCategory(Request $request){
    // $request->validate([
    //     'name' => 'required',
        
    //     'price' => 'required',
        
    //     'warranty' => 'required',
    //     'manufacturerID' => 'required',
    //     'image' => 'required',
        
    //     'categoryID' => 'required',
    // ]);

    $catID = $request->id;
    $catName = $request -> name;
    
    $catDescriptions = $request->catDescriptons;

    
    

    Category::where('categoryID','=',$catID)->update([
        
        'categoryName'=>$catName,
        'catDescriptions' => $catDescriptions,
        
    ]);
    
    return redirect()->back()->with('success','Product Updated Successfully');
}
public function deleteCategory($catID){
    Category::where('categoryID','=',$catID)->delete();
    return redirect()->back()->with('success','Category Detele Successfully');
}
    // customer management
    public function cusShow(){
        
        $customer = Customer::get();
        $data = array();
        if(session()->has('loginId')){
            $data = Admin::where('adminID','=',session()->get('loginId'))->first();
        }
        //return $data;
        return view('customer-list',compact('customer','data'));
    
    }
    public function deleteCustomer($cusID){
        Customer::where('customerID','=',$cusID)->delete();
        return redirect()->back()->with('success','Customer Detele Successfully');
    }
}
