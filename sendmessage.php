<?php
 @session_start();
   if(isset($_SESSION['user_id'])){
        $dbc = @mysqli_connect('localhost', 'soamiji', 'soami@99026', 'radhasoami_avneel')or die("error connecting to database");
 date_default_timezone_set( 'Asia/Kolkata' );
 mysqli_query( $dbc, "SET time_zone='" . date( 'P' ) . "'" );
   if(isset($_POST['group']) && isset($_POST['to_user'])){
      $query1  = "INSERT INTO messages VALUES('0', '".$_POST['group']."', '".$_POST['to_user']."','".$_SESSION['user_id']."','".$_POST['msg']."', NOW())";
      $result1 = @mysqli_query($dbc, $query1)or die("Error with query 1");           
           //update group latest msg
      $query2  = "UPDATE message_group SET latest_msg = '".$_POST['msg']."', to_user='".$_POST['to_user']."', from_user='".$_SESSION['user_id']."' WHERE group_id='".$_POST['group']."'";
      $result2 = @mysqli_query($dbc, $query2)or die("Error with query2");    
  }//end of check for isset                     
}//end of check for session

?>