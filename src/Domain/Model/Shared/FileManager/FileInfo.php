<?php


namespace FARMER\Domain\Model\Shared\FileManager;


use FARMER\Domain\Model\Shared\UnixTimestamp;

class FileInfo
{
    /** @var FileId */
    private $fileId;

    private $originalFilename;
    private $extension;
    private $mimeType;
    private $bytes;

    /** @var UnixTimestamp */
    private $createdTime;

    public function __construct(FileId $fileId, $originalFilename, $extension, $mimeType, $bytes, UnixTimestamp $createdTime)
    {
        $this->fileId = $fileId;
        $this->originalFilename = $originalFilename;
        $this->extension = $extension;
        $this->mimeType = $mimeType;
        $this->bytes = $bytes;
        $this->createdTime = $createdTime;
    }

    static function createNew($originalFilename, $extension, $mimeType, $bytes) {
        return new self(
            FileId::random(),
            $originalFilename,
            $extension,
            $mimeType,
            $bytes,
            new UnixTimestamp()
        );
    }

    public function fileId() {
        return $this->fileId;
    }

    public function originalFilename() {
        return $this->originalFilename;
    }

    public function extension() {
        return $this->extension;
    }

    public function mimeType() {
        return $this->mimeType;
    }

    public function bytes() {
        return $this->bytes;
    }

    /**
     * @return UnixTimestamp
     */
    public function createdTime() {
        return $this->createdTime;
    }
}