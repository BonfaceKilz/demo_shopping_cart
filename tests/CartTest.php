<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CartTest extends TestCase
{
    public function testCanGetItemByCode()
    {
        $mocked_data[0] = array(
            "id" => 1,
            "product_name" => "Product A",
            "code" => "60iziBo0",
            "quantity" => 1,
            "description" => "Description A",
            "price" => 100,
            "image" => 'dummy_url'
        );
        $stub = $this->createStub(DBHandler::class);
        $stub->method('executeQuery')
             ->willReturn($mocked_data);
        $cart = new Cart($stub);
        echo "test";
        echo $cart->getItemByCode(1, "60iziBo0");
        $this->assertEquals($cart->getItemByCode(1, "60iziBo0"),
                            array( "60iziBo0" => array(
                                'name' => "Product A",
                                'code' => "60iziBo0",
                                'quantity' => 1,
                                'description' => "Description A",
                                'price' => 100,
                                'image' => "dummy_url")));
    }
}
