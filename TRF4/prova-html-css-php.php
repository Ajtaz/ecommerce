<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: red;}
</style>
</head>
<body>
<?php
$nomeErr = $cargoErr = $sexoErr = "";
$nome = $cargo = $sexo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["nome"])) {
		$nomeErr = "Nome é necessário";
	} else {
		$nome = test_input($_POST["nome"]);
	  }
	if (empty($_POST["cargo"])) {
		$cargoErr = "Cargo é necessário";
	} else {
		$cargo = test_input($_POST["cargo"]);
	  }
	if (empty($_POST["sexo"])) {
		$sexoErr = "Campo sexo é necessário";
	} else {
		$sexo = test_input($_POST["sexo"]);
	  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<h2>Formulário Candidatos para o Concurso do TRF3</h2>
<p><span class="error">* campo necessário</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Nome: <input type="text" name="nome">
<span class="error">* <?php echo $nomeErr;?></span>
<br><br>

Cargo: <input type="text" name="cargo">
<span class="error">* <?php echo $cargoErr;?></span>
<br><br>

Sexo: <input type="radio" name="sexo" value="female">Female
<input type="radio" name="sexo" value="male">Male
<span class="error">* <?php echo $sexoErr;?></span>
<br><br>

<input type="submit" name="submit" value="Submit">

/form>
</body>
</html>