<?php

$router->get('/api/healthCheck', 'HealthcheckController@healthcheck');

$router->get('/api/exchange/info', 'ExchangeController@info');
$router->get('/api/exchange/{amount}/{from}/{to}', 'ExchangeController@convert');
$router->get('/api/cache/clear', 'CacheController@clear');
