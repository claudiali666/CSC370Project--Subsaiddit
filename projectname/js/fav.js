$(document).foundation();

var username;

$(document).ready(function() {
    console.log("loaded"); 
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
                 get_Account_Fav_Posts();    
            }     
          }
      }); 
 });



function get_Account_Fav_Posts() {
           $.ajax({
            type: 'post',
            url: '../controller/favourite.php',
            data:{name: username, fav: "Y"},
            dataType: "text",
            success: function(data){
                if (data){
                      console.log(data);
                     $('.Favourite_Posts').html(data);
                }else{
                    console.log("cannot fetch data");
                }
            }
        
        });
}