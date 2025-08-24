<?php 

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginate {

    public static function paginateFromCollection(Collection $collection, int $page = 1, int $perPage = 20): LengthAwarePaginator {
        return new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page
        );
    }

}