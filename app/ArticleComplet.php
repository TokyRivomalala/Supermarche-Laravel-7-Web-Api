<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Exception;

use App\Fonction;

class ArticleComplet extends Model
{
    //
    protected $table = 'articlecomplet';
    protected $fillable = ['idpourcentage','pourcentage','idarticle','idgratuit','nbmin','nbgratuit','idgratuitpourcentage','nbminprc','prc','designation','code','quantitestock','prixunitaire'];

    public function select($data){
        try{

            $code = $data['code'];
            $designation = $data['designation'];
            $pu = $data['pu'];
            $stock = $data['stock'];
            $orderBy = $data['orderBy'];
            $order = $data['order'];

            $artCompl = new ArticleComplet();

            $code = $artCompl->rqtCode($code);
            $designation = $artCompl->rqtDesignation($designation);
            
            $fonction = new Fonction();

            if($fonction->IsNullOrEmptyString($orderBy) || $fonction->IsNullOrEmptyString($order)){
                $res = ArticleComplet::where('code', 'LIKE' , $code)
                                     ->where('designation', 'LIKE' , $designation)
                                     ->paginate(3);
            }
            else{
                $res = ArticleComplet::where('code', 'LIKE' , $code)
                                     ->where('designation', 'LIKE' , $designation)
                                     ->orderBy($orderBy, $order)
                                     ->paginate(3);
            }

                                 

            if(count($res) == 0){
                throw new Exception ('Aucun Article trouvee');
            }
            return $res;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function rqtCode($code){
        $fonction = new Fonction();
        if($fonction->IsNullOrEmptyString($code)){
            $code = '%%';
            return $code;
        }
        $code = '%'.$code.'%';
        return $code;
    }

    public function rqtDesignation($designation){
        $fonction = new Fonction();
        if($fonction->IsNullOrEmptyString($designation)){
            $designation = '%%';
            return $designation;
        }
        $designation = '%'.$designation.'%';
        return $designation;
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

    //API

    public function selectApi($data){
        try{

            $code = $data['code'];
            $designation = $data['designation'];
            $pu = $data['pu'];
            $stock = $data['stock'];
            $orderBy = $data['orderBy'];
            $order = $data['order'];

            $artCompl = new ArticleComplet();

            $code = $artCompl->rqtCode($code);
            $designation = $artCompl->rqtDesignation($designation);
            
            $fonction = new Fonction();

            if($fonction->IsNullOrEmptyString($orderBy) || $fonction->IsNullOrEmptyString($order)){
                $res = ArticleComplet::where('code', 'LIKE' , $code)
                                     ->where('designation', 'LIKE' , $designation)
                                     ->paginate(3);
            }
            else{
                $res = ArticleComplet::where('code', 'LIKE' , $code)
                                     ->where('designation', 'LIKE' , $designation)
                                     ->orderBy($orderBy, $order)
                                     ->paginate(3);
            }

                                 

            if(count($res) == 0){
                throw new Exception ('Aucun Article trouvee');
            }
            return $res;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    public function rqtCodeApi($code){
        $fonction = new Fonction();
        if($fonction->IsNullOrEmptyString($code)){
            $code = '%%';
            return $code;
        }
        $code = '%'.$code.'%';
        return $code;
    }

    public function rqtDesignationApi($designation){
        $fonction = new Fonction();
        if($fonction->IsNullOrEmptyString($designation)){
            $designation = '%%';
            return $designation;
        }
        $designation = '%'.$designation.'%';
        return $designation;
    }

    public function selectByIdApi($id){
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
