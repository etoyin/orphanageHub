<div>
    <main class="about-main">
        <div class="categories mt-5 p-5">
            <?php
                $message = $this->session->flashdata('message');
                // echo json_encode($message);
                if($message && $message['status'] == 0)
                {
                    echo '
                    <div class="alert alert-danger">
                        '.$message['message'].'
                    </div>
                    ';
                }
                echo '<div style="width: 80%">';
                echo '<img class="w-100" src="'.base_url('uploads/featured_images/'.$blog['all_data'][0]->featured_image).'" />';
                echo '</div>';
                echo '<br>';
                echo '<h2>'.$blog['all_data'][0]->title.'</h2>';

            
                // echo json_encode($blog['all_data']);

                echo '<div class="content-with-images">'.$blog['all_data'][0]->blog_post.'</div>';

                if($this->session->userdata('adminId'))
                {
                    echo '<a class="btn btn-danger show-delete-form text-white" >Delete Post <i class="las la-trash"></i></a>';

                    
                    echo '<div class="authorize-delete-form-parent">';
                    echo '<div style="cursor: pointer; position: absolute; padding: 0; right: 3px; font-size: 30px; width: fit-content; height: fit-content">';
                    echo '<i class="las la-times close-donate-form"></i>';
                    echo '</div>';
                    echo '<div class="authorize-delete-form">';
                    echo '<form id="delete-form" method="post" 
                            action="'.base_url("Admin_Dashboard/delete_blog?id=".$blog['all_data'][0]->id).'&featured_image='.$blog['all_data'][0]->featured_image.'">';
                    echo '<div class="alert alert-danger">Are you sure you wanna delete post?</div>';
                    echo '<div class="form-group">';
                                        echo '<p class="errorField pin-error">Input a pin</p>';
                                        echo '<label for="amount">Pin</label>';
                                        echo '<input name="pin" type="password" id="pin" required />';
                                    echo'</div>';
                                    echo '<div class="form-submit">';
                                        echo '<button id="delete-blog" type="submit" class="btn btn-danger"> Proceed <i class="las la-trash"></i></button>';
                                    echo '</div>';
                                echo '</form>';
                            echo '</div>';
                        echo '</div>';

                }
                
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
        let formAction = $("#delete-form").attr("action");
        let imagesPath = [];
        $(".content-with-images").find("img").each(function(){
            let newSrc = "../"+$(this).attr("src");
            $(this).attr("src", newSrc)
            console.log($(this).attr("src"));
            $(this).addClass("img-fluid");
        });

        $(".close-donate-form").click(function(){
            $(".authorize-delete-form-parent").css("display", "none");
        })

        $(".show-delete-form").click(function(){
            $(".authorize-delete-form-parent").css("display", "block");

            $(".content-with-images").find("img").each(function(){
                let imagePath = $(this).attr("src");
                let newImagesPath = imagePath.slice(26, );
                imagesPath.push(newImagesPath);
                
            });
            $("#delete-form").attr("action", formAction + '&blog_images=' + JSON.stringify(imagesPath));
            console.log();
            console.log($("#delete-form").attr("action"));
        })

        $("#delete-blog").click(function(e){
            e.preventDefault();
            let pin = $("#pin").val();
            if(pin.length > 0){
                $(".pin-error").css("display", "none");
                $("#delete-form").submit();
            }
            else{
                $(".pin-error").css("display", "block");
            }
        })
    })
</script>