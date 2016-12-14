<?php
 @session_start();
   if(isset($_SESSION['user_id'])){
        $dbc = @mysqli_connect('localhost', 'soamiji', 'soami@99026', 'radhasoami_avneel')or die("error connecting to database");
 date_default_timezone_set( 'Asia/Kolkata' );
 mysqli_query( $dbc, "SET time_zone='" . date( 'P' ) . "'" );
   if(isset($_POST['book_id']) && isset($_POST['to_user_id'])){
           
 $query_book  = "SELECT * FROM book_stock WHERE book_id='".$_POST['book_id']."' LIMIT 1";
             $result_book = @mysqli_query($dbc, $query_book)or die("Error with query book");
                   $row_book = mysqli_fetch_array($result_book);
             $query1  = "SELECT * FROM send_book_request WHERE to_user='".$_POST['to_user_id']."' AND from_user='".$_SESSION['user_id']."' AND book_id='".$_POST['book_id']."'";
             $result1 = @mysqli_query($dbc, $query1)or die("Error with query1");   
                      if(mysqli_num_rows($result1)==0){
             $query2  = "INSERT INTO send_book_request VALUES('0', '".$_POST['to_user_id']."', '".$_SESSION['user_id']."', '".$_POST['book_id']."', NOW())";
             $result2 = @mysqli_query($dbc, $query2)or die("Error with query2");  
               if($result2){
             $msg_notf = 'Reader is interested in the book you have!';  
             $msg_friend = 'Hi <i class="fa fa-smile-o"></i>!, <br />I hope you are doing great. I saw your bookshelf and loved the books you have. I want to read <u><b><a href="book.php?id='.$_POST['book_id'].'" class="text_name_links">'.$row_book['bname'].'</a></b></u> By: '.$row_book['aname'].' and have a cup of coffee with you.';
             $query3  = "INSERT INTO notifications VALUES('0', '".$_POST['to_user_id']."', '".$_SESSION['user_id']."', '$msg_notf', '0')";
             $result3 = @mysqli_query($dbc, $query3)or die("Error with query3");  
                        //check for already in a group
             $query4  = "SELECT * FROM message_group WHERE to_user='".$_POST['to_user_id']."' AND from_user='".$_SESSION['user_id']."' OR to_user='".$_SESSION['user_id']."' AND from_user='".$_POST['to_user_id']."'";
             $result4 = @mysqli_query($dbc, $query4)or die("Error with query4");
                      if(mysqli_num_rows($result4)==0){
             $query5  = "INSERT INTO message_group VALUES('0', '".$_POST['to_user_id']."', '".$_SESSION['user_id']."', '$msg_friend', NOW())";
             $result5 = @mysqli_query($dbc, $query5)or die("Error with query5");      
}else{
             $query6  = "UPDATE message_group SET latest_msg='$msg_friend' WHERE to_user='".$_POST['to_user_id']."' AND from_user='".$_SESSION['user_id']."' OR to_user='".$_SESSION['user_id']."' AND from_user='".$_POST['to_user_id']."'";
             $result6 = @mysqli_query($dbc, $query6)or die("Error with query6");  
     }//end of check for grop created or not    
              //get group id of the user
             $query7  = "SELECT * FROM message_group WHERE to_user='".$_POST['to_user_id']."' AND from_user='".$_SESSION['user_id']."' OR to_user='".$_SESSION['user_id']."' AND from_user='".$_POST['to_user_id']."'";
             $result7 = @mysqli_query($dbc, $query7)or die("Error with query7");
                      $row7 = mysqli_fetch_array($result7);
                 //insert into messages
             $query8  = "INSERT INTO messages VALUES('0', '".$row7['group_id']."', '".$_POST['to_user_id']."','".$_SESSION['user_id']."','$msg_friend', NOW())";
             $result8 = @mysqli_query($dbc, $query8)or die("Error with query 8");                        
   }//end of check for request sent
 }//end of check for no request sent
}//end of isset for book id and to user
}//end of isset for user logged in
?>