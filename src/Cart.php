<?php
declare(strict_types=1);

class Cart
{
    public function __construct($db_handler)
    {
        $this->db_handler = $db_handler;
    }

    public function get_item_by_code($quantity, $code)
    {
        $product = $this->db_handler->executeQuery(
            "SELECT * FROM products where code = '" . $code . "'"
        )[0];

        return array(
            $product["code"] => array('name' => $product["product_name"],
                                      'code' => $product["code"],
                                      'quantity' => $quantity,
                                      'description' => $product["description"],
                                      'price' => $product["price"],
                                      'image' => $product["image"])
        );
    }

    public static function add_item_to_cart($product, $code)
    {
        if(!empty($_SESSION["cart_item"])) {
            if(in_array($code, array_keys($_SESSION["cart_item"]))) {
                foreach($_SESSION["cart_item"] as $key => $value) {
                    if($product["code"] == $key &&
                       empty($_SESSION["cart_items"][$key]["quantity"])) {
                        $_SESSION["cart_item"][$key]["quantity"] = 0;
                    }
                    else {
                        $_SESSION["cart_item"][$key]["quantity"] += $_POST["quantity"];
                    }
                }
            }  else {
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $product);
            }
        } else {
            $_SESSION["cart_item"] = $product;
        }
    }

    public static function remove_item_from_cart($code)
    {
        if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $key => $value) {
                if($code == $key)
                    unset($_SESSION["cart_item"][$key]);
                if(empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
			}
		}
    }

    public static function clear_all_cart()
    {
        unset($_SESSION["cart_item"]);
    }
}
