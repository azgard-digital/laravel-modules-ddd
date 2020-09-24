<?php
declare(strict_types=1);

namespace App\Modules\Wallets\Controllers\Api\V1;

use App\Exceptions\WalletsLimitException;
use App\Http\Controllers\Controller;
use App\Interfaces\App\IWallet;
use App\Interfaces\Services\IWalletService;
use App\Modules\Wallets\Controllers\Api\V1\Resources\TransactionsResource;
use App\Modules\Wallets\Controllers\Api\V1\Resources\WalletResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WalletsController extends Controller
{
    private $walletApp;
    private $walletService;

    public function __construct(IWallet $walletApp, IWalletService $walletService)
    {
        $this->walletService = $walletService;
        $this->walletApp = $walletApp;
    }

    public function store(Request $request): JsonResource
    {
        $userId = (int)$request->user()->id;

        if ($this->walletService->isLimited($userId)) {
            throw new WalletsLimitException('Too many wallets');
        }

        return new WalletResource(
            $this->walletApp->store(
                $userId
            )
        );
    }

    public function show(string $address, Request $request): JsonResource
    {
        return new WalletResource(
            $this->walletApp->show(
                $address,
                $request->user()->id
            )
        );
    }

    public function transactions(string $address): ResourceCollection
    {
        return new TransactionsResource(
            $this->walletApp->transactions(
                $address
            )
        );
    }
}
