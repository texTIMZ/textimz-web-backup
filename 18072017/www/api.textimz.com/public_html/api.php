<?php
    session_start();
    include "config.php";
    $stmt = $conn->prepare("SELECT a.pk_i_id ,a.fk_i_user_id, a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link, d.s_fname , d.s_lname , d.pk_i_id , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and a.fk_i_user_id = d.pk_i_id and c.fk_i_news_item_id = a.pk_i_id and a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = f.pk_i_id group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt->execute();
      $response = array();
        $posts = array(); 

    while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        //$id = $result['pk_i_id'];
        $headline = $result['s_headline'];
        $content = $result['s_content'];
        $source =$result['s_source'];
        $createTime = $result['s_create_time'];
        $slug = $result['s_slug'];
        $link_name  = $result['link_name'];
        $link  = $result['link'];
        $fname  = $result['s_fname'];
        $lname  = $result['s_lname'];
        $category = $result['categories_name'];

        $posts[] = array('headline'=> $headline, 'content'=>$content,'source'=>$source, 'createTime' => $createTime, 'slug' => $slug, 'link_name' => $link_name, 'link' => $link , 'fname' => $fname, 'lname' => $lname , 'category' => $category);

    }
    print_r($posts);
    $response['posts'] = $posts;

    //--------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------
    $stmt1 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 1 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt1->execute();

    $response_apparel = array();
    $posts_apparel = array();
    while ($apparel = $stmt1->fetch(PDO::FETCH_ASSOC))
            {
                    $a_createTimes = $apparel['s_create_time'];
                    $a_headlines   = $apparel['s_headline'];
                    $a_slugs       = $apparel['s_slug'];
                    $a_sources     = $apparel['s_source'];
                    $a_contents     = $apparel['s_content'];
                    $a_link_name = $apparel['link_name'];
                    $a_link = $apparel['link'];
                    $a_fname  = $apparel['s_fname'];
                    $a_lname  = $apparel['s_lname'];
                    $a_category = "apparel";
                    //$t_card_date = date('j M', strtotime($textile['s_create_time']));

                    $posts_apparel[] = array('headline'=> $a_headlines, 'content'=>$a_contents,'source'=>$a_sources, 'createTime' => $a_createTimes, 'slug' => $a_slugs, 'link' => $a_link_name, 'link_name' => $a_link, 'fname' => $a_fname, 'lname' => $a_lname , 'category' => $a_category);
            }

    echo "<br><br>";
    print_r($posts_apparel);
    $response_apparel['posts'] = $posts_apparel;

    //--------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------
    $stmt2 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 2 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt2->execute();

    $response_textile = array();
    $posts_textile = array();
    while ($textile = $stmt2->fetch(PDO::FETCH_ASSOC))
            {
                    $t_createTimes = $textile['s_create_time'];
                    $t_headlines   = $textile['s_headline'];
                    $t_slugs       = $textile['s_slug'];
                    $t_sources     = $textile['s_source'];
                    $t_contents     = $textile['s_content'];
                    $t_link_name = $textile['link_name'];
                    $t_link = $textile['link'];
                    $t_fname  = $textile['s_fname'];
                    $t_lname  = $textile['s_lname'];
                    $t_category = "textile";
                    //$t_card_date = date('j M', strtotime($textile['s_create_time']));

                    $posts_textile[] = array('headline'=> $t_headlines, 'content'=>$t_contents,'source'=>$t_sources, 'createTime' => $t_createTimes, 'slug' => $t_slugs, 'link' => $t_link_name, 'link_name' => $t_link, 'fname' => $t_fname, 'lname' => $t_lname , 'category' => $t_category);
            }

    echo "<br><br>";
    print_r($posts_textile);
    $response_textile['posts'] = $posts_textile;

    //--------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------

    $stmt3 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 3 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt3->execute();

    $response_Fashion = array();
    $posts_Fashion = array();
    while ($Fashion = $stmt3->fetch(PDO::FETCH_ASSOC))
    {
        //$id = $result['pk_i_id'];
        $f_headline = $Fashion['s_headline'];
        $f_content = $Fashion['s_content'];
        $f_source =$Fashion['s_source'];
        $f_createTime = $Fashion['s_create_time'];
        $f_slug = $Fashion['s_slug'];
        $f_link_name  = $Fashion['link_name'];
        $f_link  = $Fashion['link'];
        $f_fname  = $Fashion['s_fname'];
        $f_lname  = $Fashion['s_lname'];
        $f_category = $Fashion['categories_name'];

        $posts_Fashion[] = array('headline'=> $f_headline, 'content'=>$f_content,'source'=>$f_source, 'createTime' => $f_createTime, 'slug' => $f_slug, 'link_name' => $f_link_name, 'link' => $f_link , 'fname' => $f_fname, 'lname' => $f_lname , 'category' => $f_category);

    }
    echo "<br><br>";
    print_r($posts_Fashion);
    $response_Fashion['posts'] = $posts_Fashion;

    //--------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------

    $stmt4 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 4 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt4->execute();

    $response_Technical_Textile  = array();
    $posts_Technical_Textile  = array();
    while ($Technical_Textile  = $stmt4->fetch(PDO::FETCH_ASSOC))
    {
        //$id = $result['pk_i_id'];
        $tt_headline = $Technical_Textile['s_headline'];
        $tt_content = $Technical_Textile['s_content'];
        $tt_source =$Technical_Textile['s_source'];
        $tt_createTime = $Technical_Textile['s_create_time'];
        $tt_slug = $Technical_Textile['s_slug'];
        $tt_link_name  = $Technical_Textile['link_name'];
        $tt_link  = $Technical_Textile['link'];
        $tt_fname  = $Technical_Textile['s_fname'];
        $tt_lname  = $Technical_Textile['s_lname'];
        $tt_category = 'Technical Textile';

        $posts_Technical_Textile[] = array('headline'=> $tt_headline, 'content'=>$tt_content,'source'=>$tt_source, 'createTime' => $tt_createTime, 'slug' => $tt_slug, 'link_name' => $tt_link_name, 'link' => $tt_link , 'fname' => $tt_fname, 'lname' => $tt_lname , 'category' => $tt_category);

    }
    echo "<br><br>";
    print_r($posts_Technical_Textile);
    $response_Technical_Textile['posts'] = $posts_Technical_Textile;

    //--------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------

   $stmt5 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 5 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt5->execute();

    
    $response_Tech  = array();
    $posts_Tech  = array();
    while ($Tech  = $stmt5->fetch(PDO::FETCH_ASSOC))
    {
        //$id = $result['pk_i_id'];
        $t_headline = $Tech['s_headline'];
        $t_content = $Tech['s_content'];
        $t_source =$Tech['s_source'];
        $t_createTime = $Tech['s_create_time'];
        $t_slug = $Tech['s_slug'];
        $t_link_name  = $Tech['link_name'];
        $t_link  = $Tech['link'];
        $t_fname  = $Tech['s_fname'];
        $t_lname  = $Tech['s_lname'];
        $t_category = 'Technology';

        $posts_Tech[] = array('headline'=> $t_headline, 'content'=>$t_content,'source'=>$t_source, 'createTime' => $t_createTime, 'slug' => $t_slug, 'link_name' => $t_link_name, 'link' => $t_link , 'fname' => $t_fname, 'lname' => $t_lname , 'category' => $t_category);

    }
    echo "<br><br>";
    print_r($posts_Tech);
    $response_Tech['posts'] = $posts_Tech;

    //--------------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------
    $stmt6 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 6 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt6->execute();

    
    $response_Corporate  = array();
    $posts_Corporate  = array();
    while ($Corporate  = $stmt6->fetch(PDO::FETCH_ASSOC))
    {

        //$id = $result['pk_i_id'];
        $c_headline = $Corporate['s_headline'];
        $c_content = $Corporate['s_content'];
        $c_source =$Corporate['s_source'];
        $c_createTime = $Corporate['s_create_time'];
        $c_slug = $Corporate['s_slug'];
        $c_link_name  = $Corporate['link_name'];
        $c_link  = $Corporate['link'];
        $c_fname  = $Corporate['s_fname'];
        $c_lname  = $Corporate['s_lname'];
        $c_category = 'Corporate';

        $posts_Corporate[] = array('headline'=> $c_headline, 'content'=>$c_content,'source'=>$c_source, 'createTime' => $c_createTime, 'slug' => $c_slug, 'link_name' => $c_link_name, 'link' => $c_link , 'fname' => $c_fname, 'lname' => $c_lname , 'category' => $c_category);
        //print_r($posts_Corporate);

    }
    echo "<br><br>";

    print_r($posts_Corporate);
    $response_Corporate['posts'] = $posts_Corporate;
    
    //--------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------

    $stmt7 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 7 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt7->execute();

    $response_Innovation  = array();
    $posts_Innovation  = array();
    while ($Innovation  = $stmt7->fetch(PDO::FETCH_ASSOC))
    {

        //$id = $result['pk_i_id'];
        $i_headline = $Innovation['s_headline'];
        $i_content = $Innovation['s_content'];
        $i_source =$Innovation['s_source'];
        $i_createTime = $Innovation['s_create_time'];
        $i_slug = $Innovation['s_slug'];
        $i_link_name  = $Innovation['link_name'];
        $i_link  = $Innovation['link'];
        $i_fname  = $Innovation['s_fname'];
        $i_lname  = $Innovation['s_lname'];
        $i_category = 'Innovation';

        $posts_Innovation[] = array('headline'=> $i_headline, 'content'=>$i_content,'source'=>$i_source, 'createTime' => $i_createTime, 'slug' => $i_slug, 'link_name' => $i_link_name, 'link' => $i_link , 'fname' => $i_fname, 'lname' => $i_lname , 'category' => $i_category);
        //print_r($posts_Corporate);

    }
    echo "<br><br>";

    print_r($posts_Innovation);
    $response_Innovation['posts'] = $posts_Innovation;

    //--------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------


    $stmt8 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 8 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt8->execute();

    $response_Event  = array();
    $posts_Event  = array();
    while ($Event  = $stmt8->fetch(PDO::FETCH_ASSOC))
    {

        //$id = $result['pk_i_id'];
        $e_headline = $Event['s_headline'];
        $e_content = $Event['s_content'];
        $e_source =$Event['s_source'];
        $e_createTime = $Event['s_create_time'];
        $e_slug = $Event['s_slug'];
        $e_link_name  = $Event['link_name'];
        $e_link  = $Event['link'];
        $e_fname  = $Event['s_fname'];
        $e_lname  = $Event['s_lname'];
        $e_category = 'Event';

        $posts_Event[] = array('headline'=> $e_headline, 'content'=>$e_content,'source'=>$e_source, 'createTime' => $e_createTime, 'slug' => $e_slug, 'link_name' => $e_link_name, 'link' => $e_link , 'fname' => $e_fname, 'lname' => $e_lname , 'category' => $e_category);
        //print_r($posts_Corporate);

    }
    echo "<br><br>";

    print_r($posts_Event);
    $response_Event['posts'] = $posts_Event;

    //--------------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------

   $stmt9 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 9 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt9 ->execute();

    $response_Retail  = array();
    $posts_Retail  = array();
    while ($Retail  = $stmt9->fetch(PDO::FETCH_ASSOC))
    {

        //$id = $result['pk_i_id'];
        $r_headline = $Retail['s_headline'];
        $r_content = $Retail['s_content'];
        $r_source =$Retail['s_source'];
        $r_createTime = $Retail['s_create_time'];
        $r_slug = $Retail['s_slug'];
        $r_link_name  = $Retail['link_name'];
        $r_link  = $Retail['link'];
        $r_fname  = $Retail['s_fname'];
        $r_lname  = $Retail['s_lname'];
        $r_category = 'Retail';

        $posts_Retail[] = array('headline'=> $r_headline, 'content'=>$r_content,'source'=>$r_source, 'createTime' => $r_createTime, 'slug' => $r_slug, 'link_name' => $r_link_name, 'link' => $r_link , 'fname' => $r_fname, 'lname' => $r_lname , 'category' => $r_category);
        //print_r($posts_Corporate);

    }
    echo "<br><br>";
    print_r($posts_Retail);
    $response_Retail['posts'] = $posts_Retail;

    //--------------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------

   $stmt10 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 10 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt10 ->execute();

    $response_e_comm  = array();
    $posts_e_comm  = array();

    while ($e_comm  = $stmt10->fetch(PDO::FETCH_ASSOC))
    {

        //$id = $result['pk_i_id'];
        $ec_headline = $e_comm['s_headline'];
        $ec_content = $e_comm['s_content'];
        $ec_source =$e_comm['s_source'];
        $ec_createTime = $e_comm['s_create_time'];
        $ec_slug = $e_comm['s_slug'];
        $ec_link_name  = $e_comm['link_name'];
        $ec_link  = $e_comm['link'];
        $ec_fname  = $e_comm['s_fname'];
        $ec_lname  = $e_comm['s_lname'];
        $ec_category = 'e_comm';

        $posts_e_comm[] = array('headline'=> $ec_headline, 'content'=>$ec_content,'source'=>$ec_source, 'createTime' => $ec_createTime, 'slug' => $ec_slug, 'link_name' => $ec_link_name, 'link' => $ec_link , 'fname' => $ec_fname, 'lname' => $ec_lname , 'category' => $ec_category);
        //print_r($posts_Corporate);

    }
    echo "<br><br>";
    print_r($posts_e_comm);
    $response_e_comm['posts'] = $posts_e_comm;

    //--------------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------

   $stmt11 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 11 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt11 ->execute();

    $response_inst  = array();
    $posts_inst  = array();

    while ($institutional  = $stmt11->fetch(PDO::FETCH_ASSOC))
    {

        //$id = $result['pk_i_id'];
        $inst_headline = $institutional['s_headline'];
        $inst_content = $institutional['s_content'];
        $inst_source =$institutional['s_source'];
        $inst_createTime = $institutional['s_create_time'];
        $inst_slug = $institutional['s_slug'];
        $inst_link_name  = $institutional['link_name'];
        $inst_link  = $institutional['link'];
        $inst_fname  = $institutional['s_fname'];
        $inst_lname  = $institutional['s_lname'];
        $inst_category = 'Institutional';

        $posts_inst[] = array('headline'=> $inst_headline, 'content'=>$inst_content,'source'=>$inst_source, 'createTime' => $inst_createTime, 'slug' => $inst_slug, 'link_name' => $inst_link_name, 'link' => $inst_link , 'fname' => $inst_fname, 'lname' => $inst_lname , 'category' => $inst_category);
        //print_r($posts_Corporate);

    }
    echo "<br><br>";
    print_r($posts_inst);
    $response_inst['posts'] = $posts_inst;

    //--------------------------------------------------------------------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------

   $stmt12 = $conn->prepare("SELECT a.pk_i_id , a.s_headline,a.s_content, a.s_create_time, a.s_slug, b.s_source, c.link_name, c.link , d.s_fname , d.s_lname , e.fk_i_category_id , e.fk_i_item_id , f.categories_name, f.pk_i_id from t_news_item as a, t_media as b, t_link as c, t_user as d, t_categories as e, s_categories as f where a.pk_i_id = b.fk_i_item_id and c.fk_i_news_item_id = a.pk_i_id and a.fk_i_user_id = d.pk_i_id and   a.pk_i_id = e.fk_i_item_id and e.fk_i_category_id = 12 group by a.pk_i_id order by a.pk_i_id desc LIMIT 30");
    $stmt12 ->execute();

    $response_denim  = array();
    $posts_denim  = array();

    while ($denim  = $stmt12->fetch(PDO::FETCH_ASSOC))
    {

        //$id = $result['pk_i_id'];
        $d_headline = $denim['s_headline'];
        $d_content = $denim['s_content'];
        $d_source =$denim['s_source'];
        $d_createTime = $denim['s_create_time'];
        $d_slug = $denim['s_slug'];
        $d_link_name  = $denim['link_name'];
        $d_link  = $denim['link'];
        $d_fname  = $denim['s_fname'];
        $d_lname  = $denim['s_lname'];
        $d_category = 'denim';

        $posts_denim[] = array('headline'=> $d_headline, 'content'=>$d_content,'source'=>$d_source, 'createTime' => $d_createTime, 'slug' => $d_slug, 'link_name' => $d_link_name, 'link' => $d_link , 'fname' => $d_fname, 'lname' => $d_lname , 'category' => $d_category);
        //print_r($posts_Corporate);

    }
    echo "<br><br>";
    print_r($posts_denim);
    $response_denim['posts'] = $posts_denim;
echo json_encode($posts_denim);

    ?>
