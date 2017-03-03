<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

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

    function test_save_getAll()
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

    function test_delete()
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
    function test_find()
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


}
?>
