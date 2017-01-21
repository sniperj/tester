<?php error_reporting(E_ALL);
require_once("con.php");
class users 
{
	private $con ; 
	private $pdo ;

	function __construct()
	{
		$this->con = new dbase() ;
		$this->pdo = $this->con->connect();
	}

	 public function add()
	 {

	 	try
	 	{
	 		$_REQUEST['password'] = password_hash($_REQUEST['password'],PASSWORD_DEFAULT);
			$stmt = $this->pdo->prepare('insert into users (username, password, email, name,status_id) values(:username,:password,:email,:name,:status_id)');
			$no_error[0]=$stmt->execute(array('username'=>$_REQUEST['username'],'password'=>$_REQUEST['password'],'email'=>$_REQUEST['email'],'name'=>$_REQUEST['name'],'status_id'=>$_REQUEST['status_id']));
			$stmt->closeCursor();
			$pdo = null; 

			if($no_error[0])
			{
				$no_error[1] = "Added user successfully.";
			}	
			else
			{
				$no_error[1] = "Failed to add user.";
			} 		
		 }
	 	catch(Exception $e)
	 	{
	 		$no_error[0]	= false ; 
	 		$no_error[1]	= $e->getMessage() ; 
	 	} 	
	 	echo json_encode($no_error);
	 }

	 public function get() 
	 {
	 		$sql = "select * from users".(isset($_REQUEST['user_id'])?" where user_id=".$_REQUEST['user_id']:"");;

	 		$stmt = $this->pdo->query($sql);
			$stmt->execute();
			echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
			$stmt->closeCursor();
			$pdo = null;	

	 }
	 public function update()
	 {

	 	try
	 	{
			$stmt = $this->pdo->prepare('update users set username=:username, email=:email, name=:name where user_id=:user_id');
			$no_error[0]=$stmt->execute(array('user_id'=>$_REQUEST['user_id'],'username'=>$_REQUEST['username'],'email'=>$_REQUEST['email'],'name'=>$_REQUEST['name']));
			if($no_error[0])
			{
				$no_error[1] = "User updated successfully.";
			}	
			else
			{
				$no_error[1] = "Failed to update user.";
			} 		
		 }
	 	catch(Exception $e)
	 	{
	 		$no_error[0]	= false ; 
	 		$no_error[1]	= $e->getMessage() ; 
	 	} 	
	 	echo json_encode($no_error);
	 }
	 public function delete()
	 {
	 	try
	 	{
			$stmt = $this->pdo->prepare('delete from users where user_id=:user_id');
			$no_error[0]=$stmt->execute(array('user_id'=>$_REQUEST['user_id']));
			$stmt->closeCursor();
			$pdo = null; 

			if($no_error[0])
			{
				$no_error[1] = "User deleted successfully.";
			}	
			else
			{
				$no_error[1] = "Failed to delete user.";
			} 		
		 }
	 	catch(Exception $e)
	 	{
	 		$no_error[0]	= false ; 
	 		$no_error[1]	= $e->getMessage() ; 
	 	} 	
	 	echo json_encode($no_error);		 	
	 }

}


