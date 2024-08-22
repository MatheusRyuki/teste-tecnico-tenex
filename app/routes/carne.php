<?php
declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as RouteCollectorProxy;
use App\Application\Actions\Carne\CreateCarneAction;
use App\Application\Actions\Carne\ViewCarneAction;

return function (RouteCollectorProxy $group) {
    $group->post('', CreateCarneAction::class);
    $group->get('/{id}', ViewCarneAction::class);
};
