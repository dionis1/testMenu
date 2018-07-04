<?php
use Harimayco\Menu\Facades\Menu;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
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

Route::get('/', function () {
	$menulist = Menus::select('id','name')->get();
	$menus = MenuItems::all();
    return view('vendor.harimayco-menu.menu-html', compact('menulist','menus'));
});


Route::any('/store','HomeController@store')->name('store');

Route::any('/add','HomeController@add')->name('add');
