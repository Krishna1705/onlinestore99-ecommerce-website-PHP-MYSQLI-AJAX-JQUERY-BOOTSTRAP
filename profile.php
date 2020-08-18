<?php
include "db.php";
session_start();

if(!isset($_SESSION['userid'])){
   header("Location:index.php");
}

?>

<!--Project definataion-SHOPPING CART APP using AJAX,JQUERY,PHP,MYSQLI-->
<!--I HAVE USED BOOTSTRAP FOR FRONT END-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINESTORE99</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/1a40f3df8b.js" crossorigin="anonymous"></script>

</head>
<body>
<!-----------------------------------navbar start here----------------------------------------->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <a class="navbar-brand" href="#" >ONLINESTORE99</a>
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

      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" id="search" aria-label="Search">
        <button class="btn btn-primary my-2 my-sm-0" id="search_btn" name="search_btn">Search</button>
      </form>

      <ul class="navbar-nav mr-auto"  style="float: right;">

        <li class="nav-item dropdown active" >
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profilecartdropdown">
            <i class="fas fa-cart-plus" style="font-size: larger;"></i>  Cart <span class="k1 badge badge-primary">0</span> </a>
            <div class="dropdown-menu" aria-labelledby="profilecartdropdown">
                <div class="card text-blue text-center border-primary" style="width: 400px;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">No.</div>
                            <div class="col-md-3">Product Image</div>
                            <div class="col-md-3">Product Name</div>
                            <div class="col-md-3">Price in $</div>
                        </div>
                        
                    </div>

                    <div class="card-body">
                        <div id="getcartproducts"></div>
                      <!--<div class="row">
                            <div class="col-md-3">No.</div>
                            <div class='col-md-3'><img src='img/$pro_image' style='width:60px; height:70px;'>Product Image</div>
                            <div class="col-md-3">Product Name</div>
                            <div class="col-md-3">Price</div>
                          </div><hr/>-->
                      
                    </div>

                </div>
            </div>
        </li>

        <li class="nav-item dropdown active" >
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" 
          id="signindropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"  ></i>  <?php echo $_SESSION['name']; ?> </a>
          <!--<div class="dropdown-menu" aria-labelledby="signindropdown">
               <div class="card text-left text-white bg-info" style="width: 300px;">
                   <div class="card-header ">Login</div>
                   <div class="card-body">
                       <form action="" method="POST">
                           <label for="loginemail">Email</label>
                           <input type="email" class="form-control" id="loginemail" name="loginemail" placeholder="Email">
                           <label for="Password">Password</label>
                           <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                           <br/>
                           <a href="#" style="color:white;border:none">Forgotten Password?</a>
                           <button class="btn btn-success btn-xs" id="login" name="login" style="float: right;">Login </button>
                       </form>
                   </div>
                  
               </div>
           </div>--> 
           <div class="dropdown-menu" aria-labelledby="signindropdown">
               <ul style="width: 200px;">
                   <li><a href="cart.php"><i class="fas fa-cart-plus" style="font-size: larger;"></i> Cart</a></li>
                   
                 <!--<li><a href="#">Change Password</a></li>-->
                   <li><a href="customer_order.php">Your Orders</a></li>
                   <li><a href="logout.php">Logout</a></li>
               </ul>
           </div>
        </li>

      <!--  <li class="nav-item active">
            <a class="nav-link" href="customer_register_form.php" >
              <i class="fas fa-user"></i>  Sign Up</a>
          </li>-->
      </ul>

    </div>
  </nav>
<br/><br/><br/>
<!-----------------------------------navbar ends here------------------------------------------>
<!-----------------------------------code for shopping cart start here----------------------->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2">

        <div id="get_category"></div>
             <!-- <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="#"><h4>Categories</h4></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
               
              </ul>-->
              <div id="get_brand"></div>
             <!-- <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="#"><h4>Brands</h4></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
               
              </ul>-->

        </div>

        <div class="col-md-8">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <div id="addtoproduct_msg"></div>
            </div>
          </div>
           <div class="card">
             
             <div class="card-header">Products</div>
             <div class="card-body" >
             
             <div id="get_products"></div>
            
                  <!--  <div class="row">

                       <div class="col-md-6 col-lg-4" style="padding: 1%;">
                           <div class="card">
                               <div class="card-header">Samsung</div>
                               <div class="card-body">
                                   <img src="img/bodysuit.jpg" class="card-img" alt="">
                               </div>
                               <div class="card-footer">INR 15,000 
                                <button class="btn btn-danger btn-xs" style="float: right;">Add to cart</button>
                               </div>
                           </div>
                       </div>
                    </div>-->


             </div>
             <div class="card-footer">
                 @2020 all rights reserved.
             </div>
           </div>
        </div>

        <div class="col-md-1"></div>
    </div>
<!----------------------------------pagination code starts here---------------->
</br>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: center;">
      <center>
     <nav aria-label="Page navigation example" style="display: inline-block;">
        <ul class="pagination" id="pageno"> 
           <!------------------------------pagination number will be shown here----------------->
           
         </ul>
     </nav>
      </center>
      </div>
    </div>
  </div>
    
</div>

    <!-----------------------------------code for shopping cart end here----------------------->
<!-------------------------CODE TO ENABLE BOOTSTRAP------------------------------------------>
<script src="jquery-3.5.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="index.js"></script>


</body>
</html>