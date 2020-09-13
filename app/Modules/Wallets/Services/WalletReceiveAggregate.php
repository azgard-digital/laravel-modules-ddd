<?php


namespace App\Modules\Wallets\Services;


use App\Exceptions\ResourceException;
use App\Interfaces\DAO\IWalletDAO;
use App\Modules\Wallets\DAO\WalletDAO;
use App\Modules\Wallets\DAO\WalletInfoDAO;

class WalletReceiveAggregate
{
    /**
     * @var BtcConverterRepository
     */
    private $btcRepository;

    /**
     * @var UsdConverterRepository
     */
    private $usdRepository;

    /**
     * @var WalletRepository
     */
    private $walletRepository;

    /**
     * WalletCreateAggregator constructor.
     * @param BtcConverterRepository $btcRepository
     * @param UsdConverterRepository $usdRepository
     * @param WalletRepository $walletRepository
     */
    public function __construct(
        BtcConverterRepository $btcRepository,
        UsdConverterRepository $usdRepository,
        WalletRepository $walletRepository
    ) {
        $this->usdRepository = $usdRepository;
        $this->btcRepository = $btcRepository;
        $this->walletRepository = $walletRepository;
    }


    /**
     * @param WalletInfoDAO $dao
     * @return IWalletDAO
     */
    public function getByAddress(string $address, int $userId):IWalletDAO
    {
        $balance = $this->walletRepository->getByAddress($address, $userId);

        if ($balance) {
            return new WalletDAO(
                $address,
                $this->btcRepository->convertBalanceToBtc($balance),
                $this->usdRepository->convertBalanceToUsd($balance)
            );
        }

        throw new ResourceException('Wallet has not been found!');
    }
}
