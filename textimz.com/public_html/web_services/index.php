<?php
    session_start();
    include "config.php";
    $stmt = $conn->prepare("SELECT a.pk_i_id as i_news_id , a.s_headline, a.s_create_time, a.s_secret,a.s_slug, b.s_source from t_news_item as a, t_media as b where a.pk_i_id = b.fk_i_item_id and b_active = 1 group by i_news_id order by a.pk_i_id desc LIMIT 6,320");
    $stmt->execute();
    $stmt1 = $conn->prepare("SELECT a.pk_i_id as i_news_id , a.s_headline, a.s_create_time, a.s_secret,a.s_slug, b.s_source from t_news_item as a, t_media as b where a.pk_i_id = b.fk_i_item_id and b_active = 1 group by i_news_id order by a.s_create_time desc LIMIT 6");
    $stmt1->execute();
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>texTIMZ</title>
        <link rel="icon" href="assets/favicon.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="author" content="texTIMZ">
        <link rel="stylesheet" type="text/css" href="css/welcome.css">
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <link rel="stylesheet" type="text/css" href="css/pure-drawer.css">
        <link rel="stylesheet" type="text/css" href="css/card.css">
        <link rel="stylesheet" type="text/css" href="css/list_card.css">
        <link rel="stylesheet" type="text/css" href="css/thumb.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,700' rel='stylesheet' type='text/css'>
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
                        <li><a href="pages/career.php">Careers</a></li>
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
                    <a href="#">
                        <div class=" logo_tex"></div>
                    </a>
                </div>
                <div class= "cards">
                    <?php
                        while ($res1 = $stmt1->fetch(PDO::FETCH_ASSOC))
                                {
                                        $id    = $res1['i_news_id'];
                                        $thumb_date = date('j M', strtotime($res1['s_create_time']));
                                        $stmt2 = $conn->prepare("SELECT * FROM t_news_item WHERE pk_i_id = $id");
                                        $stmt2->execute();
                                        $res2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                                        $slug = $res2['s_slug'];
                                                        $datetoday  = date('j M', strtotime("today"));
                                        $dateyester = date('j M', strtotime("Yesterday"));
                        ?>
                    <div class="thumb" id ="<?php
                        echo $slug;
                        ?>">
                        <a href="/cards.php?id=<?php
                            echo $slug;
                            ?>" id ="<?php
                            echo $slug;
                            ?>">
                            <img src="<?php
                                echo $res1['s_source'];
                                ?>" class = thumb-img>
                            <div class="thumb-over"></div>
                            <div class="thumb-head">
                                <?php
                                    echo $res1['s_headline'];
                                    ?>
                            </div>
                    </div>
                    </a>
                    <?php
                        }
                        ?>
                </div>
                <div class = "list">
                    <?php
                        while ($res = $stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                        $id    = $res['i_news_id'];
                                        $lcard_date = date('j M', strtotime($res['s_create_time']));
                                        $stmt1 = $conn->prepare("SELECT * FROM t_news_item WHERE pk_i_id = $id");
                                        $stmt1->execute();
                                        $res1   = $stmt1->fetch(PDO::FETCH_ASSOC);
                                        $slug   = $res1['s_slug'];
                                        $secret = $res1['s_secret'];
                        ?>
                    <div class="lcard" >
                        <a href="/cards.php?id=<?php
                            echo $slug;
                            ?>" id ="<?php
                            echo $slug;
                            ?>">
                            <div class= "lcard_image">
                                <img src="<?php
                                    echo $res['s_source'];
                                    ?>" onerror="this.src='assets/img_error290X290.png'" class="limge">
                            </div>
                            <div class="lcard_title"><?php
                                echo $res['s_headline'];
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
                    </div>
                    <?php
                        }
                        ?>
                </div>
                </a>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    
                
                    $('.thumb').click(function()
                    {
                        var cid = $(this).attr('id');
                        
                    //    $( location ).attr("href", "home.php");
                    });
                    
                });        
            </script>
            <div class="footer">
                <div class="copywrite">&copytexTIMZ 2016<br>
                    MADE WITH <font color="red">&#10084;</font> IN INDIA.
                </div>
            </div>
            <div class="drawer">
            </div>
            <label class="pure-overlay" for="pure-toggle-left" data-overlay="left"></label>
        </div>
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