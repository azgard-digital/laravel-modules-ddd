<?php
declare(strict_types=1);

namespace App\Modules\Transactions\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use  App\Modules\Transactions\Controllers\Api\V1\Requests\TransactionCreateRequest;
use App\Interfaces\App\ITransaction;
use  App\Modules\Transactions\Controllers\Api\V1\Resources\TransactionResource;
use App\Modules\Transactions\Controllers\Api\V1\Resources\TransactionsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionsController extends Controller
{
    private $transactionApp;

    public function __construct(ITransaction $transactionApp)
    {
        $this->transactionApp = $transactionApp;
    }

    public function store(TransactionCreateRequest $request): JsonResource
    {
        return new TransactionResource(
            $this->transactionApp->store(
                (int)$request->user()->id,
                $request->json('wallets.from'),
                $request->json('wallets.to'),
                (int)$request->get('amount')
            )
        );
    }

    public function index(Request $request): ResourceCollection
    {
        return new TransactionsResource(
            $this->transactionApp->transactions(
                $request->user()->id
            )
        );
    }
}
