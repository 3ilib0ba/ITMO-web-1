<?php

session_start();

if (!isset($_SESSION['requests']) || !is_array($_SESSION['requests'])) {
    $_SESSION['requests'] = [];
}

?>

<html lang="ru">
<head>
    <title>web-first</title>
    <meta charset="utf-8"/>
    <meta name="author" content="3iliboba"/>
    <style>
        body {
            font-size: 20px;
            min-width: 50%;
            background-image: url("corgi.jpg");
            background-size: 100%;
            /*background-size: contain;*/
            background-repeat: repeat-y, no-repeat;
        }

        header {
            font-family: fantasy;
            color: #344a91;
            line-height: 125%;
            font-size: 50px;
            font-weight: normal;
            text-align: center;
            text-shadow: -1px -1px 3px #7c3333;
        }

        h3 {
            color: darkred;
            font-size: 30px;
            position: fixed;
            bottom: 0;
        }

        table {
            width: 100%;
            height: 100%;
        }

        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .animated-word {
            font-family: Helvetica;
            letter-spacing: 0.4em;
            font-weight: 600;
            font-size: 50px;
            text-align: center;
            color: #202125;
            cursor: pointer;
            max-width: 500px;
            width: 100%;
            outline: 70px solid;
            outline-color: rgba(71, 126, 232,0.5);
            outline-offset: 10px;
            transition: all 600ms cubic-bezier(0.2, 0.5, 0, 0.8);
        }

        .animated-word:hover {
            color: rgba(91, 196, 132, 0.7);
            outline-color: rgba(171, 66, 22, 0);
            outline-offset: 590px;
        }

        body > h7 {
            text-align: center;
        }

        #tableWithResults {
            width: 70%;
        }

        #tableWithResults:first-child {
            padding: 5px;
            overflow-y: scroll;
        }

        tr.red {
            background-color: red;
        }

        tr.green {
            background-color: green;
        }

    </style>
</head>
<body>
<table border="1" cellpadding="4" cellspacing="4">
    <tr>
        <td colspan="2" height="20%">
            <header>
                Иванов Евгений Дмитриевич, p3213, вариант 13110
            </header>
        </td>
    </tr>

    <tr>
        <td colspan="1" rowspan="2">
            <table>
                <tr>
                    <td height="150px">
                        <h7><label for="coordinateY">Choose a coordinate Y: </label></h7>
                        <input type="text" id="coordinateY" name="coordinateY" maxlength="5"
                               placeholder="От -5 по 3">
                    </td>
                    <td width="70%" height="40%">
                        <h7>Choose a parameter R:</h7>
                        <select id="coordinateR" name="coordinateR">
                            <option value="1">1</option>
                            <option value="1.5">1.5</option>
                            <option value="2">2</option>
                            <option value="2.5">2.5</option>
                            <option value="3">3</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h7>Choose a coordinate X:</h7>
                        <br>
                        <input name="coordinateX" type="radio" value="-3"> -3
                        <input name="coordinateX" type="radio" value='-2'> -2
                        <input name="coordinateX" type="radio" value="-1"> -1
                        <input name="coordinateX" type="radio" value="0"> 0
                        <input name="coordinateX" type="radio" value="1"> 1
                        <br>
                        <input name="coordinateX" type="radio" value="2"> 2
                        <input name="coordinateX" type="radio" value="3"> 3
                        <input name="coordinateX" type="radio" value="4"> 4
                        <input name="coordinateX" type="radio" value="5"> 5
                    </td>
                    <td width="60%">
                        <p align="right"><div class="container"><button type="submit" class="animated-word"
                                                 onclick="submit()">Check</button></div></p>
                    </td>
                </tr>
            </table>
        </td>
        <td width="10px" height="10px">
            <img src="grap.png" alt="Координатная плоскость" class="diagram">
        </td>
    </tr>
    <tr>
        <td bgcolor="gray">
            <p id="logs-request">Your last try:</p>
        </td>
    </tr>
<!--    <tr>-->
<!--        <td>-->
<!--            <p><button type="submit" onclick="deleteSession()">Delete-results</button></p>-->
<!--        </td>-->
<!--    </tr>-->
    <tr>
        <td height="30%" colspan="2">
            <table id="tableWithResults" align="center" border="1px">
                <tr height="30px">
                    <th>X</th>
                    <th>Y</th>
                    <th>R</th>
                    <th>CURRENT-TIME</th>
                    <th>RUNNING-TIME</th>
                    <th>RESULT</th>
                </tr>
                <?php
                foreach ($_SESSION["requests"] as $request) {
                ?>
                <tr <?php echo $request["res"] == true ? "class='green'" : "class='red'";?> height="60px">
                    <td><?=$request["x"]?></td>
                    <td><?=$request["y"]?></td>
                    <td><?=$request["r"]?></td>
                    <td><?=$request["date"]?></td>
                    <td><?=$request["runtime"]?></td>
                    <td><?php echo $request["res"] == true ? "Попадание" : "Промах"; ?></td>
                </tr>
                <?php
            }
            ?>
            </table>
        </td>
    </tr>

</table>
<script src="validation.js"></script>
<script src="other-editing/page-content.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>