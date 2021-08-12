<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class GetProductName extends Component
{
    // public $search = '';
    public $i = 1;
    public $products  = [];
    
    public $search = '';
    public $product_id;


    // public $selected;

    // public function goals($selected)
    // {
    //     dd($selected);
    // }

    public function selectsupplier($product_id, $terms)
    {
	    $this->product_id = $product_id;
	    $this->terms = $terms;
	    $this->search='';
    }

    public function render()
    {
        $articles = [];

        if(strlen($this->search) >= 1) {
            $articles = Article::where('description' , 'LIKE' , '%'.$this->search.'%')->get();
        } else {
            $articles = Article::all();
        }
        //dump($results);
        return view('livewire.get-product-name' , [
            'articles' => $articles ,
        ]);
    }
}
