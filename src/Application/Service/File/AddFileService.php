<?php


namespace FARMER\Application\Service\File;


use FARMER\Domain\Model\Shared\FileManager\FileId;
use FARMER\Domain\Model\Shared\FileManager\FileManager;
use Psr\Http\Message\UploadedFileInterface;

class AddFileService
{
    /** @var FileManager */
    private $fileManager;

    /**
     * AddFileService constructor.
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * @param UploadedFileInterface $uploadedFile
     * @param $filename
     * @return FileId
     */
    public function addFile(UploadedFileInterface $uploadedFile, $filename) {
        $fileInfo = $this->fileManager->addFile($uploadedFile, $filename);

        return $fileInfo->fileId();
    }
}