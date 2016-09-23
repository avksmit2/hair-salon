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

            $name = "Lisa Smith";
            $phone = "555-555-5555";
            $last_visit = "2016-05-01";
            $notes = "doesn't like hair to be styled";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id);
            $test_client->save();

            $result = Client::getAll();

            $this->assertEquals($test_client, $result[0]);
        }
    }
?>
