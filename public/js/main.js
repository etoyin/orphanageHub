$(document).ready(function(){
    $("#owl-demo").owlCarousel({
        navigation : true, 
        slideSpeed : 300,
        paginationSpeed : 500,
        items: 1,
        singleItem: true,
        autoPlay : 4000
    });


    $(window).scroll(function(){
        let scroll = $(window).scrollTop();

        if (scroll > 470){
            $(".card-div").css("position", "fixed");
			$(".card-div").css("top", "150px");
			// $(".card-div").css("left", "0");
			// $(".card-div").css("margin-top", "0");
			$(".card-div").css("z-index", "2");
        }
        else{
            $(".card-div").css("position", "static");
        }
    });
    // $(".editDetails")
    $(".editDetails-switch").click(function(){
        $(".editOverlay-switch").css("display", "block");
    })

    let id;
    let attr;
    $(".editDetails").click(function(){
        id = $("#keep-data").attr("data-keep");
        let db = "db";
        attr = $(this).attr("edit-Data");
        let attrData
        if (attr == "open_for_adoption") attrData = "adoption status";
        else if (attr == "boys") attrData = "Number of Boys";
        else if (attr == "girls") attrData = "Number of Girls";
        else if (attr == "phone_number") attrData = "Phone Number";
        else if (attr == "mission_statement") attrData = "Mission Statement";
        else attrData = attr;
        $("span[valueToEdit]").text(attrData);

        switch (attr) {
            case "name":
                $(".inputDiv").html(`<input id="editInput" value="${$(this).attr(db)}" type="text" class="form-control" />`);
                break;
            case "mission_statement":
                $(".inputDiv").html(`<textarea id="editInput" value="" class="form-control">${$(this).attr(db)}</textarea>`);
                break;
            case "boys":
                $(".inputDiv").html(`<input id="editInput" value="${$(this).attr(db)}" type="text" class="form-control" />`);
                break;
            case "girls":
                $(".inputDiv").html(`<input id="editInput" value="${$(this).attr(db)}" class="form-control" />`);
                break;
            case "phone_number":
                $(".inputDiv").html(`<input id="editInput" value="${$(this).attr(db)}" class="form-control" />`);
                break;
            case "address":
                $(".inputDiv").html(`<input id="editInput" value="${$(this).attr(db)}" type="text" class="form-control" />`);
                break;
            case "website":
                $(".inputDiv").html(`<input id="editInput" value="${$(this).attr(db)}" type="text" class="form-control" />`);
                break;
            default:
                break;
        }

        $(".editOverlay").css("display", "block");
    });

    $("#submit").click(function(){
        let value = $("#editInput").val();
        $(".overlay_loader").css("display", "block");
        let formdata = new FormData();
        formdata.append("id", id);
        formdata.append(attr, value);
        formdata.append("column_name", attr);

        console.log(value);
        console.log(attr);
        console.log(id);

        fetch('update_data', {
            method: 'POST',
            body: formdata,
        })
        .then(res => res.json())
        .then(res => window.location.reload())

    })

    $("#submit-switch").on('click', function(){
        // alert("kkkkkkkkkkkkkkk");
        // alert(getLocalStorage.admin);
        id = $("#keep-data").attr("data-keep");
            let status = $("#user").is(":checked") ? 1 : 0;
            // alert(data_id)
            let formdata = new FormData();
            formdata.append("id", id);
            formdata.append("open", status);

            console.log(status);
            console.log(id);

            fetch('open_for_adoption', {
                method: 'POST',
                body: formdata,
            })
            .then((res) => res.json())
            .then(res => {
                console.log(status);
                console.log(res);
                if (res.verify == 1){
                    $(this).prop('checked', 'true');
                    console.log("Yesssss!");
                    $("#text"+res.id).text("Verified");
                }else{
                    $(this).removeAttr('checked');
                    $("#text"+res.id).text("Not Yet Verified");
                }
                window.location.reload();
            });
    })

    $(".hideOverlay").click(function(){
        $(".editOverlay, .editOverlay-switch").css("display", "none");
    })

    $("#submit_reply").click(function(){
        let reply_content = $("#reply_content").val();
        let name_reply = $("#user_name_reply").attr("data-user_name");
        if(!name_reply){
            name_reply = $("#name_reply").val();
        }
        let comment_id = $("#comment_id").attr("data_id");

        if (reply_content.length > 0){
            $(".error_reply").css("display", "none");
            console.log(reply_content, name_reply, comment_id);

            let formData = new FormData();

            formData.append("id", comment_id);
            formData.append("name_reply", name_reply);
            formData.append("reply_content", reply_content);

            fetch('../post_reply', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(res => {
                string_literal = string_literal + `<div class="mt-3">
                <p class="">${reply_content}</p>
                <p class="h6"> by ${name_reply.length > 0 ? name_reply : "Anonymous"} just now</p>
                </div>`;
                $(".replies").html(string_literal);
            })

        }
        else{
            $(".error_reply").css("display", "block");
        }
    })
    let string_literal = ``;
    $(".card-body").find(".reply-button").each(function(i){
        $(this).click(function(){
            let value_id = $(this).attr('data_id2')
            fetch('../getOneComment/'+value_id)
            .then(res => res.json())
            .then(res => {
                $("#comment").text(res[0].comment);
                $("#name_comment").text(res[0].name_comment);
                let replies = res[0].replies;
                $("#comment_id").attr("data_id", res[0].id);

                for (let i=0; i<replies.length; i++){
                    string_literal = string_literal + `<div class="mt-3">
                    <p class="">${replies[i].content}</p>
                    <p class="h6"> by ${replies[i].name_reply} at ${replies[i].created_at}</p>
                    </div>`;
                }
                $(".replies").html(string_literal);
                $(".reply-section").css("display", "block");
            })
        })
    })

    

    $(".cancel").click(function(){
        $(".reply-section").css("display", "none");
        // $(".replies").remove();
        window.location.reload();
    });

    /////////////////-------------POST COMMENTS -----------////////////////////////////////////////
    $("#send_comments").click(function(){
        // console.log("kkjjdjd");
        let comment = $("#comment").val();
        let name_comment = $("#user_name").attr("data-user_name");
        if(!name_comment){
            name_comment = $("#name_comment").val();
        }
        let orphanage_id = $("#orphanage_id").attr("data-id");

        if (comment.length > 0){
            $(".errorField").css("display", "none");
            console.log(comment, name_comment, orphanage_id);

            let formData = new FormData();

            formData.append("id", orphanage_id);
            formData.append("name_comment", name_comment);
            formData.append("comment", comment);

            fetch('../post_comment', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.json())
            .then(res => console.log(res))

        }
        else{
            $(".errorField").css("display", "block");
        }
        
    })

    ///////////////////////////////////////////////CREATE EVENTS///////////////////////////////////////////

    $("#create_event").submit(function(e){
        e.preventDefault();
        let eventName = $("#event-name").val();
        let eventDate = $("#event-date").val();
        let eventTime = $("#event-time").val();
        let eventLocation = $("#event-location").val();
        let eventDescription = $("#event-description").val();

        let state = {};

        if(/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/.test(eventTime)){
            state.timeV = true;
            state.timeErr = "";
        }
        else{
            state.timeV = false;
            state.timeErr = "Input correct time format!\n";
        }
        if(eventLocation.length > 4){
            state.locationV = true;
            state.locationErr = "";
        }
        else{
            state.locationV = false;
            state.locationErr = "Input location!\n";
        }
        if(/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/.test(eventDate)){
            state.dateV = true;
            state.dateErr = "";
        }
        else{
            state.dateV = false;
            state.dateErr = "Input correct date format!\n"
        }
        if(eventName.length > 2){ 
            state.NameV = true;
            state.NameErr = "";
        }
        else{
            state.NameV = false;
            state.NameErr = "Input name\n";
        }
        if(eventDescription.length > 4){ 
            state.descriptionV = true;
            state.descriptionErr = "";
        }
        else{
            state.descriptionV = false;
            state.descriptionErr = "Input description\n";
        }
        let id = $(".getDataId").attr("data_id");
        let name = $(".getDataName").attr("data_name");
       
        let allErr = state.NameErr + state.timeErr + state.dateErr + state.descriptionErr + state.locationErr;
        if(state.NameV && state.dateV && state.timeV && state.descriptionV && state.locationV){

            $("#event-name").val("");
            $("#event-date").val("");
            $("#event-time").val("");
            $("#event-location").val("");
            $("#event-description").val("");

            let formdata = new FormData();
            formdata.append("name", eventName)
            formdata.append("time", eventTime)
            formdata.append("location", eventLocation)
            formdata.append("date", eventDate)
            formdata.append("description", eventDescription)
            formdata.append("id", id)
            formdata.append("orphanageName", name)
            fetch('event_post', {
                method: 'POST',
                body: formdata,
            })
            .then(res => res.json())
            .then(res => {
                if (res){
                    alert("Successfull");
                }else{
                    alert("Not Successfull");
                }
            })
        }else{
            alert(allErr);
        }


    })



})
