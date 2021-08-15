<?php


namespace FARMER\Domain\Model\Shared;


use ReflectionClass;

abstract class Enum
{
    protected static $cache = [];
    protected $value;

    public function __construct($value)
    {
        $this->ensureIsBetweenAcceptedValues($value);

        $this->value = $value;
    }

    abstract protected function throwExceptionForInvalidValue($value);

    public static function values(): array
    {
        $class = static::class;

        if (!isset(self::$cache[$class])) {
            $reflected = new ReflectionClass($class);
            self::$cache[$class] = $reflected->getConstants();
        }

        return self::$cache[$class];
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(Enum $other): bool
    {
        return $other == $this;
    }

    private function ensureIsBetweenAcceptedValues($value): void
    {
        if (!in_array($value, static::values(), true)) {
            $this->throwExceptionForInvalidValue($value);
        }
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }
}