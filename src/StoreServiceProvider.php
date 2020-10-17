<?php

namespace Tir\Store;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use Tir\Menu\Entities\MenuItem;
use Tir\Store\Category\Entities\Category;
use Tir\Store\Product\Entities\Product;
use Tir\Store\Search\MySqlSearchEngine;
use Tir\User\Entities\User;

class StoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
//        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        //Category module
        $this->loadRoutesFrom(__DIR__ . '/Category/Routes/admin.php');
        $this->loadMigrationsFrom(__DIR__ . '/Category/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Category/Resources/lang/', 'category');

        //Brand module
        $this->loadRoutesFrom(__DIR__ . '/Brand/Routes/admin.php');
        $this->loadMigrationsFrom(__DIR__ . '/Brand/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Brand/Resources/lang/', 'brand');
        //Attribute module
        $this->loadRoutesFrom(__DIR__ . '/Attribute/Routes/admin.php');
        $this->loadMigrationsFrom(__DIR__ . '/Attribute/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Attribute/Resources/lang/', 'attribute');
        $this->loadViewsFrom(__DIR__ . '/Attribute/Resources/Views/', 'attribute');

        //Option module
        $this->loadRoutesFrom(__DIR__ . '/Option/Routes/admin.php');
        $this->loadMigrationsFrom(__DIR__ . '/Option/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Option/Resources/lang/', 'option');
        $this->loadViewsFrom(__DIR__ . '/Option/Resources/Views/', 'option');

        //Product module
        $this->loadRoutesFrom(__DIR__ . '/Product/Routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/Product/Routes/public.php');
        $this->loadMigrationsFrom(__DIR__ . '/Product/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Product/Resources/lang/', 'product');
        $this->loadViewsFrom(__DIR__ . '/Product/Resources/Views/', 'product');

        //Review module
        $this->loadRoutesFrom(__DIR__ . '/Review/Routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/Review/Routes/public.php');
        $this->loadMigrationsFrom(__DIR__ . '/Review/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Review/Resources/lang/', 'review');
        $this->loadViewsFrom(__DIR__ . '/Review/Resources/Views/', 'review');

        //Setting module
        $this->loadRoutesFrom(__DIR__ . '/StoreSetting/Routes/admin.php');
        $this->loadMigrationsFrom(__DIR__ . '/StoreSetting/Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/StoreSetting/Resources/lang/', 'storeSetting');


        //Order module
        $this->loadMigrationsFrom(__DIR__ . '/Order/Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/Order/Routes/admin.php');
        $this->loadViewsFrom(__DIR__ . '/Order/Resources/Views/', 'order');
        $this->loadTranslationsFrom(__DIR__ . '/Order/Resources/Lang/', 'order');


        //Transaction module
        $this->loadMigrationsFrom(__DIR__ . '/Transaction/Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/Transaction/Routes/admin.php');
        $this->loadViewsFrom(__DIR__ . '/Transaction/Resources/Views/', 'transaction');
        $this->loadTranslationsFrom(__DIR__ . '/Transaction/Resources/lang/', 'transaction');

        //Account module
        $this->loadRoutesFrom(__DIR__ . '/Account/Routes/public.php');
        $this->loadTranslationsFrom(__DIR__ . '/Order/Resources/Lang/', 'account');


        //Wishlist module
        $this->loadRoutesFrom(__DIR__ . '/Wishlist/Routes/public.php');
        $this->loadMigrationsFrom(__DIR__ . '/Wishlist/Database/Migrations');


        //Support module
        $this->loadRoutesFrom(__DIR__ . '/Support/Routes/public.php');


        //Register Search Engine
        $this->registerMysqlSearchEngine();


        //Add admin menu
        $this->adminMenu();

        //Add dynamic Relation
        $this->addDynamicRelations();

        //Add additional fields to admin crud
        $this->setAdditionalFields();


    }

    private function adminMenu()
    {
        $menu = resolve('AdminMenu');
        $menu->item('store')->title('product::panel.store')->link('#')->add();
        $menu->item('store.products')->title('product::panel.products')->link('#')->add();
        $menu->item('store.products.products')->title('product::panel.catalog')->route('product.index')->add();
        $menu->item('store.products.categories')->title('category::panel.categories')->route('category.index')->add();
        $menu->item('store.products.attributes')->title('attribute::panel.attributes')->route('attribute.index')->add();
        $menu->item('store.products.attributesSets')->title('attribute::panel.attributeSets')->route('attributeSet.index')->add();
        $menu->item('store.products.brands')->title('brand::panel.brands')->route('brand.index')->add();
//        $menu->item('store.products.options')->title('option::panel.options')->add();
        $menu->item('store.products.reviews')->title('review::panel.reviews')->route('review.index')->add();
        $menu->item('store.orders')->title('order::panel.orders')->route('order.index')->add();
        $menu->item('store.transactions')->title('transaction::panel.transactions')->route('transaction.index')->add();
        $menu->item('setting')->title('storeSetting::panel.setting')->link('#')->add();
        $menu->item('setting.store_setting')->title('storeSetting::panel.store_setting')->link('./admin/storeSetting')->add();



    }


    private function registerMysqlSearchEngine()
    {
        $this->app[EngineManager::class]->extend('mysql', function () {
            return new MySqlSearchEngine;
        });

    }

    private function addDynamicRelations()
    {
        MenuItem::addDynamicRelation('category', function (MenuItem $menuItem) {
            return $menuItem->belongsTo(Category::class);
        });

        User::addDynamicRelation('wishlist', function (User $user) {
            return $user->belongsToMany(Product::class, 'wish_lists')->withTimestamps();
        });

    }

    private function setAdditionalFields()
    {
        $crud = resolve('Crud');

        $category = [
//            'type'     => 'field',
//            'group'    => 0,
//            'tab'      => 0,
//            'position' => 0,
            'crudName' => 'menuItem',
            'fields'   =>
                [
                    'name'     => 'category_id',
                    'display'  => 'category',
                    'type'     => 'relation',
                    'relation' => ['category', 'name'],
                    'visible'  => 'ce'
                ]
        ];
        $crud->addAdditionalFields($category);


    }

}
