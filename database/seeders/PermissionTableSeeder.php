<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'bons menu',
            'bon entree',
            'bon sortie',
           // 'invoices not payed',
            //'invoices payed partial',
            //'archived invoices',
            //'rapports menu',
            //'invoices rapports',
            //'employers rapports',
            'employes',
            'list des employes',
            'permissions des employes',
            'produits',
            'articles',
            'categories',
         
    
            'ajouter bon',
            'supprime bon',
            'export EXCEL',
            'payment edit',
            'modifie bon',
            'archive bon',
            'print bon',
            //'add attachment',
            //'delete attachment',
    
            'add user',
            'edit user',
            'delete user',
    
            'view role',
            'add role',
            'edit role',
            'delete role',
    
            'ajouter article',
            'modifie article',
            'supprime article',
    
            'ajouter categorie',
            'modifie categorie',
            'supprime categorie',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
