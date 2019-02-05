<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo $this->getMeta() ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/libs/materialize/materialize.min.css">
    <link rel="stylesheet" href="/css/admin.css">
    <script src="/libs/jquery.js"></script>
</head>
<body>

<ul id="slide-out" class="sidenav sidenav-fixed">
      <li class="<?php if (isset($nav_active)) { if($nav_active == "day") echo "active"; } ?>"><a href="/admin">Дни недели</a></li>
      <li class="<?php if (isset($nav_active)) { if($nav_active == "lesson") echo "active"; } ?>"><a href="/admin/dashboard/edit-lesson">Предметы</a></li>
</ul>
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
<main>
    <?= $content ?>
</main>


<script src="/libs/materialize/materialize.min.js"></script>
<script src="/js/common.js"></script>
</body>
</html>