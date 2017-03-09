<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Brand.php";
require_once "src/Store.php";

$server = 'mysql:host=localhost:3306;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Store::deleteAll();
    }

    function testGetters()
    {
        // Arrange
        $store_name = 'payless';
        $test_store = new Store($store_name);
        // Act
        $result = $test_store->getStoreName();
        $expected_result = 'payless';
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function testSaveGetAll()
    {
        // Arrange
        $store_name = 'payless';
        $test_store = new Store($store_name);
        $test_store->save();

        $store_name2 = 'shoe palace';
        $test_store2 = new Store($store_name);
        $test_store2->save();
        // Act
        $result = Store::getAll();
        $expected_result = array($result[0], $result[1]);
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function testDelete()
    {
        // Arrange
        $store_name = 'payless';
        $test_store = new Store($store_name);
        $test_store->save();
        //ACT
        $test_store->delete();
        $result = Store::getAll();
        $expected_result = [];
        //Assert
        $this->assertEquals($result, $expected_result);
    }

    function testFind()
    {
        // Arrange
        $store_name = 'payless';
        $id1 = 1;
        $test_store = new Store($store_name);
        $test_store->save();

        $store_name2 = 'shoe palace';
        $id2 = 2;
        $test_store2 = new Store($store_name);
        $test_store2->save();
        // Act
        $result = Store::find($test_store->getId());
        $expected_result = $test_store;
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function testUpdateStoreName()
    {
        // Arrange
        $store_name = 'payless';
        $id1 = 1;
        $test_store = new Store($store_name);
        $test_store->save();

        $store_name2 = 'shoe palace';
        $id2 = 2;
        $test_store2 = new Store($store_name);
        $test_store2->save();
        // Act
        $test_store->updateStoreName('Frederick');
        $result = $test_store->getStoreName();
        $expected_result = 'Frederick';
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function testAddBrandGetBrands()
    {
        // Arrange
        $brand_name = 'starburry';
        $test_brand = new Brand($brand_name);
        $test_brand->save();

        $brand_name2 = 'shaq';
        $test_brand2 = new Brand($brand_name);
        $test_brand2->save();

        $store_name = 'payless';
        $test_store = new Store($store_name);
        $test_store->save();

        $store_name2 = 'shoe palace';
        $test_store2 = new Store($store_name);
        $test_store2->save();

        $test_store->addBrand($test_brand->getId());
        $test_store->addBrand($test_brand2->getId());
        $test_store2->addBrand($test_brand->getId());
        $test_store2->addBrand($test_brand2->getId());

        // Act
        $result = $test_store->getBrands();
        $expected_result = [$test_brand, $test_brand2];
        // Assert
        $this->assertEquals($result, $expected_result);
    }


}
?>
