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
                <h1>Register</h1>
                <h4>Your Orphanage Here</h4>
            </div>
        </div>
    </main>
    <section>
        <div>
            <form id="regForm">
                <h1>Register:</h1>
                <!-- One "tab" for each step in the form: -->
                <div class="tab">Name:
                    <p class="errorField" errorField="name">Enter Name of Orphanage</p>
                    <p><input class="input required" id="name" errorField="name" placeholder="Name of Orphanage..." name="orphanage"></p>
                    <p class="errorField" errorField="owner">Enter Name of Owner</p>
                    <p><input class="input required" id="owner" errorField="owner" placeholder="Name(s) of Owner(s)..." type="text" name="owner"></p>
                </div>
                <div class="tab">Contact Info:
                    <p class="errorField" errorField="phone">Enter Phone Number</p>
                    <p><input class="input required" id="phone" errorField="phone" placeholder="Phone Number..." name="phone"></p>
                    <p class="errorField" errorField="address">Enter Phone Number</p>
                    <p><input class="input required" id="address" errorField="address" placeholder="Address..." name="address"></p>
                </div>
                <div class="tab">Login Info:
                    <p class="errorField" errorField="email">Enter Email</p>
                    <p><input class="input required" id="email" errorField="email" placeholder="Email..." name="email"></p>
                    <p class="errorField" errorField="password">Enter password more than 6 digits</p>
                    <p><input class="input required" id="password" placeholder="Password..." errorField="password" name="password" type="password"></p>
                    <p class="errorField" errorField="confirm_password">Password do not match</p>
                    <p><input class="input required" id="confirm_password" errorField="confirm_password" placeholder="Confirm password..." name="c_pword" type="password"></p>
                </div>
                <div style="overflow:auto;">
                    <div style="float:left; line-height: 10px; font-size: 13px">
                        <p style="color: red">Already Registered? </p>
                        <p><a href="<?=base_url('index.php/Login/index#loginForm')?>">Click here</a> to Login</p>
                    </div>
                    <div style="float:right;">
                        <button type="button" id="prevBtn">Previous</button>
                        <button type="button" id="nextBtn">Next</button>
                        <button type="button" id="submitBtn">Submit</button>
                    </div>
                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center; margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>
        </div>
    </section>
</div>