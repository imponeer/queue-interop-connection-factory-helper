[![License](https://img.shields.io/github/license/imponeer/queue-interop-connection-factory-helper.svg?maxAge=2592000)](LICENSE) [![GitHub release](https://img.shields.io/github/release/imponeer/queue-interop-connection-factory-helper.svg)](https://github.com/imponeer/queue-interop-connection-factory-helper/releases) [![Packagist](https://img.shields.io/packagist/dm/imponeer/queue-interop-connection-factory-helper.svg)](https://packagist.org/packages/imponeer/queue-interop-connection-factory-helper) [![Build Status](https://travis-ci.com/imponeer/queue-interop-connection-factory-helper.svg?branch=master)](https://travis-ci.com/imponeer/queue-interop-connection-factory-helper)

# Queue-Interop Connection Factory Helper

Helper that creates [queue-interop](https://github.com/queue-interop/queue-interop) connection factory from DSN string.

## Instalation

`composer require imponeer/queue-interop-connection-factory-helper`

## Supported queue-interop libraries

If you want to use specific transport you must also include related library in your project

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

## Example

```php
use Imponeer\QueueInteropConnectionFactoryHelper;

$context = QueueInteropConnectionFactoryHelper::createContext('file:');
```

## How to contribute?

If you want to add some functionality or fix bugs, you can fork, change and create pull request. If you not sure how this works, try [interactive GitHub tutorial](https://skills.github.com).

If you found any bug or have some questions, use [issues tab](https://github.com/imponeer/queue-interop-connection-factory-helper/issues) and write there your questions.
