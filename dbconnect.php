<?php 
class DbConnection()
{
	protected $db_conn;
    public $db_host = 'localhost';
    public $db_name = 'db_pdo';
    public $db_user = 'root';
    public $db_pass = '';

    function connect()
    {
    	try
    	{
 			$this->db_conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_pass);
    	}
    	catch(PDOexception $e)
    	{
    		return $e->getMessage();
    	}	
    }
}
?>