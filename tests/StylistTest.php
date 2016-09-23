<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttrivutes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            // Stylist::deleteAll();
        }

        function test_stylistName()
        {
            $name = "Betty";
            $test_stylist = new Stylist($name);

            $result = $test_stylist->getName();

            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            $name = "Betty";
            $id = 1;
            $test_stylist = new Stylist($name, $id);

            $result = $test_stylist->getId();

            $this->assertEquals(true, is_numeric($result));
        }
    }



?>
