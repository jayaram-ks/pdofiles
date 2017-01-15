<?php
include_once('dbconnect.php');
class ManageUsers()
{
	public $link;
	public function __construct()
	{
		$dbconnection = new dbConnection();
		$this->link = $dbconnection ->connect();
		return $this link;
	}
	public function RegisterUsers($username,$password,$ip_address,$reg_date)
	{
		$query = $this->link->prepare("INSERT INTO users (username,password,ip_address,reg_date,reg_time) VALUES(?,?,?,?,?)");
		$values = array($username,$password,$ip_address,$reg_date);
		$query->execute($values);
		$counts = $query->rowCount(); 
	}

}

$users = new ManageUsers();
$users->RegisterUsers('Jayaram','123','1.1.1.1','2015-03-11','12:00');

?>
