<?php
include('connect.php');
	
$conn =  db_connect();


function get_Account_Fav_Posts($conn, $username){

	  	$query =  sprintf("SELECT post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited, post_text
          	 	FROM `csc370 Project`.Posts posts
      	 	    join favourite fav on fav.fav_post_ID = posts.post_id
				      join User user on fav.fav_user_ID = user.user_id
      	  	 	WHERE user.user_name = '%s';",
             	mysqli_real_escape_string($conn, $username)); 

	  	$result = mysqli_query($conn, $query);
	  	$json = array();
        
        if (!$result) {
            $error = sprintf("Query Failed: %s", mysql_error());
        }

         if($result>0)
      {
          //parse data
          while($row = mysqli_fetch_assoc($result)) { 
            	echo 
              '<div postid="'.$row['post_id'].'">
               <div> "upvote:"'.$row['up_vote'].', "down_vote:"'.$row['down_vote'].' </div>
               <li>' .$row['post_title'].'--------------'.($row['post_text']).'</li>
               </div>
               </li>';
          }     
      }
}


function get_Account_Friend_Fav_Posts($conn, $username){

	   	 $query =  sprintf("SELECT post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited, post_text
          	 	FROM `csc370 Project`.Posts posts
      	 	    join User user on Posts.post_user = user.user_id
				      join Friends friend on friend.user_Friend = posts.post_user
				      join favourite fav on fav.fav_post_ID = posts.post_id
      	  	 	WHERE user.user_name != '%s';",
             	mysqli_real_escape_string($conn, $username));

	   	  $result = mysqli_query($conn, $query);

	   	  $result = mysqli_query($conn, $query);
	  		$json = array();
        
        if (!$result) {
            $error = sprintf("Query Failed: %s", mysql_error());
        }

         if($result>0)
      {
          //parse data
          while($row = mysqli_fetch_assoc($result)) { 
            	 echo 
              '<div postid="'.$row['post_id'].'">
               <div> "upvote:"'.$row['up_vote'].', "down_vote:"'.$row['down_vote'].' </div>
               <li>' .$row['post_title'].'--------------'.($row['post_text']).'</li>
               </div>
               </li>';
          }     
      }
}

  $username = $_POST['name'];
  $check=$_POST['fav'];
  if($check){
    get_Account_Friend_Fav_Posts($conn, $username);
  }else{
     get_Account_Fav_Posts($conn, $username);
  }
 

