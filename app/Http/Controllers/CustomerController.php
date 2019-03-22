<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index(){
        /*$customers = Customer::all();
        return view("customer.index")->with('customers', $customers);*/
        //$sellers = Seller::all()->sortByDesc('NOMVEN')->pluck('NOMVEN', 'CODVEN');
        $sellers = Seller::all()->sortByDesc('NOMVEN');//->pluck('NOMVEN', 'CODVEN');

        //dd($sellers);
        return view("customer.index")->with('sellers', $sellers);
    }

    public function getData(Request $req){
        $codSeller = $req->query('codSeller');
        $customers = [];
        if($codSeller == 'ALL'){
            $customers = Customer::all();
        } else {
            $customers = Customer::query()->where('CODVEN', $codSeller);
        }

        return DataTables::of($customers)->make(true);
    }

    public function get(Request $req, Response $res){
        $customers = Customer::all();
        return response()->json($customers, 200);
    }
}
