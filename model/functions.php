    <?php

    defined('ISHOP') or die('Access denied');


    /* ===Распечатка массива=== */
    function print_arr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    /* ===Распечатка массива=== */

    /* ===Фильтрация входящих данных=== */
    function clear($var)
    {
        $var = mysql_real_escape_string(strip_tags($var));
        return $var;
    }

    /* ===Фильтрация входящих данных=== */

    /* ===Редирект=== */
    function redirect($http = false)
    {
        if ($http) $redirect = $http;
        else    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
        header("Location: $redirect");
        exit;
    }

    /* ===Редирект=== */

    /* ===Выход пользователя=== */
    function logout()
    {
        //unset($_SESSION['auth']);
        unset($_SESSION['auth']);//
        unset($_SESSION['user']);
    }

    /* ===Выход пользователя=== */


    /* ===Постраничная навигация=== */
    function pagination($page, $pages_count, $modrew = 0)
    {
        if ($modrew == 0) {
            // если функция вызывается на странице без ЧПУ
            if ($_SERVER['QUERY_STRING']) { // если есть параметры в запросе
                $uri = "?";
                foreach ($_GET as $key => $value) {
                    // формируем строку параметров без номера страницы... номер передается параметром функции
                    if ($key != 'page') $uri .= "{$key}={$value}&amp;";
                }
            }
        } else {
            // если функция вызвана на странице с ЧПУ
            $uri = $_SERVER['REQUEST_URI'];
            $params = explode("/", $uri);;
            $uri = null;
            foreach ($params as $param) {
                if (!empty($param) AND !preg_match("#page=#", $param)) {
                    $uri .= "/$param";
                }
            }
            $uri .= "/";
        }


        // формирование ссылок
        $back = ''; // ссылка НАЗАД
        $forward = ''; // ссылка ВПЕРЕД
        $startpage = ''; // ссылка В НАЧАЛО
        $endpage = ''; // ссылка В КОНЕЦ
        $page2left = ''; // вторая страница слева
        $page1left = ''; // первая страница слева
        $page2right = ''; // вторая страница справа
        $page1right = ''; // первая страница справа

        if ($page > 1) {
            $back = "<a href='{$uri}page=" . ($page - 1) . "' class='previouspostslink'>◄</a>";//<a class='nav_link' href='{$uri}page=" .($page-1). "'>&lt;</a>
        }
        if ($page < $pages_count) {
            $forward = "<a href='{$uri}page=" . ($page + 1) . "' class='nextpostslink'>Следующая</a>";//<a class='nav_link' href=''>&gt;</a>
        }
        if ($page > 3) {
            $startpage = "<a href='{$uri}page=1' class='first'>◊</a>";//<a class='nav_link' href=''>&laquo;</a>
        }
        if ($page < ($pages_count - 2)) {
            $endpage = "<a  href='{$uri}page={$pages_count}' class='last'>◊</a>";
        }
        if ($page - 2 > 0) {
            $page2left = "<a href='{$uri}page=" . ($page - 2) . "' class='page smaller'>" . ($page - 2) . "</a>";//<a class='nav_link' href=''>" .($page-2). "</a>
        }
        if ($page - 1 > 0) {
            $page1left = "<a  href='{$uri}page=" . ($page - 1) . "'>" . ($page - 1) . "</a>";
        }
        if ($page + 2 <= $pages_count) {
            $page2right = "<a class='page larger' href='{$uri}page=" . ($page + 2) . "'>" . ($page + 2) . "</a>";
        }
        if ($page + 1 <= $pages_count) {
            $page1right = "<a class='page larger' href='{$uri}page=" . ($page + 1) . "'>" . ($page + 1) . "</a>";
        }

        // формируем вывод навигации
        //echo '<div class="pagination">' .$startpage.$back.$page2left.$page1left.'<a class="nav_active">'.$page.'</a>'.$page1right.$page2right.$forward.$endpage. '</div>';

        echo '
        
        <div id="page_navi"><div class="wp-pagenavi">
        ' . $startpage . $back . $page2left . $page1left . '
    
    
    <span class="current">' . $page . '</span>
    ' . $page1right . $page2right . $forward . $endpage . '
    
    
    
    
    </div></div>
        
        
        
        
     ';
    }



    /*===Постраничная навигация=== */


    function check_http_status($url)
    {
        $user_agent = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0)';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);//1
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $page = curl_exec($ch);

        $err = curl_error($ch);
        if (!empty($err))
            return $err;

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpcode;
    }

    ?>