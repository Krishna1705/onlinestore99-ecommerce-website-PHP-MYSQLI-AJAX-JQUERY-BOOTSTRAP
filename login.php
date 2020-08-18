<?php
include "db.php";
session_start();

/*if(isset($_POST['userLogin'])){

    $email=$_POST['userEmail'];
    $password=$_POST['userPassword'];

    $email=mysqli_real_escape_string($con,$email);
    $email=htmlentities($email);

    $password=md5($password);

    $sql="SELECT * FROM user_info WHERE email='$email' AND password='$password' ";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_array($result);

        $_SESSION['userid']=$row['user_id'];
        $_SESSION['name']=$row['first_name'];

        echo "true";
    }

}*/

#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success

if(isset($_POST['loginemail']) && isset($_POST['password'])){
    $email=$_POST['loginemail'];
    $password=$_POST['password'];

    //echo $email;
    $email=mysqli_real_escape_string($con,$email);
    $email=htmlentities($email);

    $password=md5($password);

    $sql="SELECT * FROM user_info WHERE email='$email' AND password='$password'";
    $result=mysqli_query($con,$sql);
    $count=mysqli_num_rows($result);
    if($count==1){
        $row=mysqli_fetch_array($result);

        $_SESSION['userid']=$row['user_id'];
        $_SESSION['name']=$row['first_name'];
       

        $ip_add=getenv("REMOTE_ADDR");

        //we have created cookie at login_form.php page,so if cookie is available that means user is not logged in
        //so will check if cookie is set or not
        if(isset($_COOKIE["product_list"])){

            $p_list = stripcslashes($_COOKIE["product_list"]);
			//here we are decoding stored json product list cookie to normal array
            $product_list = json_decode($p_list,true);

//print_r($product_list);

    for($i=0; $i<count($product_list);$i++){
             
          $j=$product_list[$i]; //it will return result with / character. eg if pid is 14 then it will retur 14/.so we need to remove / from the string
          $k=trim($j,"/");//so we will use trim() function to remove / from the string.
        // echo $k;

        //After getting user id from database here we are checking user cart item if there is already product is listed or not
        #$verify_cart = "SELECT id FROM cart WHERE user_id = $_SESSION[uid] AND p_id = ".$product_list[$i];
          $verify_cart="SELECT id FROM cart WHERE user_id=$_SESSION[userid] AND p_id =$k";
        //  echo $verify_cart;
          $result=mysqli_query($con,$verify_cart);
       
           if(mysqli_num_rows($result)<1){
                   
                //if user is adding first time product into cart we will update user_id into database table with valid id
                 $update_cart_query = "UPDATE cart SET user_id = '$_SESSION[userid]' WHERE ip_add = '$ip_add' AND user_id = -1";
                 # $update_cart_query="UPDATE cart SET user_id=".$_SESSION['userid']." WHERE ip_add =".$ip_add." AND user_id=-1" ;
                 mysqli_query($con,$update_cart_query);
               
           }else{

                    //if already that product is available into database table we will delete that record
                    #$delete_existing_product = "DELETE FROM cart WHERE user_id = -1 AND ip_add = '$ip_add' AND p_id = ".$product_list[$i];
                    $delete_existing_item="DELETE FROM cart WHERE user_id= -1 AND ip_add ='$ip_add' AND p_id=$k";
                    mysqli_query($con,$delete_existing_item);

                
            }
      
    }//end of for loop

            //here we are destroying user cookie
            setcookie("product_list","",strtotime("-1 day"),"/");
            //if user is logging from after cart page we will send cart_login
            echo "cart_login";
            exit();            


        }else{
            //if cookie is not set means user is login from the index.php page's dropdown login form so we will send login_success
            echo "login_success";
			exit();
        }

    }else{
        echo "<span style='color:red;'>Sorry, Credentials Don't Match...</span>";
        exit();
    }
}

?>