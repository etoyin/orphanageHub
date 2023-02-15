<div>
    <main class="about-main">
        <div class="header-children-homes pl-5 pt-5 header-about-blog" style="width: 100%">
            <div class="text-left mt-5 p-2 ">
                <h1 class="text-left">The OrphanageHub Blog</h1>
                <h4 class="text-left">Explore news here</h4>
            </div>
        </div>
        <div class="">
            <!-- <h4 class="text-center pb-2"></h4> -->
            <div class="view_body ml-5 mr-5 d-flex">
                <?php 
                    // echo json_encode($blog);

                    if (!$blog['all_data'] || !count($blog['all_data'])){
                        echo "<h3>No Blog Record found</h3>";
                    }else{
                    
                        foreach($blog['all_data'] as $key=>$row)
                        {
                            echo '<div class="card mt-2 mb-3 mr-3" style="width: 18rem;">';
                            echo '<img src="'.base_url("uploads/featured_images/".$row->featured_image).'" class="card-img-top" title="Orphanage Image" alt="Orphanage Image">';
                            echo '<div class="card-body">';
                            echo '<h4 class="card-title">'.$row->title.'</h4>';
                            // echo '<p class="card-text">'.$row.'</p>';
                            // echo '<input type="checkbox" data-id="'.$row->id.'" '.(($row->verified == '1')? "checked" : "").' hidden="hidden" id="user'.$row->id.'">';
                            echo '<div class="each_cat mr-5"><a href="#">'.$row->category.'</a></div>';
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