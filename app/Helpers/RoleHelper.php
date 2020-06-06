<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class RoleHelper
{
    public static function checkPermission($url, $role)
    {
        $query = "SELECT * FROM (
            SELECT mp.menu_id AS link_id, m.route, m.name
            FROM menu_permissions mp
            INNER JOIN menu m
            ON mp.menu_id = m.id
            WHERE mp.role_id = ".$role."
            AND mp.is_menu = 1
            UNION
            SELECT mp.submenu_id AS link_id,m.route, m.sub_menu_name as name
            FROM menu_permissions mp
            INNER JOIN sub_menu m
            ON mp.submenu_id = m.id
            WHERE mp.role_id = ".$role."
            AND mp.is_menu = 0
            ) AS t WHERE    '".$url."' LIKE CONCAT('%', t.route, '%')";
        $result = DB::select($query);
        if($result){
            //return $result[0]->link_id;
            return 'grant';
        }
        else{
            return "block";
        }
        
    }
}