<div>

    <div id="myNav" class="overlay_loader">

    <div class="overlay_loader_content">
        <img class="loader" width="50px" height="50px" src="<?=base_url('public/images/loader.gif')?>" alt="">
    </div>
    </div>


    <div class="editOverlay-switch pt-5">
        <div class="card mt-5 ml-auto mr-auto w-25">
            <span class="">
                    <p class="text-right hideOverlay"  style="cursor: pointer">
                    <i class="fa fa-window-close"></i></p>
                    <p class="text-center">Edit Profile</p>
                </span>
            <p class="errorClass"></p>
            <p class="text-center" style="color: #aaa">Edit <span valueToEdit></span> </p>
            <div class="inputDv">
                <input type="checkbox" data-id="" <?=($data[0]->open_for_adoption ? "checked" : "")?> hidden="hidden" id="user">
                <label class="switch m-auto" for="user"></label><span id="text" class="ml-3 card-text"></span>
            </div>
            <button id="submit-switch" class="btn btn-primary" >
                Make Changes
            </button>
        </div>
</div>

    

    <section id="" class="editOverlay pt-5">
        <div class="card mt-5 ml-auto mr-auto w-25">
            <span class="">
                    <p class="text-right hideOverlay"  style="cursor: pointer">
                    <i class="fa fa-window-close"></i></p>
                    <p class="text-center">Edit Profile</p>
                </span>
            <p class="errorClass"></p>
            <p class="text-center" style="color: #aaa">Edit <span valueToEdit></span> </p>
            <div class="inputDiv">

            </div>
            <button id="submit" class="btn btn-primary" >
                Make Changes
            </button>
        </div>
    </section>

    <p id="keep-data" hidden data-keep="<?=$data[0]->id?>"></p>

    <main class="about-main">
        <img class="orphanage-page" src="<?=base_url("uploads/".$data[0]->email.'/'.$data[0]->cover_photo)?>" style="width: 100%"/>
        <div class="orphanage_info p-5">
            <div class="orphanage_name d-flex">
                <h2 id="name" class="font-weight-bold"><?=$data[0]->name?></h2> 
                <span class="editDetails" db="<?=$data[0]->name?>" id="orphanageNameBtn" edit-Data="name">
                    <i class="las la-user-edit"></i>
                </span>
            </div>
            <div class="d-flex flex-wrap">
                <div class="details-overview overview pt-1 text-justify">
                    <div class="d-flex">
                        <h4 class="font-weight-bold">Overview | Mission Statement</h4>
                        <span db="<?=$data[0]->mission_statement?>" class="editDetails" id="mission_statementBtn" edit-Data="mission_statement">
                            <i class="las la-user-edit"></i>
                        </span>
                    </div>
                    <hr/>
                        <p id="mission_statement" class="mt-3">
                            <?=$data[0]->mission_statement?>
                        </p>
                    <div class="contact-info mt-5">
                        <h4 class="font-weight-bold">Our Population</h4>
                        <hr/>
                        <div class="mb-5">
                            <div class="d-flex">
                                <p id="boys">Number of Boys: <?=$data[0]->boys?></p>
                                <span class="editDetails" id="numberBoysBtn" db="<?=$data[0]->boys?>" edit-Data="boys">
                                    <i class="las la-user-edit"></i>
                                </span>
                            </div>
                            <div class="d-flex">
                                <p id="girls">Number of Girls: <?=$data[0]->girls?></p>
                                <span class="editDetails" db="<?=$data[0]->girls?>" id="numberGirlsBtn" edit-Data="girls">
                                    <i class="las la-user-edit"></i>
                                </span>
                            </div>                            
                        </div>
                        <h4 class="font-weight-bold">Contact Info</h4>
                        <hr/>
                        <div class="contact-info mb-5">
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-phone"></i>
                                </div>
                                <div class="d-flex col-md-11 border-left">
                                    <div id="phone_number" class="">
                                        <?=$data[0]->phone_number?>
                                    </div>
                                    <span class="editDetails" id="phoneBtn" db="<?=$data[0]->phone_number?>" edit-Data="phone_number">
                                        <i class="las la-user-edit"></i>
                                    </span>
                                </div>
                                
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-map-marker"></i>
                                </div>
                                <div class="d-flex col-md-11 border-left">
                                    <div id="address" class="">
                                        <?=$data[0]->address?>
                                    </div>
                                    <span class="editDetails" db="<?=$data[0]->address?>" id="addressBtn" edit-Data="address">
                                        <i class="las la-user-edit"></i>
                                    </span>
                                </div>
                                
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-envelope"></i>
                                </div>
                                <div class="col-md-11 border-left">
                                    <?=$data[0]->email?>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <i class="las la-globe"></i>
                                </div>
                                <div class="d-flex col-md-11 border-left">
                                    <div class="">
                                        <a href="http://www.lorem.ips" id="website" target="_blank" rel="noopener noreferrer">
                                            <?=$data[0]->website?>
                                        </a>
                                    </div>
                                    <span class="editDetails" id="websiteBtn" db="<?=$data[0]->website?>" edit-Data="website">
                                        <i class="las la-user-edit"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <h4 class="font-weight-bold">Director/Owner</h4>
                        <hr/>
                        <div class="mb-5">
                            <?=$data[0]->owner?>
                        </div>
                        <?php
                    
                        ?>
                    </div>
                </div>
                <div class="details-overview">
                    <div class="card-div">
                        <div class="w-50 w-md-75 w-sm-100 shadow-inner card bg-white rounded m-auto p-3 h-50">
                            <div class="d-flex adoption-info">
                                <div class="<?=($data[0]->open_for_adoption ? "indicator-green" : "indicator-orange")?> mt-1 mr-1"></div> 
                                <?=($data[0]->open_for_adoption ? "We are up for adoption!!!" : "No child up for adoption yet")?>
                                <span db="<?=$data[0]->open_for_adoption?>" class="editDetails-switch" id="adoption_statusBtn" edit-Data="open_for_adoption">
                                    <i class="las la-user-edit"></i>
                                </span>
                            </div>
                            <img class="w-100 mt-3" src="<?=base_url('public/images/40564.jpg')?>" alt="" srcset="">
                            <p class="text-success mt-3 text-center" style="cursor: pointer">Click here to view/edit your needs</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <section>
        
    </section>
</div>