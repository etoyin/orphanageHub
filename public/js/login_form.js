$(document).ready(function(){
    
    $("#submitLoginBtn").on("click", function(e){
        e.preventDefault();
        let email = $("#email").val();
        let password = $("#password").val();
        //console.log(state);
        // $("#loginForm").submit();
        if((email.length > 2 ) && (password.length > 2) ){
            $(".overlay_loader").css("display", "block");
            const fd = new FormData();
            fd.append('email', email);
            fd.append('password', password);
            
            // function pageRedirect() {
            //   window.location.replace('/');
            // }
        
            fetch('login', {
            method: 'POST',
            body: fd,
            })
            .then(response => {
                return response.json();
            })
            .then(res => {
                console.log(res);
            if(res.status == 1){
                $(".overlay_loader").css("display", "none");
                $(".overlay_success").css("width", "100%");
            }else{
                $(".overlay_loader").css("display", "none");
                $("#errorMessage").text(res.message);
                $(".overlay_error").css("width", "100%");
                // alert("Your email address might have been used for registration before")
            }
            })
            .then(() => {
                $(".overlay_loader").css("display", "none");
            })
        }

    })
})