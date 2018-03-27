<?php
$g_t = 13;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>澳洲分分彩 - 游戏规则</title>
    <link type="text/css" rel="stylesheet" href="../../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Css/ssc.css"/>
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/mmenu.all.min.js"></script>
</head>
<body mode="gm">
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>游戏规则</span>
            <a class="f_r" href="#type">游戏</a>
        </div>
        <?php include_once('../u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span></span>
                    <?php include_once('../gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="yx_gz">
            <?php include_once('type.php') ?>
            <div class="guize">
                <p class="f20">澳洲分分彩规则说明</p>
                <p class="b m_tb">简介</p>
                <p>“澳洲分分彩”是引进欧洲博彩公司专用开奖设备，使用1024位RSA密钥加密，进行全天24小时自然机率开奖，由菲律宾博彩监管机构(PAGCOR)审核监控联合开发的彩票游戏，60秒一期，全天候24小时开盘，保证公平公正；由于该彩种并不属于某单一地区彩种，所以暂时还未对外开放官方网站。<br>
                    开奖结果为五码 (万、仟、佰、拾、个)。假设结果为1 、2 、3 、4、5。</p>
                <p class="b m_tb">游戏玩法</p>
                <p class="c_t m_b">1、第一球 ~ 第五球</p>
                <p><span class="b">※第一球~第五球：</span>第一球、第二球、第三球、第四球、第五球：指下注的每一球特码与开出之号码其开奖顺序及开奖号码相同，视为中奖，如第一球开出号码8，下注第一球为 8 者视为中奖，其余情形视为不中奖。</p>
                <p><span class="b">※单双大小：</span>根据相应单项投注第一球 ~ 第五球开出的球号，判断胜负。</p>
                <p><span class="b">※大小：</span>根据相应单项投注的第一球 ~ 第五球开出的球号大于或等于 5 为特码大，小于或等于4 为特码小。</p>
                <p><span class="b">※单双：</span>根据相应单项投注的第一球 ~ 第五球开出的球号为双数则为特码双，如 2、6；球号为单数则为特码单，如1、3。</p>
                <p class="c_t m_tb">2、总和</p>
                <p><span class="b">※大小：</span>根据相应单项投注的第一球 ~ 第五球开出的球号数字总和值大于或等于 23 为总和大，小于或等于22 为总和小。</p>
                <p><span class="b">※单双：</span>根据相应单项投注的第一球 ~ 第五球开出的球号数字总和值是双数为总和双，数字总和值是单数为总和单。</p>
                <p class="c_t m_tb">3、斗牛：开奖号码不分顺序</p>
                <p><span class="b">※牛牛：</span>根据开奖第一球 ~ 第五球开出的球号数字为基础，任意组合三个号码成0或10的倍数，取剩余两个号码之和为点数（大于10时减去10后的数字作为对奖基数，如：00026为牛8，02818为牛9，68628、23500皆为牛10俗称牛牛；26378、15286因任意三个号码都无法组合成0或10的倍数，称为没牛，注：当五个号码相同时，只有00000视为牛牛，其它11111，66666等皆视为没牛）</p>
                <p><span class="b">※大小：</span>牛大(牛6,牛7,牛8,牛9,牛牛)，牛小(牛1,牛2,牛3,牛4,牛5)，若开出斗牛结果为没牛，则投注牛大牛小皆为不中奖。</p>
                <p><span class="b">※单双：</span>牛单(牛1,牛3,牛5,牛7,牛9)，牛双(牛2,牛4,牛6,牛8,牛牛)，若开出斗牛结果为没牛，则投注牛单牛双皆为不中奖。</p>
                <p class="c_t m_tb">4、梭哈：开奖号码不分顺序</p>
                <p><span class="b">※五条：</span>开奖的五个号码全部相同，例如：22222、66666、88888 投注梭哈：五条 中奖，其它不中奖。</p>
                <p><span class="b">※四条：</span>开奖的五个号码中有四个号码相同，例如：22221、66663、88885 投注梭哈：四条 中奖，其它不中奖。</p>
                <p><span class="b">※葫芦：</span>开奖的五个号码中有三个号码相同(三条)另外两个号码也相同(一对)，例如：22211、66633 投注梭哈：葫芦 中奖，其它不中奖。</p>
                <p><span class="b">※顺子：</span>开奖的五个号码从小到大排列为顺序(号码9、0、1相连)，例如：23456、89012、90123 投注梭哈：顺子 中奖，其它不中奖。</p>
                <p><span class="b">※三条：</span>开奖的五个号码中有三个号码相同另外两个不相同，例如：22231、66623、88895 投注梭哈：三条 中奖，其它不中奖。</p>
                <p><span class="b">※两对：</span>开奖的五个号码中有两组号码相同，例如：22166、66355、82668 投注梭哈：两对 中奖，其它不中奖。</p>
                <p><span class="b">※一对：</span>开奖的五个号码中只有一组号码相同，例如：22168、66315、82968 投注梭哈：一对 中奖，其它不中奖。</p>
                <p><span class="b">※散号：</span>开奖号码不是五条、四条、葫芦、三条、顺子、两对、一对的其它所有开奖号码，例如：23186、13579、21968 投注梭哈：散号 中奖，其它不中奖。</p>
                <p class="c_t m_tb">5、前三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
                <p><span class="b">※豹子：</span>开奖号码的万位千位百位数字都相同。如中奖号码为：222XX、666XX、888XX...开奖号码的万位千位百位数字相同，则投注前三豹子者视为中奖，其它视为不中奖。</p>
                <p><span class="b">※顺子：</span>开奖号码的万位千位百位数字都相连，不分顺序（数字9、0、1相连）。如中奖号码为：123XX、901XX、321XX、798XX...开奖号码的万位千位百位数字相连，则投注前三顺子者视为中奖，其它视为不中奖。</p>
                <p><span class="b">※对子：</span>开奖号码的万位千位百位任意两位数字相同（不包括豹子）。如中奖号码为：001XX，288XX、696XX...开奖号码的万位千位百位有两位数字相同，则投注前三对子者视为中奖，其它视为不中奖。如果开奖号码为前三豹子，则前三对子视为不中奖。</p>
                <p><span class="b">※半顺：</span>开奖号码的万位千位百位任意两位数字相连，不分顺序（不包括顺子、对子）。如中奖号码为：125XX、540XX、390XX、160XX...开奖号码的万位千位百位有两位数字相连，则投注前三半顺者视为中奖，其它视为不中奖。如果开奖号码为前三顺子、前三对子，则前三半顺视为不中奖。如开奖号码为：123XX、901XX、556XX、233XX...视为不中奖。</p>
                <p><span class="b">※杂六：</span>不包括豹子、对子、顺子、半顺的所有开奖号码。如开奖号码为：157XX、268XX...开奖号码位数之间无关联性，则投注前三杂六者视为中奖，其它视为不中奖。</p>
                <p class="c_t m_tb">6、中三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
                <p><span class="b">※豹子：</span>开奖号码的千位百位十位数字都相同。如中奖号码为：X222X、X666X、X888X...开奖号码的千位百位十位数字相同，则投注中三豹子者视为中奖，其它视为不中奖。</p>
                <p><span class="b">※顺子：</span>开奖号码的千位百位十位数字都相连，不分顺序（数字9、0、1相连）。如中奖号码为：X123X、X901X、X321X、X798X...开奖号码的千位百位十位数字相连，则投注中三顺子者视为中奖，其它视为不中奖。</p>
                <p><span class="b">※对子：</span>开奖号码的千位百位十位任意两位数字相同（不包括豹子）。如中奖号码为：X001X，X288X、X696X...开奖号码的千位百位十位有两位数字相同，则投注中三对子者视为中奖，其它视为不中奖。如果开奖号码为中三豹子，则中三对子视为不中奖。</p>
                <p><span class="b">※半顺：</span>开奖号码的千位百位十位任意两位数字相连，不分顺序（不包括顺子、对子）。如中奖号码为：X125X、X540X、X390X、X160X...开奖号码的千位百位十位有两位数字相连，则投注中三半顺者视为中奖，其它视为不中奖。如果开奖号码为中三顺子、中三对子，则中三半顺视为不中奖。如开奖号码为：X123X、X901X、X556X、X233X...视为不中奖。</p>
                <p><span class="b">※杂六：</span>不包括豹子、对子、顺子、半顺的所有开奖号码。如开奖号码为：X157X、X268X...开奖号码位数之间无关联性，则投注中三杂六者视为中奖，其它视为不中奖。</p>
                <p class="c_t m_tb">7、后三特殊玩法： 豹子 > 顺子 > 对子 > 半顺 > 杂六</p>
                <p><span class="b">※豹子：</span>开奖号码的百位十位个位数字都相同。如中奖号码为：XX222、XX666、XX888...开奖号码的百位十位个位数字相同，则投注后三豹子者视为中奖，其它视为不中奖。</p>
                <p><span class="b">※顺子：</span>开奖号码的百位十位个位数字都相连，不分顺序（数字9、0、1相连）。如中奖号码为：XX123、XX901、XX321、XX798...开奖号码的百位十位个位数字相连，则投注后三顺子者视为中奖，其它视为不中奖。</p>
                <p><span class="b">※对子：</span>开奖号码的百位十位个位任意两位数字相同（不包括豹子）。如中奖号码为：XX001，XX288、XX696...开奖号码的百位十位个位有两位数字相同，则投注后三对子者视为中奖，其它视为不中奖。如果开奖号码为后三豹子，则后三对子视为不中奖。</p>
                <p><span class="b">※半顺：</span>开奖号码的百位十位个位任意两位数字相连，不分顺序（不包括顺子、对子）。如中奖号码为：XX125、XX540、XX390、XX160...开奖号码的百位十位个位有两位数字相连，则投注后三半顺者视为中奖，其它视为不中奖。如果开奖号码为后三顺子、后三对子，则后三半顺视为不中奖。如开奖号码为：XX123、XX901、XX556、XX233...视为不中奖。</p>
                <p><span class="b">※杂六：</span>不包括豹子、对子、顺子、半顺的所有开奖号码。如开奖号码为：XX157、XX268...开奖号码位数之间无关联性，则投注后三杂六者视为中奖，其它视为不中奖。</p>
                <p class="c_t m_tb">8、龙虎和特殊玩法： 龙 > 虎 > 和 （0为最小，9为最大）</p>
                <p><span class="b">※龙：</span>开奖第一球（万位）的号码 大于 第五球（个位）的号码。如：第一球开出 6，第五球开出 2、第一球开出 8，第五球开出 6、第一球开出 5，第五球开出 1...开奖为龙，投注龙者视为中奖，其它视为不中奖。</p>
                <p><span class="b">※虎：</span>开奖第一球（万位）的号码 小于 第五球（个位）的号码。如：第一球开出 2，第五球开出 6、第一球开出 6，第五球开出 8、第一球开出 1，第五球开出 5...开奖为虎，投注虎者视为中奖，其它视为不中奖。</p>
                <p><span class="b">※和：</span>开奖第一球（万位）的号码&nbsp;等于&nbsp;第五球（个位）的号码。如：2XXX2、6XXX6、8XXX8...开奖为和，投注和者视为中奖，其它视为不中奖。</p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/base.js"></script>
</body>
</html>