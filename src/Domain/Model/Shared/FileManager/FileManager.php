<?php


namespace FARMER\Domain\Model\Shared\FileManager;


use Psr\Http\Message\UploadedFileInterface;

interface FileManager
{
    /**
     * @param UploadedFileInterface $uploadedFile
     * @param string $filename
     * @return FileInfo
     */
    function addFile(UploadedFileInterface $uploadedFile, $filename) : FileInfo;

    /**
     * @param FileId $fileId
     * @throws FileInfoNotFoundException
     * @throws FileContentNotFoundException
     * @return void
     */
    function removeFile(FileId $fileId);

    /**
     * @param FileId $fileId
     * @throws FileInfoNotFoundException
     * @throws FileContentNotFoundException
     * @return string
     */
    function getFilePath(FileId $fileId);

    /**
     * @param FileId $fileId
     * @throws FileInfoNotFoundException
     * @return FileInfo
     */
    function getFileInfoByFileId(FileId $fileId) : FileInfo;
}