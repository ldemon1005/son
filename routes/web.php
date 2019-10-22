<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/** @var \Illuminate\Support\Facades\Route $router */
$router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
    /** @var \Illuminate\Support\Facades\Route $router */


    //<editor-fold desc="auth view">
    $router->get('/login', 'AuthController@loginView')->name('admin_auth_login_view');
    $router->get('/register', 'AuthController@registerView')->name('admin_auth_register_view');
    $router->get('/reset-password', 'AuthController@resetPassView')->name('admin_auth_reset_password_view');
    //</editor-fold>

    //<editor-fold desc="auth action">
    $router->post('/login-action', 'AuthController@loginAction')->name('admin_auth_login_action');
    $router->post('/register-action', 'AuthController@registerAction')->name('admin_auth_register_action');
    $router->post('/reset-password-action', 'AuthController@resetPasswordAction')->name('admin_auth_reset_password_action');
    $router->post('/logout', 'AuthController@logout')->name('admin_auth_logout');
    //</editor-fold>

    $router->group(['middleware' => ['auth.admin']], function ($router) {
        /** @var \Illuminate\Support\Facades\Route $router */
        //<editor-fold desc="dashboard">
        $router::get('/dashboard', 'HomeController@dashboardV1')->name('dashboard-v1');
        //</editor-fold>

        //<editor-fold desc="category use view">
        $router->get('/list-category', 'CategoryController@listView')->name('admin_list_category');
        $router->get('/update-category/{id}', 'CategoryController@updateCategoryView')->name('admin_update_category_view');
        //</editor-fold>

        //<editor-fold desc="category action">
        $router->post('/create-category', 'CategoryController@createCategory')->name('admin_create_category');
        $router->post('/update-category', 'CategoryController@updateCategory')->name('admin_update_category_action');
        $router->post('/delete-category', 'CategoryController@deleteCategory')->name('admin_delete_category');
        //</editor-fold>

        //<editor-fold desc="product use view">
        $router->get('/list-product', 'ProductController@listView')->name('admin_list_product');
        $router->get('/update-product/{id}', 'ProductController@updateProductView')->name('admin_update_product_view');
        //</editor-fold>

        //<editor-fold desc="product action">
        $router->post('/create-product', 'ProductController@createProduct')->name('admin_create_product_action');
        $router->post('/update-product', 'ProductController@updateProduct')->name('admin_update_product_action');
        $router->post('/delete-product', 'ProductController@deleteProduct')->name('admin_delete_product');
        //</editor-fold>

        //<editor-fold desc="service use view">
        $router->get('/list-service', 'ServiceController@listView')->name('admin_list_service');
        $router->get('/update-service/{id}', 'ServiceController@updateServiceView')->name('admin_update_service_view');
        //</editor-fold>

        //<editor-fold desc="service action">
        $router->post('/create-service', 'ServiceController@createService')->name('admin_create_service_action');
        $router->post('/update-service', 'ServiceController@updateService')->name('admin_update_service_action');
        $router->post('/delete-service', 'ServiceController@deleteService')->name('admin_delete_service');
        //</editor-fold>

        //<editor-fold desc="contact use view">
        $router->get('/list-contact', 'ContactController@listView')->name('admin_list_contact');
        $router->get('/update-contact/{id}', 'ContactController@updateContactView')->name('admin_update_contact_view');
        //</editor-fold>

        //<editor-fold desc="contact action">
        $router->post('/update-contact', 'ContactController@updateContact')->name('admin_update_contact_action');
        $router->post('/delete-contact', 'ContactController@deleteContact')->name('admin_delete_contact');
        //</editor-fold>

        //<editor-fold desc="config use view">
        $router->get('/update-config', 'ConfigController@updateConfigView')->name('admin_update_config_view');
        //</editor-fold>

        //<editor-fold desc="config action">
        $router->post('/update-config', 'ConfigController@updateConfig')->name('admin_update_config_action');
        //</editor-fold>
    });
});

$router->group(['namespace' => 'Admin', 'prefix' => 'api', 'middleware' => ['auth.admin']], function ($router) {
    /** @var \Illuminate\Support\Facades\Route $router */
    /** ADMIN API */
    $router->post('/uploadImage', 'ApiController@uploadImage')->name('admin_api_image_upload');
});

$router->group(['namespace' => 'Client'], function ($router) {
    /** @var \Illuminate\Support\Facades\Route $router */
    //<editor-fold desc="auth view">
    $router->get('/', 'IndexController@index')->name('index_view');
    $router->get('/tim-kiem', 'IndexController@search')->name('search_view');
    $router->get('/gioi-thieu', 'IndexController@introduction')->name('introduction_view');
    $router->post('/lien-he-action', 'IndexController@contactAction')->name('contact_action');
    $router->get('/lien-he', 'IndexController@contactForm')->name('contact_view');
    $router->get('/tin-tuc', 'PostController@index')->name('list_post_view');
    $router->get('/tin-tuc/{slug}', 'PostController@detail')->name('detail_post_view');
    $router->get('/dich-vu/{slug}', 'IndexController@detailService')->name('detail_service_view');
    $router->get('/loai-san-pham/{slug}', 'IndexController@detailCategory')->name('detail_category_view');
    $router->get('/san-pham/{slug}', 'IndexController@detailProduct')->name('detail_product_view');
    //</editor-fold>
});
