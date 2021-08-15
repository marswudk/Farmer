<?php


namespace FARMER\Application\Service\File;


use FARMER\Domain\Model\Shared\FileManager\FileContentNotFoundException;
use FARMER\Domain\Model\Shared\FileManager\FileId;
use FARMER\Domain\Model\Shared\FileManager\FileInfoNotFoundException;
use FARMER\Domain\Model\Shared\FileManager\FileManager;

class GetFileService
{
    /** @var FileManager */
    private $fileManager;

    /**
     * GetFileService constructor.
     * @param FileManager $fileManager
     */
    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }


    public function getFileInfoByFileId($fileIdString) {
        $fileId = new FileId($fileIdString);
        $fileInfo = $this->fileManager->getFileInfoByFileId($fileId);

        return $fileInfo;
    }

    /**
     * @param $fileIdString
     * @return string
     * @throws FileContentNotFoundException
     * @throws FileInfoNotFoundException
     */
    public function getFilePathByFileId($fileIdString) {
        $fileId = new FileId($fileIdString);
        $filePath = $this->fileManager->getFilePath($fileId);

        return $filePath;
    }
}