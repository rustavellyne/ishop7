<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Помилка сервера 500</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            color: #e74c3c;
        }

        p {
            color: #333;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            color: #3498db;
        }
    </style>
</head>
<body>
    <h1>Помилка</h1>
    <p>
        <b>
            Код помилки:
        </b>
        <?= $errno ?>
    </p>
    <p>
        <b> Текст помилки:</b>
        <?= $errstr ?>
    </p>
    <p>
         <b> File</b>
        <?= $errfile ?>
    </p>
    <p>
        <b>
            Line:
        </b>
        <?= $errline ?>
    </p>
    <p>Повернутися на <a href="/">головну сторінку</a></p>
    <pre>
        <?= $traceback; ?>
    </pre>
</body>
</html>

