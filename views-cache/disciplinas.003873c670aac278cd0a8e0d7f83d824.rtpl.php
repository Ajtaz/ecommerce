<?php if(!class_exists('Rain\Tpl')){exit;}?>&lt;?php

<!DOCTYPE html>
<html>
<head>
<style>
#disciplinas {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

#disciplinas td, #disciplinas th {
  border: 1px solid #ddd;
  padding: 8px;
}

#disciplinas tr:nth-child(even){background-color: #f2f2f2;}

#disciplinas tr:hover {background-color: #ddd;}

#disciplinas th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>

<table id="disciplinas">
  <tr>
    <th>Código</th>
    <th>Disciplina</th>
    <th>Aulas</th>
    <th>Horas</th>
  </tr>

/*
   um array multidimensional deve ser providenciado 
*/

$disciplina = array
  (
  array("POR", "Português",              10, 0),
  array("DCO", "Direito Constitucional", 15, 0),
  array("DAD", "Direito Administrativo",  7, 0),
  array("RLM", "Raciocínio Lógico",      17, 0)
  );

 foreach ($disciplina as $value) {
    foreach ($value as $cod, $nome, $aulas); {
    }
 }
?&gt;
  <tr>
    <td>POR</td>
    <td>Português</td>
    <td>10</td>
    <td>35</td>
  </tr>
 
</table>

</body>
</html>