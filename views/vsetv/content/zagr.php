<?php

    if  (!isset($file))
    {
echo "Загрузить: <br>";
echo '

<a class = "btn btn-success" href = "?view=zagr&xml=zSerial">Сериалы</a><br><br>
<a class = "btn btn-success" href = "?view=zagr&xml=zFilm">Фильмы</a><br><br><br>
<a class = "btn btn-success" href = "?view=zagr&xml=ziptv">IPTV</a><br><br><br>
    ';



    }
else
    {


switch ($file) {
    case('zSerial'):
        $idd = '61';
        $cat = getList($idd); $cat = $cat['0'];

        $url = $cat['url'];
//        $url = "http://223307.selcdn.ru/kb/pl/serialy/serials.xml";
        $xml= simplexml_load_file($url);
//print_r($xml); //это для теста



        foreach ($xml->channel as $item)
        {

            $title =$item->title;
            $title = trim($title);
            $title =mysql_real_escape_string($title);

            $urlseson =$item->playlist_url;

            if (isset($item->logo_30x30)) {$logo1 =$item->logo_30x30;}else {$logo1 =$item->logo;}

//                echo "$title  $logo1 $urlseson <br><br> ";
//
//           $zapros =  mysql_query("INSERT INTO `b_kinoser`( `list`, `title`, `logo`, `tipe`)
//                                       VALUES  ('$idd','$title','$logo1','serials')");
//            $zapros = mysql_insert_id($zapros);

            $xml2= simplexml_load_file($urlseson);

            foreach ($xml2->channel as $item1)
            {
                $season =$item1->title;  $season = trim($season); $season =mysql_real_escape_string($season);
                $urlserii =$item1->playlist_url;

//                echo "$title  $logo1 $season   $urlserii <br><br><br>";



                //=========m3u

                $handle = @file($urlserii);
                for($i=1; $i < count($handle); $i++) {
                    $newphrase = trim($handle[$i]);

                    if(stristr($newphrase, 'EXTINF') != FALSE) {

                        $name = $newphrase;

                        $name = explode(",", $name);

                        $name = trim(@$name['1']);
                        $name = mysql_real_escape_string($name);
                       }//://
                    else {

                        $urlss =  $newphrase;
//
                        echo "$title $name $logo1 $season  $urlss  <br><br><br>";
//            mysql_query("INSERT INTO `b_kinoser`( `list`, `title`, `logo`, `tipe`)
//                                       VALUES  ('$idd','$title','$logo1','serials')");

                        unset($name);
                    }

                }//endfor


                //=========/m3u

            }// endforeach
//exit();
            echo "<hr>";
        }// endforeach


        break;

    case('zFilm'):
        
		
		if (!isset($_GET['i']) && !isset($_GET['y'])) 
		{
		echo "Обновить один источник фильмов:  ".PATH."?view=zagr&xml=zFilm&i= <br>"; 
		echo "Обновить первый источник фильмов:  <a class = \"btn btn-success\" href = '".PATH."?view=zagr&xml=zFilm&i=1'>Фильмы id:1</a> <br>"; 		
		echo "Обновить все фильмы:  <a class = \"btn btn-success\" href = '".PATH."?view=zagr&xml=zFilm&y=17'>Фильмы id:2...15</a>  <br>";
		break;}
	
		if (isset($_GET['i'])) 
		{
			$zagg = $_GET['i']; $zagg2 = $zagg;
		}
		else 
		{
			$zagg = 2; $zagg2 = $_GET['y'];
			}
		$counter = 0;$counter2 = 0; $counterjpg = 0;
		
       // $zagg = $_GET['i'];
		if ($zagg == 1) {add_chanel('http://iptv-telik.usite.pro/vkfilm.m3u8',1); break;}
	   //$i=$zagg; $i<=$zagg;$i++
	  //$i=2; $i<=10;$i++
	  
        for ($i=$zagg; $i<=$zagg2;$i++) {
            $cat = getList($i);
            $cat = $cat['0'];
//                print_arr($cat);
            // echo $cat['0']['playlist_url'];         print_arr($cat);

//            $file = $cat['0']['playlist_url'];


        $url = $cat['url'];//http://223307.selcdn.ru/kb/pl/in-kino/inkino.xml
        $xml= simplexml_load_file($url); //Интерпретирует XML-документ в объект
//print_r($xml); //это для теста

 $propusk = 0;

                    foreach ($xml->channel as $item)
                    {
                        $propusk++;
                        if ($i==10 && $propusk == 5) continue;
                        $title =$item->title;
                        $title = trim($title); 
			$title =mysql_real_escape_string($title);
                        $deskr = "".$item->description; //
                        						
						if (isset($item->stream_url)) {$urlkino =$item->stream_url;}
						else {$urlkino =$item->playlist_url;}
						
                        if (isset($item->logo_30x30)) {$logo1 =$item->logo_30x30;}
						else {$logo1 =$item->logo;}
						/*
						if ($zagg2 == 11)
						{
						$healthy = array("[","]");
						$yummy   = array("","");
						$logo1 = str_replace($healthy, $yummy, $logo1);
						}	*/
						
                        $deskr = trim($deskr);
                        $description = mysql_real_escape_string($deskr);
                        //$deskr = htmlspecialchars($deskr);
//'http://223307.selcdn.ru/kb/pl/serialy/ya/Ya_zombi/ya-zombi.jpg'

                        $enc=md5($title);//mb_convert_encoding($title,"windows-1251", "utf-8" )logo/
                        $logo = realpath("./userfiles/images") . '/'.$cat[tipe].'/'.$enc.'.jpg';
                        $jpg = $enc.'.jpg';
//                        download_remote_file($logo1, $logo);
//
//                        echo "$jpg<br>";

                        $getfilm =  getfilm($title);
//                        print_arr($getfilm);
                        if ($getfilm[0]['title']) {
							$counter++;
//							print_arr($getfilm[0]);
							if ($getfilm[0]['logo'] == "noimage.jpg") {
//                                download_remote_file($logo1, $logo);
                                download_remote_file_with_fopen($logo1, $logo);
                                $counterjpg++; 
//                            if ($counterjpg == 10) break;

updKinoser($description, $cat['id'], $getfilm[0]['title'], $jpg, $cat['tipe']);
                            }
//							download_remote_file_with_fopen($logo1, $logo); $counterjpg++;
                            
                        }
                      else {$counter2++;
                          download_remote_file_with_fopen($logo1, $logo); echo "++$title<br>";
                          mysql_query("INSERT INTO `b_kinoser`( `list`,`title`,`description`,`logo`,`tipe`, `url`, `date`)
                                          VALUES ($cat[id],'$title','$description','$jpg','$cat[tipe]','$urlkino',NOW())");
//                          =,=,`date`=$date,='$tipe'
//echo " <br>$cat[id],'$title','$description','$jpg','$cat[tipe]','$urlkino', <br>";
                      }

//echo "$description1,--- $cat[id],--- $title,--- $logo,--- $cat[tipe] <br>";
//                        echo "$logo1  $logo<br>";

//                        $dddd= date("Y-m-d H:i:s", time() + 7200); $result112779 = mysql_query("UPDATE je SET date='$dddd' ",$db); //задаем время
//                        $dido=date("H", time() + 7200); mysql_query("UPDATE je SET   progon='$dido' ",$db);

                        // add_category_s($title, $category, $url, $logo);


            //            $get_ser = get_serials($title);
                        // print_arr($get_ser);


//                        mysql_query("INSERT INTO `b_lists`( `name`, `url`, `activ`, `tipe`)
//                                                            VALUES ( '$title','$url',1,'films')");




                    }// endforeach



        }// endfor
echo "Было фильмов: $counter <br>Добавлено: $counter2  добавлено рисунков $counterjpg<br>";
        break;
///==========================================================
    case('ziptv'):
	if (!isset($_GET['i'])) {echo "Выбирите плейлист: ".PATH."?view=zagr&xml=ziptv&i=";
	
	echo '<br><a class = "btn btn-success" href = "'.PATH.'?view=zagr&xml=ziptv&i=">IPTV</a><br><br>';
      //  $get1 = get_iptv_list($box_mac=1,$adult =0);
        //print_arr($get1);

        //$id = $get1[id]; echo $id;        print_arr(get_iptv($id=31,$box_mac=1));


	break;}
	$i = $_GET['i']; if ($i =='') 
	{
	for ($i=31; $i<41; $i++) {echo '<br><a class = "btn btn-success" href = "'.PATH.'?view=zagr&xml=ziptv&i='.$i.'">IPTV '.$i.'</a><br>';}
	
	break;}
	$cat = getList($i);
            $cat = $cat['0'];
			$url = $cat['url'];
			$provider = $cat['id'];
			$listname = $cat['name'];
			$filename = $cat['filename'];
			
if ($i > 30 && $i<41) //$i == 31 || $i == 32 || $i == 33 || $i == 31 || 
			{add_iptv2($url,$filename);}
			else {add_iptv($url,$filename, $provider);}
			//
			
//add_iptv($url,$provider,$listname);
        break;
}




       //echo $file;
       /*  $url = "http://iptv-telik.usite.pro/vkfilm.m3u8";
//        $provider = 'ЗАО \"АИСТ\" — Тольятти';
          $provider = 1;
        add_chanel($url, $provider);*/








//        //



}





    ?>
