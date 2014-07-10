# silex-aws-provider

[AWS](https://github.com/aws/aws-sdk-php) service provider for the [Silex](http://silex.sensiolabs.org/) framework.

## Install via composer

Add in your ```composer.json``` the require entry for this library.
```json
{
    "require": {
        "ebichan/silex-aws-provider": "dev-master"
    }
}
```
and run ```composer install``` (or ```update```) to download all files.

## Usage

### Service registration
```php
$app->register(new AmqpServiceProvider, array(
    'aws.connections' => array(
        'default' => array(
            'key'    => '',
            'secret' => '',
            'region' => 'us-east-1'
        )
    ),
));
```

###  Connections retrieving
```php
$connections = $app['aws'];
$defaultConnection = $connections['default']; 
```

###  Creating aws connection via factory
```php
$awsFactory = $app['aws.factory'];
$customConnection = $awsFactory('', '', 'us-east-1');
```
