$(document).foundation();

$(document).ready(function() {
    //update nav bar 
    $.ajax({
        type: 'get',
        url: '../controller/UserLoggedIn.php',
        data: null,
        async: false,
        success: function(data){
        	console.log(data);
            if (data){
                console.log("user should be login");
                $("#js-login_btn").text(data);
            }else{
            	 console.log("user should not be login");
            }
         }

                           
  	});
    
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

});
