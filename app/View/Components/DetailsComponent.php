<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DetailsComponent extends Component
{
    public $slug;

    public function mount($slug){
        $this->slug=$slug;
    }
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $product = Product::where('slug',$this->slug)->first();
        return view('components.details-component',['product'=>$product]);
    }
}
