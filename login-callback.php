<?php
 session_start();
  require_once 'src/Facebook/autoload.php';
  $fb = new Facebook\Facebook([
    'app_id' => '268196090229712',
    'app_secret' => 'ebfdd3efb5ab0d984eaf4cd2beb9e2a0',
    'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}

// OAuth 2.0 client handler
$oAuth2Client = $fb->getOAuth2Client();

// Exchanges a short-lived access token for a long-lived one
$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

// Sets the default fallback access token so we don't have to pass it to each request
$fb->setDefaultAccessToken($longLivedAccessToken);

try {
  $response = $fb->get('/me?fields=id,first_name,last_name');
  $user = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
    $id   = $user->getId();
    $f_name = $user['first_name'];
    $l_name = $user['last_name'];
    $name =   $f_name.' '.$l_name;
         //script to register use 
		            
                 //register user
  
        $dbc = @mysqli_connect('182.50.133.81:3306', 'rsdhimanabhi', 'Bn@tc359', 'AVNE1RADHASOAMI_books_db')or die("error connecting to database");
   
    date_default_timezone_set( 'Asia/Kolkata' );
mysqli_query( $dbc, "SET time_zone='" . date( 'P' ) . "'" );
        $query  = "SELECT * FROM user_registered WHERE third_party='$id' LIMIT 1";
       
           $result = @mysqli_query($dbc, $query)or die("Error with query");   			  
			
                     if(mysqli_num_rows($result)=='0'){ 
		 
           $query1  = "INSERT INTO user_registered VALUES(0, '$name', '0', '0', '$id', NOW(), 'user.png', '0', '0', '0', '0', '0', '0')";      //00001 is for facebook
       
           $result1 = @mysqli_query($dbc, $query1)or die("Problem With Query1");
                            
              if($result1){
       
           $query2  = "SELECT * FROM user_registered WHERE third_party='$id' LIMIT 1";
       
           $result2 = @mysqli_query($dbc, $query2)or die(" Problem with query2");  
           
              if(mysqli_num_rows($result2)=='1'){   
                       
                $row2 = mysqli_fetch_array($result2);       
                           
           //make direct login
                           
            $_SESSION['user_id']  = $row2['user_id'];     
            //set session variable for user_id 
                                      
                                                  $form_team = "0";
                                                 $msg  = 'Hello <i class="fa fa-smile-o"></i>!<br /> This is the prototype of BookBot... <br /> So the number of books is limited only. ';
                                            $query5  = "INSERT INTO notifications VALUES('0', '".$row3['user_id']."', '$form_team', '$msg','0')";
                                            $result5 = @mysqli_query($dbc, $query5)or die("Error with query5"); 
                     header('Location:profile.php?new_user=true');                               	
      	                    	 }//end of select user id after register		
 		          }//end of check for successfull register
		
       		                                                                                }else{
	 //check for user already registered		
 		   $row = mysqli_fetch_array($result);
						
		 $_SESSION['user_id']  = $row['user_id'];      //set session variable for user_id 
                     header('Location:books.php'); 
	
				   
				   }//end of check for already registered
?>