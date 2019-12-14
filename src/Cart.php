<?php declare(strict_types=1);
/**
 * PHP Version 7.2
 *
 * Cart: A demo PHP Cart display for HomeChow company
 *
 * Copyright (c) 2019 Bonface K. M.
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  Demo
 * @package   None
 * @author    Bonface K. M. <bonfacemunyoki@gmail.com>
 * @copyright 2019 Bonface K. M. <bonfacemunyoki@gmail.com>
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      None
 */



/**
 * Simple Cart Class:
 *
 * You can use this to get items from the db by their code
 * and also to manage sessions
 *
 * @category  Demo
 * @package   None
 * @author    Bonface K. M. <bonfacemunyoki@gmail.com>
 * @copyright 2019 Bonface K. M. <bonfacemunyoki@gmail.com>
 * @license   Bonface K. M. <bonfacemunyoki@gmail.com>
 * @link      None
 */
class Cart
{

    /**
     * Inject class with a db handler.
     *
     * @param $db_handler The injected database handler
     *                    used to execute queries
     */
    public function __construct($db_handler)
    {
        $this->db_handler = $db_handler;
    }

    /**
     * Get an item from the db.
     *
     * @param int    $quantity The total number of items from the $_POST
     *                         request
     * @param string $code     The value of the code passed in the url
     *
     * @return array
     */
    public function getItemByCode($quantity, $code)
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

    /**
     * Add Items to the global session
     *
     * @param array  $product The product and it's details
     * @param string $code    The value of code passed in the url
     *
     * @return Null
     */
    public static function addItemToCart($product, $code)
    {
        if (!empty($_SESSION["cart_item"])) {
            if (in_array($code, array_keys($_SESSION["cart_item"]))) {
                foreach ($_SESSION["cart_item"] as $key => $value) {
                    if ($product["code"] == $key
                        && empty($_SESSION["cart_items"][$key]["quantity"])
                    ) {
                        $_SESSION["cart_item"][$key]["quantity"] = 0;
                    } else {
                        $_SESSION["cart_item"][$key]["quantity"]
                            += $_POST["quantity"];
                    }
                }
            } else {
                $_SESSION["cart_item"]
                    = array_merge($_SESSION["cart_item"], $product);
            }
        } else {
            $_SESSION["cart_item"] = $product;
        }
    }

    /**
     * Remove Items from the global session
     *
     * @param string $code The value of code passed in the url
     *
     * @return Null
     */
    public static function removeItemFromCart($code)
    {
        if (!empty($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $key => $value) {
                if ($code == $key) {
                    unset($_SESSION["cart_item"][$key]);
                }
                if (empty($_SESSION["cart_item"])) {
                    unset($_SESSION["cart_item"]);
                }
            }
        }
    }

    /**
     * Remove everything from the global session
     *
     * @return Null
     */
    public static function clearAllCart()
    {
        unset($_SESSION["cart_item"]);
    }
}
