<?php


namespace App\Modules\Wallets\Services;


use App\Exceptions\StoreResourceFailedException;
use App\Interfaces\DAO\IWalletDAO;
use App\Modules\Wallets\DAO\WalletDAO;
use App\Modules\Wallets\DAO\WalletInfoDAO;

class WalletCreateAggregator
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
    public function create(WalletInfoDAO $dao):IWalletDAO
    {
        if ($this->walletRepository->create($dao->getUserId(), $dao->getBalance(), $dao->getAddress())) {
            return new WalletDAO(
                $dao->getAddress(),
                $this->btcRepository->convertBalanceToBtc($dao->getBalance()),
                $this->usdRepository->convertBalanceToUsd($dao->getBalance())
            );
        }

        throw new StoreResourceFailedException('Wallet has not been saved!');
    }
}
