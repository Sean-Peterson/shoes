<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

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

    function test_getters()
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

    function test_save_getAll()
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

    function test_delete()
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
    function test_find()
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


}
?>
