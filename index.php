<?php session_start() ?>
<!doctype html>
<head>
    <title>Игра Камень, ножницы, бумага</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Камень, ножницы, бумага</h1>
        <p class="insert">Игра рассчитана на любое количество игроков (не менее двух) и элементов (не менее трех)</p>
        <form class="rsp" action="" method="POST">
            <div class="rsp">
                <p class="rsp">Перед тем, как начать, зададим параметры игры.</p>
                <label class="insert">Введите количество игроков: <input class="rsp" type="text" name="players_amount" value="<?php if(isset($_POST['players_amount'])) echo (int)$_POST['players_amount']; ?>"></label>
                <div class="clear"></div>
                <label class="insert">Введите количество элементов: <input class="rsp" type="text" name="elements_amount" value="<?php if(isset($_POST['elements_amount'])) echo (int)$_POST['elements_amount']; ?>"></label>
                <div class="clear"></div>
            </div>
            <div class="rsp">
                <p class="rsp">Теперь можно сделать ход, введите номер элемента. Он должен быть в диапазоне начиная от единицы и не превышать количества элементов в игре.</p>
                <label class="insert">Ваш ход: <input class="rsp" name="my_move" type="text" value="<?php if(isset($_POST['my_move'])) echo (int)$_POST['my_move']; ?>"></label>
                <div class="buttons">
                    <input type="submit" value="Сделать ход">
                </div>
            </div>
        </form>
            <?php include '2.php';?>
    </div>
</body>