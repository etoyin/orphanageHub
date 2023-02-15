<div>
    <main class="about-main">
        <div class="header-children-homes header-about2" style="width: 100%">
            <div class="text-center">
                <h1>Explore Orphanages here</h1>
                <form action="<?=base_url('Children_Homes/index')?>" method="get">
                    <div class="d-flex w-50 m-auto mb-5 form-group">
                        <select class="form-control" name="country" id="country">
                            <option value="">Select a country</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            
        </div>
        <div class="p-5">
            <h4 class="text-center pb-2">All Verified Orphanages</h4>
            <div class="view_body d-flex">
                <?php 
                    // echo json_encode($data['all_data']);

                    if (!$data['all_data']){
                        echo "<h3>No Admin record to display</h3>";
                    }else{
                    
                        foreach($data['all_data'] as $key=>$row)
                        {
                            echo '<a href="getOneOrphanage/'.$row->id.'">';
                            echo '<div class="card mb-3 mr-3" style="width: 18rem;">';
                            echo '<img src="'.base_url("uploads/".$row->email.'/'.$row->cover_photo).'" class="card-img-top" title="Orphanage Image" alt="Orphanage Image">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$row->name.'</h5>';
                            echo '<p class="card-text">'.(strlen($row->mission_statement) > 100 ? substr($row->mission_statement, 0, 100).'...' : $row->mission_statement).'</p>';
                            echo '<div class="status-switch" style="display: block">';
                            // echo '<input type="checkbox" data-id="'.$row->id.'" '.(($row->verified == '1')? "checked" : "").' hidden="hidden" id="user'.$row->id.'">';
                            echo '<span id="text'.$row->id.'" class="ml-3 card-text">'.($row->country).'</span>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                        }
                    }

                ?>
            </div>
        </div>
    </main>
</div>