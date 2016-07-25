$(document).foundation();

var username = 'undefined';
var postid = 0;
$(document).ready(function() {
    console.log("loaded");
    //update nav bar
    $.ajax({
        type: 'get',
        url: '../controller/UserLoggedIn.php',
        data: null,
        async: false,
        success: function(data){
            username = data;
            console.log(window.username);
        	console.log(data);
            if (data){
                console.log("user should be login");
                $("#js-login_btn").text(username);
                 get_Login_Posts();
                 get_Account_Subsaiddit();
            }else{
            	 console.log("user should not be login");
                 get_Home_Page_Post();
                 get_Default_Subsaiddit();
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
                    console.log(data);
                    $('.Account_Posts').html(data);
                }else{
                    console.log("cannot fetch data");
                }
            }

        });
    }

    function get_delete_Posts(event){
        if(!event) {
            event = window.event;
        };
        $(event.target).parent().hide();
        postid = $(event.target).parent().attr("postid");
        $.ajax({
            type: 'post',
            url: '../controller/Posts.php',
            data:{Post: postid},
            dataType: "text",
            success: function(data){
                if (data){
                   console.log("delete success");
                }else{
                    console.log("cannot fetch data");
                }
            }

        });
    }

    function get_Account_Subsaiddit(){
        var length;
        $.ajax({
            type: 'post',
            url: '../controller/Subsaiddit.php',
            data:{name: username},
            dataType: "json",
            success: function(data){
                var HTML = "";
                console.log(data);
                $.each(data, function(index, element) {
                     HTML += "<dd>";
                     HTML += "<li>" + element.subsaiddits_title + "</li>";
                     HTML += "</dd>";
                });
                $("#subsaiddit").html(HTML);
            }
        });

    }

    function get_Default_Subsaiddit(){
        $.ajax({
            type: 'post',
            url: '../controller/Subsaiddit.php',
            data: null,
            dataType: "json",
            success: function(data){
                var HTML = "";
                $.each(data, function(index, element) {
                     //HTML += "<dd>";
                     HTML += "<li>" + element.subsaiddits_title + "</li>";
                     //HTML += "</dd>";
                });
                 $("#subsaiddit").html(HTML);
            }
        });
    }

    function get_Account_Fav_Posts(){

    }
