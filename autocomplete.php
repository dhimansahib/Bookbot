<?php
          if(!empty($_POST['q'])){ 
        $dbc = @mysqli_connect('localhost', 'soamiji', 'soami@99026', 'radhasoami_avneel')or die("error connecting to database");
date_default_timezone_set( 'Asia/Kolkata' );
mysqli_query( $dbc, "SET time_zone='" . date( 'P' ) . "'" );
              $search = $_POST['q'];
           $search_query = "SELECT * FROM book_stock";
                       $where_list = array();
              $search_words = explode(' ', $search);
              foreach($search_words as $word){
              $where_list[]="bname LIKE'%$word%' ";
                }//end of foreach       
              $where_clause = implode(' OR ', $where_list);
              if(!empty($where_clause)){
              $search_query.="  WHERE $where_clause ORDER BY rand() LIMIT 5";
        $result = @mysqli_query($dbc, $search_query)or die("Error with $search_query");
               if(mysqli_num_rows($result)!='0'){
               while($row = mysqli_fetch_array($result)){
                              echo'<p><a href="book.php?id='.$row['book_id'].'"> <img src="images/books/'.$row['bimage'].'" class="autosearch_img" /> <b>'.$row['bname'].' </b> </a></p>';                   
       }//end of while loop for result
}
      }//end of where clause present
 
}//end of isset for username

?>