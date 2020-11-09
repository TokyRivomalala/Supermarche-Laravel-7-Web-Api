<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use App\ArticleComplet;

class ArticleCompletController extends Controller
{
    //
    public function select(){
        try{
            $art = new ArticleComplet();
            $res['article'] = $art->select();
            //dd($res['article']);
            return view('accueil/accueil',$res);
        }
        catch(Exception $ex){
            dd($ex->getMessage());
        }
        //return view('accueil/utilisateurView', $res);
    }
}
