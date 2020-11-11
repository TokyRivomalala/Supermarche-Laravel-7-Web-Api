<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;

use App\Admin;
use App\Article;
use App\Remise;
use App\StockArticle;
use App\ArticleComplet;

class ArticleController extends Controller
{
    //
    public function insert(Request $request){
        try{

            if(!$request->session()->has('admin')){
                $data['erreur'] = "Veuiller d'abord vous connecter";
                return view('login/loginView',$data);
            }

            $code = $request->input('code');
            $designation = $request->input('designation');
            $pu = $request->input('pu');
            $stock = $request->input('stock');

            $data = array (
                'code' => $code,
                'designation' => $designation,
                'pu' => $pu,
                'stock' => $stock
            );

            $art = new Article();
            $res['article'] = $art->insertComplet($data);
            //dd($res['article']);
            return redirect()->route('allArticle');
        }
        catch(Exception $ex){
            $res['erreur'] = $ex->getMessage();

            $art = new ArticleComplet();
            $res['article'] = $art->select();

            return view('accueil/accueil',$res);
        }
    }

    public function delete(Request $request, $id){
        try{

            if(!$request->session()->has('admin')){
                $data['erreur'] = "Veuiller d'abord vous connecter";
                return view('login/loginView',$data);
            }

            $art = new Article();
            $res['article'] = $art->deleteComplet($id);
            return redirect()->route('allArticle');
        }
        catch(Exception $ex){
            $res['erreur'] = $ex->getMessage();

            $art = new ArticleComplet();
            $res['article'] = $art->select();
            
            return view('accueil/accueil',$res);
        }
    }

    public function update(Request $request, $id){

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

        try{

            if(!$request->session()->has('admin')){
                $data['erreur'] = "Veuiller d'abord vous connecter";
                return view('login/loginView',$data);
            }


            $artCompl = new ArticleComplet();
            $res['articles'] = $artCompl->selectById($id);
            $res['article'] = $artCompl->select($data);
            return view('accueil/accueil',$res);
        }
        catch(Exception $ex){
            $res['erreur'] = $ex->getMessage();

            $art = new ArticleComplet();
            $res['article'] = $art->select($data);
            
            return view('accueil/accueil',$res);
        }
    }

    public function modifier(Request $request){
        try{

            $id = $request->input('idarticle');
            $code = $request->input('code');
            $designation = $request->input('designation');
            $pu = $request->input('pu');
            $stock = $request->input('stock');

            $data = array (
                'code' => $code,
                'designation' => $designation,
                'pu' => $pu,
                'stock' => $stock,
                'idarticle' => $id
            );

            if(!$request->session()->has('admin')){
                $data['erreur'] = "Veuiller d'abord vous connecter";
                return view('login/loginView',$data);
            }


            $stkArt = new StockArticle();
            $artCompl = new ArticleComplet();

            $stkArt->updateStockArticle($id,$pu);

            return redirect()->route('allArticle');
        }
        catch(Exception $ex){
            
            $res['erreur'] = $ex->getMessage();
            $res['article'] = $data;

            return view('accueil/accueil',$res);
        }
    }


    //API

    public function insertApi(Request $request){
        try{

            $code = $request->input('code');
            $designation = $request->input('designation');
            $pu = $request->input('pu');
            $stock = $request->input('stock');

            $data = array (
                'code' => $code,
                'designation' => $designation,
                'pu' => $pu,
                'stock' => $stock
            );

            $admin = new Admin();
            $token = $request->bearerToken();

            $admin->checkTokenValidApi($token);

            $art = new Article();
            $res['article'] = $art->insertCompletApi($data);

            return response()->json([
                'message' => 'Article Insere !' ,
                'article' => $res,
                'erreur' => ''
            ], 200);
        }
        catch(Exception $ex){

            return response()->json([
                'message' => 'Erreur Insert Article',
                'erreur' => $ex->getMessage()
            ], 400);
        }
    }

    public function deleteApi(Request $request, $id){
        try{

            $admin = new Admin();
            $token = $request->bearerToken();

            $admin->checkTokenValidApi($token);

            $art = new Article();
            $res['article'] = $art->deleteCompletApi($id);
            
            return response()->json([
                'message' => 'Article Supprimé !' ,
                'article' => $res,
                'erreur' => ''
            ], 200);
        }
        catch(Exception $ex){
            return response()->json([
                'message' => 'Erreur Delete Article',
                'erreur' => $ex->getMessage()
            ], 400);
        }
    }

    public function modifierApi(Request $request){
        try{

            $id = $request->input('idarticle');
            $code = $request->input('code');
            $designation = $request->input('designation');
            $pu = $request->input('pu');
            $stock = $request->input('stock');

            $data = array (
                'code' => $code,
                'designation' => $designation,
                'pu' => $pu,
                'stock' => $stock,
                'idarticle' => $id
            );

            $admin = new Admin();
            $token = $request->bearerToken();

            $admin->checkTokenValidApi($token);

            $stkArt = new StockArticle();
            $artCompl = new ArticleComplet();

            $stkArt->updateStockArticleApi($id,$pu);
            $res['article'] = $data;
            
            return response()->json([
                'message' => 'Article Modifié !' ,
                'article' => $res,
                'erreur' => ''
            ], 200);
        }
        catch(Exception $ex){

            return response()->json([
                'message' => 'Erreur Update Article',
                'erreur' => $ex->getMessage()
            ], 400);
        }
    }
}
