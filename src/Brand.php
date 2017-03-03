<?php
    require_once __DIR__."/../src/Store.php";

    class Brand
    {
        private $brand_name;
        private $id;

        function __construct($brand_name, $id=null)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        function getBrandName(){
    		return $this->brand_name;
    	}

    	function setBrandName($brand_name){
    		$this->brand_name = $brand_name;
    	}

    	function getId(){
    		return $this->id;
    	}

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand)
            {
                $new_brand = new Brand($brand['brand_name'], $brand['id']);
                array_push($brands, $new_brand);
            }
            return $brands;
        }


        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        }

        static function find($id)
        {
            $find_brand = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$id};");
            $found_brand = null;
            foreach($find_brand as $brand)
            {
                $found_brand = new Brand($brand['brand_name'], $brand['id']);
            }
            return $found_brand;
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM
            brands JOIN stores_brands ON (brands.id = stores_brands.brand_id)
            JOIN stores ON (stores_brands.store_id = stores.id)
            WHERE brands.id = {$this->getId()};
            ");
            $stores = [];
            if ($returned_stores == null)
            {
                return null;
            }
            foreach($returned_stores as $store)
            {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }
    }
 ?>
