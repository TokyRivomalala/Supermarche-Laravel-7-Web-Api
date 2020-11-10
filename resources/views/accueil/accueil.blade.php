<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <title>Accueil Supermarche</title>
</head>
<body>
    <div class="container">
        <div class = "list mt-4">
            <div class="row">
                <div class="col-2">
                    <h3>Nos Articles</h3>
                </div>
                <div class="ml-4">
                    <form action = "{{  url('/')  }}/deconnexion" method = "POST">
                        @csrf
                        <button type="submit" class="btn btn-danger mb-4">Deconnexion</button>
                    </form>
                </div>
            </div>
            <form class = "mt-4" action = "{{  url('/')  }}/article" method = "GET">
                @csrf
                <h5>Votre recherche ici</h5>
                @if (isset($erreur))
                    <span class="text text-danger">{{ $erreur }}</span>   
                @endif
                <div class="row ml-1 ">
                    <div class="form-group">
                        <label  class = "mt-2" for="exampleInputEmail1">Code</label>
                        <input type="text" class="form-control col-md-8" id="exampleInputEmail1" name = "code">
                    </div>
                    <div class="form-group">
                        <label  class = "mt-2" for="exampleInputEmail1">Designation</label>
                        <input type="text" class="form-control col-md-8" id="exampleInputEmail1" name = "designation">
                    </div>
                </div>
                <div class="row ml-1 ">
                    <div class="form-group">
                        <label  class = "mt-2" for="exampleInputEmail1">Trier Par</label><br>
                        <select class="custom-select col-md-12" name = "orderBy">
                            <option value = "prixunitaire"selected>Prix Unitaire</option>
                            <option value="designation">Designation</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-left: 75px" >
                        <label  class = "mt-2" for="exampleInputEmail1">Ordre</label><br>
                        <select class="custom-select col-md-12" name = "order">
                            <option value = "ASC"selected>Croissant</option>
                            <option value="DESC">Decroissant</option>
                        </select>
                    </div>
                </div>
                <div class="row ml-1 ">
                    <button type="submit" class="btn btn-primary mb-4">Rechercher</button>
                </div>
            </form>
            <div class="table">
                <table class="table table-striped mt-3">
                    <tr>
                        {{--  <th>Code
                            <a href="{{  url('/')  }}/article/code-asc"><i class="fas fa-arrow-up mr-1"></i></a>
                            <a href="{{  url('/')  }}/article/code-desc"><i class="fas fa-arrow-down"></i></a>
                        </th>
                        <th>Designation
                            <a href="{{  url('/')  }}/article/designation-asc"><i class="fas fa-arrow-up mr-1"></i></a>
                            <a href="{{  url('/')  }}/article/designation-desc"><i class="fas fa-arrow-down"></i></a>
                        </th>  --}}
                        <th>Code</th>
                        <th>Designation </th>
                        <th>Quantite Stock</th>
                        <th>Prix Unitaire</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                    </tr>
                    @foreach ($article as $item)
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->designation }}</td>
                        <td>{{ $item->quantitestock }}</td>
                        <td>{{ $item->prixunitaire }}</td>
                        <td><a href="{{route('deleteArticle', ['id' => $item->idarticle])}}">Suppr</a></td>
                        <td><a href="{{route('updateArticle', ['id' => $item->idarticle])}}">Modif</a></td>
                    </tr>
                    @endforeach
                </table>
                <div class="pagination">
                    
                    @if (isset($query))
                        {{ $article->appends($query)->links() }}          
                    @else
                        {{ $article->links() }}  
                    @endif
                </div>
            </div>
        </div>

        
        <div class="create">

                @if ( isset($articles))
                <form class = "mt-4" action = "{{  url('/')  }}/modifierArticle" method = "POST">
                    @csrf
                    <h3>Modifier Article</h3>
                    @if (isset($erreur))
                        <span class="text text-danger">{{ $erreur }}</span>   
                    @endif
                    <div class="row ml-1 ">
                        <div class="form-group">
                            <label  class = "mt-2" for="exampleInputEmail1">Code</label>
                            <input type="text" class="form-control col-md-8" id="exampleInputEmail1" name = "code" value="{{ $articles->code }}" disabled>
                        </div>
                        <div class="form-group">
                            <label  class = "mt-2" for="exampleInputEmail1">Designation</label>
                            <input type="text" class="form-control col-md-8" id="exampleInputEmail1" name = "designation" value="{{ $articles->designation }}" disabled>
                        </div>
                    </div>
                    <div class="row ml-1">
                        <div class="form-group">
                            <label  class = "mt-2" for="exampleInputEmail1">Quantite Stock</label>
                            <input type="number" class="form-control col-md-8" id="exampleInputEmail1" name = "stock" value="{{ $articles->quantitestock }}" disabled>
                        </div>          
                        <div class="form-group">
                            <label  class = "mt-2" for="exampleInputEmail1">Prix Unitaire</label>
                            <input type="number" class="form-control col-md-8" id="exampleInputEmail1" name = "pu">
                            <input type="hidden" class="form-control col-md-8" id="exampleInputEmail1" value = "{{ $articles->idarticle }}" name = "idarticle">
                        </div>    
                    </div>
                    <button type="submit" class="btn btn-primary mb-4">Modifier</button>
                </form>
                @else
                <form class = "mt-4" action = "newArticle" method = "POST">
                    @csrf
                    <h3>Nouvel Article</h3> 
                    @if (isset($erreur))
                        <span class="text text-danger">{{ $erreur }}</span>   
                    @endif
                    <div class="row ml-1 ">
                        <div class="form-group">
                            <label  class = "mt-2" for="exampleInputEmail1">Code</label>
                            <input type="text" class="form-control col-md-8" id="exampleInputEmail1" name = "code">
                          </div>
                          <div class="form-group">
                              <label  class = "mt-2" for="exampleInputEmail1">Designation</label>
                              <input type="text" class="form-control col-md-8" id="exampleInputEmail1" name = "designation">
                          </div>
                    </div>
                    <div class="row ml-1">
                        <div class="form-group">
                            <label  class = "mt-2" for="exampleInputEmail1">Quantite Stock</label>
                            <input type="number" class="form-control col-md-8" id="exampleInputEmail1" name = "stock">
                        </div>          
                        <div class="form-group">
                            <label  class = "mt-2" for="exampleInputEmail1">Prix Unitaire</label>
                            <input type="number" class="form-control col-md-8" id="exampleInputEmail1" name = "pu">
                        </div>    
                    </div>
                    <button type="submit" class="btn btn-primary mb-4">Nouveau</button>
                @endif
                
            </form>
        </div>
    </div>
</body>
</html>