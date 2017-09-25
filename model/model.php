    <?php
    defined('ISHOP') or die('Access denied');

    require_once 'model/xml.php';//
    require_once 'model/users.php';
    require_once 'model/mu.php';


    //=========Вызов ссылки канала========
    function getonechanel($ch)
    {
        $query = "SELECT * FROM `b_iptv`  WHERE id = '$ch' AND `hiden` != 1 LIMIT 1";
        $res = mysql_query($query);
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }

    //=========/Вызов ссылки канала========

    //=========Вызов ссылки фильма========
    function redir($tipe, $id)
    {
        $query = "SELECT * FROM `b_kinoser`  WHERE id = '$id' AND   `hiden` != 1 ";


        $res = mysql_query($query);
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }

    //=========/Вызов ссылки фильма========

    //==============Включение IP адреса====
    function vklIp($vkl, $id)
    {

        $q = "UPDATE `b_ip` SET `hiden`=$vkl  WHERE `id` = $id";
        $ss = mysql_query($q);
        return $ss;
    }

    //==============/Включение IP адреса====


    //==============копирование удаленной картинки====
    function download_remote_file($file_url, $save_to)
    {
        $content = file_get_contents($file_url);
        file_put_contents($save_to, $content);
    }

    //==============/копирование удаленной картинки====


    //==============копирование удаленной картинки====
    function download_remote_file_with_fopen($file_url, $save_to)
    {
        $in = fopen($file_url, "rb");
        $out = fopen($save_to, "wb");

        while ($chunk = fread($in, 8192)) {
            fwrite($out, $chunk, 8192);
        }

        fclose($in);
        fclose($out);
    }

    //==============/копирование удаленной картинки====


    //==============получение ссылок для загрузки====
    function getList($id)
    {
        $query = "SELECT *  FROM `b_lists`  WHERE  `id` = $id  ";
        $res = mysql_query($query); //AND `activ` = 1WHERE `vis` = 1 ORDER BY RAND() LIMIT 1
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }

    //==========/получение ссылок для загрузки========

    //==============обновление фильмов====
    function updKinoser($description, $id, $title, $logo, $tipe)

    {


        $q = "UPDATE `b_kinoser` SET `list`=$id,`description`='$description',`logo`='$logo',`date`=NOW() WHERE `title` = '$title'"; //,`tipe`='$tipe' LIKE
        $ss = mysql_query($q) || die(mysql_error());

    //    UPDATE `b_kinoser` SET `description` ='$description' , `list` = $id,`logo` = '$logo', `tipe` = `$tipe` , `date` = `$date`
    //    `list`, `title`, `season`, `parent`, `description`, `url`, `new`, `logo`, `qualiti`, `date`, `tipe`
        return $ss;
    }

    //==============/обновление фильмов====

    //=================
    function getfilm($title)
    {
        $query = "SELECT * FROM `b_kinoser` WHERE `title` LIKE '$title%'";
        $res = mysql_query($query); //WHERE `vis` = 1 ORDER BY RAND() LIMIT 1
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }

    //=================
    //========selectALLmail=========
    function selAllmail($box_mac, $tipe)
    {
        $txt = '';
        $q = "SELECT * FROM `b_mail` WHERE `parent` = 0 AND `read` = 0 AND `tipe` = '$tipe' ORDER BY `id` DESC ";//LIMIT 10
        $result = mysql_query($q);
        if (mysql_affected_rows() > 0) {
            $row = mysql_fetch_assoc($result);
            do {

                $txt .= '<channel>
    <title><![CDATA[' . $row[username] . ' ' . $row[date] . ']]></title>
    <logo_30x30><![CDATA[' . PATH . 'userfiles/images/menu/mailNE.png]]></logo_30x30>
    <description><![CDATA[' . $row[text] . ']]></description>
    <search_on>search</search_on>
    <playlist_url><![CDATA[' . PATHS . '?p=sendotv&id=' . $row[id] . ']]></playlist_url>
    </channel>';

            } while ($row = mysql_fetch_assoc($result));
        }
        return $txt;
    }

    //========/selecALLtmail=========


    //=====================
    function sendAdminmail($name, $username, $id)
    {

        $name = trim($name);
        $name = mysql_real_escape_string($name);
        $name = htmlspecialchars($name);
        $leight = strlen($name);
        if ($leight < 1) {
            $_SESSION['mail'] = "<span style='color: #ff0000;'>Слишком короткое сообщение. \"" . $name . "\"</span>";
        } else {

            mysql_query("INSERT INTO `b_mail`(`user`,`username`,`parent`, `text`, `tipe`,  `date`)
                                    VALUES ( '$box_mac','$username',$id,'$name','sendadmin', NOW())");

            mysql_query("UPDATE `b_mail` SET `read` = 1, `otvet` = 1 WHERE `id` = $id");
            $_SESSION['mail'] = "Сообщение отправлено";
        }


        $txt = $name;
        $ovet = '<channel>
    <title><![CDATA[' . $_SESSION[mail] . ']]></title>
    <logo_30x30><![CDATA[]]></logo_30x30>
    <description><![CDATA[' . $txt . ']]></description>
    </channel>';

        unset($_SESSION[mail]);
        return $ovet;
    }

    //=====================


    //========selectmail=========
    function selmail($box_mac, $tipe)
    {
        $txt = '';
        if ($tipe == 'sendotziv') {
            $q = "SELECT * FROM `b_mail` WHERE `parent` = 0 AND`tipe` = '$tipe' ORDER BY `date` DESC LIMIT 10";
        }//
        else {
            $q = "SELECT * FROM `b_mail` WHERE `parent` = 0 AND `user` = '$box_mac' AND `tipe` = '$tipe' ORDER BY `id` DESC LIMIT 10";
            if ($box_mac == '12cc8f3b45033d42') $q = "SELECT * FROM `b_mail` WHERE `parent` = 0  AND `tipe` = '$tipe' ORDER BY `date` DESC LIMIT 10";//AND `read` = 0
        }


        $result = mysql_query($q);
        if (mysql_affected_rows() > 0) {
            $row = mysql_fetch_assoc($result);


            do {
                if ($row['read']) {
                    $logos = '<img src="' . PATH . 'userfiles/images/menu/mailDA.png" height="" width="30"/>';
                } else $logos = '<img src="' . PATH . 'userfiles/images/menu/mailNE.png" height="" width="30"/>';

                if ($row['otvet']) {
                    $q2 = "SELECT * FROM `b_mail` WHERE `tipe` = '$tipe' AND `parent` = $row[id] LIMIT 1";
                    $result2 = mysql_query($q2);
                    $row2 = mysql_fetch_assoc($result2);
                    $admino = "<span style='margin-left:36px; margin-top: 3px;'><img src='" . PATH . "userfiles/images/menu/ArrowLeft.png'  width=\"30\"/><b style=' color:red;'>ADMIN: </b>" . $row2[text] . "</span>";
                } else $admino = "";
                $txt .= "<span style='margin-left:5px;'> " . $logos . " <b>$row[username]: </b><span style='margin-left:5%;'>$row[text]</span></span>		
                <br>$admino <hr>";
            } while ($row = mysql_fetch_assoc($result));
        }
        return $txt;
    }

    //========/selectmail========= <div></div>

    //=====================
    function sendmail($name, $username, $box_mac, $tipe)
    {

        $name = trim($name);
        $name = mysql_real_escape_string($name);
        $name = htmlspecialchars($name);
        $leight = strlen($name);
        if ($leight < 4) {
            $_SESSION['mail'] = "<span style='color: #ff0000;'>Слишком короткое сообщение. \"" . $name . "\"</span>";
        } else {

            mysql_query("INSERT INTO `b_mail`(`user`,`username`, `text`, `tipe`,  `date`)
                                                    VALUES ( '$box_mac','$username','$name','$tipe', NOW())");
            $_SESSION['mail'] = "Сообщение отправлено";
        }
        //header("Content-type: text/xml");

        $txt = selmail($box_mac, $tipe);


        $ovet = '<channel>
    <title><![CDATA[' . $_SESSION[mail] . ']]></title>
    <logo_30x30><![CDATA[]]></logo_30x30>
    <description><![CDATA[' . $txt . ']]></description>
    </channel>';

        unset($_SESSION[mail]);
        return $ovet;
    }

    //=====================


    //=================
    function getfilms($i)
    {
        $query = "SELECT * FROM `b_kinoser` WHERE `list` =$i ";
        $res = mysql_query($query); // `title` LIKE '$title%'WHERE `vis` = 1 ORDER BY RAND() LIMIT 1
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }

    //=================


    //=================end now


    //=================
    function serials()
    {
        $query = "SELECT *  FROM vse_data  WHERE  `cat` = 'serial' ";
        $res = mysql_query($query); //WHERE `vis` = 1 ORDER BY RAND() LIMIT 1
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }


    //=================
    function serials_category($id)
    {
        $query = "SELECT *  FROM `vse_category`  WHERE  `id` = $id ";
        $res = mysql_query($query); //WHERE `vis` = 1 ORDER BY RAND() LIMIT 1
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }

    //=====================

    //=================
    function serials_cat()
    {
        $query = "SELECT *  FROM `vse_category`  ";
        $res = mysql_query($query); //WHERE `vis` = 1 ORDER BY RAND() LIMIT 1
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }

    //=====================

    //=================
    function get_serials($title)
    {
        $query = "SELECT *  FROM vse_data  WHERE  `title` = '$title'  ";
        $res = mysql_query($query); //WHERE `vis` = 1 ORDER BY RAND() LIMIT 1
        $udp = array();
        while ($row = mysql_fetch_assoc($res)) {
            $udp[] = $row;
        }
        return $udp;
    }
    //=====================