<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Fournisseur;
use Livewire\Component;

class GetFournisseurName extends Component
{
    // public $search = '';
    public $i = 1;
    public $clients  = [];
    
    public $search = '';
    public $client_id;


    // public $selected;

    // public function goals($selected)
    // {
    //     dd($selected);
    // }

    public function selectsupplier($client_id, $terms)
    {
	    $this->client_id = $client_id;
	    $this->terms = $terms;
	    $this->search='';
    }

    public function render()
    {
        $results = [];

        if(strlen($this->search) >= 1) {
            $results = Fournisseur::where('full_name' , 'LIKE' , '%'.$this->search.'%')->get();
        } else {
            $results = Fournisseur::all();
        }
        //dump($results);
        return view('livewire.get-fournisseur-name' , [
            'results' => $results ,
        ]);
    }
}
