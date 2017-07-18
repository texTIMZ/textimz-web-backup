<?php
    session_start();
    include "config.php";
    $stmt = $conn->prepare("SELECT a.pk_i_id , a.s_headline, a.s_create_time, a.s_slug, b.s_source from t_news_item as a, t_media as b where a.pk_i_id = b.fk_i_item_id and b_active = 1 group by a.pk_i_id order by a.pk_i_id desc LIMIT 100");
    $stmt->execute();
    $ids         = array();
    $createTimes = array();
    $headlines   = array();
    $slugs       = array();
    $sources     = array();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                    $ids[]         = $result['pk_i_id'];
                    $createTimes[] = $result['s_create_time'];
                    $headlines[]   = $result['s_headline'];
                    $slugs[]       = $result['s_slug'];
                    $sources[]     = $result['s_source'];
            }
    $totalIds = count($ids);
    //echo $totalIds;
    // print_r($ids);
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>texTIMZ</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="icon" href="assets/favicon.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="author" content="texTIMZ">
        <link rel="stylesheet" type="text/css" href="css/welcome.css">
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <link rel="stylesheet" type="text/css" href="css/index_.css">
        <link rel="stylesheet" type="text/css" href="css/m.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="lib/jquery.bxslider.css" rel="stylesheet" />
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
            <div class="pure-drawer" data-paosition="left">
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
                    <div class = selector_wrapper>
                        <div class = index_head>
                            <label class = latest_news>latest NEWS</label>
                        </div>
<div class = slider><?php
                                                                            for ($i = 0; $i < 4; $i++)
                                                                                    {
                                                                                            $id         = $ids[$i];
                                                                                            $thumb_date = date('j M', strtotime($createTimes[$i]));
                                                                                            $slug       = $slugs[$i];
                                                                                            $source     = $sources[$i];
                                                                                            $headline   = $headlines[$i];
                                                                                            $datetoday  = date('j M', strtotime("today"));
                                                                                            $dateyester = date('j M', strtotime("Yesterday"));
                                                                            ?>
                                                                        <div class="thumb" id ="<?php
                                                                            echo $slug;
                                                                            ?>">
                                                                            <a href="./cards.php?id=<?php
                                                                                echo $slug;
                                                                                ?>" id ="<?php
                                                                                echo $slug;
                                                                                ?>">
                                                                                <img src="<?php
                                                                                    echo $source;
                                                                                    ?>" class = thumb-img>
                                                                                <!--<div class="thumb-over"></div>-->
                                                                                <div class="thumb-head">
                                                                                    <?php
                                                                                        echo $headline;
                                                                                        ?>
                                                                                </div>
                                                                        </div>
                                                                        </a>
                                                                        <?php
                                                                            }
                                                                            ?>
                                                                    </div>
                        <div class = thumbs_index>
                            <a href = http://blog.textimz.com/?cat=2>
                                <div class = index_option><img src = "http://blog.textimz.com/wp-content/uploads/2016/11/Kapok-375x195.jpg" style="height: 85%; width: 100%"><div class = index_option_name>
                                    what IS?
                                </div></div></a>
                                <a href = http://blog.textimz.com/?cat=3>
                                <div class = index_option style=left:234px><img src = "http://blog.textimz.com/wp-content/uploads/2016/11/cats-247x195.jpg" style="height: 85%; width: 100%"><div class = index_option_name>
                                    tex JOKES
                                </div></div></a>
				<div class = vid><iframe width="409" height="230" src="https://www.youtube.com/embed/Q3GG4JJQRQA" frameborder="0" allowfullscreen></iframe></div>
                                </div>
                        <!--
                            <div class = thumbs_index>
                            <a href = http://blog.textimz.com/?page_id=173>
                                <div class = index_option><img src = /assets/tex_jokes.jpg style="height: 80%; width: 100%"><div class = index_option_name>
                                    TEX JOKES
                                </div></div></a>
                                <div class = newsweave_block>
                                <div class = newsweave_head>
                                Get our daily e-letter, Newsweave. <br> Type in your email.
                                 <br>
                                 </div>
                                 <div class = newsweave_form>
                                <form method="POST" class="newsweave_form">
                                    <div class="group">      
                                        <input type="text" required>
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                            <label>Email</label>
                                </div>
                                    <input type="submit" name="submit" value="Subscribe" class = "btn">
                                </form>
                                </div>
                                <?php
                                include "user/config_subscriber.php";
                                include "user/ip.php";
                                if (isset($_POST['email'])) {
                                
                                    $email = $_POST['email'];
                                
                                    $ip = get_client_ip();
                                    $country = ip_info( $ip, "Country");
                                
                                    $stmt = $db->prepare("INSERT INTO t_subscribers(s_email,s_country,s_ip) VALUES(:email ,:country, :ip)");
                                    $stmt->bindParam(':email', $email);
                                    $stmt->bindParam(':country', $country);
                                    $stmt->bindParam(':ip', $ip);
                                    $stmt->execute();
                                    unset($stmt);
                                }
                                ?>
                                    
                                </div>
                                <a href = http://blog.textimz.com/?page_id=176>
                                <div class = index_option style="float: right"><img src = /assets/what_is.jpg style="height: 80%; width: 100%"><div class = index_option_name>
                                    WHAT IS?
                                </div></div></a>
                            
                            </div> -->
                    </div>
                    <!--
                        <div class= "thumbs">
                        
                            <?php
                            for ($i = 0; $i < 6; $i++)
                                    {
                                            $id         = $ids[$i];
                                            $thumb_date = date('j M', strtotime($createTimes[$i]));
                                            $slug       = $slugs[$i];
                                            $source     = $sources[$i];
                                            $headline   = $headlines[$i];
                                            $datetoday  = date('j M', strtotime("today"));
                                            $dateyester = date('j M', strtotime("Yesterday"));
                            ?>
                            <div class="thumb" id ="<?php
                            echo $slug;
                            ?>">
                                <a href="./cards.php?id=<?php
                            echo $slug;
                            ?>" id ="<?php
                            echo $slug;
                            ?>">
                                    <img src="<?php
                            echo $source;
                            ?>" class = thumb-img>
                                    <div class="thumb-over"></div>
                                    <div class="thumb-head">
                                        <?php
                            echo $headline;
                            ?>
                                    </div>
                            </div>
                            </a>
                            <?php
                            }
                            ?>
                        </div> -->
                    <div class = "mlist">
                        <?php
                            for ($i = 0; $i < $totalIds; $i++)
                                    {
                                            $id         = $ids[$i];
                                            $lcard_date = date('j M', strtotime($createTimes[$i]));
                                            $slug       = $slugs[$i];
                                            $source     = $sources[$i];
                                            $headline   = $headlines[$i];
                                            $datetoday  = date('j M', strtotime("today"));
                                            $dateyester = date('j M', strtotime("Yesterday"));
                            ?>
                        <div class="lcard" >
                            <a href="./cards.php?id=<?php
                                echo $slug;
                                ?>" id ="<?php
                                echo $slug;
                                ?>">
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
                        </div>
                        </a>
                        <?php
                            }
                            ?>
                    </div>
<script type="text/javascript">
$('.bxslider').bxSlider({
  mode: 'vertical',
  speed: '700',
autoHover: true,
auto: true,


});
</script>
                    <div class = "ilist" id=ilist>
<ul class="bxslider" style="list-style: none; line-height: inherit; padding:0px;">
<?php
                            for ($i = 4; $i <= 14; $i++)
                                    {
                                            $id         = $ids[$i];
                                            $lcard_date = date('j M', strtotime($createTimes[$i]));
                                            $slug       = $slugs[$i];
                                            $source     = $sources[$i];
                                            $headline   = $headlines[$i];
                                            $datetoday  = date('j M', strtotime("today"));
                                            $dateyester = date('j M', strtotime("Yesterday"));
                            ?>
                       <li> <div class="lcard" >
                            <a href="./cards.php?id=<?php
                                echo $slug;
                                ?>" id ="<?php
                                echo $slug;
                                ?>">
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
                        </div>
                        </a></li>
                        <?php
                            }
                            ?>
                    </div>
                    <div class = newsweave_block>
                        <div class = newsweave_head>
                            Get our daily e-letter, Newsweave. <br> Type in your email.
                            <br>
                        </div>
                        <div class = newsweave_form>
                            <form method="POST" class="newsweave_form">
                                <div class="group">      
                                    <input type="text" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Email</label>
                                </div>
                                <input type="submit" name="submit" value="Subscribe" class = "btn">
                            </form>
                        </div>
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
                    <a href="http://madewithlove.org.in" target="_blank">Made with <span style="color: #e74c3c">&hearts;</span> in India</a>
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
