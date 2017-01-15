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

}
?>
