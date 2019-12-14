<?php
session_start();
$total_quantity = 0;
$total_price = 0;
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Demo Checkout Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/assets/css/min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
    </head>
    <body>
        <!-- Cart -->
        <section id="cart">
            <heading><h3 class="title">Cart- Check Out</h3></heading>
            <div>
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
                                    <td><img alt="<?php echo 'assets/img/' . $item['name'] ?>" src="<?php echo 'assets/img/' . $item['image'] ?>"/></td>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo $item["quantity"]; ?></td>
                                    <td><?php echo "KES " . $item["price"]; ?></td>
                                    <td><?php echo "KES " . $price; ?></td>
                                </tr>
                                <?php
                                $total_quantity += $item["quantity"];
                                $total_price += ($item["price"] * $item["quantity"]);
                                }
                                ?>

                                <tr>
                                    <td colspan="5"><b>Total Price: <?php echo "KES " . $total_price; ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="5"><a href="#" class="btn btn-b btn-sm smooth">Buy Products <br/> (Lipa Na M-Pesa)</a></td>
                                </tr>

                        </tbody>
                    </table>
            </div>
        </section>

    </body>
</html>
