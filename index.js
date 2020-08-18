$(document).ready(function(){
  // alert("hello");
   console.log("hello world");
   
   cat();
   brand();
   products();
   

   function cat() {
      $.ajax({
             url:'action.php',
             method:'post',
             data:{category:1},
             success:function (data,success) {
               // console.log(data);
               $("#get_category").html(data);

             }
      });//end of $.ajax call
   }//end of function cat()

   function brand() {
      $.ajax({
              url:'action.php',
              method:'post',
              data:{brand:1},
              success:function (data,success) {
                // console.log(data);
                $("#get_brand").html(data);
              }
             })
   }//end of function brand()

   function products(){
      $.ajax({
        url: 'action.php',
        method:'post',
        data:{products:1},
        success:function (data,success) {
         // console.log(data);
          $("#get_products").html(data);
        }
      })
   }//end of function products()


   //---delegate is a special class which allows to pass method as a parameter.its used for event handling

    $("body").delegate(".category","click",function(event){
    event.preventDefault();
    var cid=$(this).attr('cid');
       console.log(cid);

       $.ajax({
        url:'action.php',
        method:'post',
        data:{'get_selected_category':1,'cat_id':cid},
        success:function (data,success) {
          console.log(data);
          $("#get_products").html(data);
        }
      })//end of ajax method

    })//end of delegate class here


  //--------------------------------------------------------------------------------------------------
  $("body").delegate(".brand","click",function(event){
    event.preventDefault();
    var bid=$(this).attr('bid');
       console.log(bid);

       $.ajax({
        url:'action.php',
        method:'post',
        data:{'get_selected_brand':1,'brand_id':bid},
        success:function (data,success) {
          console.log(data);
          $("#get_products").html(data);
        }
      })//end of ajax method

    })//end of delegate class here

//-------------------------------search functionalitY as follows:--------------------------------

$("#search_btn").click(function(event){
  event.preventDefault();
  var sword =$("#search").val();
  console.log(sword);
  //alert(sword);
  if(sword != ""){

    $.ajax({
      url:'action.php',
      method:'post',
      data:{'search':1,'searchword':sword},
      success:function (data,success) {
        console.log(data);
        $("#get_products").html(data);
      }
    })//end of ajax method


  }
})

//-------------------------user signup code as follows:---------------------------------------------

$("#signup").click(function(event){
event.preventDefault();

    $.ajax({
            url:'signup.php',
            method:'post',
            data:$("form").serialize(),
            success:function(data,success) {
              //console.log(data);
            $("#signupmsg").html(data);
            }
            
        })//$.ajax ends here

})//signup click ends here

//-----------------------------------user signup code ends here-----------------------------------

//---------------------------login code starts here---------------------------------------------

/*$("#login").click(function(){
  var email =$("#loginemail").val();
  var password =$("#password").val();
      $.ajax({
       url:'login.php',
       method:'post',
       data:{userLogin:1,userEmail:email,userPassword:password},
       success:function(data,success){
          //  alert(data);
            if(data =="true"){
              window.location.href="profile.php";
            }else{
              alert("Wrong Email or Password");
             
            }
           
           }
      })//$.ajax ends here
})*/

$("#login").on("submit",function(event) {
  event.preventDefault(event);
  //alert("login called");
  $.ajax({
        url:'login.php',
        method:'POST',
        data:$("#login").serialize(),
        success:function (data,success) {
          if(data == "login_success"){
            //alert(data)
            window.location.href="profile.php";
          }else if(data == "cart_login"){
            //alert(data)
           window.location.href="cart.php";
          }else{
           $("#login_msg").html(data);
           // alert(data)

          }
        }
  })//end of $.ajax({})
  
})//end of login

//---------------------------login code ends here---------------------------------------------

//----------------------------------add to cart code starts here-------------------------------

$("body").delegate("#product",'click',function(event){
               event.preventDefault();
              //alert("hiiiiii");
               var pid= $(this).attr('pid');
              // alert(pid);
               $.ajax({
                 url:'action.php',
                 method:'post',
                 data:{addtoproduct:1,productid:pid},
                 success:function(data,success){
                  // alert(data);
                  $("#addtoproduct_msg").html(data);
                  cart_count();
                 }

               })//end of ajax

         })//end of delegate class
//----------------------------------add to cart code ends here--------------------------------

//----------------------------cart count on cart container of profile pagecode starts here-----------------------

/*cart_count();---we will make this function call while performing add to cart also,
bcoz we want this num increment instant when add to cart btn is clicked,
every time there is no need to do page rfreshment for getting cart container number*/
cart_count();
function cart_count(){
  $.ajax({
         url:"action.php",
         method:"post",
         data:{cart_count:1},
         success:function(data,success){
          // alert(data);
          $(".k1").html(data);
         }
  })//end of ajax
}


//----------------------------cart count on cart container of profile pagecode ends here-----------------------

//-----------------------------cart container---get cart products on profile page- starts here-------------------------------------
$("#profilecartdropdown").click(function(event) {
  event.preventDefault();
  //alert(0);
  $.ajax({
       url:'action.php',
       method:'post',
       data:{get_cart_products:1},
       success:function(data,success) {
        
         $("#getcartproducts").html(data);
       }
  })//ajax method ends here
})


//-----------------------------cart container---get cart products on profile page ends here-------------------------------------

//-------------------------------cart.php page-----get cart product list for checkout starts here--------------------------
cart_product_list();
function cart_product_list(){

                $.ajax({
                     url:'action.php',
                     method:'post',
                     data:{get_cart_products_list:1},
                     success:function(data,success) {
                      
                        $("#cart_product_list").html(data);
                     }
                })//end of ajax 
}


//-------------------------------cart.php page-----get cart product list sfor checkout ends here--------------------------

//------------------------------code for qty start here-----------------------------

$("body").delegate(".qty","keyup",function(e){
  e.preventDefault();
  //following both are lines for not allowing any string and not allowing any symbols and not allowing any negetive number in quantity field
  this.value = this.value.replace(/[^\d\\-]/g,'');//not allowing any characters or symbols except minus
  this.value =this.value.replace(/\-/g,'');//not allowing minus sign
  /*if($(this).val() < 1)
     {
       $(this).val('1');
     }*/

  var pid=$(this).attr('pid');
  //alert(pid);

  var qty=$("#qty-"+pid).val();
  console.log(qty);
 
  var price=$("#price-"+pid).val();
  console.log(price);

  var total= qty*price;
  console.log("total:"+total);

  $("#total-"+pid).val(total);

})
//------------------------------code for qty end here-----------------------------
//------------------------------------code for remove items from cart start----------------------------------

$("body").delegate("#remove_item","click",function(event){
  
  event.preventDefault();//it will stop refreshing
  var pid= $(this).attr('pid_remove_item');
  //alert("remove product no: "+pid);

  $.ajax({
        url:'action.php',
        method:'post',
        data:{removeFromCart:1,removeId:pid},
        success:function(data,success){
          //alert(data);
          $("#cart_msg").html(data);
          cart_product_list();
        }
  })//end of ajax

})//end of delegate- remove_iem code

//------------------------------------code for remove items from cart end----------------------------------

//------------------------------------------code for update items of cart starts here--------------------------
$("body").delegate("#update_item","click",function(event){
  event.preventDefault();
  var pid=$(this).attr('pid_update_item');
  //alert("update product no: "+pid);
  var qty=$("#qty-"+pid).val();
//  alert(qty);
  var price=$("#price-"+pid).val();
 // alert(price);
  var total=$("#total-"+pid).val();
 // alert(total)

  $.ajax({
    url:'action.php',
    method:'post',
    data:{updateToCart:1,updateId:pid,qty:qty,price:price,total:total},
    success:function(data,success){
     // alert(data);
     $("#cart_msg").html(data);
     cart_product_list();
    }

  })//end of ajax
  

})//end of delegate- update_item code
//------------------------------------------code for update items of cart ends here--------------------------

//-----------------------pagination code starts here-------------------------------------------------------
//-------------------------------number of pages shown at footer starts----------------------------
page();
function page(){
  
  $.ajax({
    url:'action.php',
    method:'post',
    data:{page:1},
    success:function(data,success){
      console.log(data);
      $("#pageno").html(data);
    }

  })//end of ajax
}
//-------------------------------number of pages shown at footer  ends here----------------------------

//--------------------------------------when page no is clicked starts here-----------------------------------

$("body").delegate("#page","click",function(){
  var pn= $(this).attr('page');
  //alert(pn);

  $.ajax({
    url:"action.php",
    method:"post",
    data:{products:1,setpage:1,pageno:pn},
    success:function(data,success){
     // alert(data);
     $("#get_products").html(data);

    }
  })
})

//--------------------------------------when page no is clicked ends here-----------------------------------
//-----------------------pagination code ends here-------------------------------------------------------


});//end of document.ready function