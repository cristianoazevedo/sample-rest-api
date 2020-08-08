<?php

namespace App\Http\Controllers;

use App\Exceptions\TransactionException;
use App\Exceptions\UserNotFoundException;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{
    /**
     * @var TransactionService
     */
    protected TransactionService $service;

    /**
     * TransactionController constructor.
     * @param TransactionService $service
     */
    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws TransactionException
     * @throws UserNotFoundException
     */
    public function create(Request $request): JsonResponse
    {
        /**
         * @todo tirar essa validação do controller
         */
        $this->validate($request, [
            'payer' => 'required',
            'payee' => 'required|different:payer',
            'value' => 'required|numeric|min:1'
        ]);

        $payerId = $request->json()->get('payer');
        $payeeId = $request->json()->get('payee');
        $value = $request->json()->get('value');

        $transaction = $this->service->create($payerId, $payeeId, $value);

        return response()->json([
            'id' => $transaction->id,
            'created_at' => (new \DateTime($transaction->created_at))->format(\DateTime::ISO8601)
        ],
            Response::HTTP_CREATED);
    }
}
