<?php

setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR', 'fr', 'fr', 'fra', 'fr_FR@euro');
$monthsArray = [1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'];

if (isset($_GET['month']) && $_GET['year']) {
    /*  Récupère les valeurs mois et années de mes inputs  */
    $numMonth = intval($_GET['month']);
    $numYear = intval($_GET['year']);

    $numdays =   cal_days_in_month(CAL_GREGORIAN, $numMonth, $numYear);
    $dayWeek = date('N', mktime(0, 0, 0, $_GET['month'], 1, $_GET['year']));
} else {
    echo '';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP-Calendrier </title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <header>

        <h2>Calendrier</h2>
    </header>


    <form action="" method="get">


        <select name="month" size="1">
            <option value="month" selected disabled>Choississez un Mois</option>

            <?php
            foreach ($monthsArray as $index => $months) {
                echo '<option value="' . $index . '">' . $months . '</option>';
            }
            ?>

        </select>
        <select name="year" size="1">
            <option value="year" selected disabled>Choississez Une année</option>
            <?php
            for ($date = 1990; $date <= 2020; $date++) {
                echo '<option value="' . $date . '">' . $date . '</option>';
            }
            ?>

        </select>

        <input type="submit" value="Valider">

    </form>

    <?php if (isset($_GET['month']) && isset($_GET['year'])) { ?>

        <table>
            <caption><a id="prev"> Mois Précédent </a><?= $monthsArray[$numMonth]  . ' ' . $_GET['year']; ?><a id="next"> Mois Suivant </a></caption>
            <tr>
                <th>Lundi</thr>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
                <th>Dimanche</th>
            </tr>

            <?php
            $day = 1;
            for ($numcase = 1; $numcase <= $numdays + $dayWeek - 1; $numcase++) {

                if ($numcase >= $dayWeek) {
                    echo '<td>' . $day++ . '</td>';
                } else {
                    echo '<td style="background-color:whitesmoke"></td> ';
                }

                if ($numcase % 7 == 0) {
                    echo '</tr><tr>';
                }
            }
            ?>

        </table>

    <?php } else { ?>
        <h4><?= 'SELECTIONNER UNE DATE' ?></h4>
    <?php } ?>


    <script>
        var btnprev = document.getElementById('prev');
        var btnnext = document.getElementById('next');
        var mois = <?php echo $numMonth ?>;
        var year = <?php echo $numYear ?>;

        btnprev.addEventListener('click', function() {

            mois--;

            if (mois < 1) {
                year--;
                mois = 12;
            }
            console.log(mois);
            window.location.replace("?month=" + mois + "&year=" + year);

        });

        btnnext.addEventListener('click', function() {

            mois++;

            if (mois > 12) {
                year++;
                mois = 1;
            }

            console.log(mois);
            window.location.replace("?month=" + mois + "&year=" + year);
        });
    </script>

</body>

</html>