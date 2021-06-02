<?php

declare(strict_types=1);

namespace Firehed\Cache;

use function array_keys;
use function array_map;

/**
 * @covers Firehed\Cache\NullPsr16
 */
class RedisPsr16Test extends \PHPUnit\Framework\TestCase
{
    private NullPsr16 $cache;

    public function setUp(): void
    {
        $this->cache = new NullPsr16();
    }

    public function testGetReturnsNullOnMiss(): void
    {
        self::assertNull($this->cache->get('key'));
    }

    public function testGetReturnsDefaultOnMiss(): void
    {
        self::assertSame(4, $this->cache->get('key', 4));
    }

    public function testGetMulitpleReturnsNullOnMisses(): void
    {
        $data = [
            'key' => '',
            'key2' => '',
        ];
        $misses = array_map(fn () => null, $data);
        $results = $this->cache->getMultiple(array_keys($data));

        self::assertEqualsCanonicalizing($misses, $results);
    }

    public function testGetMulitpleReturnsDefaultOnMisses(): void
    {
        $data = [
            'key' => '',
            'key2' => '',
        ];
        $results = $this->cache->getMultiple(array_keys($data), 'default');

        self::assertEqualsCanonicalizing(
            array_map(fn () => 'default', $data),
            $results,
        );
    }

    public function testSetFails(): void
    {
        self::assertFalse($this->cache->set('key', 'value'));
    }

    public function testSetTtlFails(): void
    {
        self::assertFalse($this->cache->set('key', 'value', 50));
    }

    public function testSetMultipleFails(): void
    {
        self::assertFalse($this->cache->setMultiple([
            'key' => 'value',
            'key2' => 'value2',
        ]));
    }

    public function testSetMultipleTtlFails(): void
    {
        self::assertFalse($this->cache->setMultiple([
            'key' => 'value',
            'key2' => 'value2',
        ], 50));
    }

    public function testHas(): void
    {
        self::assertFalse($this->cache->has('key'));
    }

    public function testClear(): void
    {
        self::assertFalse($this->cache->clear());
    }

    public function testDeleteFails(): void
    {
        self::assertFalse($this->cache->delete('key'));
    }

    public function testDeleteMultipleFails(): void
    {
        self::assertFalse($this->cache->deleteMultiple(['key', 'key2']));
    }
}
