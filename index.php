<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$cart = new Cart(new DBHandler());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST["quantity"])) {
        $product = $cart->get_item_by_code($_POST["quantity"], $_GET["code"]);

        if($_GET["action"] == "add") {
            Cart::add_item_to_cart($product, $_GET["code"]);
        }

        if($_GET["action"] == "remove") {
            Cart::remove_item_from_cart($_GET["code"]);
        }

        if($_GET["action"] == "clear_cart") {
            Cart::clear_all_cart();
        }
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Demo Shopping Cart</title>
    </head>
    <body>
         <!-- Cart -->
         <section>
         <heading>Cart</heading>
         <div class="cart">
             <form action="">
                 <table class="cart">
                     <tbody>
                         <tr>
                             <th>Name</th>
                             <th>Code</th>
                             <th>Quantity</th>
                             <th>Unit Price</th>
                             <th>Price</th>
                             <th>Remove</th>
                         </tr>

                         <tr>
                             <td>Name</td>
                             <tr>Code</tr>
                             <tr>Quantity</tr>
                             <tr>Unit Price</tr>
                             <tr>Total Price</tr>
                             <tr>Remove Icon</tr>
                         </tr>
                     </tbody>
                 </table>
             </form>
         </div>
         </section>

        <!-- Catalog -->
        <section>
            <heading>Product Catalog</heading>
            <div class="grid-container">
                <div class="item">
                    <form method="POST" action="index.php?action=add&code=cKPCh9jT">
                        <h3>product title</h3>
                        <img alt="Product Description A" src=""/>
                    <div class="price">KES 100</div>
                    <input class="product-quantity" name="quantity" type="text" value="1" size="3" />
                    <input class="submit" type="submit" value="Add to Cart"/>
                    </form>
                </div>

                <div class="item">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <h3>product title</h3>
                        <img alt="Product Description" src=""/>
                    <div class="price">KES 100</div>
                    <input class="product-quantity" name="" type="text" value="1" size="3" />
                    <input class="submit" type="submit" value="Add to Cart"/>
                    </form>
                </div>

                <div class="item">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <h3>product title</h3>
                        <img alt="Product Description" src=""/>
                    <div class="price">KES 100</div>
                    <input class="product-quantity" name="" type="text" value="1" size="3" />
                    <input class="submit" type="submit" value="Add to Cart"/>
                    </form>
                </div>

                <div class="item">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <h3>product title</h3>
                        <img alt="Product Description" src=""/>
                    <div class="price">KES 100</div>
                    <input class="product-quantity" name="" type="text" value="1" size="3" />
                    <input class="submit" type="submit" value="Add to Cart"/>
                    </form>
                </div>

                <div class="item">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <h3>product title</h3>
                        <img alt="Product Description" src=""/>
                        <div class="price">KES 100</div>
                        <input class="product-quantity" name="" type="text" value="1" size="3" />
                        <input class="submit" type="submit" value="Add to Cart"/>
                    </form>
                </div>

            </div>
        </section>
    </body>
</html>
