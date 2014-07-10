<?php

namespace Aws\Silex\Provider;

use Aws\Common\Aws;

class AwsConnectionProvider extends \Pimple
{
    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $provider = $this;
        foreach ($options as $key => $connection) {
            $this['default'] = $this->share(function () use ($connection, $provider) {
                return $provider->createConnection($connection['key'], $connection['secret'], $connection['region']);
            });
        }
    }

    /**
     * @param  string         $key
     * @param  string         $secret
     * @param  string         $region
     * @return \AWSConnection
     */
    public function createConnection($key = '', $secret = '', $region = 'us-east-1')
    {
        return Aws::factory(array(
            'key' => $key,
            'secret'  => $secret,
            'region' => $region
        ));
    }
}
