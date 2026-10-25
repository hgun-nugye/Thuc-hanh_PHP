<?php
$a = [10, 20, 30];
echo count($a);
echo "<br>";
// 3
$a = ["PHP", "Java", "C++"];
var_dump(in_array("PHP", $a));
// bool(true)
echo "<br>";

$a = [1, 2];
array_push($a, 3, 4);
print_r($a);
// [1, 2, 3, 4]
echo "<br>";

$a = [10, 20, 30];
$x = array_pop($a);
echo $x; // 30
print_r($a); // [10, 20]

echo "<br>";

$a = [2, 3];
array_unshift($a, 1);
print_r($a);
// [1, 2, 3]
echo "<br>";


$a = [10, 20, 30];
$x = array_shift($a);
echo $x; // 10
print_r($a); // [20, 30]

echo "<br>";

$a = ["PHP", "HTML"];
$b = ["CSS", "JS"];
$c = array_merge($a, $b);
print_r($c);
// PHP, HTML, CSS, JS
echo "<br>";

$a = [1, 2, 2, 3, 1];
print_r(array_unique($a));
// Các giá trị: 1, 2, 3

echo "<br>";
$a = [5, 2, 8, 1];
sort($a);
print_r($a);
// [1, 2, 5, 8]

echo "<br>";

$a = [5, 2, 8, 1];
rsort($a);
print_r($a);
// [8, 5, 2, 1]
echo "<br>";

$numbers = [1, 2, 3, 4, 5, 6];

$soChan = array_filter($numbers, function ($n) {
    return $n % 2 == 0;
});
$soChan = array_values($soChan);
print_r($soChan);
