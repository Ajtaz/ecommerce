<?php

class funcionario extends PDO {

private $id;
private $nome;

public function getId() {return $this->id;}
public function setId($id) {$this->id = $id;}
public function getNome() {return $this->nome;}
public function setNome($nome) {$this->nome = $nome;}

	private $conn;

	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=banco", "root", "");

	}

	public function consulta($id)  
	{

		$stmt = $this-> "SELECT * FROM funcionario WHERE id = $id";
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		print_r($result);
		return $result;

	}

	public function salva() 
	{
		setNome()
		$stmt = $this-> "INSERT INTO funcionario (nome) VALUES ($nome)";
		$stmt->execute();

	}

}

?>