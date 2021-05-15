<?php 

namespace App\Helpers;

class Helpers{

    static public function check_organization_setup(){
        $user = auth()->user();
        if( $user->level == 'admin' && !empty($user->organization)){
            return true;
        }
        return false;
    }
}
?>