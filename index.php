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
        <section>
            <heading>Cart</heading>
            <a id="btnEmpty" href="index.php?action=clear_cart">Clear Cart</a>
            <div class="cart">
                <?php
                if(isset($_SESSION["cart_item"])){
                    $total_quantity = 0;
                    $total_price = 0;
                ?>
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>

                            <?php
                            foreach ($_SESSION["cart_item"] as $item){
                                $price = $item["quantity"] * $item["price"];
                            ?>
                                <tr>
                                    <td><img alt="<?php 'assets/img/' . $item['name'] ?>" src="<?php 'assets/img/' . $item['image'] ?>"/></td>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo $item["quantity"]; ?></td>
                                    <td><?php echo "KES" . $item["price"]; ?></td>
                                    <td><?php echo "KES" . $price; ?></td>
                                    <td><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                                </tr>
                                <?php
			        $total_quantity += $item["quantity"];
			        $total_price += ($item["price"] * $item["quantity"]);
		                }
		                ?>

                                <tr>
                                    <td>Total Price: <?php echo "KES" . $total_price; ?></td>
                                </tr>

                        </tbody>
                    </table>
                            <?php
                            } else {
                            ?>
                                <div>Empty Cart</div>
                            <?php
                            }
                            ?>
            </div>
        </section>

        <!-- Catalog -->
        <section>
            <heading>Product Catalog</heading>
            <div class="grid-container">
                <?php
	        $all_products = $db_handle->executeQuery("SELECT * FROM products ORDER BY id DESC");
		foreach($all_products as $key => $value){
	        ?>
                    <div>
                        <form method="POST" action="index.php?action=add&code=<?php echo $all_products[$key]["code"]; ?>">
                            <h3><?php echo $product_array[$key]["product_name"]; ?></h3>
                            <div><?php echo $product_array[$key]["product_description"]; ?></div>
                            <img alt="Product Description A" src="assets/img/<?php echo $product_array[$key]["image"]; ?>"/>
                            <div class="price">KES <?php echo $product_array[$key]["price"]; ?></div>
                            <input class="product-quantity" name="quantity" type="text" value="1" size="3" />
                            <input class="submit" type="submit" value="Add to Cart"/>
                        </form>
                    </div>

	        <?php
		}
	        ?>
            </div>
        </section>
    </body>
</html>
