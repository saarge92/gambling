<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrizeGenerateRequest;
use App\Interfaces\Services\IPrizeGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    protected IPrizeGeneratorService $prizeGeneratorService;

    public function __construct(IPrizeGeneratorService $prizeGeneratorService)
    {
        $this->prizeGeneratorService = $prizeGeneratorService;
    }

    /**
     * Генерация приза для пользователя
     * по запросу POST /prize/generate
     * @return JsonResponse Ответ с json данными сгенерированных призов
     */
    public function generatePrize(): JsonResponse
    {
        $data = $this->prizeGeneratorService->generatePriceService();
        return response()->json($data, JsonResponse::HTTP_OK);
    }
}
