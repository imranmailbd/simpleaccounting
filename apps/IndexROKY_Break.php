<?php

class Index{



	protected $db;



	public function __construct($db){$this->db = $db;}

    

	public function home(){  
        
        // echo "t";exit;

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

                   

                // new banner part starts here                
                $returnHTML .= '       
                <div class="carousel-cell" style="background-image:url(\'/assets/images/banner1s.jpg\');">
                    <div class="slide-content">
                        <div class="mask">
                            <p class="caption">PROFESSIONAL <b>ACCOUNTS & TAX</b><b> SOLUTIONS</b> SERVICES</p>
                        </div>
                        <div class="mask">
                            <a href="'.baseURL.'/contact-us.html" class="btn">Book A Consultation</a>
                        </div>
                    </div>
                </div>

                <div class="carousel-cell" style="background-image:url(\'/assets/images/banner2s.jpg\');">
                    <div class="slide-content">
                        <div class="mask">
                                <p class="caption">MINIMIZE YOUR <b>TAX LIABILITIES </b> AND<b> SECURE FINANCIAL</b> FUTURE</p>
                              
                        </div>
                        <div class="mask">
                            <a href="'.baseURL.'/contact-us.html" class="btn">Book A Consultation</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-cell" style="background-image:url(\'/assets/images/banner4s.jpg\');">
                    <div class="slide-content">
                        <div class="mask">
                            <p class="caption">WE PROVIDE THE BEST<b> BUSINESS REGISTRATION</b> SERVICES</p>
                        </div>
                        <div class="mask">
                            <a href="'.baseURL.'/contact-us.html" class="btn">Book A Consultation</a>
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

        
         

    <!-- New Service Area Starts -->
         
    <section class="service-area-new-c"> 
        <div class="section-title" style="margin-top: 70px;">
            <h4 class="text-center">Canadians Best Business Formation Services</h4> 
        </div>

        <section>
            <div class="simple-card">
                <div class="our-strength" style="margin-top: 80px;">';

                    $serviceObj = $this->db->getObj("SELECT services_id, name, font_awesome, uri_value, short_description FROM services WHERE services_publish =1 AND service_type =1 ORDER BY services_id ASC LIMIT 0, 6", array());
                                
                    $totalRows = $serviceObj->rowCount(); 

                    $it = 0;

                    if($serviceObj){                        


                        while($oneRow = $serviceObj->fetch(PDO::FETCH_OBJ)){

                            $services_id = $oneRow->services_id;

                            $name = trim(stripslashes($oneRow->name));

                            // $font_awesome = trim(stripslashes($oneRow->font_awesome));

                            $uri_value = trim(stripslashes($oneRow->uri_value));

                            $short_description = nl2br(trim(stripslashes($oneRow->short_description)));

                            $description = nl2br(trim(stripslashes($oneRow->description)));

                            if($it > 0 && ($it%3)==0 && $it<$totalRows){
                                $returnHTML .='</div>';
                                $returnHTML .='<div class="our-strength" style="margin-top: 20px;">';  
                            }
                            $it++;
                            

                            // if($oneRow->uri_value !='#'){
                            //     $services_uri = str_replace('//', '/', '/immigration-services/'.trim(stripslashes($oneRow->uri_value))).'.html';
                            // }
                            // else{
                            //     $services_uri = 'javascript:void(0);';
                            // }

                            

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
                                $serviceImg = "<img alt=\"".strip_tags(addslashes($name))."\" src=\"$serviceImgUrl\" style=\"width: 50px; padding-top: 5px;\" alt=\"\">";
                            }
                            else{

                                $serviceImg = "<img width=\"318\" height=\"290\" alt=\"".strip_tags(addslashes($name))."\" src=\"/assets/admin/images/event/1.jpg\">";

                            } 


                            $returnHTML .='
                            <div class="strength-card-system">
                                <div class="strength-card-contents mb-2"> 
                                        '.$serviceImg.' 
                                            <h3>'.$name.'</h3>
                                            <p class="mb-2">'.$short_description.'</p>                                             
                                            <a style="padding:8px 10px; margin-top:20px;margin-bottom:20px !important;" class="donate-btn button-navy-color txtOswald  mb-2 rounded-pill" href="'.$uri_value.'">Order Now</a>
                                </div>
                            </div>';

                        }

                    }

                    

                    $returnHTML .='
                    <!--div class="strength-card-system"> 
                        <div class="strength-card-contents">
                            <img  src="assets/images/tax2.png" style="width: 50px; padding-top: 5px;" alt="">   
                            <h3>Sole Proprietorship</h3>
                            <p>Agency Filing Fees only $49<br>  
                            2 Hours Rush Service Available <br>
                            Available for All Provinces</p> 
                            <button type="submit" class="donate-btn button-navy-color txtOswald  mb-1 px-2 py-1 fs-6 rounded-pill">Register Now</button>
                        </div>
                    </div>
                    <div class="strength-card-system">
                        <div class="strength-card-contents">  
                            <img  src="assets/images/tax3.png" style="width: 50px; padding-top: 5px;" alt=""> 
                            <h3>Federal Corporation</h3>
                            <p>Basic Package $299<br>  
                            Agency Filing Fees only $99 <br>
                                Government Fees $200</p> 
                            <button type="submit" class="donate-btn button-navy-color txtOswald  mb-1 px-2 py-1 fs-6 rounded-pill">Order Now</button>
                        </div>
                    </div>
                </div>

                <div class="our-strength" style="margin-top: 20px;">
                    <div class="strength-card-system">
                        <div class="strength-card-contents"> 
                            <img  src="assets/images/tax4.png" style="width: 50px; padding-top: 5px;" alt=""> 
                            <h3>Nuans Report</h3>
                            <p>Price Starts at only $13.80<br>  
                            Delivered in 1 Business Hour<br>
                            Pre-Search and Review Available</p> 
                            <button type="submit" class="donate-btn button-navy-color txtOswald  mb-1 px-2 py-1 fs-6 rounded-pill">Order Now</button>
                        </div>
                    </div>
                    <div class="strength-card-system">
                        <div class="strength-card-contents">
                            <img  src="assets/images/tax1.png" style="width: 50px; padding-top: 5px;" alt="">   
                            <h3>Business Incorporation</h3>
                            <p>Agency Filing Fees only $99<br>  
                            Incorporate in 2 hours <br>
                            Available for All Province </p> 
                            <button type="submit" class="donate-btn button-navy-color txtOswald  mb-1 px-2 py-1 fs-6 rounded-pill">Order Now</button>
                        </div>
                    </div>
                    <div-- class="strength-card-system">
                        <div class="strength-card-contents">  
                            <img  src="assets/images/tax5.png" style="width: 50px; padding-top: 5px;" alt=""> 
                            <h3>Professional Corporation</h3>
                            <p>Prepared by our legal team<br>  
                            Rush Service Available <br>
                            Up to Three Free Revisions </p> 
                            <button type="submit" class="donate-btn button-navy-color txtOswald  mb-1 px-2 py-1 fs-6 rounded-pill">See All Packages</button>
                        </div>
                    </div-->

                </div>
            </div> 

            <p class="carsl_btn" style="text-align:center; margin-top: 32px;">
            <!--a href="immigration-services.html" class="btn-more-bg animatedBtnBody">See All Our Services</a-->
            <a href="immigration-services.html" class="btn_r orange">See All Business Formation Services</a>
            </p> 
    </section>       

     <!-- New Service Area Ends -->


        
                    
        <!-- About Us Area Start -->
        <section class="abouts-area" style="margin-top: 100px;">                    
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

                            <!-- a href="https://www.youtube.com/embed/d2GgwR7kIKs" target="_blank">
                                <div class="about-img-box">
                                    <img src="'.$photo_galleryImgUrl.'" alt="" srcset="" style="width:100%; height:100%;"></a>
                                    <a href="https://www.youtube.com/embed/d2GgwR7kIKs" target="_blank">
                                        <div class="youtube-icon">
                                            <img src="/website_assets/images/pngegg.png" width="30" height="30">
                                        </div>
                                    </a>
                                </div>
                            </a -->

                            <div class="about-img-box">
                                <img class="rounded" src="/assets/accounts/about.jpg">
                           </div>
                        
                            <div class="about-sign-box py-4">
                                <!--a href="https://canadianimmigrationlegal.com/salauddin-ahmed">
                                <h4 class="salauddin">Mr. Salauddin Ahmed</h4></a -->
                                <h6> Simple Accounting & Tax Solutions</h6>
                            </div>

                            <div class="call-box">

                                <img src="/website_assets/images/phone-iocn.jpg" alt="" srcset="">

                                <div class="calling-us">

                                    <h4><span class="calling-us-span">'.$bodyPages[15][0].'</span>

                                    <a href="tel:'.$bodyPages[15][1].'">'.$bodyPages[15][1].'</a></h4>

                                </div>

                                <!--div class="calling-us">

                                    < p class="migration-assessment-box-home" ><a href="company-assessment.html">get your free assessment today!</a></p>
                                    

                                </div-->

                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="about-right">

                            <h3 class="about-title">

                                <span>'.$bodyPages[45][0].'</span>

                            </h3>

                            <p class="about-p3" style="text-align:justify;">'.$bodyPages[45][1].'</p>



                            <!-- p class="about-p2" style="text-align:justify;"><span>'.$bodyPages[4][0].'</span></p -->



                            <!-- p class="about-p3" style="text-align:justify;">'.$bodyPages[4][1].'</p -->

                        </div>

                    </div>

                </div>

                <div class="mission-commitment-area">

                    <div class="mission-box">

                        <div class="icon-box">

                            <img src="assets/images/mission.png" style="width: 35px;" alt="">

                        </div>

                        <div class="content-text-box">

                            <h4>'.$bodyPages[12][0].'</h4>

                            <p class="justify-content-center">'.$bodyPages[12][1].'</p>

                        </div>

                    </div>

                    <div class="mission-box">

                        <div class="icon-box">

                            <img src="assets/images/deal.png" style="width: 35px;" alt="">

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

        <!-- section class="help-section">

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

        </section -->


     <!-- Our Specialist part starts here -->  
              <section class="container expertise-card-design" style="margin-bottom: 88px;"> 
                <div class="simple-card" style="margin-top: 56px;">
                        <div class="mx-auto top-row">
                            <div class="col-md-12">
                                <h4 class="section-heading">WE PROVIDE THE BEST ACCOUNTING AND TAX SOLUTIONS SERVICES</h4>
                                <p class="web-text">We are dedicated to providing you with the highest quality accounting and tax services. Our team of experts excels in maintaining precise financial records, developing tax strategies that minimize your liabilities, and ensuring that you remain fully compliant with the ever-evolving tax regulations. We understand that every client is unique, which is why we offer personalized guidance on investment, retirement planning, and wealth management. </p>
                            </div>
                        </div>
                        <div class="our-strength" style="margin-top: 60px;">
                            <div class="strength-card">
                                <div class="strength-card-content"> 
                                    <div class="d-flex">
                                        <img  src="assets/images/icon1.png" style="width: 42px; margin-right: 15px;"  alt="Specialize">
                                        <h3>We Specialize</h3>
                                    </div>    
                                        <p> Our firm specializes in providing financial record keeping services to both businesses and individuals with the technical expertise, innovative thinking, and personal service they need to achieve financial security.</p>  
                                </div>
                            </div>
                            <div class="strength-card">
                                <div class="strength-card-content">
                                    <div class="d-flex">
                                        <img  src="assets/images/icon2.png" style="width: 42px; margin-right: 15px;" alt="">
                                        <h3>We Understand</h3>
                                    </div>     
                                        <p> We understand financial record keeping; it is our business! Our services save you valuable time, frustration, and money! With more than 20 years experience and continuing education, we keep up-to-date with the latest tax and accounting changes. </p>  
                                </div>
                            </div>
                            <div class="strength-card">
                                <div class="strength-card-content">
                                    <div class="d-flex">
                                        <img  src="assets/images/icon3.png" style="width: 42px; margin-right: 15px;" alt="">
                                        <h3>We Guarantee</h3>
                                    </div>    
                                        <p> We are committed to you and your business! We will do whatever it takes to ensure your satisfaction within the statutes of the law. We guarantee all of our work, and accept all responsibility for any penalties or interest that may result from our error. Our goal is fullfil customer satisfaction. </p>
                                </div>
                            </div>
                    </div>

                 </div>  
        </section>  

     <!-- Our Specialist part starts here -->  


        <!-- FAQ Area End -->

        <section class="free-consultant">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="free-left">

                        <h3><span>we’re delivering the best</span>

                            customer experience</h3>

                        <h5>If You Are Looking For any services, Just Call Us!</h5>

                        <h4><span>Call us today :</span> <a href="tel:+1 (647) 867-6351">+1 (647) 867-6351</a></h4>
                         
                    </div>
                </div>

                <!-- div class="col-md-6">

                    <div class="free-right">

                        <a href="contact-us.html">Book A Free Consultation!</a>

                    </div>

                </div --!>

            </div>

        </div>

    </section>                       






        <!-- Our Team Area Start -->

        <section class="our-expert-team">

            <div class="section-title">

                <h4 class="text-center">'.$bodyPages[20][0].'</h4>                

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

                                        <!-- div class="member-hover">

                                            <a href="#"><i class="fa fa-facebook-f"></i></a>

                                            <a href="#"><i class="fa fa-twitter-square"></i></a>

                                            <a href="#"><i class="fa fa-dribbble"></i></a>

                                        </div !-->
                                        

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
                <a href="'.$bodyPages[20][2].'" class="btn-stuff orange">See All Our Stuff</a>
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

       

        <!-- Subscription Area End -->';



        $returnHTML .= $this->footerHTML();

        $returnHTML .= '
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
        ';

        

        

		return $returnHTML;

    }

    public function businessFormationServices(){ 

        

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
    
                                <div class="single-card-pages card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
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



                                                    $tableObj = $this->db->getObj("SELECT services_id, name, font_awesome, uri_value, short_description FROM services WHERE services_publish =1 AND service_type =1 ORDER BY RAND()", array());

                                                    if($tableObj){

                                                        $pr = 0;

                                                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                                                            $name = trim(stripslashes($oneRow->name));

                                                            $font_awesome = trim(stripslashes($oneRow->font_awesome));

                                                            $uri_value = trim(stripslashes($oneRow->uri_value));

                                                            $short_description = trim(stripslashes($oneRow->short_description));

                                                            $short_description_set = implode(' ', array_slice(str_word_count($short_description,1), 0, 14));


                                                            $services_id = $oneRow->services_id;                        
                        
                                                            $pageImgUrl = ''; 
                        
                                                            $filePath = "./assets/accounts/serv_$services_id".'_';
                                                        
                        
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
                        
                                                                $pageImg = "<img style=\"margin: 4px; max-width: 250px;\" alt=\"".strip_tags(addslashes($oneRow->name))."\" src=\"$pageImgUrl\">";
                        
                                                            }
                        
                                                            else{
                        
                                                                $pageImg = "<img alt=\"".strip_tags(addslashes($oneRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";
                        
                                                            } 



                                                            if($pr %2 == 0){

                                                                $returnHTML .='</div><div class="row">';

                                                            }

                                                            $pr++;

                                                            

                                                            $returnHTML .='

                                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                                                <div class="card col">

                                                                    <div class="card-block">
                                                                    '.$pageImg.'
                                                                    <!--img src="/website_assets/images/services_icon/'.$uri_value.'.png" width="60px" class="mb-3"-->
            
                                                                        <h2 style="font-weight:900;" class="card-title">'.$name.'</h2>
            
                                                                        <p class="card-text mb-1">'.$short_description_set.'</p>
                                                                        
                                                                        <!--a href="/businessformation-services/'.$uri_value.'.html" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a-->

                                                                        <a href="/'.$uri_value.'.html" title="Read more" class="read-more" >Order Now<i class="fa fa-angle-double-right ml-2"></i></a>
            
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

    public function practiceAreas(){ 

        

        $returnHTML = $this->headerHTML();

        $segment3URI = $GLOBALS['segment3URI'];
        $segment2URI = $GLOBALS['segment2URI'];
        // echo $segment2URI;exit;

        if(!empty($segment3URI)){

            // echo $segment3URI;exit;  //services_id AS id, name, 'services' AS tableName

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
    
                                <div class="single-card-pages card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
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

                    // var_dump('service area');exit;

                    $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array(), 56=>array());

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

                                                        <h2 class="page-title">'.$bodyPages[56][0].'</h2>

                                                    </div>

                                                    <!--p class="text-center text-muted h5">'.$bodyPages[56][1].'</p-->

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
                                                                        
                                                                        <a href="/practice-areas/'.$uri_value.'.html" title="Read more" class="read-more" >Read more<i class="fa fa-angle-double-right ml-2"></i></a>
            
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


    public function pestservices(){        
        
        $id = 3;

        $bodyPages = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array(), 6=>array(), 7=>array(), 8=>array(), 9=>array(), 10=>array());
        $tableObj = $this->db->getObj("SELECT pages_id, name, short_description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($bodyPages)).") AND pages_publish =1", array());
		if($tableObj){
            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
                $bodyPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->name)), trim(stripslashes($oneRow->short_description)));
            }
        }            
        $returnHTML = $this->headerHTML();

        $returnHTML .= '            
        <section style="padding:1px 0; background-color:#E5F8F1; z-index: -1;">
            <div class="container">                    
                <div class="single-card card-style-one pl-2 mt-4 mb-3" style="padding-top:0px !important;">';
                
                    $tablePageObj = $this->db->getObj("SELECT * FROM pages WHERE pages_id = $id", array());
                    if($tablePageObj){
                    
                        while($onePageRow = $tablePageObj->fetch(PDO::FETCH_OBJ)){

                            $pages_id = $onePageRow->pages_id;
                            $name = trim(stripslashes($onePageRow->name));
                            $page_create_date = date('m/d/Y', strtotime($onePageRow->created_on));
                            $uri_value = trim(stripslashes($onePageRow->uri_value));

                            // $pageImgUrl = ''; 
                            // $filePath = "./assets/accounts/srvn_$id".'_';
                            // $pics = glob($filePath."*.jpg");
                            // if(!$pics){
                            //     $pics = glob($filePath."*.png");
                            // }
                            
                            // if($pics){
                            //     foreach($pics as $onePicture){
                            //         $pageImgUrl =baseURL.str_replace('./', '/', $onePicture);
                            //     }
                            // }
                            // if(!empty($pageImgUrl)){
                            //     $pageImg = "<img class=\"detailsPagePicture\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$pageImgUrl\">";
                            // }
                            // else{
                            //     $pageImg = "<img class=\"detailsPagePicture\" alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\" >";
                            // } 

                        
                            $returnHTML .= "
                            <div class=\"card-content\">
                                <div class=\"row\">
                                    <div class=\"col-md-4 order-md-1\">";
                                        
                                        $returnHTML .= $this->sidebarHTML();   

                                        $returnHTML .= "
                                    </div>
                                    <div class=\"col-md-8\">
                                        <div class=\"row\">
                                            <div class=\"col-md-12 details\">";
                                            $prodObj = $this->db->getObj("SELECT services_id AS id, name, description, price FROM pest_services WHERE pest_services_publish = 1", array());
                                            if($prodObj){
                                                while($oneRow = $prodObj->fetch(PDO::FETCH_OBJ)){
                                                    $returnHTML .= $this->productShortHTML($oneRow); 
                                                    // var_dump($oneRow);
                                                }
                                            }
                                            $returnHTML .= "
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
        </section>';
        $returnHTML .= $this->footerHTML();
        
		return $returnHTML;
    }

    
    public function productShortHTML($oneRow, $deals = 0){
        // var_dump($oneRow);exit;
        $baseURL = $GLOBALS['baseURL']??'';
        $customers_id = $_SESSION["customers_id"]??0;
        $currency = $_SESSION["currency"]??'$';
        $services_id = $oneRow->id;               
        $service_name = trim(stripslashes($oneRow->name));
        $service_description = trim(stripslashes($oneRow->description));
        if(strlen($service_description)>100){
            $service_description = substr($service_description, 0, 100).'...';
        }
        $service_description = nl2br($service_description);
        $service_price = $oneRow->price;  
        $regularPriceStr = '';
        if($service_price>0){
            $regularPriceStr = '<span class="ps-product__del">$ '.$service_price.'</span><br>';
        }      
    
        //#################### Product Images ##########################
        
        $prodImg = 'pest.png';
        $defaultImageSRC = "website_assets/images/$prodImg";
        
        $prodPictures = array();
        $prodPictures[0] = array($prodImg, $defaultImageSRC);
        $prodPictures[1] = array($prodImg, $defaultImageSRC);
        
        $filePath = "./assets/accounts/srvn_$services_id".'_';
        $pics = glob($filePath."*.jpg");
        if(!$pics){
            $pics = glob($filePath."*.png");
        }
        if($pics){
            $l = 0;
            foreach(array_slice($pics, 0, 2) as $onePicture){
                $prodImg = str_replace("./assets/accounts/", '', $onePicture);
                $prodImgUrl = str_replace('./', '/', $onePicture);
                $prodPictures[$l] = array($prodImg, $prodImgUrl);
                $l++;
            }
        }
        //###########################################################

       
        $returnHTML = ''; 
        
        $returnHTML .= '<div class="shop-item inner-box row" style="border:1px solid #cccccc;">
            <div class="col-lg-3 col-md-4 col-sm-6 padding0">
                <div class="">
                    <img src="'.$prodPictures[0][1].'" alt="'.$prodPictures[0][0].'" style="width:80%;"/>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-6 lower-content">
                <div class="row">
                    <div class="col-lg-9 col-md-8 txtleft">
                        <h4 class="mtop20">'.$service_name.'</h4>
                        <div>'.$service_description.'</div>
                    </div>
                    <div class="col-lg-3 col-md-4 padding0">
                        <div class="price" id="totalCalculatedPrice">
                            '.$regularPriceStr.'
                        </div>
                        <div class="w100Per" style="display:none;">
                            <div class="item-quantity">
                                <div class="quantity-spinner">
                                    <button type="button" class="minus">
                                        <span class="fa fa-minus"></span>
                                    </button>
                                    <input type="text" name="cartQty" id="cartQty'.$services_id.'" value="1" min="1" max="9999" class="cartQty numberField">                                    
                                    <button type="button" class="plus">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-lower btn-group mtop10">
                            <input type="hidden" id="services_id" name="services_id" value="'.$services_id.'">
                            <input type="hidden" id="services_price" name="services_price" value="'.$service_price.'">
                            <input type="hidden" id="services_name" name="services_name" value="'.$service_name.'">
                            <input type="hidden" id="returnYN" value="1">
                            <button type="button" title="ADD TO BUCKET" onclick="addToCart('.$services_id.', \''.addslashes($service_name).'\', '.$service_price.',\''.$prodPictures[0][1].'\');" tabindex="0">
                                <i class=" fa fa-shopping-cart"></i>
                            </button>                          
                            
                            <button type="button" title="CHECKOUT FOR ORDER NOW" onclick="addToCart('.$services_id.', \''.addslashes($service_name).'\', '.$service_price.',\''.$prodPictures[0][1].'\');" tabindex="0">
                                <i class=" fa fa-shopping-basket"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        return $returnHTML;
    }



    function sendAssessments(){

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

		$customerData['contact_no'] = $phone;

		$customerData['email'] = $email;

		$customerData['address'] = $address;

		

        $customers_id = 0;

        $queryManuObj = $this->db->getObj("SELECT customers_id FROM customers WHERE name = :name AND phone = :phone", array('name'=>$name, 'phone'=>$phone));

        if($queryManuObj){

            $customers_id = $queryManuObj->fetch(PDO::FETCH_OBJ)->customers_id;						

        }        

        // var_dump($customers_id);exit;

        if($customers_id==0){

            $customerData['offers_email'] = 1;

            $customerData['customers_publish'] = 1;

            $customerData['users_id'] = 0;

            $customerData['last_updated'] = date('Y-m-d H:i:s');

            $customerData['created_on'] = date('Y-m-d H:i:s');
            
            // var_dump($customerData);exit;

            $customers_id = $this->db->insert('customers', $customerData);

        }

        // var_dump($customers_id);exit;

        if($customers_id>0 && $services_id>0){
            
            $assessmentsData = array();

            $assessmentsData['created_on'] = date('Y-m-d H:i:s');

            $assessmentsData['last_updated'] = date('Y-m-d H:i:s');

            $assessmentsData['users_id'] = 1;

            $assessmentsData['assessments_publish'] = 1;

            $assessmentsData['notifications'] = 1;

            $assessments_no = 1;

            $queryObj = $this->db->getObj("SELECT assessments_no FROM assessments ORDER BY assessments_no DESC LIMIT 0, 1", array());

            if($queryObj){

                $assessments_no = intval($queryObj->fetch(PDO::FETCH_OBJ)->assessments_no)+1;

            }

            $assessmentsData['assessments_no'] = $assessments_no;

            $assessmentsData['services_id'] = $services_id;

            $assessmentsData['customers_id'] = $customers_id;

            $assessmentsData['services_type'] = '';

            $assessmentsData['description'] = $description;

            $assessmentsData['assessments_date'] = date('Y-m-d');

            $assessments_id = $this->db->insert('assessments', $assessmentsData);


            /**
             * Email Notification Services
             */                
            $emailck = $email;
            $returnStr = '';
            
            if($emailck =='' || is_null($emailck)){
                $returnStr = 'Could not send mail because of missing your email address.';
            }
            else{

                //================ Test message ===================
                // $msg = "First line of text\nSecond line of text";
                // use wordwrap() if lines are longer than 70 characters
                // $msg = wordwrap($msg,70);
                // send email
                // mail("imranmailbd@gmail.com","My subject",$msg);
                ///===============================================

                //======================For Customer====================//

                //####################################
                $fromName = trim(stripslashes($name));
                $do_not_reply = $this->db->supportEmail('do_not_reply');
                $email = $email;                 
                $from = 'imran@sksoftsolutions.ca';   // $this->db->supportEmail('info');  //  "imran@sksoftsolutions.ca";  // //'info@sksoftsolutions.ca'; 
                $subject = 'Free Assessment request place on '.LIVE_DOMAIN.' successfully'; 

                // Set content-type header for sending HTML email 
                $headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";                      
                // $headers .= COMPANYNAME." <$do_not_reply>". "\r\n";   //X-Sender                   
                // $headers .= "PHP/".phpversion() . "\r\n";   //X-Mailer                   
                // $headers .= '1'. "\r\n";   //X-Priority                  
                // $headers .= "text/html\r\n". "\r\n";   //Content-type                  
                // $headers .= "Reply-To: ".$do_not_reply. "\r\n";   //Reply-To                  
                // $headers .= "Organization: ".COMPANYNAME. "\r\n";   //Organization                  
                // Additional headers 
                $headers .= 'From: '.COMPANYNAME.'<'.$from.'>' . "\r\n"; 
                // $headers .= 'Cc: imran@sksoftsolutions.ca' . "\r\n"; 
                // $headers .= 'Bcc: imran@sksoftsolutions.ca' . "\r\n";                      
                //#####################   
                    
                $message = ' 
                <html> 
                <head> 
                    <title>Welcome to '.COMPANYNAME.'</title> 
                </head> 
                <body> 
                    <h1>Dear <i><strong>'.$fromName.'</strong></i>,<br />Thanks you for place your free assessment request to '.COMPANYNAME.'! We received your request. Our agent will contact with you asap.<br /><br /></h1> 
                    <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;">                             
                        <tr> 
                            <th>Your Name:</th><td>'.$fromName.'</td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Email:</th><td>'.$email.'</td> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Phone:</th><td>'.$phone.'</td> 
                        </tr>
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Address:</th><td>'.$address.'</td> 
                        </tr>                          
                        <tr style="background-color: #e0e0e0;"> 
                            <th>Thank you for the your request.</th><td>We will reply as soon as possible.</td> 
                        </tr>
                    </table> 
                </body> 
                </html>'; 

                // var_dump($message);
                // echo "<br>";
                // var_dump($headers);
                // echo "<br>";
                // var_dump($email);exit;                    


                if(mail($email, $subject, $message, $headers)){
                    
                    //=====================For Super Admin======================//
                    // Set content-type header for sending HTML email 
                    $fromName = COMPANYNAME; 
                    $do_not_reply = $this->db->supportEmail('do_not_reply'); 
                    $to = $this->db->supportEmail('info');   // 'imran.skitsbd@gmail.com';   //'user@example.com'; 
                    $cname = trim(stripslashes($name));  
                    $email = $email;
                    $subject = 'New Assessment Request # '.$assessments_no.' submitted'; 

                    $headersAdmin = array();
                    // $headersAdmin = "Organization: ".COMPANYNAME. "\r\n"; 
                    $headersAdmin = "MIME-Version: 1.0" . "\r\n"; 
                    $headersAdmin .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                    // $headersAdmin .= "X-Priority: 3" . "\r\n"; 
                    // $headersAdmin .= "X-Mailer: PHP".phpversion() . "\r\n";                         
                    // Additional headers 
                    $headersAdmin .= 'From: '.$cname.'<'.$email.'>' . "\r\n"; 
                    // $headersAdmin .= 'Cc: imran.skitsbd@gmail.com' . "\r\n"; 
                    // $headersAdmin .= 'Bcc: imran@sksoftsolutions.ca' . "\r\n";  
                    
                    $messageAdmin = ' 
                    <html> 
                    <head> 
                        <title>'.$subject.'</title> 
                    </head> 
                    <body> 
                        <h1>Dear Admin of <i><strong>'.COMPANYNAME.'</strong></i>,<br /></h1>
                        New Assessment Request submitted, Please review this.<br /><br /> 
                        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                            <tr> 
                                <th>Request No #</th><td>'.$assessments_no.'</td> 
                            </tr> 
                            <tr> 
                                <th>Customer Name:</th><td>'.$name.'</td> 
                            </tr> 
                            <tr style="background-color: #e0e0e0;"> 
                                <th>Customer Email:</th><td>'.$email.'</td> 
                            </tr>
                            <tr style="background-color: #e0e0e0;"> 
                                <th>Customer Phone:</th><td>'.$phone.'</td> 
                            </tr> 
                            <tr style="background-color: #e0e0e0;"> 
                                <th>Address:</th><td>'.$address.'</td> 
                            </tr> 
                            <tr style="background-color: #e0e0e0;"> 
                                <th>Please take action him/her as soon as possible.</th><td>&nbsp;</td> 
                            </tr>
                        </table> 
                    </body> 
                    </html>'; 
                                    
                    // var_dump($messageAdmin);
                    // echo "<br>";
                    // var_dump($headersAdmin);
                    // echo "<br>";
                    // var_dump($to);exit;
                    
                    mail($to, $subject, $messageAdmin, $headersAdmin);
                    //==============================================================
                    
                }
                else{
                    $returnStr = "Sorry! Could not send mail. Try again later.";
                }
            }
            

            /*###################* End Email Notification Services *#######################*/

            if($assessments_id){

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
                            <div class="single-card-pages card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
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

    public function forbidden404(){     

        
       

            $returnHTML = $this->headerRawHTML();

            $returnHTML .= '
                    <div class="d-flex align-items-center justify-content-center vh-100">
                        <div class="text-center">
                            <h1 class="display-1 fw-bold font-style-new text-center">404</h1>
                            <h4 class="fs-3 text-center "> <span class="text-danger">Opps!</span> Page not found.</h4>
                            <p class="lead text-center">
                                The page you’re looking for doesn’t exist.
                            </p>
                            <a href="/" class="mt-2 btn btn-primary">Go Home</a>
                        </div>
                    </div>
                    ';                      

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

                            <div class="single-card-pages card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
                            
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

                            <div class="single-card-pages card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
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



    public function set_sessionBranchesId(){

        $returnData = array();
		$returnData['login'] = '';
		$returnData['error'] = '';
		$returnData['branches_id'] = 0;

        $POST = json_decode(file_get_contents('php://input'), true);
        $branches_id = intval($POST["branches_id"]??0);

        // echo ($branches_id);exit;

        $tableObj = $this->db->getObj("SELECT branches_id, weekday_pickup_start, weekday_pickup_end FROM branches WHERE branches_id = $branches_id", array());
        if($tableObj){
            
            $tableRow = $tableObj->fetch(PDO::FETCH_OBJ);
            // var_dump($tableRow);

            $branches_id = intval($tableRow->branches_id);

            // $weekday_pickup_start = intval($tableRow->weekday_pickup_start);
            // $weekday_pickup_end = intval($tableRow->weekday_pickup_end);
            // if($weekday_pickup_end<=2){
            //     $weekday_pickup_end += 24;
            // }
            // $currentHour = date('H');
            // if($currentHour<=2){
            //     $currentHour += 24;
            // }
            // if($currentHour<$weekday_pickup_start || $weekday_pickup_end<$currentHour){
            //     $pickupStr = '';
			// 	if($weekday_pickup_start<12){
			// 		if($weekday_pickup_start==0){$weekday_pickup_start = 12;}
			// 		$pickupStr .= "$weekday_pickup_start AM";
			// 	}
			// 	else{
			// 		$weekday_pickup_start -= 12;
			// 		if($weekday_pickup_start==0){$weekday_pickup_start = 12;}
			// 		$pickupStr .= "$weekday_pickup_start PM";
			// 	}
			// 	$pickupStr .= ' to ';
			// 	if($weekday_pickup_end<12){
			// 		if($weekday_pickup_end==0){$weekday_pickup_end = 12;}
			// 		$pickupStr .= "$weekday_pickup_end AM";
			// 	}
			// 	else{
			// 		$weekday_pickup_end -= 12;
			// 		if($weekday_pickup_end==0){$weekday_pickup_end = 12;}
			// 		$pickupStr .= "$weekday_pickup_end PM";
			// 	}

            //     $returnData['error'] = "Please make sure your pickup time will be $pickupStr";
                
            // }

            $returnData['branches_id'] = $branches_id;

        }
        $_SESSION["branches_id"] = $returnData['branches_id'];

        // var_dump($returnData);exit;

        return json_encode($returnData);
    }


    public function my_Order(){
        
        $payment_ref_id = $statusMsg = ''; 
        $status = 'error'; 
        
        if(isset($_SESSION["clientSecret"])){
            unset($_SESSION["clientSecret"]);
        }
        if(isset($_SESSION["paymentIntentId"])){
            unset($_SESSION["paymentIntentId"]);
        }
        if(isset($_SESSION["price"])){
            unset($_SESSION["price"]);
        }
        if(isset($_SESSION["branches_id"])){
            unset($_SESSION["branches_id"]);
        } 
        if(isset($_SESSION["customers_id"])){
            unset($_SESSION["customers_id"]);
        } 

        $returnHTML = $this->headerHTML();
        $returnHTML .= '<section class="othersBody">
            <div class="container">                
                <div class="row" id="capture">
                    <div class="col-12 col-lg-4 pbottom10">
                        <table width="100%" align="left" class="tableBorder" style="margin-top:10px;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;line-height: 30px;" class="bbottom" id="readyForPickup" colspan="7">Customer Information:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="timerColumn">
                                                    <div class="number">
                                                        <span id="minutes"><b>Customer Name</b></span>
                                                    </div> 
                                                    <div class="number">
                                                        <span id="customer_name_conf">&nbsp;</span>
                                                    </div>                                                   
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="timerColumn">
                                                    <div class="number">
                                                        <span id="seconds"><b>Customer Email</b></span>
                                                    </div>  
                                                    <div class="number">
                                                        <span id="customer_email_conf">&nbsp;</span>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                        <table width="100%" align="left" class="tableBorder" style="margin-top:10px;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;line-height: 30px;" class="bbottom" id="readyForTrack" colspan="7">Your Order Tracking No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="timerColumn row" style="font-size: 35px; padding:20px;">
                                                    <div class="number col-4 text-right">
                                                        <span id="minutes"><b>#</b></span>
                                                    </div> 
                                                    <div class="number col-8">
                                                        <span id="customer_order_track_no_conf" class="text-center font-weight-bold">&nbsp;</span>
                                                    </div>                                                   
                                                </div>
                                            </div>                                            
                                        </div>
                                    </td>
                                </tr>
                            </tbody>                            
                        </table>
                        <table width="100%" align="left" class="tableBorder mtop10">
                            <thead>
                                <tr>
                                    <th class="bbottom" colspan="7">Office Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="addressInformation">
                                    </td>
                                </tr>
                            </tbody>
                        </table>                        
                    </div>
                    <div class="col-12 col-lg-8 pbottom10" id="myOrderCarts"></div>                        
                </div>
            </div>
        </section>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>';
        $returnHTML .= $this->footerHTML();

		return $returnHTML;
	}


    public function getPOSInfo(){
        
        $POST = json_decode(file_get_contents('php://input'), true);
        
        $message = 'Sorry, could not check Phone number.';
        $savemsg = 'error';
        $newCustomerData = $newPOSData = $newBranchesData = array();
        $id = 0;
        $pos_id = intval(array_key_exists('pos_id', $POST)?$POST['pos_id']:0);
        $error = '';
        if($pos_id == 0){
            $message = 'Your cart information has been expired. Please create new Order.';
            $error = 'Error';
        }
        if(empty($error)){
            $baseURL = $GLOBALS['baseURL']??'';
            
            $posObj = $this->db->getObj("SELECT * FROM pos WHERE pos_id = :pos_id", array('pos_id'=>$pos_id));
            if($posObj){
                while($posRow = $posObj->fetch(PDO::FETCH_OBJ)){
                    
                    $customersObj = $this->db->getObj("SELECT * FROM customers WHERE customers_id = :customers_id AND customers_publish = 1", array('customers_id'=>$posRow->customers_id));
                    if($customersObj){
                        while($oneRow = $customersObj->fetch(PDO::FETCH_OBJ)){
                            $newCustomerData = (array)$oneRow;
                        }
                    }

                    $branchesObj = $this->db->getObj("SELECT * FROM branches WHERE branches_id = :branches_id AND branches_publish = 1", array('branches_id'=>$posRow->branches_id));
                    if($branchesObj){
                        while($oneRow = $branchesObj->fetch(PDO::FETCH_OBJ)){
                            $newBranchesData = array('name'=>stripslashes(trim($oneRow->name)), 'address'=>nl2br(stripslashes(trim($oneRow->address))), 'working_hours'=>nl2br(stripslashes(trim($oneRow->working_hours))), 'google_map'=>stripslashes(trim($oneRow->google_map)));
                        }
                    }

                    $cartData = array();
                    $cartObj = $this->db->getObj("SELECT * FROM pos_cart WHERE pos_id  = :pos_id", array('pos_id'=>$posRow->pos_id));
                    if($cartObj){
                        while($cartRow = $cartObj->fetch(PDO::FETCH_OBJ)){
                            
                            $cartCMOData = array();
                            
                            // $cartCMOObj = $this->db->getObj("SELECT * FROM pos_cart_cmo WHERE pos_cart_id  = :pos_cart_id", array('pos_cart_id'=>$cartRow->pos_cart_id));
                            // if($cartCMOObj){
                            //     while($cartCMORow = $cartCMOObj->fetch(PDO::FETCH_OBJ)){
                            //         $cartCMOData[$cartCMORow->pos_cart_cmo_id] = (array)$cartCMORow;
                            //     }
                            // }

                            //########################################################
                            // $prodImg = 'pest.png';
                            // $defaultImageSRC = "website_assets/images/$prodImg";
                            
                            // $prodPictures = array();
                            // $prodPictures[0] = array($prodImg, $defaultImageSRC);
                            // $prodPictures[1] = array($prodImg, $defaultImageSRC);
                            
                            // $filePath = "./assets/accounts/srvn_$services_id".'_';
                            // $pics = glob($filePath."*.jpg");
                            // if(!$pics){
                            //     $pics = glob($filePath."*.png");
                            // }
                            // if($pics){
                            //     $l = 0;
                            //     foreach(array_slice($pics, 0, 2) as $onePicture){
                            //         $prodImg = str_replace("./assets/accounts/", '', $onePicture);
                            //         $prodImgUrl = str_replace('./', '/', $onePicture);
                            //         $prodPictures[$l] = array($prodImg, $prodImgUrl);
                            //         $l++;
                            //     }
                            // }
                            //########################################################
                            
                            $product_id = $cartRow->item_id;
                            $prodImg = 'pest.png';
                            $defaultImageSRC = "$baseURL/website_assets/images/$prodImg";
                            
                            $prodPictures = array();
                            $prodPictures[0] = array($prodImg, $defaultImageSRC);
                            $prodPictures[1] = array($prodImg, $defaultImageSRC);
                            
                            $filePath = "./assets/accounts/serv_$product_id".'_';
                            $pics = glob($filePath."*.jpg");
                            if(!$pics){
                                $pics = glob($filePath."*.png");
                            }
                            if($pics){
                                $l = 0;
                                foreach(array_slice($pics, 0, 2) as $onePicture){
                                    $prodImg = str_replace("./assets/accounts/", '', $onePicture);
                                    $prodImgUrl = str_replace('./', '/', $onePicture);
                                    $prodPictures[$l] = array($prodImg, $prodImgUrl);
                                    $l++;
                                }
                            }
                            
                            $cartRow1 = array('pos_id'=>$cartRow->pos_id,
                                            'item_id'=>$cartRow->item_id,
                                            'item_type'=>$cartRow->item_type,
                                            'description'=>$cartRow->description,
                                            'choice_more'=>$cartRow->choice_more,
                                            'add_description'=>$cartRow->add_description,
                                            'sales_price'=>$cartRow->sales_price,
                                            'qty'=>$cartRow->qty,
                                            'shipping_qty'=>$cartRow->shipping_qty,
                                            'return_qty'=>$cartRow->return_qty,
                                            'ave_cost'=>$cartRow->ave_cost,
                                            'discount_is_percent'=>$cartRow->discount_is_percent,
                                            'discount'=>$cartRow->discount,
                                            'taxable'=>$cartRow->taxable,
                                            'prodPictures'=>$prodPictures
                                        );
                            $cartData[$cartRow->pos_cart_id] = array('cartRow'=>$cartRow1, 'cartCMOData'=>$cartCMOData);
                        }
                    }
                    $newPOSData = array('posData'=>(array)$posRow, 'cartData'=>$cartData);
                }
            }
        }

        // var_dump($newPOSData);exit;

        return json_encode(array('login'=>'', 'posData'=>$newPOSData, 'customerData'=>$newCustomerData, 'branchesData'=>$newBranchesData));
    }


    public function checkRegistered(){

        $branches_id = $_SESSION["branches_id"]??1;
        $POST = json_decode(file_get_contents('php://input'), true);
        // var_dump($POST);

        $returnData = array();
		$returnData['login'] = '';
		$returnData['message'] = '';
		$returnData['savemsg'] = 'error';
		$returnData['branches_id'] = 0;
		$returnData['customers_id'] = 0;
        $returnData['stripe_client_secret'] = '';
        $returnData['paymentIntentId'] = '';

        $branches_id = intval(array_key_exists('branches_id', $POST)?$POST['branches_id']:$branches_id);
        $_SESSION["branches_id"] = $branches_id;
		$returnData['branches_id'] = $branches_id;

        $name = trim((string) array_key_exists('name', $POST)?$POST['name']:'');
        $contact_no = trim((string) array_key_exists('phone_number', $POST)?$POST['phone_number']:'');
        $expct_date = trim((string) array_key_exists('expct_date', $POST)?$POST['expct_date']:'');
        
        $email = trim((string) array_key_exists('email', $POST)?$POST['email']:'');
        $clientSecret = trim((string) array_key_exists('clientSecret', $POST)?$POST['clientSecret']:'');
        $paymentIntentId = trim((string) array_key_exists('paymentIntentId', $POST)?$POST['paymentIntentId']:'');
        $price = round(floatval(array_key_exists('amount', $POST)?$POST['amount']:0.00),2);
        
        $stripeCall = 0;

        // var_dump($_SESSION["clientSecret"]);exit;

        if(!isset($_SESSION["clientSecret"]) || $_SESSION["clientSecret"] != $clientSecret){
            $_SESSION["clientSecret"] = $clientSecret;
            $stripeCall++;
        }
        if(!isset($_SESSION["paymentIntentId"]) || $_SESSION["paymentIntentId"] != $paymentIntentId){
            $_SESSION["paymentIntentId"] = $paymentIntentId;
            $stripeCall++;
        }
        if(!isset($_SESSION["price"]) || $_SESSION["price"] != $price){
            $_SESSION["price"] = $price;
            $stripeCall++;
        }

        $error = '';
        if($name=='' || strlen($name)<4){
            $message = 'Name should be min 4 characters.';
            $error = 'Error';
        }
        elseif(strlen($name)>50){
            $message = 'Name should be max 50 characters';
            $error = 'Error';
        }

        if(strlen($contact_no)<9 || strlen($contact_no)>15){
            $message = 'Invalid Phone number.';
            $error = 'Error';
        }

        if($email=='' || strlen($email)<6){
            $message = 'Email should be min 6 characters.';
            $error = 'Error';
        }
        elseif(strlen($email)>50){
            $message = 'Email should be max 50 characters';
            $error = 'Error';
        }

        // if($expct_date=='' || strlen($expct_date)<6){
        //     $message = 'Expected date required.';
        //     $error = 'Error';
        // }
        // elseif(strlen($expct_date)>15){
        //     $message = 'Expected date should be max 15 characters';
        //     $error = 'Error';
        // }

        
        if(empty($error)){

            $sqlCustomers = "SELECT customers_id FROM customers WHERE contact_no = :contact_no AND email = :email";
            $tableObj = $this->db->getObj($sqlCustomers, array('contact_no'=>$contact_no, 'email'=>$email));
            if($tableObj){
                $customers_id = intval($tableObj->fetch(PDO::FETCH_OBJ)->customers_id);
                if($customers_id>0){
                    $this->db->update('customers', array('name'=>$name,'email'=>$email,'phone'=>$contact_no,'branches_id'=>$branches_id,'customers_publish'=>1), $customers_id);
                    $returnData['customers_id'] = $customers_id;
                    $returnData['savemsg'] = 'Old';
                }
            }

            if($returnData['customers_id']==0){
                $customersdata = array( 'customers_publish'=>1,
                                'created_on' => date('Y-m-d H:i:s'),
                                'last_updated' => date('Y-m-d H:i:s'),
                                'users_id'=>0,
                                'name'=>$name,
                                'phone'=>$contact_no,
                                'email'=>$email,
                                'address'=>'n/a',
                                'offers_email'=>0,
                                'company'=>'n/a',
                                'contact_no'=>$contact_no,
                                'secondary_phone'=>'',                                
                                'fax'=>'',                                
                                'shipping_address_one'=>'',
                                'shipping_address_two'=>'',
                                'shipping_city'=>'',
                                'shipping_state'=>'',
                                'shipping_zip'=>'',
                                'shipping_country'=>'',
                                'custom_data'=>'',
                                'alert_message'=>'',
                                'branches_id'=>$branches_id,
                                'sales_tax_name'=>'',
                                'sales_tax_rate'=>0.00
                                );
                $customers_id = $this->db->insert('customers', $customersdata);

                // var_dump($customersdata);exit;

                if($customers_id){
                    $returnData['savemsg'] = 'Add';
                    $returnData['customers_id'] = $customers_id;
                }
            }

            if($returnData['customers_id']>0){
                $_SESSION["customers_id"] = $customers_id;
                // var_dump($_SESSION["customers_id"]);exit;
                // if($stripeCall>0){
                    // var_dump('stripe');exit;
                    $Stripe = new Stripe($this->db);
                    // var_dump('stripe2');exit;
                    $getPaymentIntentData = $Stripe->getPaymentIntent($customers_id, $price);
                    $this->db->writeIntoLog("getPaymentIntentData:".json_encode($getPaymentIntentData));
                    $_SESSION["clientSecret"] = $getPaymentIntentData['stripe_client_secret'];
                    $_SESSION["paymentIntentId"] = $getPaymentIntentData['paymentIntentId'];                    
                // }
                // var_dump('no stripe');exit;

                $returnData['stripe_client_secret'] = $_SESSION["clientSecret"];
                $returnData['paymentIntentId'] = $_SESSION["paymentIntentId"];
            }
        }
        else{
            $returnData['message'] =  $message;
		    $returnData['savemsg'] = 'error';
        }

        return json_encode($returnData);
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

                                                            $serviceImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"$teamImgUrl\"  style=\"border-radius: 20px; margin: 4px; max-width: 500px;\">";

                                                        }

                                                        else{

                                                            $serviceImg = "<img alt=\"".strip_tags(addslashes($onePageRow->name))."\" src=\"/assets/admin/images/event/1.jpg\"  >";

                                                        } 



                                                        $returnHTML .= "<!--div class=\"card-content col-md-12\" style=\"padding:20px; border:0px solid red;\">

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

                                                        </div-->";

                                            
                                                    
                    
                                                        $returnHTML .= "                                                                                 
                    
                    
                                                                <div class=\"row col-md-12\" style=\"border:0px solid red !important;\">
                    
                                                                    <div class=\"row col-md-12\" style=\"margin-top:20px;\">
                    
                                                                            <div class=\"wrap_text about-area col-md-12\" style=\"border:0px solid red;\">
                                                                                <div class=\"floated\">
                                                                                $serviceImg
                                                                                </div>
                                                                                <h2 style=\"text-transform: uppercase; border:0px solid red;\" class=\"section-title mb-20 wrap_title\">".nl2br(trim(stripslashes($onePageRow->name)))."</h2> ".
                                                                                "<p>&nbsp;</p>
                                                                                <p><span style='font-weight:bold;'>Designation: </span>".nl2br(trim(stripslashes($onePageRow->address)))."</p>
                                                                                <p>&nbsp;</p>
                                                                                <p><span style='font-weight:bold;'>Email: </span><a class='text-dark' href='mailto:.$onePageRow->email.'>".nl2br(trim(stripslashes($onePageRow->email)))."</a></p>
                                                                                <p>&nbsp;</p>
                                                                                <p><span style='font-weight:bold;'>Phone: </span><a class='text-dark' href='tel:.$onePageRow->phone.'>".nl2br(trim(stripslashes($onePageRow->phone)))."</a></p>
                                                                                <p>&nbsp;</p>
                                                                                <p><span style='font-weight:bold;'>About: </span></p>
                                                                                <p>&nbsp;</p>".
                                                                                nl2br(trim(stripslashes($onePageRow->description))).
                                                                                "</div> 
                    
                                                                    </div>                                               
                    
                                                                </div> ";




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


    public function checkout(){

        $customers_id = $_SESSION["customers_id"]??0;
        $branches_id = $_SESSION["branches_id"]??0;
        // var_dump($_SESSION);exit;
        
        $first_name = $email = $contact_no = '';
        if($customers_id>0){
            $customersObj = $this->db->getObj("SELECT name, email, phone, branches_id FROM customers WHERE customers_id = $customers_id", array());
            if($customersObj){
                while($oneRow = $customersObj->fetch(PDO::FETCH_OBJ)){
                    $first_name = $oneRow->name;
                    $email = $oneRow->email;
                    $contact_no = $oneRow->contact_no;
                    if($branches_id==0){
                        $branches_id = $oneRow->branches_id;
                        $_SESSION["branches_id"] = $branches_id;
                    }
                }
            }
        }

        $returnHTML = $this->headerHTML();
        
        $baseURL = $GLOBALS['baseURL']??'';
        $returnHTML .= '<section class="othersBody">
            <div class="container">
                
                <form action="/confirmCheckOut" id="confirmCheckOut" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-12 col-lg-8 ptop15 pbottom10" id="checkOutCarts"></div>

                        <div class="col-12 col-lg-4 ptop15 pbottom10">
                            <div class="w100Per">
                                <span class="errorMsg lineHeight30 padding20" style="display:none" id="error_form"></span>
                                <span class="successMsg lineHeight30 padding20" style="display:none" id="success_form"></span>
                            </div>
                            <div class="page-body checkout-data">
                                <ol class="checkoutSteps">

                                    <!-- Service Loication  Checkout Right Bar Start -->
                                    <li id="firstStep" class="tab-section allow active">
                                        <div class="step-title">
                                            <div class="step-title-info cursor" onclick="checkOutStepsUpDown(\'firstStep\', 1)">
                                                <span class="check"><i class="fa fa-check"></i></span>
                                                <span class="number">1.</span>
                                                <h2 class="title mbottom0">Service Info</h2>
                                            </div>
                                        </div>
                                        <div class="step-details">
                                            <div class="page-body">
                                                <div class="col-12">';
                                                    $tableObj = $this->db->getObj("SELECT branches_id, name, address FROM branches WHERE branches_publish =1", array());
                                                    if($tableObj){
                                                        while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
                                                            $checked = '';
                                                            if($branches_id==$oneRow->branches_id){
                                                                $checked = ' checked="checked"';
                                                            }
                                                            $returnHTML .= '<div class="inputs" style="display:none">
                                                                <label class="cursor pleft20" for="branches_'.$oneRow->branches_id.'">
                                                                <p><input'.$checked.' checked type="radio" class="radioBtn" style="margin-left:-35px" id="branches_'.$oneRow->branches_id.'" name="branches_id" value="'.$oneRow->branches_id.'"> '.trim(stripslashes($oneRow->name)).nl2br(strip_tags(trim(stripslashes($oneRow->address)))).'</p>
                                                                </label>
                                                            </div>';

                                                        }
                                                    }

                                                    $returnHTML .= '<div class="inputs">
                                                        <label for="expct_date"><b>Expected Date</b>: <br>
                                                        <span style="font-size:12px;color:#248ECE;">Choose your expected service date<span class="txtred">*</span></span></label>
                                                        <input required type="text" class="form-control height30 lineHeight30 DateField expct_date expct_date_txt" id="expct_date" name="expct_date">
                                                        
                                                        <span class="txtred" id="error_expct_date"></span>
                                                    </div>';                                                
                                                    

                                                    $returnHTML .= '<div class="buttons">
                                                        <button type="button" class="button-2 proceed-button" onclick="checkBranches(1)">Proceed</button>                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Service Provide Loication  Checkout Right Bar End -->

                                   
                                    <!-- Your Basic Info  Checkout Right Bar Start -->
                                    <li id="secondStep" class="tab-section">
                                        <div class="step-title">
                                            <div class="step-title-info cursor" onclick="checkOutStepsUpDown(\'secondStep\', 1)">
                                                <span class="check"><i class="fa fa-check"></i></span>
                                                <span class="number">2.</span>
                                                <h2 class="title mbottom0">Your Basic Info</h2>
                                            </div>
                                        </div>
                                        <div class="step-details" style="display:none">
                                            <div class="page-body">
                                                <div class="col-12" id="basicInformation">
                                                    <div class="inputs">
                                                        <label for="first_name">Name: <span class="txtred">*</span></label>
                                                        <input type="text" class="form-control height30 lineHeight30" required id="name" name="name" value="'.$first_name.'">
                                                        <span class="txtred" id="error_name"></span>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="phone_number">Enter Phone Number: <span class="txtred">*</span></label>
                                                        <input type="tel" class="form-control height30 lineHeight30" required="required" autofocus="autofocus" id="phone_number" name="phone_number" onKeyup="checkPhone(this, 0)" value="'.$contact_no.'">
                                                        <span class="txtred" id="error_phone_number"></span>
                                                    </div>
                                                    <div class="inputs">
                                                        <label for="email">Email: <span class="txtred">*</span></label>
                                                        <input type="email" class="form-control height30 lineHeight30" id="email" name="email" value="'.$email.'">
                                                        <span class="txtred" id="error_email"></span>
                                                    </div>
                                                    <div class="buttons">
                                                        <button type="button" class="button-2 proceed-button" onclick="checkRegistered()">Proceed</button>                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Your Basic Info  Checkout Right Bar End -->
                                    

                                    <!-- Payment Method  Checkout Right Bar Start -->
                                    <li id="thirdStep" class="tab-section">
                                        <div class="step-title">
                                            <div class="step-title-info cursor" onclick="checkOutStepsUpDown(\'thirdStep\', 1)">
                                                <span class="check"><i class="fa fa-check"></i></span>
                                                <span class="number">3.</span>
                                                <h2 class="title mbottom0">Payment Method</h2>
                                            </div>
                                        </div>
                                        <div class="step-details" style="display:none">
                                            <input type="hidden" name="amount_due" id="amount_due" value="0">
                                             <script src="https://js.stripe.com/v3/"></script>
                                             <input type="hidden" name="amount_due" id="amount_due" value="0">
                                            <div class="page-body">
                                                <div class="col-12">';

                                                    $clientSecret = $_SESSION["clientSecret"]??'';
                                                    $paymentIntentId = $_SESSION["paymentIntentId"]??'';

                                                    $returnHTML .= '<input type="hidden" name="clientSecret" id="clientSecret" value="'.$clientSecret.'">
                                                    <input type="hidden" name="paymentIntentId" id="paymentIntentId" value="'.$paymentIntentId.'">
                                                
                                                    <div id="paymentElement"></div>
                                                    <div class="buttons">
                                                        <button disabled id="submitBtn" class="btn btn-success mt-3">
                                                            <div class="spinner hidden" id="spinner"></div>
                                                            <span id="buttonText">Pay Now</span>
                                                        </button>                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Payment Method  Checkout Right Bar End -->


                                </ol>
                            </div>
                        </div>
                    </div>
                </form>
                
                <div id="frmProcess" class="hidden">
                    <span class="ring"></span> Processing...
                </div>
                <!-- Display re-initiate button -->
                <div id="payReinit" class="hidden">
                    <button class="btn btn-primary" onClick="window.location.href=window.location.href.split(\'?\')[0]"><i class="rload"></i>Re-initiate Payment</button>
                </div>
                ';
                $stripe_pkData = $pickupHoursData = array();
                $tableObj = $this->db->getObj("SELECT branches_id, stripe_pk, weekday_pickup_start, weekday_pickup_end FROM branches", array());
                if($tableObj){
                    while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
                        $stripe_pkData[$oneRow->branches_id] = $oneRow->stripe_pk;
                        $pickupHoursData[$oneRow->branches_id] = array($oneRow->weekday_pickup_start, $oneRow->weekday_pickup_end);
                    }
                }

                $returnHTML .= '
                
                <script>
                    let stripe_pkData = '.json_encode($stripe_pkData).';
                    let pickupHoursData = '.json_encode($pickupHoursData).';
                    		
                    //setTimeout(function() {
                        // document.getElementById("name").focus();
                        //loadDateFunction();
                    //}, 500);

                </script>
                <script src="/website_assets/js/checkout.js"></script>
                

            </div>
        </section>';
        $returnHTML .= $this->footerHTML();

		return $returnHTML;
	}


    public function confirmCheckOut(){
        
        $POST = json_decode(file_get_contents('php://input'), true);
        $this->db->writeIntoLog("confirmCheckOut=>POST:".json_encode($POST));
        
        // var_dump($POST);exit;

        $message = 'Sorry, could not save shipping address.';
        $savemsg = 'error';
        
        $pos_id = $paymentIntentId = 0;        
        $branches_id = $_SESSION["branches_id"]??0;        
        $customers_id = $_SESSION["customers_id"]??0;

        $cartsData = array_key_exists('cartsData', $POST) ? $POST['cartsData'] : array();
        $grandTotalPrice = array_key_exists('grandTotalPrice', $POST) ? $POST['grandTotalPrice'] :0;
        $subTotalPrice = array_key_exists('subTotalPrice', $POST) ? $POST['subTotalPrice'] :0;
        // var_dump($grandTotalPrice);exit;
        
        $paymentIntentId = trim(stripslashes((string) array_key_exists('paymentIntentId', $POST) ? $POST['paymentIntentId']:''));
        $paymentMethodId = trim(stripslashes((string) array_key_exists('paymentMethodId', $POST) ? $POST['paymentMethodId']:''));
        
        $subTotalPrice = floatval($POST['subTotalPrice']??0.00);
        $service_fee = floatval($POST['service_fee']??1.99);
        $tax1 = floatval($POST['tax1']??0.00);
        $expct_date = $POST['expct_date']??'0000-00-00 00:00:00.000';

        if($customers_id == 0){
            $message = 'Missing customer info.';
            $error = 'Error';
        }
        elseif(empty($cartsData)){
            $message = 'You have to add at least one Product.';
            $error = 'Error';
        }

        // var_dump(date('Y-m-d H:i:s', strtotime($expct_date)));exit;
        
        if(empty($error)){

            // var_dump('error empty');exit;

            $invoice_no = 1;
            $poObj = $this->db->getData("SELECT invoice_no FROM pos ORDER BY invoice_no DESC LIMIT 0, 1", array());
            if($poObj){
                $invoice_no = $poObj[0]['invoice_no']+1;
            }
            
            $posData = array('users_id' => 0,
                            'invoice_no' => $invoice_no,
                            'sales_datetime' => date('Y-m-d H:i:s'),
                            'customers_id' => $customers_id,
                            'service_fee' => 1.99,
                            'taxes_name1' => 'HST',
                            'taxes_percentage1' => 13.00,
                            'tax_inclusive1' => 0,

                            'order_status' => 0,

                            'pos_publish' => 1,
                            'created_on' => date('Y-m-d H:i:s'),
                            'last_updated' => date('Y-m-d H:i:s'),
                            'is_due' => 1,
                            'branches_id' => $branches_id,
                            'paymentIntentId' => $paymentIntentId,
                            'paymentMethodId' => $paymentMethodId,                            
                            'service_datetime' => date('Y-m-d H:i:s', strtotime($expct_date)),
                            // 'pos_type' => 'Sale',
                            // 'employee_id' => 0,
                            // 'pickup_minutes'=>15
                        );


            $pos_id = $this->db->insert('pos', $posData);

            // var_dump($pos_id);exit;

            if($pos_id>0){

                $amount_due = 0;

                foreach($cartsData as $product_id=>$cartInfo){

                    $productInfo = $cartInfo[0];
                    $productCMInfo = $cartInfo[1];

                    if(!empty($productInfo)){
                        $description = trim(stripslashes((string) $productInfo['name']));
                        $sku = trim(stripslashes((string) $productInfo['sku']));
                        $qty = intval($productInfo['qty']);
                        $newsales_price = floatval($productInfo['newsales_price']);
                        $regular_price = floatval($productInfo['regular_price']);
                        $product_prices_id = intval($productInfo['product_prices_id']);
                        $choice_more = count($productCMInfo);
                        $ave_cost = 0;
                        $sales_price = $newsales_price;
                        $insertdata = array('pos_id'=>$pos_id,
                                            'item_id'=>$product_id,
                                            // 'item_type'=>'product',
                                            'description'=>$description,
                                            // 'choice_more'=>$choice_more,
                                            // 'add_description'=>'',
                                            'sales_price'=>$regular_price,
                                            'qty'=>$qty,
                                            'shipping_qty'=>0,
                                            // 'return_qty'=>0,
                                            // 'ave_cost'=>$ave_cost,
                                            // 'discount_is_percent'=>1,
                                            // 'discount'=>0.00,
                                            // 'taxable'=>1
                                        );
                        $pos_cart_id = $this->db->insert('pos_cart', $insertdata);

                        if($pos_cart_id){

                            if($sales_price != $newsales_price){
                                $description .= " [$newsales_price]";
                                $this->db->update('pos_cart', array('description'=>$description, 'sales_price'=>$sales_price), $pos_cart_id);
                            }
                            $amount_due += round($regular_price * $qty, 2);

                        }
                    }
                    
                    // var_dump($amount_due);exit;

                    if(!empty($contact_no) || !empty($email)){
                        //if(!empty($contact_no))
                            //$this->sendSMSByPosId($pos_id);

                        //if(!empty($email))
                            //$this->jquery_sendposmail($pos_id, $email, $amount_due, 0);
                    }
                }

                $payment_amount = round($amount_due + $service_fee + $tax1,2);
                $ppData = array('pos_id' => $pos_id,
                            'payment_method' => 'Stripe',
                            'payment_amount' => round($payment_amount,2),	
                            'payment_datetime' => date('Y-m-d H:i:s'),
                            'drawer' => ''
                            );
                $this->db->insert('pos_payment', $ppData);

                // var_dump('Ok');exit;

                $savemsg = 'Added';
                $message = 'Your Order has been submit successfully. Within shortly, one of our order management will contact with you.';
                
                if(isset($_SESSION["clientSecret"])){
                    unset($_SESSION["clientSecret"]);
                }
                if(isset($_SESSION["paymentIntentId"])){
                    unset($_SESSION["paymentIntentId"]);
                }
                if(isset($_SESSION["price"])){
                    unset($_SESSION["price"]);
                }
                if(isset($_SESSION["branches_id"])){
                    unset($_SESSION["branches_id"]);
                } 

                //############################################################################################################

                $name = $email = $contact_no = '';
                if($customers_id>0){
                    $customersObj = $this->db->getObj("SELECT name, email, phone, branches_id FROM customers WHERE customers_id = $customers_id", array());
                    if($customersObj){
                        while($oneRow = $customersObj->fetch(PDO::FETCH_OBJ)){
                            $name = $oneRow->name;
                            $email = $oneRow->email;
                            $contact_no = $oneRow->contact_no;
                            if($branches_id==0){
                                $branches_id = $oneRow->branches_id;
                                $_SESSION["branches_id"] = $branches_id;
                            }
                        }
                    }
                }

                $branchesName = '';
                $queryObj = $this->db->getObj("SELECT name FROM branches WHERE branches_id = $branches_id", array());
                if($queryObj){
                    $branchesName = stripslashes(trim($queryObj->fetch(PDO::FETCH_OBJ)->name));
                }

                $POSTFIELDS = array();
                $POSTFIELDS['to'] = '/topics/admin-'.$branches_id;
                $POSTFIELDS['notification'] = array('body'=>"New Order # $invoice_no submitted from $name, $email, $contact_no at $branchesName, Please Accept/Cancel this Order.",
                                                'priority'=>'high',
                                                'subtitle'=>'Paradise Shawarma',
                                                'title'=>"New Order # $invoice_no submitted",
                                                );
                $POSTFIELDS['data'] = array('customerName'=>"$name, $email, $contact_no",
                                            'pos_id'=>$pos_id,
                                            'branches_id'=>$branches_id
                                            );
        
                $POSTFIELDSData = json_encode($POSTFIELDS);
                
                
                /**
                 * Messaging Notification Services
                 */
                //==========For Customer=============//
                // $headers = array( 'Authorization: key=AAAArlwdB-4:APA91bFG4WoYzCYYFqxt1mdVWiZEpS_Lx0DpXkLjmvGkywpwQewQQ366gUwd_p9SWmK9E-MnqVypyO7MleINCuf161NQ7HHHoWtq-Ekp6gdsot_PH81LxSvgqEDzKTrtLY8ql7L0PQJq',
                //                     'Content-Type: application/json');
                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                // curl_setopt($ch, CURLOPT_POST, true);
                // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDSData);

                // $response = curl_exec($ch);
                // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                // curl_close($ch);

                //=====================For Super Admin======================//
                // $POSTFIELDS['to'] = '/topics/admin-0';
        
                // $POSTFIELDSData = json_encode($POSTFIELDS);
                
                // $headers = array( 'Authorization: key=AAAArlwdB-4:APA91bFG4WoYzCYYFqxt1mdVWiZEpS_Lx0DpXkLjmvGkywpwQewQQ366gUwd_p9SWmK9E-MnqVypyO7MleINCuf161NQ7HHHoWtq-Ekp6gdsot_PH81LxSvgqEDzKTrtLY8ql7L0PQJq',
                //                     'Content-Type: application/json');
                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                // curl_setopt($ch, CURLOPT_POST, true);
                // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDSData);

                // $response = curl_exec($ch);
                // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                // curl_close($ch);

                // $this->db->writeIntoLog("httpCode: $httpCode, response:".json_encode($response));
                // $this->db->writeIntoLog("httpCode: $httpCode, response:".json_encode($response));
                /*####################* End Messaging Notification Services *######################*/


                /**
                 * Email Notification Services
                 */                
                $emailck = $email;
                $returnStr = '';
                
                if($emailck =='' || is_null($emailck)){
                    $returnStr = 'Could not send mail because of missing your email address.';
                }
                else{

                    //================ Test message ===================
                    // $msg = "First line of text\nSecond line of text";
                    // use wordwrap() if lines are longer than 70 characters
                    // $msg = wordwrap($msg,70);
                    // send email
                    // mail("imranmailbd@gmail.com","My subject",$msg);
                    ///===============================================

                    //======================For Customer====================//

                    //####################################
                    $fromName = trim(stripslashes($name));
                    $do_not_reply = $this->db->supportEmail('do_not_reply');
                    $email = $email;                 
                    $from = 'imran@sksoftsolutions.ca';   // $this->db->supportEmail('info');  //  "imran@sksoftsolutions.ca";  // //'info@sksoftsolutions.ca'; 
                    $subject = 'Service order place on '.LIVE_DOMAIN.' successfully'; 

                    // Set content-type header for sending HTML email 
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";                      
                    // $headers .= COMPANYNAME." <$do_not_reply>". "\r\n";   //X-Sender                   
                    // $headers .= "PHP/".phpversion() . "\r\n";   //X-Mailer                   
                    // $headers .= '1'. "\r\n";   //X-Priority                  
                    // $headers .= "text/html\r\n". "\r\n";   //Content-type                  
                    // $headers .= "Reply-To: ".$do_not_reply. "\r\n";   //Reply-To                  
                    // $headers .= "Organization: ".COMPANYNAME. "\r\n";   //Organization                  
                    // Additional headers 
                    $headers .= 'From: '.COMPANYNAME.'<'.$from.'>' . "\r\n"; 
                    // $headers .= 'Cc: imran@sksoftsolutions.ca' . "\r\n"; 
                    // $headers .= 'Bcc: imran@sksoftsolutions.ca' . "\r\n";                      
                    //#####################   
                     
                    $message = ' 
                    <html> 
                    <head> 
                        <title>Welcome to '.COMPANYNAME.'</title> 
                    </head> 
                    <body> 
                        <h1>Dear <i><strong>'.$fromName.'</strong></i>,<br />Thanks you for place your service order to '.COMPANYNAME.'! We received your request. Our agent will contact with you asap.<br /><br /></h1> 
                        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;">                             
                            <tr> 
                                <th>Your Name:</th><td>'.$fromName.'</td> 
                            </tr> 
                            <tr style="background-color: #e0e0e0;"> 
                                <th>Email:</th><td>'.$email.'</td> 
                            </tr> 
                            <tr style="background-color: #e0e0e0;"> 
                                <th>Your Tracking/Order No:</th><td>'.$invoice_no.'</td> 
                            </tr>                          
                            <tr style="background-color: #e0e0e0;"> 
                                <th>Thank you for the service request.</th><td>We will reply as soon as possible.</td> 
                            </tr>
                        </table> 
                    </body> 
                    </html>'; 

                    // var_dump($message);
                    // echo "<br>";
                    // var_dump($headers);
                    // echo "<br>";
                    // var_dump($email);exit;                    


                    if(mail($email, $subject, $message, $headers)){
                        
                        //=====================For Super Admin======================//
                        // Set content-type header for sending HTML email 
                        $fromName = COMPANYNAME; 
                        $do_not_reply = $this->db->supportEmail('do_not_reply'); 
                        $to = $this->db->supportEmail('info');   // 'imran.skitsbd@gmail.com';   //'user@example.com'; 
                        $cname = trim(stripslashes($name));  
                        $email = $email;
                        $subject = 'New Order # '.$invoice_no.' submitted'; 

                        $headersAdmin = array();
                        // $headersAdmin = "Organization: ".COMPANYNAME. "\r\n"; 
                        $headersAdmin = "MIME-Version: 1.0" . "\r\n"; 
                        $headersAdmin .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                        // $headersAdmin .= "X-Priority: 3" . "\r\n"; 
                        // $headersAdmin .= "X-Mailer: PHP".phpversion() . "\r\n";                         
                        // Additional headers 
                        $headersAdmin .= 'From: '.$cname.'<'.$email.'>' . "\r\n"; 
                        // $headersAdmin .= 'Cc: imran.skitsbd@gmail.com' . "\r\n"; 
                        // $headersAdmin .= 'Bcc: imran@sksoftsolutions.ca' . "\r\n";  
                        
                        $messageAdmin = ' 
                        <html> 
                        <head> 
                            <title>'.$subject.'</title> 
                        </head> 
                        <body> 
                            <h1>Dear Admin of <i><strong>'.COMPANYNAME.'</strong></i>,<br /></h1>
                            New Order submitted, Please Accept/Cancel this Order.<br /><br /> 
                            <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                                <tr> 
                                    <th>Order #</th><td>'.$invoice_no.'</td> 
                                </tr> 
                                <tr> 
                                    <th>Customer Name:</th><td>'.$name.'</td> 
                                </tr> 
                                <tr style="background-color: #e0e0e0;"> 
                                    <th>Customer Email:</th><td>'.$email.'</td> 
                                </tr> 
                                <tr style="background-color: #e0e0e0;"> 
                                    <th>Branch:</th><td>'.$branchesName.'</td> 
                                </tr> 
                                <tr style="background-color: #e0e0e0;"> 
                                    <th>Please take action him/her as soon as possible.</th><td>&nbsp;</td> 
                                </tr>
                            </table> 
                        </body> 
                        </html>'; 
                                     
                        // var_dump($messageAdmin);
                        // echo "<br>";
                        // var_dump($headersAdmin);
                        // echo "<br>";
                        // var_dump($to);exit;
                        
                        mail($to, $subject, $messageAdmin, $headersAdmin);
                        //==============================================================
                        
                    }
                    else{
                        $returnStr = "Sorry! Could not send mail. Try again later.";
                    }
                }

                
                

                /*###################* End Email Notification Services *#######################*/

            }
        }
        
        //$newCustomerData = $newPOSData
        return json_encode(array('login'=>'', 'savemsg'=>$savemsg, 'pos_id'=>$pos_id, 'message'=>$message));

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


    public function bussinessFormationServices(){ 

        

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
    
                                <div class="single-card-pages card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
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
    
                                <div class="single-card-pages card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
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
    
                                <div class="single-card-pages card-style-one mb-3" style="border:0px solid red; padding-top:0px !important;">
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
            
                                                                        <p class="card-text mb-1">'.$short_description.'</p>
                                                                        
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

    public function nuansService(){

        

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }



        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="contact-form-section background_srv" >

            <div class="container">

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $returnHTML .= "

                                    <div class=\"row\">

                                        <div class=\"col-md-12 mb-2 ml-2\" style=\"border:0px solid red !important; align:center;\">
                                            <div class=\"progress\" style=\"border-radius:12px !important; border:2px solid #505050 !important; background-color:#c0c0c0; padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px !important; height:30px !important;\">
                                                <div class=\"progress-bar progress-bar-striped active progress-style\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                            </div>
                                        </div>";

                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:10px !important;\">";
                                          
                                        $returnHTML .= $this->sidebarHTML();   

                                        $returnHTML .= '</div>  

                                        <div class="row col-md-9" style="border:0px solid red !important;">';



                                                $returnHTML .= '<!-- start contact  -->
                                                                <div class="pageTransBody">
                                                                    <div class="row mt-5" style="margin:0 auto;margin-top:0px !important;">

                                                                        <div class="u-section-1">

                                                                            <div class="col-md-12 sec-title text-center" style="border:0px solid red; margin-left:0px; margin-top:5px !important;margin-bottom:0px !important;">

                                                                                <!--h2 class="section-title">CONTACT US TODAY TO MAKE AN APPOINTMENT!</h2>

                                                                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span-->

                                                                                <h6 class="text-justify" style="font-weight:900 !important;">NUANS® Search Report $12.80. Email delivery in 30 minutes (no extra payment)</h6>
                                                                                <hr>
                                                                                <p class="text-justify"> 
                                                                                As a member of NUANS Canada, Incorp Pro offers the Nuans Search Report at the government rate of $12.80, without any additional agency fees. Our service includes up to 3 free preliminary searches and examinations of names before reserving the name. 

                                                                                </p>

                                                                            </div> 

                                                                            <div id="contact" class="col-md-12" style="border:0px solid red; ">

                                                                                                                                                                   
                                                                                    <form id="user_form" novalidate action="form_action.php"  method="post">	
                                                                                         
                                                                                        <fieldset>
                                                                                            
                                                                                            <!--h2>Step 1: Add Account Details</h2-->

                                                                                            <div class="row my-3">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Choose Business Jurisdiction <span class="required">*</span></label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">Ontario $12.80</span> 
                                                                                                    </label>
                                                                                            
                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Alberta $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Federal (Canada) $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Prince Edward Island $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">New Brunswick $12.80</span>
                                                                                                    </label>
                                                                                                    
                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Other Regions</span>
                                                                                                    </label>
                                                                                                    
                                                                                                <li id="" style="padding-left:0px !important;" class="col-md-12 text-justify">
                                                                                                    <b><u>Disclaimer on 30-minute service</u></b>: 30-minute delivery time applies when the order is placed within our usual business hours, from 8:00 AM to 8:00 PM, Eastern Time, Monday through Friday. If orders come in after business hours, they will be processed in the first 30 minutes of the subsequent business day. 
                                                                                                </li>

                                                                                            </div>                                                                                          
                                                                                            
                                                                                            <input type="button" class="next btn-color mt-3" value="Next" />

                                                                                       </fieldset>  

                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3" > Proposed Name</h5>
                                                                                            <hr style="margin-top:7px !important;">
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Write the name you want to search and reserve</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Choose the legal suffix</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">Inc.</option>                                                                                                           
                                                                                                            <option value="inc">Ltd.</option>                                                                                                           
                                                                                                            <option value="inc">Corp.</option>                                                                                                           
                                                                                                            <option value="inc">Limited</option>                                                                                                           
                                                                                                            <option value="inc">Incorporated</option>                                                                                                           
                                                                                                            <option value="inc">Corporation</option>                                                                                                            
                                                                                                            <option value="inc">Ltee</option>                                                                                                            
                                                                                                            <option value="inc">Limitee</option>                                                                                                            
                                                                                                            <option value="inc">Incorporee</option>                                                                                                            
                                                                                                            <option value="inc">None</option>                                                                                                            

                                                                                                        </select>
                                                                                                    
                                                                                                </div>

                                                                                                <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                                    Note: In case you intend to use it in incorporation context (like a new corporation or corporate name change), it is compulsory to select one of the provided legal suffixes. Despite their similar legal implications, the selection depends solely on the preferred look. Conversely, when this name is aimed for non-incorporation use (for instance, sole proprietorship, master business license, trade name, or non-profit), opt for "none". 
                                                                                                </li>
                                                                                            </div>    
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">What is purpose of this name report?</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                    
                                                                                                        <select name="purpose" class="form-control select-box">

                                                                                                            <option value="inc">New corporations name</option>                                                                                                           
                                                                                                            <option value="inc">Corporations name change</option>                                                                                                           
                                                                                                            <option value="inc">Use as sole proprietorship</option>                                                                                                           
                                                                                                            <option value="inc">Use for master business license</option>                                                                                       

                                                                                                        </select>
                                                                                                    
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="major_activity" class="setp-field-lbl">Describe the major activities of this business</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc; " type="text" id="major_activity" name="major_activity" class="form-control srfrm_input" placeholder="Major Activity" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Next" />

                                                                                        </fieldset>
                                                                                    
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Business Registry Service Update</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                            As per latest update, a business can be registered or incorporated online bypassing the Nuans search report. In express queue, the Certificate and Articles of Incorporation are delivered in 2 business hours via email. The process also allows to add other filing such as initial return, HST & WSIB accounts etc. 
                                                                                            </li>
                                                                                            
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-3 col-sm-12">
                                                                                                    <label class="setp-field-lbl">Choose an option <span class="required">*</span></label>
                                                                                                </div>

                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80" checked="checked" id="" tabindex="2">
                                                                                                        <span class="ms-3">Obtain Nuans report with payment</span>
                                                                                                </label>

                                                                                                                                                                                        
                                                                                                <div class="col-lg-3 col-sm-12">
                                                                                                    <label class="label-width fw-bold">&nbsp;</label>
                                                                                                </div>
                                                                                                
                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80"  id="" tabindex="1">
                                                                                                        <span class="ms-3">Bypass Nuans and Register Your Business</span> 
                                                                                                </label>
                                                                                                

                                                                                            </div> 
                                                                                    
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Final Review" />

                                                                                            

                                                                                        </fieldset>
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Final Review</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Proposed Name</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose the legal suffix</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Inc.</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Whats purpose of this name report?</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">New corporations name</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Business Registry Service Update</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose an option</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Obtain Nuans report with payment</font>
                                                                                                    </td>
                                                                                                </tr>                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td colspan="2" style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>&nbsp;</strong></font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-4 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" class="text-center" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px"><strong>Your Order Details</strong></td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">                                                                                                    
                                                                                                    <td colspan="2">
                                                                                                        <table cellspacing="0" width="100%" style="border-left:1px solid #DFDFDF; border-top:1px solid #DFDFDF">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:12px; text-align:left">Product</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:50px; font-family: sans-serif; font-size:12px; text-align:center">Qty</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Unit Price</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Price</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody><tr>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:11px;">
                                                                                                                                    <strong style="color:#BF461E; font-size:12px; margin-bottom:5px">Alberta $12.80</strong>
                                                                                                                                    <ul style="margin:0"></ul>
                                                                                                                                </td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:center; width:50px; font-family: sans-serif; font-size:11px;">1</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                            </tr></tbody>
                                                                                                        <tfoot>
                                                                                                            <tr>
                                                                                                                <td colspan="3" style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:right; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">Total:</strong></td>
                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">$ 12.80 CAD</strong></td>
                                                                                                            </tr>
                                                                                                        </tfoot>
                                                                                                        </table>
                                                                                                    </td>
                                                                            
                                                                                                </tr>
                                                                                            </tbody>
                                                                                         </table>

                                                                                            <input type="hidden" id="services_id" name="services_id" value="1">
                                                                                            <input type="hidden" id="services_price" name="services_price" value="12.80">
                                                                                            <input type="hidden" id="services_name" name="services_name" value="Nuans Report">
                                                                                            <input type="hidden" id="returnYN" value="1">

                                                                                            <input type="button" name="previous" class="previous btn-color" value="Go To Business Register Page" />
                                                                                            <!--input type="submit" name="submit" class="submit btn btn-danger" value="Proceed To Pay" /-->
                                                                                            <input type="button" onclick="addToCart(1, \'Nuans Report\', 12.80,\'./assets/accounts/serv_1_805.png\');" tabindex="0" class="submit btn-color" value="Proceed To Pay" />

                                                                                            

                                                                                        </fieldset>


                                                                                    </form> 
                                                                                    

                                                                                   
                                                                                
                                                                            </div>
                                                                            <!--script-- src="/assets/js/mathCaptcha.js"></script>t-->
                                                                            <!--script src="/website_assets/js/script.js"></script>
                                                                            <!--script src="/website_assets/js/checkout.js"></!--script-->
                                                                            

                                                                        </div>

                                                                    </div> 
                                                                </div>
                                                                <!-- end contact  -->';                                     

                                                $returnHTML .= '
                                        </div>

                                    </div>    
                                    
                        </div>
                    </div>
                </div>            


            </div>

        </section>';

        $returnHTML .= $this->footerHTML();
        $returnHTML .= '
        <script src="/website_assets/js/multi_step_form.js"></script>

        <!--script src="/website_assets/js/checkout.js"></script-->';



		return $returnHTML;

    }

    public function soleproprietorshipService(){

        

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }



        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="contact-form-section background_srv" >

            <div class="container">

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $returnHTML .= "

                                    <div class=\"row\">

                                        <div class=\"col-md-12 mb-2 ml-2\" style=\"border:0px solid red !important; align:center;\">
                                            <div class=\"progress\" style=\"border-radius:12px !important; border:2px solid #505050 !important; background-color:#c0c0c0; padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px !important; height:30px !important;\">
                                                <div class=\"progress-bar progress-bar-striped active progress-style\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                            </div>
                                        </div>";

                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:10px !important;\">";
                                          
                                        $returnHTML .= $this->sidebarHTML();   

                                        $returnHTML .= '</div>  

                                        <div class="row col-md-9" style="border:0px solid red !important;">';

                                                $returnHTML .= '<!-- start contact  -->
                                                                <div class="pageTransBody">
                                                                    <div class="row mt-5" style="margin:0 auto;margin-top:0px !important;">

                                                                        <div class="u-section-1">

                                                                            <div class="col-md-12 sec-title text-center" style="border:0px solid red; margin-left:0px; margin-top:5px !important;margin-bottom:0px !important;">

                                                                                <!--h2 class="section-title">CONTACT US TODAY TO MAKE AN APPOINTMENT!</h2>

                                                                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span-->

                                                                                <h6 class="text-justify" style="font-weight:900 !important;">Register or Renew a Sole proprietorship.</h6>
                                                                                <hr>
                                                                                <p class="text-justify"> 
                                                                                We are a registered member of Corporations Canada. As a customer, all you need to do is, to fill out this form and pay. We can register your business as fast as in 2 business hours (certain provinces). You will receive the final documents in your email.
                                                                                </p>

                                                                            </div> 

                                                                            <div id="contact" class="col-md-12" style="border:0px solid red; ">

                                                                                                                                                                   
                                                                                    <form id="user_form" novalidate action="form_action.php"  method="post">	
                                                                                         
                                                                                        <fieldset>
                                                                                            
                                                                                            <!--h2>Step 1: Add Account Details</h2-->

                                                                                            <div class="row my-3">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-5 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Agency Service Fees</label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-7 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3"> $49</span> 
                                                                                                    </label>                                                                                
                                                                                            </div>  
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Govt, Admin & Registry Fees</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">Alberta $75</option>                                                                                                           
                                                                                                            <option value="inc">British Columbia $75</option>                                                                                                           
                                                                                                            <option value="inc">Ontario $75</option>                                                                                                         

                                                                                                        </select>
                                                                                                    
                                                                                                </div>
                                                                                                <div class="row my-3">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-5 col-sm-12">
                                                                                                        <label class="setp-field-lbl">How fast do you need to register?</label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-7 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">Urgent: Ready in ONE HOUR +$99</span> 
                                                                                                    </label>                                                                                            
                                                                                                    <div class="col-lg-5 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-7 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Express: Ready in ONE DAY +$49</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-5 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-7 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Regular: Ready in Five Days +$00</span>
                                                                                                    </label>
                                                                                                </div> 

                                                                                                
                                                                                            </div>                                                                                        
                                                                                            
                                                                                            <input type="button" class="next btn-color mt-3" value="Next" />

                                                                                       </fieldset>  

                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3" > Business Name</h5>
                                                                                            <hr style="margin-top:7px !important;">
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">New registration or renewal?</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">New Registration</option>                                                                                                           
                                                                                                            <option value="inc">Renew of Existing Registration</option>                                                                                   

                                                                                                        </select>
                                                                                                    
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">NUANS Report & Name Approval</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">Obtain NUANS & Name Approval for me $12.80</option>                                                                                                           
                                                                                                            <option value="inc">I have NUANS, Need only Name Approval $00</option>                                                                                   

                                                                                                        </select>
                                                                                                    
                                                                                                </div>                                                                                                
                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Proposed name of this business</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Next" />

                                                                                        </fieldset>
                                                                                    
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Business Details</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Activities of this Business</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label class="setp-field-lbl">Business Address</label>
                                                                                                </div>

                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Street Address" required>                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label class="setp-field-lbl">&nbsp;</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Suit/Unit" required>                                                                                                    
                                                                                                </div>
                                                                                            </div>    
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label class="setp-field-lbl">&nbsp;</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="City" required> 
                                                                                                                                                                                                          
                                                                                                </div> 
                                                                                            </div> 
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label class="setp-field-lbl">&nbsp;</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">Obtain NUANS & Name Approval for me $12.80</option>                                                                                                           
                                                                                                            <option value="inc">I have NUANS, Need only Name Approval $00</option>                                                                                   

                                                                                                        </select>                                                                                                   
                                                                                                </div> 
                                                                                            </div>

                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Business Owner: First Name</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Middle Name (if any)</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>                                                                                                    
                                                                                                </div>
                                                                                            </div> 
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Last Name</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>                                                                                                    
                                                                                                </div>
                                                                                            </div> 

                                                                                    
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Final Review" />

                                                                                            

                                                                                        </fieldset>
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Final Review</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Register or Renew a Sole proprietorship.</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Agency Service Fees</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">$49</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Govt, Admin & Registry Fees</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">$60</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Business Name</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>New registration or renewal?</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">New registration</font>
                                                                                                    </td>
                                                                                                </tr>                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td colspan="2" style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>&nbsp;</strong></font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-4 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" class="text-center" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px"><strong>Your Order Details</strong></td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">                                                                                                    
                                                                                                    <td colspan="2">
                                                                                                        <table cellspacing="0" width="100%" style="border-left:1px solid #DFDFDF; border-top:1px solid #DFDFDF">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:12px; text-align:left">Product</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:50px; font-family: sans-serif; font-size:12px; text-align:center">Qty</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Unit Price</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Price</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody><tr>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:11px;">
                                                                                                                                    <strong style="color:#BF461E; font-size:12px; margin-bottom:5px">Alberta $12.80</strong>
                                                                                                                                    <ul style="margin:0"></ul>
                                                                                                                                </td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:center; width:50px; font-family: sans-serif; font-size:11px;">1</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 109 CAD</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 109 CAD</td>
                                                                                                                            </tr></tbody>
                                                                                                        <tfoot>
                                                                                                            <tr>
                                                                                                                <td colspan="3" style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:right; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">Total:</strong></td>
                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">$ 109 CAD</strong></td>
                                                                                                            </tr>
                                                                                                        </tfoot>
                                                                                                        </table>
                                                                                                    </td>
                                                                            
                                                                                                </tr>
                                                                                            </tbody>
                                                                                         </table>

                                                                                            <input type="hidden" id="services_id" name="services_id" value="2">
                                                                                            <input type="hidden" id="services_price" name="services_price" value="109">
                                                                                            <input type="hidden" id="services_name" name="services_name" value="Sole Proprietorship">
                                                                                            <input type="hidden" id="returnYN" value="1">

                                                                                            <input type="button" name="previous" class="previous btn-color" value="Go To Business Register Page" />
                                                                                            <!--input type="submit" name="submit" class="submit btn btn-danger" value="Proceed To Pay" /-->
                                                                                            <input type="button" onclick="addToCart(1, \'Nuans Report\', 12.80,\'./assets/accounts/serv_2_833.png\');" tabindex="0" class="submit btn-color" value="Proceed To Pay" />

                                                                                            

                                                                                        </fieldset>


                                                                                    </form> 
                                                                                    

                                                                                   
                                                                                
                                                                            </div>
                                                                            <!--script-- src="/assets/js/mathCaptcha.js"></script>t-->
                                                                            <!--script src="/website_assets/js/script.js"></script>
                                                                            <!--script src="/website_assets/js/checkout.js"></!--script-->
                                                                            

                                                                        </div>

                                                                    </div> 
                                                                </div>
                                                                <!-- end contact  -->';                                     

                                                $returnHTML .= '
                                        </div>

                                    </div>    
                                    
                        </div>
                    </div>
                </div>            


            </div>

        </section>';

        $returnHTML .= $this->footerHTML();
        $returnHTML .= '
        <script src="/website_assets/js/multi_step_form.js"></script>

        <!--script src="/website_assets/js/checkout.js"></script-->';



		return $returnHTML;

    }

    public function federalService(){

        

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }



        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="contact-form-section background_srv" >

            <div class="container">

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $returnHTML .= "

                                    <div class=\"row\">

                                        <div class=\"col-md-12 mb-2 ml-2\" style=\"border:0px solid red !important; align:center;\">
                                            <div class=\"progress\" style=\"border-radius:12px !important; border:2px solid #505050 !important; background-color:#c0c0c0; padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px !important; height:30px !important;\">
                                                <div class=\"progress-bar progress-bar-striped active progress-style\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                            </div>
                                        </div>";

                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:10px !important;\">";
                                          
                                        $returnHTML .= $this->sidebarHTML();   

                                        $returnHTML .= '</div>  

                                        <div class="row col-md-9" style="border:0px solid red !important;">';



                                                $returnHTML .= '<!-- start contact  -->
                                                                <div class="pageTransBody">
                                                                    <div class="row mt-5" style="margin:0 auto;margin-top:0px !important;">

                                                                        <div class="u-section-1">

                                                                            <div class="col-md-12 sec-title text-center" style="border:0px solid red; margin-left:0px; margin-top:5px !important;margin-bottom:0px !important;">

                                                                                <!--h2 class="section-title">CONTACT US TODAY TO MAKE AN APPOINTMENT!</h2>

                                                                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span-->

                                                                                <h6 class="text-justify" style="font-weight:900 !important;">Federal Named or Numbered Company can be ready in 2 Business Hours</h6>
                                                                                <hr>
                                                                                <p class="text-justify"> 
                                                                                It is a very simple form, guides you step by step and takes 10-15 minutes to complete. If you get stuck in any step, we have live chat and call support. Our legal and accounting team review all orders before registration. 

                                                                                </p>

                                                                            </div> 

                                                                            <div id="contact" class="col-md-12" style="border:0px solid red; ">

                                                                                                                                                                   
                                                                                    <form id="user_form" novalidate action="form_action.php"  method="post">	
                                                                                         
                                                                                        <fieldset>
                                                                                            
                                                                                            <!--h2>Step 1: Add Account Details</h2-->

                                                                                            <div class="row my-3">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Choose Business Jurisdiction <span class="required">*</span></label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">Ontario $12.80</span> 
                                                                                                    </label>
                                                                                            
                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Alberta $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Federal (Canada) $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Prince Edward Island $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">New Brunswick $12.80</span>
                                                                                                    </label>
                                                                                                    
                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Other Regions</span>
                                                                                                    </label>
                                                                                                    
                                                                                                <li id="" style="padding-left:0px !important;" class="col-md-12 text-justify">
                                                                                                    <b><u>Disclaimer on 30-minute service</u></b>: 30-minute delivery time applies when the order is placed within our usual business hours, from 8:00 AM to 8:00 PM, Eastern Time, Monday through Friday. If orders come in after business hours, they will be processed in the first 30 minutes of the subsequent business day. 
                                                                                                </li>

                                                                                            </div>                                                                                          
                                                                                            
                                                                                            <input type="button" class="next btn-color mt-3" value="Next" />

                                                                                       </fieldset>  

                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3" > Proposed Name</h5>
                                                                                            <hr style="margin-top:7px !important;">
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Write the name you want to search and reserve</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Choose the legal suffix</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">Inc.</option>                                                                                                           
                                                                                                            <option value="inc">Ltd.</option>                                                                                                           
                                                                                                            <option value="inc">Corp.</option>                                                                                                           
                                                                                                            <option value="inc">Limited</option>                                                                                                           
                                                                                                            <option value="inc">Incorporated</option>                                                                                                           
                                                                                                            <option value="inc">Corporation</option>                                                                                                            
                                                                                                            <option value="inc">Ltee</option>                                                                                                            
                                                                                                            <option value="inc">Limitee</option>                                                                                                            
                                                                                                            <option value="inc">Incorporee</option>                                                                                                            
                                                                                                            <option value="inc">None</option>                                                                                                            

                                                                                                        </select>
                                                                                                    
                                                                                                </div>

                                                                                                <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                                    Note: In case you intend to use it in incorporation context (like a new corporation or corporate name change), it is compulsory to select one of the provided legal suffixes. Despite their similar legal implications, the selection depends solely on the preferred look. Conversely, when this name is aimed for non-incorporation use (for instance, sole proprietorship, master business license, trade name, or non-profit), opt for "none". 
                                                                                                </li>
                                                                                            </div>    
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">What is purpose of this name report?</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                    
                                                                                                        <select name="purpose" class="form-control select-box">

                                                                                                            <option value="inc">New corporations name</option>                                                                                                           
                                                                                                            <option value="inc">Corporations name change</option>                                                                                                           
                                                                                                            <option value="inc">Use as sole proprietorship</option>                                                                                                           
                                                                                                            <option value="inc">Use for master business license</option>                                                                                       

                                                                                                        </select>
                                                                                                    
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="major_activity" class="setp-field-lbl">Describe the major activities of this business</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc; " type="text" id="major_activity" name="major_activity" class="form-control srfrm_input" placeholder="Major Activity" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Next" />

                                                                                        </fieldset>
                                                                                    
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Business Registry Service Update</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                            As per latest update, a business can be registered or incorporated online bypassing the Nuans search report. In express queue, the Certificate and Articles of Incorporation are delivered in 2 business hours via email. The process also allows to add other filing such as initial return, HST & WSIB accounts etc. 
                                                                                            </li>
                                                                                            
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-3 col-sm-12">
                                                                                                    <label class="setp-field-lbl">Choose an option <span class="required">*</span></label>
                                                                                                </div>

                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80" checked="checked" id="" tabindex="2">
                                                                                                        <span class="ms-3">Obtain Nuans report with payment</span>
                                                                                                </label>

                                                                                                                                                                                        
                                                                                                <div class="col-lg-3 col-sm-12">
                                                                                                    <label class="label-width fw-bold">&nbsp;</label>
                                                                                                </div>
                                                                                                
                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80"  id="" tabindex="1">
                                                                                                        <span class="ms-3">Bypass Nuans and Register Your Business</span> 
                                                                                                </label>
                                                                                                

                                                                                            </div> 
                                                                                    
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Final Review" />

                                                                                            

                                                                                        </fieldset>
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Final Review</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Proposed Name</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose the legal suffix</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Inc.</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Whats purpose of this name report?</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">New corporations name</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Business Registry Service Update</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose an option</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Obtain Nuans report with payment</font>
                                                                                                    </td>
                                                                                                </tr>                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td colspan="2" style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>&nbsp;</strong></font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-4 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" class="text-center" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px"><strong>Your Order Details</strong></td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">                                                                                                    
                                                                                                    <td colspan="2">
                                                                                                        <table cellspacing="0" width="100%" style="border-left:1px solid #DFDFDF; border-top:1px solid #DFDFDF">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:12px; text-align:left">Product</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:50px; font-family: sans-serif; font-size:12px; text-align:center">Qty</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Unit Price</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Price</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody><tr>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:11px;">
                                                                                                                                    <strong style="color:#BF461E; font-size:12px; margin-bottom:5px">Alberta $12.80</strong>
                                                                                                                                    <ul style="margin:0"></ul>
                                                                                                                                </td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:center; width:50px; font-family: sans-serif; font-size:11px;">1</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                            </tr></tbody>
                                                                                                        <tfoot>
                                                                                                            <tr>
                                                                                                                <td colspan="3" style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:right; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">Total:</strong></td>
                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">$ 12.80 CAD</strong></td>
                                                                                                            </tr>
                                                                                                        </tfoot>
                                                                                                        </table>
                                                                                                    </td>
                                                                            
                                                                                                </tr>
                                                                                            </tbody>
                                                                                         </table>

                                                                                            <input type="hidden" id="services_id" name="services_id" value="1">
                                                                                            <input type="hidden" id="services_price" name="services_price" value="12.80">
                                                                                            <input type="hidden" id="services_name" name="services_name" value="Nuans Report">
                                                                                            <input type="hidden" id="returnYN" value="1">

                                                                                            <input type="button" name="previous" class="previous btn-color" value="Go To Business Register Page" />
                                                                                            <!--input type="submit" name="submit" class="submit btn btn-danger" value="Proceed To Pay" /-->
                                                                                            <input type="button" onclick="addToCart(1, \'Nuans Report\', 12.80,\'./assets/accounts/serv_1_805.png\');" tabindex="0" class="submit btn-color" value="Proceed To Pay" />

                                                                                            

                                                                                        </fieldset>


                                                                                    </form> 
                                                                                    

                                                                                   
                                                                                
                                                                            </div>
                                                                            <!--script-- src="/assets/js/mathCaptcha.js"></script>t-->
                                                                            <!--script src="/website_assets/js/script.js"></script>
                                                                            <!--script src="/website_assets/js/checkout.js"></!--script-->
                                                                            

                                                                        </div>

                                                                    </div> 
                                                                </div>
                                                                <!-- end contact  -->';                                     

                                                $returnHTML .= '
                                        </div>

                                    </div>    
                                    
                        </div>
                    </div>
                </div>            


            </div>

        </section>';

        $returnHTML .= $this->footerHTML();
        $returnHTML .= '
        <script src="/website_assets/js/multi_step_form.js"></script>

        <!--script src="/website_assets/js/checkout.js"></script-->';



		return $returnHTML;

    }

    public function ontarioService(){

        

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }



        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="contact-form-section background_srv" >

            <div class="container">

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $returnHTML .= "

                                    <div class=\"row\">

                                        <div class=\"col-md-12 mb-2 ml-2\" style=\"border:0px solid red !important; align:center;\">
                                            <div class=\"progress\" style=\"border-radius:12px !important; border:2px solid #505050 !important; background-color:#c0c0c0; padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px !important; height:30px !important;\">
                                                <div class=\"progress-bar progress-bar-striped active progress-style\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                            </div>
                                        </div>";

                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:10px !important;\">";
                                          
                                        $returnHTML .= $this->sidebarHTML();   

                                        $returnHTML .= '</div>  

                                        <div class="row col-md-9" style="border:0px solid red !important;">';



                                                $returnHTML .= '<!-- start contact  -->
                                                                <div class="pageTransBody">
                                                                    <div class="row mt-5" style="margin:0 auto;margin-top:0px !important;">

                                                                        <div class="u-section-1">

                                                                            <div class="col-md-12 sec-title text-center" style="border:0px solid red; margin-left:0px; margin-top:5px !important;margin-bottom:0px !important;">

                                                                                <!--h2 class="section-title">CONTACT US TODAY TO MAKE AN APPOINTMENT!</h2>

                                                                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span-->

                                                                                <h6 class="text-justify" style="font-weight:900 !important;">Ontario Named or Numbered Company Can be Ready in 2 Business Hours</h6>
                                                                                <hr>
                                                                                <p class="text-justify"> 
                                                                                It is a very simple form, guides you step by step and takes 10-15 minutes to complete. If you get stuck in any step, we have live chat and call support. Our legal and accounting team review all orders before registration. 

                                                                                </p>

                                                                            </div> 

                                                                            <div id="contact" class="col-md-12" style="border:0px solid red; ">

                                                                                                                                                                   
                                                                                    <form id="user_form" novalidate action="form_action.php"  method="post">	
                                                                                         
                                                                                        <fieldset>
                                                                                            
                                                                                            <!--h2>Step 1: Add Account Details</h2-->

                                                                                            <div class="row my-3" style="margin-bottom:5px !important;">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Agency Filing Fees</label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">$49</span> 
                                                                                                    </label>
                                                                                            </div>
                                                                                            <div class="row my-3" style="margin-top:5px !important; margin-bottom:5px !important;">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Government Fees</label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">$300 (includes electronic filing fees)</span> 
                                                                                                    </label>
                                                                                            </div>
                                                                                            <div class="row my-3" style="margin-top:5px !important; margin-bottom:5px !important;">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Certificate of Incorporation</label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">Free (sent via email)</span> 
                                                                                                    </label>
                                                                                            </div>
                                                                                            <div class="row my-3" style="margin-top:5px !important; margin-bottom:5px !important;">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Standard Articles</label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">Free (sent via email)</span> 
                                                                                                    </label>
                                                                                            </div>
                                                                                            <div class="row my-3" style="margin-top:5px !important; margin-bottom:5px !important;">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Ontario Company Key</label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container" style="padding-left:0px !important;">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">Free (needed to update the corporation)</span> 
                                                                                                    </label>
                                                                                            </div>

                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-4 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Bylaws and Minute Book</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-8 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">No bylaws, no minute book+$00</option>                                                                                                           
                                                                                                            <option value="inc">Electronic minute book & bylaws in PDF +$69</option>                                                                                                           
                                                                                                            <option value="inc">Minute book & bylaws in basic binder +$99</option>                                                                          

                                                                                                        </select>
                                                                                                    
                                                                                                </div>
                                                                                            </div>                                                                                         
                                                                                            
                                                                                            <input type="button" class="next btn-color mt-3" value="Next" />

                                                                                       </fieldset>  

                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3" > Incorporation Date</h5>
                                                                                            <hr style="margin-top:7px !important;">
                                                                                            
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Requested Incorporation Date</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">Current Date</option>                                                                                                           
                                                                                                            <option value="inc">Future Date +$250</option>                                                                                                  

                                                                                                        </select>
                                                                                                    
                                                                                                </div>
                                                                                                
                                                                                            </div>    
                                                                                            
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="major_activity" class="setp-field-lbl">Write business activities (be specific)</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc; " type="text" id="major_activity" name="major_activity" class="form-control srfrm_input" placeholder="Major Activity" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Next" />

                                                                                        </fieldset>
                                                                                    
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Business Registry Service Update</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                            As per latest update, a business can be registered or incorporated online bypassing the Nuans search report. In express queue, the Certificate and Articles of Incorporation are delivered in 2 business hours via email. The process also allows to add other filing such as initial return, HST & WSIB accounts etc. 
                                                                                            </li>
                                                                                            
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-3 col-sm-12">
                                                                                                    <label class="setp-field-lbl">Choose an option <span class="required">*</span></label>
                                                                                                </div>

                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80" checked="checked" id="" tabindex="2">
                                                                                                        <span class="ms-3">Obtain Nuans report with payment</span>
                                                                                                </label>

                                                                                                                                                                                        
                                                                                                <div class="col-lg-3 col-sm-12">
                                                                                                    <label class="label-width fw-bold">&nbsp;</label>
                                                                                                </div>
                                                                                                
                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80"  id="" tabindex="1">
                                                                                                        <span class="ms-3">Bypass Nuans and Register Your Business</span> 
                                                                                                </label>
                                                                                                

                                                                                            </div> 
                                                                                    
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Final Review" />

                                                                                            

                                                                                        </fieldset>
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Final Review</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Proposed Name</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose the legal suffix</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Inc.</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Whats purpose of this name report?</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">New corporations name</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Business Registry Service Update</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose an option</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Obtain Nuans report with payment</font>
                                                                                                    </td>
                                                                                                </tr>                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td colspan="2" style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>&nbsp;</strong></font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-4 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" class="text-center" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px"><strong>Your Order Details</strong></td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">                                                                                                    
                                                                                                    <td colspan="2">
                                                                                                        <table cellspacing="0" width="100%" style="border-left:1px solid #DFDFDF; border-top:1px solid #DFDFDF">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:12px; text-align:left">Product</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:50px; font-family: sans-serif; font-size:12px; text-align:center">Qty</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Unit Price</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Price</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody><tr>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:11px;">
                                                                                                                                    <strong style="color:#BF461E; font-size:12px; margin-bottom:5px">Alberta $12.80</strong>
                                                                                                                                    <ul style="margin:0"></ul>
                                                                                                                                </td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:center; width:50px; font-family: sans-serif; font-size:11px;">1</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                            </tr></tbody>
                                                                                                        <tfoot>
                                                                                                            <tr>
                                                                                                                <td colspan="3" style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:right; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">Total:</strong></td>
                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">$ 12.80 CAD</strong></td>
                                                                                                            </tr>
                                                                                                        </tfoot>
                                                                                                        </table>
                                                                                                    </td>
                                                                            
                                                                                                </tr>
                                                                                            </tbody>
                                                                                         </table>

                                                                                            <input type="hidden" id="services_id" name="services_id" value="1">
                                                                                            <input type="hidden" id="services_price" name="services_price" value="12.80">
                                                                                            <input type="hidden" id="services_name" name="services_name" value="Nuans Report">
                                                                                            <input type="hidden" id="returnYN" value="1">

                                                                                            <input type="button" name="previous" class="previous btn-color" value="Go To Business Register Page" />
                                                                                            <!--input type="submit" name="submit" class="submit btn btn-danger" value="Proceed To Pay" /-->
                                                                                            <input type="button" onclick="addToCart(1, \'Nuans Report\', 12.80,\'./assets/accounts/serv_1_805.png\');" tabindex="0" class="submit btn-color" value="Proceed To Pay" />

                                                                                            

                                                                                        </fieldset>


                                                                                    </form> 
                                                                                    

                                                                                   
                                                                                
                                                                            </div>
                                                                            <!--script-- src="/assets/js/mathCaptcha.js"></script>t-->
                                                                            <!--script src="/website_assets/js/script.js"></script>
                                                                            <!--script src="/website_assets/js/checkout.js"></!--script-->
                                                                            

                                                                        </div>

                                                                    </div> 
                                                                </div>
                                                                <!-- end contact  -->';                                     

                                                $returnHTML .= '
                                        </div>

                                    </div>    
                                    
                        </div>
                    </div>
                </div>            


            </div>

        </section>';

        $returnHTML .= $this->footerHTML();
        $returnHTML .= '
        <script src="/website_assets/js/multi_step_form.js"></script>

        <!--script src="/website_assets/js/checkout.js"></script-->';



		return $returnHTML;

    }

    public function businessService(){

        

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }



        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="contact-form-section background_srv" >

            <div class="container">

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $returnHTML .= "

                                    <div class=\"row\">

                                        <div class=\"col-md-12 mb-2 ml-2\" style=\"border:0px solid red !important; align:center;\">
                                            <div class=\"progress\" style=\"border-radius:12px !important; border:2px solid #505050 !important; background-color:#c0c0c0; padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px !important; height:30px !important;\">
                                                <div class=\"progress-bar progress-bar-striped active progress-style\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                            </div>
                                        </div>";

                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:10px !important;\">";
                                          
                                        $returnHTML .= $this->sidebarHTML();   

                                        $returnHTML .= '</div>  

                                        <div class="row col-md-9" style="border:0px solid red !important;">';



                                                $returnHTML .= '<!-- start contact  -->
                                                                <div class="pageTransBody">
                                                                    <div class="row mt-5" style="margin:0 auto;margin-top:0px !important;">

                                                                        <div class="u-section-1">

                                                                            <div class="col-md-12 sec-title text-center" style="border:0px solid red; margin-left:0px; margin-top:5px !important;margin-bottom:0px !important;">

                                                                                <!--h2 class="section-title">CONTACT US TODAY TO MAKE AN APPOINTMENT!</h2>

                                                                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span-->

                                                                                <h6 class="text-justify" style="font-weight:900 !important;">Corporation’s Name Change</h6>
                                                                                <hr>
                                                                                <p class="text-justify"> 
                                                                                This site guides step by step to fill in the form. Once you fill in and pay, our legal and accounting team review and register with government. You will receive registration documents in email instantly. 

                                                                                </p>

                                                                            </div> 

                                                                            <div id="contact" class="col-md-12" style="border:0px solid red; ">

                                                                                                                                                                   
                                                                                    <form id="user_form" novalidate action="form_action.php"  method="post">	
                                                                                         
                                                                                        <fieldset>
                                                                                            
                                                                                            <!--h2>Step 1: Add Account Details</h2-->

                                                                                            <div class="row my-3">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Choose Business Jurisdiction <span class="required">*</span></label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">Ontario $12.80</span> 
                                                                                                    </label>
                                                                                            
                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Alberta $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Federal (Canada) $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Prince Edward Island $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">New Brunswick $12.80</span>
                                                                                                    </label>
                                                                                                    
                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Other Regions</span>
                                                                                                    </label>
                                                                                                    
                                                                                                <li id="" style="padding-left:0px !important;" class="col-md-12 text-justify">
                                                                                                    <b><u>Disclaimer on 30-minute service</u></b>: 30-minute delivery time applies when the order is placed within our usual business hours, from 8:00 AM to 8:00 PM, Eastern Time, Monday through Friday. If orders come in after business hours, they will be processed in the first 30 minutes of the subsequent business day. 
                                                                                                </li>

                                                                                            </div>                                                                                          
                                                                                            
                                                                                            <input type="button" class="next btn-color mt-3" value="Next" />

                                                                                       </fieldset>  

                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3" > Proposed Name</h5>
                                                                                            <hr style="margin-top:7px !important;">
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Write the name you want to search and reserve</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Choose the legal suffix</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">Inc.</option>                                                                                                           
                                                                                                            <option value="inc">Ltd.</option>                                                                                                           
                                                                                                            <option value="inc">Corp.</option>                                                                                                           
                                                                                                            <option value="inc">Limited</option>                                                                                                           
                                                                                                            <option value="inc">Incorporated</option>                                                                                                           
                                                                                                            <option value="inc">Corporation</option>                                                                                                            
                                                                                                            <option value="inc">Ltee</option>                                                                                                            
                                                                                                            <option value="inc">Limitee</option>                                                                                                            
                                                                                                            <option value="inc">Incorporee</option>                                                                                                            
                                                                                                            <option value="inc">None</option>                                                                                                            

                                                                                                        </select>
                                                                                                    
                                                                                                </div>

                                                                                                <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                                    Note: In case you intend to use it in incorporation context (like a new corporation or corporate name change), it is compulsory to select one of the provided legal suffixes. Despite their similar legal implications, the selection depends solely on the preferred look. Conversely, when this name is aimed for non-incorporation use (for instance, sole proprietorship, master business license, trade name, or non-profit), opt for "none". 
                                                                                                </li>
                                                                                            </div>    
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">What is purpose of this name report?</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                    
                                                                                                        <select name="purpose" class="form-control select-box">

                                                                                                            <option value="inc">New corporations name</option>                                                                                                           
                                                                                                            <option value="inc">Corporations name change</option>                                                                                                           
                                                                                                            <option value="inc">Use as sole proprietorship</option>                                                                                                           
                                                                                                            <option value="inc">Use for master business license</option>                                                                                       

                                                                                                        </select>
                                                                                                    
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="major_activity" class="setp-field-lbl">Describe the major activities of this business</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc; " type="text" id="major_activity" name="major_activity" class="form-control srfrm_input" placeholder="Major Activity" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Next" />

                                                                                        </fieldset>
                                                                                    
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Business Registry Service Update</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                            As per latest update, a business can be registered or incorporated online bypassing the Nuans search report. In express queue, the Certificate and Articles of Incorporation are delivered in 2 business hours via email. The process also allows to add other filing such as initial return, HST & WSIB accounts etc. 
                                                                                            </li>
                                                                                            
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-3 col-sm-12">
                                                                                                    <label class="setp-field-lbl">Choose an option <span class="required">*</span></label>
                                                                                                </div>

                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80" checked="checked" id="" tabindex="2">
                                                                                                        <span class="ms-3">Obtain Nuans report with payment</span>
                                                                                                </label>

                                                                                                                                                                                        
                                                                                                <div class="col-lg-3 col-sm-12">
                                                                                                    <label class="label-width fw-bold">&nbsp;</label>
                                                                                                </div>
                                                                                                
                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80"  id="" tabindex="1">
                                                                                                        <span class="ms-3">Bypass Nuans and Register Your Business</span> 
                                                                                                </label>
                                                                                                

                                                                                            </div> 
                                                                                    
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Final Review" />

                                                                                            

                                                                                        </fieldset>
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Final Review</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Proposed Name</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose the legal suffix</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Inc.</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Whats purpose of this name report?</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">New corporations name</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Business Registry Service Update</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose an option</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Obtain Nuans report with payment</font>
                                                                                                    </td>
                                                                                                </tr>                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td colspan="2" style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>&nbsp;</strong></font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-4 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" class="text-center" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px"><strong>Your Order Details</strong></td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">                                                                                                    
                                                                                                    <td colspan="2">
                                                                                                        <table cellspacing="0" width="100%" style="border-left:1px solid #DFDFDF; border-top:1px solid #DFDFDF">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:12px; text-align:left">Product</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:50px; font-family: sans-serif; font-size:12px; text-align:center">Qty</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Unit Price</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Price</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody><tr>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:11px;">
                                                                                                                                    <strong style="color:#BF461E; font-size:12px; margin-bottom:5px">Alberta $12.80</strong>
                                                                                                                                    <ul style="margin:0"></ul>
                                                                                                                                </td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:center; width:50px; font-family: sans-serif; font-size:11px;">1</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                            </tr></tbody>
                                                                                                        <tfoot>
                                                                                                            <tr>
                                                                                                                <td colspan="3" style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:right; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">Total:</strong></td>
                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">$ 12.80 CAD</strong></td>
                                                                                                            </tr>
                                                                                                        </tfoot>
                                                                                                        </table>
                                                                                                    </td>
                                                                            
                                                                                                </tr>
                                                                                            </tbody>
                                                                                         </table>

                                                                                            <input type="hidden" id="services_id" name="services_id" value="1">
                                                                                            <input type="hidden" id="services_price" name="services_price" value="12.80">
                                                                                            <input type="hidden" id="services_name" name="services_name" value="Nuans Report">
                                                                                            <input type="hidden" id="returnYN" value="1">

                                                                                            <input type="button" name="previous" class="previous btn-color" value="Go To Business Register Page" />
                                                                                            <!--input type="submit" name="submit" class="submit btn btn-danger" value="Proceed To Pay" /-->
                                                                                            <input type="button" onclick="addToCart(1, \'Nuans Report\', 12.80,\'./assets/accounts/serv_1_805.png\');" tabindex="0" class="submit btn-color" value="Proceed To Pay" />

                                                                                            

                                                                                        </fieldset>


                                                                                    </form> 
                                                                                    

                                                                                   
                                                                                
                                                                            </div>
                                                                            <!--script-- src="/assets/js/mathCaptcha.js"></script>t-->
                                                                            <!--script src="/website_assets/js/script.js"></script>
                                                                            <!--script src="/website_assets/js/checkout.js"></!--script-->
                                                                            

                                                                        </div>

                                                                    </div> 
                                                                </div>
                                                                <!-- end contact  -->';                                     

                                                $returnHTML .= '
                                        </div>

                                    </div>    
                                    
                        </div>
                    </div>
                </div>            


            </div>

        </section>';

        $returnHTML .= $this->footerHTML();
        $returnHTML .= '
        <script src="/website_assets/js/multi_step_form.js"></script>

        <!--script src="/website_assets/js/checkout.js"></script-->';



		return $returnHTML;

    }

    public function professionalService(){

        

        $contactUsPages = array(8=>array(), 9=>array(), 10=>array());

        $tableObj = $this->db->getObj("SELECT pages_id, description, uri_value FROM pages WHERE pages_id IN (".implode(', ', array_keys($contactUsPages)).") AND pages_publish =1", array());

		if($tableObj){

            while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){

                $contactUsPages[$oneRow->pages_id] = array(trim(stripslashes($oneRow->description)), $oneRow->uri_value);

            }

        }



        $returnHTML = $this->headerHTML();

        $returnHTML .= '

        <section class="contact-form-section background_srv" >

            <div class="container">

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $returnHTML .= "

                                    <div class=\"row\">

                                        <div class=\"col-md-12 mb-2 ml-2\" style=\"border:0px solid red !important; align:center;\">
                                            <div class=\"progress\" style=\"border-radius:12px !important; border:2px solid #505050 !important; background-color:#c0c0c0; padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px !important; height:30px !important;\">
                                                <div class=\"progress-bar progress-bar-striped active progress-style\" role=\"progressbar\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
                                            </div>
                                        </div>";

                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:10px !important;\">";
                                          
                                        $returnHTML .= $this->sidebarHTML();   

                                        $returnHTML .= '</div>  

                                        <div class="row col-md-9" style="border:0px solid red !important;">';



                                                $returnHTML .= '<!-- start contact  -->
                                                                <div class="pageTransBody">
                                                                    <div class="row mt-5" style="margin:0 auto;margin-top:0px !important;">

                                                                        <div class="u-section-1">

                                                                            <div class="col-md-12 sec-title text-center" style="border:0px solid red; margin-left:0px; margin-top:5px !important;margin-bottom:0px !important;">

                                                                                <!--h2 class="section-title">CONTACT US TODAY TO MAKE AN APPOINTMENT!</h2>

                                                                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span-->

                                                                                <h6 class="text-justify" style="font-weight:900 !important;">Articles of Amendment</h6>
                                                                                <hr>
                                                                                <p class="text-justify"> 
                                                                                Our legal team and accountants can file an article of amendment for your corporation correctly. As a customer, all you need to do is, to fill in this form, explain in your own language the type of amendment you want to and pay. The rest is done by us. 

                                                                                </p>

                                                                            </div> 

                                                                            <div id="contact" class="col-md-12" style="border:0px solid red; ">

                                                                                                                                                                   
                                                                                    <form id="user_form" novalidate action="form_action.php"  method="post">	
                                                                                         
                                                                                        <fieldset>
                                                                                            
                                                                                            <!--h2>Step 1: Add Account Details</h2-->

                                                                                            <div class="row my-3">
                                                                                                    <div style="padding-left: 0px !important;" class="col-lg-4 col-sm-12">
                                                                                                        <label class="setp-field-lbl">Choose Business Jurisdiction <span class="required">*</span></label>
                                                                                                    </div>
                                                                                                    
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                            <input name="jurisdiction" type="radio" value="12.80" checked="checked" id="" tabindex="1">
                                                                                                            <span class="ms-3">Ontario $12.80</span> 
                                                                                                    </label>
                                                                                            
                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Alberta $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Federal (Canada) $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Prince Edward Island $12.80</span>
                                                                                                    </label>

                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">New Brunswick $12.80</span>
                                                                                                    </label>
                                                                                                    
                                                                                                    <div class="col-lg-4 col-sm-12">
                                                                                                        <label class="label-width fw-bold">&nbsp;</label>
                                                                                                    </div>
                                                                                                    <label class="col-lg-8 col-sm-12 rd_container">
                                                                                                        <input name="jurisdiction" type="radio" value="12.80" id="" tabindex="1">
                                                                                                        <span class="ms-3">Other Regions</span>
                                                                                                    </label>
                                                                                                    
                                                                                                <li id="" style="padding-left:0px !important;" class="col-md-12 text-justify">
                                                                                                    <b><u>Disclaimer on 30-minute service</u></b>: 30-minute delivery time applies when the order is placed within our usual business hours, from 8:00 AM to 8:00 PM, Eastern Time, Monday through Friday. If orders come in after business hours, they will be processed in the first 30 minutes of the subsequent business day. 
                                                                                                </li>

                                                                                            </div>                                                                                          
                                                                                            
                                                                                            <input type="button" class="next btn-color mt-3" value="Next" />

                                                                                       </fieldset>  

                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3" > Proposed Name</h5>
                                                                                            <hr style="margin-top:7px !important;">
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Write the name you want to search and reserve</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc;" type="text" id="company_name" name="company_name" class="form-control srfrm_input" placeholder="Company Name" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">Choose the legal suffix</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                   
                                                                                                        <select name="suffix" class="form-control select-box">

                                                                                                            <option value="inc">Inc.</option>                                                                                                           
                                                                                                            <option value="inc">Ltd.</option>                                                                                                           
                                                                                                            <option value="inc">Corp.</option>                                                                                                           
                                                                                                            <option value="inc">Limited</option>                                                                                                           
                                                                                                            <option value="inc">Incorporated</option>                                                                                                           
                                                                                                            <option value="inc">Corporation</option>                                                                                                            
                                                                                                            <option value="inc">Ltee</option>                                                                                                            
                                                                                                            <option value="inc">Limitee</option>                                                                                                            
                                                                                                            <option value="inc">Incorporee</option>                                                                                                            
                                                                                                            <option value="inc">None</option>                                                                                                            

                                                                                                        </select>
                                                                                                    
                                                                                                </div>

                                                                                                <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                                    Note: In case you intend to use it in incorporation context (like a new corporation or corporate name change), it is compulsory to select one of the provided legal suffixes. Despite their similar legal implications, the selection depends solely on the preferred look. Conversely, when this name is aimed for non-incorporation use (for instance, sole proprietorship, master business license, trade name, or non-profit), opt for "none". 
                                                                                                </li>
                                                                                            </div>    
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="company_name" class="setp-field-lbl">What is purpose of this name report?</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 mb-2">
                                                                                                                                                                                                    
                                                                                                        <select name="purpose" class="form-control select-box">

                                                                                                            <option value="inc">New corporations name</option>                                                                                                           
                                                                                                            <option value="inc">Corporations name change</option>                                                                                                           
                                                                                                            <option value="inc">Use as sole proprietorship</option>                                                                                                           
                                                                                                            <option value="inc">Use for master business license</option>                                                                                       

                                                                                                        </select>
                                                                                                    
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="row my-3">
                                                                                                <div style="padding-left:0px !important;" class="col-lg-5 col-sm-12">
                                                                                                    <label for="major_activity" class="setp-field-lbl">Describe the major activities of this business</label>
                                                                                                </div>
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-7 col-sm-12 ">
                                                                                                                                                                                                       
                                                                                                        <input style="border:1px solid #cccccc; " type="text" id="major_activity" name="major_activity" class="form-control srfrm_input" placeholder="Major Activity" required>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Next" />

                                                                                        </fieldset>
                                                                                    
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Business Registry Service Update</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <li style="padding-left:0px !important;padding-right:0px !important;" id="" class="col-md-12 text-justify">
                                                                                            As per latest update, a business can be registered or incorporated online bypassing the Nuans search report. In express queue, the Certificate and Articles of Incorporation are delivered in 2 business hours via email. The process also allows to add other filing such as initial return, HST & WSIB accounts etc. 
                                                                                            </li>
                                                                                            
                                                                                            <div class="row my-3 mb-4">
                                                                                                <div style="padding-left:0px !important;padding-right:0px !important;" class="col-lg-3 col-sm-12">
                                                                                                    <label class="setp-field-lbl">Choose an option <span class="required">*</span></label>
                                                                                                </div>

                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80" checked="checked" id="" tabindex="2">
                                                                                                        <span class="ms-3">Obtain Nuans report with payment</span>
                                                                                                </label>

                                                                                                                                                                                        
                                                                                                <div class="col-lg-3 col-sm-12">
                                                                                                    <label class="label-width fw-bold">&nbsp;</label>
                                                                                                </div>
                                                                                                
                                                                                                <label class="col-lg-9 col-sm-12 rd_container">
                                                                                                        <input name="payment" type="radio" value="12.80"  id="" tabindex="1">
                                                                                                        <span class="ms-3">Bypass Nuans and Register Your Business</span> 
                                                                                                </label>
                                                                                                

                                                                                            </div> 
                                                                                    
                                                                                            <input type="button" name="previous" class="previous btn-color" value="Previous" />
                                                                                            <input type="button" name="next" class="next btn-color" value="Final Review" />

                                                                                            

                                                                                        </fieldset>
                                                                                        <fieldset>

                                                                                            <h5 class="setp-field-title mt-3"> Final Review</h5>
                                                                                            <hr style="margin-top:7px !important;">

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Proposed Name</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose the legal suffix</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Inc.</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Whats purpose of this name report?</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">New corporations name</font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-3 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px">Business Registry Service Update</td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>Choose an option</strong></font>
                                                                                                    </td>
                                                                                                    <td style="padding:7px 7px; width:60%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;">Obtain Nuans report with payment</font>
                                                                                                    </td>
                                                                                                </tr>                                                                                                
                                                                                                <tr bgcolor="#ffffff">
                                                                                                    <td colspan="2" style="padding:7px 7px; width:40%;">
                                                                                                        <font style="font-family: sans-serif; font-size:12px;"><strong>&nbsp;</strong></font>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                            </table>

                                                                                            <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="mb-4 table">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td colspan="2" class="text-center" style="font-size:14px; font-weight:bold; background-color:#EEE; border-bottom:1px solid #DFDFDF; padding:7px 7px"><strong>Your Order Details</strong></td>
                                                                                                </tr>
                                                                                                <tr bgcolor="#ffffff">                                                                                                    
                                                                                                    <td colspan="2">
                                                                                                        <table cellspacing="0" width="100%" style="border-left:1px solid #DFDFDF; border-top:1px solid #DFDFDF">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:12px; text-align:left">Product</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:50px; font-family: sans-serif; font-size:12px; text-align:center">Qty</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Unit Price</th>
                                                                                                                <th style="background-color:#F4F4F4; border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:12px; text-align:left">Price</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody><tr>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; font-family: sans-serif; font-size:11px;">
                                                                                                                                    <strong style="color:#BF461E; font-size:12px; margin-bottom:5px">Alberta $12.80</strong>
                                                                                                                                    <ul style="margin:0"></ul>
                                                                                                                                </td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:center; width:50px; font-family: sans-serif; font-size:11px;">1</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif; font-size:11px;">$ 12.80 CAD</td>
                                                                                                                            </tr></tbody>
                                                                                                        <tfoot>
                                                                                                            <tr>
                                                                                                                <td colspan="3" style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; text-align:right; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">Total:</strong></td>
                                                                                                                <td style="border-bottom:1px solid #DFDFDF; border-right:1px solid #DFDFDF; padding:7px; width:155px; font-family: sans-serif;"><strong style="font-size:12px;">$ 12.80 CAD</strong></td>
                                                                                                            </tr>
                                                                                                        </tfoot>
                                                                                                        </table>
                                                                                                    </td>
                                                                            
                                                                                                </tr>
                                                                                            </tbody>
                                                                                         </table>

                                                                                            <input type="hidden" id="services_id" name="services_id" value="1">
                                                                                            <input type="hidden" id="services_price" name="services_price" value="12.80">
                                                                                            <input type="hidden" id="services_name" name="services_name" value="Nuans Report">
                                                                                            <input type="hidden" id="returnYN" value="1">

                                                                                            <input type="button" name="previous" class="previous btn-color" value="Go To Business Register Page" />
                                                                                            <!--input type="submit" name="submit" class="submit btn btn-danger" value="Proceed To Pay" /-->
                                                                                            <input type="button" onclick="addToCart(1, \'Nuans Report\', 12.80,\'./assets/accounts/serv_1_805.png\');" tabindex="0" class="submit btn-color" value="Proceed To Pay" />

                                                                                            

                                                                                        </fieldset>


                                                                                    </form> 
                                                                                    

                                                                                   
                                                                                
                                                                            </div>
                                                                            <!--script-- src="/assets/js/mathCaptcha.js"></script>t-->
                                                                            <!--script src="/website_assets/js/script.js"></script>
                                                                            <!--script src="/website_assets/js/checkout.js"></!--script-->
                                                                            

                                                                        </div>

                                                                    </div> 
                                                                </div>
                                                                <!-- end contact  -->';                                     

                                                $returnHTML .= '
                                        </div>

                                    </div>    
                                    
                        </div>
                    </div>
                </div>            


            </div>

        </section>';

        $returnHTML .= $this->footerHTML();
        $returnHTML .= '
        <script src="/website_assets/js/multi_step_form.js"></script>

        <!--script src="/website_assets/js/checkout.js"></script-->';



		return $returnHTML;

    }
    

    public function companyAssessment(){

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

        <section class="contact-form-section background">

            <div class="container">

                <div class="pageTransBody">

                    <div class="row mt-5 " style="max-width:1140px;margin:0 auto; border:0px solid red; margin-top:0px !important;">

                        <div class="col-sm-12 u-section-1">

                            <!-- Sec Title -->

                            <br>

                            <div class="col-sm-12 u-list-1" style="border:0px solid red; margin-top:5px !important;padding-top:5px !important;" >

                                <div class="" style="border:0px solid red;" >

                                    <div style="border:0px solid red;">

                                        <div class="col-md-12 text-center">

                                            <span id="frmSubmitMessage" class="txt24 txtGreen"></span>

                                        </div>  

                                    </div>
                                </div>
                            </div>

                            <section id="contact" class="contact-section contact-style-3" style="border:0px solid red; margin-top:0px !important;padding-top:0px !important;">

                                <div class="container" style="border:0px solid red;">

                                    <div class="row justify-content-center">

                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">

                                            <div class="section-title text-center mb-50">

                                            <p>Fill the form below take at most 5 minutes and send us to get your free assessment</p>

                                            </div>

                                        </div>

                                    </div>


                                    <!--Assessment Form-->
                                    <div class="row">

                                        <div class="col-lg-12">

                                            <div class="contact-form-wrapper">

                                                <form action="#" id="frmAssessments" onsubmit="return saveAssessments(event)" style="border:0px solid red; margin:0 auto;">

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="single-input">
                                                                <select name="services_id" id="services_id" required class="form-input form-control select-box">

                                                                    <option value="">Select Your Service</option>';                                                                

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

                                                            <input type="text" id="name" name="name" class="form-input" placeholder="Name" required>

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

                                                            <input type="text" id="phone" name="phone" class="form-input" placeholder="Phone" maxlength="14" required>

                                                            <i class="lni lni-phone"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="single-input">

                                                            <input type="text" id="address" name="address" class="form-input" placeholder="Address" required>

                                                            <i class="lni lni-text-format"></i>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="single-input">

                                                            <textarea name="description" id="description" class="form-input" placeholder="Description" rows="6"></textarea>

                                                            <i class="lni lni-comments-alt"></i>

                                                            </div>

                                                        </div>

                                                        <div class="mt-15 col-md-12">
                                                            <div id="mathCaptcha"></div>
                                                            <span id="errRecaptcha" style="color:red"></span>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <span id="msgAssessments"></span>
                                                            <div class="form-button">
                                                                <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                                                <button name="submit-form" type="submit"id="submitAssessments" class="button" data-loading-text="Please wait..."> <i class="lni lni-telegram-original"></i> Get Started</button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>                            

                                    </div>

                                </div>

                            </section> 

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <script src="/assets/js/mathCaptcha.js"></script>';

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

        <section class="contact-form-section background">

            <div class="container">

                <div class="row">

                    <div class="col-md-12 abt_body" style="border:0px solid red;">

                        <div class="single-card card-style-one mt-4 mb-3" style="border:0px solid red; padding-top:0px !important;">';                    

                            $returnHTML .= "

                                    <div class=\"row\">";

                                        $returnHTML .= "<div class=\"col-md-3 order-md-1\" style=\"padding-right:0px !important;\">";
                                          
                                        $returnHTML .= $this->sidebarHTML();   

                                        $returnHTML .= '</div>  

                                        <div class="row col-md-9" style="border:0px solid red !important;">';



                                                $returnHTML .= '<!-- start contact  -->
                                                                <div class="pageTransBody">
                                                                    <div class="row mt-5" style="margin:0 auto;margin-top:0px !important;">

                                                                        <div class="u-section-1">                         
                                                                        
                                                                            <div class="u-expanded-width u-list u-list-1">

                                                                                <div class="u-repeater u-repeater-1">

                                                                                    <div class="u-align-center u-container-style u-list-item u-radius-50 u-repeater-item u-shape-round u-white u-list-item-1">

                                                                                        <div class="u-container-layout u-similar-container u-container-layout-1"><span class="u-file-icon u-gradient u-icon u-icon-circle u-text-white u-icon-1"><img src="/website_assets/images/envelop.png" alt=""></span>

                                                                                            <h5 class="u-text u-text-3 text-center">E-mail Us</h5>

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

                                                                                            <h5 class="u-text u-text-5 text-center">Address</h5>

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

                                                                                            <h5 class="u-text u-text-7 text-center">Call Us</h5>

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
                                                                   

                                                                            <!--Contact Form--> 
                                                                            <!-- Sec Title -->
                                                                            <br>

                                                                            <div class="col-md-12 sec-title text-center" style="border:0px solid red; margin-left:0px; margin-top:5px !important;margin-bottom:25px !important;">

                                                                                <h2 class="section-title">CONTACT US TODAY TO MAKE AN APPOINTMENT!</h2>

                                                                                <span id="frmSubmitMessage" class="txt24 txtGreen"></span>

                                                                            </div> 

                                                                            <section id="contact" class="contact-section contact-style-3" style="border:0px solid red; ">

                                                                                <div class="container">

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
                                                                                                        <div class="mt-15 col-md-12">
                                                                                                            <div id="mathCaptcha"></div>
                                                                                                            <span id="errRecaptcha" style="color:red"></span>
                                                                                                        </div>

                                                                                                        <div class="col-md-12">

                                                                                                            <!--div class="form-button">

                                                                                                            <button name="submit-form" type="submit" class="button"> <i class="lni lni-telegram-original"></i> Submit</button>

                                                                                                            </div-->

                                                                                                            <span id="msgContact"></span>

                                                                                                            <div class="form-button">
                                                                                                                <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                                                                                                <button name="submit-form" type="submit" id="submitContact" class="button" data-loading-text="Please wait..."><span>Submit</span></button>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </form>

                                                                                            </div>

                                                                                        </div>                            

                                                                                    </div>

                                                                                </div>

                                                                            </section>
                                                                            <!--script src="/assets/js/mathCaptcha.js"></script>
                                                                            <!--script-- src="/assets/js/script.js"></script-->

                                                                        </div>

                                                                    </div> 
                                                                </div>
                                                                <!-- end contact  -->';                                     

                                                $returnHTML .= '
                                        </div>

                                    </div>    
                                    
                        </div>
                    </div>
                </div>            


            </div>

        </section>';

        $returnHTML .= $this->footerHTML();



		return $returnHTML;

    }


    function sendContactUs(){

        //================Email Meta Data Here==============//   
        $returnStr = '';     
        $returnData = array();
        $returnData['savemsg'] = 'error';

        $services_id = intval($_POST['services_id']??0);
		$fromName = addslashes(trim($_POST['fname']??''));
		$contact_phone = addslashes(trim($_POST['phone']??''));
		$email = addslashes(trim($_POST['email']??''));
		$contact_subject = addslashes(trim($_POST['subject']??''));	
		$note = addslashes(trim($_POST['note']??''));	
            

        //=========== Contact Email Validate & Send ==============
        if($email =='' || is_null($email)){
            $returnStr = 'Could not send mail because of missing your email address.';
        }
        else{
            
            $fromName = trim(stripslashes((string) $_POST['fname']??''));
            $contact_phone = nl2br(trim(stripslashes((string) $_POST['phone']??'')));
            $email = nl2br(trim(stripslashes((string) $_POST['email']??'')));            
            $contact_subject = nl2br(trim(stripslashes((string) $_POST['subject']??'')));            
            $note = nl2br(trim(stripslashes((string) $_POST['note']??'')));            
            $subject = '[New message] From '.LIVE_DOMAIN." Contact Form";   

            $service_name = '';
            $queryServiceObj = $this->db->getObj("SELECT * FROM services WHERE services_id = :services_id", array('services_id'=>$services_id));
            if($queryServiceObj){
                $service_name = $queryServiceObj->fetch(PDO::FETCH_OBJ)->name;						
            }  
            
            /**
             * must change the function parameter to test for test the email
             * like $this->db->supportEmail('test');
             */
            $info = $this->db->supportEmail('info');
            
            $message = "<html>";
            $message .= "<head>";
            $message .= "<title>$subject</title>";
            $message .= "</head>";
            $message .= "<body>";
            $message .= "<p>";
            $message .= "Dear <i><strong>$fromName</strong></i>,<br />";
            $message .= "We received your request for contact about the [ $service_name ] service.<br /><br />";
            $message .= "You wrote:<br />";
            $message .= "Phone: $contact_phone<br>";
            $message .= "Email: $email<br>";
            $message .= "Subject: $contact_subject<br>";
            $message .= "Message: $note<br>";
            $message .= "Service Type: $service_name";
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
            $headers[] = "From: ".$info;
            $headers[] = "Reply-To: ".$do_not_reply;
            $headers[] = "Organization: ".COMPANYNAME;
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-type: text/html; charset=iso-8859-1";
            $headers[] = "X-Priority: 3";
            $headers[] = "X-Mailer: PHP".phpversion();

            
            if(mail($email, $subject, $message, implode("\r\n", $headers))){
                
                $returnStr = "sent";
                
                
                $headersAdmin = array();
                $headersAdmin[] = "From: ".$email;
                $headersAdmin[] = "Reply-To: ".$do_not_reply;
                $headersAdmin[] = "Organization: ".COMPANYNAME;
                $headersAdmin[] = "MIME-Version: 1.0";
                $headersAdmin[] = "Content-type: text/html; charset=iso-8859-1";
                $headersAdmin[] = "X-Priority: 3";
                $headersAdmin[] = "X-Mailer: PHP".phpversion();                
                
                $message = "<html>";
                $message .= "<head>";
                $message .= "<title>$subject</title>";
                $message .= "</head>";
                $message .= "<body>";
                $message .= "<p>";
                $message .= "Dear Admin of <i><strong>".COMPANYNAME."</strong></i>,<br />";
                $message .= "We received a Contact request from $fromName.<br /><br />";
                $message .= "He / She wrotes:<br />";
                $message .= "Phone: $contact_phone<br>";
                $message .= "Email: $email<br>";
                $message .= "Subject: $contact_subject<br>";
                $message .= "Message: $note<br>";
                $message .= "Service Type: $service_name";
                $message .= "</p>";
                $message .= "<p>";
                $message .= "<br />";
                $message .= "Please reply him/her as soon as possible.";
                $message .= "</p>";
                $message .= "</body>";
                $message .= "</html>";
                
                mail($info, $subject, $message, implode("\r\n", $headersAdmin));

                $returnData['savemsg'] = 'Sent';
                $returnData['returnStr'] = $returnStr;
                
            }
            else{
                $returnData['returnStr'] = "Sorry! Could not send mail. Try again later.";
            }
        }
              
        
        return json_encode($returnData);
    }


    public function sendContactUsOLD(){

        $POST = json_decode(file_get_contents('php://input'), true);

		$returnStr = '';

        // var_dump($_POST);exit;

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

            echo $email;exit;

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

        // echo $pageURI;exit;

        $pageURI = str_replace('.html', '', implode('/', $GLOBALS['segments']));
        // var_dump($pageURI);exit;
        $tableObj = $this->db->getObj("SELECT * FROM seo_info WHERE uri_value = :uri_value AND seo_info_publish = 1 LIMIT 0, 1", array('uri_value'=>$pageURI));
        if($tableObj){
            // var_dump($tableObj->fetch(PDO::FETCH_OBJ));exit;
            $tableRow = $tableObj->fetch(PDO::FETCH_OBJ);
            
            $seo_info_id = $tableRow->seo_info_id;
            $metaTitle = trim(stripslashes($tableRow->seo_title));
            $metaKeyword = trim(stripslashes($tableRow->seo_keywords));
            $metaDescription = trim(stripslashes($tableRow->description));
            $metaUrl = trim(stripslashes($tableRow->video_url));
            $metaVideo = trim(stripslashes($tableRow->video_url));
                // echo $seo_info_id;exit;
            $pageImgUrl = '';
            $filePath = "./assets/accounts/seo_$seo_info_id".'_';
            $pics = glob($filePath."*.jpg");
            // var_dump($pics);exit;
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


        if(empty($pageImgUrl)){
            $metaImage = baseURL.'/website_assets/images/logo.png';
        } 

        $canonical = baseURL.'/'.$pageURI.'.html';
        
        if(empty($pageURI)){$canonical = baseURL.'/'.$pageURI;}


          

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

            <meta property="og:image:type" content="image/jpg"/>

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

           
            <link rel="canonical" href="'.$canonical.'" />
            <meta property="og:url" content="'.$canonical.'" />
            <meta property="og:image" content="'.$metaImage.'" />


            <!-- links -->

            <link href="'.baseURL.'/website_assets/images/icons/sats.ico" rel="shortcut icon">

            <link href="'.baseURL.'/website_assets/images/icons/sats.png" rel="apple-touch-icon-precomposed">

            <link href="'.baseURL.'/website_assets/images/icons/sats.png" rel="shortcut icon" type="image/png">



            <!-- google font link -->
            <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Jost:ital,wght@0,500;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&family=Oswald:wght@400;500;600;700&family=Arya:wght@400;500;600;700&display=swap" rel="stylesheet"> 
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
            
            <!-- bootstrap link -->
            <link rel="stylesheet" href="'.baseURL.'/website_assets/css/bootstrap.min.css">

            <link rel="stylesheet" href="'.baseURL.'/website_assets/css/style.css">                 
            
            <!-- slider -->
            <link rel="stylesheet" href="'.baseURL.'/website_assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        

            <link rel="stylesheet" href="/assets/css/jquery-ui.css"> 

            
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-LZJRWQ8RS9"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag("js", new Date());

            gtag("config", "G-LZJRWQ8RS9");
            </script> 

            <style type="text/css">
            #user_form fieldset:not(:first-of-type) {
                display: none;
            }

            .progress-style {
                /* background: #000; */
                background-color: #28a745!important;
                border-radius: 25px;
                /* display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                color: #fff;
                text-align: center;
                background-color: #007bff;
                transition: width .6s ease; */
                
                background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
                /* background-size: 1rem 1rem; */
            }
            </style>

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



        $htmlStr .= '
         <!-- header class="top-header">

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

                                <p><span><i class="fa fa-map-marker" aria-hidden="true"></i></span><a target="_blank" href="https://www.google.com/maps?ll=43.690391,-79.293086&z=16&t=m&hl=en&gl=CA&mapclient=embed&q=2942+Danforth+Ave+Toronto,+ON+M4C+1M5">'.$headerPages[17].'</a></p>

                            </div>

                        </div>

                    </div>

                </div>

            </header !-->

            <div class="middle-header header">

                <div class="container">

                    <div class="row" style="border:0px solid red;">

                        <div class="left-side-phn-icon col-md-4">                                
                            <img src="/website_assets/images/call.png" alt="phone-icon" style="width: 40px;">                                
                            <a href="tel:'.$headerPages[18].'"><h5 class="call-number">'.$headerPages[18].' <span class="call-us-today">Call us today</span>
                            </h5></a>   
                            
                            <!--div id="search-icon" class="search-btn">
                                <button type="button" class="main-btn search-toggler"><i class="fa fa-search"></i></button>
                            </div !-->

                        </div>

                        <div class="col-md-8" style="padding: 0px 11px;">

                            <div class="middle-header-right-content btns">
                                                               
                                <div class="brand-logo col-md-6">
                                     <a href="/"><img src="'.baseURL.'/website_assets/images/accounts.png" alt="brand" srcset=""></a>
                                 </div>

                                <div class="middle-header-right-box col-md-2 justify-content-end">                                
                                    <a style="margin-right: 10px;" href="/'.$headerData[27].'.html" class="btn_r orange">Get Your Free Assessment</a>   
                                     
                                    
                                    <div class="cart-menu shopping">
                                        <a class="mycart" title="My Cart" style="font-family:Rubik !important; font-style: normal; font-weight: 300; font-display: swap;" href="/My_Order.html">
                                            <!--img src="/website_assets/images/cart.png" alt="phone-icon" style="width: 44px; margin-top: -20px !important;"-->
                                            <!-- img src="/website_assets/images/cart.png" alt="phone-icon" style="width: 44px;"-->
                                        </a>
                                        <i class="fa-solid cart-effect fa-cart-shopping text-dark fs-4 me-2" style="font-size:40px !important"></i>
                                        <a style="position:absolute; top:8px;left: 48px;color:#ffffff; font-weight:600;" title="Checkout Your Order" href="/Checkout.html" id="headerCart">
                                            <span id="headerCartQty" class="ml-1">0</span>
                                        </a>
                                        <div class="shopping-item" id="shoppingItem">
                                            <div class="dropdown-cart-header">
                                                <span id="cartQuantity"></span>
                                            </div>
                                            <ul class="shopping-list" id="shoppingList"></ul>
                                            <div class="bottom">
                                                <div class="total">
                                                    <span>Total: </span>
                                                    <span class="total-amount" id="totalAmount">0</span>
                                                </div>
                                                <a id="CheckoutLink" href="/checkout.html" class="btn animate">Checkout</a>
                                            </div>                                    
                                        </div>
                                    </div>
                                    <div id="search-icon" class="search-btn">
                                        <button type="button" class="main-btn search-toggler"><i style="font-size: 26px;" class="fa fa-search"></i> </button>
                                    </div>

                                </div>
                                

                            </div>

                        </div>

                    </div>

                </div>

                
            </div>

            <nav class="navbars p-sticky">

                <div class="container menu-flex">

                    <a href="./index.html" class="brand" id="brand"><img src="/website_assets/images/logo.png" alt="brand" srcset=""></a>

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

            </nav>
            <section id="search-popup" class="search-popup">
                <div id="close-search" class="close-search"><i class="fa-regular fa-circle-xmark"></i></div>
                <div class="popup-inner">
                    <div class="overlay-layer"></div>
                    <div class="search-form">
                        <div class="form-group">';
                            $tableObj = $this->db->getObj("SELECT name, address, google_map, working_hours FROM branches WHERE branches_publish =1", array());
                            if($tableObj){
                                while($oneRow = $tableObj->fetch(PDO::FETCH_OBJ)){
                                    $htmlStr .= '<fieldset>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2>'.trim(stripslashes($oneRow->name)).'</h2>
                                                <p>Working Hours: '.nl2br(trim(stripslashes($oneRow->working_hours))).'</p>
                                                <p>'.nl2br(trim(stripslashes($oneRow->address))).'</p>
                                            </div>
                                            <div class="col-md-6">
                                                '.trim(stripslashes($oneRow->google_map)).'
                                            </div>
                                        </div>
                                    </fieldset>';
                                }
                            }
                        $htmlStr .= '</div>
                    </div>
                </div>
            </section>';

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
                        <div class="col-6" align="left" style="padding: 0px 7px;">
                            <h2 class="txtwhite">'.$GLOBALS['title'].'</h2>
                        </div>
                        <div class="col-6 text-right" style="border:0px solid red; padding: 0px;">
                            <ul class="breadcrumbs" style="margin: 5px 5px;">
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


    private function headerRawHTML(){

        

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

        // echo $pageURI;exit;

        $pageURI = str_replace('.html', '', implode('/', $GLOBALS['segments']));
        // var_dump($pageURI);exit;
        $tableObj = $this->db->getObj("SELECT * FROM seo_info WHERE uri_value = :uri_value AND seo_info_publish = 1 LIMIT 0, 1", array('uri_value'=>$pageURI));
        if($tableObj){
            // var_dump($tableObj->fetch(PDO::FETCH_OBJ));exit;
            $tableRow = $tableObj->fetch(PDO::FETCH_OBJ);
            
            $seo_info_id = $tableRow->seo_info_id;
            $metaTitle = trim(stripslashes($tableRow->seo_title));
            $metaKeyword = trim(stripslashes($tableRow->seo_keywords));
            $metaDescription = trim(stripslashes($tableRow->description));
            $metaUrl = trim(stripslashes($tableRow->video_url));
            $metaVideo = trim(stripslashes($tableRow->video_url));
                // echo $seo_info_id;exit;
            $pageImgUrl = '';
            $filePath = "./assets/accounts/seo_$seo_info_id".'_';
            $pics = glob($filePath."*.jpg");
            // var_dump($pics);exit;
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


        if(empty($pageImgUrl)){
            $metaImage = baseURL.'/website_assets/images/logo.png';
        } 

        $canonical = baseURL.'/'.$pageURI.'.html';
        
        if(empty($pageURI)){$canonical = baseURL.'/'.$pageURI;}


          

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

            <meta property="og:image:type" content="image/jpg"/>

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

           
            <link rel="canonical" href="'.$canonical.'" />
            <meta property="og:url" content="'.$canonical.'" />
            <meta property="og:image" content="'.$metaImage.'" />


            <!-- links -->

            <link href="'.baseURL.'/website_assets/images/icons/favicon.ico" rel="shortcut icon">

            <link href="'.baseURL.'/website_assets/images/icons/favicon-32x32.png" rel="apple-touch-icon-precomposed">

            <link href="'.baseURL.'/website_assets/images/icons/favicon-16x16.png" rel="shortcut icon" type="image/png">



            <!-- google font link -->
            <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Jost:ital,wght@0,500;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&family=Oswald:wght@400;500;600;700&family=Arya:wght@400;500;600;700&display=swap" rel="stylesheet"> 
            
            <!-- bootstrap link -->
            <link rel="stylesheet" href="'.baseURL.'/website_assets/css/bootstrap.min.css">

            <link rel="stylesheet" href="'.baseURL.'/website_assets/css/style.css">                 
            
            <!-- slider -->
            <link rel="stylesheet" href="'.baseURL.'/website_assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        
            
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-LZJRWQ8RS9"></script>
            <!--script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag("js", new Date());

            gtag("config", "G-LZJRWQ8RS9");
            </script> 

        </head>

        <body>
        <div class="full-site-wrapper">';          

            

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
                <span style=\"font-size:20px !important;\">Contact us: <br>
                <span style=\"font-weight:450 !important;font-size:15px !important\"><a href=\"tel:".$contactUsPages[10][0]."\">".$contactUsPages[10][0]."</a></span></span></p>

                <p class=\"content_text\"><a href=\"mailto:".$contactUsPages[9][0]."\">".$contactUsPages[9][0]."</a></p>

            </div>

        </div>";

        $segment2URI = $GLOBALS['segment2URI']??'';
        $segment3URI = $GLOBALS['segment3URI']??'';


        
        
        

        if ($segment2URI == "legal-services"){

            $htmlStr .= "<!--2nd Sidebar Start-->

            <!-- div class=\"card card-with-shadow\">

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

                                                $manuStr .= "<a href=\"/legal-services.html\" class=\"\">$rootName</a>";

                                                $mobileManuStr .= "<a href=\"legal-services.html\">$rootName</a>";

                        

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

                                                    $manuStr .= "<li><a href=\"/legal-services$subMenuUri\" style=\"font-style: normal; font-weight: 300; font-display: swap;\" ><i style=\"float:left; padding: 4px 5px;\" class=\"fa fa-caret-right\"></i>$subName</a></li>";

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

            </div -->";

            $htmlStr .= "<!--1st Sidebar Start-->
        
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
    
                                                $manuStr .= "<li><a href=\"/immigration-services$subMenuUri\" style=\"font-style: normal; font-weight: 300; font-display: swap;\" ><i style=\"float:left; padding: 4px 5px;\" class=\"fa fa-caret-right\"></i>$subName</a></li>";
    
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
    
            </div>";
            
            $htmlStr .= "<!--3rd Sidebar Start-->

            <!-- div class=\"card card-with-shadow\">

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

                                                $manuStr .= "<a href=\"/fingerprint-services.html\" class=\"\">$rootName</a>";

                                                $mobileManuStr .= "<a href=\"fingerprint-services.html\">$rootName</a>";

                        

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

            </div -->";

        } else if($segment2URI == "fingerprint-services"){


            $htmlStr .= "<!--3rd Sidebar Start-->

            <!-- div class=\"card card-with-shadow\">

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

                                                $manuStr .= "<a href=\"/fingerprint-services.html\" class=\"\">$rootName</a>";

                                                $mobileManuStr .= "<a href=\"fingerprint-services.html\">$rootName</a>";

                        

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

            </div -->";

            $htmlStr .= "<!--1st Sidebar Start-->
        
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
    
                                                $manuStr .= "<li><a href=\"/immigration-services$subMenuUri\" style=\"font-style: normal; font-weight: 300; font-display: swap;\" ><i style=\"float:left; padding: 4px 5px !important;\" class=\"fa fa-caret-right\"></i>$subName</a></li>";
    
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
    
            </div>";

            $htmlStr .= "<!--2nd Sidebar Start-->

            <!-- div class=\"card card-with-shadow\">

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

                                                $manuStr .= "<a href=\"/legal-services.html\" class=\"\">$rootName</a>";

                                                $mobileManuStr .= "<a href=\"legal-services.html\">$rootName</a>";

                        

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

            </div -->";

        } else {
            $htmlStr .= "<!--1st Sidebar Start-->
        
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
    
                                                $manuStr .= "<li><a href=\"/immigration-services$subMenuUri\" style=\"font-style: normal; font-weight: 300; font-display: swap;\" ><i style=\"float:left; padding: 4px 5px !important;\" class=\"fa fa-caret-right\"></i>$subName</a></li>";
    
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
    
            </div>";

            $htmlStr .= "<!--2nd Sidebar Start-->

            <!-- div class=\"card card-with-shadow\">

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

                                                $manuStr .= "<a href=\"/legal-services.html\" class=\"\">$rootName</a>";

                                                $mobileManuStr .= "<a href=\"legal-services.html\">$rootName</a>";

                        

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

            </div -->";

            $htmlStr .= "<!--3rd Sidebar Start-->

            <!-- div class=\"card card-with-shadow\">

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

                                                $manuStr .= "<a href=\"/fingerprint-services.html\" class=\"\">$rootName</a>";

                                                $mobileManuStr .= "<a href=\"fingerprint-services.html\">$rootName</a>";

                        

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

            </div -->";
        }



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

                                        <p class="welcome">Welcome to Simple Accounting <br> & Tax Solutions Inc.</p>

                                        <div class="line"></div>

                                        <ul class="first-ul">

                                            <li> <span style="color: #8f8da0; padding-right: 5px;"><i class="fas fa-phone"></i></span> <a href="tel:+1 647-867-6351">+1 647-867-6351</a></li>
                                            <li> <span style="color: #8f8da0; padding-right: 5px;"><i class="fas fa-envelope"></i></span> <a href="mailto:info.sats98@gmail.com">info.sats98@gmail.com</a></li> 

                            
                                            <!-- a href="https://www.google.com/maps?ll=43.690391,-79.293086&z=16&t=m&hl=en&gl=CA&mapclient=embed&q=2942+Danforth+Ave+Toronto,+ON+M4C+1M5" target="_blank"> 3098 Danforth Avenue, Toronto, ON, Canada </a -->
                                            <li> <span style="color: #8f8da0; padding-right: 5px;"><i class="fas fa-home"></i></span>3098 Danforth Avenue, Toronto, ON, Canada</li>
                                        </ul>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="footer-box">

                                        <h3 class="footer-box-title">Useful Link</h3>

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
                                    
                                    
                                </div>
                                


                                <div class="col-md-4">

                                    <div class="footer-box">

                                        <h3 class="footer-box-title">Our Location</h3>
                                        <p class="welcome mb-3 "> Here is our exact location (3098 Danforth Avenue, Toronto, ON, Canada). </p>
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2039.9313336314642!2d-79.29018064488432!3d43.69187228728352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4ce9e6647fc8b%3A0x76f3e2dc1b37ca6e!2s3098%20Danforth%20Ave%2C%20Toronto%2C%20ON%20M1L%201B1%2C%20Canada!5e0!3m2!1sen!2sbd!4v1700482328816!5m2!1sen!2sbd" width="100%" style="border:0; border-radius: 6px;" allowfullscreen="" loading="lazy"  referrerpolicy="no-referrer-when-downgrade"></iframe>

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
                                        <p> Copyright ©2023 Simple Accounting & Tax Solutions Inc. All Rights Reserved.  &nbsp;&nbsp; Developed By: <a target="_blank" href="https://sksoftsolutions.ca/"><img class="" src="/assets/accounts/sksoft1.png" width="250px;" alt="SK Soft Solutions" srcset="">&nbsp;</a></p>

                                    </div>

                                    


                                </div>

                                <div class="col-md-4">

                                    &nbsp;

                                </div>

                            </div>

                        </div>

                        <img class="footer-img" src="/website_assets/images/footer-bg-linedecor.png" alt="" srcset="">

                    </footer>

                </div>  

                <!-- jquery -->

                <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></!--script-->
                
                <script src="/website_assets/js/jquery-1.12.0.min.js"></script>
                <script src="/assets/js/jquery-ui.min.js"></script>


                <script src="js/bootstrap.min.js"></script>

                

                <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

                <script src="js/hero-slider.js"></script>
                <script type="text/javascript" src="js/flickity.min.js"></script>

                <script src="/website_assets/js/script.js"></script>

                <!--script src="/website_assets/js/checkout.js"></script-->

                

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