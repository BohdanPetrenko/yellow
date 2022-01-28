<?php

namespace App\Http\Controllers;

use App\DataObjects\StoreCompanyData;
use App\Http\Resources\CompanyResource;
use App\Services\Company\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    /**
     * @param Request        $request
     * @param CompanyService $companyService
     * @return AnonymousResourceCollection
     * @throws ValidationException
     */
    public function index(Request $request, CompanyService $companyService)
    {
        $this->validate($request, [
            'page'    => 'sometimes|integer',
            'per_page' => 'sometimes|integer',
        ]);

        $companies = $companyService->paginated(
            Auth::user()->id,
            $request->input('page', 1),
            $request->input('per_page', 20)
        );

        return CompanyResource::collection($companies->items());
    }

    /**
     * @param Request        $request
     * @param CompanyService $companyService
     * @return CompanyResource|JsonResponse
     * @throws ValidationException
     * @throws \Throwable
     */
    public function store(Request $request, CompanyService $companyService): CompanyResource|JsonResponse
    {
        $this->validate($request, [
            'title'       => 'required',
            'phone'       => 'required|string|regex:/\+?\d+/m',
            'description' => 'required|string',
        ]);

        $data    = StoreCompanyData::fromRequest($request->all());
        $company = $companyService->store(Auth::user(), $data);

        return CompanyResource::make($company)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}