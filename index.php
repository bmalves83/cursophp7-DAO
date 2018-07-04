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
//$aluno = new Usuario();
//$aluno->setDeslogin("BMAlDs19");
//$aluno->setDessenha("12s3asdf");
//$aluno->insert();
//echo $aluno;

// Como agora tem um método construtor para inserir dados no banco funcionará assim
//$aluno = new Usuario("Jupira", "41589722asd");
//$aluno->insert();
// Se quiser retornar ele na tela pode imprimir
//echo $aluno;

// Dando update dos dados no banco
$aluno = new Usuario();
// Carregando o ID que será alterado 
// No caso desse exercício será será feito assim, no caso prático 
// o ideal é exibir toda a lista na tela e permitir que o usuário faça a alteração do campo e salve por exemplo
$aluno->loadById(8);
// Passando os novos dados para o ID selecionado
$aluno->update("IgorJup", "Ksdv994");

echo $aluno;
?>