<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use DateTime;
use DateTimeZone    ;

class Fonction extends Model
{
    //

    public STATIC $now = "";

    public function getSeq($identifiant,$seq){
        $res = DB::select("SELECT lpad(nextval('".$seq."')::text,2,'0')");
        $res = $res[0]->lpad;
        return $res;
    }

    public function IsNullOrEmptyString($str){
        return (!isset($str) || trim($str) === '');
    }

    public function dateNow(){
        $dt = new DateTime();
        $dt->setTimezone(new DateTimeZone('Indian/Antananarivo'));
        return $dt->format('Y-m-d H:i:s');
    }

    public function strToDateTime($dateStr){
        $date = strtotime($dateStr); 
        return date('Y-m-d H:i:s', $date);
    }

    public function bearerToken(){
        $header = $this->header('Authorization', '');
        if (Str::startsWith($header, 'Bearer ')) {
                    return Str::substr($header, 7);
        }
    }

    public function generateToken($email,$mdp){

        $fonction = new Fonction();
        if($fonction->IsNullOrEmptyString(Fonction::$now)){
            Fonction::$now = $fonction->dateNow();
        }
        $token = sha1($email.$mdp.Fonction::$now);
        $expiration = $fonction->getTokenExpiration();
        $data = array(
            'token' => $token,
            'tokenexpiration' => $expiration
        );
        return $data;
    }

    public function getTokenExpiration(){

        $expiration = date('Y-m-d H:i:s', strtotime(Fonction::$now . ' +30 minutes'));
        Fonction::$now = null;
        return $expiration;
    }

    public function getNow(){
        return Fonction::$now;
    }
}
