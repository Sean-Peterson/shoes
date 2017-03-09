<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Store.php";
require_once "src/Brand.php";

$server = 'mysql:host=localhost:3306;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class BrandTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Brand::deleteAll();
    }


    function testGetters()
    {
        // Arrange
        $brand_name = 'starburry';
        $test_brand = new Brand($brand_name);
        // Act
        $result = $test_brand->getBrandName();
        $expected_result = 'starburry';
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function testSaveGetAll()
    {
        // Arrange
        $brand_name = 'starburry';
        $test_brand = new Brand($brand_name);
        $test_brand->save();

        $brand_name2 = 'shaq';
        $test_brand2 = new Brand($brand_name);
        $test_brand2->save();
        // Act
        $result = Brand::getAll();
        $expected_result = array($result[0], $result[1]);
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function testDelete()
    {
        // Arrange
        $brand_name = 'starburry';
        $test_brand = new Brand($brand_name);
        $test_brand->save();
        //ACT
        $test_brand->delete();
        $result = Brand::getAll();
        $expected_result = [];
        //Assert
        $this->assertEquals($result, $expected_result);
    }

    function testFind()
    {
        // Arrange
        $brand_name = 'starburry';
        $id1 = 1;
        $test_brand = new Brand($brand_name);
        $test_brand->save();

        $brand_name2 = 'shaq';
        $id2 = 2;
        $test_brand2 = new Brand($brand_name);
        $test_brand2->save();
        // Act
        $result = Brand::find($test_brand->getId());
        $expected_result = $test_brand;
        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function testGetStores()
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
        $result = $test_brand->getStores();
        $expected_result = [$test_store, $test_store2];
        // Assert
        $this->assertEquals($result, $expected_result);
    }



}
?>
