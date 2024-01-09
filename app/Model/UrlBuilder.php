<?php

namespace IShop\Model;

class UrlBuilder
{
    private string $url;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
    }

    public function build($field, $value)
    {
        $url = parse_url($this->url);
        $path = $url['path'];
        $query = $url['query'] ?? '';
        $params = [];
        if ($query) {
            parse_str($query, $params);
            $params[$field] = $value;
            $path .= '?' . http_build_query($params);
        } else {
            $params[$field] = $value;
            $path .= '?' . http_build_query($params);
        }
        return $path;
    }
}