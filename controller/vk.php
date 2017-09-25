<?php

if (!$_GET[mac] && !$_SESSION[user][mac]) //|| !$_GET[uid]

{
echo "ВВедите  мас-адрес Вашего устройства";  

echo '
    <form class="form-horizontal" action="" method="get"   >
      <div class="control-group">
        <label class="control-label" for="inputEmail">Мас-адрес</label>
        <div class="controls">
          <input type="text" id="inputEmail" placeholder="Мас-адрес" name="mac">
        </div>
      </div>

      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn">Войти</button>
        </div>
      </div>
    </form>';
 //exit();
 }
 
 else 
 {
 
if ($_GET[mac]) {$box_mac = $_GET[mac]; $box_mac = trim($box_mac);   $box_mac = mysql_real_escape_string($box_mac); $box_mac = htmlspecialchars($box_mac);
$_SESSION[user][mac] = $box_mac;
}
$box_mac = $_SESSION[user][mac] ;
$userMac = userMac($box_mac); $userMac =$userMac['0'];

if ($userMac) {

//$_SESSION[user][mac] = $userMac[box_mac];


if (isset($_GET[uid])) {

//print_arr($_GET);
//print_arr($_SESSION);

$upduser = upduser($_GET[first_name],$_SESSION[user][mac], $_GET[uid], $_GET[photo_rec]);
if ($upduser) {echo "Вы авторизированы. Приятного пользования порталом!";unset($_SESSION[user][mac]);}
else {echo "Что-то пошло не так. Попробуйте позже!"; }
echo '<br><a href="'.PATH.'">на главную</a>';

exit();
}
echo '
<center>Авторизируйтесь через VK
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?146"></script>

<script type="text/javascript">
  VK.init({apiId: 6089792});
</script>

<!-- Put this div tag to the place, where Auth block will be -->
<div id="vk_auth"></div>
<script type="text/javascript">
VK.Widgets.Auth("vk_auth", {authUrl: "/vsetv"});
</script></center>
';


//

//if (isset($_GET[uid])) {$upduser = upduser($_GET[first_name],$userMac[box_mac], $_GET[uid], $_GET[photo_rec]);

//if ($upduser) echo "Вы авторизированы. Приятного пользования порталом!";
//else echo "Что-то пошло не так. Попробуйте позже!";}




}else {echo "Пользователя нет в базе!!!";unset($_SESSION[user][mac]);}

 }


/*
$_SESSION[user][uid] = $_GET[uid];
$_SESSION[user][first_name]  = $_GET[first_name];
$_SESSION[user][photo] = $_GET[photo];
$_SESSION[user][photo_rec]  = $_GET[photo_rec];




print_arr($_GET);
//print_arr($_SESSION);
echo $_SESSION[user][uid];*/