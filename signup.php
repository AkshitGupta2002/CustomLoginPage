  <?php
  $showAlert = FALSE;
  $showError = FALSE;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
      $showAlert = FALSE;
      include 'partials/_dbconnect.php';

      $username = $_POST["username"];
      $password = $_POST["password"];
      $cpassword = $_POST["cpassword"];

      $exists = false;
      //Check if the username exist
      $exist_sql = "select * from `users` where username = '$username' ";
      $result = mysqli_query($conn, $exist_sql);
      $numExistRows = mysqli_num_rows($result);
      if($numExistRows>0){
        $showError = "Username already exists";
      }else{

        $exists=FALSE;
        if(($password == $cpassword)){
          
          $hash = password_hash($password, PASSWORD_DEFAULT);      
          $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp());";
          $result = mysqli_query($conn, $sql);
        
        if($result){
          $showAlert= TRUE;
        }

      }else{
          $showError = "Password do not match";
      }

    }

  }
  ?>

  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <title>SignUp</title>
    </head>
    <body>
      <?php require 'partials/_nav.php'?>



      <?php 
          if ($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success! </strong>You can now login into your account
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </div>';
          }

        if ($showError){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error! </strong> '. $showError .'
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </div>';
          }       

      ?>



      <div class="container col-md-4 my-4">
          
      <h1 class="text-center"><b>Sign Up here :)</b></h1>

        <form action="/loginsystem/signup.php" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
    
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          </div>

          <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Password">
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>      
          </div>
    
          <center>
          <button type="submit" class="btn btn-primary">SignUp</button>
          </center>
        
        </form>
      
      </div>

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
  </html>