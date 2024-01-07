<?php

namespace IShop\Framework;

abstract class AbstractController
{
    protected array $route = [];
    protected $view;
    protected $model;
    protected string $templateName;
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
        $this->data = array_merge($this->data, $data);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setMeta(array $meta)
    {
        $this->meta = array_merge($this->meta, $meta);
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function getParameters($key = null)
    {
        if (is_null($key)) {
            return $this->route['parameters'];
        }

        return $this->route['parameters'][$key] ?? [];
    }

    /**
     * @return bool
     */
    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}

