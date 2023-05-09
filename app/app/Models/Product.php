<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    use HasFactory;
    

    public function category(){
        return $this->belongsTo(Category::class,'categoryID','categoryID');
    }
    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class,'manufacturerID', 'manufacturerID');
    }
    
    public $timestamps=false;
}
