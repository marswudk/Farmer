<?php


namespace FARMER\Domain\Model\Shared\FileManager;


interface FileInfoRepository {
    /**
     * @param FileId $fileId
     * @throws FileInfoNotFoundException
     * @return FileInfo
     */
    function findByFileId(FileId $fileId);

    /**
     * @param FileInfo $fileInfo
     * @return void
     */
    function add(FileInfo $fileInfo);

    /**
     * @param FileInfo $fileInfo
     * @return void
     */
    function remove(FileInfo $fileInfo);
}