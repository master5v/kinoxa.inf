<?php
//<div class="brdform">
//<div class="baseform">
echo '
	<a href="?view=status&on=0">on</a> <a href="?view=status&on=1">off</a>
		<table class="tableform"  border = "0">
			<tbody>
		';


//print_arr($ipurl);
foreach ($ipurl as $key => $item)

{
//    print_arr($item);

    $statik = 'http://monitor.zone-game.info/check.php?do=status&ip='.$item[ip].'&id=7';
  // echo ' <img src="'.$statik.'" /> id = '.$item[id].'<br>';


    echo '<tr>  <form method="post"   action="">';

    if (!$item['hiden'] ) {$vk = '<span style="color:green">Выключить</span>';$vkl = 1;} else {$vk = '<span style="color:red">Включить</span>';$vkl = 0;}

 echo '<td class="label" style = "color: #555;display:table-cell;">'.$item['id'].'</td>';
    echo '<td class="label" style = "color: #555;display:table-cell;">'.$item['ip'].'</td>';
    echo '<td  class="label" style = "color: #555;"><img src='.@$statik.' ></td>';
    echo '<td  class="label" style = "color: #555;">'.$item['provider'].'</td>';

    echo '<td  class="label" style = "color: #555;display: table-cell;"><a href="?view=ststkan&ip='.$item['url_ip'].'&id='.$item['provider_ip'].'">'.$item['url_ip'].' </a>

               <a href="http://'.$item['ip'].'/status">status</a><a href="?view=ststkan&ipm='.$item['ip'].'&idm='.$item['provider_ip'].'"> m3u </a>
               </td>';
    echo '<td  class="label" style = "color: #555;display: inline-;">'.$item['provider_ip'].' </td>';		echo '<td  class="label" style = "color: #555;display: inline-;">'.$item['date'].' </td>';
    echo  '<td  class="label" style = "color: #555;display: inline-;"><button name="ipstat_btn" class="fbutton" type="submit"><span>'.$vk.'</span></button>	<input name="id" value="'.$item['id_ip'].'" type="hidden"/>
<input name="vkl" value="'.$vkl.'" type="hidden"/>
</td>

</form>
<form method="post"  action="">
<td  class="label" style = "color: #555;display: inline-;">

<input name="id" value="'.$item['id_ip'].'" type="hidden"/>
<button name="ipdel_btn" class="fbutton" type="submit"><span>Dell</span></button>'.@$chek.'

</td></form></tr>';



}
echo  '</tbody></table>';
