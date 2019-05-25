<?php

namespace Imponeer\QueueInteropConnectionFactoryHelper;

use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\DSNNotSupportedException;
use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\EmptyDSNException;
use Interop\Queue\ConnectionFactory;
use Interop\Queue\Context;

/**
 * Queue-Interop factory helper
 *
 * @package Imponeer\QueueInteropConnectionFactoryHelper
 */
class QueueConnectionFactoryHelper {

    /**
     * Disabled constructor
     */
    private function __constructor() {

    }

    /**
     * Get connection context based on DSN
     *
     * @param string $dsn DSN string to make connection
     *
     * @return Context
     *
     * @throws DSNNotSupportedException
     * @throws EmptyDSNException
     */
    public static function getFactory(string $dsn): ConnectionFactory {
        $dsn = trim($dsn);

        if (empty($dsn)) {
            throw new EmptyDSNException();
        }

        $driver = strstr($dsn, ':', true);

        switch ($driver) {
            case 'amqp':
                if (extension_loaded('amqp') && class_exists('\\Enqueue\\AmqpExt\\AmqpConnectionFactory')) {
                    return new \Enqueue\AmqpExt\AmqpConnectionFactory($dsn);
                } elseif (class_exists('\\Enqueue\\AmqpLib\\AmqpConnectionFactory')) {
                    return new \Enqueue\AmqpLib\AmqpConnectionFactory($dsn);
                }
                return new \Enqueue\AmqpBunny\AmqpConnectionFactory($dsn);
            case 'stomp':
                return new \Enqueue\Stomp\StompConnectionFactory($dsn);
            case "gps":
                return new \Enqueue\Gps\GpsConnectionFactory($dsn);
            case 'gearman':
                return new \Enqueue\Gearman\GearmanConnectionFactory($dsn);
            case 'null':
                return new \Enqueue\Null\NullConnectionFactory();
            case 'file':
                return new \Enqueue\Fs\FsConnectionFactory($dsn);
            case 'beanstalk':
                return new \Enqueue\Pheanstalk\PheanstalkConnectionFactory($dsn);
            case 'sqs':
                return new \Enqueue\Sqs\SqsConnectionFactory($dsn);
            case 'kafka':
                return new \Enqueue\RdKafka\RdKafkaConnectionFactory($dsn);
            case 'redis':
                return new \Enqueue\Redis\RedisConnectionFactory($dsn);
            case 'mongodb':
                return new \Enqueue\Mongodb\MongodbConnectionFactory($dsn);
            case 'mysql':
                return new \Enqueue\Dbal\DbalConnectionFactory($dsn);
            case 'wamp':
            case 'ws':
                return new \Enqueue\Wamp\WampConnectionFactory($dsn);
            default:
                throw new DSNNotSupportedException($driver);
        }
    }

    /**
     * Create context from dsn
     *
     * @param string $dsn Connection string
     *
     * @return Context
     */
    public static function createContext(string $dsn): Context
    {
        return static::getFactory($dsn)->createContext();
    }

}