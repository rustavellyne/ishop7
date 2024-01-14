<?php

namespace IShop\Model;

class PaginationModel
{
    protected int $total;
    protected int $currentPage;
    protected int $perPage;
    protected int $pages;
    protected int $linksQty = 5;
    private UrlBuilder $urlBuilder;
    protected array $pagination = [
        'prev' => [
            'state' => '',
            'value' => '',
            'label' => 'Previous',
        ],
        'numbers' => [],
        'next' => [
            'state' => '',
            'value' => '',
            'label' => 'Next',
        ]
    ];

    public function __construct(int $total, int $page, int $perPage)
    {
        $this->urlBuilder = new UrlBuilder();
        $this->total = $total;
        $this->pages = ceil($total / $perPage) ?: 1 ;
        $this->currentPage = $this->getCurrentPage($page);
        $this->perPage = $perPage;
        $this->setPrevState();
        $this->setNextState();
        $this->setNumbers();
        $this->setAmountInfo();
    }

    protected function setPrevState()
    {
        $page = $this->currentPage > 1 ? $this->currentPage - 1 : 0;
        $this->pagination['prev']['value'] = $this->urlBuilder->build('page', $page);
        $this->pagination['prev']['state'] = $this->currentPage > 1 ? '' : 'disabled';
    }

    protected function setNextState()
    {
        $page =  $this->currentPage >= $this->pages ? 0 : $this->currentPage + 1;
        $this->pagination['next']['value'] = $this->urlBuilder->build('page', $page);
        $this->pagination['next']['state'] = $this->currentPage >= $this->pages ? 'disabled' : '';
    }

    protected function setAmountInfo()
    {
        $this->pagination['amount'] = [
            'totals' => $this->total,
            'start' => ($this->currentPage - 1) * $this->perPage + 1,
            'end' => ($this->currentPage - 1) * $this->perPage + $this->perPage
        ];
    }

    protected function setNumbers()
    {
        $numbers = [];
        $start  = $this->currentPage - ($this->currentPage % $this->linksQty) ?: 1;
        $finish = min($start + $this->linksQty, $this->pages);
        for ($i = $start; $i < $finish; $i++) {
            $numbers[] = [
                'state' => $this->currentPage === $i ? 'active' : '',
                'value' => $this->urlBuilder->build('page', $i),
                'label' => $i,
            ];
        }
        $this->pagination['numbers'] = $numbers;
    }

    public function getCurrentPage(int $page): int
    {
        if (!$page || $page <= 1) return 1;
        if ($page > $this->pages) return $this->pages;
        return $page;
    }

    public function getPagination(): array
    {
        return $this->pagination;
    }

}