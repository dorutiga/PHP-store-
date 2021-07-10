<?php
    require_once "ShoppingCart.php";  

    template_header("Products"); 
?>
<style type="text/css">
    h3.h3{text-align:center;margin:1em;text-transform:capitalize;font-size:1.7em;}
    .container{box-shadow:      0px 0px 12px -7px;}
    
    .demo{padding:45px 0;}
    .product-grid2{font-family:'Open Sans',sans-serif;position:relative}
    .product-grid2 .product-image2{overflow:hidden;position:relative}
    .product-grid2 .product-image2 a{display:block}
    .product-grid2 .product-image2 img{width:100%;height:auto}
    .product-image2 .pic-1{opacity:1;transition:all .5s}
    .product-grid2 .product-content{padding:20px 10px;text-align:center}
    .product-grid2 .title{font-size:17px;margin:0 0 7px}
    .product-grid2 .title a{color:#303030}
    .product-grid2 .title a:hover{color:#3498db}
    .product-grid2 .price{color:#303030;font-size:15px}
    @media screen and (max-width:990px){.product-grid2{margin-bottom:30px}
    
</style>

<div class="container">
    <h3 class="h3">PRODUCTS</h3>
        <div class="row">

<?php
    $shoppingCart = new ShoppingCart();
    $query = "SELECT * FROM tbl_product";
    $product_array = $shoppingCart->getAllProduct($query);
    if (!empty($product_array)) {
        foreach ($product_array as $key => $value) {
?>

   <div class="col-md-3 col-sm-6">
        <div class="product-grid2">
            <div class="product-image2">
                <a href="product.php?action=add&code=<?php echo $product_array[$key]["code"]?>">
                    <img class="pic-1" src="<?php echo "images/".$product_array[$key]['image'];?>" alt="<?php echo "../images/".$product_array[$key]['image'];?>">
                </a>
            </div>

            <div class="product-content">
                <h3 class="title"><a href="product.php?action=add&code=<?php echo $product_array[$key]["code"]?>"><?php echo $product_array[$key]["name"]; ?></a></h3>
                <span class="price"><?php echo "$".$product_array[$key]["price"]; ?></span>
            </div>
        </div>
    </div>

     <?php
        }
     }
     ?>

    </div>
</div>

<?php 
    template_footer(); 
 ?>

