[![License](https://img.shields.io/github/license/imponeer/queue-interop-connection-factory-helper.svg?maxAge=2592000)](LICENSE) [![GitHub release](https://img.shields.io/github/release/imponeer/queue-interop-connection-factory-helper.svg)](https://github.com/imponeer/queue-interop-connection-factory-helper/releases) [![Packagist](https://img.shields.io/packagist/dm/imponeer/queue-interop-connection-factory-helper.svg)](https://packagist.org/packages/imponeer/queue-interop-connection-factory-helper)

# Queue-Interop Connection Factory Helper

A PHP library that simplifies creating [queue-interop](https://github.com/queue-interop/queue-interop) connection factories from DSN (Data Source Name) strings. This helper allows you to easily configure and instantiate queue connections for various message queue systems using a unified DSN format.

## Installation

`composer require imponeer/queue-interop-connection-factory-helper`

## Supported Queue Transports

To use a specific transport, you must also include the corresponding library in your project:

| Transport | Prefix | Library |
|----------|---------|---------|
| [AMQP](https://www.amqp.org)     | amqp | [enqueue/amqp-ext](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/amqp.md) <br> [enqueue/amqp-lib](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/amqp_lib.md) <br > [enqueue/amqp-bunny](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/amqp_bunny.md) |
| [Beanstalk](https://beanstalkd.github.io) | beanstalk | [enqueue/pheanstalk](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/pheanstalk.md) |
| [Stomp](https://stomp.github.io) | stomp | [enqueue/stomp](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/stomp.md) |
| [Amazon Simple Queue Service (SQS)](https://aws.amazon.com/sqs/) | sqs | [enqueue/sqs](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/sqs.md) |
| [Google PubSub](https://cloud.google.com/pubsub/docs/overview) | gps | [enqueue/gps](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/gps.md) |
| [Apache Kafka](https://kafka.apache.org) | kafka | [enqueue/rdkafka](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/kafka.md) |
| [Redis](https://redis.io) | redis | [enqueue/redis](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/redis.md) |
| [MongoDB](https://www.mongodb.com) | mongodb | [enqueue/mongodb](https://github.com/php-enqueue/enqueue-dev/blob/master/docs/transport/mongodb.md) |
| [Gearman](http://gearman.org) | gearman |  [enqueue/gearman](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/gearman.md) |
| [MySQL](https://www.mysql.com) | mysql | [enqueue/dbal](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/dbal.md) |
| File | file | [enqueue/fs](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/filesystem.md) |
| Null | null | [enqueue/null](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/null.md) |
| [Wamp](https://wamp-proto.org) | wamp<br>ws | [enqueue/wamp](https://github.com/php-enqueue/enqueue-dev/tree/master/docs/transport/wamp.md) |

## Usage

```php
use Imponeer\QueueInteropConnectionFactoryHelper;

$context = QueueInteropConnectionFactoryHelper::createContext('file:');
```

## Development

This project includes several development tools to maintain code quality:

Run tests with testdox output:
```bash
composer test
```

Check code style (PSR-12):
```bash
composer phpcs
```

Fix code style issues automatically:
```bash
composer phpcbf
```

Run static analysis:
```bash
composer phpstan
```

## API Documentation

[Full API documentation](https://github.com/imponeer/queue-interop-connection-factory-helper/wiki) is available in the repository wiki. Documentation is automatically updated with every release.

## How to Contribute

Contributions are welcome! To contribute:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run the development tools to ensure code quality
5. Submit a pull request

For bug reports or questions, please use the [issues tab](https://github.com/imponeer/queue-interop-connection-factory-helper/issues).
