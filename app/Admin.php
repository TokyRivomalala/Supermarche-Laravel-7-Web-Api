<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Exception;

use App\Fonction;

class Admin extends Model
{
    //
    protected $table = 'admins';
    protected $fillable = ['idadmin','email','mdp','token','tokenexpiration'];

    public function checkLogin($admin){
        try{
            $email = $admin['email'];
            $mdp = $admin['mdp'];
            $res = Admin::
                    where('email', '=' ,  $email)
                    ->where('mdp' , '=' , $mdp )
                    ->get();
            if(count($res) == 0){
                throw new Exception ('Erreur d\'authentification');
            }
            return $res;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }


    //API

    public function checkLoginApi($admin){
        try{
            $email = $admin['email'];
            $mdp = $admin['mdp'];
            $res = Admin::where('email', '=' ,  $email)
                        ->where('mdp' , '=' , $mdp )
                        ->get();
            if(count($res) == 0){
                throw new Exception ('Erreur d\'authentification');
            }

            $token = Admin::setTokenAdminApi($email,$mdp);

            return $token;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function setTokenAdminApi($email,$mdp){
        try{

            $fonction = new Fonction();

            $token = $fonction->generateToken($email,$mdp);

            Admin::where('email', $email)
                          ->update($token);
            
            return $token;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function checkTokenValidApi($token){
        
        try{
            if(!isset($token)){
                throw new Exception ("Veuiller d'abord vous connecter .");
            }
            else{
                $fonction = new Fonction(); 

                $now = $fonction->dateNow();

                $res = Admin::where('token', '=' ,  $token)
                            ->where('tokenexpiration' , '>=' , $now )
                            ->get();

                if(sizeof($res) == 0 ){
                    throw new Exception("Veuiller d'abord vous connecter");
                }
                else{
                    return $res;
                }
            }
        }catch(Exception $ex){
            throw $ex;
        }

    }
}
