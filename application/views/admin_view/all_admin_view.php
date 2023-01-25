
        <div class="center-word">
            <div class="container">
                <h2>All Administrators on this site</h2>
                <p></p>            
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
                <table class="table">
                    <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <form method="post" action="delete_admin" id="delete_admin_">
                        <?php
                        if (!$data['all_data']){
                            echo "<h3>No Admin record to display</h3>";
                        }else{

                        
                            foreach($data['all_data'] as $key=>$row)
                            {
                                echo "<tr>";
                                echo "<td>".($key + 1)."</td>";
                                echo "<td></td>";
                                echo "<td>".$row->username."</td>";
                                echo "<td class='delete'>
                                        <input id='delete".$row->id."' name='delete' type='checkbox' value='".$row->id."'/>
                                        <label for='delete".$row->id."'><i class='las la-trash'></i></label>
                                        </td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                            <div class="overlay-pin p-5">
                                <div class="w-25 m-auto p-5 mt-5 bg-light">
                                    <div class="close-add-admin" ><i style="color: grey" class="las la-window-close text-dark"></i></div>
                                    <p class="alert alert-danger">Are you sure you want to delete admin?</p>
                                    <p class="pin_error error">Pin must be 4 characters</p>
                                    <p><input class="form-control" id="pin" placeholder="Enter Authorized Pin..." errorField="pin" name="pin" type="password"></p>
                                    <button id="delete_admin" class="btn btn-primary" >Submit</button>
                                </div>
                            </div>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
        