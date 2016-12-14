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
  <title>Add Book to Shelf | BookBoT, Stay connected with readers near you!</title>
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
<?php
            //script to  process add request
   if(isset($_POST['add_book'])){
   function test_input($data){  
      $data = trim($data);
      $data = stripslashes($data); 
      $data = htmlspecialchars($data);  
         return $data;
        }      
            $bname = test_input($_POST['bname']);
            $aname = test_input($_POST['aname']);
            $cat = test_input($_POST['cat']);
            $desc = test_input($_POST['desc_book']);
  if((!empty($bname)) && (!empty($aname)) && (!empty($desc)) && (!empty($cat))){
               $i = $_FILES['bimg']['name'];
                                                               //define loacation for images                                                                    
              define('front_img','images/books/');
    $query15  = "SELECT * FROM book_stock WHERE bname='$bname'";
    $result15 = @mysqli_query($dbc, $query15)or die("Error with Query15");
    if(mysqli_num_rows($result15)=='0'){
                    $ftarget = front_img.time().$i; 
                    $fname_fimage = time().$i;
     if(move_uploaded_file($_FILES['bimg']['tmp_name'], $ftarget)){  
               $query16  = "INSERT INTO book_stock VALUES(0,'$bname', '$aname', '$fname_fimage', '$cat', '$desc')";
               $result16 = @mysqli_query($dbc, $query16)or die("Error with query16"); 
            if($result16){
                 //get the same book id
               $query17  = "SELECT * FROM book_stock WHERE bname='$bname' AND aname='$aname' AND main_cat='$cat' AND bdesc='$desc' LIMIT 1";
               $result17 = @mysqli_query($dbc, $query17)or die("Error with query17");  
                   $row17 = mysqli_fetch_array($result17);
               //enter book d and user id
                $query18  = "INSERT INTO user_books VALUES('0', '".$row17['book_id']."', '".$_SESSION['user_id']."', NOW())";
                $result18 = @mysqli_query($dbc, $query18)or die("Error with query18"); 
                 if($result18){ 
              //add repo
         $query19  = "SELECT * FROM user_registered WHERE user_id = '".$_SESSION['user_id']."'";
         $result19 = @mysqli_query($dbc, $query19)or die("Error with query 19"); 
              $row19 = mysqli_fetch_array($result19);
            $incre = $row19['repo'] + '10';
         $query20  = "UPDATE user_registered SET repo = '$incre' WHERE user_id= '".$_SESSION['user_id']."'";
         $result20 = @mysqli_query($dbc, $query20)or die("Error with query 20");   
  ?>
<div class="succ-msg reg_war"><div class="succ_inside"><p> Book Added to your shelf <i class="fa fa-check icon_error "></i></p></div></div>
<script type="text/javascript">
     $('div.succ-msg').show(); 
   setInterval(showErr,10000);
       function showErr(){
     $('div.succ-msg').fadeOut();
}; 
</script>
<?php  
                  }else{
            ?>
<div class="war-msg reg_war"><div class="error_inside"><p><i class="fa fa-exclamation icon_error "></i> Error adding book to bookshelf</p></div></div>
<script type="text/javascript">
     $('div.war-msg').fadeIn(); 
   setInterval(showErr,10000);
       function showErr(){
     $('div.war-msg').fadeOut();
}; 
</script>
<?php  
                    }//end of book adding error
                     }else{
            ?>
<div class="war-msg reg_war"><div class="error_inside"><p><i class="fa fa-exclamation icon_error "></i> Error adding book to bookshelf</p></div></div>
<script type="text/javascript">
     $('div.war-msg').fadeIn(); 
   setInterval(showErr,10000);
       function showErr(){
     $('div.war-msg').fadeOut();
}; 
</script>
<?php  
                    }//end of book adding error
 }else{
            ?>
<div class="war-msg reg_war"><div class="error_inside"><p><i class="fa fa-exclamation icon_error "></i> Error uploading book image </p></div></div>
<script type="text/javascript">
     $('div.war-msg').fadeIn(); 
   setInterval(showErr,10000);
       function showErr(){
     $('div.war-msg').fadeOut();
}; 
</script>
<?php  
                    }//end of book size error 
  }else{
            ?>
<div class="war-msg reg_war"><div class="error_inside"><p><i class="fa fa-exclamation icon_error "></i> This book is present in your bookshelf </p></div></div>
<script type="text/javascript">
     $('div.war-msg').fadeIn(); 
   setInterval(showErr,10000);
       function showErr(){
     $('div.war-msg').fadeOut();
}; 
</script>
<?php  
                    }//end of book size error 
             }else{
            ?>
<div class="war-msg reg_war"><div class="error_inside"><p><i class="fa fa-exclamation icon_error "></i> OOPs all fields are required </p></div></div>
<script type="text/javascript">
     $('div.war-msg').fadeIn(); 
   setInterval(showErr,10000);
       function showErr(){
     $('div.war-msg').fadeOut();
}; 
</script>
<?php  
                    }//end of book size error 
}//end of isset for add book
?>
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
 <h1 class="section_main_title">ADD BOOK TO SHELF</h1>
 <div id="ab_book">  
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
   <div id="u_img">
    <img src="images/website-part/books-1316306_640.png" alt="User Image" />
   <p><center><i>Book Image</i></center></p>
    <input type="file" name="bimg" placeholder="Book Image" value="BOOK IMAGE" id="image_upload" title="Upload Book Image" />  
     </div>    
   <div id="b_add_info">
      <input type="text" name="bname" placeholder="Book Name..." title="Enter Book Name" required /><br />
      <input type="text" name="aname" placeholder="Author Name..." title="Enter Author Name" required /><br />
      <select name="cat" title="Select Book Category">
          <option>Select Book Category</option>
          <option value="COURSE BOOKS">COURSE BOOKS</option>
          <option value="NOVELS">NOVELS</option>
          <option value="SAMPLE PAPERS">SAMPLE PAPERS</option>
          <option value="NOTES">NOTES</option>
           </select><br />
      <textarea name="desc_book" required title="Enter About Book" placeholder="About Book(in 3 to 4 lines)..."></textarea></br >
      <input type="submit" name="add_book" value="ADD TO SHELF" />
    </form>     </div>       <!--end of b add info-->
 </div>   <!--end of ab_book-->  
</div>       <!--end of left part-->  
 <h1 class="section_main_title">YOUR BOOKSHELF (Total Books: <?php echo $tbooks; ?>)</h1>
 <?php 
         //script to show all the readers
     $query3  = "SELECT * FROM user_books WHERE user_id='".$_SESSION['user_id']."'";
     $result3 = @mysqli_query($dbc, $query3)or die("Error with query 3");
      if(mysqli_num_rows($result3)==0){
?>
<div class="opps_n_rlt_f">
 <img src="images/website-part/books.png" alt="No result found image" />
 <h1>OOPs, Sorry no book found in your BookShelf!</h1>
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