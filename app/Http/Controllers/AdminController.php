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

            $request->session()->put('admin',$data);

            return redirect()->route('allArticle');          
        }
        catch(Exception $ex){
            $res['erreur'] = $ex->getMessage();
            
            return view('login/loginView',$res);
        }   
    }

    public function deconnexion(Request $request){

        $request->session()->forget('admin');
        return redirect('login');
    }

    public function deconnexionApi(Request $request){

        $request->session()->forget('admin');

        return response()->json([
            'message' => 'Deconnexion ok !' ,
            'erreur' => ''
        ], 200);

        return redirect('login');
    }

    public function checkLoginApi(Request $request){
        try{
            $email = $request->input('email');
            $mdp = $request->input('mdp');
            $data = array (
                'email' => $email,
                'mdp' => $mdp
            );
            $adm = new Admin();
            $res['admin'] = $adm->checkLogin($data);

            return response()->json([
                'message' => 'Login ok !' ,
                'admin' => $res['admin'],
                'erreur' => ''
            ], 200);
      
        }
        catch(Exception $ex){
            $res['erreur'] = $ex->getMessage();
            
            return response()->json([
                'message' => 'Login failed',
                'erreur' => $res['erreur']
            ], 400);
        }   
    }
}
