<?php


namespace FARMER\Infrastructure\Service\Shared\PDO;



use FARMER\Application\Service\Shared\TransactionService;

class TransactionServiceImpl implements TransactionService {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function begin()
    {
        $this->pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, 0);
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
        $this->pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, 1);
    }

    public function rollback()
    {
        $this->pdo->rollBack();
        $this->pdo->setAttribute(\PDO::ATTR_AUTOCOMMIT, 1);
    }
}