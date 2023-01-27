
        <div class="center-word">
            <div class="cards d-flex flex-wrap">
                <div style="background-color: #099b21" class="card d-flex p-3 mb-2 mr-3">
                    <div>
                        <div class="number"><?=(count($ver['all_data']) + count($unVer['all_data']))?></div>
                        <div class="details">Orphanages Registered</div>
                        <div class="p-2 text-center more-info">More Info <i class="las la-arrow-right"></i></div>
                    </div>
                    <div>
                        <i class="las la-home image-icon"></i>
                    </div>
                </div>
                <div style="background-color: #e7681f" class="card d-flex p-3 mr-3 mb-2">
                    <div>
                        <div class="number"><?=count($unVer['all_data'])?></div>
                        <div class="details">Unverified Orphanages</div>
                        <div class="p-2 text-center more-info">More Info <i class="las la-arrow-right"></i></div>
                    </div>
                    <div>
                        <i class="las la-exclamation-triangle image-icon"></i>
                    </div>
                </div>

                
                <!-- <div class="card p-3 mr-3"></div> -->
                <!-- <div class="card p-3 mr-3"></div> -->
            </div>
            <div class="card mt-4 p-2 calendar-card">
                <div class="calendar-grid">
    
                </div>
            </div>
        </div>
        