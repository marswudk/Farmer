<?php


namespace FARMER\Application\Service\Shared;


interface TransactionService
{
    public function begin();

    public function commit();

    public function rollback();
}