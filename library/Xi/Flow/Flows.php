<?php
namespace Xi\Flow;

/**
 * Static flow control object factory.
 */
class Flows
{
    /**
     * @return Promise
     */
    public static function promise()
    {
        return new Promise();
    }
    
    /**
     * @param mixed $value
     * @return Maybe
     */
    public static function maybe($value)
    {
        return new Maybe($value);
    }
}
