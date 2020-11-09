<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Exception;

use App\ArticleComplet;

class AdminController extends Controller
{
    //
    public function index(){

        return view('login/loginView');
    }

    public function checkLogin(Request $request){
        try{
            $email = $request->input('email');
            $mdp = $request->input('mdp');
            $data = array (
                'email' => $email,
                'mdp' => $mdp
            );
            $adm = new Admin();
            $res['admin'] = $adm->checkLogin($data);
            //dd($res['admin']);
            return redirect()->route('allArticle');
        }
        catch(Exception $ex){
            $res['erreur'] = $ex->getMessage();

            $art = new ArticleComplet();
            $res['article'] = $art->select();
            
            return view('login/loginView',$res);
        }
        //return view('accueil/utilisateurView', $res);
    }
}
