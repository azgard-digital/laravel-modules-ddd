<?php


namespace App\Modules\Transactions\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Interfaces\App\ITransaction;
use App\Modules\Transactions\Controllers\Api\V1\Requests\ReceiveRequest;
use App\Modules\Transactions\Controllers\Api\V1\Requests\RegisterRequest;

class TransactionsController extends Controller
{
    private $transaction;

    public function __construct(ITransaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function store(RegisterRequest $request)
    {
        return new Responses\RegisterResponse(
            $this->transaction->create(
                $request->getLoggedUserId(),
                $request->getWalletFrom(),
                $request->getWalletTo(),
                $request->getAmount()
            )
        );
    }

    public function show(ReceiveRequest $request)
    {
        return new Responses\WalletResponse(
            $this->transaction->getByAddress(
                $request->getLoggedUserId()
            )
        );
    }
}
