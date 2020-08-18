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
          <a class="nav-link" href="index.php" >
            <i class="fas fa-home " style="font-size: larger;"></i>  Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php" >
            <i class="fab fa-algolia" style="font-size: larger;"></i>  Products</a>
        </li>
      </ul>

    </div>
  </nav>
<br/>
<!-----------------------------------navbar ends here------------------------------------------>
<!-------------------------------------user sign up form starts here------------------------------------>

<div class="container">
    <div class="row" style="text-align: center;">
        
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="display: block;" >
        <div id="signupmsg" style="margin:1%;"></div>
                <div class="card">
                
                    <div class="card-header text-center">
                        <h4>Customer Signup Form</h4>
                    </div>
                   
                    <div class="card-body">
                    <form style="text-align: left;">

                    <div class="row">

                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                       <label for="f_name">FirstName</label>
                       <input type="text" class="form-control" id="f_name" name="f_name" placeholder="FirstName"> 
                      </div>

                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                       <label for="l_name">LastName</label>
                       <input type="text" class="form-control" id="l_name" name="l_name" placeholder="LastName">
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                       <label for="email">Email</label>
                       <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                      </div>

                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                       <label for="mobile">Mobile Number</label>
                       <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <label for="password">Password</label>
                       <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                      </div>

                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <label for="repassword">Repeat Password</label>
                       <input type="password" class="form-control" id="repass" name="repass" placeholder="Repeat Password">
                      </div>

                    </div>

                    
                     <div class="row">

                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                       <label for="address1">Address 1</label>
                       <input type="text" class="form-control" id="address1" name="address1" placeholder="Address 1">
                      </div>

                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                       <label for="address2">Address 2</label>
                       <input type="text" class="form-control" id="address2" name="address2" placeholder="Address 2">
                      </div>

                    </div>

                       <button class="btn btn-primary" id="signup" name="signup" style="margin-top:2%;">SignUp</button>
                    </form>
                    </div>
                </div>
            
        </div>
        
    </div>
</div>



<!-------------------------------------user sign up form ends here------------------------------------>
<!-------------------------CODE TO ENABLE BOOTSTRAP------------------------------------------>
<script src="jquery-3.5.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="index.js"></script>


</body>
</html>