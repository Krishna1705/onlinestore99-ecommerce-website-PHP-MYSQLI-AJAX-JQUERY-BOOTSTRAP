<?php

session_start();
if(!isset($_SESSION['userid'])){
   header("Location:index.php");
}

if (isset($_GET["st"])) {
#WE WILL GET following variables from the payment_sucess.php page's URL after payment completion.
$trx_id=$_GET['tx'];//transaction id returnerd by paypal
$p_st=$_GET['st'];//payment status return by paypal
$amt=$_GET['amt'];//total amt which we have paid
$cm_user_id=$_GET['cm'];//custom variable which we have set in action.php page,,we sent userid here
$cc=$_GET['cc'];//country code which we set action.php 

//in action.php page we create cookie for total amount that sent from here(from action.php page) for payment to paypal
//and here(payment_success.php page) is the amount which comes back from the paypal,so we compare both of the total amount

if(isset($_COOKIE["ta"]) == $amt && $p_st=="Completed"){
 // echo "everything is okey";

  include_once("db.php");
  $sql="SELECT p_id,product_title,price,qty FROM cart WHERE user_id='$cm_user_id'";
  $result=mysqli_query($con,$sql);

  if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_array($result)){
              $product_id[]=$row['p_id'];
              $qty[]=$row['qty'];
              $p_name[]=$row['product_title'];
              $p_price[]=$row['price'];
              
          }//end of while
  
    
       for($i=0;$i<count($product_id);$i++){
            $sql_customer_order="INSERT INTO `customer_order`(`uid`, `pid`, `p_name`, `p_price`, `p_qty`, `p_status`, `trx_id`) 
            VALUES ('$cm_user_id','".$product_id[$i]."','".$p_name[$i]."','".$p_price[$i]."','".$qty[$i]."','".$p_st."','".$trx_id."')";
            $result1=mysqli_query($con,$sql_customer_order);
         //   echo"customer_order table is updated" ;
        }//end of for loop

        $sql2 = "DELETE FROM cart WHERE user_id = '$cm_user_id'";
        $result2=mysqli_query($con,$sql2);

        if($result2){
        //  echo "products deleted from the cart sucessfully.";
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
          <a class="nav-link" href="#" >
            <i class="fab fa-algolia" style="font-size: larger;"></i>  Products</a>
        </li>
      </ul>

    </div>
  </nav>
<br/><br/><br/>
<!-----------------------------------navbar ends here------------------------------------------>

<!-----------------------------customer_order_detail code starts here------------------------------------------>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header bg-primary text-white"><h5>Thank You</h5></div>
         <div class="card-body">
               
                 <p class="card-text">Hello, <?php echo $_SESSION['name']; ?> Your Payment Process is successfully Completed.
                 Your Transaction ID is <?php echo $trx_id; ?>. You can continue your shopping.</p><br/>
                <a href="index.php" class="btn btn-success">Continue Shopping</a>
               
         </div>
      </div>
    </div>
  </div>
</div>


<!-----------------------------customer_order_detail code ends here------------------------------------------>

<!-------------------------CODE TO ENABLE BOOTSTRAP------------------------------------------>
<script src="jquery-3.5.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="index.js"></script>


</body>
</html>

<?php
    }//end of if($result2)----data deleted from cart
}//end of if(mysqli_num_rows($result)>0) statement
else{
  header("Location:index.php");
  }
}//end of isset cookie['ta'] && p-st==Completed
}//end of if (isset($_GET["st"])) {
?>
