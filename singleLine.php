<?php
class Hero
{
    public $num; //英雄的编号
    public $name; //英雄的真实姓名
    public $nickname;  //英雄的绰号
    public $next = null; //存放指针的地方
    /**构造方法，初始化属性值*/
    public function __construct($num = '', $name = '', $nickname = '')
    {
        $this->num = $num;
        $this->name = $name;
        $this->nickname = $nickname;
    }
}

/**使用很简单的一个方法进行单链表的连接*/
$head = new Hero(); //首先实例化一个空的头结点
$hero = new Hero(1, '宋江', '及时雨');
$head->next = $hero; //给头结点的指针部位赋值下一个节点的地址
$hero1 = new Hero(2, '卢俊义', '玉麒麟');
$hero->next = $hero1; //给头结点的指针部位赋值下一个节点的地址
$hero2 = new Hero(3, '刘柱', '思梦php');
$hero1->next = $hero2;

/**定义一个循环遍历节点的方法*/
function showLine($head)
{
    /**我们在进行操作单链表的时候，千万不能动头部指针，不然将毁坏链表，因此
     * 我们要使用一个临时的变量代替指针进行链表的操作
     */
    $cur = $head;
    /**我们从单链表模拟图上可以看出，如果最后一个值为null，那就说明已经到了尾部，那将停止循环*/
    while ($cur->next != null) {
        echo '<br />编号='.$cur->next->num.'-'.'姓名='.$cur->next->name.'-'.'外号='.$cur->next->nickname;
        /**每次循环，指针将向后移动一个位置*/
        $cur = $cur->next;
    }

}
/**封装一个添加链表的操作*/
function addLine($head, $hero)
{
    /**思路：
     * 添加链表的操作，就是将每个元素的指针部分指向下一个元素的地址，我们直接循环链表
     * 我们直接循环链表，然后将下一个元素地址赋值给指针
     * 我们有两种办法添加，（1）不考虑排序，直接向指针赋值 （2）排序后赋值
    */
    /**我们在进行操作单链表的时候，千万不能动头部指针，不然将毁坏链表，因此
     * 我们要使用一个临时的变量代替指针进行链表的操作
     */
    $cur = $head;
    /**方法（1）直接赋值*/
    while ($cur->next != null) {
        /**每次循环，指针移动*/
        $cur = $cur->next;
    }
    /**如果$curl等于null的话，那么就是已经到了队尾，然后你就可以进行添加了*/
    $cur->next = $hero;

    /**方法（2）排序计算*/
    $flag = true;  //判断重复值
    while ($cur->next!=null) {
        /**判断一下当前的尾部值是否大于当前加入链表值，如果大于那就直接跳出来，然后添加在
         * 你输入的那个对象的值的后面，然后添加的对象就变成了上一个连接的尾部值
         */
        if ($cur->next->num > $hero->num) {
            break;
        } elseif ($cur->next->num == $hero->num) {
            echo '<br/>编号'.$hero->num.'已经存在';
            $flag = false;
        }
        $cur = $cur->next;
    }
    /**进行一波交换，也就是，让添加的值先指向它小于的那个值，然后再添加到上一个值的尾部*/
    if ($flag) {
        $hero->next=$cur->next;
        $cur->next = $hero;
    }




}

/**单链表删除*/
function delLink($head, $num)
{
    $cur = $head;
    $flag = false;
    while ($cur->next != null) {
        if ($cur->next->num == $num) {
            $flag = true;
            break;
        }
        $cur = $cur->next;
    }
    /**防止是循环一直未找到跳出，因此我们要判断这个值是否是*/
    if ($flag) {
        $cur->next = $cur->next->next;
    } else {
        echo '<br />编号'.$num.'未找到';
    }

}

/**修改单链表*/
function editLink($head, $hero)
{
    $cur = $head;
    while ($cur->next != null) {
        if ($cur->next->num == $hero->num) {
            break;
        }
        $cur = $cur->next;
    }
    if ($cur->next == null) {
        echo '编号不存在';
    } else {
        $cur->next->name = $hero->name;
        $cur->next->nickname = $hero->nickname;
    }

}


/**模拟的操作实例*/
/**添加结点*/
$hero = new Hero(1, '宋江', '及时雨');
addLine($head,$hero);
$hero = new Hero(6, '刘柱2', '思梦2');
addLine($head,$hero);
$hero = new Hero(6, '刘柱', '思梦');
addLine($head,$hero);
$hero = new Hero(2, '卢俊义', '玉麒麟');
addLine($head,$hero);
showLine($head);
echo "<hr />";
delLink($head, 2); //删除结点
$hero = new Hero(2, '卢俊义2', '玉麒麟22');
/**修改结点*/
editLink($head,$hero);
/**展示结点*/
showLine($head);

















