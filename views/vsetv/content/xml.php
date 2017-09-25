<?php

    if  (!isset($file))
    {
echo "Загрузить: <br>";
echo '

<a class = "btn btn-success" href = "?view=xml&xml=1">Сериалы</a><br><br>
<a class = "btn btn-success" href = "?view=xml">Фильмы</a><br><br><br>

    ';

    }
else
    {
        $dirr = "iptv";
        $files = get_dir($dirr);

        $file=fopen("./userfiles/xml/iptv/temp.xml",'w');
        fputs($file,'<?xml version="1.0" encoding="UTF-8" ?>
<items>
<playlist_name><![CDATA[KiNoShKa]]></playlist_name>
<options>
<playlist_limits>nosavefav,no_save_playlist,no_step,no_save_fav</playlist_limits>
</options>
        ');

        for ($i=0;$i<count($files);$i++)
        {//or $files[$i]!=".."
            if ($files[$i]!=".." && $files[$i]!="." && $files[$i]!="temp.xml" && $files[$i]!="index.php"&& $files[$i]!="zagr.m3u")
            {

                fputs($file,"<channel>
<title><![CDATA[Лист №".$i."]]></title>
<logo_30x30><![CDATA[]]></logo_30x30>
<description><![CDATA[".$files[$i]."]]></description>
<playlist_url><![CDATA[".PATH."userfiles/xml/iptv/".$files[$i]."]]></playlist_url>
</channel>
                ");

            }// echo $files[$i]."<br>";

        }//end for


        fputs($file,"</items>");
        fclose($file);


echo "Успех";

    }//end else





    ?>
