<?php

/**
 * class-cache
 * Source available at https://github.com/fukuyama012/class-cache
 * This is distributed under the terms of the MIT license.
 */
abstract class ClassCache
{
    /** @var array */
    private static $m_cache = [];

    /**
     * @param mixed $key
     * @return mixed cache data
     */
    protected static function _cacheGet($key)
    {
        $key = self::_serializeKey($key);
        if(isset(self::$m_cache[$key]))
        {
            return self::$m_cache[$key];
        }
        return null;
    }

    /**
     * @param mixed $key
     * @param mixed $data data for cache
     */
    protected static function _cacheSet($key, $data)
    {
        self::$m_cache[self::_serializeKey($key)] = $data;
    }

    /**
     * @param mixed $key
     */
    protected static function _cacheClear($key)
    {
        unset(self::$m_cache[self::_serializeKey($key)]);
    }

    /**
     *  use when needs to release memory,
     *  avoid side effects unintended behavior
     *  ex)Batch processing
     */
    static function clearAll()
    {
        self::$m_cache = [];
    }

    /**
     * @param mixed $key
     * @return string
     */
    private static function _serializeKey($key)
    {
        if(!is_array($key))
        {
            $key = array("id" => $key);
        }
        return sprintf("%s:%s", get_called_class(), http_build_query($key));
    }
}
