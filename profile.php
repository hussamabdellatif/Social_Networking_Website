<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Network</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Indie+Flower">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="assets2/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets2/css/PUSH---Bootstrap-Button-Pack1.css">
    <link rel="stylesheet" href="assets2/css/PUSH---Bootstrap-Button-Pack3.css">
    <link rel="stylesheet" href="assets2/css/PUSH---Bootstrap-Button-Pack2.css">
    <link rel="stylesheet" href="assets2/css/DNFeature-Boxes.css">
    <link rel="stylesheet" href="assets2/css/PUSH---Bootstrap-Button-Pack.css">
    <link rel="stylesheet" href="assets2/css/styles.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean1.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body>
    <header class="hidden-sm hidden-md hidden-lg">
        <div class="searchbox">
            <form>
                <h1 class="text-left">Social Network</h1>
                <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                    <input class="form-control" type="text">
                </div>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">MENU <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li role="presentation"><a href="#">My Profile</a></li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation"><a href="user-page.html">Timeline</a></li>
                        <li role="presentation"><a href="#">Messages </a></li>
                        <li role="presentation"><a href="#">Notifications </a></li>
                        <li role="presentation"><a href="#">My Account</a></li>
                        <li role="presentation"><a href="#">Logout </a></li>
                    </ul>
                </div>
            </form>
        </div>
        <hr>
    </header>
    <div>
        <nav class="navbar navbar-default hidden-xs navigation-clean">
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="icon ion-ios-navigate"></i></a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <form class="navbar-form navbar-left">
                        <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                            <input class="form-control" type="text">
                        </div>
                    </form>
                    <ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
                        <li role="presentation"><a href="#">My Timeline</a></li>
                        <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li role="presentation"><a href="#">My Profile</a></li>
                                <li class="divider" role="presentation"></li>
                                <li role="presentation"><a href="user-page.html">Timeline </a></li>
                                <li role="presentation"><a href="#">Messages </a></li>
                                <li role="presentation"><a href="#">Notifications </a></li>
                                <li role="presentation"><a href="#">My Account</a></li>
                                <li role="presentation"><a href="#">Logout </a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                        <li role="presentation"><a href="user-page.html">Timeline</a></li>
                        <li role="presentation"><a href="#">Messages</a></li>
                        <li role="presentation"><a href="#">Notifications</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">User <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li role="presentation"><a href="#">My Profile</a></li>
                                <li class="divider" role="presentation"></li>
                                <li role="presentation"><a href="user-page.html">Timeline</a></li>
                                <li role="presentation"><a href="#">Messages </a></li>
                                <li role="presentation"><a href="#">Notifications </a></li>
                                <li role="presentation"><a href="#">My Account</a></li>
                                <li role="presentation"><a href="#">Logout </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    

    <div class="modal fade" id="newargument" role="dialog" tabindex="-1" style="padding-top:100px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title">New Argument</h4></div>
                <div style="max-height: 400px; overflow-y: auto; padding-left: 3px">
                        <form action="profile.php" method="POST" enctype="multipart/form-data">
                                <textarea name="argumenttitle" id="argumenttitlecontent" rows="1" cols="73"  style="padding-bottom: 20px; border-color: blue;"></textarea>
                               <textarea name="argumentbody" id="argumentbodycontent" rows="15" cols="73" style="padding-bottom: 25px; border-color: blue;"></textarea>
                 </div>
                <div class="modal-footer" style="height: 100px">
                 <strong style="float: left">Swing: &nbsp; &nbsp; </strong>
                                    <select name="select" id="myargumentselect" style="float: left" onmousedown="if(this.options.length>6){this.size=;}"  onchange='this.size=0;' onblur="this.size=0;">
                                    <option value="0">Which Side Are Swinging With?</option>
                                    <option value="neutral">Neutral</option>
                                    <option value="with">With</option>
                                    <option value="against">Against</option>
                                    </select>
                <input  name="post" id="argument-content-post" value="Post" class="btn btn-default" type="button" style="background-image:url(&quot;none&quot;);background-color:#da052b;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;" data-bs-hover-animate="shake">
                    <button class="btn btn-default" id = "closeargument" type="button" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<h1 class="username-welcome" style="padding-left: 20px"></h1>
<div style=" width: 65%; float: left; left: 0px">
        <div class="container" >

            <div class="row" style="left: 0px;" >
                <div class="col-md-3">
                    <ul class="list-group">
                        
                    </ul>
                </div>
                <div class="col-md-6" style="width: 85%;">
                    <ul class="list-group">
                            <h3>Your Contributions</h3>

                            <div class="timelineposts">

                            </div>
                    </ul>

                </div>
                <div class="col-md-3">
                    
                    <ul class="list-group"></ul>
                </div>
            </div>
        </div>
    </div>
    <div style= "position: absolute; right: 40px; top: 250px;">
        <div class="container">
    
        <h1 id="username-headline"> </h1></div>
    <div class="container" id="Features" style="width:350px; float: right; ">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12" style="position: top; ">
                <div id="feature-box4" class="feature-box">
                    <h2>Interests </h2>
                    <div class="padding" id="interestgroup" style="padding-right:5px;">
                        
                        <a class="btn btn-primary btn-block btn-lg" role="button" href="interests.html" style="width:300px;align-items:center;">Go To Interest Page</a></div>
                </div>
            </div>
        </div>
    </div>
    <div>



        

</div>

        
    </div>

<div class="modal fade" id="commentsmodal" role="dialog" tabindex="-1" style="padding-top:100px;">
        <div class="modal-dialog" role="document" style="width: 80%;">
            <div class="modal-content">
                <div class="modal-header">
                <div class="row"">
                <div class="col-md-3"  >
                    <ul class="list-group" id="users" style="overflow-y: scroll;display: inline-block; max-height: 500px;">
                    Arguments</ul>
                </div>
                <div class="col-md-9" style="position:relative;">
                    <ul class="list-group">
                        <blockquote class="list-group-item" id="m" style="overflow:auto;height:500px;margin-bottom:55px;">
                        No Arguments</blockquote>
                    </ul>
                    <div id="wrapper">
                    </div>
                    
          
   </div>
   </div>
   </div>
   </div>    
   </div>
   </div>
    
    
    <script src="jquery.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src = "jquery.timeago.js"></script>
    <script type="text/javascript">
        
        function resetall(){
        $('#users').empty();
        $('#m').empty();
        $('.getcomments').empty();
    }

    function showNewArgumentModal(){
    $('#newargument').modal('show')
    }

    var start = 4;
    var working = false;
    $(window).scroll(function(){
        if($(this).scrollTop() +1 >= $('body').height()-$(window).height()){
            if (working == false){
                working = true;
                $.ajax({
                    

                        type: "GET",
                        url: "api/profileposts?start="+start,
                        processData: false,
                        contentType: "application/json",
                        data: '',
                        success: function(r) {
                                var posts = JSON.parse(r)
                                $.each(posts, function(index) {
                                       $('.timelineposts').html(
                                            $('.timelineposts').html() + '<li class="list-group-item" id="'+posts[index].PostId+'"><blockquote><p>'+posts[index].PostBody+'</p><footer>Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'<br><br><button class="btn btn-default" data-id ="'+posts[index].PostId+'" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"> <i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+posts[index].Likes+' Likes</span></button><button class="btn btn-default" data-dislikeid = "'+posts[index].PostId+'" type="button" style="color:black;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-heart" data-aos="flip-right" style="color:#black;"></i><span style="color:black;"> '+posts[index].Dislikes+' Dislikes </span></button></button><br><button class="btn btn-default comment" type="button" data-postid="'+posts[index].PostId+'" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Arguments</span></button></button><button class="btn btn-default comment" type="button" onclick= "showNewArgumentModal()" data-argumentid="'+posts[index].PostId+'" style="color:#009933;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-pencil" style="color:#009933;"></i><span style="color:#009933;"> Make An Argument</span></button></footer></blockquote></li>'
                                        )
                                

                                        $('[data-argumentid]').click(function(){
                                                var postid = $(this).attr('data-argumentid');
                                                $('#argument-content-post').click(function(){
                                                    if (!($('#myargumentselect').val()==="0" || $("#argumentbodycontent").val() === '' || $("#argumenttitlecontent").val() === '')){
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "api/createargument",
                                                            processData: false,
                                                            contentType: "application/json",
                                                            data: '{"title" : "'+$("#argumenttitlecontent").val()+'", "body" : "'+$("#argumentbodycontent").val()+'", "postid" : "'+postid+'", "swing": "'+$("#myargumentselect").val()+'"}',
                                                            success: function(r){
                                                            location.reload(); 
                                                            //i dont know if it is working but you have to scroll down to that specific argument after th
                                                            $(window).scrollTop(postid.offset().top).scrollLeft(postid.offset().left);   
                                                            console.log(r);
                                                            },
                                                            error: function(r){
                                                            console.log(r)
                                                            }
                                                        });
                                                    }else{
                                                        setTimeout(function() {
                                                        $('[data-bs-hover-animate]').removeClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'));
                                                        }, 2000)
                                                        $('[data-bs-hover-animate]').addClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'))
                                                           
                                                    }
                                                })    

                                        })


                                        $('[data-id]').click(function(){
                                                var buttonid = $(this).attr('data-id');
                                                $.ajax({
                                                    type: "POST",
                                                    url: "api/likes?id=" + $(this).attr('data-id'),
                                                    processData: false,
                                                    contentType: "application/json",
                                                    data: '',
                                                    success: function(r){
                                                        var res= JSON.parse(r);
                                                         $("[data-id = '"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Likes+' Likes</span>')
                                                        console.log(r);
                                                    },
                                                    error: function(r){
                                                        console.log(r)
                                                    }
                                                });
                                        })

                                        $('[data-dislikeid]').click(function(){
                                                var buttonid = $(this).attr('data-dislikeid');
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "api/dislikes?id=" + $(this).attr('data-dislikeid'),
                                                            processData: false,
                                                            contentType: "application/json",
                                                            data: '',
                                                            success: function(r){
                                                                var res= JSON.parse(r);
                                                                 $("[data-dislikeid = '"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Dislikes+' Dislikes</span>')
                                                                console.log(r);
                                                            },
                                                            error: function(r){
                                                                console.log(r)
                                                            }
                                                        });
                                        })

                                        $('[data-postid]').click(function(){

                                                $('#users').html('No Arguments');
                                                $('#m').empty();
                                                var buttonid = $(this).attr('data-postid');
                                                    $.ajax({
                                                        type: "GET",
                                                        url: "api/argumentposts?postid=" + $(this).attr('data-postid'),
                                                        processData: false,
                                                        contentType: "application/json",
                                                        data: '',
                                                        success: function(r){
                                                        //$('#users').empty();
                                                        showCommentsModal();
                                                            
                                                            var r = JSON.parse(r);
                                                             $('#users').empty();
                                                            
                                                            $.each(r, function(index){
                                                                $('#users').html(
                                                                    $('#users').html()+
                                                                     '<button id="user'+index+'"  data-id='+r[index].id+' class="list-group-item" style="display: inline-block"><span style="font-size:14px; width=20px; word-wrap: break-word; display: inline-block">'+r[index].title+'<br><h5 style="text-transform:capitalize;">Swing: '+r[index].status+'</h5></span></button>')

                                                                            $('[data-id]').click(function() {
                                                                               $.ajax({
                                                                                    type:"GET",
                                                                                    url: "api/getarguments?postid="+ $(this).attr('data-id'),
                                                                                    processData: false,
                                                                                    contentType: "application/json",
                                                                                    data: '',
                                                                                    success: function(r){
                                                                                        
                                                                                        var r = JSON.parse(r);     
                                                                                        $.each(r, function(index){
                                                                                            $('#m').html(
                                                                                                '<div><h3>'+r[index].title+'</h3><p friction-id='+r[index].id+'style= "padding: 10px;width:50%;min-height:40px;border-radius:10px;">'+r[index].body+'</p><br></div><hr><footer>Posted BY: '+r[index].username+ ' ON ' +r[index].date+'<br><button class="btn btn-default comment" type="button" data2-postid="'+r[index].id+'" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button><button class="btn btn-default" data-arglikeid = '+r[index].id+' type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"> <i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span>'+r[index].likes+' Likes</span></button><button class="btn btn-default" data-argdislikeid = '+r[index].id+' type="button" style="color:black;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-heart" data-aos="flip-right" style="color:#black;"></i><span style="color:black;"> '+r[index].dislike+' Dislikes </span></button><button class="btn btn-default" data-reportid = '+r[index].id+' type="button" style="color:black;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-ban-circle" data-aos="flip-right" style="color:#black;"></i><span style="color:black;"> Report: Not Valid  </span></button><button class="btn btn-default" data-messageid = '+r[index].userid+' type="button" style="color:blue;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-envelope" style="color:#blue;"></i><span style="color:blue;"> Message</span></button> </footer><div style = "color:#FFF; padding:6 px;user-select:none;"><p>'+r[index]+'</p></div><div class ="getcomments" style = "font-size = 60px;"></div>')
                                                                                            $('#wrapper').html('<button class="btn btn-default msg-button-send" id="sendcomment" data4-id = '+r[index].id+' type="button" >SEND </button><div class="message-input-div"><input id="commentcontent" type="text" style="width:100%;height:45px;outline:none;font-size:16px;"></div><div class="modal-footer"><button class="btn btn-default" onclick="resetall()" type="button" data-dismiss="modal">Close</button></div>')

                                                                                                        $('[data-messageid]').click(function(){
                                                                                                            var buttonid = $(this).attr('data-messageid');
                                                                                                            
                                                                                                            $.ajax({
                                                                                                                type: "POST",
                                                                                                                url: "api/message",
                                                                                                                processData: false, 
                                                                                                                contentType: "application/json",
                                                                                                                data:'{"body": "***","receiver": "'+buttonid+'"}',
                                                                                                                success: function(r){
                                                                                                                    console.log(r);
                                                                                                                    location.href="messages.html#"+buttonid+"";
                                                                                                                },
                                                                                                                error: function(r){
                                                                                                                    console.log(r);
                                                                                                                }
                                                                                                            })


                                                                                                        })


                                                                                                        $('[data-reportid]').click(function(){
                                                                                                            var buttonid = $(this).attr('data-reportid');
                                                                                                            $.ajax({
                                                                                                                    type: "POST",
                                                                                                                    url: "api/argsreport?id=" + $(this).attr('data-reportid'),
                                                                                                                    processData: false,
                                                                                                                    contentType: "application/json",
                                                                                                                    data: '',
                                                                                                                    success: function(r){
                                                                                                                       
                                                                                                                        $("[data-reportid = '"+buttonid+"']").html('<i class="glyphicon glyphicon-ban-circle" data-aos="flip-right"></i><span> Unreport!</span>')
                                                                                                                        console.log(r);
                                                                                                                    },
                                                                                                                    error: function(r){
                                                                                                                    console.log(r)
                                                                                                                    }
                                                                                                                });
                                                                                                        })



                                                                                                    $('[data-argdislikeid]').click(function(){
                                                                                                        var buttonid = $(this).attr('data-argdislikeid');
                                                                                                            $.ajax({
                                                                                                                type: "POST",
                                                                                                                url: "api/argsdislikes?id=" + $(this).attr('data-argdislikeid'),
                                                                                                                processData: false,
                                                                                                                contentType: "application/json",
                                                                                                                data: '',
                                                                                                                success: function(r){
                                                                                                                    var res= JSON.parse(r);
                                                                                                                    $("[data-argdislikeid = '"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Dislikes+' Likes</span>')
                                                                                                                    console.log(r);
                                                                                                                },
                                                                                                                error: function(r){
                                                                                                                console.log(r)
                                                                                                                }
                                                                                                            });
                                                                                                    })

                                                                                                     $('[data-arglikeid]').click(function(){
                                                                                                        var buttonid = $(this).attr('data-arglikeid');
                                                                                                            $.ajax({
                                                                                                                type: "POST",
                                                                                                                url: "api/argslikes?id=" + $(this).attr('data-arglikeid'),
                                                                                                                processData: false,
                                                                                                                contentType: "application/json",
                                                                                                                data: '',
                                                                                                                success: function(r){
                                                                                                                    var res= JSON.parse(r);
                                                                                                                    $("[data-arglikeid = '"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Likes+' Likes</span>')
                                                                                                                    console.log(r);
                                                                                                                },
                                                                                                                error: function(r){
                                                                                                                console.log(r)
                                                                                                                }
                                                                                                            });
                                                                                                    })




                                                                                                    $('[data4-id]').click(function(){
                                                                                                        $('[data2-postid]').click();
                                                                                                        var body = $('#commentcontent').val();
                                                                                                        var argumentid =  $(this).attr('data4-id');
                                                                                                            $.ajax({
                                                                                                                type:"POST",
                                                                                                                url: "api/argumentcomment",
                                                                                                                processData: false,
                                                                                                                contentType: "application/json",
                                                                                                                data:'{"comment" : "'+$("#commentcontent").val()+'", "argumentid" : "'+argumentid+'"}',
                                                                                                                success: function(r){
                                                                                                                    $('.getcomments').append(('<hr><blockquote style = "font-size=60px">'+$("#commentcontent").val()+'</blockquote>'));
                                                                                                                    $("#commentcontent").empty();
                                                                                                                    var objDiv = document.getElementById("m");
                                                                                                                    objDiv.scrollTop = objDiv.scrollHeight;
                                                                                                                    console.log(r);
                                                                                                                },
                                                                                                                error: function(r){
                                                                                                                console.log(r);
                                                                                                                }
                                                                                                            })
                                                                                                    })
                                                                                                    
                                                                                                    
                                                                                                    $('[data2-postid]').click(function(){

                                                                                                           
                                                                                                            $.ajax({
                                                                                                                type:"GET",
                                                                                                                url: "api/getargumentcomments?postid="+ $(this).attr('data2-postid'),
                                                                                                                processData: false,
                                                                                                                contentType: "application/json",
                                                                                                                data: '',
                                                                                                                success: function(r){
                                                                                                                    $('.getcomments').empty();
                                                                                                                    try {
                                                                                                                        var r = JSON.parse(r);
                                                                                                                        $.each(r, function(index){
                                                                                                                            $('.getcomments').html(
                                                                                                                                $('.getcomments').html()+
                                                                                                                                ('<hr><blockquote style = "font-size=60px"> ~ '+r[index].username+' : '+r[index].comment+'</blockquote>')
                                                                                                                            )    
                                                                                                                        })
                                                                                                                    }catch (e){
                                                                                                                        
                                                                                                                    }     
                                                                                                                    
                                                                                                                },
                                                                                                                error:function(r){
                                                                                                                   
                                                                                                                }
                                                                                                            })
                                                                                                    })






                                                                                        })
                                                                                    }
                                                                                })
                                                                            })            





                                                            }) 
                                                        } 
                                                    })             




                                        



                                        })   




                                })
                        
                
                              // scrollToAnchor(location.hash)
                                start+=4;
                                setTimeout(function(){
                                    working = false;

                                }, 1000)
                        },
                        error: function(r) {
                                console.log(r)
                        }

                });


              
            }
        }
    })
        
        


$(document).ready(function() {
        
        $.ajax({
            type: "GET",
            url: "api/getinterestsvisual",
            processData: false,
            contentType: "application/json",
            data: '',
            success: function(r) {
                var res = JSON.parse(r);
                $.each(res, function(index){
                    
                        $('#interestgroup').prepend('<div class="thumbnail text-center"><img class="img-circle" src='+res[index].link+' style="height: 55px; height: 55px;"><div class="caption"><h5><a href="#"> '+res[index].topic+' </a></h5><a class="btn btn-primary" data-interestid ="'+res[index].id+'" role="button" href="#"><i class="fa fa-star fa-fw"></i> UnFollow</a></div></div>')
                        
                        $('[data-interestid]').click(function(){
                        var postid = $(this).attr('data-interestid');
                             $.ajax({
                                    type: "POST",
                                    url: "api/interestunfollow?id=" + $(this).attr('data-interestid'),
                                    processData: false,
                                    contentType: "application/json",
                                    data: '',
                                    success: function(r){
                                        console.log(r);
                                        location.reload();
                                    },
                                    error: function(r){
                                        console.log(r)
                                    }
                                });
                        })


                })
            }
        })


        $.ajax({
            type: "GET",
            url: "api/users",
            processData: false,
            contentType: "application/json",
            data: '',
            success: function(r) {
                
                
                $('.username-welcome').html('Welcome, '+r+'');

            }
        })

    



        $.ajax({

            type: "GET",
            url: "api/profileposts?start=0",
            processData: false,
            contentType: "application/json",
            data: '',
            success: function(r) {
                var posts = JSON.parse(r)
                $.each(posts, function(index) {
                    $('.timelineposts').html(
                        $('.timelineposts').html() + '<li class="list-group-item" id="'+posts[index].PostId+'"><blockquote><p>'+posts[index].PostBody+'</p><footer>Posted by '+posts[index].PostedBy+' ~ '+jQuery.timeago(posts[index].PostDate)+'<br><br><button class="btn btn-default" data-id ="'+posts[index].PostId+'" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"> <i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+posts[index].Likes+' Likes</span></button><button class="btn btn-default" data-dislikeid = "'+posts[index].PostId+'" type="button" style="color:black;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-heart" data-aos="flip-right" style="color:#black;"></i><span style="color:black;"> '+posts[index].Dislikes+' Dislikes </span></button></button><br><button class="btn btn-default comment" type="button" data-postid="'+posts[index].PostId+'" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Arguments</span></button></button><button class="btn btn-default comment" type="button" onclick= "showNewArgumentModal()" data-argumentid="'+posts[index].PostId+'" style="color:#009933;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-pencil" style="color:#009933;"></i><span style="color:#009933;"> Make An Argument</span></button></footer></blockquote></li>'
                    )
                   

                    $('[data-argumentid]').click(function(){
                        var postid = $(this).attr('data-argumentid');
                        $('#argument-content-post').click(function(){
                            if (!($('#myargumentselect').val()==="0" || $("#argumentbodycontent").val() === '' || $("#argumenttitlecontent").val() === '')){
                                $.ajax({
                                    type: "POST",
                                    url: "api/createargument",
                                    processData: false,
                                    contentType: "application/json",
                                    data: '{"title" : "'+$("#argumenttitlecontent").val()+'", "body" : "'+$("#argumentbodycontent").val()+'", "postid" : "'+postid+'", "swing": "'+$("#myargumentselect").val()+'"}',
                                    success: function(r){
                                    location.reload(); 
                                    //i dont know if it is working but you have to scroll down to that specific argument after th
                                    $(window).scrollTop(postid.offset().top).scrollLeft(postid.offset().left);   
                                    console.log(r);
                                    },
                                    error: function(r){
                                    console.log(r)
                                    }
                                });
                            }else{
                                setTimeout(function() {
                                $('[data-bs-hover-animate]').removeClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'));
                                }, 2000)
                                $('[data-bs-hover-animate]').addClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'))
                                   
                            }
                        })    

                    })

                     $('[data-id]').click(function(){
                                var buttonid = $(this).attr('data-id');
                                $.ajax({
                                    type: "POST",
                                    url: "api/likes?id=" + $(this).attr('data-id'),
                                    processData: false,
                                    contentType: "application/json",
                                    data: '',
                                    success: function(r){
                                        var res= JSON.parse(r);
                                         $("[data-id = '"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Likes+' Likes</span>')
                                        console.log(r);
                                    },
                                    error: function(r){
                                        console.log(r)
                                    }
                                });
                    })

                      $('[data-dislikeid]').click(function(){
                        var buttonid = $(this).attr('data-dislikeid');
                                $.ajax({
                                    type: "POST",
                                    url: "api/dislikes?id=" + $(this).attr('data-dislikeid'),
                                    processData: false,
                                    contentType: "application/json",
                                    data: '',
                                    success: function(r){
                                        var res= JSON.parse(r);
                                         $("[data-dislikeid = '"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Dislikes+' Dislikes</span>')
                                        console.log(r);
                                    },
                                    error: function(r){
                                        console.log(r)
                                    }
                                });
                    })


                    $('[data-postid]').click(function(){
                         $('#users').html('No Arguments');
                         $('#m').empty();
                        var buttonid = $(this).attr('data-postid');
                            $.ajax({
                                type: "GET",
                                url: "api/argumentposts?postid=" + $(this).attr('data-postid'),
                                processData: false,
                                contentType: "application/json",
                                data: '',
                                success: function(r){
                                //$('#users').empty();
                                showCommentsModal();
                                    
                                    var r = JSON.parse(r);
                                     $('#users').empty();
                                    
                                    $.each(r, function(index){
                                        $('#users').html(
                                            $('#users').html()+
                                             '<button id="user'+index+'"  data-id='+r[index].id+' class="list-group-item" style="display: inline-block"><span style="font-size:14px; width=20px; word-wrap: break-word; display: inline-block">'+r[index].title+'<br><h5 style="text-transform:capitalize;">Swing: '+r[index].status+'</h5></span></button>')

                                                $('[data-id]').click(function() {
                                                   $.ajax({
                                                        type:"GET",
                                                        url: "api/getarguments?postid="+ $(this).attr('data-id'),
                                                        processData: false,
                                                        contentType: "application/json",
                                                        data: '',
                                                        success: function(r){
                                                            
                                                            var r = JSON.parse(r);     
                                                            $.each(r, function(index){
                                                                $('#m').html(
                                                                    '<div><h3>'+r[index].title+'</h3><p friction-id='+r[index].id+'style= "padding: 10px;width:50%;min-height:40px;border-radius:10px;">'+r[index].body+'</p><br></div><hr><footer>Posted BY: '+r[index].username+ ' ON ' +r[index].date+'<br><button class="btn btn-default comment" type="button" data2-postid="'+r[index].id+'" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button><button class="btn btn-default" data-arglikeid = '+r[index].id+' type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"> <i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span>'+r[index].likes+' Likes</span></button><button class="btn btn-default" data-argdislikeid = '+r[index].id+' type="button" style="color:black;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-heart" data-aos="flip-right" style="color:#black;"></i><span style="color:black;"> '+r[index].dislike+' Dislikes </span></button><button class="btn btn-default" data-reportid = '+r[index].id+' type="button" style="color:black;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-ban-circle" data-aos="flip-right" style="color:#black;"></i><span style="color:black;"> Report: Not Valid  </span></button><button class="btn btn-default" data-messageid = '+r[index].userid+' type="button" style="color:blue;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-envelope" style="color:#blue;"></i><span style="color:blue;"> Message</span></button> </footer><div style = "color:#FFF; padding:6 px;user-select:none;"><p>'+r[index]+'</p></div><div class ="getcomments" style = "font-size = 60px;"></div>')
                                                                $('#wrapper').html('<button class="btn btn-default msg-button-send" id="sendcomment" data4-id = '+r[index].id+' type="button" >SEND </button><div class="message-input-div"><input id="commentcontent" type="text" style="width:100%;height:45px;outline:none;font-size:16px;"></div><div class="modal-footer"><button class="btn btn-default" onclick="resetall()" type="button" data-dismiss="modal">Close</button></div>')

                                                                    $('[data-messageid]').click(function(){
                                                                    var buttonid = $(this).attr('data-messageid');
                                                                    
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "api/message",
                                                                        processData: false, 
                                                                        contentType: "application/json",
                                                                        data:'{"body": "***","receiver": "'+buttonid+'"}',
                                                                        success: function(r){
                                                                            console.log(r);
                                                                            location.href="messages.html#"+buttonid+"";
                                                                        },
                                                                        error: function(r){
                                                                            console.log(r);
                                                                        }
                                                                    })


                                                                })


                                                                $('[data-reportid]').click(function(){
                                                                    var buttonid = $(this).attr('data-reportid');
                                                                    $.ajax({
                                                                            type: "POST",
                                                                            url: "api/argsreport?id=" + $(this).attr('data-reportid'),
                                                                            processData: false,
                                                                            contentType: "application/json",
                                                                            data: '',
                                                                            success: function(r){
                                                                               
                                                                                $("[data-reportid = '"+buttonid+"']").html('<i class="glyphicon glyphicon-ban-circle" data-aos="flip-right"></i><span> Unreport!</span>')
                                                                                console.log(r);
                                                                            },
                                                                            error: function(r){
                                                                            console.log(r)
                                                                            }
                                                                        });
                                                                })
                                                                
                                                                $('[data-argdislikeid]').click(function(){
                                                                    var buttonid = $(this).attr('data-argdislikeid');
                                                                        $.ajax({
                                                                            type: "POST",
                                                                            url: "api/argsdislikes?id=" + $(this).attr('data-argdislikeid'),
                                                                            processData: false,
                                                                            contentType: "application/json",
                                                                            data: '',
                                                                            success: function(r){
                                                                                var res= JSON.parse(r);
                                                                                $("[data-argdislikeid = '"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Dislikes+' Likes</span>')
                                                                                console.log(r);
                                                                            },
                                                                            error: function(r){
                                                                            console.log(r)
                                                                            }
                                                                        });
                                                                })

                                                                 $('[data-arglikeid]').click(function(){
                                                                    var buttonid = $(this).attr('data-arglikeid');
                                                                        $.ajax({
                                                                            type: "POST",
                                                                            url: "api/argslikes?id=" + $(this).attr('data-arglikeid'),
                                                                            processData: false,
                                                                            contentType: "application/json",
                                                                            data: '',
                                                                            success: function(r){
                                                                                var res= JSON.parse(r);
                                                                                $("[data-arglikeid = '"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Likes+' Likes</span>')
                                                                                console.log(r);
                                                                            },
                                                                            error: function(r){
                                                                            console.log(r)
                                                                            }
                                                                        });
                                                                })




                                                                $('[data4-id]').click(function(){
                                                                    $('[data2-postid]').click();
                                                                    var body = $('#commentcontent').val();
                                                                    var argumentid =  $(this).attr('data4-id');
                                                                        $.ajax({
                                                                            type:"POST",
                                                                            url: "api/argumentcomment",
                                                                            processData: false,
                                                                            contentType: "application/json",
                                                                            data:'{"comment" : "'+$("#commentcontent").val()+'", "argumentid" : "'+argumentid+'"}',
                                                                            success: function(r){
                                                                                $('.getcomments').append(('<hr><blockquote style = "font-size=60px">'+$("#commentcontent").val()+'</blockquote>'));
                                                                                $("#commentcontent").empty();
                                                                                var objDiv = document.getElementById("m");
                                                                                objDiv.scrollTop = objDiv.scrollHeight;
                                                                                console.log(r);
                                                                            },
                                                                            error: function(r){
                                                                            console.log(r);
                                                                            }
                                                                        })
                                                                })
                                                                
                                                                
                                                                $('[data2-postid]').click(function(){

                                                                       
                                                                        $.ajax({
                                                                            type:"GET",
                                                                            url: "api/getargumentcomments?postid="+ $(this).attr('data2-postid'),
                                                                            processData: false,
                                                                            contentType: "application/json",
                                                                            data: '',
                                                                            success: function(r){
                                                                                $('.getcomments').empty();
                                                                                try {
                                                                                    var r = JSON.parse(r);
                                                                                    $.each(r, function(index){
                                                                                        $('.getcomments').html(
                                                                                            $('.getcomments').html()+
                                                                                            ('<hr><blockquote style = "font-size=60px"> ~ '+r[index].username+' : '+r[index].comment+'</blockquote>')
                                                                                        )    
                                                                                    })
                                                                                }catch (e){
                                                                                    
                                                                                }     
                                                                                
                                                                            },
                                                                            error:function(r){
                                                                               
                                                                            }
                                                                        })
                                                                })

                                                            })
                                                        },
                                                        error: function(r){
                                                            
                                                        }
                                                    });

                                                    
                                                });
                                     })
                                },
                                error: function(r){
                                
                                
                                
                                }  
                            });
                    });
                            
                    

                            
                });

            },
            error: function(r){
                console.log(r);
            }
        });
});
                
                







            




                                        

                                                                      






                                                        

                                                           
                                                            
                                                        

                                                      
                                                                    

                                                        
                                                        
                                                                
                                                              
                                                        


                                                        
                                                        




                                            /*$.ajax({
                                                type: "GET",
                                                url: "api/argumentposts?postid=" + $(this).attr('data-postid') ,
                                                processData: false,
                                                contentType: "application/json",
                                                data: '',
                                                success: function(r){
                                                    var r = JSON.parse(r);
                                                    $('#m').empty();
                                                    $.each(r, function(index){
                                                        $('#m').html(
                                                            $('#m').html() + 
                                                            ('<div><p style= "padding: 10px;width:50%;min-height:40px;border-radius:10px;">'+r[index].body+'</p></div><div style = "color:#FFF; padding:15px;user-select:none;"><p>'+r[index]+'</p></div>')
                                                            )
                                                    


                                                    })


                                                },
                                                error:function(r){

                                                }
                                            })

*/
                                        


    

    function showCommentsModal(){
        $('#commentsmodal').modal('show')
        
        
    }




    </script>
</body>

</html>