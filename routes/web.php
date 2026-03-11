<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\PaymentController;
use App\Models\Plat;
use GuzzleHttp\Middleware;
use App\Models\Restaurant;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*-----------------------------Restaurant routes--------------------------------- */

Route::prefix('restaurant')->group(function () {
    // Route::get('/info', [RestaurantController::class, 'info'])->name('info');
    //Auth ROUTES
    Route::get('/login', [RestaurantController::class, 'login'])->name('login_form');
    Route::post('/connect', [RestaurantController::class, 'connect'])->name('restaurant.login');
    Route::get('/about-nudutin', [RestaurantController::class, 'about'])->name('restaurant.register');
    Route::get('/register', [RestaurantController::class, 'register'])->name('restaurant.registers');
    Route::post('/create', [RestaurantController::class, 'create'])->name('restaurant.register.create');
    //middleware ROUTES
    Route::middleware(['Restaurant'])->group(function () {

        Route::get('/logout', [RestaurantController::class, 'logout'])->name('restaurant.logout');
        Route::get('/dashboard', [RestaurantController::class, 'dashboard'])->name('restaurant.dashboard');
        Route::get('/profile', [RestaurantController::class, 'profile'])->name('restaurant.profile');
        Route::post('/update', [RestaurantController::class, 'update'])->name('restaurant.update.profile');
        //manage Menus
        Route::get('/menus', [RestaurantController::class, 'menus'])->name('restaurant.menus');
        Route::get('/menu/add', [RestaurantController::class, 'menu_add'])->name('restaurant.menu.add');
        Route::post('/menu/add', [RestaurantController::class, 'menu_store'])->name('restaurant.menu.store');
        Route::post('/menu/update', [RestaurantController::class, 'menu_update'])->name('restaurant.menu.update');
        Route::post('/destroy-menu', [RestaurantController::class, 'menu_destroy'])->name('restaurant.menu.delete');
        //manage Categories
        Route::get('/categories', [RestaurantController::class, 'categories'])->name('restaurant.categories');
        Route::get('/category/add', [RestaurantController::class, 'category_add'])->name('restaurant.category.add');
        Route::post('/category/add', [RestaurantController::class, 'category_store'])->name('restaurant.category.store');
        Route::post('/category/update', [RestaurantController::class, 'category_update'])->name('restaurant.category.update');
        Route::post('/destroy-category', [RestaurantController::class, 'category_destroy'])->name('restaurant.category.delete');
        //manage Plats
        Route::get('/plats', [RestaurantController::class, 'plats'])->name('restaurant.plats');
        Route::get('/plat/add', [RestaurantController::class, 'plat_add'])->name('restaurant.plat.add');
        Route::post('/plat/add', [RestaurantController::class, 'plat_store'])->name('restaurant.plat.store');
        Route::post('/plat/update', [RestaurantController::class, 'plat_update'])->name('restaurant.plat.update');
        Route::post('/destroy-plat', [RestaurantController::class, 'plat_destroy'])->name('restaurant.plat.delete');
        // CHat Manage
        Route::get('/chat', [RestaurantController::class, 'chat_dashboard'])->name('restaurant.chat.dashboard');
        Route::get('/chat/{id}', [RestaurantController::class, 'chat'])->name('restaurant.chat');
        //Restaurant Notification
        Route::get('/mark-as-read/{id}', [RestaurantController::class, 'mark_as_read'])->name('restaurant.mark_as_read');
        Route::get('/notifications', [RestaurantController::class, 'notifications'])->name('restaurant.notifications');
        // Commandes
        Route::get('/orders', [RestaurantController::class, 'list_commandes'])->name('restaurant.orders');
        Route::get('/orders/details/{id}', [RestaurantController::class, 'details_commandes'])->name('restaurant.orders.details');
        Route::get('/orders/{order_id}/comment', [CommentController::class, 'show_comment_to_restaurant'])->name('restaurant.orders.comment');
        // Payment settings keys
        Route::get('/payment-settings', [PaymentController::class, 'set_payment_keys'])->name('restaurant.payment.keys');
        Route::post('/payment-settings', [PaymentController::class, 'handle_payment_keys'])->name('restaurant.handle_payment_keys');
    });
});

/*-----------------------------End Restaurant routes----------------------------- */

/*------------------------------Client routes----------------------------------- */
Route::prefix('client')->group(function () {

    //Auth ROUTES
    Route::get('/login', [ClientController::class, 'login'])->name('client_login_form');
    Route::post('/connect', [ClientController::class, 'connect'])->name('client.login');
    Route::get('/register', [ClientController::class, 'register'])->name('client.register');
    Route::post('/create', [ClientController::class, 'create'])->name('client.register.create');

    Route::get('/restaurant/{id}/plats', [ClientController::class, 'plats_of_this_restaurant'])->name('client.plats_of_this_restaurant');
    Route::get('/restaurant/plat/{id}', [ClientController::class, 'show_plat'])->name('client.show_plat');

    //Maps Restaurants show
    Route::get('/restaurants/maps/', [MapsController::class, 'show_restaurants_on_maps'])->name('client.show_maps');
    Route::post('/restaurants/maps/', [MapsController::class, 'maps_restaurants'])->name('client.maps');

    //middleware ROUTES
    Route::middleware(['Client'])->group(function () {

        Route::get('add-to-cart/{plat_id}', [ClientController::class, 'addToCart'])->name('client.add_to_cart');
        Route::get('cart/', [ClientController::class, 'cart'])->name('client.cart');
        Route::patch('update-cart/', [ClientController::class, 'update_cart'])->name('update_cart');
        Route::delete('remove-from-cart/', [ClientController::class, 'remove_from_cart'])->name('remove_from_cart');

        Route::post('init-payment', [PaymentController::class, 'initPayment'])->name('client.initPayment');
        Route::get('commande-success', [ClientController::class, 'commande_success'])->name('client.commande_success');
        Route::get('thanks', [ClientController::class, 'thanks'])->name('client.order.thanks');
        Route::get('commande', [ClientController::class, 'lister_commandes'])->name('client.commandes.list');
        Route::get('/{id}/generate-commande-pdf', [ClientController::class, 'generate_commande_pdf'])->name('client.generate_commande_pdf');
        Route::get('commande/{id}/details', [ClientController::class, 'details_commandes'])->name('client.commandes.details');

        Route::get('/{order_id}/comment', [CommentController::class, 'order_comment'])->name('client.commandes.comment');
        Route::post('/comment', [CommentController::class, 'store'])->name('client.commandes.store_comment');
        Route::get('/{comment_id}/update-comment', [CommentController::class, 'edit'])->name('client.commandes.edit_comment');
        Route::post('/update-comment', [CommentController::class, 'update'])->name('client.commandes.update_comment');


        // CHat Manage
        Route::get('/chat', [ClientController::class, 'chat_dashboard'])->name('client.chat.dashboard');
        Route::get('/chat/{id}', [ClientController::class, 'chat'])->name('client.chat');

        Route::get('/logout', [ClientController::class, 'logout'])->name('client.logout');
        Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
        Route::get('/profile', [ClientController::class, 'profile'])->name('client.profile');
        Route::post('/update', [ClientController::class, 'update'])->name('client.update.profile');
    });
});
/*-----------------------------End Client routes-------------------------------- */

/*------------------------------admin routes----------------------------------- */
Route::prefix('admin')->group(function () {
    //Auth ROUTES
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login_form');
    Route::post('/connect', [AdminController::class, 'connect'])->name('admin.login');
    Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.register.create');
    //middleware ROUTES
    Route::middleware(['Admin'])->group(function () {

        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('/profile', [AdminController::class, 'profile_update'])->name('admin.profile_update');
        //manage restaurants
        Route::get('/restaurants', [RestaurantController::class, 'restaurants'])->name('Admin.restaurants');
        Route::get('/restaurants/add', [AdminController::class, 'restaurant_add'])->name('Admin.restaurants.add');
        Route::post('/restaurant/create', [AdminController::class, 'restaurant_save'])->name('Admin.restaurant.save');
        Route::post('/update-restaurant', [RestaurantController::class, 'update'])->name('restaurant.update');
        Route::post('/destroy-restaurant', [RestaurantController::class, 'destroy'])->name('restaurant.delete');
        //manage clients
        Route::get('/clients', [ClientController::class, 'clients'])->name('Admin.clients');
        Route::get('/clients/add', [AdminController::class, 'client_add'])->name('Admin.client.add');
        Route::post('/client/create', [AdminController::class, 'client_save'])->name('Admin.client.save');
        Route::post('/update-client', [ClientController::class, 'update'])->name('client.update');
        Route::post('/destroy-client', [ClientController::class, 'destroy'])->name('client.delete');
        //Admin Notification
        Route::get('/mark-as-read/{id}', [AdminController::class, 'mark_as_read'])->name('admin.mark_as_read');
        Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
        Route::get('/active-restaurant/{notification}/{id}', [AdminController::class, 'active_restaurant'])->name('admin.active_restaurant');
        Route::get('/refuse-restaurant/{notification}/{id}', [AdminController::class, 'refuse_restaurant'])->name('admin.refuse_restaurant');
        // Payment settings keys
        Route::get('/payment-mode', [PaymentController::class, 'payment_environment'])->name('admin.payment_environment');
        Route::post('/payment-mode', [PaymentController::class, 'handle_payment_environment'])->name('admin.handle_payment_environment');
    });
});
/*-----------------------------End admin routes-------------------------------- */



//Common routes
Route::get('/', function () {
    $restaurants = Restaurant::where('is_verified', '=', '1')->inRandomOrder()->limit(5)->get();
    $plats = Plat::where('status', '=', '1')->inRandomOrder()->limit(5)->get();
    //dd($restaurants);
    return view('index', compact("restaurants", "plats"));
})->name('home');

Route::get('/restaurants', [HomeController::class, 'restaurants'])->name('view_all');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';