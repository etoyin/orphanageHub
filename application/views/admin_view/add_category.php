
        <div class="center-word">
            <div class="w-50" >
                <form w-25 id="add_cat_form" method="post" action="add_cat">
                    <!-- One "tab" for each step in the form: -->
                    <div class="tabu form-group">
                        <?php
                        if($this->session->flashdata('message'))
                            {
                                // echo '<h1>jjfjdjdj</h1>';
                                $message = $this->session->flashdata("message");
                                // echo json_encode($message['message']);
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
                        <p class="h4">Add Blog Category</p>
                        <p class="cat_error error">Enter a Category</p>
                        <p><input class="input required form-control" id="cat_name" errorField="cat_error" placeholder="Enter Category" name="cat_name"></p>
                        
                    </div>
                    <div style="">
                        <div style="">
                            <button type="button" class="btn btn-primary" id="add_cat" >Add</button>
                        </div>
                    </div>
                    <div class="overlay-pin p-5">
                        <div class="w-25 m-auto p-5 mt-5 bg-light">
                            <div class="close-add-admin" ><i style="color: grey" class="las la-window-close text-dark"></i></div>
                            <p class="pin_error error">Pin must be 4 characters</p>
                            <p><input class="form-control" id="pin" placeholder="Enter Authorized Pin..." errorField="pin" name="pin" type="password"></p>
                            <button id="submit_cat" class="btn btn-primary" >Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        