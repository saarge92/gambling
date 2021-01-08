<?php

namespace App\Http\Controllers;

use App\Http\Requests\BonusToMoneyRequest;
use App\Interfaces\Repositories\IBonusService;
use App\Interfaces\Services\IBonusMoneyExchangeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Контроллер для обработки запросов касательно бонусных баллов пользователя
 * @package App\Http\Controllers
 * @author Serdar Durdyev
 */
class AccountLoyaltyController extends Controller
{
    protected IBonusService $bonusService;

    public function __construct(IBonusService $bonusService)
    {
        $this->bonusService = $bonusService;
    }

    /**
     * Получаем бонусные баллы текущего пользователя
     * по запросу GET /bonus
     * @param Request $request Текущий запрос пользователя
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCurrentBonusInfo(Request $request)
    {
        $currentUser = $request->user();
        $accountLoyalty = $this->bonusService->getUserBonusInfoByUserId($currentUser->id);
        if ($accountLoyalty)
            return view('account_loyalty', ['bonus' => $accountLoyalty->points]);
        return view('account_loyalty', ['bonus' => 0]);
    }

    /**
     * Обработка запроса по обмену бонусных баллов на деньги
     * @param BonusToMoneyRequest $request Запрос, содержащий данные пользователя
     * @param IBonusMoneyExchangeService $bonusMoneyExchangeService Сервисный класс по обмену баллов на деньги
     * @return \Illuminate\Http\JsonResponse Json ответ с обновленными бонусами пользователя
     */
    public function changeBonusToMoney(BonusToMoneyRequest $request,
                                       IBonusMoneyExchangeService $bonusMoneyExchangeService)
    {
        if ($request->validated()) {
            $currentUser = $request->user();
            $result = $bonusMoneyExchangeService->exchangeBonusToMoney($currentUser->id, $request->all());
            return response()->json($result, JsonResponse::HTTP_OK);
        }
        return response()->json($request->messages(), JsonResponse::HTTP_BAD_REQUEST);
    }
}
