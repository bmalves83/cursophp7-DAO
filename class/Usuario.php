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

			$this->setData($result[0]);
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

			$this->setData($result[0]);

		} else {

			throw new Exception("Login e/ou senha inválidos");
			
		}
	}

	// Método que traz o resultado
	public function setData($data)
	{
		$this->setIdusuario($data['id_usuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}


	// Método para adicionar um novo usuário
	public function insert()
	{
		$sql = new Sql();

		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha()
		));

		if(count($result) > 0)
		{
			
			$this->setData($result[0]);
		
		}
	}
	
	public function update($login, $password)
	{
		$this->setDeslogin($login);
		$this->setDessenha($password);
		
		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE id_usuario = :ID", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha(),
			":ID"=>$this->getIdusuario()
		));
	}

	public function __construct($login = "", $senha = "")
	{
		$this->setDeslogin($login);
		$this->setDessenha($senha);
	}

	// Retorna o resultado pronto num JSON
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