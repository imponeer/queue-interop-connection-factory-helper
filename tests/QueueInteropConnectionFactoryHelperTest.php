<?php

namespace Imponeer\QueueInteropConnectionFactoryHelper\Tests;

use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\DSNNotSupportedException;
use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\EmptyDSNException;
use Imponeer\QueueInteropConnectionFactoryHelper\QueueConnectionFactoryHelper;
use Jchook\AssertThrows\AssertThrows;
use PHPUnit\Framework\TestCase;

/**
 * Test QueueInteropConnectionFactoryHelper class
 *
 * @package Imponeer\QueueInteropConnectionFactoryHelper\Tests
 */
class QueueInteropConnectionFactoryHelperTest extends TestCase
{

    use AssertThrows;

    /**
     * Test if required static methods exists
     */
    public function testStaticMethodsExists() {
        foreach (['getFactory', 'createContext'] as $method) {
            self::assertTrue(
                method_exists(
                    QueueConnectionFactoryHelper::class,
                    $method
                ),
                "$method not exist in " .  QueueConnectionFactoryHelper::class
            );
        }
    }

    /**
     * Test that all registered DNS'es resolves to something
     */
    public function testIfGoodDNSIsResolvingCorrectly() {
        $dsn_to_test = [
            'amqp',
            'stomp',
            'gps',
            'gearman',
            'null',
            'file',
            'beanstalk',
            'sqs',
            'kafka',
            'redis',
            'mongodb',
            'mysql',
            'wamp',
            'ws'
        ];
        foreach ($dsn_to_test as $dsn_prefix) {
            $dsn = $dsn_prefix . ':';
            $this->assertThrows(
                \Error::class,
                function() use($dsn) {
                    QueueConnectionFactoryHelper::getFactory($dsn);
                },
                function ($e) {
                    self::assertRegExp("/Class \"([^\"]+)\" not found|Class '([^']+)' not found/", $e->getMessage(), "Bad error message");
                }
            );
        }
    }

    /**
     * Test if unknown DSN throws DSNNotSupportedException
     */
    public function testIfUnknownDSNIsResolvingCorrectly() {
        $this->assertThrows(DSNNotSupportedException::class, function () {
            QueueConnectionFactoryHelper::getFactory(sha1(microtime(true)) . ':');
        });
    }

    /**
     * Test if empty DSN throws EmptyDSNException
     */
    public function testEmptyDSNString() {
        $this->assertThrows(EmptyDSNException::class, function () {
            QueueConnectionFactoryHelper::getFactory('');
        });
        $this->assertThrows(EmptyDSNException::class, function () {
            QueueConnectionFactoryHelper::getFactory(' ');
        });
    }

}