<?php
        
          if(!empty($_POST['username'])){
       
 
        $dbc = @mysqli_connect('localhost', 'soamiji', 'soami@99026', 'radhasoami_avneel')or die("error connecting to database");
date_default_timezone_set( 'Asia/Kolkata' );
mysqli_query( $dbc, "SET time_zone='" . date( 'P' ) . "'" );
         $query  = "SELECT * FROM user_registered WHERE email='".$_POST['email']."' ";
        $result = @mysqli_query($dbc, $query)or die("Error with quer");
               if(mysqli_num_rows($result)==1){
                             echo'<i class="fa fa-times not_avail" rel="tooltip" title="This email is in use!"></i>';
                    }else{
                   echo'<i class="fa fa-check avail"  rel="tooltip" title="Can use this email!"></i>';
}
 
}//end of isset for username

?>