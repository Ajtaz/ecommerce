<<?php 

use \Hcode\Page;
use \Hcode\Model\Product;
use \Hcode\Model\Category;
use \Hcode\Model\Cart;
use \Hcode\Model\User;

$app->get('/', function() {

	$products = Product::listAll();

	$page = new Page();

	$page->setTpl("index", [
		'products'=>Product::checkList($products)
	]);

});

$app->get("/categories/:idcategory", function($idcategory) {

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1; 

	$category = new Category();

	$category->get((int)$idcategory);

	$pagination = $category->getProductPage();

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link'=>'/categories/'.$category-getidcategory().'?page=.$i',
			'page'=>$i
		]);

	}

	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>$pagination["data"]
	]);

});

$app->get("/products/:desurl",function($desurl){

	$product = new Product();

	$product->getfromURL($desurl);

	$page = new Page();

	$page->setTpl("product-detail", [
		'product'=>$product->getValues(),
		'categories'=>$product->getCategories()
	]);

});


$app->get("/logout", function(){

	User::logout();

	Cart::removeFromSession();

    session_regenerate_id();

   	header("Location: /login");

   	exit;
});

$app->get("/login", function(){


	$page = new Page();

	$page->setTpl("login");

});

$app->post("/login", function(){

	try{

			User::login($_POST['login'], $_POST['password']);

    }catch(Exception $e){

    		User::setError($e->getMessage()); 

    }

	header("Location: /checkout");
	exit;
});


$app->get("/cart", function(){

	$cart = Cart::getFromSession();

    $page = new Page();

	$page->setTpl("cart", [
		'cart'=>$cart->getvalues(),
		'products'=>$cart->getProducts(),
		'error'=>Cart::getMsgError()
	]);

});

$app->get("/cart/:idproduct/add", function($idproduct){//rota para add no carrinho
	
	$product = new product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();

	$qtd = (isset($_GET['qtd'])) ? (int)$_GET['qtd'] : 1;

	for ($i=0; $i < $qtd; $i++) { 
		$cart->addProduct($product);
	}

	header("Location: /cart");
	exit;

});

$app->get("/cart/:idproduct/minus", function($idproduct){ //caminho p/ remover apenas um produto do carrinho
	
	$product = new product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();

	$cart->removeProduct($product);

	header("Location: /cart");
	exit;

});

$app->get("/cart/:idproduct/remove", function($idproduct){//caminho p/ remover todos os produto do carrinho
	$product = new product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();

	$cart->removeProduct($product, true);

	header("Location: /cart");
	exit;

});

$app->post("/cart/freight", function(){

	$cart = Cart::getFromSession();

	$cart->setFreight($_POST['zipcode']);

	header("Location: /cart");
	exit;

});


?>