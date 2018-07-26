<?php

$pattern = '/[0-9]{3}/';
$subject = 'ascn2m344b5bnhh13';
$m1 = $m2 = array();
$num = preg_match($pattern, $subject, $m1);
$num2 = preg_match_all($pattern, $subject, $m2);
show($m1);
echo '<hr/>';
show($m2);

echo '<hr />匹配到的次数<br/>';
show($num);
echo '<hr />';
show($num2);

/**定义一个展示传递进来值得函数*/
function show($val = null)
{
    if (empty($val)) {
        echo 'null';
        return;
    }
    if (is_array($val) || is_object($val)) {
        echo '<pre>';
            var_dump($val);
        echo  '<pre />';
        return;
    }
    if ($val) {
        echo $val;
    }
}