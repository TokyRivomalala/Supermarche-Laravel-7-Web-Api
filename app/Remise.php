<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Exception;

class Remise extends Model
{
    //
    protected $table = 'remises';
    protected $fillable = ['idarticle','idgratuit','idpourcentage','idgratuitpourcentage'];
    
    protected $primaryKey = null;
    public $incrementing = false;

    public function insert($data){
        try{
            $rem = new Remise();

            $rem->idarticle = $data['idarticle'];
            $rem->idgratuit = $data['idgratuit'];
            $rem->idpourcentage = $data['idpourcentage'];
            $rem->idgratuitpourcentage = $data['idgratuitpourcentage'];
            
            $rem->save();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function deleteRemise($id){
        try{
            Remise::where('idarticle','=' , $id)->delete();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    //API

    public function insertApi($data){
        try{
            $rem = new Remise();

            $rem->idarticle = $data['idarticle'];
            $rem->idgratuit = $data['idgratuit'];
            $rem->idpourcentage = $data['idpourcentage'];
            $rem->idgratuitpourcentage = $data['idgratuitpourcentage'];
            
            $rem->save();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function deleteRemiseApi($id){
        try{
            Remise::where('idarticle','=' , $id)->delete();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

}
