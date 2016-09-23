<?php
    class Stylist
    {
      private $name;
      private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = ucwords((string)$new_name);
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()} ORDER BY last_visit;");
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $phone = $client['phone'];
                $last_visit = $client['last_visit'];
                $notes = $client['notes'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        function delete($stylist_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$stylist_id};");
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$stylist_id};");
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist) {
                $name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist) {
                $id = $stylist->getId();
                if ($id == $search_id)
                {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }
    }
?>
