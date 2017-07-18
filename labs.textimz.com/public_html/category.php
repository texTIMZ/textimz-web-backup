<?php 
session_start();
include "config.php";
if (isset($_GET['cat'])) {
	$category = $_GET['cat'];
	if (($category != 'Apparel') && ($category != 'Textile') && ($category != 'Fashion') && ($category != 'Technical textile')&& ($category != 'Technology') && ($category != 'Corporate') && ($category != 'Innovation') && ($category != 'Events') && ($category != 'Retail') && ($category != 'E-Commerce') && ($category != 'Institutional') && ($category != 'Denim')) 
    {

		echo '<script type="text/javascript">
           window.location = "./error_pages/errors.html"
      </script>';
	}
     $query = $conn->prepare("SELECT a.pk_i_id , a.event_name, a.date_start,a.fk_country_id, a.details, a.venue,  b.s_source  from t_events as a, t_media_events as b where a.pk_i_id = b.fk_event_id group by a.pk_i_id ORDER BY MONTH(a.date_start) desc LIMIT 20");
    $query->execute();
    $event_ids         = array();
    $event_date_start = array();
    $event_name   = array();
    $event_country_id       = array();
    $event_sources     = array();
    $event_countries = array();
    $event_details = array();
    $event_date = array();
    $event_venue = array();
    while ($result2 = $query->fetch(PDO::FETCH_ASSOC))
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

	$stmt1 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 1 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt1->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $a_headlines   = array();
    $a_sources     = array();
    while ($apparel = $stmt1->fetch(PDO::FETCH_ASSOC))
            {
                    $a_headlines[]   = $apparel['s_headline'];
                    $a_sources[]     = $apparel['s_source'];
            }
    $a_totalIds = count($a_headlines);

    $stmt = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 2 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $t_createTimes = array();
    $t_headlines   = array();
    $t_slugs       = array();
    $t_sources     = array();
    $t_contents = array();
    $t_card_date = array();
    while ($textile = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                    $t_createTimes[] = $textile['s_create_time'];
                    $t_headlines[]   = $textile['s_headline'];
                    $t_slugs[]       = $textile['s_slug'];
                    $t_sources[]     = $textile['s_source'];
                    $t_contents[]     = $textile['s_content'];
                    $t_card_date[] = date('j M', strtotime($textile['s_create_time']));
            }
    $t_totalIds = count($t_headlines);
    $stmt3 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 3 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt3->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $f_createTimes = array();
    $f_headlines   = array();
    $f_slugs       = array();
    $f_sources     = array();
    $f_contents = array();
    $f_card_date = array();
    while ($Fashion = $stmt3->fetch(PDO::FETCH_ASSOC))
            {
                    $f_createTimes[] = $Fashion['s_create_time'];
                    $f_headlines[]   = $Fashion['s_headline'];
                    $f_slugs[]       = $Fashion['s_slug'];
                    $f_sources[]     = $Fashion['s_source'];
                    $f_contents[]     = $Fashion['s_content'];
                    $f_card_date[] = date('j M', strtotime($Fashion['s_create_time']));
            }
    $f_totalIds = count($f_headlines);
    
    $stmt4 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 4 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt4->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $tt_createTimes = array();
    $tt_headlines   = array();
    $tt_slugs       = array();
    $tt_sources     = array();
    $tt_contents = array();
    $tt_card_date = array();
    while ($tech_tex = $stmt4->fetch(PDO::FETCH_ASSOC))
            {
                    $tt_createTimes[] = $tech_tex['s_create_time'];
                    $tt_headlines[]   = $tech_tex['s_headline'];
                    $tt_slugs[]       = $tech_tex['s_slug'];
                    $tt_sources[]     = $tech_tex['s_source'];
                    $tt_contents[]     = $tech_tex['s_content'];
                    $tt_card_date[] = date('j M', strtotime($tech_tex['s_create_time']));
            }
    $tt_totalIds = count($tt_headlines);
    $stmt5 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 5 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt5->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $t_createTimes = array();
    $t_headlines   = array();
    $t_slugs       = array();
    $t_sources     = array();
    $t_contents = array();
    $t_card_date = array();
    while ($tech = $stmt5->fetch(PDO::FETCH_ASSOC))
            {
                    $t_createTimes[] = $tech['s_create_time'];
                    $t_headlines[]   = $tech['s_headline'];
                    $t_slugs[]       = $tech['s_slug'];
                    $t_sources[]     = $tech['s_source'];
                    $t_contents[]     = $tech['s_content'];
                    $t_card_date[] = date('j M', strtotime($tech['s_create_time']));
            }
    $tt_totalIds = count($tt_headlines);

    $stmt6 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 6 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt6->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $c_headlines   = array();
    $c_sources     = array();
    while ($corp = $stmt6->fetch(PDO::FETCH_ASSOC))
            {
                    $c_headlines[]   = $corp['s_headline'];
                    $c_sources[]     = $corp['s_source'];
            }
    $a_totalIds = count($a_headlines);

    $stmt7 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 7 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt7->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $i_headlines   = array();
    $i_sources     = array();
    while ($corp = $stmt7->fetch(PDO::FETCH_ASSOC))
            {
                    $i_headlines[]   = $corp['s_headline'];
                    $i_sources[]     = $corp['s_source'];
            }
    $a_totalIds = count($a_headlines);

    $stmt8 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 8 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt8->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $e_headlines   = array();
    $e_sources     = array();
    while ($event = $stmt8->fetch(PDO::FETCH_ASSOC))
            {
                    $e_headlines[]   = $event['s_headline'];
                    $e_sources[]     = $event['s_source'];
            }
    $a_totalIds = count($a_headlines);

    $stmt9 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 9 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt9->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $r_headlines   = array();
    $r_sources     = array();
    while ($retail = $stmt9->fetch(PDO::FETCH_ASSOC))
            {
                    $r_headlines[]   = $retail['s_headline'];
                    $r_sources[]     = $retail['s_source'];
            }
    $a_totalIds = count($a_headlines);
	
	$stmt10 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 10 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt10->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $e_comm_headlines   = array();
    $e_comm_sources     = array();
    while ($e_comm = $stmt10->fetch(PDO::FETCH_ASSOC))
            {
                    $e_comm_headlines[]   = $e_comm['s_headline'];
                    $e_comm_sources[]     = $e_comm['s_source'];
            }

    $stmt11 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 11 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt11->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $inst_headlines   = array();
    $inst_sources     = array();
    while ($inst = $stmt11->fetch(PDO::FETCH_ASSOC))
            {
                    $inst_headlines[]   = $inst['s_headline'];
                    $inst_sources[]     = $inst['s_source'];
            }
    $stmt11 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 11 group by a.pk_i_id order by a.pk_i_id desc LIMIT 15");
    $stmt11->execute();

    //print_r($a_news_ids);
    //echo $totalNewsIds;
    $inst_headlines   = array();
    $inst_sources     = array();
    while ($inst = $stmt11->fetch(PDO::FETCH_ASSOC))
            {
                    $inst_headlines[]   = $inst['s_headline'];
                    $inst_sources[]     = $inst['s_source'];
            }
} ?>
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
                                
                <li><a href="index.html"><img src="images/home.png" alt="Magazine"></a></li>
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

	<header class="entry-header">
		<h1 class="entry-title"><span><?php echo $category; ?></span></h1>
	</header><!-- .entry-header -->
		<div class="row-fluid">
	      <?php if($category =='Apparel') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $a_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $a_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $a_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($a_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }}
			if($category =='Textile') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $t_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $t_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $t_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($t_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }} 
			if($category =='Fashion') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $f_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $f_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $f_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($f_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }}
			if($category== 'Technical textile') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $tt_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $tt_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $tt_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($tt_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }}
			if($category== 'Technology') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $t_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $t_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $t_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($t_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }} 
			if($category== 'Corporate') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $c_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $c_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $c_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($c_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }} 
			if($category== 'Innovation') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $i_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $i_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $i_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($i_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }}
			if($category== 'Events') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $e_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $e_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $e_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($e_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }}
			if($category== 'Retail') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $r_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $r_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $r_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($r_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }}

			if($category== 'E-Commerce') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $e_comm_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $e_comm_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $e_comm_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($e_comm_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }} 

			if($category== 'Institutional') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $inst_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $inst_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $inst_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($inst_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }} 

			if($category== 'Denim') {
			for ($i=0; $i <12 ; $i++) { 
			 	 ?>	
			<div class="kontengal4 span3">
				<article class="galleries">
					<a href="<?php echo $d_sources[$i]; ?>" title="" rel="prettyPhoto"><img width="570" height="360" src="<?php echo $d_sources[$i]; ?>" alt="" /></a>
					<h3 class="gal-title"><a href="#" title="<?php echo $d_headlines[$i]; ?>" rel="bookmark"><?php $small = substr($d_headlines[$i], 0, 100); echo $small; ?>...</a></h3>
				</article>
			</div>
			<?php }}
			 ?>		
		</div>
		
			<div class="clearfix"></div>
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

