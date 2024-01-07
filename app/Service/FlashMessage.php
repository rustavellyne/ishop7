<?php

namespace IShop\Service;

class FlashMessage
{
    const SUCCESS = 'success';
    const ERROR = 'danger';
    const INFO = 'info';

    public static function addMessage($message, $type = self::INFO): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }

        $_SESSION['flash_messages'][] = [
            'message' => $message,
            'type' => $type,
        ];
    }

    public static function getMessages(): array
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $messages = $_SESSION['flash_messages'] ?? [];
        unset($_SESSION['flash_messages']);

        return $messages;
    }
}