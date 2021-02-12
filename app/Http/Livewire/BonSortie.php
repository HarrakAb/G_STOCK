<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use Livewire\Component;

class BonSortie extends Component
{
    public $articles = [];
    public $categories = [];

    public function mount(){
        $this->categories = Categorie::all();
        $this->articles = [
            []
        ];
    }

    public function addRow(){

        $this->articles []= [
            [
                'categorie' => '',
                'article' => '',
                'quantite' => '',
                'prix_unitaire' => '',
            ]
        ];

    }

    public function render()
    {

        return view('livewire.bon-sortie');
    }
}
