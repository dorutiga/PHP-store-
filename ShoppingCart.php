<?php
    require_once "DBController.php";
    class ShoppingCart extends DBController {
        function getAllProduct() {
            $query = "SELECT * FROM tbl_product";
            $productResult = $this->getDBResult($query);
            return $productResult;
        }
        function getMemberCartItem($member_id) {
            $query = "SELECT tbl_product.*, tbl_cart.id as cart_id,tbl_cart.quantity FROM tbl_product, tbl_cart WHERE
 tbl_product.id = tbl_cart.product_id AND tbl_cart.member_id = ?";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $member_id
                )
            );

            $cartResult = $this->getDBResult($query, $params);
            return $cartResult;
        }
        function getProductByCode($product_code) {
            $query = "SELECT * FROM tbl_product WHERE code=?";
            $params = array(
                array(
                    "param_type" => "s",
                    "param_value" => $product_code
                )
            );
            $productResult = $this->getDBResult($query, $params);
            return $productResult;
        }
        function getCartItemByProduct($product_id, $member_id) {
            $query = "SELECT * FROM tbl_cart WHERE product_id = ? AND member_id = ?";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $product_id
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $member_id
                )
            );
            $cartResult = $this->getDBResult($query, $params);
            return $cartResult;
        }
        function addToCart($product_id, $quantity, $member_id) {
            $query = "INSERT INTO tbl_cart (product_id,quantity,member_id) VALUES (?, ?, ?)";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $product_id
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $quantity
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $member_id
                )
            );
            $this->updateDB($query, $params);
        }
        function updateCartQuantity($quantity, $cart_id) {
            $query = "UPDATE tbl_cart SET quantity = ? WHERE id= ?";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $quantity
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $cart_id
                )
            );
            $this->updateDB($query, $params);
        }
        function deleteCartItem($cart_id) {
            $query = "DELETE FROM tbl_cart WHERE id = ?";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $cart_id
                )
            );

            $this->updateDB($query, $params);
        }
        function emptyCart($member_id) {
            $query = "DELETE FROM tbl_cart WHERE member_id = ?";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $member_id
                )
            );
            $this->updateDB($query, $params);
        }
}

// Template
    function template_header($title) {
        echo <<<EOT
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="utf-8">
        <title>$title</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        </head>
        <body>
        <header>
        <div class="content-wrapper">
        <h1 style='font-weight:bold;'>▄︻̷̿┻̿═━一</h1>
        <nav>
        <a href="magazin.php" style='text-decoration: none;'>Products</a>
        <a href="account.php" style='text-decoration: none; margin-right:500px;'>Account</a>
        </nav>
        <div class="link-icons">
        <a href="cos.php">
        CART
        <i class="fas fa-shopping-cart"></i>
        </a>
        <a href='logout.php'><button type="button" class="btn btn-outline-danger" style='margin-left:30px;'>LOGOUT</button></a>
        </div>
        </div>
        </header>
        <main>
        EOT;
    }

    // Template footer
    function template_footer() {
        $year = date('Y');
        echo <<<EOT
        </main>
        <footer>
        <div class="content-wrapper">
        <p>&copy; $year, Best Romanian Retailer.</p>
        </div>
        </footer>
        </body>
        </html>
        EOT;
    }