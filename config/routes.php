<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    // Use dashed URLs like /api/my-resource-name
    $routes->setRouteClass(DashedRoute::class);

    // Define API routes with JSON extension support
    $routes->scope('/api', function (RouteBuilder $builder): void {
        // Enable .json extension for API responses
        $builder->setExtensions(['json']);

        // RESTful routes for Authors
        $builder->resources('Authors', [
            'map' => [
                // Optional: Add custom endpoints like /api/authors/search
                'search' => ['action' => 'search', 'method' => 'GET']
            ]
        ]);

        // RESTful routes for Books
        $builder->resources('Books');

        // Fallbacks for unmatched API routes
        $builder->fallbacks();
    });

    // Web routes (non-API)
    $routes->scope('/', function (RouteBuilder $builder): void {
        // You can define HTML routes here if needed
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
        $builder->fallbacks();
    });
};
