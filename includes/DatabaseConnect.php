<?php


class DatabaseConnect
{
	

private $dbname;
private $dbusername;
private $dbpassword;
private $host;

public function __construct($config)
{
	//creates a database instance
	
	$this->dbname 		= $config['dbname'];
	$this->dbusername 	= $config['dbusername'];
	$this->dbpassword   = $config['dbpassword'];
	$this->host         = $config['host'];
}
	
	
public function connect()
	{
		
		// Return a connection string if successfull else return false..	
	
		try {
			
			$conn = new PDO('mysql:host=localhost;dbname=autocode',$this->dbusername,$this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
			return $conn;

			}


		catch(PDOException $e)
			{
	
			return false;
			}
	}

public function read($conn,$bindings,$query)
	{	
		
	// return the query results if the query passes else returns false

		$stmt = $conn->prepare($query);
		try {
		$stmt->execute($bindings);
		return $stmt;
		}
		catch(PDOException $e)
		{
			return $e->getMessage();
		}
	}
	
public function insert($conn,$bindings,$query)
{
	
	$stmt = $conn->prepare($query);
	
	try {
		
	 		return $stmt->execute($bindings);
	 		
	 	
		 }
		 
	 catch(PDOException $e)
	 { 
		  return  $e;
	  }
}

public function delete()
{
	
}

}

 ?>
