<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ManageRoute;

class UserManagementController extends Controller
{
    public function index()
    {
        $data['roles'] = DB::select("SELECT * FROM user_roles");
        $data['all_menu'] = DB::select("SELECT * FROM menu");
        return view('manage_route.all_menu_and_sub_menu',$data);
    }

    public function store_user_management(Request $request)
    {
        // dd($request->all());

        // menu
        $menu = $request->menu;
        $menu_value = "";

        for ($i=0; $i < count($menu); $i++) {
            $menu_value .=$menu[$i].",";
        }

        $menu_val = rtrim($menu_value,',');

        // sub menu
        $sub_menu = $request->sub_menu;
        $sub_menu_value = "";

        for ($i=0; $i < count($sub_menu); $i++) {
            $sub_menu_value .=$sub_menu[$i].",";
        }

        $sub_menu_val = rtrim($sub_menu_value,',');

        // dd($sub_menu_val);

        $manae_routes = new ManageRoute();
        $manae_routes->role = $request->role_name;
        $manae_routes->menu_id = $menu_val ;
        $manae_routes->sub_menu_id = $sub_menu_val;
        $manae_routes->save();

        return back()->with('success', 'Success');
    }
}
