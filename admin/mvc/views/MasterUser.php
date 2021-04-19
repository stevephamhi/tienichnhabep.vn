<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php {{ echo $base->getBaseURLAdmin(); }} ?>" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/config/helper.css">
    <link rel="stylesheet" href="./public/css/style/user.css">
    <title>Quản lý đăng nhập</title>
</head>
<body>
    <div id="user_app">
        <?php {{ $base->getLayOut($layOut); }} ?>
    </div>
</body>
</html>