<?php

namespace IShop\Framework;

class View
{
    private string $layoutName;
    private string $templateName;

    public function __construct($templateName, $layout = null)
    {
        $this->template = $templateName;
        $this->layout = $layout ?? LAYOUT;
    }

    private function loadViewFile(string $path, array $data = []): string
    {
        if (!file_exists($path)) {
            throw new \Exception("Cannot find file: $path");
        }
        extract($data);
        include

    }

    public function setLayout(string $layoutName): void
    {
        $this->layoutName = $layoutName;
    }

    public function setTemplate(string $templateName): void
    {
        $this->templateName = $templateName);
    }
}

