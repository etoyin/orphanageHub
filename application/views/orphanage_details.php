<div>
    
    <main class="about-main">
        <img class="orphanage-page" src="<?=base_url("uploads/".$data[0]->email.'/'.$data[0]->cover_photo)?>" style="width: 100%"/>
        <div class="orphanage_info p-5">
            <div class="orphanage_name">
                <h2 class="font-weight-bold"><?=$data[0]->name?></h2>
            </div>
            <div class="d-flex flex-wrap">
                <div class="details-overview overview pt-1 text-justify">
                    <h4 class="font-weight-bold">Overview | Mission Statement</h4>
                    <hr/>
                    <p class="mt-3">
                        <?=$data[0]->mission_statement?>
                    </p>
                    <div class="contact-info mt-5">
                        <h4 class="font-weight-bold">Our Population</h4>
                        <hr/>
                        <div class="mb-5">
                            <p>Number of Boys: <?=$data[0]->boys?></p>
                            <p>Number of Girls: <?=$data[0]->girls?></p>
                        </div>
                        <h4 class="font-weight-bold">Contact Info</h4>
                        <hr/>
                        <div class="contact-info mb-5">
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-phone"></i>
                                </div>
                                <div class="col-md-11 border-left">
                                    <?=$data[0]->phone_number?>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-map-marker"></i>
                                </div>
                                <div class="col-md-11 border-left">
                                <?=$data[0]->address?>
                                </div>
                            </div> 
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-location-arrow"></i>
                                </div>
                                <div class="col-md-11 border-left">
                                <?=$data[0]->country?>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-envelope"></i>
                                </div>
                                <div class="text-wrap col-md-11 border-left">
                                    <?=$data[0]->email?>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-globe"></i>
                                </div>
                                <div class="col-md-11 border-left">
                                    <a href="http://www.lorem.ips" target="_blank" rel="noopener noreferrer">
                                        <?=$data[0]->website?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <h4 class="font-weight-bold">Director/Owner</h4>
                        <hr/>
                        <div class="mb-5">
                            <?=$data[0]->owner?>
                        </div>

                    </div>


                    <section class="reply-section p-5">


                        <div id="details_comments" class="card w-75 m-auto mt-5">
                            <div class="card-body">
                                <div class="d-flex flex-start align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-primary mb-1" id="name_comment">Lily Coleman</h6>
                                        <p class="text-muted small mb-0">
                                        Shared publicly - <span id="comment_date"></span>
                                        </p>
                                    </div>
                                </div>

                                <p class="mt-3 mb-4 pb-2" id="comment">
                                </p>
                                <div class="replies">
                                
                                </div>
                                <div class="small d-flex justify-content-start">
                                <!-- <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-thumbs-up me-2"></i>
                                    <p class="mb-0">Like</p>
                                </a> -->
                                <!-- <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-comment-dots me-2"></i>
                                    <p class="mb-0">Reply</p>
                                </a> -->
                                
                                <!-- <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="fas fa-share me-2"></i>
                                    <p class="mb-0">Share</p>
                                </a> -->
                                </div>
                            </div>
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <div class="d-flex flex-start w-100">
                                    <div class="form-outline w-100">
                                    <p data_id="" id="comment_id"></p>
                                    <p data-user_name="<?=($user ? $user[0]->name : "" )?>" id="user_name_reply"></p>
                                    <?php
                                        if (!$this->session->userdata('id'))
                                        {
                                            echo '<input type="text" id="name_reply" class="my-1 form-control" placeholder="Name..." />';
                                        }
                                    ?>
                                        <p class="errorField error_reply" >Enter comment!</p>
                                        <textarea class="form-control" id="reply_content" rows="4"
                                        style="background: #fff;"></textarea>
                                        <label class="form-label" for="textAreaExample">Message</label>
                                    </div>
                                </div>
                                <div class="float-end mt-2 pt-1">
                                    <button type="button" id="submit_reply" class="btn btn-primary btn-sm">Post reply</button>
                                    <button type="button" class="cancel btn btn-outline-primary btn-sm">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </section>



                    <section style="background-color: #eee;">
                        <div class="m-3 p-3">
                            <div class="card">
                                <?php
                                    foreach ($comments as $key => $value) {
                                        echo '
                                        <div class="card-body">
                                        <div class="d-flex flex-start align-items-center">
                                            <div>
                                                <h6 class="fw-bold text-primary mb-1">'.$value->name_comment.'</h6>
                                                <p class="text-muted small mb-0">
                                                Shared publicly - '.$value->created_at.'
                                                </p>
                                            </div>
                                        </div>
    
                                        <p class="mt-3 mb-4 pb-2">'.$value->comment.'</p>
                                        
    
                                        <div class="form-outline mb-4">
                                            <i class="lar la-comment me-2"></i>'.count($value->replies).'
                                            <label data_id2="'.$value->id.'" class="form-label reply-button" for="addANote">Comments</label>
                                        </div>
                                        <div class="small d-flex justify-content-start">
                                        <!-- <a href="#!" class="d-flex align-items-center me-3">
                                            <i class="far fa-thumbs-up me-2"></i>
                                            <p class="mb-0">Like</p>
                                        </a> -->
                                        
                                        <!-- <a href="#!" class="d-flex align-items-center me-3">
                                            <i class="fas fa-share me-2"></i>
                                            <p class="mb-0">Share</p>
                                        </a> -->
                                        </div>
                                    </div>';        
                                    }
                                ?>
                                
                                <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                    <div class="d-flex flex-start w-100">
                                    <div class="form-outline w-100">
                                    <p data-id="<?=$data[0]->id?>" id="orphanage_id"></p>
                                    <p data-user_name="<?=($user ? $user[0]->name : "" )?>" id="user_name"></p>
                                    <?php
                                    // echo json_encode($comments);

                                        if (!$this->session->userdata('id'))
                                        {
                                            echo '<input type="text" id="name_comment" class="my-1 form-control" placeholder="Name..." />';
                                        }
                                    ?>
                                        <p class="errorField" >Enter comment!</p>
                                        <textarea class="form-control" id="comment" rows="4"
                                        style="background: #fff;"></textarea>
                                        <label class="form-label" for="textAreaExample">Message</label>
                                    </div>
                                    </div>
                                    <div class="float-end mt-2 pt-1">
                                    <button type="button" id="send_comments" class="btn btn-primary btn-sm">Post comment</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                </div>
                <div class="details-overview">
                    <div class="card-div">
                        <div class="w-50 w-md-75 w-sm-100 shadow-inner card bg-white rounded m-auto p-3 h-50">
                            <div class="d-flex adoption-info">
                                <div class="<?=($data[0]->open_for_adoption ? "indicator-green" : "indicator-orange")?> mt-1 mr-1"></div> 
                                <?=($data[0]->open_for_adoption ? "We are up for adoption!!!" : "No child up for adoption yet")?>
                                
                            </div>
                            <img class="w-100 mt-3" src="<?=base_url('public/images/40564.jpg')?>" alt="" srcset="">
                            <p class="text-success mt-3 text-center" style="cursor: pointer">Click here to view our needs</p>
                            <!-- <button class="p-3 mt-3">Contact Us Today</button> -->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <section>
        
    </section>
</div>
