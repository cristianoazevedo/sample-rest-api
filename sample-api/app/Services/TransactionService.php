<?php

namespace App\Services;

use App\Events\TransactionSaved;
use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\NotAbleToSendValueException;
use App\Exceptions\PaymentRejectedException;
use App\Exceptions\TransactionException;
use App\Exceptions\UserNotFoundException;
use App\Models\Payer\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

/**
 * Class TransactionService
 * @package App\Services
 */
class TransactionService
{
    /**
     * @var TransactionRepository
     */
    private TransactionRepository $transactionRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var PaymentProcessAuthorization
     */
    private PaymentProcessAuthorization $paymentProcessAuthorization;

    /**
     * TransactionService constructor.
     * @param TransactionRepository $transactionRepository
     * @param UserRepository $userRepository
     * @param PaymentProcessAuthorization $paymentProcessAuthorization
     */
    public function __construct(
        TransactionRepository $transactionRepository,
        UserRepository $userRepository,
        PaymentProcessAuthorization $paymentProcessAuthorization
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
        $this->paymentProcessAuthorization = $paymentProcessAuthorization;
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
        /* @var User $payer */
        $payer = $this->userRepository->find($payerId);
        /* @var User $payee */
        $payee = $this->userRepository->find($payeeId);

        $this->paymentProcessAuthorization->process();

        if ($this->paymentProcessAuthorization->isRejected()) {
            throw new PaymentRejectedException($this->paymentProcessAuthorization->reason());
        }

        if ($payer->isNotAbleToSendValue()) {
            throw new NotAbleToSendValueException();
        }

        if ($payer->isOutOfBalance($value)) {
            throw new InsufficientBalanceException();
        }

        $transaction = $this->save($payer, $payee, $value);

        event(new TransactionSaved($transaction));

        return $transaction;
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
