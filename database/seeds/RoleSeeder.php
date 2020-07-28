<?php

use Illuminate\Database\Seeder;
use App\{User,Role,Permission};

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
             [
                'name' => 'admin_access',
                'description' => 'Pode acessar a pagina do admininstrador' 
             ],
             [
                'name' => 'manage_users',
                'description' => 'Pode gerenciar usuarios'
             ],
             [
                'name' => 'manage_products',
                'description' => 'Pode gerenciar produtos'
             ],
             [
                'name' => 'manage_roles',
                'description' => 'Permite criar papeis de usuarios e definir permissoes'
             ],
             [
                'name' => 'manage_sales',
                'description' => 'Permite gerenciar compras e vendas'
             ],
             [
                'name' => 'manage_coupons',
                'description' => 'Permite gerenciar os cupons de desconto'
             ],
             [
                'name' => 'manage_homepage',
                'description' => 'Permite gerenciar a página inicial da loja'
             ],
             [
                 'name' => 'edit_products',
                 'description' => 'Permite editar os produtos do site'
             ],
             [
                'name' => 'customer',
                'description' => 'Permite realizar compras no site'
            ]
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }

        $admin = Role::create([
            'name' => 'Admin',
            'description' => 'Super usuário, tem acesso a todo o conteúdo do site'
        ]);

        $manager = Role::create([
            'name' => 'Gerente',
            'description' => 'Gerente do site'
        ]);

        $seller = Role::create([
            'name' => 'Vendedor',
            'description' => 'Administra as compras e vendas'
        ]);

        $customer = Role::create([
            'name' => 'Cliente',
            'description' => 'Cliente que realiza as compras no site'
        ]);

        $admin->permissions()->attach(Permission::all());
        $manager->permissions()->attach(Permission::whereNotIn('id', [5])->get());
        $seller->permissions()->attach(Permission::whereIn('id', [1,3,5])->get());
        $customer->permissions()->attach(Permission::find(9));
        
        User::find(1)->roles()->attach(Role::find(1));
        
    }
}
