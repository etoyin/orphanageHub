<div id="myNav" class="overlay_loader">

    <div class="overlay_loader_content">
        <img class="loader" width="50px" height="50px" src="<?=base_url('public/images/loader.gif')?>" alt="">
    </div>
</div>

<div id="" class="overlay_success">

    <div class="overlay_success_content text-center">
    <i class="fa fa-smile-o success" style="font-size:36px; margin-bottom: 10px; color: #43ee7c"></i>
    <p>Registration Successful</p>
    <button id="successOk" class="ok" style="width: 50px; background-color: #bbb" class="btn">Ok</button>
    </div>
</div>

<div id="" class="overlay_error">

    <div class="overlay_error_content text-center">
    <i class="fa fa-smile-o success" style="font-size:36px; margin-bottom: 10px; color: #43ee7c"></i>
    <p id="errorMessage"></p>
    <button id="errorOk" class="ok" style="width: 50px; background-color: #bbb" class="btn">Ok</button>
    </div>
</div>

<div>
    <main class="about-main">
        <div class="header-children-homes header-about2" style="width: 100%">
            <div class="text-center">
                <h1>Login</h1>
                <h4>Access your account here!!</h4>
            </div>
        </div>
    </main>
    <section>
        <div>
            <form id="loginForm"  method="post" action="Login/login">
                <h1>Login:</h1>
                <?php
                if($this->session->flashdata('message'))
                    {
                        echo '
                        <div class="alert alert-danger">
                            '.$this->session->flashdata("message").'
                        </div>
                        ';
                    }
                ?>
                <!-- One "tab" for each step in the form: -->
                <div class="tab">Login Info:
                    <p class="errorField" errorField="email">Enter Email</p>
                    <p><input class="input required" id="email" errorField="email" placeholder="Email..." name="email"></p>
                    <p class="errorField" errorField="password">Enter password more than 6 digits</p>
                    <p><input class="input required" id="password" placeholder="Password..." errorField="password" name="password" type="password"></p>
                </div>
                <div style="overflow:auto;">
                    <div style="float:left; line-height: 10px; font-size: 13px">
                        <p style="color: red">Don't have an account? </p>
                        <p><a href="<?=base_url('User/register#regForm')?>">Click here</a> to register</p>
                    </div>
                    <div style="float:right;">
                        <button type="button" id="submitLoginBtn" type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>