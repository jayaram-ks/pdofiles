<?php
include_once('dbconnect.php');
class ManageUsers 	
{
	public $link;
	public function __construct()
	{
		$dbconnection = new DbConnection();
		$this->link = $dbconnection ->connect();
		return $this->link;
		
	}
	public function RegisterUsers($username,$password,$email,$mobile,$ip_address,$reg_date,$reg_time)
	{
		$query = $this->link->prepare("INSERT INTO users (username,password,email,mobile,ip_address,reg_date,reg_time) VALUES (?,?,?,?,?,?,?)");
		$values = array($username,$password,$email,$mobile,$ip_address,$reg_date,$reg_time);
		$query->execute($values);
		$counts = $query->rowCount(); 
		return $counts;
	}
	public function LoginUsers($username,$password)
	{
		$query = $this->link->query("SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."' ");
		$rowcount = $query->rowCount();
		return $rowcount; 
	}
	public function GetUserInfo($username)
	{
		$query = $this->link->query("SELECT * FROM users WHERE username = '".$username."'");
		$rowcount = $query->rowCount();
		if($rowcount==1)
		{
			$result = $query->fetchAll();
			return $result; 
		}
		else
		{
			return $rowcount;
		}
	}

	public function PdoTransaction()
	{
		$this->link->beginTransaction();
		sleep(5);
	    // our SQL statements
	    $this->link->exec("INSERT INTO users (username, password, email) 
	    VALUES ('John', 'Doe', 'john@example.com')");
	    $this->link->exec("INSERT INTO users (username, password, email) 
	    VALUES ('Mary', 'Moe', 'mary@example.com')");
	    $this->link->exec("INSERT INTO users (username, password, email) 
	    VALUES ('Julie', 'Dooley', 'julie@example.com')");
	    // commit the transaction
	    $this->link->commit();
	   
	}

}

$users = new ManageUsers();
//$users->RegisterUsers('Jayaram'.rand(),'123'.rand(),'1.1.1.1'.rand(),'2015-03-11'.rand(),'12:00'.rand());

?>
