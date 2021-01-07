<?php


namespace App\Interfaces\Services;

/**
 * Интерфейс для сервиса по генерации призов для пользователя
 * @package App\Interfaces\Services
 * @author Serdar Durdyev
 */
interface IPrizeGeneratorService
{
    function generatePriceService(): iterable;
}
