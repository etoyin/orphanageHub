$(document).ready(function(){

    $("#submit_add_admin").click(function(e){
        e.preventDefault()
        let pin = $("#pin").val();

        if(pin.length < 4){
            $(".pin_error").css("display", "block");
        }else{
            $(".pin_error").css("display", "none");
            $("#add_admin").submit();
        }
    })

    $(".close-add-admin").click(function(){
        $(".overlay-pin").css("display", "none");
        $('input:checkbox').prop("checked", false);
    })
    let un = false;
    let pwd = false;
    let cpwd = false;
    let username;
    let password;
    let cat_name;

    $("#admin_submit_admin").click(function(){
        username = $("#username").val();
        password = $("#password").val();
        let confirm_password = $("#confirm_password").val();
        if(username.length <= 2){
            $(".username_error").css("display", "block");
            un = false;
        }
        else{
            $(".username_error").css("display", "none");
            un = true;
        }

        if(password.length <= 6){
            $(".password_error").css("display", "block");
            pwd = false;
        }
        else{
            $(".password_error").css("display", "none");
            pwd = true;
        }
        if(password !== confirm_password){
            $(".confirm_password_error").css("display", "block");
            cpwd = false;
        }
        else{
            $(".confirm_password_error").css("display", "none");
            cpwd = true;
        }
        if(un && pwd && cpwd){
            $(".overlay-pin").css("display", "block");
        }

    })

    /////////////////////////////////////////////select africa countries///////////////////////////////////////////////////////////////////////

fetch("https://restcountries.com/v3.1/region/africa")
.then(res => res.json())
.then(res => {
    let sortAlpha = res.sort((a, b) => {
        return (a.name.common < b.name.common ? -1 : 1);
    })
    for (let i in sortAlpha){
        $("#country").append(`
            <option value="${sortAlpha[i].name.common}">${sortAlpha[i].name.common}</option>
        `)
        // return console.log(i);
    }
    
    // return console.log(sortAlpha[5].name);
})





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////AD CATEGORY/////////////////////////////////////////////////////
    $("#add_cat").click(function(){
        cat_name = $("#cat_name").val();
        if(cat_name.length <= 2){
            $(".cat_error").css("display", "block");
            un = false;
        }
        else{
            $(".cat_error").css("display", "none");
            un = true;
        }
        if(un){
            $(".overlay-pin").css("display", "block");
        }

    })
    

    $("#submit_cat").click(function(e){
        e.preventDefault()
        let pin = $("#pin").val();

        if(pin.length < 4){
            $(".pin_error").css("display", "block");
        }else{
            $(".pin_error").css("display", "none");
            $("#add_cat_form").submit();
        }
    })


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $(".delete").click(function(){
        $(".overlay-pin").css("display", "block");
        checkboxValue = $("input:checked").val();
        // alert(checkboxValue);
    })

    let checkboxValue;

    $("#delete_admin").click(function(e){
        e.preventDefault();
        // alert("ksksk")
        let pin = $("#pin").val();

        if(pin.length < 4){
            $(".pin_error").css("display", "block");
        }else{
            $(".pin_error").css("display", "none");
            const fd = new FormData();
            fd.append('id', checkboxValue);
            fd.append('pin', pin);

            fetch('delete_admin', {
                method: 'POST',
                body: fd,
            })
            .then(res => res.json())
            .then(res => {
                window.location.reload();
                // console.log(res);
            })
            // $("#delete_admin_").attr("action", `delete_admin/${pin}/${checkboxValue}`).submit();
        }
    });
    let hide = true;

    $(".arrow-toggle").click(function(){
        hide = !hide;
        if(!hide){
            $(this).html(`<i class="las la-angle-up"></i>`)
        }
        else{
            $(this).html(`<i class="las la-angle-down"></i>`)
        }
        $(".blog-menu").toggle(1000);
    })

})