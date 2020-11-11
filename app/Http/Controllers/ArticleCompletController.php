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
            
            if(!$request->session()->has('admin')){
                $data['erreur'] = "Veuiller d'abord vous connecter";
                return view('login/loginView',$data);
            }

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

    public function selectApi(Request $request){
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

            return response()->json([
                'message' => 'Article Trouvé(s) !' ,
                'admin' => $res,
                'erreur' => ''
            ], 200);
        }
        catch(Exception $ex){

            return response()->json([
                'message' => 'Erreur Select Article',
                'erreur' => $ex->getMessage()
            ], 400);
        }
    }
}
