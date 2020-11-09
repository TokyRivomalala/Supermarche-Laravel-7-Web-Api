<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Exception;

class ArticleComplet extends Model
{
    //
    protected $table = 'articlecomplet';
    protected $fillable = ['idpourcentage','pourcentage','idarticle','idgratuit','nbmin','nbgratuit','idgratuitpourcentage','nbminprc','prc','designation','code','quantitestock','prixunitaire'];

    public function select(){
        try{
            $res = ArticleComplet::paginate(3);
            if(count($res) == 0){
                throw new Exception ('Aucun Article trouvee');
            }
            return $res;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function selectById($id){
        try{
            $res = ArticleComplet::where('idarticle' , '=' , $id)->first();
            if(empty($res)){
                throw new Exception ('Aucun Article trouvee');
            }
            return $res;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
}
