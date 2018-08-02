<?php
/**
 * 题目描述：给定一个字符串，要求把字符串前面的若干个字符移动到字符串的尾部，如把字符串“abcdef”前面的2个字符'a'和'b'移动到字符串的尾部，
 * 使得原字符串变成字符串“cdefab”。请写一个函数完成此功能，要求对长度为n的字符串操作的时间复杂度为 O(n)，空间复杂度为 O(1)。
 * author:crazy
 * 暴力移动方法
*/
function leftShiftWord($string, $n)
{
    /**获取第一个字符*/
    $firstWorld = $string{0};
    for ($i = 1; $i < $n; $i++) {
        $string{$i-1} = $string{$i};
    }
    $string{$n-1} = $firstWorld;
    return $string;
}

echo leftShiftWord('abcdef', strlen('adcdef'));
