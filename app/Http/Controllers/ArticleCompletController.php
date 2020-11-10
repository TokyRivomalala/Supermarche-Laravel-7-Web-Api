<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use App\ArticleComplet;

class ArticleCompletController extends Controller
{
    //
    public function select(Request $request){
        try{

            $code = $request->input('code');
            $designation = $request->input('designation');
            $pu = $request->input('pu');
            $stock = $request->input('stock');
            $orderBy = $request->input('orderBy');
            $order = $request->input('order');

            $query = $request->all();

            $data = array (
                'code' => $code,
                'designation' => $designation,
                'pu' => $pu,
                'stock' => $stock,
                'orderBy' => $orderBy,
                'order' => $order,
            );

            $art = new ArticleComplet();
            $res['article'] = $art->select($data);
            $res['query'] = $query;
            //dd($res['article']);
            return view('accueil/accueil',$res);
        }
        catch(Exception $ex){
            dd($ex->getMessage());
        }
        //return view('accueil/utilisateurView', $res);
    }
}
