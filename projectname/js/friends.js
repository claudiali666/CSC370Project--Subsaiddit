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
                 get_Friends_Posts();    
            }     
          }
      }); 
    });

  function get_Friends_Posts() {
           $.ajax({
            type: 'post',
            url: '../controller/Friends.php',
            data:{name: username},
            dataType: "text",
            success: function(data){
                if (data){
                      console.log(data);
                     $('.Friends_Posts').html(data);
                }else{
                    console.log("cannot fetch data");
                }
            }
        
        });
    }