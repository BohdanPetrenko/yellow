<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryContract;
use Illuminate\Contracts\Pagination\Paginator;

class CompanyRepository implements CompanyRepositoryContract
{
    /**
     * @param Company $company
     */
    public function __construct(
        private Company $company
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getBlank(array $attributes = []): Company
    {
        return $this->company->newInstance()->setRawAttributes($attributes);
    }

    /**
     * @inheritDoc
     */
    public function save(Company $company): bool
    {
        return $company->saveOrFail();
    }

    /**
     * @inheritDoc
     */
    public function paginated(int $userId, int $page, int $perPage): Paginator
    {
        return $this->company
            ->newQuery()
            ->where('user_id', $userId)
            ->simplePaginate(perPage: $perPage, page: $page);
    }
}