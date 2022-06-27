<?php  
session_start();
include "../db_conn.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$role = test_input($_POST['role']);

	if (empty($username)) {
		header("Location: ../index.php?error=User Name is Required");
	}else if (empty($password)) {
		header("Location: ../index.php?error=Password is Required");
	}else {
			try{


				// Hashing the password
				$password = md5($password);
				
				$sql = "SELECT * FROM users WHERE username=:userna AND password=:passw";
				$select_stmt = $db->prepare($sql);
				$select_stmt->bindParam(":userna",$username);
				$select_stmt->bindParam(":passw",$password);
				$select_stmt->execute();

				
					// the user name must be unique
					while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
						$name_db = $row['name'];
						$id_db = $row['id'];
						$role_db = $row['role'];
						$usernam_db = $row['username'];
						$password_db = $row['password'];
					}

					if ($username != null && $password != null && $role != null) {
						if($select_stmt->rowCount() > 0){
							if ($username == $usernam_db && $password == $password_db && $role == $role_db) {
								$_SESSION['name'] = $name_db;
								$_SESSION['id'] = $id_db;
								$_SESSION['role'] = $role_db;
								$_SESSION['username'] = $usernam_db;
				
								header("Location: ../home.php");
							}else{
								header("Location: ../index.php?error=Incorect milea User name or password");
							}
						}else {
							header("Location: ../index.php?error=Incorect asdf User name or password");
						}				

					}else {
						header("Location: ../index.php?error=Incorect fdasf User name or password");
					}
			}catch(PDOException $e){
				$e->getMessage();
			}
        

	}
	
}else {
	header("Location: ../index.php");
}