<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$db_handle = new DBHandler();
$cart = new Cart($db_handle);


if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    !empty($_POST["quantity"])) {
    $product = $cart->get_item_by_code($_POST["quantity"], $_GET["code"]);

    if($_GET["action"] == "add") {
        Cart::add_item_to_cart($product, $_GET["code"]);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if($_GET["action"] == "remove") {
        Cart::remove_item_from_cart($_GET["code"]);
    }

    if($_GET["action"] == "clear_cart") {
        Cart::clear_all_cart();
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
        <section id="cart">
            <heading><h3 class="title">Cart</h3></heading>

            <div>
                <?php
                if(isset($_SESSION["cart_item"])){
                    $total_quantity = 0;
                    $total_price = 0;
                ?>
                    <table>
                        <tbody>
                            <tr>
                                <th colspan="2">Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Price</th>
                            </tr>

                            <?php
                            foreach ($_SESSION["cart_item"] as $item){
                                $price = $item["quantity"] * $item["price"];
                            ?>
                                <tr>
                                    <td><img alt="<?php echo "assets/img/" . $item['name'] ?>" src="<?php echo "assets/img/" . $item["image"] ?>"/></td>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo $item["quantity"]; ?></td>
                                    <td><?php echo "KES " . $item["price"]; ?></td>
                                    <td><?php echo "KES " . $price; ?></td>
                                    <td><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                                </tr>
                                <?php
			        $total_quantity += $item["quantity"];
			        $total_price += ($item["price"] * $item["quantity"]);
		                }
		                ?>
                                <tr>
                                    <td colspan="2">Total Price: <?php echo "KES" . $total_price; ?></td>
                                    <td colspan="2"><a href="checkout.php" class="btn-sm btn btn-b">Proceed to checkout</a></td>
                                    <td colspan="2"><a class="btn-sm btn btn-c" href="index.php?action=clear_cart">Clear Cart</a></td>
                                </tr>
                                <tr>
                                </tr>

                        </tbody>
                    </table>
                            <?php
                            } else {
                            ?>
                                <article>Your Cart is Empty :(</article>
                            <?php
                            }
                            ?>
            </div>
        </section>

        <!-- Catalog -->
        <section id="catalog">
            <heading><h3 class ="title">Product Catalog</h3></heading>
            <div class="grid-container">
                <?php
	        $all_products = $db_handle->executeQuery("SELECT * FROM products ORDER BY id DESC");
		foreach($all_products as $key => $value){
	        ?>
                    <div>
                        <form method="POST" action="index.php?action=add&code=<?php echo $all_products[$key]["code"]; ?>">
                            <h3><?php echo $all_products[$key]["product_name"]; ?></h3>
                            <div><?php echo $all_products[$key]["product_description"]; ?></div>
                            <img alt="Product Description" src="assets/img/<?php echo $all_products[$key]["image"]; ?>"/>
                            <input name="quantity" type="number" value="1" size="3" />
                            <input class="btn-sm btn btn-a" type="submit" value="Add to Cart (KES <?php echo $all_products[$key]["price"]; ?>)"/>
                        </form>
                    </div>

	        <?php
		}
	        ?>
            </div>
        </section>
    </body>
</html>
