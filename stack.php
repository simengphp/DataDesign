<?php
$ret = '3+4*5-2';
$index=0;
$numStack = new Stack(); //定义一个数栈
$operStack = new Stack(); //定义一个符号栈
while (true) {
    $val = substr($ret, $index, 1);
    $isNumStr = $operStack->isNumOrOper($val);
    /**判断是数字还是符号*/
    if ($isNumStr) {
        /**如果栈为空那么将直接入栈*/
        if ($operStack->isEmpty()) {
            $operStack->push($val);
        } else {
            //echo $operStack->pop();
            /**判断优先级，运算符*/
            /**获取栈顶的值的优先级*/
            $proVal = $operStack->pro($operStack->getTop());
            /**获取当前符号的优先级*/
            $operY = $operStack->pro($val);
            /**当前的运算符的优先级小于栈顶运算符的优先级，就计算，否则将直接入栈*/
            if ($operY <= $proVal) {
                $num1 = $numStack->pop();
                $num2 = $numStack->pop();
                $operVal = $operStack->pop();
                /**计算好的结果存入数栈*/
                $countNum = $operStack->countNum($num1, $num2, $operVal);
                $numStack->push($countNum);
                /**把当前扫描的符号存入栈中*/
                $operStack->push($val);
            } else {
                $operStack->push($val);
            }
        }
    } else {
        $numStack->push($val);
    }
    $index++;
    if ($index == strlen($ret)) {
        break;
    }
}
/**扫描完毕之后，如果符号栈为空，则循环完毕，否则继续循环*/
while (!$operStack->isEmpty()) {
    $num1 = $numStack->pop();
    $num2 = $numStack->pop();
    $oper = $operStack->pop();
    $ret = $operStack->countNum($num1, $num2, $oper);
    $numStack->push($ret);
}
echo 'ret'.$numStack->getTop();







class Stack
{
    private $top = -1; //定义栈指针的初始指向
    private $maxSize; //栈的最大容量
    private $stack; //栈的容器



    /**构造函数初始化值*/
    public function __construct($maxSize = 15)
    {
        $this->maxSize = $maxSize;
    }

    /**获取栈顶的值，但是不出栈*/
    public function getTop()
    {
        return $this->stack[$this->top];
    }
    /**判断运算符的优先级*/
    public function pro($val)
    {
        if (in_array($val, ['+','-'])) {
            return 0;
        }
        if (in_array($val, ['*','/'])) {
            return 1;
        }
    }

    /**计算*/
    public function countNum($num1, $num2, $oper)
    {
        $ret = 0;
        switch ($oper) {
            case "+":
                $ret = $num1+$num2;
                break;
            case "-":
                $ret = $num2-$num1;
                break;
            case '*':
                $ret = $num1*$num2;
                break;
            case "/":
                $ret = $num2/$num1;
        }
        return $ret;
    }
    /**判断栈里面是否有值*/
    public function isEmpty()
    {
        return $this->top==-1?true:false;
    }

    /**判断这个值是数字还是运算符*/
    public function isNumOrOper($str)
    {
        if (in_array($str, ['+','-','*','/'])) {
            return true;
        } else {
            return false;
        }
    }

    /**入栈操作
     * @param $val入栈的值
     */
    public function push($val)
    {
        /**我们要判断是否已经栈满了，因为指针初始值是—1所以我们最大值-1*/
        if ($this->top == $this->maxSize-1) {
            echo '<br />栈满';
            return;
        }
        /**入栈之后，指针移动一个位置*/
        $this->top++;
        /**将值存入栈容器中*/
        $this->stack[$this->top] = $val;
    }

    /**出栈的操作*/
    public function pop()
    {
        /**如果指针指向了-1，那么这个栈就已经没有值了*/
        if ($this->top == -1) {
            echo '<br />栈空';
            return;
        }
        /**弹出栈的值*/
        $valTop = $this->stack[$this->top];
        /**移动指针*/
        $this->top--;
        /**输出指针值*/
        return $valTop;
    }

    /**展示栈*/
    public function showStack()
    {
        /**首先判断栈里面是否有值，如果为-1，那么指针为初始化值，那么这个栈是没有值的*/
        if ($this->top == -1) {
            echo '<br/>栈空';
            return;
        }
        /**循环，栈是先入后出，那么我们也将循环输出值逆向输出一下*/
        for ($i=$this->top; $i>=0; $i--) {
            echo $this->stack[$i];
        }
    }
}



