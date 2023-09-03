<?php

namespace IShop\Framework;

abstract class AbstractController
{
    protected array $route = [];

    protected $view;

    protected $model;

    protected array $data = [];

    protected array $meta = [];

    public function __construct(array $route)
    {
        $this->route = $route;
    }
    
    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setMeta(array $meta)
    {
        $this->meta = $meta;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }
}

