<?php

namespace App\Services\Company;

use App\DataObjects\StoreCompanyData;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Contracts\CompanyRepositoryContract;
use Illuminate\Contracts\Pagination\Paginator;

class CompanyService
{
    public function __construct(
        private CompanyRepositoryContract $companyRepository
    )
    {
    }

    /**
     * @param User             $user
     * @param StoreCompanyData $data
     * @return Company
     * @throws \Throwable
     */
    public function store(User $user, StoreCompanyData $data): Company
    {
        $company = $this->companyRepository->getBlank($data->toStore());
        $company->user()->associate($user);
        $this->companyRepository->save($company);

        return $company;
    }

    /**
     * @param int $userId
     * @param int $page
     * @param int $perPage
     * @return Paginator
     */
    public function paginated(int $userId, int $page, int $perPage): Paginator
    {
        return $this->companyRepository->paginated($userId, $page, $perPage);
    }
}