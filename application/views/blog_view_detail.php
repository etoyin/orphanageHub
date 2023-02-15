<div>
    <main class="about-main">
        <div class="categories mt-5 p-5">
            <?php
                echo '<div style="width: 80%">';
                echo '<img class="w-100" src="'.base_url('uploads/featured_images/'.$blog['all_data'][0]->featured_image).'" />';
                echo '</div>';
                echo '<br>';
                echo '<h2>'.$blog['all_data'][0]->title.'</h2>';

            
                // echo json_encode($blog['all_data']);

                echo '<div class="content-with-images">'.$blog['all_data'][0]->blog_post.'</div>';
                
            ?>
        </div>
        <div class="">
            <!-- <h4 class="text-center pb-2"></h4> -->
            <!-- <div class="view_body ml-5 mr-5 d-flex mt-5">
                
            </div> -->
        </div>
    </main>
</div>
<script>
    $(document).ready(function(){
        $(".content-with-images").find("img").each(function(){
            let newSrc = "../"+$(this).attr("src");
            $(this).attr("src", newSrc)
            console.log($(this).attr("src"));
        })
    })
</script>