$(document).foundation();

var username = 'undefined';
$(document).ready(function() {
    
    //update nav bar 
    $.ajax({
        type: 'get',
        url: '../controller/UserLoggedIn.php',
        data: null,
        async: false,
        success: function(data){
            username = data;
        	console.log(data);
            if (data){
                console.log("user should be login");
                $("#js-login_btn").text(username);
                get_Login_Posts();
            }else{
            	 console.log("user should not be login");
                 get_Home_Page_Post();
            }
         }                    
  	});
});  

    function get_Home_Page_Post() {
        //get homePage posts
           $.ajax({
            type: 'get',
            url: '../controller/Posts.php',
            data: null,
            async: false,
            success: function(data){
                if (data){
                    console.log(data);
                     $('.HomePage_Posts').html(data);
                }else{
                    console.log("cannot fetch data");
                }
            }
        
        });
    }

    //Post the username to the server 
    function get_Login_Posts(){
          $.ajax({
            type: 'post',
            url: '../controller/Posts.php',
            data:{name: username},
            dataType: "text",
            success: function(data){
                if (data){
                    $('.HomePage_Posts').html(data);
                }else{
                    console.log("cannot fetch data");
                }
            }
          
        });
    }

    function get_delete_Posts(){
        $.ajax({
            type: 'post',
            url: '../controller/Posts.php',
            data:{Post: postid},
            dataType: "text",
            success: function(data){
                console.log("+++++++++");
                if (data){
                   console.log("delete success");
                   console.log(data);
                }else{
                    console.log("cannot fetch data");
                }
            }
          
        });
    }
    
    

