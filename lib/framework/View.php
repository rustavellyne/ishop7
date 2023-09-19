<?php

namespace IShop\Framework;

class View
{
    private string $layoutName;
    private string $templateName;

    public function __construct(string $templateName, ?string $layout = null)
    {
        $this->templateName = strtolower($templateName);
        $this->layoutName = strtolower($layout ?? LAYOUT);
    }

    public function renderTemplate(array $data = []): string
    {
        $path = VIEWS . DS . 'templates' . DS . $this->templateName . '.php';
        $content = $this->loadViewFile($path, $data);
        return $content;
    }

    public function renderPage(array $data = [], array $meta = []): string
    {
        $layoutPath = VIEWS . DS . 'layouts' . DS . $this->layoutName . '.php';
        $templateContent = $this->renderTemplate($data);
        $pageData = [
            'content' => $templateContent,
            'head' => $meta['head'],
            'meta' => $meta['meta'],
        ];
        $fullPage = $this->loadViewFile($layoutPath, $pageData);
        return $fullPage; 
    }

    private function loadViewFile(string $path, array $data = []): string
    {
        if (!file_exists($path)) {
            throw new \Exception("Cannot find file: $path");
        }
        extract($data);
        ob_start();
        include $path;
        $content = ob_get_clean();
        return $content;
    }

    public function setLayout(string $layoutName): void
    {
        $this->layoutName = $layoutName;
    }

    public function setTemplate(string $templateName): void
    {
        $this->templateName = $templateName;
    }
}

