<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";


    $app = new Silex\Application();

    $app['debug'] = true;


    $server = 'mysql:host=localhost:3306;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render("index.html.twig", array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/", function() use ($app) {
        $new_store = new Store($_POST['new_store']);
        $new_store->save();
        return $app->redirect('/');
    });

    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands()));
    });

    $app->post("/add/brand/{id}", function($id) use ($app) {
        $new_brand = new Brand($_POST['new_brand']);
        $new_brand->save();
        $store = Store::find($id);
        $brand_id = $new_brand->getId();
        $store->addBrand($brand_id);
        return $app->redirect('/store/' . $id);
    });

    $app->patch("/patch/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->updateStoreName($_POST['new_store_name']);
        return $app->redirect('/store/' . $id);
    });

    $app->delete("/delete/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app->redirect('/');
    });

    return $app;
 ?>
