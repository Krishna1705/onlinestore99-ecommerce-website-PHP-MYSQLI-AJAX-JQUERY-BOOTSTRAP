<?php

session_start();
include "db.php";

$ip_add = getenv("REMOTE_ADDR");//fetch ip address in PHP


if(isset($_POST['category'])){

    $cat_query="SELECT * FROM categories";
    $result=mysqli_query($con,$cat_query);
    

    echo "<ul class='nav nav-pills flex-column'>
              <li class='nav-item'>
                <a class='nav-link active' href='#'><h4>Categories</h4></a>
              </li>";
    if(mysqli_num_rows($result)>0){
     while ($row=mysqli_fetch_array($result)) {
       // print_r($row);

       $cat_id=$row['cat_id'];
       $cat_name=$row['cat_title'];

       echo   "<li class='nav-item'>
                 <a class='nav-link category' href='#' cid='$cat_id'>$cat_name</a>
              </li>";
        }   
        
    }
    echo "</ul>";

}//end of isset($_POST['category']--in HTML 5 U CAN SPECIFY UR QWN ATTRIBUTE LIKE E.G cid here...cid='$cat_id';

if(isset($_POST['brand'])){
  $brand_query="SELECT * FROM brands";
  $result=mysqli_query($con,$brand_query);

     echo "<ul class='nav nav-pills flex-column'>
              <li class='nav-item'>
                 <a class='nav-link active' href='#'><h4>Brands</h4></a>
              </li>";

  if(mysqli_num_rows($result)>0){
      while($row=mysqli_fetch_array($result)){
          $brand_id=$row['brand_id'];
          $brand_name=$row['brand_title'];
          echo "<li class='nav-item'>
                  <a class='nav-link brand' href='#' bid='$brand_id'>$brand_name</a>
                </li>";
      }
     }//end of if
     echo "</ul>";
}//end of  isset($_POST['brand']


//-------------pagination starts here-------------------
if(isset($_POST['page'])){
  $sql="SELECT * FROM products";
  $result=mysqli_query($con,$sql);
  //follow line will give num of rows of products table.
  $count=mysqli_num_rows($result);
 
// echo $count;
//echo "<br/>";
//we want to show 9 products on a page so we will devide it by 9.so we will get no of pages we required to show our all productts.
//ceil function will convert float  value into integer
$pageno=ceil($count/9);
//echo $pageno;
//pago no will be 6 ...means we required 6 pages to show our products

for($i=1;$i<=$pageno;$i++){
 echo
         "<li class='page-item' >
         <a class='page-link' id='page' page='$i' href='#'>$i</a>
         </li>";
}

}//end of isset page-----------it just will give no of pages 

if(isset($_POST['products'])){

  $limit=9;

  if(isset($_POST['setpage'])){
    $pageno=$_POST['pageno'];
    $start=($pageno*$limit) - $limit;
  }else{
    $start=0;
  }
  $product_query="SELECT * FROM products  LIMIT $start,$limit"  ;
  $result=mysqli_query($con,$product_query);

echo "<div class='row'>";

  if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){

      $product_id=$row['product_id'];
      $product_cat_id=$row['product_cat_id'];
      $product_brand_id=$row['product_brand_id'];
      $product_title=$row['product_title'];
      $product_price=$row['product_price'];
      $product_desc=$row['product_desc'];
      $product_image=$row['product_image'];
      $product_keywords=$row['product_keywords'];

      echo "
      <div class='col-md-6 col-lg-4' style='padding: 1%;'>
                           <div class='card'>
                               <div class='card-header'>$product_title</div>
                               <div class='card-body'>
                                   <img src='img/$product_image' class='card-img img-fluid' style='width:auto; height:40vh;'
                                    alt='$product_title'>
                               </div>
                               <div class='card-footer'>$ $product_price/-
                                <button class='btn btn-danger btn-sm' pid='$product_id' id='product' style='float: right;'>Add to cart</button>
                               </div>
                           </div>
                       </div>
      ";
    }
  }

  echo "</div>";
}//end of isset($_POST['products'])



if(isset($_POST['get_selected_category'])){
  $cid=$_POST['cat_id'];

  $selected_product_query="SELECT * FROM products WHERE product_cat_id= '$cid'";
  $result=mysqli_query($con,$selected_product_query);

  echo "<div class='row'>";
  if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){

      $product_id=$row['product_id'];
      $product_cat_id=$row['product_cat_id'];
      $product_brand_id=$row['product_brand_id'];
      $product_title=$row['product_title'];
      $product_price=$row['product_price'];
      $product_desc=$row['product_desc'];
      $product_image=$row['product_image'];
      $product_keywords=$row['product_keywords'];

      echo "
      <div class='col-md-6 col-lg-4' style='padding: 1%;'>
                           <div class='card'>
                               <div class='card-header'>$product_title</div>
                               <div class='card-body'>
                                   <img src='img/$product_image' class='card-img img-fluid' style='width:auto; height:40vh;'
                                    alt='$product_title'>
                               </div>
                               <div class='card-footer'>$ $product_price/-
                                <button class='btn btn-danger btn-sm' pid='$product_id' id='product' style='float: right;'>Add to cart</button>
                               </div>
                           </div>
                       </div>
      ";

    }
  }

}//end of isset($_POST['get_selected_category'])


if(isset($_POST['get_selected_brand'])){
  $bid=$_POST['brand_id'];

  $selected_product_query="SELECT * FROM products WHERE product_brand_id= '$bid'";
  $result=mysqli_query($con,$selected_product_query);

  echo "<div class='row'>";
  if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){

      $product_id=$row['product_id'];
      $product_cat_id=$row['product_cat_id'];
      $product_brand_id=$row['product_brand_id'];
      $product_title=$row['product_title'];
      $product_price=$row['product_price'];
      $product_desc=$row['product_desc'];
      $product_image=$row['product_image'];
      $product_keywords=$row['product_keywords'];

      echo "
      <div class='col-md-6 col-lg-4' style='padding: 1%;'>
                           <div class='card'>
                               <div class='card-header'>$product_title</div>
                               <div class='card-body'>
                                   <img src='img/$product_image' class='card-img img-fluid' style='width:auto; height:40vh;'
                                    alt='$product_title'>
                               </div>
                               <div class='card-footer'>$ $product_price/-
                                <button class='btn btn-danger btn-sm' pid='$product_id' id='product' style='float: right;'>Add to cart</button>
                               </div>
                           </div>
                       </div>
      ";

    }
  }

}//end of isset($_POST['get_selected_brand'])


//-----------------query for search functionality---------------------------------------

if(isset($_POST['search'])){
  $searchword=$_POST['searchword'];

  $selected_product_query="SELECT * FROM products WHERE product_keywords LIKE '%$searchword%'";
  $result=mysqli_query($con,$selected_product_query);

  echo "<div class='row'>";
  if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){

      $product_id=$row['product_id'];
      $product_cat_id=$row['product_cat_id'];
      $product_brand_id=$row['product_brand_id'];
      $product_title=$row['product_title'];
      $product_price=$row['product_price'];
      $product_desc=$row['product_desc'];
      $product_image=$row['product_image'];
      $product_keywords=$row['product_keywords'];

      echo "
      <div class='col-md-6 col-lg-4' style='padding: 1%;'>
                           <div class='card'>
                               <div class='card-header'>$product_title</div>
                               <div class='card-body'>
                                   <img src='img/$product_image' class='card-img img-fluid' style='width:auto; height:40vh;'
                                    alt='$product_title'>
                               </div>
                               <div class='card-footer'>$ $product_price/-
                                <button class='btn btn-danger btn-sm' pid='$product_id' id='product' style='float: right;'>Add to cart</button>
                               </div>
                           </div>
                       </div>
      ";

    }
  }

}//end of isset($_POST['search'])

//----------------------------------add to cart code starts here-------------------------------
if(isset($_POST['addtoproduct'])){

  if(isset($_SESSION['userid'])){
/*====================if user is logged in then we will add product into cart with user_id and user ip_address=====================*/
   $p_id = $_POST['productid'];
   $user_id=$_SESSION['userid'];
  
   $sql="SELECT * FROM cart WHERE p_id='$p_id' AND user_id='$user_id'";
   $result=mysqli_query($con,$sql);
   if(mysqli_num_rows($result)>0){
     
     echo "<div class='alert alert-danger' role='alert'>
     product is already added into the cart!...Continue Shopping.
         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
           <span aria-hidden='true'>&times;</span>
         </button>
     </div>";

   }else{

    $sql1="SELECT * FROM products WHERE product_id='$p_id'";
    $result1=mysqli_query($con,$sql1);
    if(mysqli_num_rows($result1)>0){
      $row=mysqli_fetch_array($result1);

      $pro_id = $row['product_id'];
      $pro_title= $row['product_title'];
      $pro_image= $row['product_image'];
      $pro_price= $row['product_price'];

    $sql2="INSERT INTO `cart`(`p_id`, `ip_add`, `user_id`, `product_title`, `product_image`, `qty`, `price`, `total_amount`)
    VALUES ('$pro_id','$ip_add','$user_id','$pro_title','$pro_image',1,'$pro_price','$pro_price')";

    $result2=mysqli_query($con,$sql2);
    if($result2){
         
         echo "<div class='alert alert-success' role='alert'>
         Product Successfully added to the cart
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
               <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
        }
    }
   }
  }//if (isset($_SESSION['userid'])) ends
  else{
 /*====================if user is not logged in then we will add product into cart with user ip address,AND with user_id=-1=====================*/
            $p_id = $_POST['productid'];
            
            //$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
            $sql="SELECT * FROM cart WHERE p_id='$p_id' AND ip_add= '$ip_add' AND user_id = -1";
            $result=mysqli_query($con,$sql);
            if(mysqli_num_rows($result)>0){
              
              echo "<div class='alert alert-danger' role='alert'>
              product is already added into the cart!...Continue Shopping(index page)
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
              exit();

 }else{
        $sql1="SELECT * FROM products WHERE product_id='$p_id'";
        $result1=mysqli_query($con,$sql1);
        if(mysqli_num_rows($result1)>0){
          $row=mysqli_fetch_array($result1);

          $pro_id = $row['product_id'];
          $pro_title= $row['product_title'];
          $pro_image= $row['product_image'];
          $pro_price= $row['product_price'];

        $sql2="INSERT INTO `cart`(`p_id`, `ip_add`, `user_id`, `product_title`, `product_image`, `qty`, `price`, `total_amount`)
        VALUES ('$pro_id','$ip_add',-1,'$pro_title','$pro_image',1,'$pro_price','$pro_price')";

        $result2=mysqli_query($con,$sql2);
        if($result2){
            
            echo "<div class='alert alert-success' role='alert'>
            Product Successfully added to the cart.(index pge)
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
            }
        }
        
 }
   
  }//end of else
}//if(isset($_POST['addtoproduct'])) ends


//----------------------------------add to cart code ends here-------------------------------

//----------------------------------get cart products on profile page & index page cart container-dropdown starts-------------------------------
if(isset($_POST['get_cart_products'])){
  if(isset($_SESSION['userid'])){
    $user_id=$_SESSION['userid'];

    $sql="SELECT * FROM cart WHERE user_id='$user_id'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
      $no=1;
      while($row=mysqli_fetch_array($result)){
        
        $pro_id=$row['p_id'];
        $pro_title=$row['product_title'];
        $pro_image=$row['product_image'];
        $pro_price=$row['price'];


        echo "<div class='row'>
                  <div class='col-md-3'>$no</div>
                  <div class='col-md-3'><img src='img/$pro_image' style='width:60px; height:70px;'></div>
                  <div class='col-md-3'>$pro_title</div>
                  <div class='col-md-3'>$pro_price</div>
             </div><hr/>";

      $no=$no+1;
      }
      echo "<a href='cart.php' style:'float:right' class='btn btn-warning'>Edit</a>";
    }else{
      echo "<div class='alert alert-danger' role='alert'>
      Your Cart is Empty
      </div>";
    }
  }else{
//if user is not logged in then we will do it with help of ip_address
        $sql="SELECT * FROM cart WHERE user_id= -1 AND ip_add='$ip_add'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>0){
          $no=1;
          while($row=mysqli_fetch_array($result)){
            
            $pro_id=$row['p_id'];
            $pro_title=$row['product_title'];
            $pro_image=$row['product_image'];
            $pro_price=$row['price'];


            echo "<div class='row'>
                      <div class='col-md-3'>$no</div>
                      <div class='col-md-3'><img src='img/$pro_image' style='width:60px; height:70px;'></div>
                      <div class='col-md-3'>$pro_title</div>
                      <div class='col-md-3'>$pro_price</div>
                </div><hr/>";

          $no=$no+1;    
    }
    echo "<a href='cart.php' style:'float:right' class='btn btn-warning'>Edit</a>";

    }else{
      echo "<div class='alert alert-danger' role='alert'>
      Your Cart is Empty
      </div>";
    }
  }

}
//------------------------------------get cart products on profile page & index page cart container-dropdown ends----------------------------------

//-------------------get cart count on profile page &index page container starts here--------------------------

if(isset($_POST['cart_count'])){
 if(isset($_SESSION['userid'])){
      $user_id=$_SESSION['userid'];

      $sql="SELECT * FROM cart WHERE user_id='$user_id'";
      $result=mysqli_query($con,$sql);
      $count=mysqli_num_rows($result);
      echo $count;
    }else{
      //if user is not logged in then we will do it with help of ip_address
      $sql="SELECT * FROM cart WHERE user_id= -1 AND ip_add='$ip_add'";
      $result=mysqli_query($con,$sql);
      $count=mysqli_num_rows($result);
      echo $count;
    }
}


//-------------------get cart count on profile page &index page container ends here--------------------------
//-----------------------------------|| cart.php-cart page starts here-----------------------------------------

if(isset($_POST['get_cart_products_list'])){
  
  if(isset($_SESSION['userid'])){
    $uid=$_SESSION['userid'];
  $sql="SELECT * FROM cart WHERE user_id='$uid'";
  }else{
    $sql="SELECT * FROM cart WHERE user_id=-1 AND ip_add='$ip_add'";
  }
  $result=mysqli_query($con,$sql);


  if(mysqli_num_rows($result)>0){
    echo "<form method='post' action='login_form.php'>";
    $total_amt=0;
    while($row=mysqli_fetch_array($result)){

           $pid= $row['p_id'];
           $pro_title=$row['product_title'];
           $pro_image=$row['product_image'];
           $pro_qty=$row['qty'];
           $pro_price=$row['price'];
           $pro_total=$row['total_amount'];
           $cart_item_id = $row["id"];
           
           $price_array=array($pro_total);
           $total_sum=array_sum($price_array);
           $total_amt=$total_amt + $total_sum;
           
  /*we will setcookie here to check it at payment_success.php page as follows:here we are creating cookie for total amount which is going to b paid
  so we will give this name very intelligently,so no one able to understand that this cookie is used for what purpose.here i m givinig it name "ta"
  for totAL amount.*/
  setcookie("ta",$total_amt,strtotime("+1 Day"),"/","","",TRUE);

           echo "<div class='row'>

            <div class='col-md-2'>
                <div class='btn-group' role='group' aria-label='Basic example'>
                   <a href='#'><button type='button' pid_remove_item='$pid' id='remove_item' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button></a>
                   <a href='#'> <button type='button' pid_update_item='$pid' id='update_item' class='btn btn-primary'><i class='fas fa-check-square'></i></button></a>
                </div>
            </div>

            <!--follow two items we will fetch at login_form.php page -->
            <input type='hidden' name='pid[]' value=$pid/>
						<input type='hidden' name='' value=$cart_item_id/>

            <div class='col-md-2'><img src='img/$pro_image' style='width:60px; height:70px;'></div>
            <div class='col-md-2'>$pro_title</div>
            <div class='col-md-2'><input type='text' class='form-control price' pid='$pid' id='price-$pid' value='$pro_price' disabled></div>
            <div class='col-md-2'><input type='text' class='form-control qty' pid='$pid'  id='qty-$pid' value='$pro_qty' ></div>
            <div class='col-md-2'><input type='text' class='form-control total' pid='$pid'  id='total-$pid' value='$pro_total' disabled></div>  

        </div><hr/>";
    }
    echo "
    <div class='row'>
       <div class='col-md-8'></div>
       <div class='col-md-4'>
          <b>Total : $ $total_amt</b> 
       </div>
    </div>";
    
  if (!isset($_SESSION["userid"])) {
  //---------------------------if user is not logged in then show him a ready checkout and redirect to login page
    echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info " value="Ready to Checkout" >
        </form>';
  }else if(isset($_SESSION['userid'])){
//isf user is already logged in then rediretct him to paypal itegration module--------------------------
//-------------------------------------paypal code starts here---------------------------------------

echo"</form>
<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>

  <input type='hidden' name='cmd' value='_cart'>
  <input type='hidden' name='business' value='cart@onlinestore99.com'>
  <input type='hidden' name='upload' value='1'>";

  $x=0;
  //if(isset($_SESSION['userid'])){}
  $uid=$_SESSION['userid'];
  $sql1="SELECT * FROM cart WHERE user_id='$uid' ";
 
  $result1=mysqli_query($con,$sql1);
  if(mysqli_num_rows($result1)>0){
    while($row=mysqli_fetch_array($result1)){
          $x++;
     
    echo'
      <input type="hidden" name="item_name_'.$x.'"  value="'.$row['product_title'].'">
      <input type="hidden" name="item_number_'.$x.'" value="'.$x.'">
      <input type="hidden" name="amount_'.$x.'" value="'.$row['price'].'">
      <input type="hidden" name="quantity_'.$x.'" value="'.$row['qty'].'">';
    

         }
       }


echo
     '<input type="hidden" name="return" value="http://localhost/onlinestore99/payment_success.php"/>
			<input type="hidden" name="notify_url" value="http://localhost/onlinestore99/payment_success.php">
			<input type="hidden" name="cancel_return" value="http://localhost/onlinestore99/cancel.php"/>
			<input type="hidden" name="currency_code" value="USD"/>
      <input type="hidden" name="custom" value="'.$_SESSION["userid"].'"/>
                  
									<input style="float:right;margin-right:80px;" type="image" name="submit"
                  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                  alt="PayPal Checkout"
                  alt="PayPal - The safer, easier way to pay online">
                  
								</form>';


//--------------------------------------------paypal code ends here===========================================

  }

}//mysqli_num_rows----which fetches added product list is ends here
else{
 
  echo "<div class='alert alert-danger' role='alert'>
  Your Cart is Empty. Please add some Products into the Cart and then you can continue...
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
          echo" <a href='index.php' class='btn btn-success'>Add Products into Cart</a>";
}
}//if(isset ) ends here



//----------------------------------------|| cart.php-cart page ends here-----------------------------

//-----------------------------remove item from code starts here-----------------------------------
if(isset($_POST['removeFromCart'])){
  $pid=$_POST['removeId'];

  if(isset($_SESSION['userid'])){
  $userid=$_SESSION['userid'];
  $sql="DELETE FROM cart WHERE user_id='$userid' AND p_id='$pid' ";
  }else{
    $sql="DELETE FROM cart WHERE ip_add='$ip_add' AND p_id='$pid' AND user_id=-1";
  }
  $result=mysqli_query($con,$sql);

  if($result){
    echo "<div class='alert alert-danger' role='alert'>
    Product removed from the Cart. Continue Shopping...
   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
   </button>
  </div>";
  }

}

//-----------------------------remove item from code ends here-----------------------------------
//------------------------------------------code for update items of cart starts here--------------------------
if(isset($_POST['updateToCart'])){

  $pid=$_POST['updateId'];
  
  $qty=$_POST['qty'];
  $price=$_POST['price'];
  $total=$_POST['total'];

  if(isset($_SESSION['userid'])){
     $userid=$_SESSION['userid'];
     $sql= "UPDATE `cart` SET qty='$qty', price ='$price', total_amount='$total' WHERE user_id ='$userid' AND p_id= '$pid' ";
  }else{
    $sql= "UPDATE `cart` SET qty='$qty', price ='$price', total_amount='$total' WHERE ip_add='$ip_add' AND p_id= '$pid' AND user_id=-1 ";
  }

  $result=mysqli_query($con,$sql);
  if($result){
    echo "<div class='alert alert-success' role='alert'>
    Product is Updated Successfully. Continue Shopping...
   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
   </button>
  </div>";
  }
}



//------------------------------------------code for update items of cart ends here--------------------------
