# Flog Generator for Laravel

Flog is a Laravel package that provides an interface to generate fake logs. This package is a wrapper around the `flog` binary created by [mingrammer/flog](https://github.com/mingrammer/flog).

## Installation

Install the package using Composer:

```bash
composer require perfocard/flog
```

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Perfocard\Flog\FlogServiceProvider"
```

## Configuration

After publishing, the configuration file `config/flog.php` will be available. You can specify the binary path and platform-specific binary paths here:

```php
return [
    'platform' => 'linux-arm64', // Default platform
    'binary_path' => 'vendor/perfocard/flog/bin/{platform}/flog',
];
```

Update the `platform` value to match your system's architecture.

## Usage

### Generate a single log

```php
use Perfocard\Flog\Generator;

$log = Generator::generateOne();
```

### Generate multiple logs

```php
use Perfocard\Flog\Generator;

$logs = Generator::generate(10);
```

You can also specify a custom format:

```php
$log = Generator::generateOne('apache_common');
```

## Testing

To test this package, ensure that the `tests` directory is registered in the PHPUnit configuration file of your main project.

Add the following to the `phpunit.xml` file in your Laravel project:

```xml
<testsuites>
    <testsuite name="Perfocard/Flog Tests">
        <directory>vendor/perfocard/flog/tests</directory>
    </testsuite>
</testsuites>
```

Run the tests:

```bash
php artisan test
```

## Contributing

Contributions are welcome! Feel free to submit a pull request or open an issue.

## License

This package is open-source software licensed under the [MIT license](LICENSE).
