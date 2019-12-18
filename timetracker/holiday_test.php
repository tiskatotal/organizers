<?php

// Require the composer auto loader
require '../vendor/autoload.php';

$year = 2020;

// Use the factory to create a new holiday provider instance
$holidays           = Yasumi\Yasumi::create('Spain', $year);
$holidaysInDecember = $holidays->between(
                        new DateTime('12/01/' . $year),
                        new DateTime('12/31/' . $year)
                      );
// We then can see the following holidays in Spain in December:

foreach ($holidaysInDecember as $holiday) {
    echo $holiday . ' - ' . $holiday->getName() . PHP_EOL;
}

// 2019-12-08 - Immaculate Conception
// 2019-12-25 - Christmas
// 2019-12-26 - St. Stephen's Day
echo $holidaysInDecember->count();

// 3
?>