<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Exception;

class StockArticle extends Model
{
    //
    protected $table = 'stockarticles';
    protected $fillable = ['idarticle','quantitestock','prixunitaire'];

    protected $primaryKey = null;
    public $incrementing = false;

    public function insert($data){
        try{
            $stkArt = new StockArticle();

            $stkArt->idarticle = $data['idarticle'];
            $stkArt->quantitestock = $data['quantitestock'];
            $stkArt->prixunitaire = $data['prixunitaire'];
            
            $stkArt->save();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function deleteStockArticle($id){
        try{
            StockArticle::where('idarticle','=' , $id)->delete();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function updateStockArticle($id,$pu){
        try{
            StockArticle::updateException($id,$pu);
            
            StockArticle::where('idarticle', $id)
                          ->update(['prixunitaire' => $pu]);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function updateException($id,$pu){
        try{
            $fonction = new Fonction();
            if($fonction->IsNullOrEmptyString($id) || $fonction->IsNullOrEmptyString($pu)){
                throw new Exception("Veuiller remplir le formulaire");
            }
            if($pu <= 0){
                throw new Exception("Prix Unitaire Invalide");
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}
