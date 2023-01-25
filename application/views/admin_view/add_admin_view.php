
        <div class="center-word">
            <div class="w-50" >
                <form w-25 id="add_admin" method="post" action="admin_reg">
                    <!-- One "tab" for each step in the form: -->
                    <div class="tabu form-group">Login Info:
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
                        <p class="username_error error">Enter username</p>
                        <p><input class="input required form-control" id="username" errorField="username" placeholder="Username..." name="username"></p>
                        <p class="password_error error">Enter password</p>
                        <p><input class="input required form-control" id="password" placeholder="Password..." errorField="password" name="password" type="password"></p>
                        <p class="confirm_password_error error">Passwords do not match</p>
                        <p><input class="input required form-control" id="confirm_password" placeholder="Confirm Password..." errorField="confirm_password" name="confirm_password" type="password"></p>
                    </div>
                    <div style="">
                        <div style="">
                            <button type="button" class="btn btn-primary" id="admin_submit_admin" >Add</button>
                        </div>
                    </div>
                    <div class="overlay-pin p-5">
                        <div class="w-25 m-auto p-5 mt-5 bg-light">
                            <div class="close-add-admin" ><i style="color: grey" class="las la-window-close text-dark"></i></div>
                            <p class="pin_error error">Pin must be 4 characters</p>
                            <p><input class="form-control" id="pin" placeholder="Enter Authorized Pin..." errorField="pin" name="pin" type="password"></p>
                            <button id="submit_add_admin" class="btn btn-primary" >Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        