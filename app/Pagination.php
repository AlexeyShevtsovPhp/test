<?php

namespace app;

class Pagination
{
    private int $totalPages;

    function __construct($totalPages)
    {
        $this->totalPages = $totalPages;
    }

    /**
     * @param int $page
     * @return int
     */
    function getPreviousPage(int $page): int
    {
        return $page > 0 ? $page - 1 : 0;
    }

    /**
     * @param int $page
     * @return int
     */
    function getNextPage(int $page): int
    {
        return $page < $this->totalPages - 1 ? $page + 1 : $this->totalPages - 1;
    }
}
