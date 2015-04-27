<?php

namespace Aws\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class AwsServiceProvider implements ServiceProviderInterface
{
    const AWS = 'aws';
    const AWS_CONNECTIONS = 'aws.connections';
    const AWS_FACTORY = 'aws.factory';

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app[self::AWS_CONNECTIONS] = array(
            'default' => array(
                'key'    => '',
                'secret' => '',
                'region' => 'us-east-1',
            )
        );

        $app[self::AWS_FACTORY] = $app->protect(function ($key = '', $secret = '', $region = 'us-east-1') use ($app) {
            return $app[AwsServiceProvider::AWS]->createConnection($key, $secret, $region);
        });

        $app[self::AWS] = $app->share(function () use ($app) {
            return new AwsConnectionProvider($app[AwsServiceProvider::AWS_CONNECTIONS]);
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registers
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {}
}
