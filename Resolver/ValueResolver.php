<?php

namespace LapaLabs\ValueResolver\Resolver;

use stdClass;

/**
 * Class ValueResolver
 *
 * @author Victor Bocharsky <bocharsky.bw@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php The MIT License
 */
class ValueResolver
{
    const TYPE_BOOL     = 'bool';
    const TYPE_BOOLEAN  = 'boolean';
    const TYPE_INT      = 'int';
    const TYPE_INTEGER  = 'integer';
    const TYPE_FLOAT    = 'float';
    const TYPE_DOUBLE   = 'double';
    const TYPE_REAL     = 'real';
    const TYPE_STRING   = 'string';
    const TYPE_ARRAY    = 'array';
    const TYPE_OBJECT   = 'object';

    /**
     * @param mixed $value
     * @param mixed $default = null
     * @return mixed
     */
    public static function resolve($value, $default = null)
    {
        if ($value) {
            return $value;
        }

        return $default;
    }

    /**
     * @param string $type
     * @param mixed $value
     * @param mixed $default = null
     * @return mixed
     */
    public static function typecasting($type, $value, $default = null)
    {
        switch ($type) {
            case static::TYPE_STRING:
                return (string)static::resolve((string)$value, $default);

            case static::TYPE_INT:
            case static::TYPE_INTEGER:
                return (int)static::resolve((int)$value, $default);

            case static::TYPE_FLOAT:
            case static::TYPE_DOUBLE:
            case static::TYPE_REAL:
                return (float)static::resolve((float)$value, $default);

            case static::TYPE_BOOL:
            case static::TYPE_BOOLEAN:
                return (bool)static::resolve((bool)$value, $default);

            case static::TYPE_ARRAY:
                return (array)static::resolve($value, $default);

            case static::TYPE_OBJECT:
                return (object)static::resolve($value, $default);

            default:
                throw new \InvalidArgumentException(sprintf(
                    'Unexpected type "%s" for typecasting', $type
                ));
        }

        return $default;
    }

    /**
     * @param mixed $value
     * @param string $default = ''
     * @return string
     */
    public static function string($value, $default = '')
    {
        return static::typecasting(static::TYPE_STRING, $value, $default);
    }

    /**
     * @param mixed $value
     * @param int $default = 0
     * @return int
     */
    public static function integer($value, $default = 0)
    {
        return static::typecasting(static::TYPE_INTEGER, $value, $default);
    }

    /**
     * @param mixed $value
     * @param float $default = 0.0
     * @return float
     */
    public static function float($value, $default = 0.0)
    {
        return static::typecasting(static::TYPE_FLOAT, $value, $default);
    }

    /**
     * @param mixed $value
     * @param bool $default = false
     * @return bool
     */
    public static function boolean($value, $default = false)
    {
        return static::typecasting(static::TYPE_BOOLEAN, $value, $default);
    }

    /**
     * @param mixed $value
     * @param array $default = []
     * @return array
     */
    public static function toArray($value, array $default = [])
    {
        return static::typecasting(static::TYPE_ARRAY, $value, $default);
    }

    /**
     * @param mixed $value
     * @param object $default = new \stdClass
     * @return object
     */
    public static function toObject($value, stdClass $default = null)
    {
        if (null === $default) {
            $default = new stdClass();
        }

        return static::typecasting(static::TYPE_OBJECT, $value, $default);
    }
}
