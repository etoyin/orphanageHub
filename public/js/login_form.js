$(document).ready(function(){

    $(".input-email").bind("keyup",function(e){
        let attr = $(this).attr("data-hold");
        // let value = ;
        // console.log(value);
        if (e.target.value.length < 3){
            console.log("lessss");
            $("#"+attr).css("display", "block");
        }else{
            $("#"+attr).css("display", "none");
        }
    })

    let base_url = window.location.origin;

    $("#submit-email").click(function(){
        let name = $("#name").val();
        let subject = $("#subject").val();
        let content = $("#content").val();
        if ((name.length > 3) && (subject.length > 3) && (content.length > 3)){
            $(".errorGen").css("display", "none");
            $(".la-spinner").css("display", "block");
            console.log("yesssssssss");
            let formData = new FormData();
            formData.append("name", name);
            formData.append("subject", subject);
            formData.append("content", content);

            fetch(base_url +"/Home/submit_email", {
                method: "post",
                body: formData
            })
            .then((res) => res.json())
            .then((res) => {
                $(".la-spinner").css("display", "none");
                if(res.status == 1){
                    $(".alert-e").css("display", "block").addClass("alert-success").text(res.message);
                    $(".alert-e").css("display", "block").removeClass("alert-danger");
                }else{
                    $(".alert-e").css("display", "block").addClass("alert-danger").text(res.message);
                    $(".alert-e").css("display", "block").removeClass("alert-success");
                }
            });
        }else{
            $(".errorGen").css("display", "block");
            console.log("Noooooooooo");
        }
    })
    
    $("#submitLoginBtn").on("click", function(e){
        e.preventDefault();
        let email = $("#email").val();
        let password = $("#password").val();
        //console.log(state);
        if((email.length > 2 ) && (password.length > 2) ){
            $(".overlay_loader").css("display", "block");
            const fd = new FormData();
            fd.append('email', email);
            fd.append('password', password);
            $("#loginForm").submit();
        }

    })
})