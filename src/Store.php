<?php
require_once __DIR__."/../src/Brand.php";

    class Store
    {
        private $store_name;
        private $id;

        function __construct($store_name, $id=null)
        {
            $this->store_name = $store_name;
            $this->id = $id;
        }

        function getStoreName(){
    		return $this->store_name;
    	}

    	function setStoreName($store_name){
    		$this->store_name = $store_name;
    	}

    	function getId(){
    		return $this->id;
    	}

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getStoreName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store)
            {
                $new_store = new Store($store['store_name'], $store['id']);
                array_push($stores, $new_store);
            }
            return $stores;
        }


        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        }

        static function find($id)
        {
            $find_store = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$id};");
            $found_store = null;
            foreach($find_store as $store)
            {
                $found_store = new Store($store['store_name'], $store['id']);
            }
            return $found_store;
        }

        function addBrand($brand_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand_id});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM
            stores JOIN stores_brands ON (stores.id = stores_brands.store_id)
            JOIN brands ON (stores_brands.brand_id = brands.id)
            WHERE stores.id = {$this->getId()};
            ");
            $brands = [];
            if ($returned_brands == null)
            {
                return null;
            }
            foreach($returned_brands as $brand)
            {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
    }
 ?>
