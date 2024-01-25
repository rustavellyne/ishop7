<?php

namespace IShop\Service;

class ImageLoader
{
    private array $files = [];
    private array $imagesNames = [];
    private string $targetDir = ROOT . '/public/images/';
    private array $fileTypes = ['jpg', 'png', 'jpeg', 'gif'];
    private const MAX_FILE_SIZE = 500000;

    public function __construct(array $files)
    {
        $files = $this->reformatFiles($files);
        $this->validateFiles($files);
        $this->moveUploadedFiles();
    }

    private function moveUploadedFiles(): void
    {
        if (empty($this->files)) return;
        foreach ($this->files as $imageGroup => $images) {
            foreach ($images as $index => $image) {
                $fileName = $this->generateFileName($image['tmp_name'], $this->getFileExtension($image['type']));
                $target_file = $this->targetDir . $fileName;
                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    $this->imagesNames[$imageGroup][] = $fileName;
                }
            }
        }
        return;
    }

    private function generateFileName(string $name, string $ext): string
    {
        return sprintf("%s.%s", md5($name), $ext);
    }

    private function validateFiles(array $files): void
    {
        $result = [];
        foreach ($files as $imageGroup => $images) {
            foreach ($images as $index => $image) {
                if ($this->validateImage($image)) {
                    $result[$imageGroup][$index] = $image;
                }
            }
        }
        $this->files = $result;
    }

    private function validateImage(array $image): bool
    {
        if ($image['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if ($image['size'] > self::MAX_FILE_SIZE) {
            return false;
        }

        $imageExt = $this->getFileExtension($image['type']);
        if (!in_array($imageExt, $this->fileTypes)) {
            return false;
        }

        return true;
    }

    private function getFileExtension($mime)
    {
        return explode('/', $mime )[1];
    }

    private function reformatFiles(array $files): array
    {
        $result = [];
        foreach ($files as $imageGroup => $item) {
            if (!is_array($item['name'])) {
                $result[$imageGroup][] = $item;
            } else {
                foreach ($item as $fileKey => $fileValues) {
                    foreach ($fileValues as $i => $val) {
                        $result[$imageGroup][$i][$fileKey] = $val;
                    }
                }
            }
        }
        return $result;
    }

    public function getImagesNames(): array
    {
        return $this->imagesNames;
    }
}