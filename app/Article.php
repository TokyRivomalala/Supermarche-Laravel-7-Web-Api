<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Fonction;
use App\Remise;
use App\StockArticle;

use DB;

use Exception;

class Article extends Model
{
    //
    protected $table = 'articles';
    protected $fillable = ['idarticle','designation','code'];
    protected $primaryKey = 'idarticle';

    public function getCode($code){
        $res = Article::where("code" , "=" , $code )->get();
        return $res;
    }

    public function insertException($code,$designation,$pu,$stock){
        try{
            $fonction = new Fonction();
            if($fonction->IsNullOrEmptyString($code) || $fonction->IsNullOrEmptyString($designation) || $fonction->IsNullOrEmptyString($pu) || $fonction->IsNullOrEmptyString($stock)){
                throw new Exception("Veuiller remplir le formulaire");
            }
            if($pu <= 0){
                throw new Exception("Prix Unitaire Invalide");
            }
            if($stock <= 0){
                throw new Exception("Stock Invalide");
            }
    
            $checkCode = Article::getCode($code);
            if(count($checkCode) != 0){
                throw new Exception("Ce nom de code est deja pris");
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function insertComplet($data){
        try{
            $code = $data['code'];
            $designation = $data['designation'];
            $pu = $data['pu'];
            $stock = $data['stock'];

            Article::insertException($code,$designation,$pu,$stock);

            $fonction = new Fonction();
            $idArticle = 'ART'.$fonction->getSeq('ART','article_seq');

            $article = array (
                'idarticle' => $idArticle,
                'designation' => $designation,
                'code' => $code
            );

            $stockArticle = array(
                'idarticle' => $idArticle,
                'quantitestock' => $stock,
                'prixunitaire' => $pu
            );  

            $remise = array(
                'idarticle' => $idArticle,
                'idgratuit' => 'GRT01',
                'idpourcentage' => 'PRC01',
                'idgratuitpourcentage' => 'GRP01'
            );
            
            
            $art = new Article();
            $stkArt = new StockArticle();
            $rem = new Remise();

            $art->insert($article);
            $stkArt->insert($stockArticle);
            $rem->insert($remise);

            return $data;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function insert($data){
        try{
            $article = new Article();

            $article->idarticle = $data['idarticle'];
            $article->code = $data['code'];
            $article->designation = $data['designation'];

            $article->save();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function deleteArticle($id){
        try{
            Article::where('idarticle','=' , $id)->delete();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function deleteComplet($id){
        try{

            //Article::insertException($code,$designation,$pu,$stock);
            
            $art = new Article();
            $stkArt = new StockArticle();
            $rem = new Remise();

            $rem->deleteRemise($id);
            $stkArt->deleteStockArticle($id);
            $art->deleteArticle($id);

            return $id;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    //API

    public function getCodeApi($code){
        $res = Article::where("code" , "=" , $code )->get();
        return $res;
    }

    public function insertExceptionApi($code,$designation,$pu,$stock){
        try{
            $fonction = new Fonction();
            if($fonction->IsNullOrEmptyString($code) || $fonction->IsNullOrEmptyString($designation) || $fonction->IsNullOrEmptyString($pu) || $fonction->IsNullOrEmptyString($stock)){
                throw new Exception("Veuiller remplir le formulaire");
            }
            if($pu <= 0){
                throw new Exception("Prix Unitaire Invalide");
            }
            if($stock <= 0){
                throw new Exception("Stock Invalide");
            }
    
            $checkCode = Article::getCode($code);
            if(count($checkCode) != 0){
                throw new Exception("Ce nom de code est deja pris");
            }
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function insertCompletApi($data){
        try{
            $code = $data['code'];
            $designation = $data['designation'];
            $pu = $data['pu'];
            $stock = $data['stock'];

            Article::insertException($code,$designation,$pu,$stock);

            $fonction = new Fonction();
            $idArticle = 'ART'.$fonction->getSeq('ART','article_seq');

            $article = array (
                'idarticle' => $idArticle,
                'designation' => $designation,
                'code' => $code
            );

            $stockArticle = array(
                'idarticle' => $idArticle,
                'quantitestock' => $stock,
                'prixunitaire' => $pu
            );  

            $remise = array(
                'idarticle' => $idArticle,
                'idgratuit' => 'GRT01',
                'idpourcentage' => 'PRC01',
                'idgratuitpourcentage' => 'GRP01'
            );
            
            
            $art = new Article();
            $stkArt = new StockArticle();
            $rem = new Remise();

            $art->insertApi($article);
            $stkArt->insertApi($stockArticle);
            $rem->insertApi($remise);

            return $data;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function insertApi($data){
        try{
            $article = new Article();

            $article->idarticle = $data['idarticle'];
            $article->code = $data['code'];
            $article->designation = $data['designation'];

            $article->save();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function deleteArticleApi($id){
        try{
            Article::where('idarticle','=' , $id)->delete();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function deleteCompletApi($id){
        try{
            
            $art = new Article();
            $stkArt = new StockArticle();
            $rem = new Remise();

            $rem->deleteRemiseApi($id);
            $stkArt->deleteStockArticleApi($id);
            $art->deleteArticleApi($id);

            return $id;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }


}
