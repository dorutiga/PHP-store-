<?php 
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "magazin2");

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(!$con) {
	exit("Conncetion failed.");
}
session_start();
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

$item_total = $_POST['item_total'] ?? 0;
if($item_total == 0) {
	header("Location: cos.php");
}
else {
	$transport = 10;
	$total = $item_total + $transport;

	$member_id = $_SESSION['id'];
	$status = "processing";
	$products = $_POST['produse'] ?? "";
	$products = substr($products, 0, -2);

	$sql = "INSERT INTO orders (member_id, order_date, status, products, total) VALUES ('".mysqli_real_escape_string($con, $member_id)."', '".date('Y-m-d H:i:s')."', '".mysqli_real_escape_string($con, $status)."', '".mysqli_real_escape_string($con, $products)."', '".mysqli_real_escape_string($con, $total)."') LIMIT 1";
	$inserare = mysqli_query($con, $sql);
	$id_insert = mysqli_insert_id($con);
	if(!$inserare) {
		echo "Error to register order.";
	}
}



template_header("Order placed");
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                <tr>
                    <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#62c47c">
                        <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                <tr>
                                    <td align="center" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;" class="mobile-center">
                                        <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;">▄︻̷̿┻̿═━一</h1>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                            <tr>
                                <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                                    <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank You <?php echo $_SESSION['name']; ?> For Your Order! </h2>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> We received your order and will begin processing it soon. Your order information appears below. </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 20px;">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> Order Number </td>
                                            <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> <?php echo $id_insert; ?> </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> Purchased Items </td>
                                            <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> <?php echo "$" .$item_total; ?> </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> Shipping + Handling </td>
                                            <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> $10.00 </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 20px;">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> TOTAL </td>
                                            <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"><?php echo "$".$total; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                            <tr>
                                <td align="center" valign="top" style="font-size:0;">
                                    <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                            <tr>
                                                <td align="center" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                    <p style="font-weight: 800;">Estimated Delivery Duration</p>
                                                    <p>5-10 Working Days</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

































<?php template_footer(); ?>