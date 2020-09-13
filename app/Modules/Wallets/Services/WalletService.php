<?php


namespace App\Modules\Wallets\Services;


use App\Interfaces\DAO\IWalletDAO;
use App\Interfaces\Services\IWalletService;
use App\Modules\Wallets\DAO\WalletInfoDAO;

class WalletService implements IWalletService
{
    /**
     * @var WalletRepository
     */
    private $walletRepository;

    /**
     * @var BtcConverterRepository
     */
    private $btcRepository;

    /**
     * @var UsdConverterRepository
     */
    private $usdRepository;


    public function __construct(
        WalletRepository $walletRepository,
        BtcConverterRepository $btcRepository,
        UsdConverterRepository $usdRepository
    ) {
        $this->walletRepository = $walletRepository;
        $this->usdRepository = $usdRepository;
        $this->btcRepository = $btcRepository;
    }

    public function limit():int
    {
        return self::WALLETS_LIMIT;
    }

    public function create(int $userId):IWalletDAO
    {
        $address = $this->walletRepository->createWalletAddress($userId);
        $dao = new WalletInfoDAO($address,self::DEFAULT_BALANCE, $userId);
        $aggregator = new WalletCreateAggregator($this->btcRepository, $this->usdRepository, $this->walletRepository);
        return $aggregator->create($dao);
    }

    public function getByAddress(string $address, int $userId):IWalletDAO
    {
        $aggregator = new WalletReceiveAggregate($this->btcRepository, $this->usdRepository, $this->walletRepository);
        return $aggregator->getByAddress($address, $userId);
    }

    public function count(int $userId):int
    {
        return $this->walletRepository->count($userId);
    }
}
