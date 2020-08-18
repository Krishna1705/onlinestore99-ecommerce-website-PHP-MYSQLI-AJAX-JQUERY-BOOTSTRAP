<?php

#this login_form.php page will not shown to the user when he will logged in.if user is already logged in then he wil be redirected to the profile.php page
if(isset($_SESSION['userid'])){
header("Location:profile.php");
}

#here we will fetch data from action.php page's ready to checkout button.
#when user clicked on ready to checkout button that time we pass all data in form of form in action.php page.
#we will get those data here.
if(isset($_POST['login_user_with_product'])){
    #here data will be in array formand we are going to make use of cookies here.
    #since cookie can't store array data so we will covert these array data into json format

    $product_list=$_POST['pid'];//this $product_list is an array

    $json_e=json_encode($product_list);//here we are converting array into json format because array cannot be store in cookie

    //here we are creating cookie and name of cookie is product_list,WE WILL USE IT AT login.php page
    setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);
}


?>
<!--I HAVE USED BOOTSTRAP FOR FRONT END-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPPING CART</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/1a40f3df8b.js" crossorigin="anonymous"></script>

</head>
<body>
<!-----------------------------------navbar start here----------------------------------------->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <a class="navbar-brand" href="#" >ONLINE STORE99</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          <a class="nav-link" href="profile.php" >
            <i class="fas fa-home " style="font-size: larger;"></i>  Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="profile.php" >
            <i class="fab fa-algolia" style="font-size: larger;"></i>  Products</a>
        </li>
      </ul>
     
    </div>
  </nav>
<br/><br/><br/>
<!-------------------------------------------------------------navbar ends here------------------------------------------>
<!-----------------if user is not logged in then he will come here from ready to checkout button with product list here----------------->
<div class="container-fluid">
    <div class="container">
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white" style="text-align: center; padding:1%;"><h3>login form</h3></div>
            <div class="card-body">
            <form onsubmit="return false" id="login"> 
              <label for="loginemail">Email</label>
              <input type="text" class="form-control" id="loginemail" name="loginemail" placeholder="Email">
            <!--  <small class="text-muted form-text">We will never share this email with anyone else.</small>-->
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">

              <input type="submit" class="btn btn-success btn-xs" value="Login" style="display:block; margin-top:1%; margin-bottom:1%;">

              <a href="#" style="border:none; display:block;">Forgotten Password?</a>
              <a href="customer_register_form.php?register=1"  style="border:none; display:block;">Create New Account</a>
              </form> 
            </div> 
            <div class="card-footer"><div id="login_msg"></div></div>     
        </div>
        </div>
        <div class="col-md-3"></div>

        </div>
    </div>
</div>
    
<!-------------------------CODE TO ENABLE BOOTSTRAP------------------------------------------>
<script src="jquery-3.5.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="index.js"></script>


</body>
</html>