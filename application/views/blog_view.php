<div>
    <main class="about-main">
        <div class="header-children-homes pl-5 pt-5 header-about-blog" style="width: 100%">
            <div class="text-left mt-5 p-2 ">
                <h1 class="text-left">The OrphanageHub Blog</h1>
                <h4 class="text-left">Explore news here</h4>
            </div>
        </div>
        <div class="categories p-5 d-flex">
            <?php
            
                // echo json_encode($cat['all_data']);
                if(!$cat['all_data']){
                    echo '<div class="text-center">No categories added yet</div>';
                }
                else{
                    foreach($cat['all_data'] as $key=>$row){
                        echo '<div class="each_cat mr-5 h5"><a href="get_blog/?cat='.$row->cat_name.'">'.$row->cat_name.'</a></div>';
                    }
                }
            ?>
        </div>
        <div class="">
        <?php
            $message = $this->session->flashdata('message');
            if($message && $message['status'] == 1)
            {
                echo '
                <div class="alert alert-success">
                    '.$message['message'].'
                </div>
                ';
            }
        ?>
            <!-- <h4 class="text-center pb-2"></h4> -->
            <div class="view_body ml-5 mr-5 d-flex flex-wrap">
                <?php 
                    // echo json_encode($blog['all_data']);

                    if (!$blog['all_data'] || !count($blog['all_data'])){
                        echo "<h3>No Blog Record found</h3>";
                    }else{
                    
                        foreach($blog['all_data'] as $key=>$row)
                        {
                            
                            echo '';
                            echo '<div class="card mb-3 mr-3" style="width: 18rem;">';
                            echo '<img src="'.base_url("uploads/featured_images/".$row->featured_image).'" class="card-img-top" title="Orphanage Image" alt="Orphanage Image">';
                            echo '<div class="card-body">';
                            echo '<h4 class="card-title">'.$row->title.'</h4>';
                            // echo '<p class="card-text">'.$row.'</p>';
                            // echo '<input type="checkbox" data-id="'.$row->id.'" '.(($row->verified == '1')? "checked" : "").' hidden="hidden" id="user'.$row->id.'">';
                            echo '<div class="each_cat mr-5"><a href="'.base_url("Blog/get_blog_detail/?cat=".$row->category).'">'.$row->category.'</a></div>';
                            echo '<a class="" href="'.base_url("Blog/get_blog_detail/?id=".$row->id).'"><button class="mt-3 btn btn-primary"> Read More</button></a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }

                ?>
            </div>
        </div>
    </main>
</div>