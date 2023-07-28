<?php


namespace App\Services;


class MenuServices
{
    public static function makePermisionsData($selectedMenus)
    {
        $userMenus = explode(",",$selectedMenus);

        $masterMenus = collect(config('constants.menu'));
        $permissions = collect([]);
        foreach ($masterMenus as $menu){
            if(collect($menu['sub_menu'])->whereIn('id',$userMenus)->count()>0){
                $permissions->push($menu['id']);
            }else{
                $userMenus = array_diff($userMenus,array($menu['id']));
            }
        }
        $userPermisssion = $permissions->merge($userMenus);
        return  $userPermisssion->unique()->values()->all();
    }
}
