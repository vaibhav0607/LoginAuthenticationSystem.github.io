<?php
  $showAlert=false;
  $showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){

    include 'parcal/dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    $exists=false;
    //check wheter username is exit
    $existsql="SELECT * FROM `users` WHERE  username='$username' ";
   
    $result=mysqli_query($conn,$existsql);
    $numExistRows=mysqli_num_rows($result);
    if($numExistRows>0){
      // $exits=true;
      $showError=" username already exists";
    }else{
     
    
    if(($password==$cpassword) ){
      $hash=password_hash($password,PASSWORD_DEFAULT);
    $sql="INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ( '$username', '$hash', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    if($result){
      $showAlert=true;
    }
    }else{
      $showError="Passwords do not match ";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sign up!</title>
  </head>
  <body>
    <?php require 'parcal/nav.php'  ?>

    <?php
    
   if($showAlert){

   
   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>success!</strong> Your account is now created and you can login
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

}
if($showError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '.$showError.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>

    <div class="container my-4">
        <h1 class="text-center">Signup to our website</h1>
        <form action="/login/signup.php " method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" maxlength="15" class="form-control" id="Username" name="username" aria-describedby="emailHelp" placeholder="Enter username">
  
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" maxlength="23"  class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="cpassword">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword" >
    <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
  </div>
 
  <button type="submit" class="btn btn-primary">Signup</button>
</form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
    
</body>
</html>