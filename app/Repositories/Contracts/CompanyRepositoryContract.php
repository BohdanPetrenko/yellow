<?php

namespace App\Repositories\Contracts;

use App\Models\Company;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyRepositoryContract
{
    /**
     * @param array $attributes
     * @return Company
     */
    public function getBlank(array $attributes = []): Company;

    /**
     * @param Company $company
     * @return bool
     * @throws \Throwable
     */
    public function save(Company $company): bool;

    /**
     * @param int $userId
     * @param int $page
     * @param int $perPage
     * @return Paginator
     */
    public function paginated(int $userId, int $page, int $perPage): Paginator;
}