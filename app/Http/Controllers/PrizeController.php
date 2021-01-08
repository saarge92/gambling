<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrizeGenerateRequest;
use App\Interfaces\Services\IPrizeGeneratorService;
use Illuminate\Http\JsonResponse;

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

    /**
     * Получение приза для пользователя
     * по запросу POST /prize/get
     * @param int $prizeTypeId Id типа вознаграждения
     * @param PrizeGenerateRequest $request Запрос, содержщий параметры
     * @return JsonResponse Json ответ с результатами присвоения
     */
    public function getGeneratedPrize(int $prizeTypeId, PrizeGenerateRequest $request): JsonResponse
    {
        if ($request->validated()) {
            $currentUser = $request->user();
            $data = $this->prizeGeneratorService->getPrize($currentUser->id, $prizeTypeId, $request->all());
            return response()->json($data, JsonResponse::HTTP_OK);
        }
        return response()->json($request->messages(), JsonResponse::HTTP_BAD_REQUEST);
    }
}
