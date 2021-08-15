<?php


namespace FARMER\Infrastructure\Domain\Model\FileManager;


use FARMER\Domain\Model\Shared\FileManager\AddFileFailException;
use FARMER\Domain\Model\Shared\FileManager\FileId;
use FARMER\Domain\Model\Shared\FileManager\FileInfo;
use FARMER\Domain\Model\Shared\FileManager\FileInfoNotFoundException;
use FARMER\Domain\Model\Shared\FileManager\FileInfoRepository;
use Psr\Http\Message\UploadedFileInterface;

class FileManagerImpl
{
    /** @var FileInfoRepository */
    private $fileInfoRepository;


    public function __construct(FileInfoRepository $fileInfoRepository)
    {
        $this->fileInfoRepository = $fileInfoRepository;
    }

    /**
     * @param UploadedFileInterface $uploadedFile
     * @param string $originalFilename
     * @return FileInfo
     * @throws AddFileFailException
     */
    function addFile(UploadedFileInterface $uploadedFile, $originalFilename): FileInfo
    {
//        if(!\file_exists($pathToFile)) {
//            throw new AddFileFailException("{$pathToFile} does not exist.");
//        }

//        $bytes = \filesize($pathToFile);
//        $mimeType = @\mime_content_type($pathToFile);
//        $extension = \pathinfo($originalFilename, PATHINFO_EXTENSION);

        $bytes = $uploadedFile->getSize();
        $mimeType = $uploadedFile->getClientMediaType();
        $extension = \pathinfo($originalFilename, PATHINFO_EXTENSION);

        if(!$mimeType) {
            $mimeType = 'application/octet-stream';
        }

        $fileInfo = FileInfo::createNew($originalFilename, $extension, $mimeType, $bytes);

        $pathToStoreFile = $this->generateRealFilePath($fileInfo);


        if (!$uploadedFile->moveTo($pathToStoreFile)) {
            throw new AddFileFailException(sprintf('Error moving file %s to %s', $originalFilename, $pathToStoreFile));
        }

        $this->fileInfoRepository->add($fileInfo);

        return $fileInfo;
    }

    /**
     * @param FileId $fileId
     * @return void
     * @throws FileInfoNotFoundException
     */
    function removeFile(FileId $fileId)
    {
        $fileInfo = $this->fileInfoRepository->findByFileId($fileId);

        $filePath = $this->generateRealFilePath($fileInfo);

        if (!unlink($filePath)) {
            throw new \RuntimeException(sprintf('Error removing file %s', $filePath));
        }
    }

    /**
     * @param FileId $fileId
     * @return string
     * @throws FileInfoNotFoundException
     */
    function getFilePath(FileId $fileId)
    {
        $fileInfo = $this->fileInfoRepository->findByFileId($fileId);

        $filePath = $this->generateRealFilePath($fileInfo);

        return $filePath;
    }

    /**
     * @param FileId $fileId
     * @throws FileInfoNotFoundException
     * @return FileInfo
     */
    function getFileInfoByFileId(FileId $fileId): FileInfo
    {
        $fileInfo = $this->fileInfoRepository->findByFileId($fileId);

        return $fileInfo;
    }

    private function generateRealFilePath(FileInfo $fileInfo) {
        $yearMonth = $fileInfo->createdTime()->format('Ym');

        $extension = $fileInfo->extension();
        $fileId = $fileInfo->fileId()->value();

        if(!\is_dir(FILE_STORE_PATH . $yearMonth)) {
            \mkdir(FILE_STORE_PATH . $yearMonth, 0777, true);
        }

        if($extension) {
            return (FILE_STORE_PATH . $yearMonth . '/' . $fileId . '.' . $extension);
        } else {
            return (FILE_STORE_PATH . $yearMonth . '/' . $fileId);
        }
    }
}