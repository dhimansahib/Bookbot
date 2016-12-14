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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" /> 	 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="" >
  <meta name="keywords" content="" />
  <title>Messages | BookBoT, Stay connected with readers near you!</title>
  <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.min.css" type="text/css" media="all" />                              <!--for whole body-->         
  <link rel="stylesheet" href="css/main.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/secondary.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/signup.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/tile.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/viewuser.css" type="text/css" />                                     <!--for whole body--> 
  <link rel="stylesheet" href="css/messages.css" type="text/css" />                                     <!--for whole body--> 
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
      <p><a href="messages.php">MESSAGES</a></p>
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
<div id="main">
<div id="right_part"> 
<div id="all_cats">
<div class="l_tile"><h1><a href="books.php?t=COLLEGE"> COLLEGE</a></h1></div> <!--end of genre open-->
<div class="l_tile"><h1><a href="books.php?t=LOCALITY"> LOCALITY</a></h1></div> <!--end of genre open-->
<div class="l_tile"><h1><a href="readers.php"> READERS</a></h1></div> <!--end of genre open-->
</div>           <!--end of all cat-->
<div id="trending_books">
 <p>TRENDING BOOKS</p>
  <img src="images/books/1114536031854214.jpg" / >
  <img src="images/books/121453603474965733.jpg" / >
  <img src="images/books/121453603474965733.jpg" / >
</div>           <!--end of trending books-->
</div>        <!--end of right part--> 
<div id="left_part">
  <div id="inbox">
   <h1 class="block_heading">INBOX</h1>
    <?php
              //get all message groups
       $query4  = "SELECT * FROM message_group WHERE from_user='".$_SESSION['user_id']."' OR to_user='".$_SESSION['user_id']."' ORDER BY date DESC";
       $result4 = @mysqli_query($dbc, $query4)or die("Error with query4");
                      if(mysqli_num_rows($result4)==0){
           }else{
          while($row4 = mysqli_fetch_array($result4)){     
       if($row4['to_user']==$_SESSION['user_id']){
            $query5  = "SELECT * FROM user_registered WHERE user_id='".$row4['from_user']."' LIMIT 1";
            $result5 = @mysqli_query($dbc, $query5)or die("Error with query5"); 
                $row5 = mysqli_fetch_array($result5);
                  $img = $row5['image'];
                  $name = $row5['name']; 
            }else{
            $query5  = "SELECT * FROM user_registered WHERE user_id='".$row4['to_user']."' LIMIT 1";
            $result5 = @mysqli_query($dbc, $query5)or die("Error with query5"); 
                $row5 = mysqli_fetch_array($result5);
                  $img = $row5['image'];
                  $name = $row5['name'];
         }//end of check for other user
 ?>
<a href="messages.php?gid=<?php echo $row4['group_id'];?>">
<div class="grp_tile">
  <img src="images/website-part/<?php echo $img;?>" alt="user image" /> 
  <div class="right_info">
   <b><?php echo $name;?></b> <br /><?php if($row4['from_user']==$_SESSION['user_id']){echo'<i>Sent Message</i>';}else{echo'<i>Received Message</i>';}?><br />
   <?php echo substr($row4['latest_msg'],0);?>
   </div>         <!--end of right info --> 
</div>      <!--end of grp tile--></a>
<?php
           }//end of while loop for groups
          }//end of check for groups
?>
   </div>             <!--end of inbox-->
  <div id="chat">
   <h1 class="block_heading">MESSAGES</h1>
   <?php 
      //show user messages
     if(isset($_GET['gid'])){
            //get messages from database
         $query6  = "SELECT * FROM messages WHERE group_id='".$_GET['gid']."' ORDER BY date ASC";
         $result6 = @mysqli_query($dbc, $query6)or die("Error with query6"); 
                     while($row6 = mysqli_fetch_array($result6)){
    //script to select from sender
        if($row6['m_from_user']==$_SESSION['user_id']){
           $id = $row6['m_to_user'];
            $query7  = "SELECT * FROM user_registered WHERE user_id='".$row6['m_to_user']."' LIMIT 1";
            $result7 = @mysqli_query($dbc, $query7)or die("Error with query7"); 
                $row7 = mysqli_fetch_array($result7);
                  $img = $row7['image'];
                  $name = $row7['name']; 
?>
  <div class="msg_tile sent">
       <img src="images/website-part/you.png" alt="You" /> 
      <div class="msg_body">
        <span><i class="fa fa-globe"></i> <?php echo $row6['date'];?></span>
        <p><?php echo $row6['msg'];?></p>
     </div>     <!--end of msg body-->
   </div>         <!--end of msg tile-->
<?php
     }//end of check for sender
        if($row6['m_to_user']==$_SESSION['user_id']){
 $id = $row6['m_from_user'];
            $query7  = "SELECT * FROM user_registered WHERE user_id='".$row6['m_from_user']."' LIMIT 1";
            $result7 = @mysqli_query($dbc, $query7)or die("Error with query7"); 
                $row7 = mysqli_fetch_array($result7);
                  $img = $row7['image'];
                  $name = $row7['name']; 
?>
  <div class="msg_tile receve">
       <img src="images/website-part/<?php echo $img;?>" alt="You" /> 
      <div class="msg_body">
        <span><b><a href="reader.php?id=<?php echo $row6['m_from_user'];?>" class="text_name_links"><?php echo $name;?></a></b> <i class="fa fa-globe"></i> <?php echo $row6['date'];?></span>
        <p><?php echo $row6['msg'];?></p>
     </div>     <!--end of msg body-->
      
   </div>         <!--end of msg tile-->
<?php
               }//end of check for msg recieved
             }//end of while loop
?>
<div id="send_msg"> 
 <form method="POST" action="sendmessage.php" id="send_msg">
   <input type="hidden" name="group" value="<?php echo $_GET['gid'];?>" />
   <input type="hidden" name="to_user" value="<?php echo $id;?>" />
   <input type="hidden" name="from_user" value="<?php echo $_SESSION['user_id'];?>" />
   <input type="text" name="msg" placeholder="Type Here..." />
   <input type="button" value="SEND" />
  </from>
<div id="success_msg">
 <h4>Message Sent Successfully! REFRESH NOW</h4>
</div>             <!--end of send request-->
<div id="fail_msg">
 <h4>Request Failed!</h4>
</div>             <!--end of send request-->
<script type="text/javascript"> 
setInterval(hide_msg,10000);
       function hide_msg(){
     $('div#success_msg').fadeOut();
};  
setInterval(hidefail_msg,10000);
       function hidefail_msg(){
     $('div#fail_msg').fadeOut();
}; 
</script>
<script type="text/javascript">
   $('form#send_msg input[type="button"]').click(function(){
      var data = $('form#send_msg input').serializeArray();
      $.post($('form#send_msg').attr('action'),data,function(json){
                  $('div#success_msg').show();     
             if(json){           
 }
             if(json.status=="fail"){
                 $('div#fail_msg').show();                
 }
});
}); 
</script>
</div>       <!--end of send msg-->
  </div>             <!--end of chat-->
<?php
         }//end of isset for group id  
?>
</div>                <!--end of left part-->
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