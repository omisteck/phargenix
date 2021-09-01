<?php 

namespace App\Helpers;

use Carbon\Carbon;
use Keygen\Keygen;
use App\Models\Sales;
use App\Models\Purchase;
use App\Models\Transfer;
use App\Models\Reconcile;
use App\Models\Sales_Return;
use Illuminate\Support\Facades\DB;

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
        $purchases = Purchase::where("product->id", $product)->where('old','!=','true')->sum("qty");
        $transfer_in = Transfer::where("to_product->id", $product)->where('old','!=','true')->sum("qty");
        $transfer_out = Transfer::where("from_product->id", $product)->where('old','!=','true')->sum("qty");
        
        $reconcile_in = Reconcile::where("data->id", $product)->where('type', 'in')->where('old','!=','true')->sum("qty");
        $reconcile_out = Reconcile::where("data->id", $product)->where('type', 'out')->where('old','!=','true')->sum("qty");
        $sales = Sales::where("data->id", $product)->where('old','!=','true')->sum("qty");
        $return_sales = Sales_Return::where("data->id", $product)->where('old','!=','true')->sum("qty");

        return (($purchases + $transfer_in + $reconcile_in + $return_sales) -( $transfer_out + $reconcile_out + $sales ));
    }

    static public function get_product($product,  $branch = NULL){

        if(isset($branch) && $branch != NULL ){
            $branchHolder = $branch;
        }else{
            $branchHolder = session('active_branch')['id'];
        }
        $sql = "SELECT p.*,
        (COALESCE(pc.num,0) + COALESCE(ti.num,0) + COALESCE(ri.num,0) + COALESCE(sr.num,0)) - (COALESCE(s.num,0) + COALESCE(ro.num,0) + COALESCE(tf.num,0)) as instore
        FROM products as p
        LEFT JOIN ( SELECT SUM(sales.qty) num, JSON_EXTRACT(sales.data, '$.\"id\"') product
                    FROM sales  Where old = 'false'
                    GROUP BY product
                  ) s ON p.id = s.product
        LEFT JOIN ( SELECT SUM(purchases.qty) num, JSON_EXTRACT(purchases.product, '$.\"id\"') product
                    FROM purchases  Where old = 'false'
                    GROUP BY product
                  ) pc ON p.id = pc.product
        LEFT JOIN ( SELECT SUM(transfers.qty) num, JSON_EXTRACT(transfers.to_product, '$.\"id\"') product
                    FROM transfers  Where old = 'false'
                    GROUP BY product
                  ) ti ON p.id = ti.product
        LEFT JOIN ( SELECT SUM(transfers.qty) num, JSON_EXTRACT(transfers.from_product, '$.\"id\"') product
                    FROM transfers  Where old = 'false'
                    GROUP BY product
                  ) tf ON p.id = tf.product
        LEFT JOIN ( SELECT SUM(reconciles.qty) num, JSON_EXTRACT(reconciles.data, '$.\"id\"') product
                    FROM reconciles Where reconciles.type = 'in' AND old = 'false'
                    GROUP BY product
                  ) ri ON p.id = ri.product
        LEFT JOIN ( SELECT SUM(reconciles.qty) num , JSON_EXTRACT(reconciles.data, '$.\"id\"') product
                    FROM reconciles Where reconciles.type = 'out' AND old = 'false'
                    GROUP BY product
                  ) ro ON p.id = ro.product
        LEFT JOIN ( SELECT SUM(sales_returns.qty) num , JSON_EXTRACT(sales_returns.data, '$.\"id\"') product
                    FROM sales_returns Where old ='false'
                    GROUP BY product
                  ) sr ON p.id = sr.product
        WHERE p.name LIKE '%".$product."%' AND p.branch_id = ". $branchHolder;
        
        $products = DB::select((DB::raw($sql)));
        return $products;
    }


    static public function search_product($product,  $branch = NULL){
        
        $branchHolder = session('active_branch')['id'];

        $sql = "SELECT p.*,
        (COALESCE(pc.num,0) + COALESCE(ti.num,0) + COALESCE(ri.num,0) + COALESCE(sr.num,0)) - (COALESCE(s.num,0) + COALESCE(ro.num,0) + COALESCE(tf.num,0)) as instore
        FROM products as p
        LEFT JOIN ( SELECT SUM(sales.qty) num, JSON_EXTRACT(sales.data, '$.\"id\"') product
                    FROM sales  Where old = 'false'
                    GROUP BY product
                  ) s ON p.id = s.product
        LEFT JOIN ( SELECT SUM(purchases.qty) num, JSON_EXTRACT(purchases.product, '$.\"id\"') product
                    FROM purchases  Where old = 'false'
                    GROUP BY product
                  ) pc ON p.id = pc.product
        LEFT JOIN ( SELECT SUM(transfers.qty) num, JSON_EXTRACT(transfers.to_product, '$.\"id\"') product
                    FROM transfers  Where old = 'false'
                    GROUP BY product
                  ) ti ON p.id = ti.product
        LEFT JOIN ( SELECT SUM(transfers.qty) num, JSON_EXTRACT(transfers.from_product, '$.\"id\"') product
                    FROM transfers  Where old = 'false'
                    GROUP BY product
                  ) tf ON p.id = tf.product
        LEFT JOIN ( SELECT SUM(reconciles.qty) num, JSON_EXTRACT(reconciles.data, '$.\"id\"') product
                    FROM reconciles Where reconciles.type = 'in' AND old = 'false'
                    GROUP BY product
                  ) ri ON p.id = ri.product
        LEFT JOIN ( SELECT SUM(reconciles.qty) num , JSON_EXTRACT(reconciles.data, '$.\"id\"') product
                    FROM reconciles Where reconciles.type = 'out' AND old = 'false'
                    GROUP BY product
                  ) ro ON p.id = ro.product
        LEFT JOIN ( SELECT SUM(sales_returns.qty) num , JSON_EXTRACT(sales_returns.data, '$.\"id\"') product
                    FROM sales_returns Where old ='false'
                    GROUP BY product
                  ) sr ON p.id = sr.product
        WHERE p.name LIKE '%".$product."%' AND p.branch_id = ". $branchHolder;
        
        $products = DB::select((DB::raw($sql)));
        return $products;
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