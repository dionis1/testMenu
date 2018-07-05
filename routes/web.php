<?php
use Harimayco\Menu\Facades\Menu;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {
    
   

	$menulist = Menus::all();
    
    if(isset($request->menu)){
    	$menu = new MenuItems();
        $id = $request->menu;

        $menus = $menu->getall($id);

        $idmenu = Menus::findorfail($id);
        
    }
    

    return view('vendor.harimayco-menu.menu-html', compact('menulist','menus','idmenu'));
});


Route::any('/store','HomeController@store')->name('store');

Route::any('/add','HomeController@add')->name('add');


Route::any('/update', function (Request $request) {

   

   if(isset($request->arraydata))
   {
     
   	 foreach ($request->arraydata as $data) {

  	    $menuitems = MenuItems::findorfail($data['id']);
		
		if(isset($data['label'])) 
		{
			$menuitems->label =	$data['label'];
		} 

		if(isset($data['class'])) 
		{
			$menuitems->class =	$data['class'];
		}

		if(isset($data['link'])) 
		{
			$menuitems->link =	$data['link'];
		}     
     }
   

   	$menuitems->update();

    return response()->json(200);
   
   }else{
     
      $menuitems = MenuItems::findorfail($request->id);
		
		if(isset($request->label)) 
		{
			$menuitems->label =	$request->label;
		} 

		if(isset($request->class)) 
		{
			$menuitems->class =	$request->class;
		}

		if(isset($request->link)) 
		{
			$menuitems->link =	$request->link;
		}          

	    $menuitems->update();

	    return response()->json(200);
   }
   
    

    
})->name('update');

Route::any('/updatemenu', function (Request $request) 
{
    

    foreach ($request->arraydata as $data) {
    	
		$menuitems = MenuItems::findorfail($data['id']);
		
		if(isset($data['depth'])) 
		{
			$menuitems->depth =	$data['depth'];
		} 

		if(isset($data['parent'])) 
		{
			$menuitems->parent =	$data['parent'];
		}

		if(isset($data['sort'])) 
		{
			$menuitems->sort =	$data['sort'];
		}

	    $menuitems->update();

    }

    $menu = Menus::findorfail($request->idmenu);
    
    if(isset($request->name)) 
	{
		$menu->name =	$request->menuname;
	}

	$menu->update();


    return response()->json(200);
   
})->name('updatemenu');


Route::any('/delete', function (Request $request) {
    
     $menu = Menus::findorfail($request->id);
     $menu->delete();

    
    return response()->json('Menu successfully deleted');
	
})->name('delete');


Route::any('/deleteitem', function (Request $request) {
    
     $menuitem = MenuItems::findorfail($request->id);
     $menuitem->delete();

    
    return response()->json(200);
	
})->name('deleteitem');