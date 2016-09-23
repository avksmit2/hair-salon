<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttrivutes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function testSave()
        {
            $name = "Flo";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name = "Barb";
            $phone = "423-443-1234";
            $last_visit = "2016-07-01";
            $notes = "Beaverton";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
            $test_client->save();

            $result = Client::getAll();
            $this->assertEquals($test_client, $result[0]);
        }

        function testGetAll()
        {
            $name = "Flo";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name = "Barb";
            $phone = "423-443-1234";
            $last_visit = "2016-07-01";
            $notes = "Beaverton";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
            $test_client->save();

            $name = "Sandy";
            $phone = "522-443-1234";
            $last_visit = "2016-05-01";
            $notes = "Northside";
            $stylist_id = $test_stylist->getId();
            $test_client2 = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function testDeleteAll()
        {
            $name = "Flo";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name = "Lisa Smith";
            $phone = "555-555-5555";
            $last_visit = "2016-05-01";
            $notes = "doesn't like hair to be styled";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
            $test_client->save();

            $name2 = "Veronica Mars";
            $phone = "555-555-5555";
            $last_visit = "2016-07-01";
            $notes = "none";
            $test_client2 = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
            $test_client2->save();

            Client::deleteAll();
            $result = Client::getAll();

            $this->assertEquals([], $result);
        }

        function testGetId()
        {
            $name = "Flo";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name = "Lisa Smith";
            $phone = "555-555-5555";
            $last_visit = "2016-07-01";
            $notes = "none";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
            $test_client->save();

            $result = $test_client->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function testGetStylistId()
        {
            $name = "Flo";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name = "Lisa Smith";
            $phone = "555-555-5555";
            $last_visit = "2016-07-01";
            $notes = "none";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
            $test_client->save();

            $result = $test_client->getStylistId();

            $this->assertEquals(true, is_numeric($result));
        }
    }
?>
