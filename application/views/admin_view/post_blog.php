<div class="center-word">
    <div class="container-fluid">
        <h1>Write Blog</h1>
        <?php
        if($this->session->flashdata('message'))
            {
                // echo '<h1>jjfjdjdj</h1>';
                $message = $this->session->flashdata("message");
                echo json_encode($message['message']);
                if ($message['status'] == 1){
                    echo '
                    <div class="alert alert-success">
                        '.$message['message'].'
                    </div>
                    ';
                }
                else {
                    echo '
                    <div class="alert alert-danger">
                        '.$message['message'].'
                    </div>
                    ';
                }
                
            }
        ?>
        <form id="post_blog" method="post" action="post_blog_to_db" enctype='multipart/form-data'>
            <p class="title-error error" >Enter Blog Title</p>
            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Post Title"/>

            <div class="overlay_upload_content mt-3 mb-3">
                <div class="uploadFlexContainer">
                    <p class="image-error error" errorField="profilePicture">Upload and Image and Select Image type</p>
                    <div class="drop-zone">
                    <span class="drop-zone__prompt">Drop featured image here or click to upload </span>
                    <!-- <div class="drop-zone__thumb" data-label="file.txt "></div> -->
                    <input type="file" name="featured_image" class="drop-zone__input required" id="featured-image" >
                    </div>
                    <!-- <button style="margin-top: 10px" id="submitUpload" class="btn-primary form-control nextFormSlide">Next</button> -->
                
                </div>
            </div>

            <!-- <input type="file" name="featured-image" id="featured-image" class="form-control"> -->
            <p class="error cat-error" id="cat-error">Select a Category</p>
            <select class="form-control mb-3" name="category" id="category">
                <?php 
                    if (!$categories['all_data']){
                        echo "<option>No Categories added yet</option>";
                    }else{

                        foreach($categories['all_data'] as $key=>$row)
                        {
                            echo "<option value=''>Select a category</option>";
                            echo "<option value='".$row->cat_name."'>".$row->cat_name."</option>";
                        }
                    }
                ?>
            </select>
            <p class="error text-error" id="text-error">You have little or no content</p>
            <textarea name="post_content" class="pt-5" id="editorjs"></textarea>
            <button id="save" class="btn btn-primary">Save</button>
        </div>
        <div class="overlay-pin p-5">
            <div class="w-25 m-auto p-2 mt-5 bg-light">
                <p class="close-add-admin" ><i style="color: grey" class="las la-window-close text-dark"></i></p>
                <p class="pin_error error">Pin must be 4 characters</p>
                <p><input class="form-control" id="pin" placeholder="Enter Authorized Pin..." errorField="pin" name="pin" type="password"></p>
                <button id="submit_blog_post" class="btn btn-primary" >Submit</button>
            </div>
        </div>
    </form>
    <div id="display"></div>
</div>
