<?php
    session_start();
    include "config.php";
    $stmt = $conn->prepare("SELECT a.pk_i_id ,a.fk_i_user_id, a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link, d.s_fname , d.s_lname , d.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d where a.pk_i_id = b.fk_i_item_id and a.fk_i_user_id = d.pk_i_id and c.fk_i_news_item_id = a.pk_i_id group by a.pk_i_id order by a.pk_i_id desc LIMIT 100");
    $stmt->execute();
        $ids[]= array();
        $createTimes[]= array();
        $headlines[]= array();
        $slugs[]= array();
        $sources[]=array();
        $contents[]= array();
        $link_names[] = array();
        $links[] = array();
        $fnames[] = array();
        $lnames[] = array();
        $items = array();

    while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $ids[]= $result['pk_i_id'];
        $createTimes[]= $result['s_create_time'];
        $headlines[]= $result['s_headline'];
        $slugs[]= $result['s_slug'];
        $sources[]=$result['s_source'];
        $contents[]= $result['s_content'];
        $link_names[] = $result['link_name'];
        $links[] = $result['link'];
        $fnames[] = $result['s_fname'];
        $lnames[] = $result['s_lname'];

    }
    $totalIds = count($ids);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include "./config.php";
if (isset($_GET['id']))
        {
                $slug_id = $_GET['id'];
                $query   = $conn->prepare("SELECT * from t_news_item WHERE `s_slug` = :slug_id");
                $query->bindParam('slug_id', $slug_id);
                $query->execute();
                $news   = $query->fetch(PDO::FETCH_ASSOC);
                $nid    = $news['pk_i_id'];
                $card_date   = date('j M', strtotime($news['s_create_time']));
                $uid    = $news['fk_i_user_id'];
                $query1 = $conn->prepare("SELECT * from t_media WHERE `fk_i_item_id` = :nid");
                $query1->bindParam('nid', $nid);
                $query1->execute();
                $image  = $query1->fetch(PDO::FETCH_ASSOC);
                $query2 = $conn->prepare("SELECT * from t_user WHERE `pk_i_id` = :uid");
                $query2->bindParam('uid', $uid);
                $query2->execute();
                $user   = $query2->fetch(PDO::FETCH_ASSOC);
                $query3 = $conn->prepare("SELECT * from t_link WHERE `fk_i_news_item_id` = :nid");
                $query3->bindParam('nid', $nid);
                $query3->execute();
                $lid        = $query3->fetch(PDO::FETCH_ASSOC);
                $datetoday  = date('j M', strtotime("today"));
                $dateyester = date('j M', strtotime("Yesterday"));

?>

    <meta charset="UTF-8">
    <title>texTIMZ</title>
      <link rel="icon" href="assets/favicon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="texTIMZ">
    <link rel="stylesheet" type="text/css" href="css/welcome.css">
    <link rel="stylesheet" type="text/css" href="css/m.css">
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="css/scroll.css">
    <link rel="stylesheet" type="text/css" href="css/pure-drawer.css">
    <link rel="stylesheet" type="text/css" href="css/card.css">
    <link rel="stylesheet" type="text/css" href="css/list_card.css">
    <link rel="stylesheet" type="text/css" href="css/thumb.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,700' rel='stylesheet' type='text/css'>
    <!-- for Facebook -->          
<meta property="og:title" content="<?php
                echo $news['s_headline'];
?>" />
<meta property="og:type" content="News" />
<meta property="og:image" content="<?php
                echo $image['s_source'];
?>" />
<meta property="og:url" content="<?php
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
echo $url;
?>" />
<meta property="og:description" content="<?php
                echo $news['s_content'];
?>" />

<!-- for Twitter -->          
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php
                echo $news['s_headline'];
?>" />
<meta name="twitter:description" content="<?php
                echo $news['s_content'];
?>" />
<meta name="twitter:image" content="<?php
                echo $image['s_source'];
?>" />
</head>
<body>
    <!--DRAWER MAMLA-->
    <div class="pure-container" data-effect="pure-effect-reveal">
        <input type="checkbox" id="pure-toggle-left" class="pure-toggle" data-toggle="left"> 

        <label class="pure-toggle-label" for="pure-toggle-left" data-toggle-label="left"> 

            <span class="pure-toggle-icon"></span> 
        </label> 
        <div class="pure-drawer" data-position="left">
            <div class="row collapse">
                <div class="large-12 columns">
                    <ul class="nav-primary" style="list:style=none;text-align: left">
                        <li><a href="pages/career.php">Career</a></li>
                        <li><a href="pages/contact.php">Contact Us</a></li>
                        <li><a href="pages/terms.php">Terms of Use</a></li>
                        <li><a href="pages/team.php">Team</a></li>
                     </ul> 
                </div>
            </div>
        </div>
        <div class="pure-pusher-container">
            <div class="pure-pusher">


                <div class="head">
                 <a href="index.php"><div class=" logo_tex"></div></a>
                </div>
                <div class= "cards">
                    <div class="card"><a href="cards.php?id= <?php echo $slug; ?>" id ="<?php echo $slug; ?>"></a>
                                <div class= "card_image">
                                    <img src="<?php
                echo $image['s_source'];
?> "onerror="this.src='assets/img_error290X290.png'" class="imge">
                                </div>
                                <div class="card_title"><?php
                echo $news['s_headline'];
?></div>
                                <div class="auth_details"><?php
                echo $user['s_fname'] . " " . $user['s_lname'];
?></div>
                                <div class="card_date"><?php
                if ($card_date == $datetoday)
                        {
                                echo "Today";
                        }
                elseif ($card_date == $dateyester)
                        {
                                echo "Yesterday";
                        }
                else
                        {
                                echo $card_date;
                        }
?></div>
                                <div class="card_content">
                                    <?php
                echo $news['s_content'];
?>
                               </div>

                                                        <div class="social-buttons">
<div class="addthis_sharing_toolbox"></div>
                            </div>
                                <div class="card_footer"> 
<div class="mauth_details"><?php
                echo $user['s_fname'] . " " . $user['s_lname'];
?></div>
                                    <div class="footer_static">
                                        more at
                                    </div>
                                    <div class="footer_dynamic">
                                        <a href="<?php
                echo $lid['link'];
?>" target="_blank"><?php
                echo $lid['link_name'];
?></a>
                                    </div>
                                

                                </div>
                            </div></a>
                            <?php
        }
?>
<div class = "buttons-item">
<button class = "next_button"></button>
<button class = "prev_button"></button>
</div>
                           </div>

                <div class = "list">
                <?php
                for ($i=1; $i < $totalIds ; $i++)
                {
                        $id    = $ids[$i];
                        $lcard_date = date('j M', strtotime($createTimes[$i]));
                        $slug   = $slugs[$i];
                        $source = $sources[$i];
                        $headline = $headlines[$i];
                        $datetoday  = date('j M', strtotime("today"));
                        $dateyester = date('j M', strtotime("Yesterday"));
                        $items[] = $slug;

?>                        
                    <div class = "card_id" ><a href="cards.php?id=<?php echo $slug; ?>"  class="lcard" >
                         <div class= "lcard_image">
                            <img src="<?php
                echo $source;
?>" onerror="this.src='assets/img_error290X290.png'" class="limge">
                        </div>
                        <div class="lcard_title"><?php
                echo $headline;
?></div>
                        <div class="lcard_date"><?php
                if ($lcard_date == $datetoday)
                        {
                                echo "Today";
                        }
                elseif ($lcard_date == $dateyester)
                        {
                                echo "Yesterday";
                        }
                else
                        {
                                echo $lcard_date;
                        }
?></div>
                        </a>
                        
                    </div>
                      <?php
     }
?>
<?php //print_r($items); ?>
<script type='text/javascript'>
function getUrlVars() {
var vars = {};
var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
vars[key] = value;
});
return vars;
}

    var items = [<?php echo '"'.implode('","', $items).'"' ?>];
    var item_slug = getUrlVars()["id"];
                //alert(item_slug);
                function id_to_slug() {
                    var arrlen = items.length;
                    var i;
                    for (i=0; i<arrlen; i++){
                        if(items[i] == item_slug){
                            var i_id = i;
                            //alert(i_id); 
                        } 

                    }
                return(i_id);
                }
    function leftpress() {
        var current_add = id_to_slug();
        if(current_add>0){
        var prev_add = current_add - 1;}
        else{
            prev_add = items.length - 1;
        }
        window.location.href = "cards.php?id=" + items[prev_add];


       
}
    function rightpress() {
        var current_add = id_to_slug();
        if(current_add<items.length-1){
        var next_add = current_add + 1;}
        else{
            next_add = 0;
        
    }
        window.location.href = "cards.php?id=" + items[next_add];

    }

    document.onkeydown = function(evt) {
        evt = evt || window.event;
        switch (evt.keyCode) {
            case 37://left arrow
                leftpress();
                break;
            case 39://right arrow
                rightpress();
                break;
        }
    };
    $('.next_button').click(function(){rightpress()});
    $('.prev_button').click(function(){leftpress()});
document.getElementById("<?php echo $nid ?>").scrollIntoView({behavior: "smooth"});
</script>

                   </div>


                <div class="footer">

                    <div class="copywrite">&copytexTIMZ 2016<br>
                        <a href="http://madewithlove.org.in" target="_blank">Made with <span style="color: #e74c3c">&hearts;</span> in India</a>
                    </div>



                    <div class="drawer">
                    </div>

                    <label class="pure-overlay" for="pure-toggle-left" data-overlay="left"></label>
                </div>




<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-577b73a42e0c3381"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-577b73a42e0c3381"></script>


            </body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82466846-1', 'auto');
  ga('send', 'pageview');

</script>
            </html>

