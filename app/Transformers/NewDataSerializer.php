<?php

namespace App\Transformers;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Pagination\PaginatorInterface;

class NewDataSerializer extends ArraySerializer
{
    public function collection($resourceKey, array $data)
    {
        if($resourceKey == 'disable')
        {
            return $data;
        }

        return ['data' => $data];
    }

    public function item($resourceKey, array $data)
    {
        return $data;
    }

    /**
     * Serialize the meta.
     *
     * @param array $meta
     *
     * @return array
     */
    public function meta(array $meta)
    {
        if (empty($meta)) {
            return [];
        }

        return ['meta' => $meta];
    }

    public function paginator(PaginatorInterface $paginator)
    {
        $currentPage = (int) $paginator->getCurrentPage();
        $lastPage = (int) $paginator->getLastPage();
        $pagination = [
            'total' => (int) $paginator->getTotal(),
            'count' => (int) $paginator->getCount(),
            'per_page' => (int) $paginator->getPerPage(),
            'current_page' => $currentPage,
            'total_pages' => $lastPage,
        ];
        $pagination['links'] = [];
        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->getUrl($currentPage - 1);
        }
        if ($currentPage < $lastPage) {
            $pagination['links']['next'] = $paginator->getUrl($currentPage + 1);
        }
        return ['pagination' => $pagination];
    }

    
}