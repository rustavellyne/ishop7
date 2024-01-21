<?php

namespace IShop\Controller\Admin;

use IShop\Model\CategoryModel;
use IShop\Service\FlashMessage;
use Valitron\Validator;

class CacheController extends AbstractAdminController
{
    public function index()
    {
        $caches = [
            'filters'    => 'Filters',
            'categories' => 'Categories',
            'all'        => 'All'
        ];
        $data = compact('caches');
        $this->setData($data);
        $this->setMeta(['general' => ['page' => 'settings']]);
        echo $this->renderPage();
    }

    public function clean()
    {
        $parameters = $this->getParameters('GET');
        if (!isset($parameters['key'])) {
            FlashMessage::addMessage('Wrong parameter', FlashMessage::ERROR);
            redirect();
        }
        $cacheModel = [
            'filters'    => 'IShop7_category_filters',
            'categories' => 'IShop7_menu',
            'all'        => 'all'
        ];
        if (!isset($cacheModel[$parameters['key']])) {
            FlashMessage::addMessage('Wrong cache key', FlashMessage::ERROR);
            redirect();
        }
        $key = $cacheModel[$parameters['key']];
        $cache = \IShop\Framework\Cache::getInstance();
        if ($key === 'all') {
            foreach ($cacheModel as $key => $value) {
                $cache->delete($value);
            }
        } else {
            $cache->delete($key);
        }

        FlashMessage::addMessage('Cache Cleaned', FlashMessage::SUCCESS);
        redirect('/admin/cache');
    }
}
