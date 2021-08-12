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
            
            'stock value',
            'stock etat',

            'credit',
            'edit credit',
            'suivi credit',
            
            'clients',
            'clients list',
            'add client',
            'edit client',
            'delete client',

            'fournisseurs',
            'fournisseurs list',
            'add fournisseur',
            'edit fournisseur',
            'delete fournisseur',

            'commande',
            'add commande',
            'archive commande',
            'voir commande',
            'delete commande',
            'print commande',

            'employes',
            'list des employes',
            'permissions des employes',
            
            'add bon',
            'delete bon',
            'export EXCEL',
            'edit bon',
            'archive bon',
            'print bon',

            'add user',
            'edit user',
            'delete user',
    
            'view role',
            'add role',
            'edit role',
            'delete role',
    
            'articles',
            'add article',
            'edit article',
            'delete article',
    
            'categories',
            'add categorie',
            'edit categorie',
            'delete categorie',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
