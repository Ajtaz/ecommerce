<?php

require_once("funcionarioDAO.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["flag"])) {
		$flagErr = "Flag não informada";
	} else {
		$flag = test_input($_POST["flag"]);
	  }
	if (empty($_POST["id"])) {
		$idErr = "Id é necessário";
	} else {
		$id = test_input($_POST["cargo"]);
	  }
}

	if ($flag = "consulta_func") 
	{
		salva($nome);
	}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
