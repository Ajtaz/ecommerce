<!DOCTYPE html>
<html>
	<head>
		<title>Teste 3</title>
		<style>
			form { width: 200px; height: auto; margin: 0 auto; }
			label, input { width: 100%; height: auto; display: block; float:left; margin: 5px 0; }
			
		</style>
	</head>
	
	<body>

<?php

$r = 0.0; 
$n = 0;
$aux = 0; 


	if (isset($_POST['numero'])) { 		
		
			$numero = $_POST['numero'];
			echo "O triplo de " . $numero . " e " . 3 * $numero; ;
	}

?>

<form action="#" method="post">
		
		<fieldset>
		
			<label>Digite um numero:</label>
            <input type="text" name="numero" value="" />
			
			<input type="submit" value="Enviar" />

        </fieldset>
		
    </form>
	</body>
</html>