<?php

function fib(int $n): array
{
    $a = "0";
    $b = "1";
    $arrayNumbers = ['1' => $a, '2' => $b];


    for ($i = 3; $i <= $n; $i++) {
        $sum = addBigNumbers($a, $b);
        $arrayNumbers[] = $sum;
        $a = $b;
        $b = $sum;
    }

    return $arrayNumbers;
}


function addBigNumbers(string $a, string $b): string
{
    $a = str_pad($a, strlen($b), '0', STR_PAD_LEFT);
    $b = str_pad($b, strlen($a), '0', STR_PAD_LEFT);

    $result = '';
    $carry = 0;

    for ($i = strlen($a) - 1; $i >= 0; $i--) {
        $sum = (int)$a[$i] + (int)$b[$i] + $carry;
        $carry = (int)($sum / 10);
        $result = ($sum % 10) . $result;
    }

    if ($carry > 0) {
        $result = $carry . $result;
    }

    return $result;
}

fib('dsd');
