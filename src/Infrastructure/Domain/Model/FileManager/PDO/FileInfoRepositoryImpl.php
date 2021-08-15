<?php


namespace FARMER\Infrastructure\Domain\Model\FileManager\PDO;


use FARMER\Domain\Model\Shared\FileManager\FileId;
use FARMER\Domain\Model\Shared\FileManager\FileInfo;
use FARMER\Domain\Model\Shared\FileManager\FileInfoNotFoundException;
use FARMER\Domain\Model\Shared\FileManager\FileInfoRepository;
use FARMER\Domain\Model\Shared\UnixTimestamp;

class FileInfoRepositoryImpl implements FileInfoRepository
{
    private $pdo;
    private $fileInfoTable = 'fileinfo';

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param FileId $fileId
     * @return FileInfo
     * @throws FileInfoNotFoundException
     */
    function findByFileId(FileId $fileId)
    {
        $table = $this->fileInfoTable;

        $sql = "
          SELECT * 
          FROM {$table}
          WHERE
            file_id = :file_id";

        $stmt = $this->pdo->prepare($sql);

        $fileId = $fileId->value();

        $stmt->bindParam(':file_id', $fileId);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $fileInfo = null;

        foreach ($rows as $row) {
            $fileInfo = $this->map($row);
        }

        if(!$fileInfo) {
            throw new FileInfoNotFoundException();
        }

        return $fileInfo;
    }

    /**
     * @param FileInfo $fileInfo
     * @return void
     */
    function add(FileInfo $fileInfo)
    {
        $table = $this->fileInfoTable;

        $sql = "INSERT INTO 
                  {$table} 
                SET 
                  file_id = :file_id,
                  original_filename = :original_filename,
                  extension = :extension,
                  mime_type = :mime_type,
                  bytes = :bytes,
                  created_time = :created_time";

        $stmt = $this->pdo->prepare($sql);

        $fileId = $fileInfo->fileId()->value();
        $originalFilename = $fileInfo->originalFilename();
        $extension = $fileInfo->extension();
        $mimeType = $fileInfo->mimeType();
        $bytes = $fileInfo->bytes();
        $createdTime = $fileInfo->createdTime()->value();


        $stmt->bindParam(':file_id',$fileId);
        $stmt->bindParam(':original_filename',$originalFilename);
        $stmt->bindParam(':extension',$extension);
        $stmt->bindParam(':mime_type',$mimeType);
        $stmt->bindParam(':bytes',$bytes);
        $stmt->bindParam(':created_time',$createdTime);

        $stmt->execute();
    }

    /**
     * @param FileInfo $fileInfo
     * @return void
     */
    function remove(FileInfo $fileInfo)
    {
        $table = $this->fileInfoTable;

        $sql = "DELETE FROM {$table} WHERE file_id = :file_id";

        $stmt = $this->pdo->prepare($sql);

        $fileId = $fileInfo->fileId()->value();

        $stmt->bindParam(':file_id',$fileId);

        $stmt->execute();
    }

    private function map($row) {
        $fileId = new FileId($row['file_id']);
        $originalFilename = $row['original_filename'];
        $extension = $row['extension'];
        $mimeType = $row['mime_type'];
        $bytes = $row['bytes'];
        $createdTime = new UnixTimestamp($row['created_time']);

        return new FileInfo(
            $fileId,
            $originalFilename,
            $extension,
            $mimeType,
            $bytes,
            $createdTime
        );
    }
}