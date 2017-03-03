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
        $expected_result = array($test_store, $test_store2);
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


}
?>
