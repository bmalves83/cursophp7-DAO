<?php 

require_once("config.php");

//$sql = new Sql();
//$users = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($users);

// Retorna um item da lista
//$root = new Usuario();
//$root->loadById(5);
//echo $root;

//Retorna todos os itens da lista
//$lista = Usuario::getList();
//echo json_encode($lista);

// Carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("ria");
//echo json_encode($search);

// Retorna um resultado no caso se o Login e Senha estiverem corretos
//$user = new Usuario();
//$user->login("Bruno", "12345687");
//echo $user;

// Exemplo de inserção com procedure
$aluno = new Usuario();

$aluno->setDeslogin("BMAlDs19");
$aluno->setDessenha("12s3asdf");

$aluno->insert();

echo $aluno;

?>