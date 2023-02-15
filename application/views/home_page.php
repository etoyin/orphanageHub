        <main id="ad-section">
            <div class="owl-carousel owl-theme" id="owl-demo">
                <div>
                    <div class="owl-text-overlay hidden-xs pt-5">
                        <div class="w-75 m-auto">
                            <h2 class="owl-title ">Welcome to the Orphanage Hub</h2>
                            <p class="h3"><em> Every child is a blessing</em></p>
                            <a href="#about"><button class="learn-more btn btn-sm btn-primary">Learn More</button></a>
                        </div>
                    </div>
                    <img class="owl-img" src="<?=base_url('public/images/3-children.jpg')?>">
                </div>
                <div>
                    <div class="owl-text-overlay hidden-xs pt-5">
                        <div class="w-75 m-auto">
                            <h2 class="owl-title ">A Voice for Children</h2>
                            <p class="h3"><em> Every child is a blessing</em></p>
                            <a href="#about"><button class="btn btn-sm learn-more btn-primary">Learn More</button></a>
                        </div>
                    </div>
                    <img class="owl-img" src="<?=base_url('public/images/caro1.jpg')?>">
                </div>
                <div>
                    <div class="owl-text-overlay hidden-xs pt-5">
                        <div class="w-75 m-auto">
                            <h2 class="owl-title ">A Place of Love</h2>
                            <p class="h3"><em> Every child is a blessing</em></p>
                            <a href="#about"><button class="btn btn-sm btn-primary learn-more">Learn More</button></a>
                        </div>
                    </div>
                    <img class="owl-img" src="<?=base_url('public/images/caro2.jpg')?>">
                </div>
            </div>
        
        </main>
        

        <section id="about">
            <div class="about">
                <div class="d-flex flex-wrap m-auto" >
                    <div class="about p-4 m-auto" >
                        <div class="hidden header text-center">
                            our Vision
                        </div>
                        <div class=" hidden body h5 text-center">
                          <p>
                            To care for all children
                          </p>
                        </div>
                        <div class="header hidden text-center">
                            our Mission
                        </div>
                        <div class="body h5 hidden">
                          <p>
                                <p>To make orphanage and care homes easily accessible</p>
                                <p>To facilitate fostering and adoption</p>
                                <p>To meet the needs of the less privileged children</p>
                                <p>To be a voice for children</p>
                          </p>
                        </div>
                    </div>
                    <div class="about-img p-5 m-auto hidden" >
                        <img width="100%" src="<?=base_url('public/images/3-children.jpg')?>" class="m-auto" alt="A Child">
                    </div>
                </div>
            </div>
        </section>
        <!-- <section>
            <div class="impact w-75 ml-auto mr-auto">
                <div class="w-100 h-100 ml-auto mr-auto p-5">
                    <div class="header mt-5 mb-5 text-center">Our <span>National</span> impact</div>
                    <div class="box w-75 ml-auto mr-auto d-sm-flex flex-sm-wrap justify-content-between">
                        <div class="homes">
                            <div class="number">23</div>
                            <div class="line"></div>
                            <div>Children Homes</div>
                        </div>
                        <div class="states">
                            <div class="number">12</div>
                            <div class="line"></div>
                            <div>States</div>
                        </div>
                        <div class="children">
                            <div class="number">1500+</div>
                            <div class="line"></div>
                            <div>Children Saved</div>
                        </div>
                    </div>
                    <div class="buttons w-100 mt-5 d-sm-flex flex-md-wrap justify-content-between">
                        <div class="btn">Make DOnation</div>
                        <div class="btn">Safe a Child</div>
                        <div class="btn">Adopt a Home</div>
                    </div>
                </div>
            </div>
        </section> -->
        <section style="border-top: 1px solid #bbb" class="blog-section">
            <h2 class="text-center font-weight-bold mt-3 hidden">Our Blog</h2>
            <div class="view_body ml-5 mr-5 d-flex">
                <?php 
                    // echo json_encode($blog['all_data']);

                    if (!$blog['all_data'] || !count($blog['all_data'])){
                        echo "<div class=\"w-100 alert hidden alert-warning\" role=\"alert\">
                            <i class=\"las la-exclamation-triangle\"></i> No Blog Record found!!!
                            </div>";
                    }else{
                        $limit = count($blog['all_data']) > 3 ? 3 : count($blog['all_data']);
                    
                        for($key = 0; $key < $limit; $key++)
                        {
                            echo '';
                            echo '<div class="card mb-3 mr-3 hidden" style="width: 18rem;">';
                            echo '<img src="'.base_url("uploads/featured_images/".$blog['all_data'][$key]->featured_image).'" class="card-img-top" title="Orphanage Image" alt="Orphanage Image">';
                            echo '<div class="card-body">';
                            echo '<h4 class="card-title">'.$blog['all_data'][$key]->title.'</h4>';
                            // echo '<p class="card-text">'.$row.'</p>';
                            // echo '<input type="checkbox" data-id="'.$row->id.'" '.(($row->verified == '1')? "checked" : "").' hidden="hidden" id="user'.$row->id.'">';
                            echo '<div class="each_cat mr-5"><a href="#">'.$blog['all_data'][$key]->category.'</a></div>';
                            echo '<a class="" href="'.base_url("Blog/get_blog_detail/?id=".$blog["all_data"][$key]->id).'"><button class="mt-3 btn btn-primary"> Read More</button></a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }

                ?>
            </div>
            <div class="text-center view-more-blog-posts mb-3 hidden">
                <a href="<?=base_url('Blog/index')?>" style="text-decoration: none; color: #444"> 
                    View More
                </a>
            </div>
        </section>
        <!-- <article>
            <div class="blog p-5">
                <div>
                    <div class="blog-header text-center">our blog</div>
                    <div class="blog-posts mt-5 d-sm-flex flex-md-wrap">
                        <div class="ml-4">
                            <div>
                                <img src="<?=base_url('public/images/blog-display.png')?>" width="100%" alt="about image">
                            </div>
                            <div class="p-3">
                                <div class="post-header">Five Children’s Homes Safely Evacuated: Update as of April 8, 2022</div>
                                <div class="post-body">
                                    <p>
                                        We have officially evacuated 
                                        all five of our partner children’s 
                                        homes and have settled them in safe, 
                                        semi-permanent homes. We....
                                    </p>
                                    <p class="btn">
                                        Read more
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="ml-4">
                            <div>
                                <img src="<?=base_url('public/images/blog-display.png')?>" width="100%" alt="about image">
                            </div>
                            <div class="p-3">
                                <div class="post-header">Five Children’s Homes Safely Evacuated: Update as of April 8, 2022</div>
                                <div class="post-body">
                                    <p>
                                        We have officially evacuated 
                                        all five of our partner children’s 
                                        homes and have settled them in safe, 
                                        semi-permanent homes. We....
                                    </p>
                                    <p class="btn">
                                        Read more
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center view-more-blog-posts">View More</div>
                </div>
            </div>
        </article> -->
        <div class="p-5" style="background-color: #e2dfdf;">
            <div class="contact w-50 mr-auto ml-auto">
                <div class="contact-header text-center hidden">Contact Us</div>
                <div class="alert alert-e"></div>
                <div class="errorField errorGen">Fill the form to submit!!!</div>
                <p class="errorField" id="nameError">Please input your name</p>
                <input class="form-control input-email hidden mt-3" data-hold="nameError" type="text" id="name" name="name" placeholder="Your Name"/>
                <p class="errorField" id="subjectError">Please add the subject matter</p>
                <input class="form-control input-email hidden" type="text" data-hold="subjectError" name="subject" id="subject" placeholder="Subject"/>
                <p class="errorField" id="contentError">Please add a comment</p>
                <textarea rows="10" id="content" data-hold="contentError" class="form-control hidden input-email mb-1"></textarea>
                <div class="">
                    <button id="submit-email" class="justify-content-center btn btn-block d-flex hidden"><i class="mt-1 mr-2 las la-spinner"></i> Submit</button>
                </div>
            </div>
        </div>
        
        
