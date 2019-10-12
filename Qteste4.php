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

	<p> $numero </p>	

<?php

	if (isset($_POST['numero'])) { 		
		
			$numero = $_POST['numero'];
			calcula($numero);
	}


function calcula($n) {

	$r = 0; $aux = 0; 

	while ($n <= 1) {

		$r = 1.0;
		for ($aux=2; $aux <= $n ; $aux++) { 
			
			$r = $r + 1.0 / $aux; 

		}
	    echo "resultado = " . $r;	

	}

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