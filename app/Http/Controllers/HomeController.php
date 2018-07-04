<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use Harimayco\Menu\Facades\Menu;

class HomeController extends Controller
{
    public function store(Request $request)
    {   
        $menu = new Menus();

        $menu->name = $request->menuname;

        $menu->save();

        return response()->json([$menu, 200]);
    }

    public function add(Request $request)
    {   
        
        $menuitem = new MenuItems();

        $menuitem->label = $request->labelmenu;

        $menuitem->link = $request->linkmenu;

        $menuitem->menu = $request->idmenu;

        $menuitem->save();

        return response()->json([$menuitem, 200]);
    }
}
