<?php
use yii\bootstrap\Nav;

if ( isset(Yii::$app->params["remoteApiServer"]) ){
    $serverApi = Yii::$app->params["remoteApiServer"];
    $list = Yii::$app->params["listOfAlltTypes"];
}
else
    return false;
//echo $serverApi.'/'.$list;
$json = file_get_contents($serverApi.'/'.$list);

$types_array = json_decode($json, false);

?>
<aside class="main-sidebar">

    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul id="w0" class="sidebar-menu nav">
            <li class="header">Меню карти</li>
            <?php
            foreach($types_array as $type){
            echo "<li><a href='/index/{$type->value}'</a><i class='fa fa-file-code-o'></i><span>{$type->name} </span></a></li>";
            //
            } ?>
            <li><a href="/site/add"><i class="fa fa-dashboard"></i><span>Додаты новый пункт</span></a></li>

            <li><a href="/site/about"><i class="fa fa-dashboard"></i><span>Про команду</span></a></li>
            <li><a href="/site/mobile"><i class="fa fa-dashboard"></i><span>Моб. Додаток</span></a></li>
            <li><a href="/site/getapi"><i class="fa fa-dashboard"></i><span>Наше вiдкрите Api</span></a></li>

        </ul>


    </section>

</aside>