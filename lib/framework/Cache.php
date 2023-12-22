<?php

namespace IShop\Framework;

class Cache
{
    use TSingleton;

    private string $path = CACHE;

    public function set(string $key, $data, int $ttl = 3600): bool
    {
        if ($ttl == 0) {
            return false;
        }
        $content['data'] = $data;
        $content['end_time'] = time() + $ttl;
        $content = serialize($content);
        $filename = $this->getFilePath($key);
        return (bool)file_put_contents($filename, $content);

    }

    private function getFilePath(string $key): string
    {
        return $this->path . DS . md5($key) . '.txt';
    }

    public function get(string $key)
    {
        $filename = $this->getFilePath($key);
        if (!file_exists($filename)) {
            return false;
        }
        $content = unserialize(file_get_contents($filename));
        if (time() > $content['end_time']) {
            unlink($filename);
            return false;
        }
        return $content['data'];
    }

    public function delete(string $key): bool
    {
        $filename = $this->getFilePath($key);
        if (file_exists($filename)) {
            return unlink($filename);
        }
        return false;
    }
}

