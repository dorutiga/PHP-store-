<?php
require_once "ShoppingCart.php";

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
    $quantity = $_POST['quantity'] ?? 0;
    $product_id = $_POST['product_id'] ?? 0;

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            // Produsul există în coș, așa că trebuie doar să actualizați cantitatea
            $_SESSION['cart'][$product_id] += $quantity;
    }   else {
            // Produsul nu este în coș, așa că adăugați-l
            $_SESSION['cart'][$product_id] = $quantity;
        }
    } 
    else {
        // se adauga primul produs in cosul gol
        $_SESSION['cart'] = array($product_id => $quantity);
    }

if(isset($_POST['placeorder'])) {
    header("Location: placeorder.php");
}

$member_id=$_SESSION['id'];
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
    switch ($_GET["action"]) {
    case "add":
    if (! empty($_POST["quantity"])) {
        $productResult = $shoppingCart->getProductByCode($_GET["code"]);
        $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);
        if (! empty($cartResult)) {
            $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
            $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
        } 
        else {
            $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $member_id);
        }
    }
    break;
    case "remove":
    $shoppingCart->deleteCartItem($_GET["id"]);
    break;
    case "empty":
    $shoppingCart->emptyCart($member_id);
    break;
    }
}   
    $produse = "";
    template_header("Cos");
?>

<div class="cart content-wrapper">
    <h1>▄︻̷̿┻̿═━一</h1>

    <form action="placeorder.php" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Code</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $cartItem = $shoppingCart->getMemberCartItem($member_id);
                    $item_total = 0;
                 ?>

                <?php if(empty($cartItem)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">You don't have products in Cart</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($cartItem as $item): ?>
                    <tr>
                        <td class="img">
                            <a href="index.php?page=product&id=<?=$product['id']?>">
                                <img src="<?php echo "images/" . $item["image"];?>" width="50" height="50" alt="<?php echo "images/" . $item["image"];?>">
                            </a>
                        </td>
                        <td>
                            <a href="index.php?page=product&id=<?=$product['id']?>"><?php echo $item["name"]; ?></a><br>
                        </td>
                        <td><?php echo $item["code"]; ?></td>

                        <td class="price"><?php echo "$".$item["price"]; ?></td>

                        <td class="price"><input type="number" name="quantity" value="<?php echo $item["quantity"]; ?>" min=0 max=500 readonly></td>

                        <td class="price"><?php echo "$" . ($item["price"] * $item["quantity"]) ?></td>

                        <td><a href="cos.php?action=remove&id=<?php echo $item["cart_id"]; ?>" class="remove" ><img src="icon-delete.png" alt="icon-delete" title="Remove Item" /></a></a></td>
                    </tr>  
                    
                    <?php $item_total += ($item["price"] * $item["quantity"]); $produse= $produse . $item["name"] . ", ";
                        endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if($item_total): ?>
        <div class="subtotal">
            <span class="text">SUBTOTAL</span>
            <span class="price">&dollar;<?=$item_total?></span><br>
            <span class="text" style='margin-right: 23px'>SHIPPING</span>
            <span class="price">$10</span><br>
            <span class="text" style='margin-right: 23px'>TOTAL</span>
            <span class="price"><?php echo ($item_total + 10); ?></span>
        </div>
        <div class="buttons">
            <input type="hidden" name="item_total" value="<?php echo $item_total; ?>">
            <input type="hidden" name="produse" value="<?php echo $produse; ?>">
            
            <!-- <input type="submit" value="Update" name="update"> -->
            <input type="submit" value="Place Order" name="placeorder">  
        </div>
        
    </form>
<a href="cos.php?action=empty" style='margin-left:935px '><button class="btn btn-danger">REMOVE ALL</button></a>
<?php endif; ?>
</div>

<?php
    
?>
</div>

<?php 
    template_footer(); 
 ?>
