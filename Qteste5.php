<?php

	$r = 0; $aux = 0; 
	$n = 2;
	$i = 0;
  for ($i = 2; $i <= 99; $i++) {
	$n = $i;
	while ($n >= 1) {

		$r = 1.0;
		for ($aux=2; $aux <= $n ; $aux++) { 
			
			$r = $r + 1.0 / $aux; 

		}
	    echo "<br>" . "resultado para " . $n . " = " . $r;	
	    $n =0;
	}
  }
?>