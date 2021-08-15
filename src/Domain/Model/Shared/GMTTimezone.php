<?php


namespace FARMER\Domain\Model\Shared;


class GMTTimezone extends Enum {
    const MINUS_0100 = '-0100';
    const MINUS_0200 = '-0200';
    const MINUS_0300 = '-0300';
    const MINUS_0400 = '-0400';
    const MINUS_0500 = '-0500';
    const MINUS_0600 = '-0600';
    const MINUS_0700 = '-0700';
    const MINUS_0800 = '-0800';
    const MINUS_0900 = '-0900';
    const MINUS_1000 = '-1000';
    const MINUS_1100 = '-1100';

    const PLUS_0000 = '+0000';
    const PLUS_0100 = '+0100';
    const PLUS_0200 = '+0200';
    const PLUS_0300 = '+0300';
    const PLUS_0400 = '+0400';
    const PLUS_0500 = '+0500';
    const PLUS_0600 = '+0600';
    const PLUS_0700 = '+0700';
    const PLUS_0800 = '+0800';
    const PLUS_0900 = '+0900';
    const PLUS_1000 = '+1000';
    const PLUS_1100 = '+1100';
    const PLUS_1200 = '+1200';

    /**
     * MemberLevel constructor.
     * @param $value
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

    protected function throwExceptionForInvalidValue($value)
    {
        throw new \InvalidArgumentException($value);
    }
}