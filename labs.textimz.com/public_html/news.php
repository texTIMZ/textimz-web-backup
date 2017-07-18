<?php
session_start();
    include "config.php";
	if (isset($_GET['id'])) {
	//echo $_GET['id'];
	$slugs = $_GET['id'];

	$query   = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link ,d.s_fname , d.s_lname, e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and a.pk_i_id = e.fk_i_item_id and a.s_slug = :slugs group by a.pk_i_id order by a.pk_i_id ");
    $query->bindParam('slugs', $slugs);
    $query->execute();
	while ($res = $query->fetch(PDO::FETCH_ASSOC))
            {
                    $ids         = $res['pk_i_id'];
                    $createTime = $res['s_create_time'];
                    $headline   = $res['s_headline'];
                    $source     = $res['s_source'];
                    $content     = $res['s_content'];
                    $category_1 = $res['categories_name'];
                    $fname = $res['s_fname'];
                    $lname = $res['s_lname'];
                    $card_dates = date('j M', strtotime($res['s_create_time']));
            }

    $stmt1  = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link ,d.s_fname , d.s_lname, e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = f.pk_i_id group by a.pk_i_id order by a.pk_i_id desc LIMIT 100");
    $stmt1->execute();
    $ids         = array();
    $createTimes = array();
    $headlines   = array();
    $slugs       = array();
    $sources     = array();
    $contents = array();
    $categories = array();
    $fnames = array();
    $lnames = array();
    $card_date = array();
    while ($result = $stmt1->fetch(PDO::FETCH_ASSOC))
            {
                    $ids[]         = $result['pk_i_id'];
                    $createTimes[] = $result['s_create_time'];
                    $headlines[]   = $result['s_headline'];
                    $slugs[]       = $result['s_slug'];
                    $sources[]     = $result['s_source'];
                    $contents[]    = $result['s_content'];
                    $categories[] = 	$result['categories_name'];
				    $fnames[] = 		$result['s_fname'];
				    $lnames[] = 		$result['s_lname'];
                    $card_date[] = date('j M', strtotime($result['s_create_time']));
            }
    $totalIds = count($ids);
    //print_r($categories);
    for ($i=0; $i < $totalIds; $i++) 
    { //echo "do";
    	if ($slugs[$i] == $_GET['id'] ) 
    	{
    		$found = $i;
    		echo $found;
    	}
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

    $stmt3= $conn->prepare("SELECT * FROM t_videos");
    $stmt3->execute();
    $Video_name = array();
    $link = array();
    while ($videos = $stmt3->fetch(PDO::FETCH_ASSOC))
            {
                    $Video_name[] = $videos['video_name'];
                    $link[]   = $videos['link'];
            }

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
            <a href="index.html" title="Magazine" rel="home"><img src="images/logo.png" alt="Magazine" /></a>
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
                <li><a href="index.php">Highlights</a></li>
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
					<li><p><a href="#" title="<?php echo $event_name[$i]; ?>" rel="bookmark"><span class="title"><?php echo $event_name[$i];?>...</span> <?php echo $event_date[$i]." ".$event_countries[$i]; ?></a></p></li>
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

				<?php $final = $found+5;
				for ($i=$found; $i < $final; $i++) 
				{ ?>
				<article class="post">
					<h2 class="entry-title">
						<?php echo $headlines[$i]; ?>
						<span class="entry-cat"><a href="category.php?cat=<?php echo $categories[$i]; ?>" title="View all posts in <?php echo $categories[$i]; ?> News" rel="category tag"><?php echo $categories[$i];?></a></span>
					</h2>
					<div class="entry-meta row-fluid">
						<ul class="clearfix">
							<li><img alt='' src='images/avatar.png' height='15' width='15' /><?php echo $fnames[$i]." ".$lnames[$i]; ?></li>
							<li><img src="images/time.png" alt=""><?php echo $card_date[$i]; ?></li>
						</ul>
					</div>
					<div class="entry-content">
						<a href="news.php?id=<?php echo $slugs[$i]; ?>" title="<?php echo $headlines[$i]; ?>">
						<img width="774" height="320" src="<?php echo $sources[$i]; ?>" alt="" />
						</a>
						<p><?php echo $contents[$i]; ?>
					</div>
				</article>				
				<?php } ?>

				
			<div class="pagination magz-pagination"><a class="prev page-numbers" href="all_news.php?p=0">Load More</a></div>

			</div><!-- #main-left -->

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
						<a href="news.php?id=<?php echo $slugs[$i]; ?>"><img width="225" height="136" src="<?php echo $sources[$i]; ?>" class="thumb" alt="" /></a>
						<h4 class="post-title"><a href="news.php?id=<?php echo $slugs[$i]; ?>"><?php $small = substr($headlines[$i], 0, 60); echo $small; ?> ...</a></h4>
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
						<a href="news.php?id=<?php echo $slugs[$i]; ?>"><img width="225" height="136" src="<?php echo $sources[$i]; ?>" class="thumb" alt="" /></a>
						<h4 class="post-title"><a href="news.php?id=<?php echo $slugs[$i]; ?>"><?php $small = substr($headlines[$i], 0, 60); echo $small; ?> ...</a></h4>
						<p><?php $small = substr($contents[$i], 0, 60); echo $small; ?> ...</p>
						<div class="clearfix"></div>	
					</li>
                    <?php } ?>
				</ul> 	 
			</div><!-- /#tab2 --> 

			<!-- /#tab2 --> 
	
			</div><!-- /#tab-content -->

			</div>
			

			
			
			<div class="video-box widget row-fluid">
				<h3 class="title"><span style="background-color: #;color: #;">Videos Gallery</span></h3>		
				<iframe width="369" height="188" src="<?php echo $link[0]; ?>" frameborder="0" allowfullscreen></iframe>
				
        	</div><!-- sidebar -->
		
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
