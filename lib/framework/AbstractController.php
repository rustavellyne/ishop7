<?php

namespace IShop\Framework;

abstract class AbstractController
{
    protected array $route = [];
    protected $view;
    protected $model;
    protected string $temlateName;
    protected array $data = [];
    protected array $meta = [];

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->templateName = $route['controller'] . DS . $route['action'];
    }

    public function renderPage(): string
    {
        if (is_null($this->view)) {
            $this->view = new \IShop\Framework\View($this->templateName);
        }

        return $this->view->renderPage($this->data, $this->meta);
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

