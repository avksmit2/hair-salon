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

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function testStylistName()
        {
            $name = "Betty";
            $test_stylist = new Stylist($name);

            $result = $test_stylist->getName();

            $this->assertEquals($name, $result);
        }

        function testGetId()
        {
            $name = "Betty";
            $id = 1;
            $test_stylist = new Stylist($name, $id);

            $result = $test_stylist->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            $name = "Betty";
            // $id = null;
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $result = Stylist::getAll();

            $this->assertEquals($test_stylist, $result[0]);
        }

        function testGetAll()
        {
            $name = "Betty";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $name2 = "Flo";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function testDeleteAll()
        {
            $name = "Betty";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $name2 = "Flo";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            Stylist::deleteAll();
            $result = Stylist::getAll();

            $this->assertEquals([], $result);
        }

        function testFind()
        {
            $name = "Betty";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $name2 = "Flo";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            $result = Stylist::find($test_stylist->getId());

            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            $name = "Betty";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $new_name = "Elizabeth";

            $test_stylist->update($new_name);

            $this->assertEquals("Elizabeth", $test_stylist->getName());
        }
    }



?>
