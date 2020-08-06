<?php

namespace App\Services;

use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\NotAbleToSandValueException;
use App\Exceptions\TransactionException;
use App\Exceptions\UserNotFoundException;
use App\Models\Payer\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class TransactionService
{
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * TransactionService constructor.
     * @param TransactionRepository $transactionRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TransactionRepository $transactionRepository, UserRepository $userRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $payerId
     * @param int $payeeId
     * @param float $value
     * @return mixed
     * @throws TransactionException
     * @throws UserNotFoundException
     */
    public function create(int $payerId, int $payeeId, float $value)
    {
        try {
            /* @var User $payer */
            $payer = $this->userRepository->find($payerId);
            /* @var User $payee */
            $payee = $this->userRepository->find($payeeId);

            if ($payer->isNotAbleToSendValue()) {
                throw new NotAbleToSandValueException();
            }

            if ($payer->hasNoBalance($value)) {
                throw new InsufficientBalanceException();
            }

            return $this->save($payer, $payee, $value);
        } catch (NotAbleToSandValueException | InsufficientBalanceException $exception) {
            throw new TransactionException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param User $payer
     * @param User $payee
     * @param float $value
     * @return mixed
     */
    private function save(User $payer, User $payee, float $value)
    {
        return $this->transactionRepository->save($payer, $payee, $value);
    }
}
