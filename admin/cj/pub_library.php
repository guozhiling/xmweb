<?php
function theif_uid($langx)
{


}

function theif_data($site, $uid, $gtype, $rtype, $langx, $page_no)
{
    switch ($gtype) {
        case 'FU':
            $base_url = "$site/app/member/FT_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
            $filename = "$site/app/member/FT_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";

            break;
        case 'FS':
            $base_url = "$site/app/member/browse_FS/loadgame_R.php?rtype=fs&uid=$uid&langx=$langx&mtype=3";
            $filename = "$site/app/member/browse_FS/reloadgame_R.php?mid=1&uid=$uid&langx=$langx&choice=ALL&LegGame=ALL&pages=1&records=40&FStype=FT&area_id=&league_id=&rtype=$rtype";
            break;
        case 'OU':
            $gtype_browse = $gtype . "_browse";
            $base_url = "$site/app/member/OP_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
            $filename = "$site/app/member/OP_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
            break;
        case 'BKR':
            $base_url = "$site/app/member/BK_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
            $filename = "$site/app/member/BK_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
            break;
        case 'msg':
            $base_url = "$site/app/member/select.php?uid=$uid&langx=$langx";
            $filename = "$site/app/member/scroll_history.php?uid=$uid&langx=$langx&select_date=0";
            break;
        default:
            $gtype_browse = $gtype . "_browse";
            $base_url = "$site/app/member/" . $gtype_browse . "/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
            $filename = "$site/app/member/" . $gtype_browse . "/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
            break;
    }
    //echo $filename;
    //$base_url=$filename="http://g.com/a.php";
    $thisHttp = new cHTTP();
    $thisHttp->setReferer($base_url);

    $thisHttp->getPage($filename);
    $msg = $thisHttp->getContent();
    //echo $msg;
    /*if(in_array("$gtype",array("BS","FS"))==0){
        $msg .= gzinflate(substr($msg,10));
    }*/
    $a = array(
        "if(self == top)",
        "<script>",
        "</script>",
        "parent.GameFT=new Array();",
        "new Array('gid'",
        "\n\n"
    );
    $b = array(
        "",
        "",
        "",
        "",
        "",
        ""
    );
    unset($matches);
    $html_data = str_replace($a, $b, $msg);
//echo $html_data;
    return $html_data;
}

function write_file($filename, $data, $method = "rb+", $iflock = 1)
{
    @touch($filename);
    $handle = @fopen($filename, $method);
    if ($iflock) {
        @flock($handle, LOCK_EX);
    }
    @fputs($handle, $data);
    if ($method == "rb+") @ftruncate($handle, strlen($data));
    @fclose($handle);
    @chmod($filename, 0777);
    if (is_writable($filename)) {
        return true;
    } else {
        return false;
    }
}

?>