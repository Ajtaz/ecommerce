<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
Use \Hcode\Model;
Use \Hcode\Mailer;
Use \Hcode\Model\User;

class Cart extends Model {

	const SESSION = "Cart";

	public static function getFromSession()
	{
		
		$cart = new Cart();
		
		/*
		foreach ($_SESSION as $key=>$value)
    	{
	        var_dump($value);
	    }
		*/

		if(isset($_SESSION[Cart::SESSION]['idcart']) && (int)$_SESSION[Cart::SESSION]['idcart'] > 0){//se a sessão estiver ativa - procura o carrinho

			$cart->get((int)$_SESSION[Cart::SESSION]['idcart']);

		} else { // ainda não há um carrinho 

			$cart->getFromSessionID();

			If (!(int)$cart->getidcart() > 0) {

				$data = [
					'dessessionid'=>session_id()
				];

				if (User::checkLogin(false)) {

					$user = User::getFromSession();

					$data['iduser'] = $user->getiduser();

				}

				$cart->setData($data);

				$cart->save();

				$cart->SetToSession();

			}

		}

		return $cart;

	}


	public function setToSession()
	{

		$_SESSION[Cart::SESSION] = $this->getValues();

	}


	public function getFromSessionID()
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carts WHERE dessessionid = :dessessionid", [
			':dessessionid'=>session_id()
		]);

		// var_dump($results);

		if (count($results) > 0) {

			$this->setData($results[0]);
		}
	}


	public function get(int $idcart)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carts WHERE idcart = :idcart", [
			':idcart'=>$idcart
		]);

		if (count($results) > 0) {

			$this->setData($results[0]);

		}

	}


	public function save()
	{

		$sql = new Sql();

		return $sql->select("CALL sp_carts_save(:idcart, :dessessionid, :iduser, :deszipcode, :vlfreight, :nrdays)", [
			':idcart'=>$this->getidcart(),
			':dessessionid'=>$this->getdessessionid(),
			':iduser'=>$this->getiduser(),
			':deszipcode'=>$this->getdeszipcode(),
			':vlfreight'=>$this->getvlfreight(),
			':nrdays'=>$this->getnrdays(),
		]);

		if (count($results) > 0) {

			$this->setData($results[0]);
		}
	}


	public static function removeFromSession() {
    	
    	$_SESSION[Cart::SESSION] = NULL;
	
	}

	public function addProduct(Product $product) //funcao para adicionar produto ao carrinho
	{
		$sql = new Sql();

		$sql->query("INSERT INTO tb_cartsproducts(idcart, idproduct) VALUES (:idcart, :idproduct)", [
			':idcart'=>$this->getidcart(),
			':idproduct'=>$product->getidproduct()
		]);

	}

	public function removeProduct(Product $product, $all = false)
	{
		$sql = new Sql();

		if($all)
		{
			$sql->query("UPDATE tb_cartsproducts SET dtremoved = now() WHERE idcart = :idcart AND idproduct = :idproduct AND dtremoved IS NULL", [
				':idcart'=>$this->getidcart(),
				'idproduct'=>$product->getidproduct()
			]);
		} else {
		
			$sql->query("UPDATE tb_cartsproducts SET dtremoved = now() WHERE idcart = :idcart AND idproduct = :idproduct AND dtremoved IS NULL LIMIT 1", [
				':idcart'=>$this->getidcart(),
				'idproduct'=>$product->getidproduct()
			]);
		}

			//forçar atualização do frete qdo for excluido um item do carrinho 

		// $this->getCalculateTotal();

	}

	public function getProducts() // mostrar os produtos dentro do carrinho
	{
		
		$sql = new Sql();

		$rows = $sql->select("
			SELECT b.idproduct, b.desproduct, b.vlprice, b.vlwidth, b.vlheight, b.vllength, b.vlweight, b.desurl, COUNT(*) AS nrqtd, SUM(b.vlprice) AS vltotal
		    FROM tb_cartsproducts a 
		    INNER JOIN tb_products b 
		    ON a.idproduct = b.idproduct 
		    WHERE a.idcart = :idcart AND a.dtremoved IS NULL 
		    GROUP BY b.idproduct , b.desproduct, b.vlprice, b.vlwidth, b.vlheight, b.vllength, b.vlweight, b.desurl
		    ORDER BY b.desproduct
		", [
		 	':idcart'=>$this->getidcart()
		]);

		return Product::checklist($rows);

	}

	public function getProductsTotals()
	{
		$sql = new Sql();

		$results = $sql->select(" SELECT SUM(vlprice) AS vlprice, SUM(vlwidth) AS vlwidth, SUM(vlheight) AS vlheight, SUM(vllength) AS vllength, SUM(vlweight) AS vlweight, COUNT(*) AS nrqtd 
									FROM tb_products a
							  INNER JOIN tb_cartsproducts b 
							          ON a.idproduct = b.idproduct
							       WHERE b.idcart = :idcart
							         AND dtremoved IS NULL
			", [
				':idcart'=>$this->getidcart()
			]);


		if(count($results) > 0)
		{
			return $results[0];
		}else
		{
			return [];
		}
	}
}

?>