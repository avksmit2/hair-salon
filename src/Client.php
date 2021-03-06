<?php
class Client
{
    private $name;
    private $phone;
    private $last_visit;
    private $notes;
    private $stylist_id;
    private $id;

    function __construct($name, $phone, $last_visit, $notes, $stylist_id, $id=null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->last_visit = $last_visit;
        $this->notes = $notes;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

    function setName($new_name)
    {
        $this->name = (string)$new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function setPhone($new_phone)
    {
        $this->phone = $new_phone;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function setLastVisit($new_last_visit)
    {
        $this->last_visit = $new_last_visit;
    }

    function getLastVisit()
    {
        return $this->last_visit;
    }

    function setNotes($new_notes)
    {
        $this->notes = (string)$new_notes;
    }

    function getNotes()
    {
        return $this->notes;
    }

    function getId()
    {
        return $this->id;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO clients (name, phone, last_visit, notes, stylist_id) VALUES ('{$this->getName()}', '{$this->getPhone()}', '{$this->getLastVisit()}', '{$this->getNotes()}', '{$this->getStylistId()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    function update($new_name, $new_phone, $new_last_visit, $new_notes)
    {
        $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}', phone = '{$new_phone}', last_visit = '{$new_last_visit}', notes = '{$new_notes}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
        $this->setPhone($new_phone);
        $this->setLastVisit($new_last_visit);
        $this->setNotes($new_notes);
    }

    static function getAll()
    {
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
        $clients = array();
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

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM clients;");
    }

    static function find($search_id)
    {
        $found_client = null;
        $clients = Client::getAll();
        foreach($clients as $client) {
            $id = $client->getId();
            if ($id == $search_id)
            {
                $found_client = $client;
            }
        }
        return $found_client;
    }

    static function delete($stylist_id)
    {
        $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$stylist_id};");
    }
}
?>
