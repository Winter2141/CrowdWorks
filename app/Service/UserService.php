<?php

namespace App\Service;

use App\Models\User;
use Auth;
use DB;

class UserService {

    public static function doSearch($search_params)
    {
        $users = User::whereNull('deleted_at');
        if(isset($search_params['name'])) {
            $users = $users->where('name', 'like', '%' . $search_params['name'] . '%');
        }

        /*
         * Add Search Conditions
         */
        return $users;
    }

    public static function doUpdate($user, $data) {
        $user->name = $data['name'];
        /*
         * Add User Data
         */

        if ($user->save() ) {
            return true;
        } else {
            return false;
        }
    }

    public static function doDelete($id) {
        $user = User::findOrFail($id);
        if($user->delete()) {
            return true;
        } else {
            return false;
        }
    }

}