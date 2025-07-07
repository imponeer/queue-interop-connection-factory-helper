<?php

declare(strict_types=1);

namespace Imponeer\QueueInteropConnectionFactoryHelper;

use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\ComposerPackageMissingException;
use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\DSNNotSupportedException;
use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\EmptyDsnException;
use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\InvalidDsnFormatException;
use Interop\Queue\ConnectionFactory;
use Interop\Queue\Context;

/**
 * Queue-Interop factory helper
 *
 * @package Imponeer\QueueInteropConnectionFactoryHelper
 */
final class QueueConnectionFactoryHelper
{
    /**
     * Defines protocol map
     */
    private const array PROTOCOLS_MAP = [
        'amqp' => [
            [
                'package' => 'enqueue/amqp-ext',
                'extensions' => ['amqp'],
                'class' => 'Enqueue\AmqpExt\AmqpConnectionFactory',
            ],
            [
                'package' => 'enqueue/amqp-lib',
                'extensions' => [],
                'class' => 'Enqueue\AmqpLib\AmqpConnectionFactory',
            ],
            [
                'package' => 'enqueue/amqp-bunny',
                'extensions' => [],
                'class' => 'Enqueue\AmqpBunny\AmqpConnectionFactory',
            ],
        ],
        'stomp' => [
            [
                'package' => 'enqueue/stomp',
                'extensions' => [],
                'class' => 'Enqueue\Stomp\StompConnectionFactory',
            ],
        ],
        'gps' => [
            [
                'package' => 'enqueue/gps',
                'extensions' => [],
                'class' => 'Enqueue\Gps\GpsConnectionFactory',
            ],
        ],
        'gearman' => [
            [
                'package' => 'enqueue/gearman',
                'extensions' => ['gearman'],
                'class' => 'Enqueue\Gearman\GearmanConnectionFactory',
            ],
        ],
        'null' => [
            [
                'package' => 'enqueue/null',
                'extensions' => [],
                'class' => 'Enqueue\Null\NullConnectionFactory',
            ],
        ],
        'file' => [
            [
                'package' => 'enqueue/fs',
                'extensions' => [],
                'class' => 'Enqueue\Fs\FsConnectionFactory',
            ],
        ],
        'beanstalk' => [
            [
                'package' => 'enqueue/pheanstalk',
                'extensions' => [],
                'class' => 'Enqueue\Pheanstalk\PheanstalkConnectionFactory',
            ],
        ],
        'sqs' => [
            [
                'package' => 'enqueue/sqs',
                'extensions' => [],
                'class' => 'Enqueue\Sqs\SqsConnectionFactory',
            ],
        ],
        'kafka' => [
            [
                'package' => 'enqueue/rdkafka',
                'extensions' => ['rdkafka'],
                'class' => 'Enqueue\RdKafka\RdKafkaConnectionFactory',
            ],
        ],
        'redis' => [
            [
                'package' => 'enqueue/redis',
                'extensions' => ['redis'],
                'class' => 'Enqueue\Redis\RedisConnectionFactory',
            ],
        ],
        'mongodb' => [
            [
                'package' => 'enqueue/mongodb',
                'extensions' => ['mongodb'],
                'class' => 'Enqueue\Mongodb\MongodbConnectionFactory',
            ],
        ],
        'mysql' => [
            [
                'package' => 'enqueue/dbal',
                'extensions' => [],
                'class' => 'Enqueue\Dbal\DbalConnectionFactory',
            ],
        ],
        'wamp' => [
            [
                'package' => 'enqueue/wamp',
                'extensions' => [],
                'class' => 'Enqueue\Wamp\WampConnectionFactory',
            ],
        ],
        'ws' => [
            [
                'package' => 'enqueue/wamp',
                'extensions' => [],
                'class' => 'Enqueue\Wamp\WampConnectionFactory',
            ],
        ],
    ];

    /**
     * Disabled constructor - this is a utility class
     */
    private function __construct()
    {
    }

    /**
     * Get connection factory based on DSN
     *
     * @param string $dsn DSN string to make connection
     *
     * @return ConnectionFactory
     *
     * @throws DSNNotSupportedException When the DSN driver is not supported
     * @throws EmptyDsnException When the DSN is empty
     */
    public static function getFactory(string $dsn): ConnectionFactory
    {
        $dsn = trim($dsn);

        if (empty($dsn)) {
            throw new EmptyDsnException();
        }

        $driver = strstr($dsn, ':', true);
        if ($driver === false) {
            throw new InvalidDsnFormatException();
        }

        if (!isset(self::PROTOCOLS_MAP[$driver])) {
            throw new DSNNotSupportedException($driver);
        }

        $supportedPackages = [];
        foreach (self::PROTOCOLS_MAP[$driver] as $driverInfo) {
            $class = $driverInfo['class'];
            $supportedPackages[] = $driverInfo['package'];

            if (!class_exists($class)) {
                continue;
            }

            if (!self::hasAllRequiredPhpExtensions($driverInfo['extensions'])) {
                continue;
            }

            return new $class($dsn);
        }

        throw new ComposerPackageMissingException($supportedPackages);
    }

    /**
     * @param string[] $extensions
     */
    private static function hasAllRequiredPhpExtensions(array $extensions): bool
    {
        if (empty($extensions)) {
            return true;
        }

        foreach ($extensions as $extension) {
            if (!extension_loaded($extension)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Create context from DSN
     *
     * @param string $dsn Connection string
     *
     * @return Context
     *
     * @throws DSNNotSupportedException When the DSN driver is not supported
     * @throws EmptyDsnException When the DSN is empty
     */
    public static function createContext(string $dsn): Context
    {
        return self::getFactory($dsn)->createContext();
    }
}
