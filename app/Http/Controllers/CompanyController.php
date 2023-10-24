<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\{Request, Response};
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\{Log, Validator};
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Str;
use Throwable;

class CompanyController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'companyIds' => 'required',
        ]);

        if ($validator->fails()) {
            return new JsonResponse(
                $validator->getMessageBag()->toArray(),
                Response::HTTP_BAD_REQUEST
            );
        }

        $ids = $request->get('companyIds');

        $companies = Company::whereIn('company_id', $ids)
                        ->get()
                        ->toArray();

        return new JsonResponse($companies);
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->obtainEntityDataByRequest($request);

        try {
            Company::insert($data);
        } catch (Throwable $t) {
            Log::error($t->getTraceAsString());

            return new JsonResponse(['error' => $t->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new JsonResponse([
            'message' => 'Successful save'
        ], Response::HTTP_ACCEPTED);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $data = $this->obtainEntityDataByRequest($request);

        try {
            (new Company)->where('company_id', '=', $id)->update($data);
        } catch (Throwable $t) {
            Log::error($t->getTraceAsString());

            return new JsonResponse(['error' => $t->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new JsonResponse([
            'message' => 'Successful save'
        ], Response::HTTP_ACCEPTED);
    }

    private function obtainEntityDataByRequest(Request $request)
    {
        $result = [];

        $data = $request->toArray();

        foreach ($data as $key => $value) {
            $result[Str::snake($key)] = $value;
        }

        return $result;
    }
}
