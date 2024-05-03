<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\String_;

class CommonLoaderController extends Controller
{
    /**
     * load carousel categori
     */
    public function loadSlider(){
        $today = date('Y-m-d');
        $data = DB::table('sliders')
        ->where('active_date', '<=', $today)
        ->where('flag','=','Y')
        ->orderBy('active_date', 'desc')
        ->get();
        return $data;
    }

    /**
     * load carousel by kategori
     */
    public function loadCarouselCategory(Request $req){
        
        $collectionId = $req->collection_id;
        $data = DB::table('product_models')
        ->where('product_collection','=', $collectionId)
        ->orderBy('id', 'asc')
        ->get();

        $discounts = $this->getActiveDiscount();

        foreach ($data as $item) {

            $item->product_price_after_disc = $item->product_price;
            $id = $item->id;
            $filteredDiscount = Arr::where($discounts, function ($value, $key) use ($id){
                return $value->product_id == $id;
            }); 
            
            if (count($filteredDiscount) > 0){
                foreach ($discounts as $discount){
                    $item->st_discount = $discount->discount;
                    $priceAfterDisc = ($item->product_price) - (($item->product_price) * ($discount->discount) / 100);
                    $item->product_price_after_disc = round($priceAfterDisc, 2, PHP_ROUND_HALF_UP);
                }
            }
        }

        return $data;
    }

    /**
     * load product data pada halaman coffe
     */
    public function loadProductData(Request $req){
        
        $isHasCollectionFilter = $req->collection != null && $req->collection != "all";
        $isHasFormFilter       = $req->form != null && $req->form != "all";
        $isHasSortingFilter    = $req->sorting != null && $req->sorting != "all";

        $extendedSql = "WHERE deleted = 'false' ";
        if ($isHasCollectionFilter)
            $extendedSql .= "AND product_collection = '".$req->collection."' ";
        if ($isHasFormFilter)
            $extendedSql .= "AND product_form = '".$req->form."' ";
        if ($isHasSortingFilter)
            $extendedSql .= $this->getSortingSqlProduct($req->sorting);

        $products = DB::select("SELECT * FROM product_models ".$extendedSql."");
        $discounts = $this->getActiveDiscount();

        foreach ($products as $item) {

            $item->product_price_after_disc = $item->product_price;
            $id = $item->id;
            $filteredDiscount = Arr::where($discounts, function ($value, $key) use ($id){
                return $value->product_id == $id;
            }); 
            
            if (count($filteredDiscount) > 0){
                foreach ($discounts as $discount){
                    $item->st_discount = $discount->discount;
                    $priceAfterDisc = ($item->product_price) - (($item->product_price) * ($discount->discount) / 100);
                    $item->product_price_after_disc = round($priceAfterDisc, 2, PHP_ROUND_HALF_UP);
                }
            }
        }

        return $products;
    }

    private function getSortingSqlProduct($id) {

        // tambahkan 1 array disini jika menambahkan kategori sorting & sql nya
        $arrSorting = [
            ["id" => "latest", "sql" => "ORDER BY id DESC"],
            ["id" => "price_high_low", "sql" => "ORDER BY product_price DESC"],
            ["id" => "price_low_high", "sql" => "ORDER BY product_price DESC"]
        ];

        $arrSortingSelected = Arr::where($arrSorting, function($value, $key) use ($id) {
            return $value['id'] == $id;
        });

        if (count($arrSortingSelected) > 0){
            foreach ($arrSortingSelected as $sort) {
                return $sort['sql'];
            }
        }

        return "";
    }

    private function getActiveDiscount(){
        $discounts = DB::select("SELECT 
            dm.product_id,
            dm.discount 
            FROM discount_models dm 
            INNER JOIN (
                SELECT 
                id 
                FROM discount_cluster_models dcm 
                WHERE date(now()) >= active_date AND date(now()) <= active_date
                AND status = 'active'
            ) dcm ON dm.discount_cluster_id = dcm.id 
            WHERE dm.status = 'active'");
        return $discounts;
    }
}
