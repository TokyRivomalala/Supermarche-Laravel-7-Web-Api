<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Fonction extends Model
{
    //
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
}
