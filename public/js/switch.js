$(document).ready(function(){
    
    $(".orphanage_verify_container").find("input[type='checkbox']").each(function(i){
        $(this).on('change', function(){
            // alert("kkikikkk");
            let data_id = $(this).attr("data-id");
            // alert(getLocalStorage.admin);
                let status = $(this).is(":checked") ? 1 : 0;
                // alert(data_id)
                let formdata = new FormData();
                formdata.append("id", data_id);
                formdata.append("verified", status);

                // console.log(formdata.getAll("id"));

                fetch('verify_orphanage', {
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
                });
        })
        // let trai = state[attr];
        // for (let j in trai){
        //   if(trai[j] == $(this).val()){
        //     $(this).prop('checked', 'true');
        //   }
        // }
      });

})