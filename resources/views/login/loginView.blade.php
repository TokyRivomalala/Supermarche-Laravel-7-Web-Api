<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Login Supermarche</title>
</head>
<body>
    <div class="container">
        <form class = "mt-4" action = "checkLogin" method = "POST">
            @csrf
            <h3>Sign-in</h3>
            @if (isset($erreur))
              <span class="text text-danger">{{ $erreur }}</span>   
            @endif
            <div class="form-group">
              <label  class = "mt-2" for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control col-md-3" id="exampleInputEmail1" aria-describedby="emailHelp" name = "email">

            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control col-md-3" id="exampleInputPassword1" name = "mdp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>