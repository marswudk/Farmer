<?php


namespace FARMER\Domain\Model\Shared;


class UnixTimestamp {
    private $unixTimestamp;

    /** @var \DateTime */
    private $dt;

    public function __construct($unixTimestamp = '')
    {
        if($unixTimestamp === '') {
            $unixTimestamp = \time();
        }

        $this->dt = \DateTime::createFromFormat('U', $unixTimestamp);
        $this->unixTimestamp = $unixTimestamp;
    }

    public function value() {
        return $this->unixTimestamp;
    }

    public function format($formatString) {
        $this->dt->setTimezone(new \DateTimeZone(GMTTimezone::PLUS_0800));

        return $this->dt->format($formatString);
    }

    public function dt() {
        return $this->dt;
    }

    public function __toString()
    {
        return (string)$this->unixTimestamp;
    }
}