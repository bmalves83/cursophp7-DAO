<?php 

class Usuario 
{

	private $iduser;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario()
	{
		return $this->iduser;
	}

	public function setIdusuario($value)
	{
		$this->iduser = $value;
	}

	public function getDeslogin()
	{
		return $this->deslogin;
	}

	public function setDeslogin($value)
	{
		$this->deslogin = $value;
	}

	public function getDessenha()
	{
		return $this->dessenha;
	}

	public function setDessenha($value)
	{
		$this->dessenha = $value;
	}

	public function getDtcadastro()
	{
		return $this->dtcadastro;
	}

	public function setDtcadastro($value)
	{
		$this->dtcadastro = $value;
	}

	// Método que traz um dado específico da tabela
	public function loadById($id)
	{
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID", array(
			":ID"=>$id
		));

		if(isset($result[0]))
		{
			$row = $result[0];

			$this->setIdusuario($row['id_usuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}

	}

	// Método que trará todos os dados de uma tabela
	public static function getList()
	{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios");
	}

	// Método que busca com base no nome do usuário
	public static function search($login)
	{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			":SEARCH"=>"%".$login."%"
		));
	}

	// Método para fazer uma busca mais detalhada com base no login e senha
	public function login($login, $password)
	{
		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASS", array(
			":LOGIN"=>$login,
			":PASS"=>$password
		));

		if(count($result) > 0)
		{
			$row = $result[0];

			$this->setIdusuario($row['id_usuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		} else {

			throw new Exception("Login e/ou senha inválidos");
			
		}
	}

	public function __toString()
	{
		return json_encode(array(
			"id_usuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format('d-m-Y')
		));
	}
}


?>