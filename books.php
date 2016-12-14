<?php
        $dbc = @mysqli_connect('localhost', 'soamiji', 'soami@99026', 'radhasoami_avneel')or die("error connecting to database");
date_default_timezone_set( 'Asia/Kolkata' );
mysqli_query( $dbc, "SET time_zone='" . date( 'P' ) . "'" );
                               //if user registered get user details
 @session_start();
         if(isset($_SESSION['user_id'])){
             $query1  = "SELECT * FROM user_registered WHERE user_id='".$_SESSION['user_id']."' LIMIT 1";
             $result1 = @mysqli_query($dbc, $query1)or die("Error with query 9");  
                   $row1 = mysqli_fetch_array($result1); 
                       }//end of check for user logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" /> 	 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="" >
  <meta name="keywords" content="" />
  <title>Books | BookBoT, Stay connected with readers near you!</title>
  <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css" type="text/css" media="all" />                              <!--for whole body-->         
  <link rel="stylesheet" href="css/main.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/secondary.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/signup.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/tile.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/basic_all.css" type="text/css" />                                     <!--for whole body--> 
   <link rel="stylesheet" type="text/css" href="font_awesome_4.0.3/css/font-awesome.css" />
                       <!--favicon-->
 <link rel='shortcut icon' type='image/x-icon' href='images/favicon/favicon.ico' />
    <!--scripts-->
<script type="text/javascript" src="script/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="script/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="script/main.js"></script>
</head>
<body>
<?php
                //if user is not logged in than show this
       if(!isset($_SESSION['user_id'])){
            require_once('useraccount/userlogin.php');
             }//end of check for user is not logged in
?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '268196090229712',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div id="all_black">
</div>                     <!--end of all_black-->
<?php
                //check for user logged in
      if(!isset($_SESSION['user_id'])){
?>
<div id="register_open">
<i class="fa fa-times close_icon" id="close_register"></i>
 <div class="top_account_part">
  <h1>Join For Free</h1>
  <h2>Already a Member, <a id="my_account" class="clr_animate">Login</a> Here.</h2>   
   </div>           <!--end of div_top-->
 <div class="main_account_div">
    <div class="left_member_part">
     <ol>
       <li> Connect with readers in your locality.</li>
       <li> Feed your hunger to read for free.</li>
       <li> Make good friends.</li>
         </ol>
      <h1> Stay connected with readers near you!</h1>
       </div>             <!--end of left part-->
    <div class="right_member_part">
         <form class="user_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
         <div class="reg_div"><i class="fa fa-user reg"></i><input type="name" required placeholder="Name" title="Enter Name" name="name" /></div>           
         <div class="reg_div"><i class="fa fa-envelope reg"></i><input type="email" required placeholder="abc@xyz.com" id="u_name" onblur="checkAvailable()" title="Enter Email" name="email" /></div>
         <span id="user-availability-status"></span>
         <div class="reg_div"><i class="fa fa-shield reg"></i><input type="password" required placeholder="Password" name="reg-password" title="Enter Password" /></div>
         <input type="submit" id="sign_up" class="sign_up" name="register_now" value="Join Now"/>
            </form>
<script type="text/javascript">
 function checkAvailable(){
    jQuery.ajax({
	url: "check_availability.php",
	data:'email='+$("#u_name").val(),
	type: "POST",
	success:function(data){
		$("#user-availability-status").html(data);
	},
	error:function (){}
	});
}
</script>  
     <div id="social_auth_s_up">
 <div class="social_tile">
<a href="<?php echo $loginUrl; ?>" rel="tooltip" title="Sign up with Facebook" class="btn btn-lg btn-primary" id="facebook_login">
 <i class="fa fa-facebook-square fa-lg pull-left"></i> <span class="socail_title">Register via Facebook</span>
</a>
   </div>           <!--end of social tile-->
 </div>              <!--end of socail auth-->

       </div>             <!--end of left part-->
  </div>     <!--end of div main-->
 <div class="bottom_part_account">
  <p>With Registration you <b>Accept <a href="t&c.php">Terms & Conditions</a> & <a href="privacypolicy.php">Privacy Policy</a></b>. </p>
   </div>           <!--end of div_bottom-->
</div>                 <!--end of register-->


<div id="my_account_open">
<i class="fa fa-times close_icon" id="close_account"></i>
 <div class="top_account_part">
  <h1>Login to Account</h1>
  <h2>New Member, <a id="register_open" class="clr_animate">Signup</a> for Free.</h2>   
   </div>           <!--end of div_top-->
 <div class="main_account_div">
    <div class="left_member_part">
     <ol>
       <li> Connect with readers in your locality.</li>
       <li> Feed your hunger to read for free.</li>
       <li> Make good friends.</li>
         </ol>
      <h1> Stay connected with readers near you!</h1>
       </div>             <!--end of left part-->
    <div class="right_member_part">
         <form class="user_form"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
          <div class="reg_div"><i class="fa fa-envelope reg"></i><input type="email" required placeholder="abc@xyz.com"  title="Enter Email" name="email" /></div>
            <div class="reg_div"><i class="fa fa-shield reg"></i><input type="password" required placeholder="Password" name="password" title="Enter Password" /></div>
         <input type="submit" id="sign_up" class="sign_up" name="open_account" value="Login Now"/>
            </form>
     <div id="social_auth_s_up">
 <div class="social_tile">
<a href="<?php echo $loginUrl; ?>" rel="tooltip" title="Sign up with Facebook" class="btn btn-lg btn-primary" id="facebook_login">
 <i class="fa fa-facebook-square fa-lg pull-left"></i> <span class="socail_title">Login via Facebook</span>
</a>
   </div>           <!--end of social tile-->
 </div>              <!--end of socail auth-->

       </div>             <!--end of left part-->
  </div>     <!--end of div main-->
 <div class="bottom_part_account">
  <p>Happy to have you !</p>
   </div>           <!--end of div_bottom-->
</div>                 <!--end of my account-->
<?php
       }//end of check for user id
?>
<header>  
 <a href="index.php"><img src="images/website-part/logo.png" id="main_top_logo" alt="BookBot, Stay connected with readers near you!" /></a>
 <div id="cat_menu_icon">
 <img src="images/website-part/menu.jpg" id="cat_menu_icon" />
  </div>           <!--end of cat menu-->
<?php
            //check for user logged in
    if(isset($_SESSION['user_id'])){
?>
 <div id="account_2"><h3 id="notification"><i class="fa fa-bell"></i><?php
         //check for new notifications
    $query_notf  = "SELECT * FROM notifications WHERE to_user='".$_SESSION['user_id']."' AND viewed='0'";
    $result_notf = @mysqli_query($dbc, $query_notf)or die("Error with query notf"); 
          if(mysqli_num_rows($result_notf)==0){}else{echo '<i class="fa fa-circle" id="bling_dot"></i>';};
?></h3>
  </div>
  <div id="user_menu">
    <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><img id="u_img" src="images/website-part/<?php echo $row1['image'];?>" alt="Hi User"/> <span class="caret"></span>
    </button>
    <div id="umbox">
      <p><a href="profile.php">PROFILE</a> </p>
      <p><a href="addbook.php">ADD BOOK</a> </p>
      <p><a href="messages.php">MESSAGES</a> </p>
      <p><a href="useraccount/logout.php">LOGOUT</a> </p>
    </div>        <!--end of user menu box-->
</div>
<?php 
      }else{
?>
 <div id="account"><h3 id="notification"><i class="fa fa-bell"></i></h3><h3 id="my_account"><i class="fa fa-user"></i> </h3></div>
<?php
        }//end of check for user logged in
?>
</header>
<div id="notification_box">
<?php
  if(isset($_SESSION['user_id'])){
    //get notifications
           $query_list_notf  = "SELECT * FROM notifications WHERE to_user='".$_SESSION['user_id']."' ORDER BY notifi_id DESC LIMIT 1";
           $result_list_notf = @mysqli_query($dbc, $query_list_notf)or die("Error with query_list_notf");
              while($row_list_notf = mysqli_fetch_array($result_list_notf)){
?>
 <p><?php echo $row_list_notf['message'];?></p>
<?php
          }//end of check forlist_notf
}else{ 
     echo'<p>Hello <i class="fa fa-smile-o"></i><br />  This is a prototype of BookBot... <br /> So the number of books is limited only.</p>';
}//end of check for user loged in
?>
</div>            <!--end of notification box-->
<div id="category_box">
      <p><a href="books.php?c=COURSE BOOKS">COURSE BOOKS</a></p>
      <p><a href="books.php?c=NOVELS">NOVELS</a></p>
      <p><a href="books.php?c=SAMPLE PAPERS">SAMPLE PAPERS</a></p>
      <p><a href="books.php?c=NOTES">NOTES</a></p>
</div>       <!--end of category box-->

<div id="search">
 <form method="GET" action="search.php">
<div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="search-query form-control" id="q_search" onkeydown="searc_sug()" name="q" placeholder="Search Books In Locality and College..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
 </form>
<div id="suggestions">
</div>      <!--end of suggestions-->
</div>       <!--end of search-->
<script type="text/javascript">
 function searc_sug(){
             $('div#suggestions').stop().show();  
    jQuery.ajax({
	url: "autocomplete.php",
	data:'q='+$("#q_search").val(),
	type: "POST",
	success:function(data){
		$("#suggestions").html(data);
	},
	error:function (){}
	});
}   
</script>
<div id="container">
<div id="main">
<div id="left_menu">
<div class="dashboard">
  <p><?php  if(isset($_GET['t'])){ echo $_GET['t'];}else{ ?>
<?php if(isset($_GET['c'])){echo  $_GET['c'];}else{ ?> BOOKS  <?php }?> NEAR YOU
<?php } ?></p>
</div>            <!--end of dashboard-->
<div id="all_cats">
<?php if(!isset($_GET['c'])){?>
<?php 
     if(!isset($_SESSION['user_id'])){
?>
<div class="l_tile"><h1 id="open_login_box"> COLLEGE</h1></div> <!--end of genre open-->
<?php
}else{
?>
<div class="l_tile"><h1><a href="books.php?t=COLLEGE"> COLLEGE</a></h1></div> <!--end of genre open-->
<?php
       }//end of check for user logged in
?>
<div class="l_tile"><h1><a href="books.php?t=LOCALITY"> LOCALITY</a></h1></div> <!--end of genre open-->
<?php
           }else{
?>
<?php 
     if(!isset($_SESSION['user_id'])){
?>
<div class="l_tile"><h1 id="open_login_box"> COLLEGE</h1></div> <!--end of genre open-->
<?php
}else{
?>
<div class="l_tile"><h1><a href="books.php?t=COLLEGE&c=<?php echo $_GET['c'];?>"> COLLEGE</a></h1></div> <!--end of genre open-->
<?php
       }//end of check for user logged in
?>
<div class="l_tile"><h1><a href="books.php?t=LOCALITY&c=<?php echo $_GET['c'];?>"> LOCALITY</a></h1></div> <!--end of genre open-->
<?php
      }//ed of check for book category present
?>
<div class="l_tile"><h1><a href="readers.php"> READERS</a></h1></div> <!--end of genre open-->
</div>       <!--end of all cats-->
</div>          <!--end of left menu-->
<p id="path_all_pages">
 <a href="index.php">HOME</a> > <a href="<?php echo $_SERVER['REQUEST_URI'];?>"><?php if(isset($_GET['c'])){echo  $_GET['c'];}else{ ?> BOOKS  <?php }?></a>
</p>           <!--end of path all pages-->
 <div id="section_book">
 <h1 class="section_main_title">
 <?php if(!isset($_GET['t'])){
?>
       SHOWING ALL THE <?php if(isset($_GET['c'])){echo  $_GET['c'];}else{ ?> BOOKS  <?php }?> NEAR YOU. 
<?php
 }else{
        if($_GET['t']=='COLLEGE'){
?>
SHOWING ALL THE <?php if(isset($_GET['c'])){echo  $_GET['c'];}else{ ?> BOOKS  <?php }?> FROM YOUR COLLEGE (<?php echo $row1['college'];?>).
<?php  
     }else{
?>
   SHOWING ALL THE <?php if(isset($_GET['c'])){echo  $_GET['c'];}else{ ?> BOOKS  <?php }?> FROM YOUR LOCALITY.
<?php  
       }
}?>
</h1>
<?php
                //script to check for user books 
        if(isset($_GET['t'])){
                if($_GET['t']=='LOCALITY'){
?>
<p id="demo"></p>
<script>
var x = document.getElementById("demo");

$(document).ready(function(){
       getLocation();
});
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
 function showPosition(position) {
    x.innerHTML = "(To show that BOOKBOT uses GEOLOCATION to get books and readers near you !!) Latitude: " + position.coords.latitude + 
    " Longitude: " + position.coords.longitude; 
 }


</script>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry no book found in your Locality!</h1>
</div>                        <!--end of opps sory no result found-->
 <h1 class="section_main_title">Most Viewed Books...</h1>
<?php
       //showing some random result for locality not match
       if(!isset($_GET['c'])){
?>
<?php  
             //script to select ebooks
            $query10  = "SELECT * FROM book_stock";
            $result10 = @mysqli_query($dbc, $query10)or die("Error with query 10"); 
                       if(mysqli_num_rows($result10)=='0'){
?>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry no book found!</h1>
</div>                        <!--end of opps sory no result found-->
<?php
                        }else{
                 while($row10 = mysqli_fetch_array($result10)){
?>   
<div class="tile">
 <div class="eb_img" >
 <a href="book.php?id=<?php echo $row10['book_id'];?>"><img rel="tooltip" title="<?php echo $row10['bname'];?>" src="images/books/<?php echo $row10['bimage'];?>" alt="<?php echo $row10['bname'];?>" /></a>
 </div>                                 <!--end of img div-->
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="partial_name_show"><p class="title"><?php echo substr($row10['bname'],0,16);?>..</p></a>
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="full_name_show"><p class="title"><?php echo $row10['bname'];?></p></a>
 <p class="view_book"><a href="book.php?id=<?php echo $row10['book_id'];?>"></i>View Book</a></p>
</div>            <!--end of tile--> 
<?php
                  }//end of while loop
            }//end of check for book                
?>
<?php 
        }else{
         $c = $_GET['c'];
?>
<?php
             //script to select ebooks
            $query10  = "SELECT * FROM book_stock WHERE main_cat='$c'";
            $result10 = @mysqli_query($dbc, $query10)or die("Error with query 10"); 
                       if(mysqli_num_rows($result10)=='0'){
?>
<?php
                        }else{
                 while($row10 = mysqli_fetch_array($result10)){
?> <div class="tile">
 <div class="eb_img" >
 <a href="book.php?id=<?php echo $row10['book_id'];?>"><img rel="tooltip" title="<?php echo $row10['bname'];?>" src="images/books/<?php echo $row10['bimage'];?>" alt="<?php echo $row10['bname'];?>" /></a>
 </div>                                 <!--end of img div-->
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="partial_name_show"><p class="title"><?php echo substr($row10['bname'],0,16);?>..</p></a>
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="full_name_show"><p class="title"><?php echo $row10['bname'];?></p></a>
 <p class="view_book"><a href="book.php?id=<?php echo $row10['book_id'];?>"></i>View Book</a></p>
</div>            <!--end of tile--> 
<?php
                  }//end of while loop
            }//end of check for book                
?>
<?php
               }//end of check for isset present category present
         }//end of check for books in locality
                if($_GET['t']=='COLLEGE'){
            $query2  = "SELECT user_id FROM user_registered WHERE college='".$row1['college']."'";
            $result2 = @mysqli_query($dbc, $query2)or die("Error with query2"); 
                  if(mysqli_num_rows($result2)==0){
?>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry no book found!</h1>
</div>                        <!--end of opps sory no result found-->
<?php            
            }else{ 
    while($row2 = mysqli_fetch_array($result2)){
         if($_SESSION['user_id']!=$row2['user_id']){  
           $query3  = "SELECT * FROM user_books WHERE user_id='".$row2['user_id']."'";
           $result3 = @mysqli_query($dbc, $query3)or die("Error with query3"); 
                  if(mysqli_num_rows($result3)=='0'){}else{
                while($row3 = mysqli_fetch_array($result3)){
?>
<?php
       if(!isset($_GET['c'])){
?>
<?php  
             //script to select ebooks
            $query10  = "SELECT * FROM book_stock WHERE book_id='".$row3['book_id']."'";
            $result10 = @mysqli_query($dbc, $query10)or die("Error with query 10"); 
                       if(mysqli_num_rows($result10)=='0'){
?>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry no book found!</h1>
</div>                        <!--end of opps sory no result found-->
<?php
                        }else{
                 while($row10 = mysqli_fetch_array($result10)){
?>   
<div class="tile">
 <div class="eb_img" >
 <a href="book.php?id=<?php echo $row10['book_id'];?>"><img rel="tooltip" title="<?php echo $row10['bname'];?>" src="images/books/<?php echo $row10['bimage'];?>" alt="<?php echo $row10['bname'];?>" /></a>
 </div>                                 <!--end of img div-->
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="partial_name_show"><p class="title"><?php echo substr($row10['bname'],0,16);?>..</p></a>
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="full_name_show"><p class="title"><?php echo $row10['bname'];?></p></a>
 <p class="view_book"><a href="book.php?id=<?php echo $row10['book_id'];?>"></i>View Book</a></p>
</div>            <!--end of tile--> 
<?php
                  }//end of while loop
            }//end of check for book                
?>
<?php 
        }else{
         $c = $_GET['c'];
?>
<?php
             //script to select ebooks
            $query10  = "SELECT * FROM book_stock WHERE main_cat='$c' AND book_id='".$row3['book_id']."'";
            $result10 = @mysqli_query($dbc, $query10)or die("Error with query 10"); 
                       if(mysqli_num_rows($result10)=='0'){
?>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry no book found!</h1>
</div>                        <!--end of opps sory no result found-->
<?php
                        }else{
                 while($row10 = mysqli_fetch_array($result10)){
?> <div class="tile">
 <div class="eb_img" >
 <a href="book.php?id=<?php echo $row10['book_id'];?>"><img rel="tooltip" title="<?php echo $row10['bname'];?>" src="images/books/<?php echo $row10['bimage'];?>" alt="<?php echo $row10['bname'];?>" /></a>
 </div>                                 <!--end of img div-->
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="partial_name_show"><p class="title"><?php echo substr($row10['bname'],0,16);?>..</p></a>
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="full_name_show"><p class="title"><?php echo $row10['bname'];?></p></a>
 <p class="view_book"><a href="book.php?id=<?php echo $row10['book_id'];?>"></i>View Book</a></p>
</div>            <!--end of tile--> 
<?php
                  }//end of while loop
            }//end of check for book                
?>
<?php
               }//end of check for isset present category present
      }//end of while for book in user books
      }//end of check for book in user books
     }//end of check for different user
    }//end of while for all users having same college
   }//end of check for whether same college present or not
  }//end of check for request to sort by college
                                   }else{
           //showning book without any sort
?>
<p id="demo"></p>
<script>
var x = document.getElementById("demo");

$(document).ready(function(){
       getLocation();
});
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
 function showPosition(position) {
    x.innerHTML = "(To show that BOOKBOT uses GEOLOCATION to get books and readers near you!!) Latitude: " + position.coords.latitude + 
    " Longitude: " + position.coords.longitude; 
 }


</script>
<?php
       if(!isset($_GET['c'])){
?>
<?php  
             //script to select ebooks
            $query10  = "SELECT * FROM book_stock";
            $result10 = @mysqli_query($dbc, $query10)or die("Error with query 10"); 
                       if(mysqli_num_rows($result10)=='0'){
?>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry no book found!</h1>
</div>                        <!--end of opps sory no result found-->
<?php
                        }else{
                 while($row10 = mysqli_fetch_array($result10)){
?>   
<div class="tile">
 <div class="eb_img" >
 <a href="book.php?id=<?php echo $row10['book_id'];?>"><img rel="tooltip" title="<?php echo $row10['bname'];?>" src="images/books/<?php echo $row10['bimage'];?>" alt="<?php echo $row10['bname'];?>" /></a>
 </div>                                 <!--end of img div-->
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="partial_name_show"><p class="title"><?php echo substr($row10['bname'],0,16);?>..</p></a>
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="full_name_show"><p class="title"><?php echo $row10['bname'];?></p></a>
 <p class="view_book"><a href="book.php?id=<?php echo $row10['book_id'];?>"></i>View Book</a></p>
</div>            <!--end of tile--> 
<?php
                  }//end of while loop
            }//end of check for book                
?>
<?php 
        }else{
         $c = $_GET['c'];
?>
<?php
             //script to select ebooks
            $query10  = "SELECT * FROM book_stock WHERE main_cat='$c'";
            $result10 = @mysqli_query($dbc, $query10)or die("Error with query 10"); 
                       if(mysqli_num_rows($result10)=='0'){
?>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry no book found!</h1>
</div>                        <!--end of opps sory no result found-->
<?php
                        }else{
                 while($row10 = mysqli_fetch_array($result10)){
?> <div class="tile">
 <div class="eb_img" >
 <a href="book.php?id=<?php echo $row10['book_id'];?>"><img rel="tooltip" title="<?php echo $row10['bname'];?>" src="images/books/<?php echo $row10['bimage'];?>" alt="<?php echo $row10['bname'];?>" /></a>
 </div>                                 <!--end of img div-->
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="partial_name_show"><p class="title"><?php echo substr($row10['bname'],0,16);?>..</p></a>
 <a href="book.php?id=<?php echo $row10['book_id'];?>" id="full_name_show"><p class="title"><?php echo $row10['bname'];?></p></a>
 <p class="view_book"><a href="book.php?id=<?php echo $row10['book_id'];?>"></i>View Book</a></p>
</div>            <!--end of tile--> 
<?php
                  }//end of while loop
            }//end of check for book        
   }//end  of check for isset for c        
?>

<?php
}//end of check for t
?>
  </div>          <!--end of section books-->
</div>             <!--end of container-->


<div id="scroll_top">
  <img src="images/website-part/cone.png" rel="tooltip" title="Back to top" alt="Scroll top" />
</div>                     <!--end of scroll top-->
<footer>         
 <ul class="right_footer">
  <li><a href=""><i class="fa fa-facebook-square"></i></a></li>
  <li><a href=""><i class="fa fa-twitter-square"></i></a></li>
   </ul>       
 <ul class="left_footer">
  <li><a href="about.php">ABOUT</a></li>
  <li><a href="t&c.php">TERMS & CONDITIONS</a></li>
  <li><a href="privacypolicy.php">PRIVACY POLICY</a></li>
   </ul>                                         
</footer> 

<script type="text/javascript">
 $('i.remove-log_out').click(function(){
   $('p#successfull_logout').stop().remove();
});
</script>
<?php
                      //script to show successfull operation
                if(isset($_GET['logout'])){
                      echo'<p id="successfull_logout">Successfully Logged Out</p>';
?>
<script type="text/javascript">
   setInterval(hide_logout, 4000);
       function hide_logout(){
     $('p#successfull_logout').stop().fadeOut();
};
</script>
<?php
                }//end of check for logout   
?>              
</body>
</html>