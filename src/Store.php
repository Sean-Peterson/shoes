<?php
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
    }
 ?>
