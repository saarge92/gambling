<?php

namespace Tests\Unit;

use App\Interfaces\Repositories\IBonusRepository;
use App\Interfaces\Services\IBonusMoneyExchangeService;
use App\Interfaces\Services\IStripeRemoteService;
use App\Models\AccountLoaylty;
use App\Providers\IoCProvider;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

/**
 * Unit-тестирование функционала класса по обмену бонусов на деньги
 * Тестирирование класса BonusMoneyExchangeService
 *
 * @package Tests\Unit
 * @author Serdar Durdyev
 */
class BonusMoneyExchangeServiceTest extends TestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createApplication()->register(IoCProvider::class);
    }

    /**
     * Тестирование функции по съему денег с карты
     * Тестирование функции exchangeBonusToMoney в классе BonusMoneyExchangeService
     * @throws \Exception
     */
    public function testChangeBonusToMoney()
    {
        $exchangeService = $this->getBonusMoneyDependency();
        $bonusMockRepository = \Mockery::mock(IBonusRepository::class);
        $stripeMockService = \Mockery::mock(IStripeRemoteService::class);
        $randomLoyalty = AccountLoaylty::orderByRaw("RAND()")->where('points', '>', 1)->first();

        if (!$randomLoyalty)
            throw new \Exception("Невозможно провести тест, поскольку отсутвуют записи с наполненными бонусами");

        $paymentInfo = [
            'card_number' => 4242424242424242,
            'exp_month' => 9,
            'exp_year' => 2022,
            'cvc' => 444
        ];

        $result = $exchangeService->exchangeBonusToMoney($randomLoyalty->user_id, $paymentInfo);

        $bonusMockRepository->shouldReceive('getUserBonusInfoByUserId')->with($randomLoyalty->user_id);
        $stripeMockService->shouldReceive('createToken')->with($paymentInfo);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('money', $result);
        $this->assertArrayHasKey('account_loyalty', $result);
    }

    /**
     * Получение функционала класса для тестирования
     * @return IBonusMoneyExchangeService
     */
    private function getBonusMoneyDependency(): IBonusMoneyExchangeService
    {
        return resolve(IBonusMoneyExchangeService::class);
    }
}
