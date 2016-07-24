
<?php

include('connect.php');


	// Function for connecting to the saiddit database
    //if user is not logged in, show posts of default subsdaiddits
    $conn =  db_connect();
	function getHomePage_Post($conn){
		
		//select default posts
		$default = "Y";

    $query =  sprintf("SELECT post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited, post_text 
      	 	   FROM `csc370 Project`.Posts posts
      	 	   Join Subsaiddits subsaid on subsaiddits_id = post_subsaiddits
      	     WHERE subsaiddits_is_default = '%s'
             order by posts.up_vote-posts.down_vote DESC;",
             mysqli_real_escape_string($conn, $default));
      	
      	$result = mysqli_query($conn, $query);
         
      	if (!$result) {
            $error = sprintf("Query Failed: %s", mysql_error());
        }
      	if($result>0){
      		//parse data
      		while($row = mysqli_fetch_assoc($result)) {   
      		  echo 
              '<div postid="'.$row['post_id'].'">
               <div> "upvote:"'.$row['up_vote'].', "down_vote:"'.$row['down_vote'].' </div>
               <li>' .$row['post_title'].'--------------'.($row['post_text']).'</li>
                <button onclick="get_delete_Posts()" class="button round" >Delete</button>
               </div>
               </li>';   
               //$new_array[ $row['post_id']] = $row;      			
      	 	}	
      	} 

      	//$myJSONString = json_encode($new_array);

        //printf($myJSONString);
      	
	}  

    
	//if user is logged in, show posts of subscribed subsaiddits
	function get_Account_Post($conn, $username){

             $query =  sprintf("SELECT post_id, post_title, post_URL, 
             	up_vote, down_vote, post_published, post_edited, post_text 
          	 FROM `csc370 Project`.subscribe sub 
      	 	   join Subsaiddits subsaid on subsaid.subsaiddits_id = sub.subscribe_subsaid_id
			       join User user on user.user_id = sub.subscribe_user_id
			       join Posts post on post.post_subsaiddits = subsaiddits_id
      	  	 WHERE user_name = '%s'
      	  	 order by post.up_vote-post.down_vote DESC;", 
             mysqli_real_escape_string($conn, $username));

             $result = mysqli_query($conn, $query);
             
             if (!$result) {
            	$error = sprintf("Query Failed: %s", mysql_error());
        	}

             
        if($result>0){
      		//parse data
      		while($row = mysqli_fetch_assoc($result)) {    			 
      		  echo 
              '<div postid="'.$row['post_id'].'">
               <div> "upvote:"'.$row['up_vote'].', "down_vote:"'.$row['down_vote'].' </div>
               <li>' .$row['post_title'].'--------------'.($row['post_text']).'</li>
                <button onclick="get_delete_Posts()" class="button round">Delete</button>
               </div>
               </li>';  
      			 //$new_array[ $row['post_id']] = $row;      
      	 	}	
      	 	 
      	}       
      	
      	//$myJSONString = json_encode($new_array);		 

	}

	function get_Delete_Posts($conn, $post_id){
         
        $query = sprintf("DELETE From Posts WHERE post_id = '%s';",
        mysqli_real_escape_string($conn, $post_id));

        $result = mysqli_query($conn, $query);
        
        if(!$result){
        	echo "not row affected";
        }
        echo "success";

	}

	      // main routine
        $username = $_POST['name'];
    	if($username!=NULL){
    		//Get Account Post 
    		get_Account_Post($conn, $username);

    	}else{
    		//return HomePage Post 
    		getHomePage_Post($conn);
        
    	}

      $Post_id = $_POST['Post']; 	
    	if($Post_id!=NULL){
    		get_Delete_Posts($conn, $Post_id);
    	}
    	
    


?>