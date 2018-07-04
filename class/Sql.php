<?php 
//Exibindo todos os Erros e Warnings para facilitar a identificação
ini_set('display_errors', true);
error_reporting(E_ALL);


class Sql extends PDO
{
	private $conn;

	public function __construct()
	{
		// Para conectar com banco de dados MySql
		if(!defined('BD_Mysql'))
		{
			define('BD_Mysql', ['mysql:host=localhost;', 'dbname=dbphp7', 'root', '']);
		}
		
		// Para conectar com banco de dados SQL Server
		if(!defined('BD_Sql'))
		{
			define('BD_Sql', ['sqlsrv:Database=bdphp7;', 'server=localhost\SQLEXPRESS;ConnectionPooling=0;', 'bmalves', '21,1983,']);
		}	
		
		$this->conn = new PDO(BD_Mysql[0].BD_Mysql[1], BD_Mysql[2], BD_Mysql[3]);
	}

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->setParam($statement, $key, $value);

		}

	}

	private function setParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{
		
		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchALL(PDO::FETCH_ASSOC);

	}
}


 ?>