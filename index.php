<?php

require_once("DB.php");
//handle requests..we need to handle which kind of request we recieved and it is done with this method below
$db = new DB("127.0.0.1", "proveMeWrong", "root", "00039");

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

if ($_SERVER['REQUEST_METHOD'] == "GET"){
	
	if($_GET['url'] == "musers"){
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$users = $db->query("SELECT DISTINCT s.username AS Sender, r.username AS Receiver, s.id AS SenderID, r.id AS ReceiverID FROM messages LEFT JOIN users s ON s.id = messages.sender LEFT JOIN users r ON r.id = messages.receiver WHERE (s.id = :userid OR r.id=:userid)", array(":userid"=>$userid));
		$u = array();
		foreach ($users as $user) {
			 if (!in_array(array('username'=>$user['Receiver'], 'id'=>$user['ReceiverID']), $u)) {
                    array_push($u, array('username'=>$user['Receiver'], 'id'=>$user['ReceiverID']));
             }
             if (!in_array(array('username'=>$user['Sender'], 'id'=>$user['SenderID']), $u)) {
                    array_push($u, array('username'=>$user['Sender'], 'id'=>$user['SenderID']));
             }
		}
		echo json_encode($u);
	}elseif ($_GET['url'] == "searchgroupuser") {

		 $tosearch = explode(" ", $_GET['query']);
            if (count($tosearch) == 1) {
               $tosearch = str_split($tosearch[0], 2);
            }
                $whereclause = "";
                $paramsarray = array(':userName'=>'%'.$_GET['query'].'%');
                for ($i = 0; $i < count($tosearch); $i++) {
                        if ($i % 2) {
                        $whereclause .= " OR userName LIKE :p$i ";
                        $paramsarray[":p$i"] = $tosearch[$i];
                        }
                }
                $posts = $db->query('SELECT userName, ID FROM users WHERE userName LIKE :userName '.$whereclause.' LIMIT 3', $paramsarray);
                //echo "<pre>";
                echo json_encode($posts);





	}elseif ($_GET['url'] == "getallinvitations") {
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$invitations = $db->query('SELECT users.userName, groups.title, group_invite.group_id FROM users, groups, group_invite WHERE group_invite.user_id = :userid AND group_invite.sender_id = users.ID AND group_invite.group_id = groups.id', array(':userid'=>$userid));

		$output .= "[";

		foreach ($invitations as $invite) {
			$output .= "{";
			$output .= '"username": "'.$invite['userName'].'",';
			$output .= '"id": "'.$invite['group_id'].'",';
			$output .= '"title": "'.$invite['title'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
		echo $output;




	}elseif ($_GET['url'] == "getgroups") {
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$groups = $db->query('SELECT groups.id, groups.title FROM groups WHERE admin_id = :userid OR groups.id IN (SELECT group_id FROM group_follower WHERE follower_id = :follower_id)', array(':userid'=>$userid,':follower_id'=>$userid));

		$output .= "[";

		foreach ($groups as $group) {
			$output .= "{";
			$output .= '"title": "'.$group['title'].'",';
			$output .= '"id": "'.$group['id'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
		echo $output;




	}elseif ($_GET['url'] == "getinterestsvisual") {
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$interests = $db->query('SELECT id, interest_id, link FROM interests WHERE follower_id = :userid', array(':userid'=>$userid));

		$output .= "[";

		foreach ($interests as $comment) {
			$output .= "{";
			$output .= '"topic": "'.$comment['interest_id'].'",';
			$output .= '"id": "'.$comment['id'].'",';
			$output .= '"link": "'.$comment['link'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
			
			echo $output;







	}elseif ($_GET['url'] == "notifications2") {
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$notifications = $db->query('SELECT extra, date_at FROM notifications WHERE receiver =:userid ORDER BY date_at DESC', array(':userid'=>$userid));
		$output .= "[";
		foreach ($notifications as $notification ) {
			$output .= "{";
			$output .= '"extra": "'.$notification['extra'].'",';
			$output .= '"date": "'.$notification['date_at'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
		echo $output;



	}
	elseif ($_GET['url'] == "notifications1") {
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$notifications = $db->query('SELECT extra, date_at FROM notifications WHERE receiver =:userid ORDER BY date_at DESC LIMIT 5', array(':userid'=>$userid));
		$output .= "[";
		foreach ($notifications as $notification ) {
			$output .= "{";
			$output .= '"extra": "'.$notification['extra'].'",';
			$output .= '"date": "'.$notification['date_at'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
		echo $output;




	}elseif ($_GET['url'] == "getgrouparguments" && isset($_GET['postid'])) {

		$arguments = $db->query('SELECT group_arguments.title, group_arguments.body, group_arguments.user_id, group_arguments.id, users.userName, group_arguments.date_at, group_arguments.likes, group_arguments.dislikes FROM group_arguments, users WHERE group_arguments.id =:id AND group_arguments.user_id = users.ID  ', array(':id'=> $_GET['postid']));
		$output .= "[";

		foreach ($arguments as $comment) {
			$output .= "{";
			$output .= '"body": "'.$comment['body'].'",';
			$output .= '"date": "'.$comment['date_at'].'",';
			$output .= '"username": "'.$comment['userName'].'",';
			$output .= '"userid": "'.$comment['user_id'].'",';
			$output .= '"likes": "'.$comment['likes'].'",';
			$output .= '"dislike": "'.$comment['dislikes'].'",';
			$output .= '"title": "'.$comment['title'].'",';
			$output .= '"id": "'.$comment['id'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
			
			echo $output;





	}elseif ($_GET['url'] == "getarguments" && isset($_GET['postid'])) {
		$arguments = $db->query('SELECT arguments.title, arguments.body, arguments.user_id, arguments.id, users.userName, arguments.date_at, arguments.likes, arguments.dislikes FROM arguments, users WHERE arguments.id =:id AND arguments.user_id = users.ID  ', array(':id'=> $_GET['postid']));
		$output .= "[";

		foreach ($arguments as $comment) {
			$output .= "{";
			$output .= '"body": "'.$comment['body'].'",';
			$output .= '"date": "'.$comment['date_at'].'",';
			$output .= '"username": "'.$comment['userName'].'",';
			$output .= '"userid": "'.$comment['user_id'].'",';
			$output .= '"likes": "'.$comment['likes'].'",';
			$output .= '"dislike": "'.$comment['dislikes'].'",';
			$output .= '"title": "'.$comment['title'].'",';
			$output .= '"id": "'.$comment['id'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
			
			echo $output;
				
				


	}elseif ($_GET['url'] == "getgroupargumentcomments") {
		
		$arguments = $db->query('SELECT group_argument_comment.comment, users.userName FROM group_argument_comment, users WHERE group_argument_comment.argument_id = :argumentsid AND group_argument_comment.user_id = users.ID', array(':argumentsid'=> $_GET['postid']));

		$output .= "[";

		foreach ($arguments as $comment) {
			$output .= "{";
			$output .= '"comment": "'.$comment['comment'].'",';
			$output .= '"username": "'.$comment['userName'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
			
		echo $output;


	}elseif ($_GET['url'] == "getargumentcomments") {
		
		$arguments = $db->query('SELECT argument_comment.comment, users.userName FROM argument_comment, users WHERE argument_comment.argument_id = :argumentsid AND argument_comment.user_id = users.ID', array(':argumentsid'=> $_GET['postid']));

		$output .= "[";

		foreach ($arguments as $comment) {
			$output .= "{";
			$output .= '"comment": "'.$comment['comment'].'",';
			$output .= '"username": "'.$comment['userName'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
			
			echo $output;
				











	}elseif ($_GET['url'] == "getallmembers" && isset($_GET['group'])) {
		$groupid = $_GET['group'];
		$members = $db->query('SELECT users.userName FROM users, group_follower WHERE group_follower.group_id = :groupid AND group_follower.follower_id = users.ID', array(':groupid'=>$groupid));
		$output .= "[";
		foreach ($members as $member) {
			$output .= "{";
			$output .= '"username": "'.$member['userName'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
			
			echo $output;


	}elseif ($_GET['url'] == "auth") {
		# code...
	}elseif ($_GET['url'] == "groupargumentposts" && isset($_GET['postid'])) {

		$arguments = $db->query('SELECT group_arguments.title, group_arguments.id, group_arguments.body, group_arguments.date_at, group_arguments.likes,group_arguments.status, group_arguments.dislikes, users.userName FROM group_arguments, users WHERE group_post_id =:postid AND group_arguments.user_id = users.ID', array(':postid'=> $_GET['postid']));
		

			$output .= "[";
		foreach ($arguments as $comment) {
			$output .= "{";
			$output .= '"title": "'.$comment['title'].'",';
			$output .= '"username": "'.$comment['userName'].'",';
			$output .= '"status": "'.$comment['status'].'",';
			$output .= '"body": "'.$comment['body'].'",';
			$output .= '"dateat": "'.$comment['date_at'].'",';
			$output .= '"likes": "'.$comment['likes'].'",';
			$output .= '"dislikes": "'.$comment['dislikes'].'",';
			$output .= '"id": "'.$comment['id'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
			
			echo $output;


	}elseif ($_GET['url'] == "argumentposts" && isset($_GET['postid'])) {
		$arguments = $db->query('SELECT arguments.title, arguments.id, arguments.body, arguments.date_at, arguments.likes, arguments.status, arguments.dislikes, users.userName FROM arguments, users WHERE post_id =:postid AND arguments.user_id = users.ID', array(':postid'=> $_GET['postid']));
		

			$output .= "[";
		foreach ($arguments as $comment) {
			$output .= "{";
			$output .= '"title": "'.$comment['title'].'",';
			$output .= '"username": "'.$comment['userName'].'",';
			$output .= '"status": "'.$comment['status'].'",';
			$output .= '"body": "'.$comment['body'].'",';
			$output .= '"dateat": "'.$comment['date_at'].'",';
			$output .= '"likes": "'.$comment['likes'].'",';
			$output .= '"dislikes": "'.$comment['dislikes'].'",';
			$output .= '"id": "'.$comment['id'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
			
			echo $output;

	}elseif ($_GET['url'] == "getgrouppost") {
		$group = $_GET['group'];
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if (!($db->query('SELECT id FROM group_follower WHERE follower_id =:userid AND group_id =:groupid', array(':userid'=>$userid, ':groupid'=>$groupid))) ||($db->query('SELECT id FROM groups WHERE admin_id =:userid', array(':userid'=>$userid)))){
			echo '{"fail" : "fail"}';
		}else{
		
		$posts = $db->query('SELECT group_posts.id,group_posts.group_id, group_posts.body, group_posts.posted_at, group_posts.likes, group_posts.dislikes, users.userName FROM group_posts, users WHERE group_posts.user_id = users.ID AND group_posts.group_id =:groupid ORDER BY group_posts.posted_at DESC', array(':groupid'=>$group)); 

		$response = "[";
		foreach ($posts as $post) {
			 $response.="{";
			 $response .= '"PostId": '.$post['id'].',';
			 $response .= '"GroupId": '.$post['group_id'].',';
             $response .= '"PostBody": "'.$post['body'].'",';
             $response .= '"PostedBy": "'.$post['userName'].'",';
             $response .= '"PostDate": "'.$post['posted_at'].'",';
             $response .= '"Dislikes": "'.$post['dislikes'].'",';
             $response .= '"Likes": '.$post['likes'].'';
             $response .= "},";
		}
		$response = substr($response, 0, strlen($response)-1);
		$response .= "]";
		http_response_code(200);
		echo $response;

	}



	

	}elseif ($_GET['url'] == "messages") {
		$sender = $_GET['sender'];
		$token = $_COOKIE['SNID'];
		$receiver = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$messages = $db ->query('SELECT messages.id, messages.body, s.username AS Sender, r.username AS Receiver FROM messages LEFT JOIN users s ON messages.sender = s.id LEFT JOIN users r ON messages.receiver = r.id WHERE (r.id =:r AND s.id=:s) OR r.id=:s AND s.id=:r', array(':r'=>$receiver, ':s'=>$sender));
		
		echo json_encode($messages);

	}
	elseif ($_GET['url'] == "comments" && isset($_GET['postid'])) {
		
		$output = "";
		$comments = $db->query('SELECT comments.comment, users.userName FROM comments, users WHERE post_id = :postid AND comments.user_id = users.ID', array(':postid'=>$_GET['postid']));
		$output .= "[";
		foreach ($comments as $comment) {
			$output .= "{";
			$output .= '"Comment": "'.$comment['comment'].'",';
			$output .= '"CommentedBy": "'.$comment['userName'].'"';
			$output .= "},";
		}
		$output = substr($output, 0, strlen($output)-1);
		$output .= "]";
		echo $output;




	}elseif ($_GET['url'] == "search") {
		if (empty ($_GET['query'])){
			die('s');
		}
				$result = ltrim($_GET['query']);


		 		$tosearch = explode(" ", $result);
                if (count($tosearch) == 1) {
                        $tosearch = str_split($tosearch[0], 2);
                }
                $whereclause = "";
                $paramsarray = array(':body'=>'%'.$result.'%');
                for ($i = 0; $i < count($tosearch); $i++) {
                        if ($i % 2) {
                        $whereclause .= " OR body LIKE :p$i ";
                        $paramsarray[":p$i"] = $tosearch[$i];
                        }
                }
        
                $posts = $db->query('SELECT posts.id, posts.body, posts.posted_at, posts.likes, posts.dislikes, users.userName FROM posts, users WHERE users.id = posts.user_id AND posts.body LIKE :body '.$whereclause.' LIMIT 10', $paramsarray);
                //echo "<pre>";
                $response = "[";
				foreach ($posts as $post) {
					$response.="{";
			 		$response .= '"PostId": '.$post['id'].',';
			        $response .= '"PostBody": "'.$post['body'].'",';
			        $response .= '"PostedBy": "'.$post['userName'].'",';
			        $response .= '"PostDate": "'.$post['posted_at'].'",';
			        $response .= '"Dislikes": "'.$post['dislikes'].'",';
			        $response .= '"Likes": '.$post['likes'].'';
			        $response .= "},";
				}

				$response = substr($response, 0, strlen($response)-1);
				$response .= "]";
				http_response_code(200);
				echo $response;
		




	}elseif ($_GET['url'] == "users") {
		$token = $_COOKIE['SNID'];
		$user_id = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$username = $db->query('SELECT userName FROM users WHERE ID =:userid', array(':userid'=>$user_id))[0]['userName'];
		echo $username;

	}elseif ($_GET['url'] == "profileposts") {
		$start = (int)$_GET['start'];
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		
		$followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_at, posts.likes, posts.dislikes, users.userName FROM posts JOIN users ON users.id = posts.user_id WHERE posts.user_id = :userid OR posts.id IN (SELECT post_id FROM arguments WHERE user_id = :userid) ORDER BY posts.posted_at DESC LIMIT 4 OFFSET '.$start.';', array(':userid' =>$userid, ':userid'=>$userid));
		
		$response = "[";
		foreach ($followingposts as $post) {
			$response.="{";
			 $response .= '"PostId": '.$post['id'].',';
             $response .= '"PostBody": "'.$post['body'].'",';
             $response .= '"PostedBy": "'.$post['userName'].'",';
             $response .= '"PostDate": "'.$post['posted_at'].'",';
             $response .= '"Dislikes": "'.$post['dislikes'].'",';
             $response .= '"Likes": '.$post['likes'].'';
             $response .= "},";
		}
		$response = substr($response, 0, strlen($response)-1);
		$response .= "]";
		http_response_code(200);
		echo $response;
		
		
		

		
	}elseif ($_GET['url'] == "posts") {
		$start = (int)$_GET['start'];
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		
		$followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_at, posts.likes, posts.dislikes, users.userName FROM posts JOIN users ON users.id = posts.user_id WHERE posts.user_id = :userid OR posts.topics IN (SELECT interest_id FROM interests WHERE follower_id = :userid) ORDER BY posts.posted_at DESC LIMIT 8 OFFSET '.$start.';', array(':userid' =>$userid, ':userid'=>$userid));
		
		$response = "[";
		foreach ($followingposts as $post) {
			$response.="{";
			 $response .= '"PostId": '.$post['id'].',';
             $response .= '"PostBody": "'.$post['body'].'",';
             $response .= '"PostedBy": "'.$post['userName'].'",';
             $response .= '"PostDate": "'.$post['posted_at'].'",';
             $response .= '"Dislikes": "'.$post['dislikes'].'",';
             $response .= '"Likes": '.$post['likes'].'';
             $response .= "},";
		}
		$response = substr($response, 0, strlen($response)-1);
		$response .= "]";
		http_response_code(200);
		echo $response;
	
	}

} else if ($_SERVER['REQUEST_METHOD'] == "POST"){
	
	if($_GET['url'] == "message"){
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$body= $postBody->body;
		$receiver = $postBody->receiver;
		
			$db->query("INSERT INTO messages VALUES(0,:body, :sender, :receiver, '0')", array(':body'=>$body, ':sender'=>$userid, ':receiver'=>$receiver));
			echo '{"success" : "message sent"}';
		




	}else if($_GET['url'] == "groupargumentcomment"){
		
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$comment = $postBody->comment;
		$args_id = $postBody->argumentid;
		$token = $_COOKIE['SNID'];
		$user_id = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$argument_userid = $db->query('SELECT user_id FROM group_arguments WHERE id =:argsid', array(':argsid'=>$args_id))[0]['user_id'];
		$db->query('INSERT INTO group_argument_comment VALUES (0, :comment, NOW(), :argument_id, :user_id)', array(':comment'=>$comment, ':argument_id'=>$args_id, ':user_id'=>$user_id));
		$title .= "A comment was added on your argument: ";
		$title .= $db->query('SELECT title FROM group_arguments WHERE id =:argsid', array(':argsid'=>$args_id))[0]['title'];

		$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$argument_userid, ':sender'=>$user_id, ':extra'=>$title));
		echo '{"success" : "message sent"}';


	}else if($_GET['url'] == "argumentcomment"){
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$comment = $postBody->comment;
		$args_id = $postBody->argumentid;
		$token = $_COOKIE['SNID'];
		$user_id = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$argument_userid = $db->query('SELECT user_id FROM arguments WHERE arguments.id =:argsid', array(':argsid'=>$args_id))[0]['user_id'];
		$db->query('INSERT INTO argument_comment VALUES (0, :comment, NOW(), :argument_id, :user_id)', array(':comment'=>$comment, ':argument_id'=>$args_id, ':user_id'=>$user_id));
		$title .= "A comment was added on your argument: ";
		$title .= $db->query('SELECT arguments.title FROM arguments WHERE arguments.id =:argsid', array(':argsid'=>$args_id))[0]['title'];

		$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$argument_userid, ':sender'=>$user_id, ':extra'=>$title));
		echo '{"success" : "message sent"}';




	}else if($_GET['url'] == "users"){

		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$username = $postBody->username;
		$password = $postBody->password;
		$email = $postBody->email;
		$firstname = $postBody->firstname;
		$lastname = $postBody->lastname;

		if (!$db->query('SELECT userName FROM users WHERE userName =:username', array(':username'=>$username))){
			if (strlen($username) >=3 && strlen($username)<=32){
				if(preg_match('/[a-zA-Z0-9_]+/', $username)){
					if (strlen($password) >=6 && strlen($password)<=60){
						if (filter_var($email, FILTER_VALIDATE_EMAIL)){
							if (!$db->query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))){
								$db->query('INSERT INTO users VALUES(0, :userName, :password, :firstname, :lastname, :email, \'\')', array(':userName'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT),':firstname'=>$firstname, ':lastname'=>$lastname,':email'=>$email));
								//MAIL::sendMail('Welcom to our Social Network!', 'Your account has been created!', $email);
								$cstrong = true;
								$token = bin2hex (openssl_random_pseudo_bytes(64, $cstrong));
								$user_id = $db->query('SELECT ID from users WHERE userName=:username', array(':username'=>$username))[0]['ID'];
								$db->query('INSERT INTO login_tokens VALUES (0, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
								setcookie("SNID", $token, (time()+60*60*24*7), '/', NULL, NULL, TRUE);
								setcookie("SNID_",1, time()+60*60*24*3, '/', NULL, NULL, TRUE);
								$st = true;
								
								echo '{"Success":"'.$st.'"}';
								http_response_code(200);
							}else{
								echo '{ "Error": "Email in use!" }';
                                http_response_code(409);
							}
						}else{
							echo '{ "Error": "Invalid Email!" }';
                            http_response_code(409);
						}
					}else{
						echo '{ "Error": "Invalid Password!" }';
                        http_response_code(409);
					}
				}else{
					echo '{ "Error": "Invalid Username1!" }';
                    http_response_code(409);
				}
			}else{
				echo '{ "Error": "Invalid Username2!" }';
                http_response_code(409);
			}
		}else{
			echo '{ "Error": "User exists!" }';
            http_response_code(409);
		}



	}




}


	if($_GET['url'] == "auth"){
		//to get the body of the body request 
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$username = $postBody->username;
		$password = $postBody->password;
		if ($db->query('SELECT userName FROM users WHERE userName=:username', array(':username'=>$username))){
			if(password_verify($password, $db->query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])){
				$cstrong = true;
				$token = bin2hex (openssl_random_pseudo_bytes(64, $cstrong));
				$user_id = $db->query('SELECT ID from users WHERE userName=:username', array(':username'=>$username))[0]['ID'];
				$db->query('INSERT INTO login_tokens VALUES (0, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
				$st = true;
				//originaly instead of $st it had the token but i want to redirect to another page so i used a boolean variable be cautious it might be important to pass in the token 
				//echo "window.location.href = \"user-page.html\"";
				//header("location: user-page.html");
				setcookie("SNID", $token, (time()+60*60*24*7), '/', NULL, NULL, TRUE);
				setcookie("SNID_",1, time()+60*60*24*3, '/', NULL, NULL, TRUE);
				echo '{"Token":"'.$st.'"}';
				

			}else{
				echo '{"Error":"Invalid username or password"}';
				http_response_code(401);
			}
		}else{
			echo '{"Error":"Invalid username or password"}';
			http_response_code(401);
		}				
	}elseif ($_GET['url'] == "interests") {
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$link = $postBody->src;
		$isFollowing = false;
		$interest_id = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$user_id = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(! $db->query('SELECT interest_id FROM interests WHERE follower_id =:follower_id AND interest_id =:interest_id', array(':follower_id'=>$user_id, ':interest_id'=>$interest_id))){
			$db->query ('INSERT INTO interests VALUES (0, :follower_id, :interest_id, :link)', array(':follower_id'=>$user_id, ':interest_id'=>$interest_id, ':link'=>$link));
			echo '{"Status" : "already-following"}';

		}else{
			$db->query('DELETE FROM interests WHERE follower_id =:follower_id AND interest_id =:interest_id', array(':follower_id'=>$user_id, ':interest_id'=>$interest_id));
			echo '{"Status" : "not-following"}';
		}


	}elseif ($_GET['url'] == "interests-check") {
		$interest_id = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$user_id = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(! $db->query('SELECT interest_id FROM interests WHERE follower_id =:follower_id AND interest_id =:interest_id', array(':follower_id'=>$user_id, ':interest_id'=>$interest_id))){
			echo '{"Status" : "not-following"}';
		}else{
			echo '{"Status" : "following"}';
		}
	
	}elseif ($_GET['url'] == "groupargslikes") {
		
		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM group_argument_like WHERE argument_id= :argument_id AND user_id=:userid', array(':argument_id'=>$postId, ':userid'=>$likerId))){
			$db->query('UPDATE group_arguments SET likes=likes+1 WHERE id = :argument_id', array(':argument_id'=>$postId));
			$db->query('INSERT INTO group_argument_like VALUES(0, :argument_id, :user_id)', array(':argument_id'=>$postId, ':user_id'=>$likerId));
		
			$argument_userid = $db->query('SELECT user_id FROM group_arguments WHERE id =:argsid', array(':argsid'=>$postId))[0]['user_id'];
			$title .= "Your Argument: ";
			$title .= $db->query('SELECT group_arguments.title FROM group_arguments WHERE group_arguments.id =:argsid', array(':argsid'=>$postId))[0]['title'];
			$title .= " got liked!";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$argument_userid, ':sender'=>$likerId, ':extra'=>$title));

		}else{
			$db->query('UPDATE group_arguments SET likes=likes-1 WHERE id= :argument_id', array(':argument_id'=>$postId));
			$db->query('DELETE FROM group_argument_like WHERE argument_id = :argument_id AND user_id =:userid', array(':argument_id'=>$postId, ':userid'=>$likerId));
		}
		echo "{";
		echo '"Likes":';
		echo $db->query('SELECT likes FROM group_arguments WHERE id=:postid', array(':postid'=>$postId))[0]['likes'];
		echo "}";

	
	}elseif ($_GET['url'] == "groupargsdislikes") {

		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM group_argument_dislike WHERE argument_id= :argument_id AND user_id=:userid', array(':argument_id'=>$postId, ':userid'=>$likerId))){
			$db->query('UPDATE group_arguments SET dislikes=dislikes+1 WHERE id = :argument_id', array(':argument_id'=>$postId));
			$db->query('INSERT INTO group_argument_dislike VALUES(0, :argument_id, :user_id)', array(':argument_id'=>$postId, ':user_id'=>$likerId));
		
			$argument_userid = $db->query('SELECT user_id FROM group_arguments WHERE id =:argsid', array(':argsid'=>$postId))[0]['user_id'];
			$title .= "Your Argument: ";
			$title .= $db->query('SELECT group_arguments.title FROM group_arguments WHERE group_arguments.id =:argsid', array(':argsid'=>$postId))[0]['title'];
			$title .= " got disliked!";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$argument_userid, ':sender'=>$likerId, ':extra'=>$title));

		}else{
			$db->query('UPDATE group_arguments SET dislikes=dislikes-1 WHERE id= :argument_id', array(':argument_id'=>$postId));
			$db->query('DELETE FROM group_argument_dislike WHERE argument_id = :argument_id AND user_id =:userid', array(':argument_id'=>$postId, ':userid'=>$likerId));
		}
		echo "{";
		echo '"Dislikes":';
		echo $db->query('SELECT dislikes FROM group_arguments WHERE id=:postid', array(':postid'=>$postId))[0]['dislikes'];
		echo "}";





	}elseif ($_GET['url'] == "argsdislikes") {

		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM argument_dislikes WHERE argument_id= :argument_id AND user_id=:userid', array(':argument_id'=>$postId, ':userid'=>$likerId))){
			$db->query('UPDATE arguments SET dislikes=dislikes+1 WHERE id = :argument_id', array(':argument_id'=>$postId));
			$db->query('INSERT INTO argument_dislikes VALUES(0, :argument_id, :user_id)', array(':argument_id'=>$postId, ':user_id'=>$likerId));
		
			$argument_userid = $db->query('SELECT user_id FROM arguments WHERE arguments.id =:argsid', array(':argsid'=>$postId))[0]['user_id'];
			$title .= "Your Argument: ";
			$title .= $db->query('SELECT arguments.title FROM arguments WHERE arguments.id =:argsid', array(':argsid'=>$postId))[0]['title'];
			$title .= " got disliked!";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$argument_userid, ':sender'=>$likerId, ':extra'=>$title));

		}else{
			$db->query('UPDATE arguments SET dislikes=dislikes-1 WHERE id= :argument_id', array(':argument_id'=>$postId));
			$db->query('DELETE FROM argument_dislikes WHERE argument_id = :argument_id AND user_id =:userid', array(':argument_id'=>$postId, ':userid'=>$likerId));
		}
		echo "{";
		echo '"Dislikes":';
		echo $db->query('SELECT dislikes FROM arguments WHERE id=:postid', array(':postid'=>$postId))[0]['dislikes'];
		echo "}";







	}elseif ($_GET['url'] == "argsreport") {
		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM argument_reports WHERE user_id = :user_id AND argument_id = :argument_id', array(':argument_id'=>$postId, ':user_id'=>$likerId))){
			$db->query('UPDATE arguments SET report = report+1 WHERE id=:argument_id', array(':argument_id'=>$postId));
			$db->query('INSERT INTO argument_reports VALUES(0, :user_id, :argument_id)', array(':user_id'=>$likerId, ':argument_id'=>$postId));
		}else{
			$db->query('UPDATE arguments SET report=report-1 WHERE id=:argument_id', array(':argument_id'=>$postId));
			$db->query('DELETE FROM argument_reports WHERE argument_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
		}
		echo '{"Status" : "Success"}';





	}elseif ($_GET['url'] == "dislikes") {
		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM post_dislikes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId))){
			$db->query('UPDATE posts SET dislikes=dislikes+1 WHERE id=:postid', array(':postid'=>$postId));
			$db->query('INSERT INTO post_dislikes VALUES(0, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$likerId));
		
			$post_userid = $db->query('SELECT user_id FROM posts WHERE posts.id =:argsid', array(':argsid'=>$postId))[0]['user_id'];
			$title .= "Your Post: ";
			$big = $db->query('SELECT posts.body FROM posts WHERE id =:argsid', array(':argsid'=>$postId))[0]['body'];
			$small = substr($big, 0, 50);
			$title .= $small;
			$title .= "... got disliked!";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$post_userid, ':sender'=>$likerId, ':extra'=>$title));

		}else{
			$db->query('UPDATE posts SET dislikes=dislikes-1 WHERE id=:postid', array(':postid'=>$postId));
			$db->query('DELETE FROM post_dislikes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
		}
		echo "{";
		echo '"Dislikes":';
		echo $db->query('SELECT dislikes FROM posts WHERE id=:postid', array(':postid'=>$postId))[0]['dislikes'];
		echo "}";






	}elseif ($_GET['url'] == "argslikes") {
		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM argument_likes WHERE argument_id= :argument_id AND user_id=:userid', array(':argument_id'=>$postId, ':userid'=>$likerId))){
			$db->query('UPDATE arguments SET likes=likes+1 WHERE id = :argument_id', array(':argument_id'=>$postId));
			$db->query('INSERT INTO argument_likes VALUES(0, :argument_id, :user_id)', array(':argument_id'=>$postId, ':user_id'=>$likerId));
		
			$argument_userid = $db->query('SELECT user_id FROM arguments WHERE arguments.id =:argsid', array(':argsid'=>$postId))[0]['user_id'];
			$title .= "Your Argument: ";
			$title .= $db->query('SELECT arguments.title FROM arguments WHERE arguments.id =:argsid', array(':argsid'=>$postId))[0]['title'];
			$title .= " got liked!";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$argument_userid, ':sender'=>$likerId, ':extra'=>$title));


		}else{
			$db->query('UPDATE arguments SET likes=likes-1 WHERE id= :argument_id', array(':argument_id'=>$postId));
			$db->query('DELETE FROM argument_likes WHERE argument_id = :argument_id AND user_id =:userid', array(':argument_id'=>$postId, ':userid'=>$likerId));
		}
		echo "{";
		echo '"Likes":';
		echo $db->query('SELECT likes FROM arguments WHERE id=:postid', array(':postid'=>$postId))[0]['likes'];
		echo "}";

	}elseif ($_GET['url'] == "interestunfollow") {
		$interest_id = $_GET['id'];
		$db->query('DELETE FROM interests WHERE id=:id', array(':id'=>$interest_id));
		echo '{"Status" : "Success"}';




	}elseif ($_GET['url'] == "rejectinvite") {
		$groupid = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$db->query('DELETE FROM group_invite WHERE user_id = :user_id AND group_id = :group_id', array(':user_id'=>$userid, ':group_id'=>$groupid));
	}elseif ($_GET['url'] == "acceptinvite") {
		$groupid = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if (!$db->query('SELECT id FROM group_follower WHERE follower_id = :userid AND group_id = :groupid', array(':userid'=>$userid, ':groupid'=>$groupid))){
			$db->query('INSERT INTO group_follower VALUES (0, :follower_id, :group_id)', array(':follower_id'=>$userid, ':group_id'=>$groupid));
			$db->query('DELETE FROM group_invite WHERE user_id = :user_id AND group_id = :group_id', array(':user_id'=>$userid, ':group_id'=>$groupid));
		}
		$db->query('DELETE FROM group_invite WHERE user_id = :user_id AND group_id = :group_id', array(':user_id'=>$userid, ':group_id'=>$groupid));
		echo '{"Status" : "Success"}';



	}elseif ($_GET['url'] == "groupdislikes") {

		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM group_post_dislikes WHERE group_post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId))){
			$db->query('UPDATE group_posts SET dislikes=dislikes+1 WHERE id=:postid', array(':postid'=>$postId));
			$db->query('INSERT INTO group_post_dislikes VALUES(0, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$likerId));
		
			$post_userid = $db->query('SELECT user_id FROM group_posts WHERE id =:argsid', array(':argsid'=>$postId))[0]['user_id'];
			$title .= "Your Post: ";
			$big = $db->query('SELECT group_posts.body FROM group_posts WHERE id =:argsid', array(':argsid'=>$postId))[0]['body'];
			$small = substr($big, 0, 50);
			$title .= $small;
			$title .= "... got disliked!";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$post_userid, ':sender'=>$likerId, ':extra'=>$title));


		}else{
			$db->query('UPDATE group_posts SET dislikes=dislikes-1 WHERE id=:postid', array(':postid'=>$postId));
			$db->query('DELETE FROM group_post_dislikes WHERE group_post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
		}
		echo "{";
		echo '"Dislikes":';
		echo $db->query('SELECT dislikes FROM group_posts WHERE id=:postid', array(':postid'=>$postId))[0]['dislikes'];
		echo "}";









	}elseif ($_GET['url'] == "grouplikes") {

		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM group_post_likes WHERE group_post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId))){
			$db->query('UPDATE group_posts SET likes=likes+1 WHERE id=:postid', array(':postid'=>$postId));
			$db->query('INSERT INTO group_post_likes VALUES(0, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$likerId));
		
			$post_userid = $db->query('SELECT user_id FROM group_posts WHERE id =:argsid', array(':argsid'=>$postId))[0]['user_id'];
			$title .= "Your Post: ";
			$big = $db->query('SELECT group_posts.body FROM group_posts WHERE id =:argsid', array(':argsid'=>$postId))[0]['body'];
			$small = substr($big, 0, 50);
			$title .= $small;
			$title .= "... got liked!";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$post_userid, ':sender'=>$likerId, ':extra'=>$title));


		}else{
			$db->query('UPDATE group_posts SET likes=likes-1 WHERE id=:postid', array(':postid'=>$postId));
			$db->query('DELETE FROM group_post_likes WHERE group_post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
		}
		echo "{";
		echo '"Likes":';
		echo $db->query('SELECT likes FROM group_posts WHERE id=:postid', array(':postid'=>$postId))[0]['likes'];
		echo "}";








	}elseif ($_GET['url'] == "likes") {
		$postId = $_GET['id'];
		$token = $_COOKIE['SNID'];
		$likerId = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		if(!$db->query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId))){
			$db->query('UPDATE posts SET likes=likes+1 WHERE id=:postid', array(':postid'=>$postId));
			$db->query('INSERT INTO post_likes VALUES(0, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$likerId));
		
			$post_userid = $db->query('SELECT user_id FROM posts WHERE posts.id =:argsid', array(':argsid'=>$postId))[0]['user_id'];
			$title .= "Your Post: ";
			$big = $db->query('SELECT posts.body FROM posts WHERE id =:argsid', array(':argsid'=>$postId))[0]['body'];
			$small = substr($big, 0, 50);
			$title .= $small;
			$title .= "... got liked!";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$post_userid, ':sender'=>$likerId, ':extra'=>$title));


		}else{
			$db->query('UPDATE posts SET likes=likes-1 WHERE id=:postid', array(':postid'=>$postId));
			$db->query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
		}
		echo "{";
		echo '"Likes":';
		echo $db->query('SELECT likes FROM posts WHERE id=:postid', array(':postid'=>$postId))[0]['likes'];
		echo "}";
	
	}else if ($_GET['url'] == "creategroupargument"){

		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$postcontent = $postBody->body;
		$title = $postBody->title;
		$swing = $postBody->swing;
		$postid = $postBody->postid;
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];

		if (!$db->query('INSERT INTO group_arguments VALUES (0, :body, :user_id, NOW(), :group_post_id, :title, 0, 0, :status)', array(':body'=>$postcontent, ':user_id'=>$userid, ':group_post_id'=>$postid, ':title'=>$title, ':status'=>$swing))){
			
			$post_userid = $db->query('SELECT user_id FROM group_posts WHERE group_posts.id =:argsid', array(':argsid'=>$postid))[0]['user_id'];
			$title2 .= "An argument was added to your Post: ";
			$big = $db->query('SELECT body FROM group_posts WHERE id =:argsid', array(':argsid'=>$postid))[0]['body'];
			$small = substr($big, 0, 50);
			$title2 .= $small;
			$title2 .= "... !";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$post_userid, ':sender'=>$userid, ':extra'=>$title2));
			echo '{"Status" : "Success"}';
			http_response_code(200);
		
			

		}else{
			echo '{"Error" : "something is wrong"}';
		 	http_response_code(400);
		}







	}else if ($_GET['url'] == "createargument"){
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$postcontent = $postBody->body;
		$title = $postBody->title;
		$swing = $postBody->swing;
		$postid = $postBody->postid;
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];

		if (!$db->query('INSERT INTO arguments VALUES (0, :body, :user_id, NOW(), :post_id, :title, 0, 0, :status,0)', array(':body'=>$postcontent, ':user_id'=>$userid, ':post_id'=>$postid, ':title'=>$title, ':status'=>$swing))){
			
			$post_userid = $db->query('SELECT user_id FROM posts WHERE posts.id =:argsid', array(':argsid'=>$postid))[0]['user_id'];
			$title2 .= "An argument was added to your Post: ";
			$big = $db->query('SELECT posts.body FROM posts WHERE id =:argsid', array(':argsid'=>$postid))[0]['body'];
			$small = substr($big, 0, 50);
			$title2 .= $small;
			$title2 .= "... !";
			$db->query('INSERT INTO notifications VALUES (0, 1, :receiver, :sender, :extra, NOW())', array(':receiver'=>$post_userid, ':sender'=>$userid, ':extra'=>$title2));
			echo '{"Status" : "Success"}';
			http_response_code(200);
		
			

		}else{
			echo '{"Error" : "something is wrong"}';
		 	http_response_code(400);
		}





	}else if ($_GET['url'] == "getgroupusers"){





	}else if ($_GET['url'] == "invitegroupuser"){
		$groupId = $_GET['group'];
		$userid = $_GET['userid'];
		$token = $_COOKIE['SNID'];
		$senderid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$db->query('INSERT INTO group_invite VALUES (0, :user_id, :group_id, :sender_id)', array(':user_id'=>$userid, ':group_id'=>$groupId, ':sender_id'=>$senderid));
		$username = $db->query('SELECT userName FROM users WHERE ID = :id', array(':id'=>$userid))[0]['userName'];
		echo '{"username" : "'.$username.'"}';


	}else if ($_GET['url'] == "creategrouppost"){

		$groupId = $_GET['group'];
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$postcontent = $postBody->post;
		$topic = $postBody->topic;
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		
		if (!$db->query('INSERT INTO group_posts VALUES (0, :body, NOW(), :user_id, 0, 0, :group_id)', array(':body'=>$postcontent, ':user_id'=>$userid, ':group_id'=>$groupId ))){
			echo '{"Status" : "Success"}';
			http_response_code(200);
		}else{
			echo '{"Error" : "something is wrong"}';
		 	http_response_code(400);
		}



	}else if ($_GET['url'] == "creategroup"){
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$title = $postBody->title;
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		$db->query('INSERT INTO groups VALUES (0, :admin_id, :title)', array(':admin_id'=>$userid, ':title'=>$title));
		echo '{"Status" : "Success"}';


	}else if ($_GET['url'] == "createpost"){
		$postBody = file_get_contents("php://input");
		$postBody = json_decode($postBody);
		$postcontent = $postBody->post;
		$topic = $postBody->topic;
		$token = $_COOKIE['SNID'];
		$userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
		
		if (!$db->query('INSERT INTO posts VALUES (0, :body, NOW(), :user_id, 0, \'\', :topics, 0)', array(':body'=>$postcontent, ':user_id'=>$userid, ':topics'=>$topic ))){
			echo '{"Status" : "Success"}';
			http_response_code(200);
		}else{
			echo '{"Error" : "something is wrong"}';
		 	http_response_code(400);
		}



}else if ($_SERVER['REQUEST_METHOD'] == "DELETE"){
	if($_GET['url'] == "auth"){
		//Deleting token and logging the user out
	 if (isset($_GET['token'])){
	 	//check if the token is valid
	 	if ($db->query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>sha1($_GET['token'])))){
	 		$db->query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_GET['token'])));
	 		echo '{"Status" : "Success"}';
	 		http_response_code(200);
	 	}else{
	 		//token is not valid
	 		echo '{"Error" : "Invalid token"}';
	 		http_response_code(400);
	 	}	
	 }else{
	 	echo '{"Error" : "Malformed request"}';
	 	http_response_code(400);
	 }	

	}
}else{
	http_response_code(405);
}




?>