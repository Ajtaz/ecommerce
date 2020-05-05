<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app->get("/admin/users", function(){

 	User::verifyLogin();

 	$users = User::listAll();

 	$page = new PageAdmin();

 	$page->setTpl("users", array(
 		"users"=>$users
 	));

});

$app->get("/admin/users/create", function(){

 	User::verifyLogin();

  	$page = new PageAdmin();

 	$page->setTpl("users-create");

});

$app->get("/admin/users/:iduser/delete", function($iduser){

 	User::verifyLogin();

 	$user = new User();

 	$user->get((int)$iduser);

 	$user->delete();

 	header("Location: /admin/users");
 	exit;

});

$app->get("/admin/users/:iduser", function($iduser){

 	User::verifyLogin();

 	$user = new User();

 	$user->get((int)$iduser);

 	$page = new PageAdmin();

 	$page->setTpl("users-update", array(
 		"user"=>$user->getValues()
 	));

});

$app->post("/admin/users/create", function(){

 	User::verifyLogin();

 	$user = new User();

 	echo "rota: /admin/users/create";
 	exit;

 	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

 	$msg = 1;
 	//$msg = checkInput();
 	
 	if ($msg = 0) {
 		$user->setData($_POST);
 		$user->save();
 	}  
 	else {
 		echo "falhou " . $msg;
 		exit;
 	}

 	header("Location: /admin/users");

});

$app->post("/admin/users/:iduser", function($iduser){

 	User::verifyLogin();

 	$user = new User();

 	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

 	$user->get((int)$iduser);

 	$user->setData($_POST);

 	$user->update();

 	header("Location: /admin/users");
 	exit;

});

function checkInput() {
	// import_request_variables("gP");

	$msgErr=null;

	if (empty($_POST["desperson"])) {
		$msgErr = $msgErr . "Nome é obrigatório. " ;
	} else {
		$desperson = test_input($_POST["desperson"]);
			    // check if field only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$desperson)) {
			$msgErr = $msgErr . "Somente letras e espaço permitidos no nome. ";
		}
	}

	if (empty($_POST["deslogin"])) {
		$msgErr = $msgErr . "Login é obrigatório. ";
	} else {
		$deslogin = test_input($_POST["deslogin"]);
			    // check if field only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$deslogin)) {
			$msgErr = $msgErr . "Somente letras e espaço permitidos no login. ";
		}
	}

	if (empty($_POST["desphone"])) {
		$msgErr = $msgErr . "Telefone é obrigatório. ";
	} else {
		$desphone = test_input($_POST["deslogin"]);
	}

	if (empty($_POST["desemail"])) {
		$msgErr = $msgErr . "Email é obrigatório. ";
	} else {
		$desemail = test_input($_POST["desemail"]);
	}

	if (empty($_POST["dessenha"])) {
		$msgErr = $msgErr . "É obrigatório definir uma senha. ";
	} else {
		$dessenha = test_input($_POST["dessenha"]);
		if ($dessenha == $deslogin) {
			$msgErr = $msgErr . "Senha não pode ser igual ao login. ";
		}
	}

	if (is_null($msgErr)) return 0;
		else {
			return $msgErr;
		} 
			
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


function formatMessage() {
	$data = "mensagem de erro";
	return $data;
}

?>