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
  <meta name="description" content="Prototype of BOOKBOT" >
  <meta name="keywords" content="" />
  <title>BookBoT, Stay connected with readers near you!</title>
  <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css" type="text/css" media="all" />                              <!--for whole body-->         
  <link rel="stylesheet" href="css/main.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/signup.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/slider.css" type="text/css" />                                     <!--for whole body--> 
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
<div id="back_clack">
</div>         <!--end of back black-->

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
<div id="all_cont">
<div id="alert"><span id="close_intro">CLOSE THIS INTRODUCTION</span>
 <h1>Welcome To Prototype Of BOOKBOT.. </h1>
 <p>Hello Jury / team campus shark</p>
 <p>First of all a great <b>THANKYOU for selecting BOOKBOT</b> for the second phase of campus shark. I am really excited and a bit nervous to present you prototype of BOOKBOT.<br />
  <br />BOOKBOT is an online robot that searches for books and readers near your locality and in your college. It also facilitates it's user to maintain a bookshelf where they can add book which they want to share or exchange.
 <br />I have tried to use all the best possible technologies and frameworks that could make user experience simple, time and cost efficient and user friendly. BOOKBOT make a search in user locality and college and get them the best possible results.
  <br /><br />But this being a prototype so the number of books uploaded in very less and GOOGLE MAPS is not used for sorting of books because this can lead to no result and hence you wont be able to check the site properly. But when the webapp will get alive
 all there will be a good use of MAPS API to get user geolocation wherever possible.
 
  <br/ ><br /> Thankyou & Enjoy the site<br />ABHISEHK DHIMAN<br>Founder & Developer of BOOKBOT<br />G. B. PANT ENGINEERING COLLEGE, NEW DELHI  </p>
</div><!--end of alert-->
<header>  
 <img src="images/website-part/logo.png" id="main_top_logo" alt="BookBot, Stay connected with readers near you!" />
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
<div id="container">
<div id="top_img">
 </div>            <!--end of top img-->
<div id="layer1">
 <h1 id="main_title">SHARE & EXCHANGE BOOKS WITH<br/ > YOUR FRIENDS IN COLLEGE<br /> AND IN LOCALITY!</h1>
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
<h1 id="sub_title">GET ALL THE BOOKS NEAR YOU</h1>
<div id="main_link"><h4><a href="books.php">VIEW BOOKS</a></h4></div>
</div> <!--end of layer one-->
<div id="slider_part">
<h1 id="above_scroll">SHARE BOOKS & MAKE NEW FRIENDS!</h1>
<div id="slider">
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                  </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right">
                    <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                            data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
<?php
              //get product detials
                 $query2  = "SELECT * FROM book_stock ORDER BY rand() LIMIT 1";
                 $result2 = @mysqli_query($dbc, $query2)or die("Error with query 2"); 
                   while($row2 = mysqli_fetch_array($result2)){
?>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="book.php?id=<?php echo $row2['book_id'];?>"><img src="images/books/<?php echo $row2['bimage'];?>" class="img-responsive" alt="a" /></a>
                                </div>
                            </div>
                        </div>
<?php
       }//end of while loop
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     <!--end of section-->
</div>          <!--end of slider part-->
</div>               <!--end of container-->
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

<?php
                      //script to show successfull operation
                if(isset($_GET['logout'])){
?>
<div class="succ-msg reg_war"><div class="succ_inside"><p> Successfully Logged Out!</p></div></div>
<script type="text/javascript">
     $('div.succ-msg').show(); 
   setInterval(showErr,10000);
       function showErr(){
     $('div.succ-msg').fadeOut();
}; 
</script>
<?php
                }//end of check for logout   
?>              
</body>
</html>