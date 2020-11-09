<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;

use App\Article;
use App\Remise;
use App\StockArticle;
use App\ArticleComplet;

class ArticleController extends Controller
{
    //
    public function insert(Request $request){
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

    public function delete($id){
        try{

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

    public function update($id){
        try{
            $artCompl = new ArticleComplet();
            $res['articles'] = $artCompl->selectById($id);
            $res['article'] = $artCompl->select();
            return view('accueil/accueil',$res);
        }
        catch(Exception $ex){
            $res['erreur'] = $ex->getMessage();

            $art = new ArticleComplet();
            $res['article'] = $art->select();
            
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

            $stkArt = new StockArticle();
            $artCompl = new ArticleComplet();

            $stkArt->updateStockArticle($id,$pu);
            $res['article'] = $artCompl->select();
            return redirect()->route('allArticle');
        }
        catch(Exception $ex){
            $res['erreur'] = $ex->getMessage();

            $art = new ArticleComplet();
            $res['article'] = $art->select();
            
            return view('accueil/accueil',$res);
        }
    }
}