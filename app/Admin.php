<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Exception;

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
}
