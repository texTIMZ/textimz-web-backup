

<?php
    session_start();
    include "config.php";
    $stmt = $conn->prepare("SELECT a.pk_i_id , a.s_headline, a.s_create_time, a.s_slug, a.s_content, b.s_source from t_news_item as a, t_media as b where a.pk_i_id = b.fk_i_item_id and b_active = 1 group by a.pk_i_id order by a.pk_i_id desc LIMIT 100");
    $stmt->execute();
    $ids         = array();
    $createTimes = array();
    $headlines   = array();
    $slugs       = array();
    $sources     = array();
    $contents = array();
    $card_date = array();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                    $ids[]         = $result['pk_i_id'];
                    $createTimes[] = $result['s_create_time'];
                    $headlines[]   = $result['s_headline'];
                    $slugs[]       = $result['s_slug'];
                    $sources[]     = $result['s_source'];
                    $contents[]     = $result['s_content'];
                    $card_date[] = date('j M', strtotime($result['s_create_time']));
            }
    $totalIds = count($ids);

    $stmt1 = $conn->prepare("SELECT * FROM s_categories");
    $stmt1->execute();
    $categories = array();
    while ($cat = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    	$categories[] = $cat['categories_name'];
    }
    $totalCats = count($categories);
    //echo $totalIds;
    // print_r($ids);
     $stmt1 = $conn->prepare("SELECT a.pk_i_id , a.s_headline, a.s_create_time, a.s_slug, a.s_content, b.s_source from t_news_item as a, t_media as b where a.pk_i_id = b.fk_i_item_id and b_publish = 1 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt1->execute();
    $featured_ids         = array();
    $featured_createTimes = array();
    $featured_headlines   = array();
    $featured_slugs       = array();
    $featured_sources     = array();
    $featured_contents = array();
    $featured_card_date = array();
    while ($result1 = $stmt1->fetch(PDO::FETCH_ASSOC))
            {
                    $featured_ids[]         = $result1['pk_i_id'];
                    $featured_createTimes[] = $result1['s_create_time'];
                    $featured_headlines[]   = $result1['s_headline'];
                    $featured_slugs[]       = $result1['s_slug'];
                    $featured_sources[]     = $result1['s_source'];
                    $featured_contents[]     = $result1['s_content'];
                    $featured_card_date[] = date('j M', strtotime($result1['s_create_time']));
            }

     $stmt2 = $conn->prepare("SELECT a.pk_i_id , a.event_name, a.date_start,a.fk_country_id, a.details, a.venue,  b.s_source  from t_events as a, t_media_events as b where a.pk_i_id = b.fk_event_id group by a.pk_i_id ORDER BY MONTH(a.date_start) desc LIMIT 20");
    $stmt2->execute();
    $event_ids         = array();
    $event_date_start = array();
    $event_name   = array();
    $event_country_id       = array();
    $event_sources     = array();
    $event_countries = array();
    $event_details = array();
    $event_date = array();
    $event_venue = array();
    while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC))
            {
                    $event_ids[]         = $result2['pk_i_id'];
                    $event_date_start[] = $result2['date_start'];
                    $event_name[]   = $result2['event_name'];
                    $event_country_id[]       = $result2['fk_country_id'];
                    $event_sources[]     = $result2['s_source'];
                    $event_details[]     = $result2['details'];
                    $event_venue[]     = $result2['venue'];
                    $event_date[] = date('j M', strtotime($result2['date_start']));
                }
                $totalEvents = count($event_ids);

    for ($i=0; $i < $totalEvents; $i++) 
    { 
    $country_id = $event_country_id[$i];
    $query = $conn->prepare("SELECT country_name FROM s_country WHERE pk_i_id = :country_id  ");
    $query->bindParam(':country_id', $country_id);
    $query->execute();
    $country = $query->fetch(PDO::FETCH_ASSOC);
    $event_countries[$i] = $country['country_name'];
    }
     //print_r($event_ids);

    $stmt3 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 1 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt3->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $a_createTimes = array();
    $a_headlines   = array();
    $a_slugs       = array();
    $a_sources     = array();
    $a_contents = array();
    $a_card_date = array();
    while ($apparel = $stmt3->fetch(PDO::FETCH_ASSOC))
            {
                    $a_createTimes[] = $apparel['s_create_time'];
                    $a_headlines[]   = $apparel['s_headline'];
                    $a_slugs[]       = $apparel['s_slug'];
                    $a_sources[]     = $apparel['s_source'];
                    $a_contents[]     = $apparel['s_content'];
                    $a_card_date[] = date('j M', strtotime($apparel['s_create_time']));
            }
    $a_totalIds = count($a_headlines);

    $stmt4 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 2 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt4->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $t_createTimes = array();
    $t_headlines   = array();
    $t_slugs       = array();
    $t_sources     = array();
    $t_contents = array();
    $t_card_date = array();
    while ($textile = $stmt4->fetch(PDO::FETCH_ASSOC))
            {
                    $t_createTimes[] = $textile['s_create_time'];
                    $t_headlines[]   = $textile['s_headline'];
                    $t_slugs[]       = $textile['s_slug'];
                    $t_sources[]     = $textile['s_source'];
                    $t_contents[]     = $textile['s_content'];
                    $t_card_date[] = date('j M', strtotime($textile['s_create_time']));
            }
    $t_totalIds = count($t_headlines);

    $stmt5 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 3 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt5->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $f_createTimes = array();
    $f_headlines   = array();
    $f_slugs       = array();
    $f_sources     = array();
    $f_contents = array();
    $f_card_date = array();
    while ($Fashion = $stmt5->fetch(PDO::FETCH_ASSOC))
            {
                    $f_createTimes[] = $Fashion['s_create_time'];
                    $f_headlines[]   = $Fashion['s_headline'];
                    $f_slugs[]       = $Fashion['s_slug'];
                    $f_sources[]     = $Fashion['s_source'];
                    $f_contents[]     = $Fashion['s_content'];
                    $f_card_date[] = date('j M', strtotime($Fashion['s_create_time']));
            }
    $f_totalIds = count($f_headlines);

   $stmt6 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 11 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt6->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $inst_createTimes = array();
    $inst_headlines   = array();
    $inst_slugs       = array();
    $inst_sources     = array();
    $inst_contents = array();
    $inst_card_date = array();
    while ($Institutional = $stmt6->fetch(PDO::FETCH_ASSOC))
            {
                    $inst_createTimes[] = $Institutional['s_create_time'];
                    $inst_headlines[]   = $Institutional['s_headline'];
                    $inst_slugs[]       = $Institutional['s_slug'];
                    $inst_sources[]     = $Institutional['s_source'];
                    $inst_contents[]     = $Institutional['s_content'];
                    $inst_card_date[] = date('j M', strtotime($Institutional['s_create_time']));
            }
    $inst_totalIds = count($inst_headlines);

    $stmt7 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 5 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt7->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $tech_createTimes = array();
    $tech_headlines   = array();
    $tech_slugs       = array();
    $tech_sources     = array();
    $tech_contents = array();
    $tech_card_date = array();
    while ($tech = $stmt7->fetch(PDO::FETCH_ASSOC))
            {
                    $tech_createTimes[] = $tech['s_create_time'];
                    $tech_headlines[]   = $tech['s_headline'];
                    $tech_slugs[]       = $tech['s_slug'];
                    $tech_sources[]     = $tech['s_source'];
                    $tech_contents[]     = $tech['s_content'];
                    $tech_card_date[] = date('j M', strtotime($tech['s_create_time']));
            }
    $tech_totalIds = count($tech_headlines);

    $stmt8 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 6 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt8->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $c_createTimes = array();
    $c_headlines   = array();
    $c_slugs       = array();
    $c_sources     = array();
    $c_contents = array();
    $c_card_date = array();
    while ($Corporate = $stmt8->fetch(PDO::FETCH_ASSOC))
            {
                    $c_createTimes[] = $Corporate['s_create_time'];
                    $c_headlines[]   = $Corporate['s_headline'];
                    $c_slugs[]       = $Corporate['s_slug'];
                    $c_sources[]     = $Corporate['s_source'];
                    $c_contents[]     = $Corporate['s_content'];
                    $c_card_date[] = date('j M', strtotime($Corporate['s_create_time']));
            }
    $c_totalIds = count($c_headlines);

    $stmt9 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 9 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt9->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $r_createTimes = array();
    $r_headlines   = array();
    $r_slugs       = array();
    $r_sources     = array();
    $r_contents = array();
    $r_card_date = array();
    while ($Retail = $stmt9->fetch(PDO::FETCH_ASSOC))
            {
                    $r_createTimes[] = $Retail['s_create_time'];
                    $r_headlines[]   = $Retail['s_headline'];
                    $r_slugs[]       = $Retail['s_slug'];
                    $r_sources[]     = $Retail['s_source'];
                    $r_contents[]     = $Retail['s_content'];
                    $r_card_date[] = date('j M', strtotime($Retail['s_create_time']));
            }
    $r_totalIds = count($r_headlines);

$stmt10 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 7 group by a.pk_i_id order by a.pk_i_id desc LIMIT 10");
    $stmt10->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $i_createTimes = array();
    $i_headlines   = array();
    $i_slugs       = array();
    $i_sources     = array();
    $i_contents = array();
    $i_card_date = array();
    while ($Innovation = $stmt10->fetch(PDO::FETCH_ASSOC))
            {
                    $i_createTimes[] = $Innovation['s_create_time'];
                    $i_headlines[]   = $Innovation['s_headline'];
                    $i_slugs[]       = $Innovation['s_slug'];
                    $i_sources[]     = $Innovation['s_source'];
                    $i_contents[]     = $Innovation['s_content'];
                    $i_card_date[] = date('j M', strtotime($Innovation['s_create_time']));
            }
    $i_totalIds = count($i_headlines);

    $stmt11= $conn->prepare("SELECT * FROM t_videos");
    $stmt11->execute();
    $Video_name = array();
    $link = array();
    while ($videos = $stmt11->fetch(PDO::FETCH_ASSOC))
            {
                    $Video_name[] = $videos['video_name'];
                    $link[]   = $videos['link'];
            }

?>

<!DOCTYPE html>

<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->

<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->

<!--[if IE 9]>
<html class="ie ie9" lang="en-US">
<![endif]-->

<!--[if !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html lang="en-US">
<!--<![endif]-->

<head>
<title>texTIMZ | Textile Information Network</title>
<meta charset="UTF-8" />
<link rel="shortcut icon" href="images/favicon.png" title="Favicon"/>
<meta name="viewport" content="width=device-width" />

<link rel='stylesheet' id='magz-style-css'  href='style.css' type='text/css' media='all' />
<link rel='stylesheet' id='swipemenu-css'  href='css/swipemenu.css' type='text/css' media='all' />
<link rel='stylesheet' id='flexslider-css'  href='css/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css'  href='css/bootstrap.css' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-responsive-css'  href='css/bootstrap-responsive.css' type='text/css' media='all' />
<link rel='stylesheet' id='simplyscroll-css'  href='css/jquery.simplyscroll.css' type='text/css' media='all' />
<link rel='stylesheet' id='jPages-css'  href='css/jPages.css' type='text/css' media='all' />
<link rel='stylesheet' id='rating-css'  href='css/jquery.rating.css' type='text/css' media='all' />
<link rel='stylesheet' id='ie-styles-css'  href='css/ie.css' type='text/css' media='all' />
<link rel='stylesheet' id='Roboto-css'  href='http://fonts.googleapis.com/css?family=Roboto' type='text/css' media='all' />

<script type='text/javascript' src="js/jquery-1.10.2.min.js"></script>
<script type='text/javascript' src='js/html5.js'></script>
<script type='text/javascript' src='js/bootstrap.min.js'></script>
<script type='text/javascript' src='js/jquery.flexslider.js'></script>
<script type='text/javascript' src='js/jquery.flexslider.init.js'></script>
<script type='text/javascript' src='js/jquery.bxslider.js'></script>
<script type='text/javascript' src='js/jquery.bxslider.init.js'></script>
<script type='text/javascript' src='js/jquery.rating.js'></script>
<script type='text/javascript' src='js/jquery.idTabs.min.js'></script>
<script type='text/javascript' src='js/jquery.simplyscroll.js'></script>
<script type='text/javascript' src='js/fluidvids.min.js'></script>
<script type='text/javascript' src='js/jPages.js'></script>
<script type='text/javascript' src='js/jquery.sidr.min.js'></script>
<script type='text/javascript' src='js/jquery.touchSwipe.min.js'></script>
<script type='text/javascript' src='js/custom.js'></script>

        <!-- END -->

</head>

<body>

<div id="page">

    <header id="header" class="container">
        <div id="mast-head">
            <div id="logo">
            <a href="index.php" title="Magazine" rel="home"><img src="images/logo.png" alt="Magazine" /></a>
            </div>
        </div>

                
        <nav class="navbar navbar-inverse clearfix nobot">
                        
            <a id="responsive-menu-button" href="#swipe-menu">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>        
            </a>    

            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse" id="swipe-menu-responsive">

            <ul class="nav">
                
                <li>
                <span id="close-menu">
                    <a href="#" class="close-this-menu">Close</a>
                        <script type="text/javascript">
                            jQuery('a.sidr-class-close-this-menu').click(function(){
                                jQuery('div.sidr').css({
                                    'right': '-476px'
                                });
                                jQuery('body').css({
                                'right': '0'
                                });                         
                            });
                        </script>
                    
                </span>
                </li>
                                
                <li><a href="index.php"><img src="images/home.png" alt="Magazine"></a></li>
                <li><a href="contact.html">Highlights</a></li>
                <li><a href="contact.html">Events</a></li>
                <!--
                TODO: jobs section
                <li><a href="contact.html">Jobs</a></li>
                -->
                </li>
                <li class="dropdown"><a href="##">Categories</a>
                    <ul class="sub-menu">
                        <li><a href="category.php?cat=Apparel">Apparel</a></li>
                        <li><a href="category.php?cat=Textile">Textile</a></li>
                        <li><a href="category.php?cat=Fashion">Fashion</a></li>
                        <li><a href="category.php?cat=Technical textile">Technical Textile</a></li>
                        <li><a href="category.php?cat=Technology">Technology</a></li>
                        <li><a href="category.php?cat=Corporate">Corporate</a></li>
                        <li><a href="category.php?cat=Innovation">Innovation</a></li>
                        <li><a href="category.php?cat=Events">Events</a></li>
                        <li><a href="category.php?cat=Retail">Retail</a></li>
                        <li><a href="category.php?cat=E-Commerce">E-Commerce</a></li>
                        <li><a href="category.php?cat=Institutional">Institutional</a></li>
                    </ul>
                </li>
                <li><a href="terms.html">Terms of Use</a></li>
                <li><a href="contact.html">Career</a></li>
                <li><a href="contact.html">Team</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            </div><!--/.nav-collapse -->
            
        </nav><!-- /.navbar -->
            
    </header><!-- #masthead -->

    <div id="headline" class="container">
    <div class="row-fluid">
        
        <div class="span6">
            <article class="post">
                <a href=""> <!--TODO: Put link php-->
                    <img src=""> <!--TODO: Put banner image php, create database for ad banners-->
                </a>
            </article>
        </div>
        
        <div class="span6">
            <article class="post">
                <a href=""> <!--TODO: Put link php-->
                    <img src=""> <!--TODO: Put banner image php, create database for ad banners-->
                </a>
            </article>
        </div>
        
    </div>
    </div>

	<div id="intr" class="container">
		<div class="row-fluid">
			<div class="brnews span9">
				<h3>Upcoming Events</h3>
				<ul id="scroller"><!--TODO: put php of events-->
				<?php for ($i=0; $i < 3; $i++) { ?>
					<li><p><a href="#" title="<?php echo $event_name[$i];?>" rel="bookmark"><span class="title"><?php echo $event_name[$i];?>...</span> <?php echo $event_date[$i]." ".$event_countries[$i]; ?></a></p></li>
					<?php }  ?>
				</ul>
			</div>
		
		<div class="search span3"><div class="offset1">
			<form method="get" id="searchform" action="#"><!--TODO: put searcg feature-->
				<p><input type="text" value="Search here..." onfocus="if ( this.value == 'Search here...' ) { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = 'Search here...'; }" name="s" id="s" />
				<input type="submit" id="searchsubmit" value="Search" /></p>
			</form>
		</div></div>
		</div>
	</div>

	<div id="content" class="container">

		<div id="main" class="row-fluid">
			<div id="main-left" class="span8">
				<div id="slider" class="clearfix">
					<div id="slide-left" class="flexslider span8">
						<ul class="slides">
						<?php for ($i=0; $i < 4 ; $i++) {  ?>
							<li data-thumb="<?php echo $featured_sources[$i]; ?>">
								<a href="./news.php?id=<?php echo $featured_slugs[$i]; ?>" title="<?php echo $featured_headlines[$i]; ?>" rel="bookmark">
								<img width="546" height="291" src="<?php echo $featured_sources[$i]; ?>" alt="<?php echo $featured_headlines[$i]; ?>" />
								</a>
								<div class="entry">
									<h4><?php echo $featured_headlines[$i]; $small = substr($featured_contents[$i], 0, 60); ?>...</h4>
									<p><?php echo $small; ?>...</p>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>

					<div id="slide-right" class="span4">
						<h3>Most Popular</h3>
							<ul>
							<?php for ($i=0; $i < 4 ; $i++) {  ?>
								<li><a href="./cards.php?id=<?php echo $slugs[$i]; ?>" title="<?php echo $headlines[$i]; ?>" rel="bookmark"><h4 class="post-title"><?php echo $headlines[$i]; ?></h4></a></li>
								<?php } ?>
							</ul><div class="clear"></div>
					</div>
				</div>
				
				<div id="home-top">
					<h3 class="title"><span>Events</span></h3>
					<ul class="bxslider">
					<?php for ($i=0; $i < $totalEvents ; $i++) {  ?>
						<li><a class="image_thumb_zoom" href="#" title="<?php echo $event_name[$i]; ?>" rel="bookmark">
							<img width="225" height="136" src="<?php echo $event_sources[$i]; ?>" alt="<?php echo $event_name[$i]; ?>" />
							</a>
							<h4 class="post-title clearfix">
								<img class="post-icon" alt="<?php echo $event_name[$i]; ?>" src="images/image.png">
								<a href="#" title="<?php echo $event_name[$i]; ?>"><?php echo $event_name[$i]; ?></a>
							</h4>
							<div class="meta clearfix">
								<span class="date"><?php echo $event_date[$i]; ?></span>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
				
				<div id="home-middle" class="clearfix">
					<div class="left span6">
						<h3 class="title"><a href="category.php?cat=apparel" title="Apparel"><span>Apparel</span></a></h3>
						<div class="row-fluid">	
						<article class="post">
								<a class="image_thumb_zoom" href="#" title="<?php echo $a_headlines[0]; ?>" rel="bookmark">
								<img width="371" height="177" src="<?php echo $a_sources[0]; ?>" alt="" />
								</a>
								<h4 class="post-title">
								<a href="#" title="<?php echo $a_headlines[0]; ?>" rel="bookmark"><?php echo $a_headlines[0]; ?></a>
								<span class="date"><?php echo $a_card_date[0]; ?></span>
								</h4>
								<p><?php $small = substr($a_contents[0], 0, 100); echo $small; ?>...</p>
							</article>
						<article class="post">
								<div class="entry clearfix">
									<a href="#" title="<?php echo $a_headlines[1]; ?>" rel="bookmark">
									<img width="225" height="136" src="<?php echo $a_sources[1]; ?>" class="thumb" alt="" />
									<h4 class="post-title"><?php echo $a_headlines[1]; ?>...</h4>
									</a>
									<p><?php $small = substr($a_contents[1], 0, 100); echo $small; ?>...</p>
									<div class="meta">
										<span class="date"><?php echo $a_card_date[1]; ?></span>
									</div>
								</div>
							</article>
							<article class="post">
								<div class="entry clearfix">
									<a href="#" title="<?php echo $a_headlines[2]; ?>" rel="bookmark">
									<img width="225" height="136" src="<?php echo $a_sources[2]; ?>" class="thumb" alt="" />
									<h4 class="post-title"><?php echo $a_headlines[2]; ?></h4>
									</a>
									<p><?php $small = substr($a_contents[2], 0, 100); echo $small; ?>...</p>
									<div class="meta">
										<span class="date"><?php echo $a_card_date[2]; ?></span>
									</div>
								</div>
							</article>


							<div class="clearfix"></div>
						</div>
					</div>

					<div class="right span6">
						<h3 class="title"><a href="category.php?cat=textile" title="Textile"><span>Textile</span></a></h3>
							<div class="row-fluid">
								<article class="post">
								<a class="image_thumb_zoom" href="#" title="<?php echo $t_headlines[0]; ?>" rel="bookmark">
								<img width="371" height="177" src="<?php echo $t_sources[0]; ?>" alt="" />
								</a>
								<h4 class="post-title">
								<a href="#" title="<?php echo $t_headlines[0]; ?>" rel="bookmark"><?php echo $t_headlines[0]; ?></a>
								<span class="date"><?php echo $t_card_date[0]; ?></span>
								</h4>
								<p><?php $small = substr($t_contents[0], 0, 100); echo $small; ?>...</p>
							</article>
						<article class="post">
								<div class="entry clearfix">
									<a href="#" title="<?php echo $t_headlines[1]; ?>" rel="bookmark">
									<img width="225" height="136" src="<?php echo $t_sources[1]; ?>" class="thumb" alt="" />
									<h4 class="post-title"><?php echo $t_headlines[1]; ?>...</h4>
									</a>
									<p><?php $small = substr($t_contents[1], 0, 100); echo $small; ?>...</p>
									<div class="meta">
										<span class="date"><?php echo $t_card_date[1]; ?></span>
									</div>
								</div>
							</article>
							<article class="post">
								<div class="entry clearfix"t
									<a href="#" title="<?php echo $t_headlines[2]; ?>" rel="bookmark">
									<img width="225" height="136" src="<?php echo $t_sources[2]; ?>" class="thumb" alt="" />
									<h4 class="post-title"><?php echo $t_headlines[2]; ?></h4>
									</a>
									<p><?php $small = substr($t_contents[2], 0, 100); echo $small; ?>...</p>
									<div class="meta">
										<span class="date"><?php echo $t_card_date[2]; ?></span>
									</div>
								</div>
							</article>

								<div class="clearfix"></div>

							</div>
					</div>

				</div>

				<div id="home-bottom" class="clearfix">
					<h3 class="title"><a href="category.php?cat=Fashion" title="Fashion"><span>Fashion</span></a></h3>	
					<div class="row-fluid">	
						<div class="span6">
							<article class="post">
								<a class="image_thumb_zoom" href="#" title="<?php echo $f_headlines[0]; ?>" rel="bookmark">
								<img width="371" height="177" src="<?php echo $f_sources[0]; ?>" alt="" />
								</a>
								<h4 class="post-title">
								<a href="#" title="<?php echo $f_headlines[0]; ?>" rel="bookmark"><?php echo $f_headlines[0]; ?>..</a>
								<span class="date"><?php echo $f_card_date[0]; ?></span>
								</h4>
								<p><?php $small = substr($f_contents[0], 0, 100); echo $small; ?>...</p>
							</article>
						</div>

						<div class="span6">
							<article class="post">
								<div class="entry clearfix">
									<a href="#" title="<?php echo $f_headlines[1]; ?>">
									<img width="225" height="136" src="<?php echo $f_sources[1]; ?>" class="thumb" alt="" />
									<h4 class="post-title"><?php $small = substr($f_headlines[1], 0, 40); echo $small; ?>...</h4>
									</a>
									<p><?php $small = substr($f_contents[1], 0, 100); echo $small; ?>...</p>
									<div class="meta">
										<span class="date"><?php echo $f_card_date[1]; ?></span>
									</div>
								</div>
							</article>
							<article class="post">
								<div class="entry clearfix">
									<a href="#" title="<?php echo $f_headlines[2]; ?>" rel="bookmark">
									<img width="225" height="136" src="<?php echo $f_sources[2]; ?>" class="thumb" alt="" />
									<h4 class="post-title"><?php $small = substr($f_headlines[2], 0, 40); echo $small; ?>...</h4>
									</a>
									<p><?php $small = substr($f_contents[2], 0, 100); echo $small; ?>...</p>
									<div class="meta">
										<span class="date"><?php echo $f_card_date[2]; ?></span>
									</div>
								</div>
							</article>
							<article class="post">
									<div class="entry clearfix">
										<a href="#" title="<?php echo $f_headlines[3]; ?>" rel="bookmark">
										<img width="225" height="136" src="<?php echo $f_sources[3]; ?>" class="thumb" alt="" />
										<h4 class="post-title"><?php $small = substr($f_headlines[3], 0, 40); echo $small; ?>...</h4>
										</a>
										<p><?php $small = substr($f_contents[3], 0, 60); echo $small; ?>...</p>
										<div class="meta">
											<span class="date"><?php echo $f_card_date[3]; ?></span>
										</div>
									</div>
							</article>
                            <div class="clearfix"></div>
						</div>
					</div>
				</div>

                <div id="home-bottom" class="clearfix">
                    <h3 class="title"><a href="category.php?cat=Retail" title="Fashion"><span>Retail</span></a></h3> 
                    <div class="row-fluid"> 
                        <div class="span6">
                            <article class="post">
                                <a class="image_thumb_zoom" href="#" title="<?php echo $r_headlines[0]; ?>" rel="bookmark">
                                <img width="371" height="177" src="<?php echo $r_sources[0]; ?>" alt="" />
                                </a>
                                <h4 class="post-title">
                                <a href="#" title="<?php echo $r_headlines[0]; ?>" rel="bookmark"><?php echo $r_headlines[0]; ?>..</a>
                                <span class="date"><?php echo $r_card_date[0]; ?></span>
                                </h4>
                                <p><?php $small = substr($r_contents[0], 0, 100); echo $small; ?>...</p>
                            </article>
                        </div>

                        <div class="span6">
                            <article class="post">
                                <div class="entry clearfix">
                                    <a href="#" title="<?php echo $r_headlines[1]; ?>">
                                    <img width="225" height="136" src="<?php echo $r_sources[1]; ?>" class="thumb" alt="" />
                                    <h4 class="post-title"><?php $small = substr($r_headlines[1], 0, 40); echo $small; ?>...</h4>
                                    </a>
                                    <p><?php $small = substr($r_contents[1], 0, 100); echo $small; ?>...</p>
                                    <div class="meta">
                                        <span class="date"><?php echo $r_card_date[1]; ?></span>
                                    </div>
                                </div>
                            </article>
                            <article class="post">
                                <div class="entry clearfix">
                                    <a href="#" title="<?php echo $r_headlines[2]; ?>" rel="bookmark">
                                    <img width="225" height="136" src="<?php echo $r_sources[2]; ?>" class="thumb" alt="" />
                                    <h4 class="post-title"><?php $small = substr($r_headlines[2], 0, 40); echo $small; ?>...</h4>
                                    </a>
                                    <p><?php $small = substr($r_contents[2], 0, 100); echo $small; ?>...</p>
                                    <div class="meta">
                                        <span class="date"><?php echo $r_card_date[2]; ?></span>
                                    </div>
                                </div>
                            </article>
                            <article class="post">
                                    <div class="entry clearfix">
                                        <a href="#" title="<?php echo $r_headlines[3]; ?>" rel="bookmark">
                                        <img width="225" height="136" src="<?php echo $r_sources[3]; ?>" class="thumb" alt="" />
                                        <h4 class="post-title"><?php $small = substr($r_headlines[3], 0, 40); echo $small; ?>...</h4>
                                        </a>
                                        <p><?php $small = substr($r_contents[3], 0, 60); echo $small; ?>...</p>
                                        <div class="meta">
                                            <span class="date"><?php echo $r_card_date[3]; ?></span>
                                        </div>
                                    </div>
                            </article>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
				<div id="home-bottom" class="clearfix">
					<h3 class="title"><a href="category.php?cat=Innovation" title="Innovation"><span>Innovation</span></a></h3>	
					<div class="row-fluid">	
						<div class="span6">
							<article class="post">
								<a class="image_thumb_zoom" href="#" title="<?php echo $i_headlines[0]; ?>" rel="bookmark">
								<img width="371" height="177" src="<?php echo $i_sources[0]; ?>" alt="" />
								</a>
								<h4 class="post-title">
								<a href="#" title="<?php echo $i_headlines[0]; ?>" rel="bookmark"><?php echo $i_headlines[0]; ?>..</a>
								<span class="date"><?php echo $i_card_date[0]; ?></span>
								</h4>
								<p><?php $small = substr($i_contents[0], 0, 100); echo $small; ?>...</p>
							</article>
						</div>

						<div class="span6">
							<article class="post">
								<div class="entry clearfix">
									<a href="#" title="<?php echo $i_headlines[1]; ?>">
									<img width="225" height="136" src="<?php echo $i_sources[1]; ?>" class="thumb" alt="" />
									<h4 class="post-title"><?php $small = substr($i_headlines[1], 0, 40); echo $small; ?>...</h4>
									</a>
									<p><?php $small = substr($i_contents[1], 0, 100); echo $small; ?>...</p>
									<div class="meta">
										<span class="date"><?php echo $i_card_date[1]; ?></span>
									</div>
								</div>
							</article>
							<article class="post">
								<div class="entry clearfix">
									<a href="#" title="<?php echo $i_headlines[2]; ?>" rel="bookmark">
									<img width="225" height="136" src="<?php echo $i_sources[2]; ?>" class="thumb" alt="" />
									<h4 class="post-title"><?php $small = substr($i_headlines[2], 0, 40); echo $small; ?>...</h4>
									</a>
									<p><?php $small = substr($i_contents[2], 0, 100); echo $small; ?>...</p>
									<div class="meta">
										<span class="date"><?php echo $i_card_date[2]; ?></span>
									</div>
								</div>
							</article>
							<article class="post">
									<div class="entry clearfix">
										<a href="#" title="<?php echo $i_headlines[3]; ?>" rel="bookmark">
										<img width="225" height="136" src="<?php echo $i_sources[3]; ?>" class="thumb" alt="" />
										<h4 class="post-title"><?php $small = substr($i_headlines[3], 0, 40); echo $small; ?>...</h4>
										</a>
										<p><?php $small = substr($i_contents[3], 0, 60); echo $small; ?>...</p>
										<div class="meta">
											<span class="date"><?php echo $i_card_date[3]; ?></span>
										</div>
									</div>
							</article>

							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
            <!-- #main-left -->


		<div id="sidebar" class="span4">

			<div id="tabwidget" class="widget tab-container"> 
				<ul id="tabnav" class="clearfix"> 
					<li><h3><a href="#tab1" class="selected"><img src="images/view-white-bg.png" alt="Popular">Popular</a></h3></li>
					<li><h3><a href="#tab2"><img src="images/time-white.png" alt="Recent">Recent</a></h3></li>
				</ul> 

			<div id="tab-content">
			
	 		<div id="tab1" style="display: block; ">
				<ul id="itemContainer" class="recent-tab">
                <?php for ($i=5; $i < 17 ; $i++) {  ?>
					<li>
						<a href="#"><img width="225" height="136" src="<?php echo $sources[$i]; ?>" class="thumb" alt="" /></a>
						<h4 class="post-title"><a href="#"><?php $small = substr($headlines[$i], 0, 60); echo $small; ?> ...</a></h4>
						<p><?php $small = substr($contents[$i], 0, 60); echo $small; ?> ...</p>
						<div class="clearfix"></div>				
					</li>
                <?php } ?>
								
					<script type="text/javascript">
						jQuery(document).ready(function($){

							/* initiate the plugin */
							$("div.holder").jPages({
							containerID  : "itemContainer",
							perPage      : 3,
							startPage    : 1,
							startRange   : 1,
							links		   : "blank"
							});
						});		
					</script>

				</ul>
				
				<div class="holder clearfix"></div>
				<div class="clear"></div>

			<!-- End most viewed post -->		  

			</div><!-- /#tab1 -->
 
			<div id="tab2" style="display: none;">	
				<ul id="itemContainer2" class="recent-tab">
                <?php for ($i=3; $i < 6 ; $i++) {  ?>
					<li>
						<a href="#"><img width="225" height="136" src="<?php echo $sources[$i]; ?>" class="thumb" alt="" /></a>
						<h4 class="post-title"><a href="#"><?php $small = substr($headlines[$i], 0, 60); echo $small; ?> ...</a></h4>
						<p><?php $small = substr($contents[$i], 0, 60); echo $small; ?> ...</p>
						<div class="clearfix"></div>	
					</li>
                    <?php } ?>
				</ul> 	 
			</div><!-- /#tab2 --> 

			<!-- /#tab2 --> 
	
			</div><!-- /#tab-content -->

			</div><!-- /#tab-widget --> 


			<div class="widget widget_latestpost"><a href="category.php?cat=Institutional"><h3 class="title"><span>Institutional</span></h3></a>
				<div class="latest-posts">
					<article class="post">
						<a class="image_thumb_zoom" href="#" title="<?php echo $inst_headlines[0]; ?>" rel="bookmark">
						<img width="371" height="177" src="<?php echo $inst_sources[0]; ?>" alt="" />
						</a>
						<h4 class="post-title">
						<a href="#" title="<?php echo $inst_headlines[0]; ?>" rel="bookmark"><?php $small = substr($inst_headlines[0], 0, 60); echo $small; ?>...</a>
						<span class="date"><?php echo $inst_card_date[0]; ?></span>
						</h4>
						<p><?php $small = substr($inst_contents[0], 0, 100); echo $small; ?>...</p>
					</article>
				
					<article class="post">
						<div class="entry clearfix">
							<a href="#" title="<?php echo $inst_headlines[1]; ?>">
							<img width="225" height="136" src="<?php echo $inst_sources[1]; ?>" class="thumb" alt="" />
							<h4 class="post-title"><?php $small = substr($inst_headlines[1], 0, 40); echo $small; ?>...</h4>
							</a>
							<p><?php $small = substr($inst_contents[1], 0, 60); echo $small; ?>...</p>
							<div class="meta">
								<span class="date"><?php echo $inst_card_date[1]; ?></span>
							</div>
						</div>
					</article>

					<article class="post">
						<div class="entry clearfix">
							<a href="#" title="<?php echo $inst_headlines[2]; ?>" rel="bookmark">
							<img width="225" height="136" src="<?php echo $inst_sources[2]; ?>" class="thumb" alt="" />
							<h4 class="post-title"><?php $small = substr($inst_headlines[2], 0, 40); echo $small; ?>...</h4></a>
							<p><?php $small = substr($inst_contents[2], 0, 60); echo $small; ?>...</p>
							<div class="meta">
								<span class="date"><?php echo $inst_card_date[2]; ?></span>
							</div>
						</div>
					</article>
				</div>
			</div>
			<br><br>

			<div class="widget widget_latestpost"><a href="category.php?cat=Technology"><h3 class="title"><span>Technology</span></h3></a>
				<div class="latest-posts">
					<article class="post">
						<a class="image_thumb_zoom" href="#" title="<?php echo $tech_headlines[0]; ?>" rel="bookmark">
						<img width="371" height="177" src="<?php echo $tech_sources[0]; ?>" alt="" />
						</a>
						<h4 class="post-title">
						<a href="#" title="<?php echo $tech_headlines[0]; ?>" rel="bookmark"><?php $small = substr($tech_headlines[0], 0, 60); echo $small; ?>...</a>
						<span class="date"><?php echo $tech_card_date[0]; ?></span>
						</h4>
						<p><?php $small = substr($tech_contents[0], 0, 100); echo $small; ?>...</p>
					</article>
				
					<article class="post">
						<div class="entry clearfix">
							<a href="#" title="<?php echo $tech_headlines[1]; ?>">
							<img width="225" height="136" src="<?php echo $tech_sources[1]; ?>" class="thumb" alt="" />
							<h4 class="post-title"><?php $small = substr($tech_headlines[1], 0, 40); echo $small; ?>...</h4>
							</a>
							<p><?php $small = substr($tech_contents[1], 0, 60); echo $small; ?>...</p>
							<div class="meta">
								<span class="date"><?php echo $tech_card_date[1]; ?></span>
							</div>
						</div>
					</article>

					<article class="post">
						<div class="entry clearfix">
							<a href="#" title="<?php echo $tech_headlines[2]; ?>" rel="bookmark">
							<img width="225" height="136" src="<?php echo $tech_sources[2]; ?>" class="thumb" alt="" />
							<h4 class="post-title"><?php $small = substr($tech_headlines[2], 0, 40); echo $small; ?>...</h4></a>
							<p><?php $small = substr($tech_contents[2], 0, 60); echo $small; ?>...</p>
							<div class="meta">
								<span class="date"><?php echo $tech_card_date[2]; ?></span>
							</div>
						</div>
					</article>
				</div>
			</div>
			<div class="widget widget_latestpost"><a href="category.php?cat=Corporate"><h3 class="title"><span>Corporate</span></h3></a>
				<div class="latest-posts">
					<article class="post">
						<a class="image_thumb_zoom" href="#" title="<?php echo $c_headlines[0]; ?>" rel="bookmark">
						<img width="371" height="177" src="<?php echo $c_sources[0]; ?>" alt="" />
						</a>
						<h4 class="post-title">
						<a href="#" title="<?php echo $c_headlines[0]; ?>" rel="bookmark"><?php $small = substr($c_headlines[0], 0, 60); echo $small; ?>...</a>
						<span class="date"><?php echo $c_card_date[0]; ?></span>
						</h4>
						<p><?php $small = substr($c_contents[0], 0, 100); echo $small; ?>...</p>
					</article>
				
					<article class="post">
						<div class="entry clearfix">
							<a href="#" title="<?php echo $c_headlines[1]; ?>">
							<img width="225" height="136" src="<?php echo $c_sources[1]; ?>" class="thumb" alt="" />
							<h4 class="post-title"><?php $small = substr($c_headlines[1], 0, 40); echo $small; ?>...</h4>
							</a>
							<p><?php $small = substr($c_contents[1], 0, 60); echo $small; ?>...</p>
							<div class="meta">
								<span class="date"><?php echo $c_card_date[1]; ?></span>
							</div>
						</div>
					</article>

					<article class="post">
						<div class="entry clearfix">
							<a href="#" title="<?php echo $c_headlines[2]; ?>" rel="bookmark">
							<img width="225" height="136" src="<?php echo $c_sources[2]; ?>" class="thumb" alt="" />
							<h4 class="post-title"><?php $small = substr($c_headlines[2], 0, 40); echo $small; ?>...</h4></a>
							<p><?php $small = substr($c_contents[2], 0, 60); echo $small; ?>...</p>
							<div class="meta">
								<span class="date"><?php echo $c_card_date[2]; ?></span>
							</div>
						</div>
					</article>
				</div>
			</div>
			
			<div class="video-box widget row-fluid">
				<h3 class="title"><span style="background-color: #;color: #;">Videos Gallery</span></h3>		
				<iframe width="369" height="188" src="<?php echo $link[0]; ?>" frameborder="0" allowfullscreen></iframe>
				
        	</div>
        				
		</div><!-- sidebar -->
		
		<div class="clearfix"></div>

		<div id="gallery">
			<h3 class="title"><span>All News Gallery</span></h3>
				<ul class="gallery">
                <?php for ($i=0; $i < 30 ; $i++) { ?>
					<li>
					<a class="image_thumb_zoom" href="#" title="<?php echo $headlines[$i]; ?>" rel="bookmark">
					<img width="225" height="136" src="<?php echo $sources[$i]; ?>" alt="" />
					</a>
					<a href="#" title="<?php echo $headlines[$i]; ?>" rel="bookmark">
					<h4 class="post-title clearfix"><img class="post-icon" alt="Text post" src="images/text.png"><?php  $small = substr($headlines[$i], 0, 60); echo $small; ?></h4></a>
					<div class="meta clearfix">
						<span class="date"><?php echo $card_date[$i]; ?></span>
					</div>
					</li>
                    <?php } ?>
				</ul>
		</div>

		</div><!-- #main -->

		</div><!-- #content -->

	<footer id="footer" class="row-fluid">
        <div id="footer-widgets" class="container">

            <div class="footer-widget span3 block3">
                <div class="widget">
                    <h3 class="title"><span>Tag Cloud</span></h3>
                    <div class="tagcloud">
                        <a href='#'>Yarn</a>
                        <a href='#'>Cotton</a>
                        <a href='#'>Home Textile</a>
                        <a href='#'>Institutional</a>
                        <a href='#'>Fashion</a>
                        <a href='#'>Machinery</a>
                        <a href='#'>Technical Textile</a>
                        <a href='#'>Apparel</a>
                        <a href='#'>Textile</a>
                    </div>
                </div>
            </div>
            
            <div class="footer-widget span3 block4">
                <div class="widget">
                    <h3 class="title"><span>Social Media</span></h3>
                        <div class="socmed clearfix">       
                            <ul>
                                <li>
                                    <a href="#"><img src="images/rss-icon.png" alt=""></a>
                                    <h4>RSS</h4>
                                    <p>Subscribe</p>
                                </li>
                                <li>
                                    <a href="#"><img src="images/twitter-icon.png" alt=""></a>
                                    <h4>37005</h4>
                                    <p>Followers</p>
                                </li>
                                <li>
                                    <a href="#"><img src="images/fb-icon.png" alt=""></a>
                                    <h4>109</h4>
                                    <p>Fans</p>
                                </li>
                            </ul>
                        </div>
                </div>
            </div>
            
            <div class="footer-widget span6 block5">
                <img class="footer-logo" src="images/logo.png" alt="texTIMZ">
                    <div class="footer-text">
                        <h4>About texTIMZ</h4>
                        <p>texTIMZ is a knowledge portal for textile industry, we provide news on the go.</p>
                    </div><div class="clearfix"></div>
            </div>

        </div><!-- footer-widgets -->

    
        <div id="site-info" class="container">
        
            <div id="footer-nav" class="fr">
                <ul class="menu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="terms.html">Blog</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>

            <div id="credit" class="fl">
                <p>All Right Reserved by texTIMZ, 2017</p>
            </div>

        </div><!-- .site-info -->
        
    </footer>

</div><!-- #wrapper -->

</body>
</html>
