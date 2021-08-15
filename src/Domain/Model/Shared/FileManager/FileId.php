<?php


namespace FARMER\Domain\Model\Shared\FileManager;


use FARMER\Domain\Model\Shared\Uuid;

class FileId extends Uuid implements \JsonSerializable
{

    public function jsonSerialize()
    {
        return [
            'fileId' => $this->value()
        ];
    }

    static public function fromJSONArray($jsonArray) {
        return new self(
            $jsonArray['fileId']
        );
    }
}