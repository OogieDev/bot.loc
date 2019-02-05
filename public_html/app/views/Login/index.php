<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo $this->getMeta() ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/libs/materialize/materialize.min.css">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col s12 form-wrapper">
            <div class="form">
                <h5>Авторизация</h5>
                <form action="<?= $action ?>" method="post">
                    <div class="input-field">
                        <input required id="login" type="text" name="login" class="validate">
                        <label for="login">Логин</label>
                    </div>
                    <div class="input-field">
                        <input required id="password" type="password" name="password" class="validate">
                        <label for="password">Пароль</label>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="/libs/materialize/materialize.min.js"></script>
</body>
</html>