<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $errno ?></title>
</head>
<body>
<style>
* {
    margin: 0;
    padding: 0;
}
.error_wrap {
    max-width: 1170px;
    padding-top: 30px;
    padding-bottom: 30px;
    padding-left: 15px;
    padding-right: 15px;
    margin: auto;
    background: #f2f2f2;
}
</style>
    
    <div class="error_wrap">
        <h3>Тип ошибки: <?= $errno ?></h3>
        <h3>Текст: <?= $errstr ?></h3>
        <h3>Файл: <?= $errfile ?></h3>
        <h3>Строка: <?= $errline ?></h3>
    </div>

</body>
</html>