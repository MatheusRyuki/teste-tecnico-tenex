<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });


    $app->post('/carne', function (Request $request, Response $response, array $args) {
        $data = $request->getParsedBody();

        $carne = new \App\Models\Carne(
            $data['valor_total'],
            $data['qtd_parcelas'],
            $data['data_primeiro_vencimento'],
            $data['periodicidade'],
            $data['valor_entrada'] ?? 0
        );
        $response->getBody()->write(json_encode($carne));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/carne/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];
  
        $parcelas = [];
        $response->getBody()->write(json_encode($parcelas));
        return $response->withHeader('Content-Type', 'application/json');
    });
};
