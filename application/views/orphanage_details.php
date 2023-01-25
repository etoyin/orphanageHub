<div>
    <main class="about-main">
        <img class="orphanage-page" src="<?=base_url("uploads/".$data[0]->email.'/'.$data[0]->cover_photo)?>" style="width: 100%"/>
        <div class="orphanage_info p-5">
            <div class="orphanage_name">
                <h2 class="font-weight-bold"><?=$data[0]->name?></h2>
            </div>
            <div class="row">
                <div class="col-md overview pt-1 text-justify">
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
                </div>
                <div class="col-md">
                    <div class="card-div">
                        <div class="w-50 w-md-75 w-sm-100 shadow-inner card bg-white rounded m-auto p-3 h-50">
                            <div class="d-flex adoption-info">
                                <div class="<?=($data[0]->open_for_adoption ? "indicator-green" : "indicator-orange")?> mt-1 mr-1"></div> 
                                <?=($data[0]->open_for_adoption ? "We are up for adoption!!!" : "No child up for adoption yet")?>
                                
                            </div>
                            <img class="w-100 mt-3" src="<?=base_url('public/images/40564.jpg')?>" alt="" srcset="">
                            <p class="text-success mt-3 text-center" style="cursor: pointer">Click here to view our needs</p>
                            <button class="p-3 mt-3">Contact Us Today</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
    <section>
        
    </section>
</div>