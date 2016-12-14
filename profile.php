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
            //total books of user
             $tbooks_array = array();
     $query2  = "SELECT * FROM user_books WHERE user_id='".$_SESSION['user_id']."'";
     $result2 = @mysqli_query($dbc, $query2)or die("Error with query2");
         while($row2 = mysqli_fetch_array($result2)){
                $tbooks_array[] = $row2['ub_id'];
        }//end of while for total books
                   $tbooks = count($tbooks_array);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" /> 	 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="" >
  <meta name="keywords" content="" />
  <title>Hi, <?php echo $row1['name'];?> | BookBoT, Stay connected with readers near you!</title>
  <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css" type="text/css" media="all" />                              <!--for whole body-->         
  <link rel="stylesheet" href="css/main.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/secondary.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/signup.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/tile.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/viewuser.css" type="text/css" />                                     <!--for whole body--> 
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
<header>  
 <a href="index.php"><img src="images/website-part/logo.png" id="main_top_logo" alt="BookBot, Stay connected with readers near you!" /></a>
 <div id="cat_menu_icon">
 <img src="images/website-part/menu.jpg" id="cat_menu_icon" />
  </div>           <!--end of cat menu-->
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
<?php
        if(isset($_GET['new_user'])){
?>
<div id="save_success">
 <h4>Saved to Profile <br />Successfully!</h4>
</div>             <!--end of send request-->
<div id="save_fail">
 <h4>Request Failed!</h4>
</div>             <!--end of send request-->
<script type="text/javascript"> 
setInterval(hide_msg,10000);
       function hide_msg(){
     $('div#save_success').fadeOut();
};  
setInterval(hidefail_msg,10000);
       function hidefail_msg(){
     $('div#save_fail').fadeOut();
}; 
</script>
<div id="edit_profile">
 <form method="POST" action="saveprofile.php" id="save_to_profile">
 <div id="form_right"> 
  <h1>SOCIAL DETAILS</h1>
 <input type="text" name="facebook" placeholder="Facebook Profile Link" /><br/>
 <input type="text" name="twitter" placeholder="Twitter Profile Link" /><br/>
 <input type="text" name="linkedin" placeholder="Linkedin Profile Link" /><br/>
  </div>      <!--end of form right-->
 <div id="form_left"> 
  <h1>PROFILE DETAILS</h1>
   <select name="college"> 
     <option>Please Select Your College</option>
     <option value="G. B. PANT ENGINEERING COLLEGE">G. B. PANT ENGINEERING COLLEGE</option>
     </select><br/>
   <textarea name="address" required placeholder="Complete Address"></textarea>
   </div>      <!--end of form left-->
  <input type="button" id="save_profile" value="SAVE TO PROFILE" /> <span id="skip">SKIP</span>
  <b><p>Fields once filled can't be edited later!</p></b>
  </form>
<script type="text/javascript">
   $('form#save_to_profile input[type="button"]').click(function(){
      var data = $('form#save_to_profile input, select, textarea').serializeArray();
      $.post($('form#save_to_profile').attr('action'),data,function(json){
             if(json){
                $('div#save_success').fadeIn();  
              $('div#all_black').stop().hide();
              $('div#edit_profile').stop().animate({top:'-100%'},1000);            
 }
             if(json.status=="fail"){
                $('div#save_fail').show();                
 }
});
}); 
</script>
 
</div>           <!--end of edit profile-->
<script type="text/javascript">
  $('div#all_black').stop().show();
  $('div#edit_profile').stop().animate({top:'120px'},1000);
  $('span#skip').mouseover(function(){
       $(this).stop().animate({paddingLeft:'10px'},600);
});

  $('span#skip').mouseout(function(){
       $(this).stop().animate({paddingLeft:'0px'},400);
});
  $('span#skip').click(function(){
  $('div#all_black').stop().hide();
  $('div#edit_profile').stop().animate({top:'-100%'},1000);
});
</script>
<?php
      }//end of check for new user
?>
<div id="main">
<div id="right_part"> 
<div id="all_cats">
<div class="l_tile"><h1><a href="books.php?t=COLLEGE"> COLLEGE</a></h1></div> <!--end of genre open-->
<div class="l_tile"><h1><a href="books.php?t=LOCALITY"> LOCALITY</a></h1></div> <!--end of genre open-->
<div class="l_tile"><h1><a href="readers.php"> READERS</a></h1></div> <!--end of genre open-->
<div class="l_tile"><h1><a href="addbook.php"> ADD BOOK</a></h1></div> <!--end of genre open-->
</div>           <!--end of all cat-->
<div id="trending_books">
 <p>TRENDING BOOKS</p>
  <img src="images/books/1114536031854214.jpg" / >
  <img src="images/books/121453603474965733.jpg" / >
  <img src="images/books/121453603474965733.jpg" / >
</div>           <!--end of trending books-->
</div>        <!--end of right part--> 
<div id="save_success">
 <h4>Saved to Profile <br />Successfully!</h4>
</div>             <!--end of send request-->
<div id="save_fail">
 <h4>Request Failed!</h4>
</div>             <!--end of send request-->
<script type="text/javascript"> 
setInterval(hide_msg,10000);
       function hide_msg(){
     $('div#save_success').fadeOut();
};  
setInterval(hidefail_msg,10000);
       function hidefail_msg(){
     $('div#save_fail').fadeOut();
}; 
</script>
<div id="left_part">
 <h1 class="section_main_title">Hello <?php echo $row1['name'];?></h1>
 <div id="ab_book">  
 <div id="top_part"> 
  <div id="edit_proile_link">
   <input type="button" value="EDIT PROFILE" />
    </div>        <!--end of edit profile link-->
<?php
      if(!isset($_GET['new_user'])){
?>
<div id="edit_profile">
 <form method="POST" action="editprofile.php" id="edit_to_profile">
 <div id="form_right"> 
  <h1>SOCIAL DETAILS</h1>
         <?php
                           if(!empty($row1['facebook'])){ echo '<p class="hiden_val">Facebook: '.$row1['facebook'].'</p>'; echo'<input type="hidden" name="facebook" value="'.$row1['facebook'].'" /><br />';}else{
?>
 <input type="text" name="facebook" title="Facebook Profile Link" placeholder="Facebook Profile Link" /><br/>
 <?php
        }//end of check for facebook link
?>
         <?php
                           if(!empty($row1['twitter'])){ echo '<p class="hiden_val">Twitter: '.$row1['twitter'].'</p>';  echo'<input type="hidden" name="twitter" value="'.$row1['twitter'].'" /><br />';}else{
?>
 <input type="text" name="twitter" title="Twitter Profile Link" placeholder="Twitter Profile Link" /><br/>
 <?php
          }//end of check for twitter link
?>
         <?php
                           if(!empty($row1['linkedin'])){ echo '<p class="hiden_val">Linkedin: '.$row1['linkedin'].'</p>';  echo'<input type="hidden" name="linkedin" value="'.$row1['linkedin'].'" /><br />';}else{
?>
 <input type="text" name="linkedin" title="Linkedin Profile Link" placeholder="Linkedin Profile Link" /><br/>
<?php
    }//end of check for linked in profile  
?>
  </div>      <!--end of form right-->
 <div id="form_left"> 
  <h1>PROFILE DETAILS</h1>
         <?php
                           if(!empty($row1['college'])){ echo '<p class="hiden_val">College: '.$row1['college'].'</p>';  echo'<input type="hidden" name="college" value="'.$row1['college'].'" /><br />';}else{
?>
   <select name="college" title="Select College"> 
     <option>Please Select Your College</option>
     <option value="G. B. PANT ENGINEERING COLLEGE">G. B. PANT ENGINEERING COLLEGE</option>
     </select><br/>
<?php
     }//end of check for college
?>
         <?php
                           if(!empty($row1['address'])){ echo '<p class="hiden_val">Address: '.$row1['address'].'</p>';  echo'<input type="hidden" name="address" value="'.$row1['address'].'" /><br />';}else{
?>
   <textarea name="address" title="Enter Complete Address" required placeholder="Complete Address"></textarea>
 <?php
          }//end of check for address
?>  
 </div>      <!--end of form left-->
  <input type="button" id="save_profile" value="EDIT PROFILE" /> <span id="skip">CLOSE</span>
  <b><p>Fields once filled can't be edited later!</p></b>
  </form>
<script type="text/javascript">
   $('form#edit_to_profile input[type="button"]').click(function(){
      var data = $('form#edit_to_profile input, select, textarea').serializeArray();
      $.post($('form#edit_to_profile').attr('action'),data,function(json){
             if(json){
                $('div#save_success').fadeIn();  
              $('div#all_black').stop().hide();
              $('div#edit_profile').stop().animate({top:'-100%'},1000);            
 }
             if(json.status=="fail"){
                $('div#save_fail').show();                
 }
});
}); 
</script>
</div>           <!--end of edit profile-->
<?php
       }//end of check for not a new user
?>
   <div id="u_img">
    <img src="images/website-part/<?php echo $row1['image'];?>" alt="User Image" />
    <p class="repo">REPO: <span><?php echo $row1['repo'];?></span></p>
     </div>    
   <div id="b_info">
     <h1 class="values">Books in Shelf: <span><?php echo $tbooks;?></span></h1>
     <h1 class="values">Facebook: <a href="<?php echo $row1['facebook'];?>"><span><?php echo $row1['facebook'];?><span></a></h1>
     <h1 class="values">Linkedin: <a href="<?php echo $row1['linkedin'];?>"><span><?php echo $row1['linkedin'];?><span></a></h1>
     <h1 class="values">Twitter: <a href="<?php echo $row1['twitter'];?>"><span><?php echo $row1['twitter'];?><span></a></h1>
     </div>       <!--end of b info-->
  </div> <!--end of toppart-->
 <div id="pro_details">
  <h1 class="sec_title">PROFILE DETAILS</h1>
     <h1 class="values">College: <?php echo $row1['college'];?></h1>
     <h1 class="values">Address: <?php echo $row1['address'];?></h1>
     <h1 class="values">Email: <?php echo $row1['email'];?></h1>
     <h1 class="values">Date Joined: <?php echo $row1['date_added'];?></h1>
  </div>           <!--end of pro details-->
 </div>   <!--end of ab_book-->  
</div>       <!--end of left part-->  
 <h1 class="section_main_title">YOUR BOOKSHELF</h1>
 <?php 
         //script to show all the readers
     $query3  = "SELECT * FROM user_books WHERE user_id='".$_SESSION['user_id']."'";
     $result3 = @mysqli_query($dbc, $query3)or die("Error with query 3");
      if(mysqli_num_rows($result3)==0){
?>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry nothing found in BookShelf!</h1>
</div>                        <!--end of opps sory no result found-->
<?php
           }else{
              while($row3 = mysqli_fetch_array($result3)){
     $query4  = "SELECT * FROM book_stock WHERE book_id='".$row3['book_id']."' LIMIT 1";
     $result4 = @mysqli_query($dbc, $query4)or die("Error with query4");  
             $row4 = mysqli_fetch_array($result4);
?>  
<div class="tile">
 <div class="eb_img" >
 <a href="book.php?id=<?php echo $row4['book_id'];?>"><img rel="tooltip" title="<?php echo $row4['bname'];?>" src="images/books/<?php echo $row4['bimage'];?>" alt="<?php echo $row4['bname'];?>" /></a>
 </div>                                 <!--end of img div-->
 <a href="book.php?id=<?php echo $row4['book_id'];?>" id="partial_name_show"><p class="title"><?php echo substr($row4['bname'],0,16);?>..</p></a>
 <a href="book.php?id=<?php echo $row4['book_id'];?>" id="full_name_show"><p class="title"><?php echo $row4['bname'];?></p></a>
 <p class="view_book"><a href="book.php?id=<?php echo $row4['book_id'];?>"></i>View Book</a></p>
</div>            <!--end of tile--> 
<?php
 }//end of while loop to check for users
}//end of check for book found in shelf
?>
</div>      <!--end of main-->
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
<?php
            }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookBoT, Stay connected with readers near you!</title>
  <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css" type="text/css" media="all" /> 
  <link rel="stylesheet" href="css/nosession.css" type="text/css" media="all" />
</head>
<body>
<div id="img_back">
<img src="images/stack/notepad.png" id="main_img" />
</div>
<h1>You have Logged Out of your account.</h1>
</body>
</html>

<?php
        }//end of check for user loged in
?>