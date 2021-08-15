<?php


namespace FARMER\Domain\Model\Shared;


class DisplayStatus extends Enum
{
    const SHOW = 'SHOW';
    const HIDE = 'HIDE';

    public function __construct($value)
    {
        parent::__construct($value);
    }

    protected function throwExceptionForInvalidValue($value)
    {
        throw new \InvalidArgumentException($value);
    }
}