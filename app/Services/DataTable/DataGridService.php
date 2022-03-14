<?php

namespace App\Services\DataTable;

class DataGridService
{
    /*
     * Get Filters
     * */
    public function getFilters(): array
    {
        $filters = request()->query('filter');
        $result  = [];
        if (isset($filters[0]) && is_array($filters[0])):
            foreach ($filters as $index => $filter):
                if ($index % 2 == 0):
                    $filterArr = json_decode($filter, true);
                    if (is_array($filterArr)):
                        $result[] = [@$filterArr[0] => @$filterArr[2]];
                    endif;
                endif;
            endforeach;
        elseif (isset($filters)):
            $result = [@$filters[0] => @$filters[2]];
        endif;
        request()->merge($result);
        return $result;
    }

    /*
     * Get Sorts
     * */
    public function getSorts(): array
    {
        $sorts  = request()->query('sort');
        $result = [];
        if (is_array($sorts)):
            foreach ($sorts as $sort):
                $sortArr  = json_decode($sort, true);
                $result[] = [$sortArr['selector'] => $sortArr['desc'] ? 'desc' : 'asc'];
            endforeach;
        endif;
        request()->merge(['sort' => $result]);
        return $result;
    }

    /*
     * Get Page
     * */
    public function getPage(): float|int
    {
        $skip = request()->query('skip');
        $take = request()->query('take');
        $page = 1;
        if ($skip > 0):
            $page = ceil($skip / $take) + 1;
        endif;
        request()->merge(['page' => $page]);
        return $page;
    }

    /*
     * Get Limit
     * */
    public function getLimit(): array|string|null
    {
        $take = request()->query('take');
        request()->merge(['limit' => $take]);
        return $take;
    }

    /*
     * Start
     * */
    public function start()
    {
        $this->getFilters();
        $this->getSorts();
        $this->getPage();
        $this->getLimit();
    }
}
