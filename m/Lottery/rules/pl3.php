<?php
$g_t = 9;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>体彩排列3 - 游戏规则</title>
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
                <p class="f20">体彩排列3规则说明</p>
                <p class="b m_tb">简介</p>
                <p>排列三是依照中国体彩管理中心发行的排列三的开奖结果为派彩依据，开奖时间是每天晚上八点半，每天开奖一次。假设排列三开奖结果为 123，那么百位是 1，十位是 2，个位是 3。(每个位数在开奖时从 0 ~ 9 中摇出一个结果)；本公司排列三具体游戏规则如下：<br>
                    假设下列为开奖结果为1、2、3</p>
                <p class="b m_tb">游戏玩法</p>
                <p class="c_t m_b">1、选号玩法</p>
                <p><strong>单选：</strong>于百、十、个任选一位(百、十或个)、二位(百十、百个或十个)或三位(百十个)，分别自0~9选择1个号码、2个号码或3个号码，只要当期开奖结果与所选的号码相同且顺序一致时，即为中奖。</p>
                <p><span class="b">※举例：</span>投注者购买单选百位，选择号码为1，当期开奖结果如果只要百位数为1，十位及个位数无论为1xx皆视为中奖。（x=0~9任一数）</p>
                <p><span class="b">※举例：</span>投注者购买单选百十定位，选择号码为百位1、十位2，当期开奖结果如果只要百位与十位皆与其所选的号码相同且顺序一致时，个位数无论为12x皆视为中奖。（x=0~9任一数）</p>
                <p><span class="b">※举例：</span>投注者购买单选百十个定位，选择号码为百位1、十位2、个位3，当期开奖结果如为123，即视为中奖。</p>
                <p><strong>组一：</strong>自0~9任选1号进行投注，当开奖结果百十个任一数与所选的号码相同时，即为中奖；若开奖结果出现重覆数字时，视为中奖一次。</p>
                <p><span class="b">※举例：</span>投注者购买一字组合，选择号码为1，当期开奖结果如为1xx、x1x、xx1皆视为中奖。（x=0~9任一数）；若开奖的结果为11x、1x1、x11或111仅视为中奖一次</p>
                <p><strong>组二：</strong>自0~9任选2号进行投注，当开奖结果百十个任二数与所选的号码相同时，即为中奖。</p>
                <p><span class="b">※举例：</span>投注者购买二字组合，选择号码为12，当期开奖结果如为12x、1x2、21x、2x1、x12、x21皆视为中奖。（x=0~9任一数）</p>
                <p><strong>组三：</strong>自0~9号任选3号且其中2个号需相同（如112），当开奖结果与所选号码相同(顺序不一定要相同)时，即为中奖。</p>
                <p><span class="b">※举例：</span>投注者购买组三，选择号码为112，当期开奖结果如为112、121、211皆视为中奖。</p>
                <p><strong>组六：</strong>自0~9号任选3号且3个号都不相同时（如123），当开奖结果与所选号码相同(顺序不一定要相同)时，即为中奖。</p>
                <p><span class="b">※举例：</span>投注者购买组六，选择号码为123，当期开奖结果如为123、132、213、231、312、321皆视为中奖。</p>
                <p class="c_t m_tb">2、和值玩法</p>
                <p>以中奖号码个位、十位、百位数字相加起来的总和值为投注中奖的标准。</p>
                <p class="c_t m_tb">3、佰、十、个 单双大小</p>
                <p>中奖号码个位、十位、百位的单双大小</p>
                <p><strong>单双玩法:</strong>0、2、4、6、8 为双；1、3、5、7、9 为单</p>
                <p><strong>大小玩法:</strong>0、1、2、3、4 为小；5、6、7、8、9 为大</p>
                <p><strong>过串玩法:</strong>个十百单双大小串—在个位、十位、百位中任选一位、两位或者三位进行单双大小投注。</p>
                <p class="c_t m_tb">4、跨度</p>
                <p>以开奖三个号码的最大差距(跨度)，作为中奖的依据。会员可以选择 0 ~ 9 的任一跨度。</p>
                <p><span class="b">※举例：</span>开奖结果为 3，4，8。中奖的跨度为 5。(最大号码 8 减 最小号码 3 = 5)。投注者购买跨度，选择号码为5，视为中奖。</p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../js/base.js"></script>
</body>
</html>