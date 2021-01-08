<?php

namespace App\Http\Controllers;

use App\Interfaces\Repositories\IBonusService;
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
}
