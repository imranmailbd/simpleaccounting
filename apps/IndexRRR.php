<?php

class Index{



	protected $db;



	public function __construct($db){$this->db = $db;}

    

	public function home(){        

        $returnHTML = $this->headerHTML();


        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 12=>array(), 13=>array(), 14=>array(), 15=>array(), 19=>array(), 20=>array(),  21=>array(),  22=>array(), 27=>array(), 45=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)), trim(stripslashes($oneRow->uri_value)));

            }
  
        }     

        $returnHTML .='
        <!-- Banner Area Start  main-slider hero_carosel owl-carousel owl-theme  -->
        <section>
            <div class="hero-slider" data-carousel>';

            $bannObj = $this->db->getObj("SELECT banners_id, name, description FROM banners WHERE banners_publish = 1 ORDER BY RAND() LIMIT 0,4", array());

            if($bannObj){

                while($oneRow = $bannObj->fetch(PDO::FETCH_OBJ)){

                    $banners_id = $oneRow->banners_id;

                    $name = trim(stripslashes($oneRow->name));

                    $description = stripslashes($oneRow->description);

                    $filePath = "./assets/accounts/banner_$banners_id".'_';

                    $catPics = glob($filePath."*.jpg");

                    if(!$catPics){

                        $catPics = glob($filePath."*.png");

                    }

                    $catImgSrc = '/assets/images/missing-picture.jpg';                                            

                    if($catPics){

                        foreach($catPics as $onePicture){

                            $catImgSrc = str_replace("./", '/', $onePicture);

                        }

                    }              

                    // $returnHTML .= '<div class="item">

                    //     <div class="hero-img">

                    //         <img src="'.$catImgSrc.'" alt="">

                    //     </div>

                    //     <div class="desc">

                    //         <h2>'.$name.'

                    //         </h2>

                    //         <p class="carsl_cnt">'.$description.'</p>

                    //         <p class="carsl_btn"><a href="immigration-assessment.html" class="btn-gradient-bg animatedBtnBody">Book A Consultation</a></p>

                    //     </div>

                    // </div>';

                // new banner part starts here                
                $returnHTML .= '       
                <div class="carousel-cell" style="background-image:url(\'/assets/images/banner2-min.png\');">
                    <div class="slide-content">
                        <div class="mask">
                            <p class="caption">PROFESSIONAL <b>VISA </b> APPLICATION<br><b>SERVICES</b> SYSTEM</p>
                        </div>
                        <div class="mask">
                            <a href="https://canadianimmigrationlegal.com/immigration-assessment.html" class="btn">Book A Consultation</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-cell" style="background-image:url(\'/assets/images/banner3-min.png\');">
                    <div class="slide-content">
                        <div class="mask">
                                <p class="caption">STUDY IN <b>CANADA </b>YOUR PATHWAY<br><b>A WORLD-CLASS</b> EDUCATION</p>
                        </div>
                        <div class="mask">
                            <a href="https://canadianimmigrationlegal.com/immigration-assessment.html" class="btn">Book A Consultation</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-cell" style="background-image:url(\'/assets/images/banner4.png\');">
                    <div class="slide-content">
                        <div class="mask">
                            <p class="caption">UNLOCKING <b>YOUR </b> BRIGHT<br><b>FUTURE</b> IN CANADA</p>
                        </div>
                        <div class="mask">
                            <a href="https://canadianimmigrationlegal.com/immigration-assessment.html" class="btn">Book A Consultation</a>
                        </div>
                    </div>
                </div>';  
                // new banner part ends here           

                }

            }                        

            $returnHTML .='
            </div>
        </section>
        <!-- Banner Area End -->

        
        <!-- News & Article Area Start -->        
        <!--section class="details-area">
            <div class="container details-area-bg">
                <div class="row">';



                    $newsArtObj = $this->db->getObj("SELECT news_articles_id, name, uri_value, short_description, description FROM news_articles WHERE news_articles_publish = 1 ORDER BY RAND() LIMIT 0,3", array());



                    if($newsArtObj){

                        while($oneRow = $newsArtObj->fetch(PDO::FETCH_OBJ)){
            
                            $news_articles_id = $oneRow->news_articles_id;
                            $uri_value = $oneRow->uri_value;
                            $name = trim(stripslashes($oneRow->name));
                            $description = stripslashes($oneRow->description);
                            $short_description = stripslashes($oneRow->short_description);
                            $filePath = "./assets/accounts/news_$news_articles_id".'_';
                            $catPics = glob($filePath."*.jpg");
                            if(!$catPics){
                                $catPics = glob($filePath."*.png");
                            }
            
                            $catImgSrc = '/assets/images/missing-picture.jpg';                                            
                            if($catPics){
                                foreach($catPics as $onePicture){
                                    $catImgSrc = str_replace("./", '/', $onePicture);
                                }
                            }                            
                            $returnHTML .= '<div class="col-md-4">
                            <div class="details-box">
                                <img class="box-image" src="'.$catImgSrc.'" alt="" srcset="">
                                <div class="details-box-content">
                                    <img class="box-c-image" src="/website_assets/images/icon-1.jpg" alt="" srcset="">
                                    <div class="details-text">
                                        <h4>'.$name.'</h4>
                                        <p>'.$short_description.'</p>
                                        <div class="details-box-btn">
                                            <a href='.$uri_value.'>View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                            
                        }
                    }                    
                    $returnHTML .='
                </div>
            </div>
        </section-->
        <!-- News & Article Area News -->

        
                    
                    
        <!-- Service Area Start -->
        <section class="service-area">

            <div class="section-title divider">
                <h4>'.$bodyPages[14][0].'</h4> 
            </div>

            <div class="container">

                <div class="row">';            

                    $serviceObj = $this->db->getObj("SELECT services_id, name, font_awesome, uri_value, short_description FROM services WHERE services_publish =1 AND service_type =1 ORDER BY services_id ASC LIMIT 0, 6", array());
                                

                    if($serviceObj){                        



                        while($oneRow = $serviceObj->fetch(PDO::FETCH_OBJ)){

                            $services_id = $oneRow->services_id;

                            $name = trim(stripslashes($oneRow->name));

                            $font_awesome = trim(stripslashes($oneRow->font_awesome));

                            $uri_value = trim(stripslashes($oneRow->uri_value));

                            $short_description = nl2br(trim(stripslashes($oneRow->short_description)));

                            $description = nl2br(trim(stripslashes($oneRow->description)));

                            if($oneRow->uri_value !='#'){

                                $services_uri = str_replace('//', '/', '/immigration-services/'.trim(stripslashes($oneRow->uri_value))).'.html';

                            }

                            else{

                                $services_uri = 'javascript:void(0);';

                            }

                            

                            $serviceImgUrl = '';

                            $filePath = "./assets/accounts/serv_$services_id".'_';

                            

                            $pics = glob($filePath."*.jpg");

                            if(!$pics){

                                $pics = glob($filePath."*.png");

                            }

                            

                            if($pics){

                                foreach($pics as $onePicture){

                                    $serviceImgUrl = str_replace('./', '/', $onePicture);

                                }

                            }

                            if(!empty($serviceImgUrl)){

                                $serviceImg = "<img alt=\"".strip_tags(addslashes($name))."\" src=\"$serviceImgUrl\" >";

                            }

                            else{

                                $serviceImg = "<img width=\"318\" height=\"290\" alt=\"".strip_tags(addslashes($name))."\" src=\"/assets/admin/images/event/1.jpg\">";

                            } 



                            $returnHTML .='<div class="col-md-4">

                                <a href="'.$services_uri.'">

                                    <div class="service-box">

                                        <div class="service-img">

                                            '.$serviceImg.'

                                        </div>

                                        <div class="service-content">

                                            <h5>'.$name.'</h5>

                                            <p>'.$short_description.'



                                            </p>

                                            <div class="right-icon">

                                                <i class="fa fa-long-arrow-right"></i>

                                            </div>

                                        </div>

                                    </div>

                                </a>

                            </div>';



                        }

                    }

                            

                    $returnHTML .='
                    
                    </div>

                    <p class="carsl_btn" style="text-align:center;">
                    <!--a href="immigration-services.html" class="btn-more-bg animatedBtnBody">See All Our Services</a-->
                    <a href="immigration-services.html" class="btn_r orange">See All Immigration Services</a>
                    </p>



            </div>
            

        </section>
        <!-- Service Area End -->
        
                    
        <!-- About Us Area Start -->
        <section class="abouts-area">                    
            <div class="container">                        
                <div class="row">
                
                    <div class="col-md-6">                    
                        <div class="about-left">';

                            $video = '';

                            $tableObj = $this->db->getObj("SELECT youtube_url FROM videos WHERE videos_publish=1 ORDER BY videos_id ASC LIMIT 0,1", array());

                            if($tableObj){

                                while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                    $video = trim(stripslashes($oneRow->youtube_url));

                                }

                            }

                            $galleryObj = $this->db->getObj("SELECT photo_gallery_id, name FROM photo_gallery WHERE photo_gallery_publish = 1 AND photo_gallery_id = 6 LIMIT 0, 1", array());

                            if($galleryObj){ 

                                while($oneGalleryRow = $galleryObj->fetch(PDO::FETCH_OBJ)){

                                    $photo_gallery_id = $oneGalleryRow->photo_gallery_id;

                                    $gallery_name = stripslashes(trim((string) $oneGalleryRow->name));



                                    $filePath = "./assets/accounts/photo_$photo_gallery_id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(empty($pics) || !$pics){

                                        $pics = glob($filePath."*.png");

                                    }                            

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $prodImg = str_replace("./assets/accounts/", '', $onePicture);

                                            $photo_galleryImgUrl = str_replace('./', '/', $onePicture);  

                                        }

                                    }



                                }

                            }  

                            $returnHTML .='

                            <a href="https://www.youtube.com/embed/d2GgwR7kIKs" target="_blank">
                                <div class="about-img-box">
                                    <img src="'.$photo_galleryImgUrl.'" alt="" srcset="" style="width:100%; height:100%;"></a>
                                    <a href="https://www.youtube.com/embed/d2GgwR7kIKs" target="_blank">
                                        <div class="youtube-icon">
                                            <img src="/website_assets/images/pngegg.png" width="30" height="30">
                                        </div>
                                    </a>
                                </div>
                            </a>

                            <div class="about-sign-box">
                                <a href="https://canadianimmigrationlegal.com/salauddin-ahmed">
                                <h4>Mr. Salauddin Ahmed</h4></a>
                                <h6>Lead consultant </h6>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="about-right">

                            <h3 class="about-title">

                                <span>'.$bodyPages[45][0].'</span>

                            </h3>

                            <p class="about-p3" style="text-align:justify;">'.$bodyPages[45][1].'</p>



                            <p class="about-p2" style="text-align:justify;"><span>'.$bodyPages[4][0].'</span></p>



                            <p class="about-p3" style="text-align:justify;">'.$bodyPages[4][1].'</p>



                            <div class="call-box">

                                <img src="/website_assets/images/phone-iocn.jpg" alt="" srcset="">

                                <div class="calling-us">

                                    <h4><span class="calling-us-span">'.$bodyPages[15][0].'</span>

                                        <a href="tel:'.$bodyPages[15][1].'">'.$bodyPages[15][1].'</a></h4>

                                </div>

                                <!--div class="calling-us">

                                    <p class="migration-assessment-box-home" ><a href="immigration-assessment.html">get your free assessment today!</a></p>

                                </div-->

                            </div>



                        </div>

                    </div>

                </div>

                <div class="mission-commitment-area">

                    <div class="mission-box">

                        <div class="number-box">

                            <h6>01</h6>

                        </div>

                        <div class="content-text-box">

                            <h4>'.$bodyPages[12][0].'</h4>

                            <p class="justify-content-center">'.$bodyPages[12][1].'</p>

                        </div>

                    </div>

                    <div class="mission-box">

                        <div class="number-box">

                            <h6>02</h6>

                        </div>

                        <div class="content-text-box">

                            <h4>'.$bodyPages[13][0].'</h4>

                            <p class="justify-content-center">'.$bodyPages[13][1].'</p>

                        </div>

                    </div>

                </div>
            </div>
        </section>        
        <!-- About Us Area End -->   


        <!-- FAQ Area Start -->

        <section class="help-section">

            <div class="container">

                <div class="section-title">

                    <p>'.$bodyPages[19][1].'</p>

                    <h4>'.$bodyPages[19][0].'</h4>

                </div>

                <div class="row">

                    <div class="col-md-7">';



                        $whyChUsObj = $this->db->getObj("SELECT why_choose_us_id, name, description FROM why_choose_us WHERE why_choose_us_publish = 1 ORDER BY RAND() LIMIT 0,4", array());

                        $i = 0;

                        if($whyChUsObj){

                            while($oneRow = $whyChUsObj->fetch(PDO::FETCH_OBJ)){

                                $i++;

                                $why_choose_us_id = $oneRow->why_choose_us_id;

                                $name = trim(stripslashes($oneRow->name));

                                $description = stripslashes($oneRow->description);                    



                                $returnHTML .='<div class="mission-box">

                                    <div class="number-box">

                                        <h6>0'.$i.'</h6>

                                    </div>

                                    <div class="content-text-box">

                                        <h4>'.$name.'</h4>

                                        <p>'.$description.'</p>

                                    </div>

                                </div>';

                                

                            }

                        }



                        $returnHTML .='

                    </div>

                    <div class="col-md-5">

                        <div class="help-img border-gradient border-gradient-green">';



                            $galleryObj = $this->db->getObj("SELECT photo_gallery_id, name FROM photo_gallery WHERE photo_gallery_publish = 1 AND photo_gallery_id = 7 LIMIT 0, 1", array());

                            if($galleryObj){ 

                                while($oneGalleryRow = $galleryObj->fetch(PDO::FETCH_OBJ)){

                                    $photo_gallery_id = $oneGalleryRow->photo_gallery_id;

                                    $gallery_name = stripslashes(trim((string) $oneGalleryRow->name));



                                    $filePath = "./assets/accounts/photo_$photo_gallery_id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(empty($pics) || !$pics){

                                        $pics = glob($filePath."*.png");

                                    }                            

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $prodImg = str_replace("./assets/accounts/", '', $onePicture);

                                            $photo_galleryImgUrl = str_replace('./', '/', $onePicture);  

                                        }

                                    }



                                }

                            }



                            $returnHTML .='<img  src="'.$photo_galleryImgUrl.'" alt="Guide To the Visa Application" srcset="">

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- FAQ Area End -->





        <!-- Our Team Area Start -->

        <section class="our-expert-team">

            <div class="section-title">

                <h4>'.$bodyPages[20][0].'</h4>                

            </div>

            <div class="container">

                <div class="row">';



                    $customerObj = $this->db->getObj("SELECT customers_id, name, uri_value, address FROM customers WHERE customers_publish = 1 ORDER BY RAND() LIMIT 0,4", array());



                    if($customerObj){

                        while($oneRow = $customerObj->fetch(PDO::FETCH_OBJ)){

            

                            $customers_id = $oneRow->customers_id;

                            $name = trim(stripslashes($oneRow->name));

                            $address = stripslashes($oneRow->address);
                            $uri_value = stripslashes($oneRow->uri_value);
                            // var_dump($uri_value);exit;

                            $filePath = "./assets/accounts/customer_$customers_id".'_';

                            $catPics = glob($filePath."*.jpg");

                            if(!$catPics){

                                $catPics = glob($filePath."*.png");

                            }

            

                            $customerImgSrc = '/assets/images/missing-picture.jpg';                                            

                            if($catPics){

                                foreach($catPics as $onePicture){

                                    $customerImgSrc = str_replace("./", '/', $onePicture);

                                }

                            } 



                            $returnHTML .='<div class="col-md-3">


                            

                                <div class="member">

                                    <div class="m-img">

                                    <a href='.$uri_value.'><img src='.$customerImgSrc.'></a>

                                        <div class="member-hover">

                                            <a href="#"><i class="fa fa-facebook-f"></i></a>

                                            <a href="#"><i class="fa fa-twitter-square"></i></a>

                                            <a href="#"><i class="fa fa-dribbble"></i></a>

                                        </div>
                                        

                                    </div>

                                    <div class="img-desc">

                                    <a href='.$uri_value.'><h4>'.$name.'</h4></a>

                                        <a href='.$uri_value.'><p>'.$address.'</p></a>
                                        

                                    </div>

                                </div>



                                


                            </div>';

                            

                        }

                    }  



                    $returnHTML .='                   

                </div>

                <p class="carsl_btn" style="text-align:center;">
                <!--a href="immigration-services.html" class="btn-more-bg animatedBtnBody">See All Our Stuff</a-->
                <a href="'.$bodyPages[20][2].'" class="btn_r orange">See All Our Stuff</a>
                </p>

            </div>

           

        </section>

        <!-- Our Team Area End -->


        <!-- Testimonial Area Start -->        

        <section class="testimonials-style1-area">

            <div class="map-layer paroller"

                style="background-image: url(images/map-1.png); transform: translateY(-49px); transition: transform 0.6s cubic-bezier(0, 0, 0, 1) 0s; will-change: transform;">

            </div>

            <div class="container">

                <div class="row">

                    <div class="col-xl-4">

                        <div class="testimonial-style1-title-box">

                            <div class="sec-title">                               

                                <h2>'.$bodyPages[21][0].'<br>

                                '.$bodyPages[22][0].'</h2>

                                <p>'.$bodyPages[21][1].'s</p>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="testimonial-style1-content-box">

                            <div class="owl-carousel testimonial-area owl-theme thm-owl__carousel testimonial-style1-carousel owl-nav-style-one owl-loaded owl-drag"

                                data-owl-options="{

                                    &quot;loop&quot;: true,

                                    &quot;autoplay&quot;: true,

                                    &quot;margin&quot;: 30,

                                    &quot;nav&quot;: true,

                                    &quot;dots&quot;: false,

                                    &quot;smartSpeed&quot;: 500,

                                    &quot;autoplayTimeout&quot;: 1000,

                                    &quot;navText&quot;: [&quot;

                                                <span class=\&quot;left icon-left-arrow\&quot;></span>&quot;,&quot;

                                                <span class=\&quot;right icon-right-arrow\&quot;></span>&quot;],

                                    &quot;responsive&quot;: {

                                            &quot;0&quot;: {

                                                &quot;items&quot;: 1

                                            },

                                            &quot;768&quot;: {

                                                &quot;items&quot;: 2

                                            },

                                            &quot;992&quot;: {

                                                &quot;items&quot;: 2

                                            },

                                            &quot;1200&quot;: {

                                                &quot;items&quot;: 2

                                            }

                                        }

                                    }">

                                <div class="owl-stage-outer">

                                    <div class="owl-stage"

                                        style="transform: translate3d(-800px, 0px, 0px); transition: all 0.5s ease 0s; width: 2400px;">';



                                        $customerRreviewsObj = $this->db->getObj("SELECT customer_reviews_id, name, address, description FROM customer_reviews WHERE customer_reviews_publish = 1 ORDER BY RAND() LIMIT 0,4", array());

                                        $i = 0;



                                        if($customerRreviewsObj){

                                            while($oneRow = $customerRreviewsObj->fetch(PDO::FETCH_OBJ)){

                                                $i++;

                                                $customer_reviews_id = $oneRow->customer_reviews_id;

                                                $name = trim(stripslashes($oneRow->name));

                                                $address = trim(stripslashes($oneRow->address));

                                                $description = stripslashes($oneRow->description); 



                                                $returnHTML .='<div class="owl-item" style="width: 370px; margin-right: 30px;">

                                                    <div class="single-testimonials-style1">

                                                        <div class="single-testimonials-style1__inner">



                                                            <div class="text-box">

                                                                <p>'.$description.' </p>

                                                                <div class="title-box">

                                                                    <div>

                                                                        <h3>'.$name.'</h3>

                                                                        <span>'.$address.'</span>

                                                                    </div>

                                                                    <div class="qutation">

                                                                        <img src="/website_assets/images/icon9.png" alt="" srcset="">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>



                                                    </div>

                                                </div>';                                                

                                            }

                                        }



                                        $returnHTML .='

                                    </div>

                                </div>

                                

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- Testimonial Area End -->    



        <!-- Subscription Area Start -->    

        <section class="free-consultant">

            <div class="container">

                <div class="row">

                    <div class="col-md-6">

                        <div class="free-left">

                            <h3><span>we’re delivering the best</span>

                                customer experience</h3>

                            <h5>If You Are Looking For Visa Applications, Just Call Us!</h5>

                            <h4><span>Call us today :</span> <a href="tel:416-686-7713">416-686-7713</a></h4>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="free-right">

                            <a href="immigration-assessment.html">Book A Free Consultation!</a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- Subscription Area End -->';



        $returnHTML .= $this->footerHTML();

        

        

		return $returnHTML;

    }



    function sendAppointments(){



        //================Email Options Here==============//    
        

        $returnData = array();

        $returnData['savemsg'] = 'error';

        $services_id = intval($_POST['services_id']??0);

		$name = addslashes(trim($_POST['name']??''));

		$phone = addslashes(trim($_POST['phone']??''));

		$email = addslashes(trim($_POST['email']??''));	

		$description = addslashes(trim($_POST['description']??''));	

		$address = addslashes(trim($_POST['address']??''));	

        

        $customerData = array();

		$customerData['name'] = $name;

		$customerData['phone'] = $phone;

		$customerData['email'] = $email;

		$customerData['address'] = $address;

		

        $customers_id = 0;

        $queryManuObj = $this->db->getObj("SELECT customers_id FROM customers WHERE name = :name AND phone = :phone", array('name'=>$name, 'phone'=>$phone));

        if($queryManuObj){

            $customers_id = $queryManuObj->fetch(PDO::FETCH_OBJ)->customers_id;						

        }        

        if($customers_id==0){

            $customerData['offers_email'] = 1;

            $customerData['customers_publish'] = 1;

            $customerData['users_id'] = 0;

            $customerData['last_updated'] = date('Y-m-d H:i:s');

            $customerData['created_on'] = date('Y-m-d H:i:s');

            $customers_id = $this->db->insert('customers', $customerData);

        }

        if($customers_id>0 && $services_id>0){

            

            $appointmentsData = array();

            $appointmentsData['created_on'] = date('Y-m-d H:i:s');

            $appointmentsData['last_updated'] = date('Y-m-d H:i:s');

            $appointmentsData['users_id'] = 1;

            $appointmentsData['appointments_publish'] = 1;

            $appointmentsData['notifications'] = 1;

            $appointments_no = 1;

            $queryObj = $this->db->getObj("SELECT appointments_no FROM appointments ORDER BY appointments_no DESC LIMIT 0, 1", array());

            if($queryObj){

                $appointments_no = intval($queryObj->fetch(PDO::FETCH_OBJ)->appointments_no)+1;

            }



            $appointmentsData['appointments_no'] = $appointments_no;

            $appointmentsData['services_id'] = $services_id;

            $appointmentsData['customers_id'] = $customers_id;

            $appointmentsData['services_type'] = '';

            $appointmentsData['description'] = $description;

            $appointmentsData['appointments_date'] = date('Y-m-d');

            $appointments_id = $this->db->insert('appointments', $appointmentsData);

            if($appointments_id){

		        $returnData['savemsg'] = 'Sent';

            }

        }

        

        return json_encode($returnData);

    }



	public function whyChooseUs(){  

        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="why-choose-us-area background" style="padding:20px 0;">

            <div class="container">

                <div class="row">

                    <div class="col-md-10" style="margin:0 auto;">';



                        $tableObj = $this->db->getObj("SELECT name, description FROM why_choose_us WHERE why_choose_us_publish =1 ORDER BY RAND() LIMIT 0, 4", array());

                        if($tableObj){

                            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                $name = trim(stripslashes($oneRow->name));

                                $description = trim(stripslashes($oneRow->description));



                                $returnHTML .= '

                                <div class="choose-box">

                                    <div class="icon icon1">

                                        <i class="fa-solid fa-reply"></i>

                                    </div>

                                    <div class="choose-box-content">

                                        <h4>'.$name.'</h4>

                                        <div class="text">'.$description.'</div>

                                    </div>

                                </div>';

                            }

                        }



                    $returnHTML .= '</div>                       

                </div>

            </div>

        </section>';

        $returnHTML .= $this->footerHTML();

		return $returnHTML;

	}



    public function newsMain(){ 

        

        $returnHTML = $this->headerHTML();



        $returnHTML .= '

        <section class="blog-area" style="padding:20px 0;">

            <div class="container">

                <div class="row">

                    <div class="col-md-10" style="margin:0 auto;">';

                        $pr = 0;

                        $tableObj = $this->db->getObj("SELECT news_articles_id, name, news_articles_date, created_by, uri_value, short_description FROM news_articles WHERE news_articles_publish =1 ORDER BY RAND() LIMIT 0, 3", array());

                        if($tableObj){

                            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                $news_articles_id = $oneRow->news_articles_id;

                                $name = trim(stripslashes($oneRow->name));

                                $created_by = trim(stripslashes($oneRow->created_by));

                                $news_articles_date = date('m/d/Y', strtotime($oneRow->news_articles_date));

                                $uri_value = trim(stripslashes($oneRow->uri_value));

                                $short_description = trim(stripslashes($oneRow->short_description));

                                $filePath = "./assets/accounts/news_$news_articles_id".'_';

                                $catPics = glob($filePath."*.jpg");

                                if(!$catPics){

                                    $catPics = glob($filePath."*.png");

                                }



                                $catImgSrc = '/assets/images/missing-picture.jpg';                                            

                                if($catPics){

                                    foreach($catPics as $onePicture){

                                        $catImgSrc = str_replace("./", '/', $onePicture);

                                    }

                                }



                                $returnHTML .= "

                                <div class=\"single-card card-style-one mt-30 mb-30\">";

                                

                                if($pr%2 == 0){

                                    

                                    $returnHTML .= "

                                    <div class=\"row ml-0 mr-0\">

                                        <div class=\"col-md-6 order-md-1 text-center\">                                            

                                            <a href=\"$uri_value.html\"><img src=\"$catImgSrc\" alt=\"\"></a>

                                        </div>

                                        <div class=\"col-md-6 order-md-2 blog-content\">

                                            <h2 class=\"featurette-heading-new lh-1\">$name </h2>

                                            <p class=\"lead\">$short_description</p>

                                            <br>

                                            <p class=\"post-meta\">

                                                By <span> $created_by</span> - $news_articles_date

                                            </p>

                                            <div class=\"arrow d-flex justify-content-left\">

                                                <a class=\"btn btn-outline-danger btn-sm my-3\" href=\"$uri_value.html\">Read More<a>

                                            </div>

                                        </div>                                        

                                    </div>

                                    ";

                                } else {

                                    $returnHTML .="

                                    <div class=\"row ml-0 mr-0\" >

                                        <div class=\"col-md-8\">

                                            <h2 class=\"featurette-heading-new lh-1 float-right\">$name. </h2><br><br>

                                            <p class=\"lead float-right\">$short_description.</p><br>

                                            <br>

                                            <p class=\"post-meta\">

                                                By <span> $created_by</span> - $news_articles_date

                                            </p>

                                            <div class=\"arrow d-flex float-right\">

                                                <a class=\"btn btn-warning  float-right\" href=\"$uri_value.html\">Read More<a>

                                            </div>

                                        </div>

                                        <div class=\"col-md-4\">                                            

                                        <a href=\"$uri_value.html\"><img src=\"$catImgSrc\" alt=\"\"></a>

                                        </div>

                                    </div>";       

                                }

                                $returnHTML .= "</div>";

                            }

                        }

                        $returnHTML .= '                    

                    </div>

                </div>

            </div>

        </section>';

        $returnHTML .= $this->footerHTML();        

        

		return $returnHTML;

    }



    public function fetchNews(){



        $returnStr = '';



        if(isset($_POST['start'])){

            $pr = 0;

            $start = $_POST['start'];

            $tablePageObj = $this->db->getObj("SELECT * FROM news_articles WHERE news_articles_publish = 1 limit $start,1", array());

            if($tablePageObj){

                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){

                    $pr++;

                    $news_articles_id = $onePageRow->news_articles_id;

                    $short_description = nl2br(trim(stripslashes($onePageRow->short_description)));

                    $uri_value = nl2br(trim(stripslashes($onePageRow->uri_value)));

                    $description = nl2br(trim(stripslashes($onePageRow->description)));

                    $name = nl2br(trim(stripslashes($onePageRow->name)));



                    $filePath = "./assets/accounts/news_$news_articles_id".'_';

                    $catPics = glob($filePath."*.jpg");

                    if(!$catPics){

                        $catPics = glob($filePath."*.png");

                    }



                    $catImgSrc = '/assets/images/missing-picture.jpg';                                            

                    if($catPics){

                        foreach($catPics as $onePicture){

                            $catImgSrc = str_replace("./", '/', $onePicture);

                        }

                    }



                    $returnStr .= "

                        <div class=\"row featurette\" >

                            <div class=\"col-md-9 order-md-2\">

                                <h2 class=\"featurette-heading-new lh-1\">$name</h2>

                                <p class=\"lead\">$short_description</p>

                                <br>

                                <div class=\"arrow d-flex justify-content-left\">

                                    <a class=\"btn btn-warning\" href=\"$uri_value.html\">Read More<a>

                                    <a href=\"'.$uri_value.'.html\"></a>  

                                </div>

                            </div>

                            <div class=\"col-md-3 order-md-1\">                                            

                            <a href=\"blog-details.html\"><img src=\"$catImgSrc\" alt=\"\"></a>

                            </div>

                            <div class=\"separator\"></div>

                        </div>";



                }

            }

        }



        echo $returnStr;



    }



    public function newsMainOLD(){ 

        

        $returnHTML = $this->headerHTML();



        $returnHTML .= '

        <br><br>

        <section>

            <div class="container">                    

                <div class="row">

                    ';



                        $tableObj = $this->db->getObj("SELECT news_articles_id, name, news_articles_date, created_by, uri_value, short_description FROM news_articles WHERE news_articles_publish =1 ORDER BY RAND() LIMIT 0, 3", array());

                        

                        if($tableObj){

                            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                $news_articles_id = $oneRow->news_articles_id;

                                $name = trim(stripslashes($oneRow->name));

                                $created_by = trim(stripslashes($oneRow->created_by));

                                $news_articles_date = date('m/d/Y', strtotime($oneRow->news_articles_date));

                                $uri_value = trim(stripslashes($oneRow->uri_value));

                                $short_description = trim(stripslashes($oneRow->short_description));

                                $filePath = "./assets/accounts/news_$news_articles_id".'_';

                                $catPics = glob($filePath."*.jpg");

                                if(!$catPics){

                                    $catPics = glob($filePath."*.png");

                                }



                                $catImgSrc = '/assets/images/missing-picture.jpg';                                            

                                if($catPics){

                                    foreach($catPics as $onePicture){

                                        $catImgSrc = str_replace("./", '/', $onePicture);

                                    }

                                }



                                $returnHTML .= '<div class="col-lg-4 news-block-one">

                                    <div class="inner-box wow fadeInDown" data-wow-duration="1500ms">

                                        <div class="image"><a href="blog-details.html"><img src="'.$catImgSrc.'" alt=""></a></div>

                                        <h5><strong>'.$name.'</strong></h5>

                                        <p><a href="'.$uri_value.'.html">'.$short_description.'</a></p>

                                        <div class="post-meta">By <a href="#"><span> '.$created_by.'</span></a> - <a href="#">'.$news_articles_date.'</a></div>

                                        <div class="link-btn"><a href="'.$uri_value.'.html" class="theme-btn btn-style-one style-two"><span> Learn More</span></a></div>

                                    </div>

                                </div>';

                            }

                        }



                        $returnHTML .= '

                    

                </div>';                    

                $returnHTML .= '

            </div>

        </section><br><br>';

        $returnHTML .= $this->footerHTML();

        

        

		return $returnHTML;

    }



    public function newses(){

        

        $id = $GLOBALS['id'];



        if($id>0){

            $returnHTML = $this->headerHTML();



            $returnHTML .= '

            <section>

                <div class="container">                    

                    <div class="row">

                        <div class="col-md-12">

                            <div class="single-card card-style-one mt-30 mb-30">';

                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM news_articles WHERE news_articles_id = $id", array());

                            if($tablePageObj){

                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $serviceImgUrl = ''; 

                                    $filePath = "./assets/accounts/news_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $serviceImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($serviceImgUrl)){

                                        $serviceImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$serviceImgUrl\"  style=\"height:90% !important; padding:20px;\">";

                                    }

                                    else{

                                        $serviceImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\"  width=\"500\" height=\"500\" >";

                                    } 



                                    $returnHTML .= "<div class=\"card-content\" style=\"padding:20px;\">

                                        <div class=\"row\">

                                            <div class=\"col-md-7 order-md-2\">

                                                <p class=\"txtJustfy\">".nl2br(trim(stripslashes($onePageRow->short_description)))."</p>

                                                <p class=\"txtJustfy\">".nl2br(trim(stripslashes($onePageRow->description)))."</p>

                                                

                                                <br>

                                                <button class=\"btn btn-danger\" onclick=\"history.back()\">Go Back</button>

                                                <br><br>

                                            </div>

                                            <div class=\"col-md-5 order-md-1\">

                                                $serviceImg

                                            </div>                                        

                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>

                        </div>

                    </div>

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

        

		return $returnHTML;

    }


    public function pages(){     

        $id = $GLOBALS['id'];

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }      

        if($id>0){            

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section class="background">

                <div class="container" style="border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <!--main body-->                    
                            <div class="single-card card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
                            ';                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 
                                

                                    $returnHTML .= "

                                    <div class=\"card-content\" style=\"border:0px solid red;\">

                                        <div class=\"row\" style=\"border:0px solid red;\">"; 

                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                

                                            $returnHTML .= $this->sidebarHTML(); 

                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                        <div class=\"wrap_text about-area\">
                                                            <div class=\"floated\">
                                                            $pageImg
                                                            </div>
                                                            <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                            // nl2br(trim(stripslashes($onePageRow->short_description))).
                                                            nl2br(trim(stripslashes($onePageRow->description)))."
                                                            <!--ul style=\"margin-top:20px !important;margin-left:20px !important;\" class=\"list\">";

                                                                $metaUrl = $this->db->seoInfo('immiUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a style=\"font-style: normal; font-weight: 300; font-display: swap;\" title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }
                                                                $returnHTML .= "
                                                            </ul-->
                                                        </div>                                                  
                                                    

                                                    

                                                    <!--div class=\"row col-md-12 eq_row\" style=\"border:0px solid red;\">                                                               

                                                        <div class=\"flex-box\">

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR MISSION</h3>

                                                                <p> Responsible for the future immigration dreams of our clients, our mission is to provide practical solutions and legal support to anyone wanting to come to Canada.

                                                                </p> 

                                                            </div>

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR COMMITMENT</h3>

                                                                <p> We work with our clients to obtain their Visa to Canada. We will communicate the status of their application and help solve their problems so their case is a success.

                                                                </p> 

                                                                

                                                            </div>                                                                

                                                        </div>

                                                    </div-->


                                                </div>                                               

                                            </div>                                





                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </!div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

           

		return $returnHTML;

    }



    public function pagesOLD(){        

        $id = $GLOBALS['id'];

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }

        if($id>0){

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section>

                <div class="container" style="min-width:80% !important; border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12" style="border:0px solid red;">

                            <div class="single-card card-style-one pl-2 mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';
                 
                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 


                                

                                    $returnHTML .= "

                                    <div class=\"card-content\">

                                        <div class=\"row\">";                                            



                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\">";

                                                

                                            $returnHTML .= $this->sidebarHTML();   



                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"height:100% !important; border:0px solid red !important;\">
                                                
                                                <div class=\"col-md-12\">

                                                    <h2 class=\"mb-10 fontdescription_two\"><strong>$name</strong></h2>

                                                </diV>                                                

                                                <div class=\"row\" >

                                                    <div class=\"banner-image-wrapper col-md-5\" style=\"padding-top:20px; padding-left:20px; padding-right:20px;\">                                            

                                                        <p class=\"text-center\" style=\"border:0px solid red;\">$pageImg</p>

                                                    </diV>

                                                    <div class=\"about-area col-md-7\" style=\"padding-left:0px !important; padding-right:20px; padding-top:0px; padding-bottom:0px ;\"> 
                                                    
                                                        <div class=\"about-content\">                                                            

                                                            <p class=\"roboto_txt txtJustfy\">".nl2br(trim(stripslashes($onePageRow->short_description)))."</p>   
                                                            
                                                
                                                            <p class=\"txtJustfy\">".nl2br(trim(stripslashes($onePageRow->description)))."</p>
                                                            
                                                        </div>

                                                    </div>                                                                                                       

                                                    <div class=\"row col-md-12 eq_row\" style=\"padding-top:0px !important; margin-top:0px !important; padding-left:36px !important; padding-right:20px; \">
                                                    </div>

                                                </div>
                                               

                                            </div> 

                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section><br><br>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

        

		return $returnHTML;

    }



    public function aboutUs(){     

        $id = 3;

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }        

        if($id>0){            

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section class="background">

                <div class="container" style="border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <div class="single-card card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
                            
                            <!--div class="col-12">
                                <ul class="breadcrumbs " style="border:0px solid red; margin:0 auto; ">
                                    <li class="breadcrumbs_item"><a href="/" style="">Home</a></li>
                                    <li class="breadcrumbs_item active" aria-current="page"><a href="/" style="">'.$GLOBALS['title'].'</a></li>
                                </ul>
                            </div-->';                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){
                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 
                                

                                    $returnHTML .= "

                                    <div class=\"card-content\" style=\"border:0px solid red;\">

                                        <div class=\"row\" style=\"border:0px solid red;\">"; 

                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                

                                            $returnHTML .= $this->sidebarHTML(); 

                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                        <div class=\"wrap_text about-area\">
                                                            <div class=\"floated\">
                                                            $pageImg
                                                            </div>
                                                            <h2 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h2> ".
                                                            nl2br(trim(stripslashes($onePageRow->short_description)))."
                                                            <!--ul style=\"margin-top:20px !important;margin-left:20px !important;\" class=\"list\">";

                                                                $metaUrl = $this->db->seoInfo('aboutUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a style=\"font-style: normal; font-weight: 300; font-display: swap;\" title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }
                                                                $returnHTML .= "
                                                            </ul-->
                                                        </div>                                                  
                                                    

                                                    

                                                    <!--div class=\"row col-md-12 eq_row\" style=\"border:0px solid red;\">                                                               

                                                        <div class=\"flex-box\">

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR MISSION</h3>

                                                                <p> Responsible for the future immigration dreams of our clients, our mission is to provide practical solutions and legal support to anyone wanting to come to Canada.

                                                                </p> 

                                                            </div>

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR COMMITMENT</h3>

                                                                <p> We work with our clients to obtain their Visa to Canada. We will communicate the status of their application and help solve their problems so their case is a success.

                                                                </p> 

                                                                

                                                            </div>                                                                

                                                        </div>

                                                    </div-->


                                                </div>                                               

                                            </div>                                





                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

           

		return $returnHTML;

    }


    public function immigration(){   
        
        

        $id = 29;

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }        

        if($id>0){            

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section>

                <div class="container" style="border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <div class="single-card card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
                            <div class="col-12">
                                <ul class="breadcrumbs " style="border:0px solid red; margin:0 auto;">
                                    <li class="breadcrumbs_item"><a href="/" style="">Home</a></li>
                                    <li class="breadcrumbs_item active" aria-current="page"><a href="/" style="">'.$GLOBALS['title'].'</a></li>
                                </ul>
                            </div>';                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){
                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 
                                

                                    $returnHTML .= "

                                    <div class=\"card-content\" style=\"border:0px solid red;\">

                                        <div class=\"row\" style=\"border:0px solid red;\">"; 

                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                

                                            $returnHTML .= $this->sidebarHTML(); 

                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                        <div class=\"wrap_text about-area\">
                                                            <div class=\"floated\">
                                                            $pageImg
                                                            </div>
                                                            <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                            nl2br(trim(stripslashes($onePageRow->short_description)))."
                                                            <ul style=\"margin-top:20px !important;margin-left:20px !important;\" class=\"list\">";

                                                                $metaUrl = $this->db->seoInfo('immiUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a style=\"font-style: normal; font-weight: 300; font-display: swap;\" title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }
                                                                $returnHTML .= "
                                                            </ul>
                                                        </div>                                                  
                                                    

                                                    

                                                    <!--div class=\"row col-md-12 eq_row\" style=\"border:0px solid red;\">                                                               

                                                        <div class=\"flex-box\">

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR MISSION</h3>

                                                                <p> Responsible for the future immigration dreams of our clients, our mission is to provide practical solutions and legal support to anyone wanting to come to Canada.

                                                                </p> 

                                                            </div>

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR COMMITMENT</h3>

                                                                <p> We work with our clients to obtain their Visa to Canada. We will communicate the status of their application and help solve their problems so their case is a success.

                                                                </p> 

                                                                

                                                            </div>                                                                

                                                        </div>

                                                    </div-->


                                                </div>                                               

                                            </div>                                





                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

           

		return $returnHTML;

    }


    public function immigrationOLD2(){     

        $id = 26;

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }        

        if($id>0){            

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section>

                <div class="container" style="border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <div class="single-card card-style-one pl-2 mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){
                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 
                                

                                    $returnHTML .= "

                                    <div class=\"card-content\" style=\"border:0px solid red;\">

                                        <div class=\"row\" style=\"border:0px solid red;\">"; 

                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" >";                                                

                                            $returnHTML .= $this->sidebarHTML(); 

                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                        <div class=\"wrap_text about-area\">
                                                            <div class=\"floated\">
                                                            $pageImg
                                                            </div>
                                                            <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                            nl2br(trim(stripslashes($onePageRow->short_description)))."
                                                            <ul style=\"margin-top:20px !important;margin-left:20px !important;\" class=\"list\">";

                                                                $metaUrl = $this->db->seoInfo('immiUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a style=\"font-style: normal; font-weight: 300; font-display: swap;\" title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }
                                                                $returnHTML .= "
                                                            </ul>
                                                        </div>                                                  
                                                    

                                                    

                                                    <!--div class=\"row col-md-12 eq_row\" style=\"border:0px solid red;\">                                                               

                                                        <div class=\"flex-box\">

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR MISSION</h3>

                                                                <p> Responsible for the future immigration dreams of our clients, our mission is to provide practical solutions and legal support to anyone wanting to come to Canada.

                                                                </p> 

                                                            </div>

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR COMMITMENT</h3>

                                                                <p> We work with our clients to obtain their Visa to Canada. We will communicate the status of their application and help solve their problems so their case is a success.

                                                                </p> 

                                                                

                                                            </div>                                                                

                                                        </div>

                                                    </div-->


                                                </div>                                               

                                            </div>                                





                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

           

		return $returnHTML;

    }



    public function immigrationOLD(){

       

        $id = 26;

        

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 25=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }

        

        if($id>0){

            

            $returnHTML = $this->headerHTML();



            $returnHTML .= '

            <section>



                <div class="container" style="min-width:80% !important; border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">



                            <div class="single-card card-style-one pl-2 mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';

                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){

                                

                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"width:90% !important;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 



                                

                                    $returnHTML .= "

                                    <div class=\"card-content\">

                                        <div class=\"row\">";                                            



                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\">";

                                                

                                            $returnHTML .= $this->sidebarHTML();   



                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\" height:100% !important; border:0px solid red !important;\">

                                                

                                                <div class=\"col-md-12\">

                                                    <h2 class=\"mb-10 fontdescription_two\"><strong>". $bodyPages[25][0]."</strong></h2>

                                                </diV>

                                            

                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                    <div class=\"col-md-5\" style=\"padding-top:5px; padding-left:5px; padding-right:5px;\">

                                                        $pageImg

                                                    </diV>

                                                    <div class=\"about-area col-md-7\" style=\"padding-left:0px !important; padding-right:20px; padding-top:0px; padding-bottom:0px ;\"> 

                                                    

                                                        <div class=\"about-content\">

                                                            

                                                            <p class=\"txtJustfy\">".nl2br(trim(stripslashes($onePageRow->short_description)))."</p> 
                                                            

                                                            <ul style=\"margin-top:20px !important;\" class=\"list\">";

                                                                $metaUrl = $this->db->seoInfo('immiUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }                    

                                                                $returnHTML .= '

                                                            </ul>

                                                        
                                                           
                                                            
                                                        </div>
                                                    </div>
                                                </div>  

                                                        <!-- FAQ part starts here -->
                                                        <section class="mt-3">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lx-12">
                                                                    <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row justify-content-center mt-2">
                                                                            <div class="col-xl-5 col-lg-8">
                                                                                <div class="text-center">
                                                                                    <h4>Frequently Asked Questions?</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row justify-content-center mt-4">
                                                                            <div class="col-9">
                                                                                <ul class="nav nav-tabs  nav-tabs-custom nav-justified justify-content-center faq-tab-box" id="pills-tab" role="tablist">
                                                                                    <li class="nav-item" role="presentation">
                                                                                        <button class="nav-link active" id="pills-genarel-tab" data-bs-toggle="pill" data-bs-target="#pills-genarel" type="button" role="tab" aria-controls="pills-genarel" aria-selected="true">
                                                                                            <span style="font-size:16px;">General Questions</span>
                                                                                        </button>
                                                                                    </li>
                                                                                    <li class="nav-item" role="presentation">
                                                                                        <button class="nav-link" id="pills-privacy_policy-tab" data-bs-toggle="pill" data-bs-target="#pills-privacy_policy" type="button" role="tab" aria-controls="pills-privacy_policy" aria-selected="false">
                                                                                            <span style="font-size:16px;">Advance Questions</span>
                                                                                        </button>
                                                                                    </li>
                                                                                    <li class="nav-item" role="presentation">
                                                                                        <button class="nav-link" id="pills-teachers-tab" data-bs-toggle="pill" data-bs-target="#pills-pricing_plan" type="button" role="tab" aria-controls="pills-pricing_plan" aria-selected="false">
                                                                                            
                                                                                            <span style="font-size:16px;">Help Resource</span>
                                                                                        </button>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                                    <div class="col-lg-11">
                                                                                    <div class="tab-content pt-3" id="pills-tabContent">
                                                                                        <div class="tab-pane fade active show" id="pills-genarel" role="tabpanel" aria-labelledby="pills-genarel-tab">
                                                                                            <div class="row g-4 mt-2">
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>Do I Need Covered Health Insurance?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;">Yes, if you are a foreign visitor, you will need to have private health insurance during your stay in Canada. 
                                                                                                Canada’s free health care system is not available for visitors from other countries so you will need minimum coverage during your visitation. 
                                                                                                If you are a recent immigrant, you will still need visitors to Canada insurance until you are eligible to receive public health insurance in your province. 
                                                                                            </p>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>Do I Need To Know English Or French?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;">  Yes, most applicants intending to immigrate to Canada must have proof of language ability in either English or French. 
                                                                                                    If you are immigrating from an English-speaking country, you are still required to show proof or complete a language proficiency test like the IELTS (English) or TEF (French) Language Test.</p>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>How Much Money Will I Need?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The amount of money you will need depends on the immigration program you apply for,
                                                                                                    the intended period of visitation, and the number of dependents. Generally speaking, if you are single and are applying for permanent residency under the express entry program,
                                                                                                    you will need a minimum savings of around $13,000 in Canadian dollars to cover costs of settlement, visa and other legal document processing fees, and basic necessities.
                                                                                                    </p>
                                                                                            
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>How Much Time Will It Take To Process The Visa?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The time it takes for Visa processing varies depending on the candidate, 
                                                                                                    country, program, and case. Generally, the expected wait time is between 8 to 32 weeks (2 to 8 months) but can be longer. 
                                                                                                    We advise you to contact us if you are not sure or check the estimated processing time for each application type provided by the Government of Canada.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                            
                                                                                        <div class="tab-pane fade" id="pills-privacy_policy" role="tabpanel" aria-labelledby="pills-privacy_policy-tab">
                                                                                            <div class="row g-4 mt-2">
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>How does Canadian immigration system work?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The Canadian immigration system operates through different programs,
                                                                                                    such as Express Entry, Provincial Nominee Programs (PNPs), Family Sponsorship, and more. Each program has its own eligibility criteria, requirements,
                                                                                                    and application process. Applicants are assessed based on factors like education, work experience, language proficiency, and adaptability.</p>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>Can I apply for Canadian citizenship immediately after arriving in Canada?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> No, you cannot apply for citizenship immediately. 
                                                                                                    You must first become a permanent resident, fulfill the residency requirement, 
                                                                                                    and then apply for Canadian citizenship after a certain period of time (usually three to five years).</p>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>Can I bring my family with me when I immigrate to Canada?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Yes, you can include your immediate family members (spouse or common-law partner, dependent children) in your immigration application. 
                                                                                                    There are also separate sponsorship programs available for sponsoring other family members, such as parents and grandparents.</p>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                <h5>Are there any age restrictions for Canadian immigration?<h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify; font-weight:normal; line-height:1.42;"> While there are no specific age restrictions for most immigration programs,
                                                                                                certain programs may have age limits or specific requirements for different age groups. 
                                                                                                It is important to review the eligibility criteria for each program to understand any age-related considerations.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="tab-pane fade" id="pills-pricing_plan" role="tabpanel">
                                                                                            <div class="row g-4 mt-2">
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>What is the Canadian immigration system?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The Canadian immigration system refers to the policies, programs, 
                                                                                                    and processes established by the Canadian government to regulate the entry and settlement of immigrants in Canada. 
                                                                                                    It includes various pathways and programs through which individuals can apply for temporary or permanent residency in Canada.</p>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>Can I apply for multiple immigration programs simultaneously?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;">Yes, you can submit applications for multiple immigration programs simultaneously, 
                                                                                                    such as Express Entry and Provincial Nominee Programs, if you meet the eligibility requirements. This can increase your chances of obtaining permanent residency in Canada.</p>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>Are there any language requirements for Canadian immigration?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Proficiency in English or French is generally required for most immigration programs.
                                                                                                    Applicants may need to provide language test results, such as IELTS or CELPIP, to demonstrate their language abilities. The level of language proficiency required may vary depending on the program.</p>
                                                                                                </div>
                                                                                                <div class="col-lg-6">
                                                                                                    <h5>What are Provincial Nominee Programs(PNPs)?</h5>
                                                                                                    <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Provincial Nominee Programs are immigration programs through which Canadian provinces and territories nominate individuals 
                                                                                                    who have the skills and qualifications needed in their specific region. Each province or territory has its own set of criteria and streams to select candidates for nomination.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                        </div>
                                                                      </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </section>
                                                
                                                        <!-- FAQ part ends here -->                 

                                            </div> 

                                        </div>
                                    </div>';

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

        

		return $returnHTML;

    }




    public function legalServicesOLD2(){     

        $id = 29;

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }        

        if($id>0){            

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section>

                <div class="container" style="border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 
                                

                                    $returnHTML .= "

                                    <div class=\"card-content\" style=\"border:0px solid red;\">

                                        <div class=\"row\" style=\"border:0px solid red;\">"; 

                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                

                                            $returnHTML .= $this->sidebarHTML(); 

                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                        <div class=\"wrap_text about-area\">
                                                            <div class=\"floated\">
                                                            $pageImg
                                                            </div>
                                                            <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                            nl2br(trim(stripslashes($onePageRow->short_description)))."
                                                            <ul style=\"margin-top:20px !important;margin-left:20px !important;\" class=\"list\">";

                                                                $metaUrl = $this->db->seoInfo('immiUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a style=\"font-style: normal; font-weight: 300; font-display: swap;\" title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }
                                                                $returnHTML .= "
                                                            </ul>
                                                        </div>                                                  
                                                    

                                                    

                                                    <!--div class=\"row col-md-12 eq_row\" style=\"border:0px solid red;\">                                                               

                                                        <div class=\"flex-box\">

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR MISSION</h3>

                                                                <p> Responsible for the future immigration dreams of our clients, our mission is to provide practical solutions and legal support to anyone wanting to come to Canada.

                                                                </p> 

                                                            </div>

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR COMMITMENT</h3>

                                                                <p> We work with our clients to obtain their Visa to Canada. We will communicate the status of their application and help solve their problems so their case is a success.

                                                                </p> 

                                                                

                                                            </div>                                                                

                                                        </div>

                                                    </div-->


                                                </div>                                               

                                            </div>                                





                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

           

		return $returnHTML;

    }

    public function legalServicesOLD(){

       

        $id = 29;

        

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 28=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }

        

        if($id>0){

            

            $returnHTML = $this->headerHTML();



            $returnHTML .= '

            <section>



                <div class="container" style="min-width:80% !important; border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">



                            <div class="single-card card-style-one pl-2 mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';

                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){



                                

                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"width:90% !important;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 

                                

                                    $returnHTML .= "

                                    <div class=\"card-content\">

                                        <div class=\"row\">";                                            



                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\">";

                                                

                                            $returnHTML .= $this->sidebarHTML();   



                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"height:100% !important;  border:0px solid red !important;\">

                                                

                                                <div class=\"col-md-12\">

                                                    <h4 class=\"mb-10 fontdescription_two\"><strong>". $bodyPages[28][0]."</strong></h4>

                                                </diV>



                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                    <div class=\"col-md-5\" style=\"padding-top:5px; padding-left:5px; padding-right:5px;\">

                                                        $pageImg

                                                    </diV>

                                                    <div class=\"about-area col-md-7\" style=\"padding-left:0px !important; padding-right:30px !important; padding-top:0px; padding-bottom:0px ;\"> 

                                                    

                                                        <div class=\"about-content\">                                                            

                                                            <p class=\"txtJustfy text-color\">".nl2br(trim(stripslashes($onePageRow->short_description)))."</p>
                                                            <p class=\"txtJustfy text-color\">".nl2br(trim(stripslashes($onePageRow->description)))."</p>

                                                            <ul style=\"margin-top:20px !important;\" class=\"list flex\">";

                                                                $metaUrl = $this->db->seoInfo('lsUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a title=\"$label\" href=\"/$oneMetaUrl\" style=\"line-height:20px;\">$label</a></li>";

                                                                }                    

                                                                $returnHTML .= '

                                                            </ul>                                                           

                                                        </div>

                                                        

                                                    </div>

                                                </div>
                                                            
                                        <!-- FAQ part starts here -->
                                            <section class="mt-3">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lx-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row justify-content-center mt-2">
                                                                        <div class="col-xl-5 col-lg-8">
                                                                            <div class="text-center">
                                                                                <h4>Frequently Asked Questions?</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-center mt-4">
                                                                        <div class="col-9">
                                                                            <ul class="nav nav-tabs  nav-tabs-custom nav-justified justify-content-center faq-tab-box" id="pills-tab" role="tablist">
                                                                                <li class="nav-item" role="presentation">
                                                                                    <button class="nav-link active" id="pills-genarel-tab" data-bs-toggle="pill" data-bs-target="#pills-genarel" type="button" role="tab" aria-controls="pills-genarel" aria-selected="true">
                                                                                        <span style="font-size:16px;">General Questions</span>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="nav-item" role="presentation">
                                                                                    <button class="nav-link" id="pills-privacy_policy-tab" data-bs-toggle="pill" data-bs-target="#pills-privacy_policy" type="button" role="tab" aria-controls="pills-privacy_policy" aria-selected="false">
                                                                                        <span style="font-size:16px;">Advance Questions</span>
                                                                                    </button>
                                                                                </li>
                                                                                <li class="nav-item" role="presentation">
                                                                                    <button class="nav-link" id="pills-teachers-tab" data-bs-toggle="pill" data-bs-target="#pills-pricing_plan" type="button" role="tab" aria-controls="pills-pricing_plan" aria-selected="false">
                                                                                        
                                                                                        <span style="font-size:16px;">Help Resource</span>
                                                                                    </button>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                                <div class="col-lg-11">
                                                                                <div class="tab-content pt-3" id="pills-tabContent">
                                                                                    <div class="tab-pane fade active show" id="pills-genarel" role="tabpanel" aria-labelledby="pills-genarel-tab">
                                                                                        <div class="row g-4 mt-2">
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Do I Need Covered Health Insurance?</h5>
                                                                                            <p class="text-muted py-1" style="font-size:14px; text-align: justify;">Yes, if you are a foreign visitor, you will need to have private health insurance during your stay in Canada. 
                                                                                            Canada’s free health care system is not available for visitors from other countries so you will need minimum coverage during your visitation. 
                                                                                            If you are a recent immigrant, you will still need visitors to Canada insurance until you are eligible to receive public health insurance in your province. 
                                                                                        </p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Do I Need To Know English Or French?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;">  Yes, most applicants intending to immigrate to Canada must have proof of language ability in either English or French. 
                                                                                                If you are immigrating from an English-speaking country, you are still required to show proof or complete a language proficiency test like the IELTS (English) or TEF (French) Language Test.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>How Much Money Will I Need?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The amount of money you will need depends on the immigration program you apply for,
                                                                                                the intended period of visitation, and the number of dependents. Generally speaking, if you are single and are applying for permanent residency under the express entry program,
                                                                                                you will need a minimum savings of around $13,000 in Canadian dollars to cover costs of settlement, visa and other legal document processing fees, and basic necessities.
                                                                                                </p>
                                                                                        
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>How Much Time Will It Take To Process The Visa?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The time it takes for Visa processing varies depending on the candidate, 
                                                                                                country, program, and case. Generally, the expected wait time is between 8 to 32 weeks (2 to 8 months) but can be longer. 
                                                                                                We advise you to contact us if you are not sure or check the estimated processing time for each application type provided by the Government of Canada.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                        
                                                                                    <div class="tab-pane fade" id="pills-privacy_policy" role="tabpanel" aria-labelledby="pills-privacy_policy-tab">
                                                                                        <div class="row g-4 mt-2">
                                                                                            <div class="col-lg-6">
                                                                                                <h5>How does Canadian immigration system work?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The Canadian immigration system operates through different programs,
                                                                                                such as Express Entry, Provincial Nominee Programs (PNPs), Family Sponsorship, and more. Each program has its own eligibility criteria, requirements,
                                                                                                and application process. Applicants are assessed based on factors like education, work experience, language proficiency, and adaptability.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Can I apply for Canadian citizenship immediately after arriving in Canada?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> No, you cannot apply for citizenship immediately. 
                                                                                                You must first become a permanent resident, fulfill the residency requirement, 
                                                                                                and then apply for Canadian citizenship after a certain period of time (usually three to five years).</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Can I bring my family with me when I immigrate to Canada?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Yes, you can include your immediate family members (spouse or common-law partner, dependent children) in your immigration application. 
                                                                                                There are also separate sponsorship programs available for sponsoring other family members, such as parents and grandparents.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                            <h5>Are there any age restrictions for Canadian immigration?<h5>
                                                                                            <p class="text-muted py-1" style="font-size:14px; text-align: justify; font-weight:normal; line-height:1.42;"> While there are no specific age restrictions for most immigration programs,
                                                                                            certain programs may have age limits or specific requirements for different age groups. 
                                                                                            It is important to review the eligibility criteria for each program to understand any age-related considerations.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="pills-pricing_plan" role="tabpanel">
                                                                                        <div class="row g-4 mt-2">
                                                                                            <div class="col-lg-6">
                                                                                                <h5>What is the Canadian immigration system?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The Canadian immigration system refers to the policies, programs, 
                                                                                                and processes established by the Canadian government to regulate the entry and settlement of immigrants in Canada. 
                                                                                                It includes various pathways and programs through which individuals can apply for temporary or permanent residency in Canada.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Can I apply for multiple immigration programs simultaneously?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;">Yes, you can submit applications for multiple immigration programs simultaneously, 
                                                                                                such as Express Entry and Provincial Nominee Programs, if you meet the eligibility requirements. This can increase your chances of obtaining permanent residency in Canada.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Are there any language requirements for Canadian immigration?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Proficiency in English or French is generally required for most immigration programs.
                                                                                                Applicants may need to provide language test results, such as IELTS or CELPIP, to demonstrate their language abilities. The level of language proficiency required may vary depending on the program.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>What are Provincial Nominee Programs(PNPs)?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Provincial Nominee Programs are immigration programs through which Canadian provinces and territories nominate individuals 
                                                                                                who have the skills and qualifications needed in their specific region. Each province or territory has its own set of criteria and streams to select candidates for nomination.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        
                                        <!-- FAQ part ends here --> 

                                            </div>                                

                                        </div>

                                    </div>';

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

        

		return $returnHTML;

    }


    public function fingerprint(){     

        $id = 31;

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }        

        if($id>0){            

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section>

                <div class="container" style="border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){
                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 
                                

                                    $returnHTML .= "

                                    <div class=\"card-content\" style=\"border:0px solid red;\">

                                        <div class=\"row\" style=\"border:0px solid red;\">"; 

                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                

                                            $returnHTML .= $this->sidebarHTML(); 

                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                        <div class=\"wrap_text about-area\">
                                                            <div class=\"floated\">
                                                            $pageImg
                                                            </div>
                                                            <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                            nl2br(trim(stripslashes($onePageRow->short_description)))."
                                                            <ul style=\"margin-top:20px !important;margin-left:20px !important;\" class=\"list\">";

                                                                $metaUrl = $this->db->seoInfo('immiUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a style=\"font-style: normal; font-weight: 300; font-display: swap;\" title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }
                                                                $returnHTML .= "
                                                            </ul>
                                                        </div>                                                  
                                                    

                                                    

                                                    <!--div class=\"row col-md-12 eq_row\" style=\"border:0px solid red;\">                                                               

                                                        <div class=\"flex-box\">

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR MISSION</h3>

                                                                <p> Responsible for the future immigration dreams of our clients, our mission is to provide practical solutions and legal support to anyone wanting to come to Canada.

                                                                </p> 

                                                            </div>

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR COMMITMENT</h3>

                                                                <p> We work with our clients to obtain their Visa to Canada. We will communicate the status of their application and help solve their problems so their case is a success.

                                                                </p> 

                                                                

                                                            </div>                                                                

                                                        </div>

                                                    </div-->


                                                </div>                                               

                                            </div>                                





                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

           

		return $returnHTML;

    }



    public function fingerprintOLD(){

       

        $id = 31;

        

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 30=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }        

        

        if($id>0){

            

            $returnHTML = $this->headerHTML();



            $returnHTML .= '

            <section>



                <div class="container" style="min-width:80% !important; border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">



                            <div class="single-card card-style-one pl-2 mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';

                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());

                            if($tablePageObj){



                                

                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/page_$id".'_';

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"width:90% !important;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 



                                

                                    $returnHTML .= "

                                    <div class=\"card-content\">

                                        <div class=\"row\">";                                            



                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\">";

                                                

                                            $returnHTML .= $this->sidebarHTML();   



                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\" height:100% !important; border:0px solid red !important;\">

                                                

                                                <div class=\"col-md-12\">

                                                    <h4 class=\"mb-10 fontdescription_two\"><strong>". $bodyPages[30][0]."</strong></h4>

                                                </diV>

                                                



                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                    <div class=\"col-md-4\" style=\"padding-top:5px; padding-left:5px; padding-right:5px;\">

                                                        $pageImg

                                                    </diV>

                                                    <div class=\"about-area col-md-8\" style=\"padding-left:0px !important; padding-right:20px; padding-top:0px; padding-bottom:0px ;\"> 

                                                    

                                                        <div class=\"about-content\">                                                            

                                                            <p class=\"txtJustfy\">".nl2br(trim(stripslashes($onePageRow->short_description)))."</p>
                                                            <p class=\"txtJustfy\">".nl2br(trim(stripslashes($onePageRow->description)))."</p>

                                                            <ul style=\"margin-top:20px !important;\" class=\"list flex\">";

                                                                $metaUrl = $this->db->seoInfo('navUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }                    

                                                                $returnHTML .= '

                                                            </ul>                                                           

                                                        </div>

                                                        

                                                    </div>

                                                    

                                                </div>

                                            <!-- FAQ part starts here -->
                                                <section class="mt-3">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lx-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row justify-content-center mt-2">
                                                                            <div class="col-xl-5 col-lg-8">
                                                                                <div class="text-center">
                                                                                    <h4>Frequently Asked Questions?</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row justify-content-center mt-4">
                                                                            <div class="col-9">
                                                                                <ul class="nav nav-tabs  nav-tabs-custom nav-justified justify-content-center faq-tab-box" id="pills-tab" role="tablist">
                                                                                    <li class="nav-item" role="presentation">
                                                                                        <button class="nav-link active" id="pills-genarel-tab" data-bs-toggle="pill" data-bs-target="#pills-genarel" type="button" role="tab" aria-controls="pills-genarel" aria-selected="true">
                                                                                            <span style="font-size:16px;">General Questions</span>
                                                                                        </button>
                                                                                    </li>
                                                                                    <li class="nav-item" role="presentation">
                                                                                        <button class="nav-link" id="pills-privacy_policy-tab" data-bs-toggle="pill" data-bs-target="#pills-privacy_policy" type="button" role="tab" aria-controls="pills-privacy_policy" aria-selected="false">
                                                                                            <span style="font-size:16px;">Advance Questions</span>
                                                                                        </button>
                                                                                    </li>
                                                                                    <li class="nav-item" role="presentation">
                                                                                        <button class="nav-link" id="pills-teachers-tab" data-bs-toggle="pill" data-bs-target="#pills-pricing_plan" type="button" role="tab" aria-controls="pills-pricing_plan" aria-selected="false">
                                                                                            
                                                                                            <span style="font-size:16px;">Help Resource</span>
                                                                                        </button>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="col-lg-11">
                                                                                <div class="tab-content pt-3" id="pills-tabContent">
                                                                                    <div class="tab-pane fade active show" id="pills-genarel" role="tabpanel" aria-labelledby="pills-genarel-tab">
                                                                                        <div class="row g-4 mt-2">
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Do I Need Covered Health Insurance?</h5>
                                                                                            <p class="text-muted py-1" style="font-size:14px; text-align: justify;">Yes, if you are a foreign visitor, you will need to have private health insurance during your stay in Canada. 
                                                                                            Canada’s free health care system is not available for visitors from other countries so you will need minimum coverage during your visitation. 
                                                                                            If you are a recent immigrant, you will still need visitors to Canada insurance until you are eligible to receive public health insurance in your province. 
                                                                                        </p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Do I Need To Know English Or French?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;">  Yes, most applicants intending to immigrate to Canada must have proof of language ability in either English or French. 
                                                                                                If you are immigrating from an English-speaking country, you are still required to show proof or complete a language proficiency test like the IELTS (English) or TEF (French) Language Test.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>How Much Money Will I Need?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The amount of money you will need depends on the immigration program you apply for,
                                                                                                the intended period of visitation, and the number of dependents. Generally speaking, if you are single and are applying for permanent residency under the express entry program,
                                                                                                you will need a minimum savings of around $13,000 in Canadian dollars to cover costs of settlement, visa and other legal document processing fees, and basic necessities.
                                                                                                </p>
                                                                                        
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>How Much Time Will It Take To Process The Visa?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The time it takes for Visa processing varies depending on the candidate, 
                                                                                                country, program, and case. Generally, the expected wait time is between 8 to 32 weeks (2 to 8 months) but can be longer. 
                                                                                                We advise you to contact us if you are not sure or check the estimated processing time for each application type provided by the Government of Canada.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                        
                                                                                    <div class="tab-pane fade" id="pills-privacy_policy" role="tabpanel" aria-labelledby="pills-privacy_policy-tab">
                                                                                        <div class="row g-4 mt-2">
                                                                                            <div class="col-lg-6">
                                                                                                <h5>How does Canadian immigration system work?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The Canadian immigration system operates through different programs,
                                                                                                such as Express Entry, Provincial Nominee Programs (PNPs), Family Sponsorship, and more. Each program has its own eligibility criteria, requirements,
                                                                                                and application process. Applicants are assessed based on factors like education, work experience, language proficiency, and adaptability.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Can I apply for Canadian citizenship immediately after arriving in Canada?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> No, you cannot apply for citizenship immediately. 
                                                                                                You must first become a permanent resident, fulfill the residency requirement, 
                                                                                                and then apply for Canadian citizenship after a certain period of time (usually three to five years).</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Can I bring my family with me when I immigrate to Canada?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Yes, you can include your immediate family members (spouse or common-law partner, dependent children) in your immigration application. 
                                                                                                There are also separate sponsorship programs available for sponsoring other family members, such as parents and grandparents.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                            <h5>Are there any age restrictions for Canadian immigration?<h5>
                                                                                            <p class="text-muted py-1" style="font-size:14px; text-align: justify; font-weight:normal; line-height:1.42;"> While there are no specific age restrictions for most immigration programs,
                                                                                             certain programs may have age limits or specific requirements for different age groups. 
                                                                                             It is important to review the eligibility criteria for each program to understand any age-related considerations.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="pills-pricing_plan" role="tabpanel">
                                                                                        <div class="row g-4 mt-2">
                                                                                            <div class="col-lg-6">
                                                                                                <h5>What is the Canadian immigration system?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> The Canadian immigration system refers to the policies, programs, 
                                                                                                and processes established by the Canadian government to regulate the entry and settlement of immigrants in Canada. 
                                                                                                It includes various pathways and programs through which individuals can apply for temporary or permanent residency in Canada.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Can I apply for multiple immigration programs simultaneously?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;">Yes, you can submit applications for multiple immigration programs simultaneously, 
                                                                                                such as Express Entry and Provincial Nominee Programs, if you meet the eligibility requirements. This can increase your chances of obtaining permanent residency in Canada.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>Are there any language requirements for Canadian immigration?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Proficiency in English or French is generally required for most immigration programs.
                                                                                                Applicants may need to provide language test results, such as IELTS or CELPIP, to demonstrate their language abilities. The level of language proficiency required may vary depending on the program.</p>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <h5>What are Provincial Nominee Programs(PNPs)?</h5>
                                                                                                <p class="text-muted py-1" style="font-size:14px; text-align: justify;"> Provincial Nominee Programs are immigration programs through which Canadian provinces and territories nominate individuals 
                                                                                                who have the skills and qualifications needed in their specific region. Each province or territory has its own set of criteria and streams to select candidates for nomination.</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            
                                            <!-- FAQ part ends here -->   

                                            </div>                                





                                        </div>

                                    </div>';

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

        

		return $returnHTML;

    }


    public function ourTeam(){     

        $id = 26;

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 20=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }        

        if($id>0){            

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section class="background">

                <div class="container" style="border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                                $returnHTML .= "

                                    <div class=\"row\">";                                            



                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";

                                            

                                        $returnHTML .= $this->sidebarHTML();   



                                        $returnHTML .= "</div>  



                                        <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                            <div id=\"rs-team\" class=\"rs-team fullwidth-team pt-100 pb-70 col-md-12\"  style=\"border:0px solid red !important;\">

                                                <div class=\"container\">";
                                                        $returnHTML .="
                                                    <div class=\"row row col-md-12\">";                            

                                                        $customerObj = $this->db->getObj("SELECT uri_value, customers_id, name, address FROM customers WHERE customers_publish = 1 ORDER BY customers_id", array());

                                                        $pr = 0;

                                                        if($customerObj){

                                                            while($oneRow = $customerObj->fetch(PDO::FETCH_OBJ)){

                                                

                                                                $customers_id = $oneRow->customers_id;

                                                                $uri_value = $oneRow->uri_value;

                                                                $name = trim(stripslashes($oneRow->name));

                                                                $address = stripslashes($oneRow->address);

                                                                $filePath = "./assets/accounts/customer_$customers_id".'_';

                                                                $catPics = glob($filePath."*.jpg");

                                                                if(!$catPics){

                                                                    $catPics = glob($filePath."*.png");

                                                                }

                                                

                                                                $customerImgSrc = '/assets/images/missing-picture.jpg';                                            

                                                                if($catPics){

                                                                    foreach($catPics as $onePicture){

                                                                        $customerImgSrc = str_replace("./", '/', $onePicture);

                                                                    }

                                                                } 





                                                                if($pr%3==0){

                                                                $returnHTML .='
                                                                
                                                    </div>
                                                    
                                                    <div class="row">';

                                                                }

                                                                $pr++;



                                                                $returnHTML .= "

                                                                <div class=\"col-lg-4 col-md-4 rs-box-wraper\">

                                                                    <div class=\"col-lg-12 col-md-12 rs-box\">                                                
                                                                        
                                                                            <div class=\"team-item\">
                                                                                
                                                                                <div class=\"team-img\">

                                                                                    <img src=\"".$customerImgSrc."\" alt=\"".$name."\">

                                                                                    <div class=\"normal-text\">

                                                                                        <h4 class=\"team-name\"><a href=\"".$uri_value."\">".$name."</a></h4>

                                                                                        <span class=\"subtitle\">".$address."</span>

                                                                                    </div>

                                                                                </div>
                                                                                
                                                                                <div class=\"team-content\">

                                                                                    <div class=\"display-table\">

                                                                                        <div class=\"display-table-cell\">                                                        
                                                                                        
                                                                                            <div class=\"team-details\">

                                                                                                <h4 class=\"team-name\">

                                                                                                    <a href=\"".$uri_value."\">".$name."</a>

                                                                                                </h4>

                                                                                                <span class=\"postion\"><a class=\"menu-link\" href=\"".$uri_value."\">".$address."</a></span>

                                                                                            </div>
                                                                                        
                                                                                        </div>

                                                                                    </div>

                                                                                </div>
                                                                                
                                                                            </div>
                                                                        
                                                                    </div>

                                                                </div>";

                                                                

                                                            }

                                                        }  


                                                        $returnHTML .= '  
                                                    </div> 
                                                    
                                                </div>
                                                
                                            </div>

                                        </div>

                            </div>

                        </div>

                    </div>
                    
                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

           

		return $returnHTML;

    }


    public function teams(){


        $id = $GLOBALS['id'];

        if($id>0){

            $returnHTML = $this->headerHTML();



            $returnHTML .= '

            <section class="background">

                <div class="container">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">
                            ';

                                $returnHTML .= "

                                    <div class=\"row\">"; 

                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";

                                                

                                        $returnHTML .= $this->sidebarHTML();   



                                        $returnHTML .= "</div>  

                                        <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">";

                                                $tablePageObj = $this->db->getObj("SELECT * FROM customers WHERE customers_id  = $id", array());

                                                if($tablePageObj){

                                                

                                                    while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                                        $teamImgUrl = ''; 

                                                        $filePath = "./assets/accounts/customer_$id".'_';

                                                        $pics = glob($filePath."*.jpg");

                                                        if(!$pics){

                                                            $pics = glob($filePath."*.png");

                                                        }

                                                        if($pics){

                                                            foreach($pics as $onePicture){

                                                                $teamImgUrl = str_replace('./', '/', $onePicture);

                                                            }

                                                        }

                                                        if(!empty($teamImgUrl)){

                                                            $serviceImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$teamImgUrl\"  style=\"padding:20px;\">";

                                                        }

                                                        else{

                                                            $serviceImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\"  width=\"500\" height=\"500\" >";

                                                        } 



                                                        $returnHTML .= "<div class=\"card-content col-md-12\" style=\"padding:20px; border:0px solid red;\">

                                                            <div class=\"row about-details-box\" style=\"\">

                                                                <div class=\"col-md-8 order-md-2 team-details-content\">

                                                                    <div>
                                                                    <h4>".nl2br(trim(stripslashes($onePageRow->name)))."</h4>
                                                                    <p>&nbsp;</p>
                                                                    <p><span style='font-weight:bold;'>Designation: </span>".nl2br(trim(stripslashes($onePageRow->address)))."</p>
                                                                    <p>&nbsp;</p>
                                                                    <p><span style='font-weight:bold;'>Email: </span>".nl2br(trim(stripslashes($onePageRow->email)))."</p>
                                                                    <p>&nbsp;</p>
                                                                    <p><span style='font-weight:bold;'>Phone: </span>".nl2br(trim(stripslashes($onePageRow->phone)))."</p>
                                                                    <p>&nbsp;</p>
                                                                    <p><span style='font-weight:bold;'>About: </span></p>
                                                                    <p>&nbsp;</p>
                                                                    <p style=\"text-align:justify\">".nl2br(trim(stripslashes($onePageRow->description)))."</p>
                                                                    <button class=\"btn btn-outline-danger my-3 btn-sm\" onclick=\"history.back()\">Go Back</button>
                                                                    </div>

                                                                </div>

                                                                <div class=\"col-md-4 order-md-1\" style=\"vertical-align:top !important; border:0px solid red !important;\">

                                                                    $serviceImg

                                                                </div>                                        

                                                            </div>

                                                        </div>";

                                                    }

                                                }

                                                $returnHTML .= '   
                                        </div>        
                                
                                    </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

        

		return $returnHTML;

    }




    public function ourTeamOLD(){

       

        $id = 26;

        

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 20=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }

        

        if($id>0){

            

            $returnHTML = $this->headerHTML();



            $returnHTML .= '

            <section>



                <div class="container" style="min-width:80% !important; border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card card-style-one pl-2 mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';

                            

                            

                                    $returnHTML .= "

                                    <div class=\"row\">";                                            



                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\">";

                                            

                                        $returnHTML .= $this->sidebarHTML();   



                                        $returnHTML .= "</div>  



                                        <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                            <div id=\"rs-team\" class=\"rs-team fullwidth-team pt-100 pb-70\">

                                                <div class=\"container\">";

                                                $returnHTML .="<div class=\"row\">";

                            

                                                $customerObj = $this->db->getObj("SELECT customers_id, name, address FROM customers WHERE customers_publish = 1 ORDER BY customers_id", array());



                                                $pr = 0;

                                                if($customerObj){

                                                    while($oneRow = $customerObj->fetch(PDO::FETCH_OBJ)){

                                        

                                                        $customers_id = $oneRow->customers_id;

                                                        $name = trim(stripslashes($oneRow->name));

                                                        $address = stripslashes($oneRow->address);

                                                        $filePath = "./assets/accounts/customer_$customers_id".'_';

                                                        $catPics = glob($filePath."*.jpg");

                                                        if(!$catPics){

                                                            $catPics = glob($filePath."*.png");

                                                        }

                                        

                                                        $customerImgSrc = '/assets/images/missing-picture.jpg';                                            

                                                        if($catPics){

                                                            foreach($catPics as $onePicture){

                                                                $customerImgSrc = str_replace("./", '/', $onePicture);

                                                            }

                                                        } 





                                                        if($pr%2==0){

                                                        $returnHTML .="</div><div class=\"row\">";

                                                        }

                                                        $pr++;



                                                        $returnHTML .= "

                                                        <div class=\"col-lg-6 col-md-6 rs-box-wraper\">

                                                            <div class=\"col-lg-12 col-md-12 rs-box\">                                                

                                                                <div class=\"team-item\">

                                                                    <div class=\"team-img\">

                                                                        <img src=\"".$customerImgSrc."\" alt=\"".$name."\">

                                                                        <div class=\"normal-text\">

                                                                            <h4 class=\"team-name\">".$name."</h4>

                                                                            <span class=\"subtitle\">".$address."</span>

                                                                        </div>

                                                                    </div>

                                                                    <div class=\"team-content\">

                                                                        <div class=\"display-table\">

                                                                            <div class=\"display-table-cell\">                                                        

                                                                                <div class=\"team-details\">

                                                                                    <h4 class=\"team-name\">

                                                                                        <a href=\"speakers-single.html\">".$name."</a>

                                                                                    </h4>

                                                                                    <span class=\"postion\">".$address."</span>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>";

                                                        

                                                    }

                                                }  



                                                $returnHTML .='

                                                </div>

                                            </div>

                                        </div>



                            </div>

                            </div>                           

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

        

		return $returnHTML;

    }



    

    public function videosMain(){ 

        

        $returnHTML = $this->headerHTML();

        

        $returnHTML .='

        <section>

            <div class="container" style="min-width:80% !important; border:0px solid red;">                    

                <div class="row">

                    <div class="col-md-12" style="border:0px solid red;">



                        <div class="single-card card-style-one pl-2 mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';



                                $returnHTML .= "

                                <div class=\"card-content\">

                                    <div class=\"row\">";                                            



                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\">";

                                            

                                        $returnHTML .= $this->sidebarHTML();   



                                        $returnHTML .= "</div> "; 



                                        $returnHTML .= "<div class=\"row col-md-9\" style=\"border:0px solid red !important;\">"; 

                                        

                                                            $returnHTML .= '<!-- services Section -->

                                                            <section class="video-area" style="background-image: -webkit-linear-gradient( 90deg, rgba(233, 247, 242, 0.4) 0%, rgb(233, 247, 242) 100% ) !important; padding: 12px 0 12px; width:100%; border:0px solid red !important; position:relative !important;">

                                                                <div class="container">                                                                    

                                                                    <div class="section-title text-center">                                            

                                                                        <h2>Our Works Videos</h2>

                                                                    </div>

                                                                    <div class="video-wrapper">

                                                                        

                                                                        <div class="row">                                            

                                                                            <section class="col-md-12 video-section">

                                                                                <div class="container">

                                                                                    <div class="row" style="border:0px solid red !important;">';



                                                                                    $pr = 0;

                                                                                    $tablePageObj = $this->db->getObj("SELECT * FROM videos WHERE videos_publish = 1", array());

                                                                                    

                                                                                    if($tablePageObj){

                                                                                

                                                                                        while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){

                                                            

                                                                                            $pr++;

                                                                                            $videos_id = $onePageRow->videos_id;

                                                                                            $name = nl2br(trim(stripslashes($onePageRow->name)));

                                                                                            $video = trim(stripslashes($onePageRow->youtube_url));



                                                                                            $videoImgUrl = ''; 

                                                                                            $filePath = "./assets/accounts/video_$videos_id".'_';

                                                                                            $pics = glob($filePath."*.jpg");

                                                                                            if(!$pics){

                                                                                                $pics = glob($filePath."*.png");

                                                                                            }

                                                                                            if($pics){

                                                                                                foreach($pics as $onePicture){

                                                                                                    $videoImgUrl = str_replace('./', '/', $onePicture);

                                                                                                }

                                                                                            }                                                                                    

                                                        

                                                                                            $returnHTML .='                                                                           

                                                                                                                                                                

                                                                                                <div class="col-md-4 text-center" style="border:0px solid red; margin:0 auto;">

                                                                                                    <div class="video-box" style="height: 300px; background-image: url('.$videoImgUrl.'); background-repeat: no-repeat; background-position: center; background-size: cover;">

                                                                                                        <div class="video-btn">

                                                                                                            <a target="_blank" href="'.$video.'" class="show-effect"><span class="fa-sharp fa-solid fa-play"></span></a>

                                                                                                        </div>

                                                                                                    </div> 

                                                                                                    <span style="font-family:Rubik !important; font-style: normal; font-display: swap;" class="mb-10 mt-50">'.$name.'</span>                                                                       

                                                                                                </div>

                                                                                            ';                                                    

                                                                                

                                                                                        }

                                                            

                                                                                    }  

                                                    

                                                                    $returnHTML .= '</div>

                                                                </div>

                                                            </section>

                                                        </div>

                                    </div>

                                </div>

                            

                        </div>

                    </div>

                </div>';                    

                $returnHTML .= '

            </div>

        </section><br><br>';

        $returnHTML .= $this->footerHTML();

        

        

		return $returnHTML;

    }





    public function galleryMain(){ 

        

        $returnHTML = $this->headerHTML();

        

        $returnHTML .='

        <section>

            <div class="container" style="min-width:80% !important; border:0px solid red;">                    

                <div class="row">

                    <div class="col-md-12" style="border:0px solid red;">



                        <div class="single-card card-style-one pl-2 mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';



                                $returnHTML .= "

                                <div class=\"card-content\">

                                    <div class=\"row\">";                                            



                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\">";

                                            

                                        $returnHTML .= $this->sidebarHTML();   



                                        $returnHTML .= "</div> "; 



                                        $returnHTML .= "<div class=\"row col-md-9\" style=\"border:0px solid red !important;\">"; 

                                        

                                                            $returnHTML .= '

                                                            <!-- services Section -->

                                                            <section class="gallery-area section" style="padding-top:12px !important; background-image: -webkit-linear-gradient( 90deg, rgba(233, 247, 242, 0.4) 0%, rgb(233, 247, 242) 100% ) !important; padding: 2px 0 2px; width:100%; border:0px solid red !important; position:relative !important;">

                                                                <div class="container">



                                                                    <div class="section-title text-center">                                            

                                                                        <h2>Our Service Photo Gallery</h2>

                                                                    </div>';

                                                                    

                                                                        $gallerySql = "SELECT photo_gallery_id, name FROM photo_gallery WHERE photo_gallery_publish = 1 LIMIT 0, 6";

                                                                        $galleryObj = $this->db->getObj($gallerySql, array());

                                                                        if($galleryObj){ 

                                                                            $returnHTML .='

                                                                            <div class="row">                                            

                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                                                <div class="gallery-nav text-center">

                                                                                    <!--div class="row" style="border:0px solid red !important; margin:0 auto;"-->

                                                                                    <ul class="list-inline">

                                                                                        <li class="filter" data-filter="all">All</li>';

                                                                                                           

                                                                                        $picturesStr = '';                                        

                                                    

                                                                                        $returnHTML .= '';               

                                                                                        while($oneGalleryRow = $galleryObj->fetch(PDO::FETCH_OBJ)){

                                                                                            $photo_gallery_id = $oneGalleryRow->photo_gallery_id;

                                                                                            $name = stripslashes(trim((string) $oneGalleryRow->name));

                                                                                            $returnHTML .= '<li class="filter" data-filter=".id_'.$photo_gallery_id.'">'.$name.'</li>';                                                   

                                                                                        

                                                                                            $filePath = "./assets/accounts/photo_$photo_gallery_id".'_';

                                                                                            $pics = glob($filePath."*.jpg");

                                                                                            if(empty($pics) || !$pics){

                                                                                                $pics = glob($filePath."*.png");

                                                                                            }                            

                                                                                            if($pics){

                                                                                                // var_dump($pics);exit;

                                                                                                foreach($pics as $onePicture){

                                                                                                    $prodImg = str_replace("./assets/accounts/", '', $onePicture);

                                                                                                    $photo_galleryImgUrl = str_replace('./', '/', $onePicture);

                                                                                                    

                                                                                                    $picturesStr .= '<div class="col-lg-3 col-md-6 col-xs-12 col-sm-12 mix id_'.$photo_gallery_id.'">

                                                                                                        <div class="gallery">

                                                                                                            <figure><a href="'.$photo_galleryImgUrl.'">

                                                                                                                <img alt="'.strip_tags(addslashes($name)).'" src="'.$photo_galleryImgUrl.'">

                                                                                                            <span></span>

                                                                                                        </a></figure>

                                                                                                        </div>

                                                                                                    </div>';

                                                                                                        

                                                                                                }

                                                                                            }

                                                                                        }

                                                                                        $returnHTML .= '</ul>

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                        <div class="row" id="Container">'.$picturesStr.'</div>';                                                                                                                                                



                                                                                    $returnHTML .= '

                                                                                    </ul>

                                                                                    <!--/div-->

                                                                                </div>

                                                                            </div>

                                                                        </div>';

                                                                    }

                                                                    

                                                                    $returnHTML .='</div>

                                                            </section>

                            

                                                        </div>

                                    </div>

                                </div>';                    

                                $returnHTML .= '

                        </div>

                    </div>

                </div>

            </div>

        </section><br><br>';

        $returnHTML .= $this->footerHTML();        

        

		return $returnHTML;

    }

    



    public function immigrationServicesOLD(){ 

        

        $returnHTML = $this->headerHTML();



        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 32=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }

        

        $returnHTML .='

        <section class="service-area-main">

            <div class="container" style="border:0px solid red;">                    

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card-pages card-style-one mt-4 mb-3">';



                        $returnHTML .= "

                        <div class=\"card-content\">

                            <div class=\"row\">";                                            



                                $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";

                                    

                                $returnHTML .= $this->sidebarHTML();   



                                $returnHTML .= "</div>  



                                <div class=\"row col-md-9\" style=\"padding-left:25px !important;border:0px solid red !important;\">";



                                $returnHTML .='<section id="what-we-do">

                                    <div class="container-fluid">

                                        <div class="section-title text-center">                                            

                                            <h2 class="page-title">'.$bodyPages[32][0].'</h2>

                                        </div>

                                        <!--p class="text-center text-muted h5">'.$bodyPages[32][1].'</p-->

                                        <div class="row">';



                                        $tableObj = $this->db->getObj("SELECT name, font_awesome, uri_value, short_description FROM services WHERE services_publish =1 AND service_type =1 ORDER BY RAND()", array());

                                        if($tableObj){

                                            $pr = 0;

                                            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                $name = trim(stripslashes($oneRow->name));

                                                $font_awesome = trim(stripslashes($oneRow->font_awesome));

                                                $uri_value = trim(stripslashes($oneRow->uri_value));

                                                $short_description = trim(stripslashes($oneRow->short_description));

                                                $short_description_set = implode(' ', array_slice(str_word_count($short_description,1), 0, 14));





                                                if($pr %2 == 0){

                                                    $returnHTML .='</div><div class="row">';

                                                }

                                                $pr++;

                                                

                                                $returnHTML .='

                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                                                    <div class="card col">

                                                        <div class="card-block '.$font_awesome.'">

                                                            <h3 class="card-title">'.$name.'</h3>

                                                            <p class="card-text mb-1">'.$short_description_set.'</p>
                                                            
                                                            <a href="/services/'.$uri_value.'.html" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>

                                                        </div>

                                                    </div>

                                                </div>';



                                            }

                                        }



                                        $returnHTML .='</div>

                                    </div>	

                                </section>';



                                

                               

                        $returnHTML .= '

                        </div>

                    </div>

                </div>';                    

                $returnHTML .= '

            </div>

        </section>';

        $returnHTML .= $this->footerHTML();

        

        

		return $returnHTML;

    }


    public function immigrationServices(){ 

        

        $returnHTML = $this->headerHTML();



        $segment3URI = $GLOBALS['segment3URI'];
        $segment2URI = $GLOBALS['segment2URI'];
        // echo $segment2URI;exit;

        if(!empty($segment3URI)){

            // echo $segment3URI;exit;  services_id AS id, name, 'services' AS tableName

            $tableObj = $this->db->getObj("SELECT *  FROM services WHERE uri_value = :uri_value", array('uri_value'=>$segment3URI));
            
            // $tableObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());

            $id = 0;

            if($tableObj){
    
                while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
                    $id = $oneRow->services_id;
                    // $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));
    
                }
    
            }      
    
            if($id>0){     
                
                $tablePageObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());
    
                if($tablePageObj){                            

                    while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){

                        $page_id = $onePageRow->page_id;

                        $bredc_name = trim(stripslashes($onePageRow->name));
                    }
                }
       
                $returnHTML .= '
    
                <section class="background">
    
                    <div class="container" style="border:0px solid red;">                    
    
                        <div class="row">
    
                            <div class="col-md-12 abt_body" style="border:0px solid red;">
    
                                <div class="single-card card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
                                ';                    
    
                                $tablePageObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());
    
                                if($tablePageObj){                            
    
                                    while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){
    
    
    
                                        $page_id = $onePageRow->page_id;
    
                                        $name = trim(stripslashes($onePageRow->name));
    
                                        $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));
    
                                        $uri_value = trim(stripslashes($onePageRow->uri_value));
    
    
    
                                        $pageImgUrl = ''; 
    
                                        $filePath = "./assets/accounts/serv_$id".'_';
                                    
    
                                        $pics = glob($filePath."*.jpg");
    
                                        if(!$pics){
    
                                            $pics = glob($filePath."*.png");
    
                                        }
    
                                        if($pics){
    
                                            foreach($pics as $onePicture){
    
                                                $pageImgUrl = str_replace('./', '/', $onePicture);
    
                                            }
    
                                        }
    
                                        if(!empty($pageImgUrl)){
    
                                            $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";
    
                                        }
    
                                        else{
    
                                            $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";
    
                                        } 
                                    
    
                                        $returnHTML .= "
    
                                        <div class=\"card-content\" style=\"border:0px solid red;\">
    
                                            <div class=\"row\" style=\"border:0px solid red;\">"; 
    
                                                $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                
    
                                                $returnHTML .= $this->sidebarHTML(); 
    
                                                $returnHTML .= "</div>  
    
    
    
                                                <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">
    
                                                    <div class=\"row\" style=\"margin-top:20px;\">
    
                                                            <div class=\"wrap_text about-area\">
                                                                <div class=\"floated\">
                                                                $pageImg
                                                                </div>
                                                                <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                                // nl2br(trim(stripslashes($onePageRow->short_description))).
                                                                nl2br(trim(stripslashes($onePageRow->description)))."
                                                                
                                                            </div>                                                      
    
                                                    </div>                                               
    
                                                </div>                                
    
    
    
    
    
                                            </div>
    
                                        </div>";
    
                                    }
    
                                }
    
                                $returnHTML .= '                            
    
                                </div>
    
    
    
                            </div>
    
                        </div>';                    
    
                        $returnHTML .= '
    
                    </div>
    
                </section>';
    
    
            }
    
            else {
    
                $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());
    
                $uri_value = $tableObj->uri_value;
    
                $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";
    
            }
    
            

        } else {

                    $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 32=>array());

                    $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

                    if($tableObj){

                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                            $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

                        }

                    }

        

                    $returnHTML .='

                    <section class="service-area-main">

                        <div class="container" style="border:0px solid red;">                    

                            <div class="row">

                                <div class="col-md-12 abt_body" style="border:0px solid red;">

                                    <div class="single-card-pages card-style-one mb-3">
                                    ';



                                    $returnHTML .= "

                                    <div class=\"card-content\">

                                        <div class=\"row\">";                                            



                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";

                                                

                                            $returnHTML .= $this->sidebarHTML();   



                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"padding-left:25px !important;border:0px solid red !important;\">";



                                            $returnHTML .='<section id="what-we-do">

                                                <div class="container-fluid">

                                                    <div class="section-title text-center">                                            

                                                        <h2 class="page-title">'.$bodyPages[32][0].'</h2>

                                                    </div>

                                                    <!--p class="text-center text-muted h5">'.$bodyPages[32][1].'</p-->

                                                    <div class="row">';



                                                    $tableObj = $this->db->getObj("SELECT name, font_awesome, uri_value, short_description FROM services WHERE services_publish =1 AND service_type =1 ORDER BY RAND()", array());

                                                    if($tableObj){

                                                        $pr = 0;

                                                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                            $name = trim(stripslashes($oneRow->name));

                                                            $font_awesome = trim(stripslashes($oneRow->font_awesome));

                                                            $uri_value = trim(stripslashes($oneRow->uri_value));

                                                            $short_description = trim(stripslashes($oneRow->short_description));

                                                            $short_description_set = implode(' ', array_slice(str_word_count($short_description,1), 0, 14));





                                                            if($pr %2 == 0){

                                                                $returnHTML .='</div><div class="row">';

                                                            }

                                                            $pr++;

                                                            

                                                            $returnHTML .='

                                                            <!--div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                                                                <div class="card col">

                                                                    <div class="card-block '.$font_awesome.'">

                                                                        <img src="/website_assets/images/services_icon/'.$uri_value.'.png">
                                                                        <h3 class="card-title">'.$name.'</h3>

                                                                        <p class="card-text mb-1">'.$short_description_set.'</p>
                                                                        
                                                                        <a href="/immigration-services/'.$uri_value.'.html" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>

                                                                    </div>

                                                                </div>

                                                            </div-->

                                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                                <div class="card col">

                                                                    <div class="card-block">
                                                                    <img src="/website_assets/images/services_icon/'.$uri_value.'.png" width="60px" class="mb-3">
            
                                                                        <h2 style="font-weight:900;" class="card-title">'.$name.'</h2>
            
                                                                        <p class="card-text mb-1">'.$short_description_set.'</p>
                                                                        
                                                                        <a href="/immigration-services/'.$uri_value.'.html" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
            
                                                                    </div>
            
                                                                </div>
                                                            </div>';

                                                        }

                                                    }



                                                    $returnHTML .='</div>

                                                </div>	

                                            </section>';



                                            

                                        

                                    $returnHTML .= '

                                    </div>

                                </div>

                            </div>';                    

                            $returnHTML .= '

                        </div>

                    </section>';

        }


        $returnHTML .= $this->footerHTML();
           

		return $returnHTML;

    }




    public function legalServices(){ 
        

        $returnHTML = $this->headerHTML();


        $segment3URI = $GLOBALS['segment3URI'];
        // echo $segment3URI;exit;

        if(!empty($segment3URI)){

            // echo $segment3URI;exit;  services_id AS id, name, 'services' AS tableName

            $tableObj = $this->db->getObj("SELECT *  FROM services WHERE uri_value = :uri_value", array('uri_value'=>$segment3URI));
            
            // $tableObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());

            $id = 0;

            if($tableObj){
    
                while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
                    $id = $oneRow->services_id;
                    // $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));
    
                }
    
            }      
    
            if($id>0){ 
                
                $tablePageObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());
    
                if($tablePageObj){                            

                    while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){

                        $page_id = $onePageRow->page_id;

                        $bredc_name = trim(stripslashes($onePageRow->name));
                    }
                }

    
                $returnHTML .= '
    
                <section class="background">
    
                    <div class="container" style="border:0px solid red;">                    
    
                        <div class="row">
    
                            <div class="col-md-12 abt_body" style="border:0px solid red;">
    
                                <div class="single-card card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
                                ';                    
    
                                $tablePageObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());
    
                                if($tablePageObj){                            
    
                                    while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){
    
    
    
                                        $page_id = $onePageRow->page_id;
    
                                        $name = trim(stripslashes($onePageRow->name));
    
                                        $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));
    
                                        $uri_value = trim(stripslashes($onePageRow->uri_value));
    
    
    
                                        $pageImgUrl = ''; 
    
                                        $filePath = "./assets/accounts/serv_$id".'_';
                                    
    
                                        $pics = glob($filePath."*.jpg");
    
                                        if(!$pics){
    
                                            $pics = glob($filePath."*.png");
    
                                        }
    
                                        if($pics){
    
                                            foreach($pics as $onePicture){
    
                                                $pageImgUrl = str_replace('./', '/', $onePicture);
    
                                            }
    
                                        }
    
                                        if(!empty($pageImgUrl)){
    
                                            $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";
    
                                        }
    
                                        else{
    
                                            $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";
    
                                        } 
                                    
    
                                        $returnHTML .= "
    
                                        <div class=\"card-content\" style=\"border:0px solid red;\">
    
                                            <div class=\"row\" style=\"border:0px solid red;\">"; 
    
                                                $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                
    
                                                $returnHTML .= $this->sidebarHTML(); 
    
                                                $returnHTML .= "</div>  
    
    
    
                                                <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">
    
                                                    <div class=\"row\" style=\"margin-top:20px;\">
    
                                                            <div class=\"wrap_text about-area\">
                                                                <div class=\"floated\">
                                                                $pageImg
                                                                </div>
                                                                <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                                // nl2br(trim(stripslashes($onePageRow->short_description))).
                                                                nl2br(trim(stripslashes($onePageRow->description)))."
                                                                
                                                            </div>                                                      
    
                                                    </div>                                               
    
                                                </div>                                
    
    
    
    
    
                                            </div>
    
                                        </div>";
    
                                    }
    
                                }
    
                                $returnHTML .= '                            
    
                                </div>
    
    
    
                            </div>
    
                        </div>';                    
    
                        $returnHTML .= '
    
                    </div>
    
                </section>';

    
            }
    
            else {
    
                $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());
    
                $uri_value = $tableObj->uri_value;
    
                $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";
    
            }
    
            

        } else {

                    $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 29=>array(), 32=>array());

                    $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

                    if($tableObj){

                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                            $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

                        }

                    }
        

                    $returnHTML .='

                    <section class="service-area-main">

                        <div class="container" style="border:0px solid red;">                    

                            <div class="row">

                                <div class="col-md-12 abt_body" style="border:0px solid red;">

                                    <div class="single-card-pages card-style-one mb-3">
                                    ';



                                    $returnHTML .= "

                                    <div class=\"card-content\">

                                        <div class=\"row\">";                                            



                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";

                                                

                                            $returnHTML .= $this->sidebarHTML();   



                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"padding-left:25px !important;border:0px solid red !important;\">";



                                            $returnHTML .='<section id="what-we-do">

                                                <div class="container-fluid">

                                                    <div class="section-title text-center">                                            

                                                        <h2 class="page-title">'.$bodyPages[29][0].'</h2>

                                                    </div>

                                                    <!--p class="text-center text-muted h5">'.$bodyPages[29][1].'</p-->

                                                    <div class="row">';



                                                    $tableObj = $this->db->getObj("SELECT name, font_awesome, uri_value, short_description FROM services WHERE services_publish =1 AND service_type =2 ORDER BY RAND()", array());

                                                    if($tableObj){

                                                        $pr = 0;

                                                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                            $name = trim(stripslashes($oneRow->name));

                                                            $font_awesome = trim(stripslashes($oneRow->font_awesome));

                                                            $uri_value = trim(stripslashes($oneRow->uri_value));

                                                            $short_description = trim(stripslashes($oneRow->short_description));

                                                            $short_description_set = implode(' ', array_slice(str_word_count($short_description,1), 0, 14));





                                                            if($pr %2 == 0){

                                                                $returnHTML .='</div><div class="row">';

                                                            }

                                                            $pr++;

                                                            

                                                            $returnHTML .='
                                                            

                                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                                <div class="card col">

                                                                    <div class="card-block">
                                                                    <img src="/website_assets/images/services_icon/'.$uri_value.'.png" width="60px" class="mb-3">
            
                                                                        <h2 style="font-weight:900;" class="card-title">'.$name.'</h2>
            
                                                                        <p class="card-text mb-1">'.$short_description_set.'</p>
                                                                        
                                                                        <a href="/legal-services/'.$uri_value.'.html" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
            
                                                                    </div>
            
                                                                </div>
                                                            </div>';


                                                        }

                                                    }



                                                    $returnHTML .='</div>

                                                </div>	

                                            </section>';



                                            

                                        

                                    $returnHTML .= '

                                    </div>

                                </div>

                            </div>';                    

                            $returnHTML .= '

                        </div>

                    </section>';

        }            

        $returnHTML .= $this->footerHTML();
        

		return $returnHTML;

    }


    public function fingerprintServices(){ 
        

        $returnHTML = $this->headerHTML();


        $segment3URI = $GLOBALS['segment3URI'];
        // echo $segment3URI;exit;

        if(!empty($segment3URI)){

            // echo $segment3URI;exit;  services_id AS id, name, 'services' AS tableName

            $tableObj = $this->db->getObj("SELECT *  FROM services WHERE uri_value = :uri_value", array('uri_value'=>$segment3URI));
            
            // $tableObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());

            $id = 0;

            if($tableObj){
    
                while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
                    $id = $oneRow->services_id;
                    // $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));
    
                }
    
            }      
    
            if($id>0){

                $tablePageObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());
    
                if($tablePageObj){                            

                    while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){

                        $page_id = $onePageRow->page_id;

                        $bredc_name = trim(stripslashes($onePageRow->name));
                    }
                }
                
    
                $returnHTML .= '
    
                <section class="background">
    
                    <div class="container" style="border:0px solid red;">                    
    
                        <div class="row">
    
                            <div class="col-md-12 abt_body" style="border:0px solid red;">
    
                                <div class="single-card card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
                                ';                    
    
                                $tablePageObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());
    
                                if($tablePageObj){                            
    
                                    while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){
    
    
    
                                        $page_id = $onePageRow->page_id;
    
                                        $name = trim(stripslashes($onePageRow->name));
    
                                        $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));
    
                                        $uri_value = trim(stripslashes($onePageRow->uri_value));
    
    
    
                                        $pageImgUrl = ''; 
    
                                        $filePath = "./assets/accounts/serv_$id".'_';
                                    
    
                                        $pics = glob($filePath."*.jpg");
    
                                        if(!$pics){
    
                                            $pics = glob($filePath."*.png");
    
                                        }
    
                                        if($pics){
    
                                            foreach($pics as $onePicture){
    
                                                $pageImgUrl = str_replace('./', '/', $onePicture);
    
                                            }
    
                                        }
    
                                        if(!empty($pageImgUrl)){
    
                                            $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";
    
                                        }
    
                                        else{
    
                                            $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";
    
                                        } 
                                    
    
                                        $returnHTML .= "
    
                                        <div class=\"card-content\" style=\"border:0px solid red;\">
    
                                            <div class=\"row\" style=\"border:0px solid red;\">"; 
    
                                                $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                
    
                                                $returnHTML .= $this->sidebarHTML(); 
    
                                                $returnHTML .= "</div>  
    
    
    
                                                <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">
    
                                                    <div class=\"row\" style=\"margin-top:20px;\">
    
                                                            <div class=\"wrap_text about-area\">
                                                                <div class=\"floated\">
                                                                $pageImg
                                                                </div>
                                                                <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                                // nl2br(trim(stripslashes($onePageRow->short_description))).
                                                                nl2br(trim(stripslashes($onePageRow->description)))."
                                                                <!--ul style=\"margin-top:20px !important;margin-left:20px !important;\" class=\"list\">";
    
                                                                    $metaUrl = $this->db->seoInfo('immiUrl');
    
                                                                    foreach($metaUrl as $oneMetaUrl=>$label){
    
                                                                        $returnHTML .= "<li class=\"seo_link\"><a style=\"font-style: normal; font-weight: 300; font-display: swap;\" title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";
    
                                                                    }
                                                                    $returnHTML .= "
                                                                </ul-->
                                                            </div>                                                      
    
                                                    </div>                                               
    
                                                </div>                                
    
    
    
    
    
                                            </div>
    
                                        </div>";
    
                                    }
    
                                }
    
                                $returnHTML .= '                            
    
                                </div>
    
    
    
                            </div>
    
                        </div>';                    
    
                        $returnHTML .= '
    
                    </div>
    
                </section>';
    
            }
    
            else {
    
                $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());
    
                $uri_value = $tableObj->uri_value;
    
                $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";
    
            }
    
            

        } else {

            $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 29=>array(), 31=>array(), 32=>array());

            $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());
    
            if($tableObj){
    
                while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
    
                    $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));
    
                }
    
            }
            
    
            $returnHTML .='
    
                    <section class="service-area-main">
            
                        <div class="container" style="border:0px solid red;">                    
            
                            <div class="row">
            
                                <div class="col-md-12 abt_body" style="border:0px solid red;">
            
                                    <div class="single-card-pages card-style-one mb-3">
                                    ';
            
            
            
                                    $returnHTML .= "
            
                                    <div class=\"card-content\">
            
                                        <div class=\"row\">";                                            
            
            
            
                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";
            
                                                
            
                                            $returnHTML .= $this->sidebarHTML();   
            
            
            
                                            $returnHTML .= "</div>  
            
            
            
                                            <div class=\"row col-md-9\" style=\"padding-left:25px !important;border:0px solid red !important;\">";
            
            
            
                                            $returnHTML .='<section id="what-we-do">
            
                                                <div class="container-fluid">
            
                                                    <div class="section-title text-center">                                            
            
                                                        <h2 class="page-title">'.$bodyPages[31][0].'</h2>
            
                                                    </div>
            
                                                    <!--p class="text-center text-muted h5">'.$bodyPages[31][1].'</p-->
            
                                                    <div class="row">';
            
            
            
                                                    $tableObj = $this->db->getObj("SELECT name, font_awesome, uri_value, short_description FROM services WHERE services_publish =1 AND service_type =3 ORDER BY RAND()", array());
            
                                                    if($tableObj){
            
                                                        $pr = 0;
            
                                                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
            
                                                            $name = trim(stripslashes($oneRow->name));
            
                                                            $font_awesome = trim(stripslashes($oneRow->font_awesome));
            
                                                            $uri_value = trim(stripslashes($oneRow->uri_value));
            
                                                            $short_description = trim(stripslashes($oneRow->short_description));
            
                                                            $short_description_set = implode(' ', array_slice(str_word_count($short_description,1), 0, 14));
            
            
            
            
            
                                                            if($pr %2 == 0){
            
                                                                $returnHTML .='</div><div class="row">';
            
                                                            }
            
                                                            $pr++;
            
                                                            
            
                                                            $returnHTML .='
            
                                                            
                                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                                <div class="card col">

                                                                    <div class="card-block">
                                                                    <img src="/website_assets/images/services_icon/'.$uri_value.'.png" width="60px" class="mb-3">
            
                                                                        <h2 style="font-weight:900;" class="card-title">'.$name.'</h2>
            
                                                                        <p class="card-text mb-1">'.$short_description_set.'</p>
                                                                        
                                                                        <a href="/fingerprint-services/'.$uri_value.'.html" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
            
                                                                    </div>
            
                                                                </div>
                                                            </div>';
            
            
            
                                                        }
            
                                                    }
            
            
            
                                                    $returnHTML .='</div>
            
                                                </div>	
            
                                            </section>';
            
            
            
                                            
            
                                        
            
                                    $returnHTML .= '
            
                                    </div>
            
                                </div>
            
                            </div>';                    
            
                            $returnHTML .= '
            
                        </div>
            
                    </section>';

        }            

        $returnHTML .= $this->footerHTML();
        

		return $returnHTML;

    }


    public function fingerprintServicesOLD(){ 
        

        $returnHTML = $this->headerHTML();


        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 29=>array(), 31=>array(), 32=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }
        

        $returnHTML .='

        <section class="service-area-main">

            <div class="container" style="border:0px solid red;">                    

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card-pages card-style-one mt-4 mb-3">';



                        $returnHTML .= "

                        <div class=\"card-content\">

                            <div class=\"row\">";                                            



                                $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";

                                    

                                $returnHTML .= $this->sidebarHTML();   



                                $returnHTML .= "</div>  



                                <div class=\"row col-md-9\" style=\"padding-left:25px !important;border:0px solid red !important;\">";



                                $returnHTML .='<section id="what-we-do">

                                    <div class="container-fluid">

                                        <div class="section-title text-center">                                            

                                            <h2 class="page-title">'.$bodyPages[31][0].'</h2>

                                        </div>

                                        <!--p class="text-center text-muted h5">'.$bodyPages[31][1].'</p-->

                                        <div class="row">';



                                        $tableObj = $this->db->getObj("SELECT name, font_awesome, uri_value, short_description FROM services WHERE services_publish =1 AND service_type =3 ORDER BY RAND()", array());

                                        if($tableObj){

                                            $pr = 0;

                                            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                $name = trim(stripslashes($oneRow->name));

                                                $font_awesome = trim(stripslashes($oneRow->font_awesome));

                                                $uri_value = trim(stripslashes($oneRow->uri_value));

                                                $short_description = trim(stripslashes($oneRow->short_description));

                                                $short_description_set = implode(' ', array_slice(str_word_count($short_description,1), 0, 14));





                                                if($pr %2 == 0){

                                                    $returnHTML .='</div><div class="row">';

                                                }

                                                $pr++;

                                                

                                                $returnHTML .='

                                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                                                    <div class="card col">

                                                        <div class="card-block '.$font_awesome.'">

                                                            <h3 class="card-title">'.$name.'</h3>

                                                            <p class="card-text mb-1">'.$short_description_set.'</p>
                                                            
                                                            <a href="/'.$uri_value.'.html" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>

                                                        </div>

                                                    </div>

                                                </div>';



                                            }

                                        }



                                        $returnHTML .='</div>

                                    </div>	

                                </section>';



                                

                               

                        $returnHTML .= '

                        </div>

                    </div>

                </div>';                    

                $returnHTML .= '

            </div>

        </section>';

        $returnHTML .= $this->footerHTML();
        

		return $returnHTML;

    }


    // public function services(){

        

    //     $id = $GLOBALS['id'];

    //     // var_dump($id);exit;



    //     if($id>0){



    //         $returnHTML = $this->headerHTML();



    //         $returnHTML .= '

    //         <section>

    //             <div class="container">                    

    //                 <div class="row">

    //                     <div class="col-md-12">

    //                     <div class="single-card card-style-one mt-30 mb-30">';

                    

    //                         $tablePageObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());

    //                         if($tablePageObj){

                            

    //                             while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



    //                                 $serviceImgUrl = ''; 

    //                                 $filePath = "./assets/accounts/serv_$id".'_';

    //                                 $pics = glob($filePath."*.jpg");

    //                                 if(!$pics){

    //                                     $pics = glob($filePath."*.png");

    //                                 }

    //                                 if($pics){

    //                                     foreach($pics as $onePicture){

    //                                         $serviceImgUrl = str_replace('./', '/', $onePicture);

    //                                     }

    //                                 }

    //                                 if(!empty($serviceImgUrl)){

    //                                     $serviceImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$serviceImgUrl\"  width=\"500\" height=\"500\" style=\"height:500px !important;\">";

    //                                 }

    //                                 else{

    //                                     $serviceImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\"  width=\"500\" height=\"500\" >";

    //                                 } 



                                   

    //                                 $returnHTML .="

    //                                 <div class=\"card-content\">

    //                                 <div class=\"row featurette\" >

    //                                     <div class=\"col-md-7 order-md-2\">

    //                                         <h2 class=\"card-title featurette-heading-new lh-1\">$onePageRow->name </h2>

    //                                         <br>

    //                                         <p class=\"text lead\">$onePageRow->description</p>

                                            

    //                                         <button style=\"margin-top:15px;margin-bottom:5px;\" class=\"btn btn-sm btn-outline-danger my-3\" onclick=\"history.back()\">Go Back</button>

                                            

    //                                     </div>

    //                                     <div class=\"card-image col-md-5 order-md-1\">

    //                                         $serviceImg

    //                                     </div>

    //                                 </div>

    //                                 </div>";    



                                

    //                             }

    //                         }

    //                         $returnHTML .= '

    //                         </div>

    //                     </div>

    //                 </div>';                    

    //                 $returnHTML .= '

    //             </div>

    //         </section>';

    //         $returnHTML .= $this->footerHTML();

    //     }

    //     else{

    //         $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

    //         $uri_value = $tableObj->uri_value;

    //         $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

    //     }

        

	// 	return $returnHTML;

    // }

    public function services(){     

        $id = $GLOBALS['id'];
        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());

        // $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());

        //  $tableObj = $this->db->getObj("SELECT services_id, name, short_description, uri_value FROM services WHERE services_id IN (".implode(', ', array_keys($bodyPages)).") AND services_publish =1", array());

        $tableObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));

            }

        }      

        if($id>0){            

            $returnHTML = $this->headerHTML();

            $returnHTML .= '

            <section>

                <div class="container" style="border:0px solid red;">                    

                    <div class="row">

                        <div class="col-md-12 abt_body" style="border:0px solid red;">

                            <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $tablePageObj = $this->db->getObj("SELECT * FROM services WHERE services_id = $id", array());

                            if($tablePageObj){                            

                                while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){



                                    $page_id = $onePageRow->page_id;

                                    $name = trim(stripslashes($onePageRow->name));

                                    $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));

                                    $uri_value = trim(stripslashes($onePageRow->uri_value));



                                    $pageImgUrl = ''; 

                                    $filePath = "./assets/accounts/serv_$id".'_';
                                

                                    $pics = glob($filePath."*.jpg");

                                    if(!$pics){

                                        $pics = glob($filePath."*.png");

                                    }

                                    if($pics){

                                        foreach($pics as $onePicture){

                                            $pageImgUrl = str_replace('./', '/', $onePicture);

                                        }

                                    }

                                    if(!empty($pageImgUrl)){

                                        $pageImg = "<img style=\"border-radius: 20px; margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";

                                    }

                                    else{

                                        $pageImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";

                                    } 
                                

                                    $returnHTML .= "

                                    <div class=\"card-content\" style=\"border:0px solid red;\">

                                        <div class=\"row\" style=\"border:0px solid red;\">"; 

                                            $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";                                                

                                            $returnHTML .= $this->sidebarHTML(); 

                                            $returnHTML .= "</div>  



                                            <div class=\"row col-md-9\" style=\"border:0px solid red !important;\">

                                                <div class=\"row\" style=\"margin-top:20px;\">

                                                        <div class=\"wrap_text about-area\">
                                                            <div class=\"floated\">
                                                            $pageImg
                                                            </div>
                                                            <h3 style=\"text-transform: uppercase;\" class=\"section-title mb-20 wrap_title\">$name</h3> ".
                                                            // nl2br(trim(stripslashes($onePageRow->short_description))).
                                                            nl2br(trim(stripslashes($onePageRow->description)))."
                                                            <!--ul style=\"margin-top:20px !important;margin-left:20px !important;\" class=\"list\">";

                                                                $metaUrl = $this->db->seoInfo('immiUrl');

                                                                foreach($metaUrl as $oneMetaUrl=>$label){

                                                                    $returnHTML .= "<li class=\"seo_link\"><a style=\"font-style: normal; font-weight: 300; font-display: swap;\" title=\"$label\" href=\"/$oneMetaUrl\">$label</a></li>";

                                                                }
                                                                $returnHTML .= "
                                                            </ul-->
                                                        </div>                                                  
                                                    

                                                    

                                                    <!--div class=\"row col-md-12 eq_row\" style=\"border:0px solid red;\">                                                               

                                                        <div class=\"flex-box\">

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR MISSION</h3>

                                                                <p> Responsible for the future immigration dreams of our clients, our mission is to provide practical solutions and legal support to anyone wanting to come to Canada.

                                                                </p> 

                                                            </div>

                                                            <div class=\"box member\">

                                                                <i class=\"fa fa-award\"></i>

                                                                <h3>OUR COMMITMENT</h3>

                                                                <p> We work with our clients to obtain their Visa to Canada. We will communicate the status of their application and help solve their problems so their case is a success.

                                                                </p> 

                                                                

                                                            </div>                                                                

                                                        </div>

                                                    </div-->


                                                </div>                                               

                                            </div>                                





                                        </div>

                                    </div>";

                                }

                            }

                            $returnHTML .= '                            

                            </div>



                        </div>

                    </div>';                    

                    $returnHTML .= '

                </div>

            </section>';

            $returnHTML .= $this->footerHTML();

        }

        else{

            $tableObj = $this->db->getObj("SELECT uri_value FROM pages WHERE pages_id = 1", array());

            $uri_value = $tableObj->uri_value;

            $returnHTML = "<meta http-equiv = \"refresh\" content = \"0; url = '/$uri_value.html'\" />";

        }

           

		return $returnHTML;

    }
    

    public function immigrationAssessment(){

        

        // var_dump('test');exit;

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }



        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="contact-form-section background" >

            <div class="container">

                <div class="pageTransBody">



                    <div class="row mt-5 " style="max-width:1140px;margin:0 auto; border:0px solid red; margin-top:0px !important;">

                        <div class="col-sm-12 u-section-1"> 


                            <!--Contact Form-->

                            

                            <!-- Sec Title -->

                            <br>

                            <div class="col-sm-12 u-list-1" style="border:0px solid red; margin-top:5px !important;padding-top:5px !important;" >

                                <div class="" style="border:0px solid red;" >

                                    <div style="border:0px solid red;">



                            <div class="col-md-12 text-center">

                                <!--h4>REQUEST YOUR CONSULTATION <br>GET YOUR FREE ASSESSMENT TODAY!</h4-->

                                <h2 class="mb-15 section-title">Request your consultation</h2>

                                <!--p class="migration-assessment-box"><a href="">GET YOUR FREE ASSESSMENT TODAY!</a></p-->

                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span>

                            </div>  

                            </div></div></div>                         





                            <section id="contact" class="contact-section contact-style-3" style="border:0px solid red; margin-top:0px !important;padding-top:0px !important;">

                                <div class="container">

                                    <div class="row justify-content-center">

                                        <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">

                                            <div class="section-title text-center mb-50">

                                            <!--h3 class="mb-15">Get in touch</h3-->

                                            <p>Fill the form below take at most 5 minutes and send us to get your free assessment</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-12">

                                            <div class="contact-form-wrapper">

                                                <form action="#" id="contactUsForm" onsubmit="sendContactUs(event)" style="border:0px solid red; margin:0 auto;">

                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <select name="services_id" required class="form-input form-control select-box">

                                                                <option value="">Select Service Type</option>';

                                                                

                                                                $tableObj = $this->db->getObj("SELECT services_id, name FROM services WHERE services_publish = 1 ORDER BY name ASC", array());

                                                                if($tableObj){

                                                                    while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                                        $name = trim(stripslashes($oneRow->name));

                                                                        $returnHTML .= "<option value=\"$oneRow->services_id\">$name</option>";

                                                                    }

                                                                }

                                                                

                                                                $returnHTML .= '

                                                            </select>

                                                            <i class="lni lni-user"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <input type="text" id="name" name="fname" class="form-input" placeholder="Name" required>

                                                            <i class="lni lni-user"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <input type="email" id="email" name="email" class="form-input" placeholder="Email" required>

                                                            <i class="lni lni-envelope"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <input type="text" id="number" name="phone" class="form-input" placeholder="Number" maxlength="10" required>

                                                            <i class="lni lni-phone"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <input type="text" id="subject" name="subject" class="form-input" placeholder="Subject">

                                                            <i class="lni lni-text-format"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="single-input">

                                                            <textarea name="note" id="message" class="form-input" placeholder="Message" rows="6"></textarea>

                                                            <i class="lni lni-comments-alt"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="form-button">

                                                            <button name="submit-form" type="submit" class="button"> <i class="lni lni-telegram-original"></i> Submit</button>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>                            

                                    </div>

                                </div>

                            </section>









                            <!--div class="contact-form">

                                <form action="#" id="contactUsForm" onsubmit="sendContactUs(event)" style="border:0px solid red; margin:0 auto;">

                                    <div class="row">

                                        <div class="form-group col-md-6">

                                            <div class="dropdown2 bootstrap-select2 dropup2">

                                                <select name="services_id" required class="selectpicker333 select-box">

                                                    <option value="">Select Service Type</option>';

                                                    

                                                    $tableObj = $this->db->getObj("SELECT services_id, name FROM services WHERE services_publish = 1 ORDER BY name ASC", array());

                                                    if($tableObj){

                                                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                            $name = trim(stripslashes($oneRow->name));

                                                            $returnHTML .= "<option value=\"$oneRow->services_id\">$name</option>";

                                                        }

                                                    }

                                                    

                                                    $returnHTML .= '

                                                </select>

                                            </div>                            

                                        </div>



                                        <div class="form-group col-md-12">

                                            <input type="text" name="fname" placeholder="First Name *" required>

                                        </div> 

                                        <div class="form-group col-md-12">

                                            <input type="text" name="lname" placeholder="Last Name *" required>

                                        </div> 



                                        <div class="form-group col-md-6">

                                            <input type="email" name="email" placeholder="Email *" required>

                                        </div>



                                        <div class="form-group col-md-6">

                                            <input type="text" name="phone" placeholder="Phone *" maxlength="10" required>

                                        </div>

                                        

                                        <div class="form-group col-md-12">

                                            <textarea class="minHeight100" name="note" placeholder="Message *" required></textarea>

                                        </div>                                        

                                        

                                        

                                        <div id="mathCaptcha" class="form-group col-lg-6 col-md-6 col-sm-12">

                                        </div>

                                                    

                                        <div class="form-group col-md-12">

                                            <div class="text-center">                                                

                                                <button name="submit-form" type="submit" class="theme-btn btn-style-one"><span>Submit</span></button>

                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div-->

                               

                        </div>

                    </div>

                </div>

            </div>

        </section>';

        $returnHTML .= $this->footerHTML();



		return $returnHTML;

    }





    public function contactUs(){

        

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }



        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="contact-form-section background" >

            <div class="container">

                <div class="pageTransBody">



                    <div class="row mt-5" style="max-width:1140px;margin:0 auto;margin-top:0px !important;">

                        <div class="col-sm-12 u-section-1"> 
                        

                        <div class="col-12" style="margin-top:20px;">
                        <ul class="breadcrumbs " style="border:0px solid red; margin:0 auto;">
                            <li class="breadcrumbs_item"><a href="/" style="margin-left: -10px;">Home</a></li>
                            <li class="breadcrumbs_item active" aria-current="page"><a href="/" style="">'.$GLOBALS['title'].'</a></li>
                        </ul>
                    </div>



                            <div class="u-expanded-width u-list u-list-1">

                                <div class="u-repeater u-repeater-1">

                                    <div class="u-align-center u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-1">

                                        <div class="u-container-layout u-similar-container u-container-layout-1"><span class="u-file-icon u-gradient u-icon u-icon-circle u-text-white u-icon-1"><img src="/website_assets/images/envelop.png" alt=""></span>

                                        <h5 class="u-text u-text-3">E-mail Us</h5>

                                        <p class="contact-card-link">

                                            <a href="mailto:immigration75@gmail.com" class="">';

                                            if(!empty($contactUsPages[9])){

                                                $returnHTML .= $contactUsPages[9][0];

                                            }

                                            $returnHTML .=' 

                                            </a>

                                        </p>

                                        </div>

                                    </div>

                                    <div class="u-align-center u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-2">

                                        <div class="u-container-layout u-similar-container u-container-layout-2"><span class="u-file-icon u-gradient u-icon u-icon-circle u-text-white u-icon-2"><img src="/website_assets/images/location.png" alt=""></span>

                                        <h5 class="u-text u-text-5">Address</h5>

                                            <p class="contact-card-link"> 

                                                <a href="https://www.google.com/maps?ll=43.690391,-79.293086&z=16&t=m&hl=en&gl=CA&mapclient=embed&q=2942+Danforth+Ave+Toronto,+ON+M4C+1M5" class="">';

                                                if(!empty($contactUsPages[8])){

                                                    $returnHTML .= $contactUsPages[8][0];

                                                }

                                                $returnHTML .= '

                                                </a>

                                            <br>

                                        </p>

                                        </div>

                                    </div>

                                    <div class="u-align-center u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-3">

                                        <div class="u-container-layout u-similar-container u-container-layout-3"><span class="u-file-icon u-gradient u-icon u-icon-circle u-text-white u-icon-3"><img src="/website_assets/images/phone.png" alt=""></span>

                                        <h5 class="u-text u-text-7">Call Us</h5>

                                        <p class="contact-card-link">

                                            <a href="tel:+1(416)6867713" class="">';

                                            if(!empty($contactUsPages[10])){

                                                $returnHTML .= $contactUsPages[10][0];

                                            }

                                            $returnHTML .= '

                                            </a>

                                        </p>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            

                            <!--div class="row clearfix">                               

                                <div class="reserve-box col-lg-4 col-md-5 col-sm-12">

                                    <div class="inner-box">

                                        <div class="content">

                                            <span class="icon flaticon-call">

                                            

                                            </span>

                                            <h4>Phone</h4>';

                                            if(!empty($contactUsPages[10])){

                                                $returnHTML .= $contactUsPages[10][0];

                                            }

                                        $returnHTML .= '</div>

                                    </div>

                                </div>

        

                                <div class="reserve-box col-lg-3 col-md-4 col-sm-12 pleft0 pright0">

                                    <div class="inner-box">

                                        <div class="content">

                                            <span class="icon flaticon-email">

                                                

                                            </span>

                                            <h4>E-mail Us</h4>';

                                            if(!empty($contactUsPages[9])){

                                                $returnHTML .= $contactUsPages[9][0];

                                            }

                                        $returnHTML .= '<br><br><br></div>

                                    </div>

                                </div>

        

                                <div class="reserve-box col-lg-5 col-md-4 col-sm-12">

                                    <div class="inner-box">

                                        <div class="content">

                                            <span class="icon flaticon-placeholder">

                                            

                                            </span>

                                            <h4>Address</h4>';

                                            if(!empty($contactUsPages[8])){

                                                $returnHTML .= $contactUsPages[8][0];

                                            }

                                        $returnHTML .= '<br><br></div>

                                    </div>

                                </div> 



                            </div-->

                            



                            <!--Contact Form-->

                            

                            <!-- Sec Title -->

                            <br>

                            <div class="col-md-12 sec-title text-center" style="border:0px solid red; margin-left:0px; margin-top:5px !important;margin-bottom:25px !important;">

                                <h2 class="section-title">CONTACT US TODAY TO MAKE AN APPOINTMENT!</h2>

                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span>

                            </div>

                            





                            <section id="contact" class="contact-section contact-style-3">

                                <div class="container">

                                    <!--div class="row justify-content-center">

                                        <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">

                                            <div class="section-title text-center mb-50">

                                            <h3 class="mb-15">Get in touch</h3>

                                            <p>Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed!</p>

                                            </div>

                                        </div>

                                    </div-->

                                    <div class="row">

                                        <div class="col-lg-12">

                                            <div class="contact-form-wrapper">

                                                <form action="#" id="contactUsForm" onsubmit="sendContactUs(event)" style="border:0px solid red; margin:0 auto;">

                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <select name="services_id" required class="form-input form-control select-box">

                                                                <option value="">Select Service Type</option>';

                                                                

                                                                $tableObj = $this->db->getObj("SELECT services_id, name FROM services WHERE services_publish = 1 ORDER BY name ASC", array());

                                                                if($tableObj){

                                                                    while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                                        $name = trim(stripslashes($oneRow->name));

                                                                        $returnHTML .= "<option value=\"$oneRow->services_id\">$name</option>";

                                                                    }

                                                                }

                                                                

                                                                $returnHTML .= '

                                                            </select>

                                                            <i class="lni lni-user"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <input type="text" id="name" name="fname" class="form-input" placeholder="Name" required>

                                                            <i class="lni lni-user"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <input type="email" id="email" name="email" class="form-input" placeholder="Email" required>

                                                            <i class="lni lni-envelope"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <input type="text" id="number" name="phone" class="form-input" placeholder="Number" maxlength="10" required>

                                                            <i class="lni lni-phone"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="single-input">

                                                            <input type="text" id="subject" name="subject" class="form-input" placeholder="Subject">

                                                            <i class="lni lni-text-format"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="single-input">

                                                            <textarea name="note" id="message" class="form-input" placeholder="Message" rows="6"></textarea>

                                                            <i class="lni lni-comments-alt"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="form-button">

                                                            <button name="submit-form" type="submit" class="button"> <i class="lni lni-telegram-original"></i> Submit</button>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>                            

                                    </div>

                                </div>

                            </section>









                            <!--div class="contact-form">

                                <form action="#" id="contactUsForm" onsubmit="sendContactUs(event)" style="border:0px solid red; margin:0 auto;">

                                    <div class="row">

                                        <div class="form-group col-md-6">

                                            <div class="dropdown2 bootstrap-select2 dropup2">

                                                <select name="services_id" required class="selectpicker333 select-box">

                                                    <option value="">Select Service Type</option>';

                                                    

                                                    $tableObj = $this->db->getObj("SELECT services_id, name FROM services WHERE services_publish = 1 ORDER BY name ASC", array());

                                                    if($tableObj){

                                                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                            $name = trim(stripslashes($oneRow->name));

                                                            $returnHTML .= "<option value=\"$oneRow->services_id\">$name</option>";

                                                        }

                                                    }

                                                    

                                                    $returnHTML .= '

                                                </select>

                                            </div>                            

                                        </div>



                                        <div class="form-group col-md-12">

                                            <input type="text" name="fname" placeholder="First Name *" required>

                                        </div> 

                                        <div class="form-group col-md-12">

                                            <input type="text" name="lname" placeholder="Last Name *" required>

                                        </div> 



                                        <div class="form-group col-md-6">

                                            <input type="email" name="email" placeholder="Email *" required>

                                        </div>



                                        <div class="form-group col-md-6">

                                            <input type="text" name="phone" placeholder="Phone *" maxlength="10" required>

                                        </div>

                                        

                                        <div class="form-group col-md-12">

                                            <textarea class="minHeight100" name="note" placeholder="Message *" required></textarea>

                                        </div>                                        

                                        

                                        

                                        <div id="mathCaptcha" class="form-group col-lg-6 col-md-6 col-sm-12">

                                        </div>

                                                    

                                        <div class="form-group col-md-12">

                                            <div class="text-center">                                                

                                                <button name="submit-form" type="submit" class="theme-btn btn-style-one"><span>Submit</span></button>

                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div-->

                               

                        </div>

                    </div>

                </div>

            </div>

        </section>';

        $returnHTML .= $this->footerHTML();



		return $returnHTML;

    }



    public function sendContactUs(){

        $POST = json_decode(file_get_contents('php://input'), true);

		$returnStr = '';

        

		// $email = addslashes($POST['email']??'');

		$email = $_POST['email']?$_POST['email']:'';

		if($email =='' || is_null($email)){

            $returnStr = 'Could not send mail because of missing your email address.';

		}

		else{

			

			$fromName = trim(stripslashes((string) $POST['fname']??''.' '.$POST['lname']??''));

			$phone = nl2br(trim(stripslashes((string) $POST['phone']??'')));

			$note = nl2br(trim(stripslashes((string) $POST['note']??'')));

            

			$subject = '[New message] From '.LIVE_DOMAIN." Contact Form";

			            

            $message = "<html>";

            $message .= "<head>";

            $message .= "<title>$subject</title>";

            $message .= "</head>";

            $message .= "<body>";

            $message .= "<p>";

            $message .= "Dear <i><strong>$fromName</strong></i>,<br />";

            $message .= "We received your request for contact.<br /><br />";

            $message .= "You wrote:<br />";

            $message .= "Phone: $phone<br>";

            $message .= "Email: $email<br>";

            $message .= "Message: $note";

            $message .= "</p>";

            $message .= "<p>";

            $message .= "<br />";

            $message .= "Thank you for contacting us.";

            $message .= "<br />";

            $message .= "We will reply as soon as possible.";

            $message .= "</p>";

            $message .= "</body>";

            $message .= "</html>";



            $do_not_reply = $this->db->supportEmail('do_not_reply');

			

            $headers = array();

            $headers[] = 'MIME-Version: 1.0';

            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            $headers[] = 'To: '.$fromName.' <'.$email.'>';

            $headers[] = 'From: '.COMPANYNAME.' <'.$do_not_reply.'>';

            

            //$headers .= 'Cc: shobhancse@gmail.com' . "\r\n";

			if(mail($email, $subject, $message, implode("\r\n", $headers))){

				$returnStr = 'sent';

                

                $info = $this->db->supportEmail('info');

                $headers = array();

                $headers[] = 'MIME-Version: 1.0';

                $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                $headers[] = 'To: '.COMPANYNAME.' <'.$info.'>';

                $headers[] = 'From: '.$fromName.' <'.$email.'>';

                

                $message = "<html>";

                $message .= "<head>";

                $message .= "<title>$subject</title>";

                $message .= "</head>";

                $message .= "<body>";

                $message .= "<p>";

                $message .= "Dear Admin of <i><strong>".COMPANYNAME."</strong></i>,<br />";

                $message .= "We received a Contact request from $fromName.<br /><br />";

                $message .= "He / She wrotes:<br />";

                $message .= "Phone: $phone<br>";

                $message .= "Email: $email<br>";

                $message .= "Message: $note";

                $message .= "</p>";

                $message .= "<p>";

                $message .= "<br />";

                $message .= "Please reply him/her as soon as possible.";

                $message .= "</p>";

                $message .= "</body>";

                $message .= "</html>";



                mail($info, $subject, $message, implode("\r\n", $headers));



			}

			else{

				$returnStr = "Sorry! Could not send mail. Try again later.";

			}

		}

		return json_encode(array('login'=>'', 'returnStr'=>$returnStr));

    }



    private function headerHTML(){

        

        $segment2URI = $GLOBALS['segment2URI']??'';
        $segment3URI = $GLOBALS['segment3URI']??'';

        

        $returnHTML = '';

        $title = $GLOBALS['title'];

        $metaSiteName = $this->db->seoInfo('metaSiteName');

        $metaTitle = $this->db->seoInfo('metaTitle');

        if(in_array($segment2URI, array('home', 'null', ''))){$title = $metaTitle;}

        $metaDescription = $this->db->seoInfo('metaDescription');

        $metaKeyword = $this->db->seoInfo('metaKeyword');

        $metaDomain = $this->db->seoInfo('metaDomain');

        $metaUrl = $this->db->seoInfo('metaUrl');

        $metaImage = $this->db->seoInfo('metaImage');

        $metaVideo = $this->db->seoInfo('metaVideo');

        $metaLocale = $this->db->seoInfo('metaLocale');      


        $pageURI = str_replace('.html', '', implode('/', $GLOBALS['segments']));
        $tableObj = $this->db->getObj("SELECT * FROM seo_info WHERE uri_value = :uri_value AND seo_info_publish = 1 LIMIT 0, 1", array('uri_value'=>$pageURI));
        if($tableObj){
            $tableRow = $tableObj->fetch(PDO::FETCH_OBJ);
            
            $seo_info_id = $tableRow->seo_info_id;
            $metaTitle = trim(stripslashes($tableRow->seo_title));
            $metaKeyword = trim(stripslashes($tableRow->seo_keywords));
            $metaDescription = trim(stripslashes($tableRow->description));
            $metaUrl = trim(stripslashes($tableRow->video_url));

            $pageImgUrl = '';
            $filePath = "./assets/accounts/seo_$seo_info_id".'_';
            $pics = glob($filePath."*.jpg");
            if(!$pics){
                $pics = glob($filePath."*.png");
            }
            if($pics){
                foreach($pics as $onePicture){
                    $pageImgUrl = str_replace('./', '/', $onePicture);
                }
            }

            if(!empty($pageImgUrl)){
                $metaImage = baseURL.$pageImgUrl;
            }            
        }
          

        $htmlStr = '

        <!DOCTYPE html>

        <html lang="en">

        <head>        

            <meta charset="UTF-8">

            <meta http-equiv="X-UA-Compatible" content="IE=edge">

            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

            <meta name="format-detection" content="telephone=no">

            <meta name="apple-mobile-web-app-capable" content="yes">

            <meta name="viewport" content="width=device-width,initial-scale=1.0"/>

            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

            <meta name="language" content="English">

            <meta name="google-site-verification" content="DVN9gOUQUqpnNg_Wkq_BfCFRYYt_lupcz8EOB9VXd7w" />

            <title>'.$title.'</title>            

            <meta name="author" content="'.COMPANYNAME.'" />

            <meta name="title" content="'.$metaTitle.'"/>

            <meta name="description" content="'.$metaDescription.'"/>

            <meta name="keywords" content="'.$metaKeyword.'">

            <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>


            <meta property="og:type" content="website" />

            <meta property="og:site_name" content="'.$metaSiteName.'"/>

            <meta name="og:domain" content="'.$metaDomain.'"/>

            <meta property="og:title" content="'.$metaTitle.'"/>

            <meta property="og:description" content="'.$metaDescription.'"/>';



            foreach($metaUrl as $oneMetaUrl=>$labelName){

                $htmlStr .= "<meta property=\"og:url\" content=\"$metaDomain$oneMetaUrl\"/>";

            }

    

            $htmlStr .= '<meta property="og:image" content="'.$metaImage.'"/>

            <meta property="og:image:type" content="image/png"/>

            <meta property="og:image:width" content="400"/>

            <meta property="og:image:height" content="300"/>

            <meta property="og:image:alt" content="'.$metaSiteName.'" />

            <meta content="'.$metaLocale.'" property="og:locale"/>

            <meta property="og:video" content="'.$metaVideo.'"/>

            <meta property="og:video:width" content="400"/>

            <meta property="og:video:height" content="300"/>

            <meta property="og:video:secure_url" content="'.$metaVideo.'"/>

            <meta property="og:video:type" content="application/x-shockwave-flash" />         



            <meta name="twitter:card" content="'.$metaDescription.'">

            <meta name="twitter:url" content="'.$metaDomain.'">

            <meta name="twitter:title" content="'.$metaTitle.'"/>

            <meta name="twitter:description" content="'.$metaDescription.'"/>

            <meta name="twitter:site" content="'.$metaSiteName.'"/>

            <meta name="twitter:image" content="'.$metaImage.'">

            <meta name="twitter:image:alt" content="'.$metaSiteName.'">

            <meta name="twitter:image:width" content="400"/>

            <meta name="twitter:image:height" content="300"/>

            <meta name="twitter:creator" content="'.COMPANYNAME.'">


            <!-- links -->

            <link href="/website_assets/images/icons/favicon.ico" rel="shortcut icon">

            <link href="/website_assets/images/icons/favicon-32x32.png" rel="apple-touch-icon-precomposed">

            <link href="/website_assets/images/icons/favicon-16x16.png" rel="shortcut icon" type="image/png">



            <!-- google font link -->
            <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Jost:ital,wght@0,500;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&family=Oswald:wght@400;500;600;700&family=Arya:wght@400;500;600;700&display=swap" rel="stylesheet"> 
            
            <!-- bootstrap link -->
            <link rel="stylesheet" href="/website_assets/css/bootstrap.min.css">

            <link rel="stylesheet" href="/website_assets/css/style.css">                 
            
            <!-- slider -->
            <link rel="stylesheet" href="/website_assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        
            
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-LZJRWQ8RS9"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag("js", new Date());

            gtag("config", "G-LZJRWQ8RS9");
            </script> 

        </head>

        <body>
        <div class="full-site-wrapper">';          

            $headerPages = array(1=>array(), 2=>array(), 16=>array(), 17=>array(), 18=>array(), 27=>array());

            $headerData = array(1=>array(), 2=>array(), 16=>array(), 17=>array(), 18=>array(), 27=>array());

            $tableObj = $this->db->getObj("SELECT pages_id, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($headerPages)).") AND pages_publish =1", array());

            if($tableObj){

                while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                    $headerPages[$oneRow->pages_id] = trim(stripslashes($oneRow->short_description));

                    $headerData[$oneRow->pages_id] = trim(stripslashes($oneRow->uri_value));

                }

            }



        $htmlStr .= '<header class="top-header">

                <div class="container">

                    <div class="row">

                        <div class="col-md-8">

                            <div class="top-header-left">

                                <ul>

                                <li><a href="tel:'.$headerPages[1].'">Call: '.$headerPages[1].'</a></li>

                                <li>Fax: '.$headerPages[16].'</li>

                                <li><a href="mailto:'.$headerPages[2].'">Email: '.$headerPages[2].'</a></li>

                                </ul>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="top-header-right">

                                <p><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>'.$headerPages[17].'5</p>

                            </div>

                        </div>

                    </div>

                </div>

            </header>

            <div class="middle-header">

                <div class="container">

                    <div class="row" style="border:0px solid red;">

                        <div class="col-md-5">

                            <div class="brand-logo">

                                <a href="/"><img src="/website_assets/images/main-logo.png" alt="brand" srcset=""></a>

                            </div>

                        </div>

                        <div class="col-md-7">

                            <div class="middle-header-right-content btns">
                                                               
                                <div class="middle-header-right-box col-md-6">                                
                                <img src="/website_assets/images/phone-icon.png" alt="phone-icon" srcset="">                                
                                <a href="tel:'.$headerPages[18].'"><h5 class="call-number">'.$headerPages[18].' <span class="call-us-today">Call us today</span>
                                </h5></a>                                
                                </div>

                                <div >
                                    <a href="/'.$headerData[27].'.html" class="btn_r orange">Get Your Free Assessment</a>
                                </div>
                                

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <nav class="navbars p-sticky">

                <div class="container menu-flex">

                    <a href="./index.html" class="brand" id="brand"><img src="/website_assets/images/main-logo.png" alt="brand" srcset=""></a>

                    <div class="burger" id="burger">

                        <span class="burger-line"></span>

                        <span class="burger-line"></span>

                        <span class="burger-line"></span>

                    </div>
                    
                    <div class="menu" id="menu">

                        <ul class="menu-inner">';



                        $manuStr = $mobileManuStr = '';

                        $activeYN = 0;

                        $FMSql = "SELECT front_menu_id, name, menu_uri FROM front_menu WHERE root_menu_id  = 1 AND sub_menu_id = 0 AND front_menu_publish = 1 ORDER BY menu_position ASC";

                        $FMObj = $this->db->getObj($FMSql, array());

                        if($FMObj){

                            $currentURI = $GLOBALS['segment2URI']??'';

                            if(empty($currentURI)){$currentURI = '/';}

                            

                            while($oneRow = $FMObj->fetch(PDO::FETCH_OBJ)){



                                $sub_menu_id = $oneRow->front_menu_id;

                                $rootName = trim(stripslashes($oneRow->name));



                                if($oneRow->menu_uri !='#'){

                                    $rootMenu_uri = str_replace('//', '/', '/'.trim(stripslashes($oneRow->menu_uri))).'.html';

                                }

                                else{

                                    $rootMenu_uri = 'javascript:void(0);';

                                }                                                                

                                if($rootMenu_uri=='/.html'){

                                    $rootMenu_uri = '/';

                                    $rootName = '<i class="fa fa-home"></i> '.$rootName;

                                }

                                $activeDefault = '';

                                if($currentURI==$oneRow->menu_uri){

                                    $activeDefault = ' active';

                                    $activeYN++;

                                }
                                

                                //==============Sub Menu============//
                                $FMSql2 = "SELECT name, menu_uri FROM front_menu WHERE root_menu_id  = 1 AND sub_menu_id = $sub_menu_id AND front_menu_publish = 1 ORDER BY menu_position ASC";

                                $FMObj2 = $this->db->getObj($FMSql2, array());

                                if($FMObj2){ 
                                    // $manuStr .= "<li class=\"dropdown$activeDefault\">";

                                    $manuStr .= "<li class=\"menu-item\">";

                                    $mobileManuStr .= "<li class=\"dropdown$activeDefault\">";

                                    if(strpos($rootMenu_uri, 'servi') !==-1){

                                        $manuStr .= "<a href=\"#\" class=\"menu-link animatedBtn\">$rootName</a>";

                                        $mobileManuStr .= "<a href=\"#\">$rootName</a>";

                                    } else {

                                        // $manuStr .= "<a href=\"$rootMenu_uri\">$rootMame <i class=\"fa fa-caret-down\"></i></a>";

                                        $manuStr .= "<a href=\"#\" class=\"menu-link animatedBtn\">$rootName</a>";

                                        $mobileManuStr .= "<a href=\"$rootMenu_uri\">$rootName</a>";

                                    }

                                    // $manuStr .= "<ul class=\"down-menu\">";

                                    // $mobileManuStr .= "<ul class=\"down-menu\" id=\"drop-menu\">";

                                    // while($oneRow2 = $FMObj2->fetch(PDO::FETCH_OBJ)){

                                    //     $subName = trim(stripslashes($oneRow2->name));

                                    //     $subMenuUri = trim(stripslashes($oneRow2->menu_uri));

                                    //     $target = '';

                                    //     if(strpos($subMenuUri, 'http') !== false){

                                    //         $target = ' target="_blank"';

                                    //     }

                                    //     else{

                                    //         $subMenuUri = str_replace('//', '/', '/'.trim(stripslashes($oneRow->menu_uri))).'.html';

                                    //     }

                                    //     $activeDefault = '';

                                    //     if($currentURI==$oneRow2->menu_uri){

                                    //         $activeDefault = ' active';

                                    //         $activeYN++;

                                    //     }

                                    //     // $manuStr .= "<li><a$target href=\"$subMenuUri\">$subName</a></li>";

                                    //     $manuStr .= "<li class=\"menu-item\"><a href=\"$subMenuUri\" class=\"menu-link\">$subName</a></li>";

                                    //     $mobileManuStr .= "<li><a$target href=\"$subMenuUri\">$subName</a></li>";

                                    // }



                                    // $manuStr .= "</ul></li>";

                                    $manuStr .= "</li>";



                                    $mobileManuStr .= "</ul>

                                        <div class=\"dropdown-btn\" id=\"drop-btn\">

                                            <i class=\"fa fa-caret-down\"></i>

                                        </div>

                                    </li>";

                                }

                                else{                                    

                                    $manuStr .= "<li class=\"menu-item $activeDefault\"><a href=\"$rootMenu_uri\" class=\"menu-link animatedBtn\">$rootName</a></li>";

                                    $mobileManuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootName</a></li>";

                                }

                            }

                        }                        

                        $htmlStr .= $manuStr.'</ul>

                    </div>

                </div>

            </nav>';

            if(!in_array($segment3URI, array('home', null, ''))){
                $tableObj = $this->db->getObj("SELECT *  FROM services WHERE uri_value = :uri_value", array('uri_value'=>$segment3URI));

                if($tableObj){
        
                    while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
                        $id = $oneRow->services_id;
                        $service_name = $oneRow->name;
                        $service_uri_value = $oneRow->uri_value;
        
                    }
        
                }   
            } 

            if(!in_array($segment2URI, array('home', null, ''))){
                $htmlStr .='<section class="page-header">
                <div class="container">                        
                    <div class="row">
                        <div class="col-6" align="left">
                            <h2 class="txtwhite">'.$GLOBALS['title'].'</h2>
                        </div>
                        <div class="col-6 text-right" style="border:0px solid red; margin-top:10px;">
                            <ul class="breadcrumbs" style="margin-right:10px;">
                                <li class="breadcrumbs_item"><a href="/">Home</a></li>
                                <li class="breadcrumbs_item active" aria-current="page"><a href="'.baseURL.'/'.$segment2URI.'/">'.$GLOBALS['title'].'</a></li>';
                                if(!in_array($segment3URI, array('home', null, ''))){
                                    $htmlStr .='<li class="breadcrumbs_item active" aria-current="page"><a href="'.$service_uri_value.'/">'.$service_name.'</a></li>';
                                }    
                                $htmlStr .='
                            </ul>
                        </div>
                    </div>
                </div>
            </section>';
            }            

		return $htmlStr;

    }

    

    private function sidebarHTML(){              

        $htmlStr = '';       

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());
        if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }       

		$htmlStr = "

        <div class=\"sidebar_card card-just-text card-with-shadow\" data-background=\"color\" data-color=\"orange\">       

            <div class=\"content\">

                <p class=\"content_text\" style=\"\">
                <h5 class=\"\">Have Any Question?</h5>
                <span style=\"font-size:17px !important;\">Contact us: <br>
                <span style=\"font-weight:450 !important;\">".$contactUsPages[10][0]."</span></span></p>

                <p class=\"content_text\">".$contactUsPages[9][0]."</p>

            </div>

        </div>

        <!--1st Sidebar Start-->

        <div class=\"card card-with-shadow\">

            <div class=\"content\"> 



                            <div class=\"nav animated bounceInDown\">

                            <ul>";                

                            $manuStr = $mobileManuStr = '';

                            $activeYN = 0;

                            $FMSql = "SELECT front_menu_id, name, menu_uri FROM front_menu WHERE root_menu_id  = 13 AND sub_menu_id = 0 AND front_menu_publish = 1 ORDER BY menu_position ASC";
                            
                            $FMObj = $this->db->getObj($FMSql, array());
                            

                            if($FMObj){

                

                                $currentURI = $GLOBALS['segment2URI']??'';

                                if(empty($currentURI)){$currentURI = '/';}

                                

                                while($oneRow = $FMObj->fetch(PDO::FETCH_OBJ)){

                

                                    $sub_menu_id = $oneRow->front_menu_id;
                                    
                                    $rootName = trim(stripslashes($oneRow->name));
                                    
                                    if($oneRow->menu_uri !='#'){

                                        $rootMenu_uri = str_replace('//', '/', '/'.trim(stripslashes($oneRow->menu_uri))).'.html';

                                    }

                                    else{

                                        $rootMenu_uri = 'javascript:void(0);';

                                    }

                                    

                                    $activeDefault = '';

                                    if($currentURI==$oneRow->menu_uri){

                                        $activeDefault = ' active';

                                        $activeYN++;

                                    }

                                    
                                    
                                    //==============Sub Menu============//

                                    $FMSql2 = "SELECT name, menu_uri FROM front_menu WHERE root_menu_id  = 13 AND sub_menu_id = $sub_menu_id AND front_menu_publish = 1 ORDER BY menu_position ASC";

                                    $FMObj2 = $this->db->getObj($FMSql2, array());
                                    
                                    if($FMObj2){                  

                                        // $manuStr .= "<li class=\"dropdown$activeDefault\">";

                                        $manuStr .= "<li class=\"sidebar_link\">";

                                        $mobileManuStr .= "<li class=\"dropdown$activeDefault\">";                

                                        // $manuStr .= "<a href=\"$rootMenu_uri\">$rootName <i class=\"fa fa-caret-down\"></i></a>";

                                        $manuStr .= "<a href=\"/immigration-services.html\" class=\"\">$rootName</a>";

                                        $mobileManuStr .= "<a href=\"immigration-services.html\">$rootName</a>";                

                                        $manuStr .= "<ul>";

                                        $mobileManuStr .= "<ul class=\"down-menu\" id=\"drop-menu\">";                 

                                        while($oneRow2 = $FMObj2->fetch(PDO::FETCH_OBJ)){

                                            $subName = trim(stripslashes($oneRow2->name));

                                            $subMenuUri = trim(stripslashes($oneRow2->menu_uri));
                                            
                                            
                                            $target = '';

                                            if(strpos($subMenuUri, 'http') !== false){

                                                $target = ' target="_blank"';

                                            }

                                            else{

                                                $subMenuUri = str_replace('//', '/', '/'.trim(stripslashes($oneRow2->menu_uri))).'.html';

                                            }
                                            

                                            $activeDefault = '';

                                            if($currentURI==$oneRow2->menu_uri){

                                                $activeDefault = ' active';

                                                $activeYN++;

                                            }

                                            // $manuStr .= "<li><a$target href=\"$subMenuUri\">$subName</a></li>";

                                            $manuStr .= "<li><a href=\"/immigration-services$subMenuUri\" style=\"font-style: normal; font-weight: 300; font-display: swap;\" ><i style=\"float:left;\" class=\"fa fa-caret-right\"></i>$subName</a></li>";

                                            $mobileManuStr .= "<li><a$target href=\"$subMenuUri\">$subName</a></li>";                

                                        }

                                        $manuStr .= "</ul>

                                        </li>";

                                        $mobileManuStr .= "</ul>

                                            <div class=\"dropdown-btn\" id=\"drop-btn\">

                                                <i class=\"fa fa-caret-down\"></i>

                                            </div>

                                        </li>";                

                                    }

                                    else{

                                        // $manuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootMame</a></li>";

                                        $manuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootName</a></li>";

                                        $mobileManuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootName</a></li>";

                                    }

                                }

                            }                

                        $htmlStr .= $manuStr."</ul>                                

                        </div>

            </div>

        </div>


        <!--2nd Sidebar Start-->

        <div class=\"card card-with-shadow\">

                <div class=\"content\"> 

                        <div class=\"nav animated bounceInDown\">

                        <ul>";              

                                $manuStr = $mobileManuStr = '';

                                $activeYN = 0;

                                $FMSql = "SELECT front_menu_id, name, menu_uri FROM front_menu WHERE root_menu_id  = 1 AND sub_menu_id = 0 AND front_menu_id = 10 AND front_menu_publish = 1 ORDER BY menu_position ASC";
                                
                                $FMObj = $this->db->getObj($FMSql, array());                        

                                if($FMObj){            

                                    $currentURI = $GLOBALS['segment2URI']??'';

                                    if(empty($currentURI)){$currentURI = '/';}

                                    

                                    while($oneRow = $FMObj->fetch(PDO::FETCH_OBJ)){            

                                        $sub_menu_id = $oneRow->front_menu_id;
                                        
                                        $rootName = trim(stripslashes($oneRow->name));
                                        
                                        if($oneRow->menu_uri !='#'){

                                            $rootMenu_uri = str_replace('//', '/', '/'.trim(stripslashes($oneRow->menu_uri))).'.html';

                                        }

                                        else{

                                            $rootMenu_uri = 'javascript:void(0);';

                                        }

                                        

                                        $activeDefault = '';

                                        if($currentURI==$oneRow->menu_uri){

                                            $activeDefault = ' active';

                                            $activeYN++;

                                        }                                
                                        
                                        //==============Sub Menu============//

                                        $FMSql2 = "SELECT name, menu_uri FROM front_menu WHERE root_menu_id  = 13 AND sub_menu_id = $sub_menu_id AND front_menu_publish = 1 ORDER BY menu_position ASC";

                                        $FMObj2 = $this->db->getObj($FMSql2, array());
                                        
                                        if($FMObj2){     

                                            // $manuStr .= "<li class=\"dropdown$activeDefault\">";

                                            $manuStr .= "<li class=\"sidebar_link\">";

                                            $mobileManuStr .= "<li class=\"dropdown$activeDefault\">";
                    

                                            // $manuStr .= "<a href=\"$rootMenu_uri\">$rootName <i class=\"fa fa-caret-down\"></i></a>";

                                            $manuStr .= "<a href=\"/immigration-services.html\" class=\"\">$rootName</a>";

                                            $mobileManuStr .= "<a href=\"immigration-services.html\">$rootName</a>";

                    

                                            $manuStr .= "<ul>";

                                            $mobileManuStr .= "<ul class=\"down-menu\" id=\"drop-menu\">";  

                    

                                            while($oneRow2 = $FMObj2->fetch(PDO::FETCH_OBJ)){

                                                $subName = trim(stripslashes($oneRow2->name));

                                                $subMenuUri = trim(stripslashes($oneRow2->menu_uri));
                                                
                                                
                                                $target = '';

                                                if(strpos($subMenuUri, 'http') !== false){

                                                    $target = ' target="_blank"';

                                                }

                                                else{

                                                    $subMenuUri = str_replace('//', '/', '/'.trim(stripslashes($oneRow2->menu_uri))).'.html';

                                                }
                                                

                                                $activeDefault = '';

                                                if($currentURI==$oneRow2->menu_uri){

                                                    $activeDefault = ' active';

                                                    $activeYN++;

                                                }

                    

                                                // $manuStr .= "<li><a$target href=\"$subMenuUri\">$subName</a></li>";

                                                $manuStr .= "<li><a href=\"/legal-services$subMenuUri\" style=\"font-style: normal; font-weight: 300; font-display: swap;\" ><i style=\"float:left;\" class=\"fa fa-caret-right\"></i>$subName</a></li>";

                                                $mobileManuStr .= "<li><a$target href=\"$subMenuUri\">$subName</a></li>";

                    

                                            }

                                            $manuStr .= "</ul>

                                            </li>";
                                            

                    

                                            $mobileManuStr .= "</ul>

                                                <div class=\"dropdown-btn\" id=\"drop-btn\">

                                                    <i class=\"fa fa-caret-down\"></i>

                                                </div>

                                            </li>";

                    

                                        }

                                        else{

                                            // $manuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootMame</a></li>";

                                            $manuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootName</a></li>";

                                            $mobileManuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootName</a></li>";

                                        }

                                    }

                                }                    

                                $htmlStr .= $manuStr."

                        </ul>                            

                        </div>

                </div>

        </div>


        <!--3rd Sidebar Start-->

        <div class=\"card card-with-shadow\">

                <div class=\"content\"> 

                        <div class=\"nav animated bounceInDown\">

                        <ul>";              

                                $manuStr = $mobileManuStr = '';

                                $activeYN = 0;

                                $FMSql = "SELECT front_menu_id, name, menu_uri FROM front_menu WHERE root_menu_id  = 1 AND sub_menu_id = 0 AND front_menu_id = 21 AND front_menu_publish = 1 ORDER BY menu_position ASC";
                                
                                $FMObj = $this->db->getObj($FMSql, array());                        

                                if($FMObj){            

                                    $currentURI = $GLOBALS['segment2URI']??'';

                                    if(empty($currentURI)){$currentURI = '/';}

                                    

                                    while($oneRow = $FMObj->fetch(PDO::FETCH_OBJ)){            

                                        $sub_menu_id = $oneRow->front_menu_id;
                                        
                                        $rootName = trim(stripslashes($oneRow->name));
                                        
                                        if($oneRow->menu_uri !='#'){

                                            $rootMenu_uri = str_replace('//', '/', '/'.trim(stripslashes($oneRow->menu_uri))).'.html';

                                        }

                                        else{

                                            $rootMenu_uri = 'javascript:void(0);';

                                        }

                                        

                                        $activeDefault = '';

                                        if($currentURI==$oneRow->menu_uri){

                                            $activeDefault = ' active';

                                            $activeYN++;

                                        }                                
                                        
                                        //==============Sub Menu============//

                                        $FMSql2 = "SELECT name, menu_uri FROM front_menu WHERE root_menu_id  = 13 AND sub_menu_id = $sub_menu_id AND front_menu_publish = 1 ORDER BY menu_position ASC";

                                        $FMObj2 = $this->db->getObj($FMSql2, array());
                                        
                                        if($FMObj2){     

                                            // $manuStr .= "<li class=\"dropdown$activeDefault\">";

                                            $manuStr .= "<li class=\"sidebar_link\">";

                                            $mobileManuStr .= "<li class=\"dropdown$activeDefault\">";
                    

                                            // $manuStr .= "<a href=\"$rootMenu_uri\">$rootName <i class=\"fa fa-caret-down\"></i></a>";

                                            $manuStr .= "<a href=\"/immigration-services.html\" class=\"\">$rootName</a>";

                                            $mobileManuStr .= "<a href=\"immigration-services.html\">$rootName</a>";

                    

                                            $manuStr .= "<ul>";

                                            $mobileManuStr .= "<ul class=\"down-menu\" id=\"drop-menu\">";  

                    

                                            while($oneRow2 = $FMObj2->fetch(PDO::FETCH_OBJ)){

                                                $subName = trim(stripslashes($oneRow2->name));

                                                $subMenuUri = trim(stripslashes($oneRow2->menu_uri));
                                                
                                                
                                                $target = '';

                                                if(strpos($subMenuUri, 'http') !== false){

                                                    $target = ' target="_blank"';

                                                }

                                                else{

                                                    $subMenuUri = str_replace('//', '/', '/'.trim(stripslashes($oneRow2->menu_uri))).'.html';

                                                }
                                                

                                                $activeDefault = '';

                                                if($currentURI==$oneRow2->menu_uri){

                                                    $activeDefault = ' active';

                                                    $activeYN++;

                                                }

                    

                                                // $manuStr .= "<li><a$target href=\"$subMenuUri\">$subName</a></li>";

                                                $manuStr .= "<li><a href=\"/fingerprint-services$subMenuUri\" style=\"font-style: normal; font-weight: 300; font-display: swap;\" ><i style=\"float:left;\" class=\"fa fa-caret-right\"></i>$subName</a></li>";

                                                $mobileManuStr .= "<li><a$target href=\"$subMenuUri\">$subName</a></li>";

                    

                                            }

                                            $manuStr .= "</ul>

                                            </li>";
                                            

                    

                                            $mobileManuStr .= "</ul>

                                                <div class=\"dropdown-btn\" id=\"drop-btn\">

                                                    <i class=\"fa fa-caret-down\"></i>

                                                </div>

                                            </li>";

                    

                                        }

                                        else{

                                            // $manuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootMame</a></li>";

                                            $manuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootName</a></li>";

                                            $mobileManuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootName</a></li>";

                                        }

                                    }

                                }                    

                                $htmlStr .= $manuStr."

                        </ul>                            

                        </div>

                </div>

        </div>";



        return $htmlStr;



    }



     





    private function footerHTML(){	

        

        $headerPages = array(1=>array(), 2=>array(), 4=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($headerPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $headerPages[$oneRow->pages_id] = trim(stripslashes($oneRow->short_description));

            }

        }

        $location = '';

        $tableObj = $this->db->getObj("SELECT address FROM branches WHERE branches_publish=1 ORDER BY branches_id ASC LIMIT 0,1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $location = trim(stripslashes($oneRow->address));

            }

        }



        $htmlStr ='

        <footer class="footer">

            <div class="container">

                <div class="row">

                    <div class="col-md-4">

                        <div class="footer-box">

                            <h3 class="footer-box-title">Communicate With us</h3>

                            <p class="welcome">Welcome to our Canadian Immigration <br> & Legal Services Inc.</p>

                            <div class="line"></div>

                            <ul class="first-ul">

                                <li><span><i class="fa fa-phone-square"></i>

                                    </span><a href="tel:416-686-7713">416-686-7713</a> , <a href="tel:647-748-5678">647-748-5678</a>



                                </li>

                                <li><span><i class="fa fa-envelope"></i></span>immigration75@gmail.com</li>

                                <li><span><i class="fa fa-map-marker"></i>

                                    </span>2942 Danforth Avenue, Toronto, ON M4C 1M5</li>

                            </ul>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="footer-box">

                            <h3 class="footer-box-title">Explore</h3>

                            <div class="second-ul-box">

                                <ul>';

                                $manuStr = $mobileManuStr = '';

                                $activeYN = 0;
                                $l = 0;
        
                                $FMSql = "SELECT front_menu_id, name, menu_uri FROM front_menu WHERE root_menu_id  = 24 AND sub_menu_id = 0 AND front_menu_publish = 1 ORDER BY menu_position ASC";
        
                                $FMObj = $this->db->getObj($FMSql, array()); 

                                if($FMObj){                                    
        
                                    $currentURI = $GLOBALS['segment2URI']??'';
        
                                    if(empty($currentURI)){$currentURI = '/';}
        
                                    
        
                                    while($oneRow = $FMObj->fetch(PDO::FETCH_OBJ)){
                                                
                                        $l++;
                                    
                                        if($l == 7){
                                            $manuStr .= '</ul><ul>';
                                        }
        
                                        $sub_menu_id = $oneRow->front_menu_id;
        
                                        $rootName = trim(stripslashes($oneRow->name));
        
        
        
                                        if($oneRow->menu_uri !='#'){
        
                                            $rootMenu_uri = str_replace('//', '/', '/'.trim(stripslashes($oneRow->menu_uri))).'.html';
        
                                        }
        
                                        else{
        
                                            $rootMenu_uri = 'javascript:void(0);';
        
                                        }                                                                
        
                                        if($rootMenu_uri=='/.html'){
        
                                            $rootMenu_uri = '/';
        
                                            $rootName = '<i class="fa fa-home"></i> '.$rootName;
        
                                        }
        
                                        $activeDefault = '';
        
                                        if($currentURI==$oneRow->menu_uri){
        
                                            $activeDefault = ' active';
        
                                            $activeYN++;
        
                                        }                                        
        
                                        //==============Sub Menu============//
                                        // $FMSql2 = "SELECT name, menu_uri FROM front_menu WHERE root_menu_id  = 24 AND sub_menu_id = $sub_menu_id AND front_menu_publish = 1 ORDER BY menu_position ASC";
        
                                        // $FMObj2 = $this->db->getObj($FMSql2, array());
        
                                        // if($FMObj2){
        
                                        //     $manuStr .= "<li>";
        
                                        //     $mobileManuStr .= "<li class=\"dropdown$activeDefault\">";
        
                                        //     if(strpos($rootMenu_uri, 'servi') !==-1){
        
                                        //         $manuStr .= "<a href=\"#\" class=\"menu-link animatedBtn\">$rootName</a>";
        
                                        //         $mobileManuStr .= "<a href=\"#\">$rootName</a>";
        
                                        //     } else {        
                                                       
                                        //         $manuStr .= "<a href=\"#\" class=\"menu-link animatedBtn\">$rootName</a>";
        
                                        //         $mobileManuStr .= "<a href=\"$rootMenu_uri\">$rootName</a>";
        
                                        //     }
        
                                        //     $manuStr .= "</li>";
        
                                        //     $mobileManuStr .= "</ul>
        
                                        //         <div class=\"dropdown-btn\" id=\"drop-btn\">        
                                        //             <i class=\"fa fa-caret-down\"></i>        
                                        //         </div>
        
                                        //     </li>";
        
                                        // } else {                                    
        
                                            $manuStr .= "<li><a href=\"$rootMenu_uri\" class=\"\">$rootName</a></li>";
        
                                            $mobileManuStr .= "<li class=\"$activeDefault\"><a href=\"$rootMenu_uri\">$rootName</a></li>";
                                            
                                           
        
                                        // }

                                        
        
                                    }



        
                                }                        
        
                                $htmlStr .= $manuStr.'</ul>
                                

                                
                            </div>   
                           

                        </div>
                        <li><a href="https://canadianimmigrationlegal.com/sitemap.xml" target="_blank" style="color:#8f8da0;text-decoration:none;">Sitemap</a></li>
                        
                    </div>
                    


                    <div class="col-md-4">

                        <div class="footer-box">

                            <h3 class="footer-box-title">Our Location</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1573.051467289999!2d-79.29499180513055!3d43.68999100347029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cc21acaa0dc9%3A0x4d7ec62a710bc2cd!2s2942%20Danforth%20Ave%2C%20Toronto%2C%20ON%20M4C%201M5!5e0!3m2!1sen!2sca!4v1629097943092!5m2!1sen!2sca" width="100%" allowfullscreen="" loading="lazy"></iframe>

                        </div>

                    </div>

                </div>

                <div class="footer-middle">

                    <div class="line"></div>

                </div>

                <div class="row">

                    <div class="col-md-11">

                        <div class="footer-copyright" style="color:#B1B2B6;">

                            <!--p>Copyright © 2023 Canadian Immigration & Legal Services Inc. All rights reserved.</p-->
                            <p>Copyright ©2023 Canadian Immigration & Legal Services Inc All Rights Reserved.  &nbsp;&nbsp; Developed By: <a target="_blank" href="https://skitsbd.com"><img class="" src="/assets/accounts/power_logo.png" alt="SK IT SOLUTION" srcset="">&nbsp;</a></p>

                        </div>

                        


                    </div>

                    <div class="col-md-4">

                        <ul class="footer-bottom-ul">

                            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>

                            <li><a href="#" target="_blank" ><i class="fa fa-facebook-official"></i></a></li>

                            <li><a href="#" target="_blank"><i class="fa fa-pinterest"></i></a></li>

                            <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>

                               

                        </ul>

                    </div>

                </div>

            </div>

            <img class="footer-img" src="/website_assets/images/footer-bg-linedecor.png" alt="" srcset="">

        </footer>

    </div>








    

    <!-- jquery -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="js/hero-slider.js"></script>
    <script type="text/javascript" src="js/flickity.min.js"></script>
    <script type="text/javascript">
    const options = {
        accessibility: true,
        prevNextButtons: true,
        pageDots: true,
        autoPlay: 4000,
        setGallerySize: false,
          wrapAround: true,
          pauseAutoPlayOnHover:false
      };
      
      const carousel = document.querySelector("[data-carousel]");
      const flickity = new Flickity(carousel, options);
      const slideContent = document.querySelectorAll(".slide-content");
      let selectedSlide = flickity.selectedElement;
      
      flickity.on("settle", function () {
        selectedSlide = flickity.selectedElement;
      });
      
      flickity.on("scroll", function () {
        flickity.slides.forEach(function (slide, i) {
          const image = slide.cells[0].element;
          const x = (slide.target + flickity.x) * -1/2;
          image.style.backgroundPosition = x + "px";
        });
      });
      
      flickity.on("change", function(index) {
        slideContent[index].classList.remove("mask");
      
        setTimeout(function() {
          Array.from(slideContent).forEach(function(slide) {
            slide.classList.add("mask");
          });
        }, 500);
      });
      
      flickity.on("dragStart", function(event) {
        let index = 0;
        selectedSlide = flickity.selectedElement;
      
        if (event.layerX > 0) { // direction right
          index = Array.from(selectedSlide.parentNode.children).indexOf(selectedSlide) + 1;
        } else { // direction left
          index = Array.from(selectedSlide.parentNode.children).indexOf(selectedSlide) - 1;
        }
      
        slideContent[index].classList.remove("mask");
      });
      
      Array.from(slideContent).forEach(function(slide) {
        slide.classList.add("mask");
      });
    </script>

    <script type="text/javascript">



        $ = jQuery.noConflict();



        $(function () {

            

            // Owl Carousel

            var owl = $(".testimonial-area");

            owl.owlCarousel({

                items: 2,

                margin: 20,

                loop: true,

                dots: false,

                nav: true,

                autoplay: true,

                autoplayTimeout: 2000,

                autoplayHoverPause: false,

                navText: [

                    "<i class=\"fa fa-long-arrow-left\"></i>",

                    "<i class=\"fa fa-long-arrow-right\"></i>"

                ],

                "responsive": {

                    "0": {

                        "items": 1

                    },

                    "768": {

                        "items": 2

                    },

                    "992": {

                        "items": 2

                    },

                    "1200": {

                        "items": 2

                    }

                }

        

            });

        });

        

        $(document).ready(function() {

        

            var counters = $(".count-text");

            var countersQuantity = counters.length;

            var counter = [];

        

            for (i = 0; i < countersQuantity; i++) {

            counter[i] = parseInt(counters[i].innerHTML);

            }

        

            var count = function(start, value, id) {

            var localStart = start;

            setInterval(function() {

                if (localStart < value) {

                localStart++;

                counters[id].innerHTML = localStart + "+";

                }

            }, 40);

            }

        

            for (j = 0; j < countersQuantity; j++) {

            count(0, counter[j], j);

            }

        });













      

        const navbarMenu = document.getElementById("menu");

        const burgerMenu = document.getElementById("burger");

        const headerMenu = document.getElementById("header");



        // Open Close Navbar Menu on Click Burger

        if (burgerMenu && navbarMenu) {

        burgerMenu.addEventListener("click", () => {

            burgerMenu.classList.toggle("is-active");

            navbarMenu.classList.toggle("is-active");

        });

        }



        // Close Navbar Menu on Click Menu Links

        document.querySelectorAll(".menu-link").forEach((link) => {

        link.addEventListener("click", () => {

            burgerMenu.classList.remove("is-active");

            navbarMenu.classList.remove("is-active");

        });

        });



        // Close Navbar Menu on Click Outside

        window.addEventListener("click", function(e) {

            if (!document.querySelector("#menu").contains(e.target) && !document.querySelector(".burger").contains(e.target)) {

                burgerMenu.classList.remove("is-active");

                navbarMenu.classList.remove("is-active");

            }

        })

           



    </script>


    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0VQ2RB8F5K"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag("js", new Date());

    gtag("config", "G-0VQ2RB8F5K");
    </script>



</body>



</html>';





		return $htmlStr;

        

	}

    

	function handleErr(){

		$POST = json_decode(file_get_contents('php://input'), true);



		$name = $POST['name']??'';

		if(is_array($name)){$name = implode(', ', $name);}

		$message = $POST['message']??'';

		if(is_array($message)){$message = implode(', ', $message);}

		$url = $POST['url']??'';

		if(is_array($url)){$url = implode(', ', $url);}



		$this->db->writeIntoLog($name . ', Message: '.$message . ', Page Url: '.$url);

		return json_encode(array('returnMsg'=>'Saved'));

	}	

}

?>