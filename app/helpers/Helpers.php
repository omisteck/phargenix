<?php 

namespace App\Helpers;

use App\Models\Purchase;
use App\Models\Reconcile;
use App\Models\Sales;
use App\Models\Sales_Return;
use App\Models\Transfer;
use Carbon\Carbon;
use Keygen\Keygen;

class Helpers{

    static public function check_organization_setup(){
        $user = auth()->user();

        if( !empty($user) && !empty($user->organization)){
            return true;
        }elseif( !empty($user) && empty($user->organization) && $user->level == 'admin' ){
            return false;
        }else{
            return redirect()->route('home')->with('error', 'Please setup your business and branches');
        }
        
    }

    static public function get_instore_value($product){
        $purchases = Purchase::where("product->id", $product)->sum("qty");
        $transfer_in = Transfer::where("to_product->id", $product)->sum("qty");
        $transfer_out = Transfer::where("from_product->id", $product)->sum("qty");
        
        $reconcile_in = Reconcile::where("data->id", $product)->where('type', 'in')->sum("qty");
        $reconcile_out = Reconcile::where("data->id", $product)->where('type', 'out')->sum("qty");
        $sales = Sales::where("data->id", $product)->sum("qty");
        $return_sales = Sales_Return::where("data->id", $product)->sum("qty");
        // dd($sales);
        return (($purchases + $transfer_in + $reconcile_in) -( $transfer_out + $reconcile_out + $sales ));
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