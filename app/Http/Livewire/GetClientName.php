<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class GetClientName extends Component
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
            $results = Client::where('full_name' , 'LIKE' , '%'.$this->search.'%')->get();
        } else {
            $results = Client::all();
        }
        //dump($results);
        return view('livewire.get-client-name' , [
            'results' => $results ,
        ]);
    }
}
