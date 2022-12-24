<?php

$elements_amount = null;
$my_move = null;
$players_amount = null;

if (isset($_POST['players_amount'])) {
    $players_amount = (int)$_POST['players_amount'];
}
if (isset($_POST['elements_amount'])) {
    $elements_amount = (int)$_POST['elements_amount'];
}
if (isset($_POST['my_move'])) {
    $my_move = (int)$_POST['my_move'];
}

if (isset($players_amount) && isset($elements_amount) && isset($my_move)) {
    if ($players_amount < 2) {
        echo "<p class='rsp'><strong>Ошибка.</strong> Количество игроков должно быть целым числом не менее 2</p>";
    }
    else {
        if ($elements_amount < 3 or $elements_amount%2 == 0) {
            echo "<p class='rsp'><strong>Ошибка.</strong> Количество элементов должно быть целым нечетным числом не менее 3</p>";
        }
        else {
            if ($elements_amount % 2 == 0)
                $elements_amount++;
            $comp_move = [];
            for ($i = 1; $i <= $players_amount - 1; $i++) {
                $comp_move[$i] = mt_rand(1, $elements_amount);
            }
            function win_interval($my_move, $elements_amount)
            {
                $win = [];
                $var = ($elements_amount - 1) / 2;
                for ($i = $my_move + 1, $k = 0; $i <= $my_move + $var && $i <= $elements_amount; $i++) {
                    $win[] = $i;
                    $k++;
                }
                for ($i = 1; $i <= $var - $k; $i++) {
                    $win[] = $i;
                }
                return $win;
            }

            function lose_interval($my_move, $elements_amount)
            {
                $lose = [];
                $var = ($elements_amount - 1) / 2;
                for ($i = $my_move - 1, $k = 0; $i >= 1 && $i >= $my_move - $var; $i--) {
                    $lose[] = $i;
                    $k++;
                }
                for ($i = $elements_amount; $i > $elements_amount - ($var - $k); $i--) {
                    $lose[] = $i;
                }
                return $lose;
            }

            $w = 0;
            foreach ($comp_move as $value) {
                if (in_array($value, win_interval($my_move, $elements_amount))) {
                    $w++;
                }
            }
            $l = 0;
            foreach ($comp_move as $value) {
                if (in_array($value, lose_interval($my_move, $elements_amount))) {
                    $l++;
                }
            }

            if ($my_move >= 1 && $my_move <= $elements_amount) {
                if ($w > 0 && $l == 0) {
                    echo "<p class='rsp'>Ваш ход: <strong>" . $my_move . ".</strong> Ходы других игроков (компьютера): " . implode(', ', $comp_move) . ". <strong>Вы выйграли</strong></p>";
                }

                if ($w == 0 && $l > 0) {
                    echo "<p class='rsp'>Ваш ход: <strong>" . $my_move . ".</strong> Ходы других игроков (компьютера): " . implode(', ', $comp_move) . ". <strong>Вы проиграли</strong></p>";
                }

                if ($w == 0 && $l == 0) {
                    echo "<p class='rsp'>Ваш ход: <strong>" . $my_move . ".</strong> Так же походили другие игроки (компьютер). <strong>Ничья</strong></p>";
                }

                if ($w > 0 && $l > 0) {
                    echo "<p class='rsp'>Ваш ход: <strong>" . $my_move . ".</strong> Другие игроки (компьютер) сделали следующие ходы: " . implode(', ', $comp_move) . ". <strong>Ничья</strong></p>";
                }
                echo "<br><a class='again' href='/index.php'>Ввести другие параметры игры</a>";
            } else echo "<p class='rsp'><strong>Ошибка.</strong> Ваш ход должен находиться в диапазоне от 1 до " . $elements_amount . "</p>";
        }
    }
}