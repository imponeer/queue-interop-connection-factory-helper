<?php

declare(strict_types=1);

namespace Imponeer\QueueInteropConnectionFactoryHelper\Tests;

use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\ComposerPackageMissingException;
use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\DSNNotSupportedException;
use Imponeer\QueueInteropConnectionFactoryHelper\Exceptions\EmptyDsnException;
use Imponeer\QueueInteropConnectionFactoryHelper\QueueConnectionFactoryHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Test QueueInteropConnectionFactoryHelper class
 *
 * @package Imponeer\QueueInteropConnectionFactoryHelper\Tests
 */
final class QueueInteropConnectionFactoryHelperTest extends TestCase
{

	public static function provideEmptyDSNString(): array
	{
		return [
			'spaces' => [
				'dsn' => ' '
			],
			'empty' => [
				'dsn' => ''
			],
		];
	}

	public function testStaticMethodsExists(): void
	{
		$requiredMethods = ['getFactory', 'createContext'];

		foreach ($requiredMethods as $method) {
			self::assertTrue(
				method_exists(QueueConnectionFactoryHelper::class, $method),
				"Method '{$method}' does not exist in " . QueueConnectionFactoryHelper::class
			);
		}
	}

	public static function provideGoodDSN(): array
	{
		return [
			'amqp' => [
				'dsn' => 'amqp://localhost'
			],
			'stomp' => [
				'dsn' => 'stomp://localhost'
			],
			'gps' => [
				'dsn' => 'gps://localhost'
			],
			'gearman' => [
				'dsn' => 'gearman://localhost'
			],
			'null' => [
				'dsn' => 'null://'
			],
			'file' => [
				'dsn' => 'file://localhost.txt'
			],
			'beanstalk' => [
				'dsn' => 'beanstalk://localhost'
			],
			'sqs' => [
				'dsn' => 'sqs://localhost'
			],
			'kafka' => [
				'dsn' => 'kafka://localhost'
			],
			'redis' => [
				'dsn' => 'redis://localhost'
			],
			'mongodb' => [
				'dsn' => 'mongodb://localhost'
			],
			'mysql' => [
				'dsn' => 'mysql://localhost'
			],
			'wamp' => [
				'dsn' => 'wamp://localhost'
			],
			'ws' => [
				'dsn' => 'ws://localhost'
			],
		];
	}

	/**
	 * @throws DSNNotSupportedException
	 * @throws EmptyDsnException
	 */
	#[DataProvider('provideGoodDSN')]
	public function testIfGoodDNSIsResolvingCorrectly(string $dsn): void
	{
		$this->expectException(ComposerPackageMissingException::class);
		QueueConnectionFactoryHelper::getFactory($dsn);
	}

	/**
	 * @throws EmptyDsnException
	 */
	public function testIfUnknownDSNIsResolvingCorrectly(): void
	{
		$this->expectException(DSNNotSupportedException::class);
		QueueConnectionFactoryHelper::getFactory(sha1((string)microtime(true)) . ':');
	}

	/**
	 * @throws DSNNotSupportedException
	 */
	#[DataProvider('provideEmptyDSNString')]
	public function testEmptyDSNString(string $dsn): void
	{
		$this->expectException(EmptyDsnException::class);
		QueueConnectionFactoryHelper::getFactory($dsn);
	}

}