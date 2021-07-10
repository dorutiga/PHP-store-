<?php
    require_once "ShoppingCart.php";  
    template_header("Products");

    $code = $_GET['code'] ?? "";

    $shoppingCart = new ShoppingCart();
    $query = "SELECT * FROM tbl_product";
    $product = $shoppingCart->getProductByCode($code);

    if(!$product) {
    	exit("Product doesn't exist.");
    }

?>

<div class="product content-wrapper">
	<img src="<?php echo "images/".$product[0]['image'];?>" width="50%" height="50%" alt="<?php echo "img/".$product[0]['image'];?>">
	<div>
		<h1 class="name"><?php echo $product[0]["name"]; ?></h1>
		<span class="price"><?php echo "$".$product[0]["price"]; ?>
		</span>
		<form action="cos.php?action=add&code=<?php echo $product[0]["code"];?>" method="post">
			<input type="number" name="quantity" value="1" min="1" placeholder="Quantity" required>
			<input type="hidden" name="product_id" value="<?php echo $product[0]['id']; ?>">
			<input type="submit" value="Add to cart">
		</form>
		<div class="description">
			<?php echo $product[0]["description"]; ?>
		</div>
	</div>
</div>

