<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylist", function() use ($app) {
        $stylist = new Stylist($_POST['name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        Client::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('edit_stylists.html.twig', array('stylist' => $stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $stylist = Stylist::find($id);
        $stylist->update($name);
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete($id);
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/clients/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/clients/{id}/add", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('add_clients.html.twig', array('stylist' => $stylist));
    });

    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('edit_clients.html.twig', array('client' => $client));
    });

    $app->post("/clients", function() use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $last_visit = $_POST['last_visit'];
        $notes = $_POST['notes'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($name, $phone, $last_visit, $notes, $stylist_id, $id=null);
        $client->save();

        $stylist=Stylist::find($stylist_id);
        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->patch("/clients/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $last_visit = $_POST['last_visit'];
        $notes = $_POST['notes'];
        $client = Client::find($id);
        $client->update($name, $phone, $last_visit, $notes);
        $stylist = Stylist::find($_POST['stylist_id']);
        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/clients/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        Client::delete($id);
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    return $app;
?>
