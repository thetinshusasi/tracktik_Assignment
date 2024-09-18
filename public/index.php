<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\EmployeeController;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$request = Request::createFromGlobals();

$routes = new RouteCollection();
$routes->add('new-employee', new Route('/employee', [
    '_controller' => [new EmployeeController(), 'createCustomer']
], [], [], '', [], ['POST']));

$routes->add('patch-employee', new Route('/employee/{employee_id}', [
    '_controller' => [new EmployeeController(), 'updateCustomer']
], [
    'employee_id' => '\d+'
], [], '', [], ['PATCH']));

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());

    $response = call_user_func_array($parameters['_controller'], [$request, $parameters['employee_id'] ?? null]);
} catch (\Exception $e) {
    $response = new Response('Not Found', 404);
}

$response->send();