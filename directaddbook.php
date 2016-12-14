<?php
 @session_start();
   if(isset($_POST['book_id'])){

        $dbc = @mysqli_connect('localhost', 'soamiji', 'soami@99026', 'radhasoami_avneel')or die("error connecting to database");
 date_default_timezone_set( 'Asia/Kolkata' );
 mysqli_query( $dbc, "SET time_zone='" . date( 'P' ) . "'" );
         
            $query  = "INSERT INTO user_books VALUES('0', '".$_POST['book_id']."', '".$_SESSION['user_id']."', NOW())";
            $result = @mysqli_query($dbc, $query)or die("Error with query");
  if($result){
         //add repo
         $query1  = "SELECT * FROM user_registered WHERE user_id = '".$_SESSION['user_id']."'";
         $result1 = @mysqli_query($dbc, $query1)or die("Error with query 1"); 
              $row1 = mysqli_fetch_array($result1);
            $incre = $row1['repo'] + '10';
         $query2  = "UPDATE user_registered SET repo = '$incre' WHERE user_id= '".$_SESSION['user_id']."'";
         $result2 = @mysqli_query($dbc, $query2)or die("Error with query 2");   
}

}//end of check for book id isset
?>