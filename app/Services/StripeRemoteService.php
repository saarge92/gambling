<?php


namespace App\Services;

use App\Interfaces\Services\IStripeRemoteService;
use Stripe\BaseStripeClient;

/**
 * Сервис для удаленного вызовова API платежного сервиса Stripe
 * @package App\Services
 */
class StripeRemoteService implements IStripeRemoteService
{
    private BaseStripeClient $stripeClient;

    public function __construct(BaseStripeClient $stripeClient)
    {
        $this->stripeClient = $stripeClient;
    }

    /**
     * Обращение к платежному сервису Stripe для верификации карты
     * @param array $data Данные карты
     * @return \Stripe\Token Вернем данные токена с сервиса Stripe
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createToken(array $data): \Stripe\Token
    {
        $tokenInfo = $this->stripeClient->tokens->create([
            'card' => [
                'number' => $data['card_number'],
                'exp_month' => $data['exp_month'],
                'exp_year' => $data['exp_year'],
                'cvc' => $data['cvc']
            ]
        ]);
        return $tokenInfo;
    }

    public function createCharge(float $amount, string $token)
    {
        // TODO: Implement createCharge() method.
    }
}
