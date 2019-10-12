<?php

$var1 = 1; $var2 = 2; 

function funcao1() {

 global $var1, $var2;
 $var1 = 100; $var2 = 100;
 echo  "</br>" . "Variavéis dentro da funcao1(): var1= $var1, var2= $var2";

}

function funcao2() {

 global $var1, $var2;
 $var1 = $var1 + 1; 
 $var2 = $var2 + 2;
 echo "</br>" . "Variavéis dentro da funcao2(): var1= $var1, var2= $var2";

}

 echo "</br>" . "Variavéis antes de chamar a funcao1(): var1= $var1, var2= $var2";
 funcao1();
 echo "</br>" . "Variavéis depois de chamar a funcao1(): var1= $var1, var2= $var2";
 funcao2();
 echo "</br>" . "Variavéis depois de chamar a funcao2(): var1= $var1, var2= $var2";

 /* Resultado 

Variavéis antes de chamar a funcao1(): var1= 1, var2= 2
Variavéis dentro da funcao1(): var1= 100, var2= 100
Variavéis depois de chamar a funcao1(): var1= 100, var2= 100
Variavéis dentro da funcao2(): var1= 101, var2= 102
Variavéis depois de chamar a funcao2(): var1= 101, var2= 102




C - Variaveis dentro da funcao2(): var1=101 var2=102

E - Variaveis depois de chamar a funcao2(): var1=101 var2=102

 */
?>