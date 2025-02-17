<?php

class CommentOther
{

    private int $number;

    function __construct($number)
    {

        $this->number = $number;

    }

    function add(int $a): self
    {
        $this->number += $a;
        return $this;
    }

    function minus(int $b): self
    {
        $this->number -= $b;
        return $this;
    }

    function multiply(int $c): self
    {
        $this->number *= $c;
        return $this;
    }

    public function __toString(): string
    {
        return $this->number;
    }
}

$value = 5;
$object = new A($value);
echo "Сумма: " . $object->add(10) . "\n";// 15
$object = new A($value);
echo "Сумма-минус: " . $object->add(10)->minus(8) . "\n"; // 7
$object = new A($value);
echo "Сумма-минус-умножение: " . $object->add(100)->minus(8)->multiply(15) . "\n";

$calculator = new A(5);
echo "Умножение: " . $calculator->multiply(5) . "\n";
