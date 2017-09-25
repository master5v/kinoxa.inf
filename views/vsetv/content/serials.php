					<div class="content">
                        <h2>Популярные телеканалы</h2>
                        
						
						
						
						
						<div class="row row-channel">



						<?php  foreach ($serials as $item): if ($item['tipe'] == 'filmsold') {$item['tipe'] = 'films';}//print_arr($serials);PATH.''.$item['logo'];?>
						
						
                            <div class="col-sm-3 col-xs-6 tv">
                                <div class="channel">
                                   <a href="#"><img class="logo-channel" src="<?php echo PATH."userfiles/images/". $item['tipe'].'/'. $item['logo'];?>"
                                                    alt="<?php echo $item['title'];?>" title="<?php echo $item['title'];?>"></a>
                                    <div class="status">33</div>
                                    <div class="free">free</div>
                                </div>
                            </div>
                           
                        
						
						<?php endforeach;?>
						</div>
						
						
						
						
						
						
						
                        
                    </div>











<?php

//print_arr($serials);
/*

$gray = "";

foreach ($serials as $item)
    {


        echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-4 col-uxs-6 col-u2xs-12 body_qaiety text-center '.$gray.'">
                        <div class="tv-chanel">

                            <a class="tv-chanel_link" href="'.'"><img src="'.$item['logo'].'" alt="'.$item['title'].'" title="'.$item['title'].'"></a>
                            <p> '.substr($item['title'], 0, 40).'</p>
                            <div>
                                <div class="badge badge-tv">'.'</div>
                                <div class="badge badge-much">'.'</div>
                            </div>
                        </div>
                    </div>
 ';




    }
*/

?>
