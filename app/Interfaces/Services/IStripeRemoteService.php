<?php


namespace App\Interfaces\Services;

/**
 * Интерфейс для работы бизнес-логики
 * для связи с сервисом Stripe для подтверждения
 *
 * @package App\Interfaces\Services
 * @author Serdar Durdyev
 */
interface IStripeRemoteService
{
    function createToken(array $data);

    function createCharge(float $amount, string $token);
}
