<?php

$var1 = 1; $var2 = 2; 

$a = 2; $b = 5; $c = 4;

 echo "</br>" . "O resto da divisão de $a por $b: " . $a % $b;

 echo "</br>" .  "O resto da divisão de $b por $a: " . $b % $a;

exit;


 // global $var1, $var2;

function funcao1() {


 $var1 = 100; $var2 = 100;
 echo  "</br>" . "Variavéis dentro da funcao1(): var1= $var1, var2= $var2";

}

function funcao2() {

 $var1 = 999; $var2 = 999; 
 
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


Variavéis antes de chamar a funcao1(): var1= 1, var2= 2
Variavéis dentro da funcao1(): var1= 100, var2= 100
Variavéis depois de chamar a funcao1(): var1= 1, var2= 2
Variavéis dentro da funcao2(): var1= 1000, var2= 1001
Variavéis depois de chamar a funcao2(): var1= 1, var2= 2

 */
?>