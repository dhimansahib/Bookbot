<?php
 @session_start();
   if(isset($_SESSION['user_id'])){
        $dbc = @mysqli_connect('localhost', 'soamiji', 'soami@99026', 'radhasoami_avneel')or die("error connecting to database");
 date_default_timezone_set( 'Asia/Kolkata' );
 mysqli_query( $dbc, "SET time_zone='" . date( 'P' ) . "'" );
         //get user repo points
      $query1  = "SELECT * FROM user_registered WHERE user_id='".$_SESSION['user_id']."'";
      $result1 = @mysqli_query($dbc, $query1)or die("Error with query 1");
            $row1 = mysqli_fetch_array($result1);
          $repo = $row1['repo'];
         if(!empty($_POST['facebook'])){
           if(empty($row1['facebook'])){
                $repo = $repo+2;
 }
} 
         if(!empty($_POST['twitter'])){   
       if(empty($row1['twitter'])){
                $repo = $repo+2;
}
} 
         if(!empty($_POST['linkedin'])){
       if(empty($row1['linkedin'])){
                $repo = $repo+2;
}
} 
         if(!empty($_POST['address'])){
       if(empty($row1['address'])){
                $repo = $repo+5;
}
}
            $query  = "UPDATE user_registered SET repo='$repo',facebook='".$_POST['facebook']."', twitter='".$_POST['twitter']."', linkedin='".$_POST['linkedin']."', college='".$_POST['college']."', address='".$_POST['address']."' WHERE user_id='".$_SESSION['user_id']."'";
            $result = @mysqli_query($dbc, $query)or die("Error with query");
   if($result){
     echo'success';
}else{
     echo'Problem Saving To Profile';
}

}//end of check for book id isset
?>