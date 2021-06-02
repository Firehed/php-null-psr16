<?php

declare(strict_types=1);

namespace Firehed\Cache;

use Psr\SimpleCache\CacheInterface;

use function array_combine;
use function array_map;
use function array_values;
use function count;
use function is_array;
use function is_int;
use function iterator_to_array;

class NullPsr16 implements CacheInterface
{
    public function get($key, $default = null): mixed
    {
        return $default;
    }

    public function set($key, $value, $ttl = null): bool
    {
        return false;
    }

    public function delete($key): bool
    {
        return false;
    }

    public function clear(): bool
    {
        return false;
    }

    /**
     * @param iterable<string> $keys
     * @return array<string, mixed>
     */
    public function getMultiple($keys, $default = null)
    {
        $keys = is_array($keys) ? array_values($keys) : iterator_to_array($keys);
        return array_fill_keys($keys, $default);
    }

    /**
     * @param iterable<string> $values
     */
    public function setMultiple($values, $ttl = null): bool
    {
        return false;
    }

    /**
     * @param iterable<string> $keys
     */
    public function deleteMultiple($keys): bool
    {
        return false;
    }

    public function has($key): bool
    {
        return false;
    }
}
