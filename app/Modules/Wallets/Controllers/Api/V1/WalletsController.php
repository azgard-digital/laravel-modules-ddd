<?php

namespace App\Modules\Wallets\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Interfaces\App\IWallet;
use App\Modules\Wallets\Controllers\Api\V1\Requests\ReceiveRequest;
use App\Modules\Wallets\Controllers\Api\V1\Requests\RegisterRequest;

class WalletsController extends Controller
{
    private $wallet;

    public function __construct(IWallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function store(RegisterRequest $request)
    {
        return new Responses\WalletResponse(
            $this->wallet->create(
                $request->getLoggedUserId()
            )
        );
    }

    public function show(string $address, ReceiveRequest $request)
    {
        return new Responses\WalletResponse(
            $this->wallet->getByAddress(
                $address,
                $request->getLoggedUserId()
            )
        );
    }
}
