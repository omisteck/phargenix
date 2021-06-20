<?php 

namespace App\Helpers;

use App\Models\Sales;
use Carbon\Carbon;
use Keygen\Keygen;

class Helpers{

    static public function check_organization_setup(){
        $user = auth()->user();
        if( $user->level == 'admin' && !empty($user->organization)){
            return true;
        }
        return false;
    }

    static public function get_instore_value($product){
        return 20;
    }

    static protected function generateNumericKey()
{
    // prefixes the key with a random integer between 1 - 9 (inclusive)
    return Keygen::numeric(9)->prefix(mt_rand(1, 9))->generate(true);
}

static public function generateInvoiceNumber()
{
    $id = static::generateNumericKey();

    // Ensure ID does not exist
    // Generate new one if ID already exists
    // while (Sales::whereId($id)->count() > 0) {
    //     $id = static::generateNumericKey();
    // }

    return $id;
}

static public function shift(){
    $current_time = Carbon::now();
    // check if the current time is not past two
    if($current_time->hour <= 14){
        return "Morning";
    }else{
        return "Afternoon";
    }
}

static public function get_shift(){
    return session('shift');
}

static public function active_branch(){
    return session('active_branch');
}

}
?>