$(".ok").click(function(){
    $(".overlay_success, .overlay_error").css("width", "0");    
})

let state = {};
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

let pswd;

$("#submitBtn").on("click", function(e){
    e.preventDefault();
    $(".tab").each(function(i){
        if(currentTab == i){
            $(this).find(".required").each(function(){
                switch ($(this).attr("id")) {
                    case "email":
                        let emailValid = /^([\w.%+-]+)@([\w-]+\.)+([\w]{2,})$/.test(String($(this).val()).toLowerCase());
                        if(!emailValid){
                            valid  = false;
                            $(this).addClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).css("display", "block");
                                }
                            });
                        }else{
                            valid  = true;
                            $(this).removeClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).css("display", "none");
                                }
                            });
                        };
                        break;
                    case "password":
                        if($(this).val().length < 6){
                            valid  = false;
                            $(this).addClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).css("display", "block");
                                }
                            });
                        }else{
                            valid  = true;
                            pswd = $(this).val();
                            $(this).removeClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).css("display", "none");
                                }
                            });
                        }
                        break;
                    case "confirm_password":
                        if($(this).val() != pswd){
                            valid  = false;
                            $(this).addClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).css("display", "block");
                                }
                            });
                        }else{
                            valid  = true;
                            $(this).removeClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).css("display", "none");
                                }
                            });
                        }
                        break;
                }
            })
            $(this).find(".input").each(function(){
                let attr = $(this).attr("id");
                state[attr] = $(this).val();
            })
    	    // $(this).css("display", "none")
        }
    })
    //console.log(state);
    // $("#regForm").submit();
    if(valid){
         $(".overlay_loader").css("display", "block");
        const fd = new FormData();
        fd.append('orphanage', state.name);
        fd.append('address', state.address);
        fd.append('email', state.email);
        fd.append('password', state.password);
        fd.append('phone', state.phone);
        fd.append('owner', state.owner);
        
        // function pageRedirect() {
        //   window.location.replace('/');
        // }
      
        fetch('regSubmit', {
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



$("#nextBtn").click(function(){
    if (currentTab < ($(".tab").length - 1)) {
        nextPrev(1)
    }
})
$("#prevBtn").click(function(){
    nextPrev(-1)
})

function showTab(n) {
  // This function will display the specified tab of the form...  
  let tabs = $(".tab");
  $(".tab").each(function(i, each){
  	if(n == i){
    	$(this).css("display", "block")
    }
  });
  
  if (n == 0) {
    $("#prevBtn").css("display","none");
  } else {
      $("#prevBtn").css("display","inline");
  }
  if (n == (tabs.length - 1)) {
    $("#nextBtn").css("display", "none");
    $("#submitBtn").css("display", "inline");
  } else {
    $("#nextBtn").css("display", "inline");
    $("#submitBtn").css("display", "none");
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  
    let tabs = $(".tab");
    if (n == 1 && !validateForm()) return false;
    $(".tab").each(function(i){
        if(currentTab == i){
            $(this).find(".input").each(function(){
                let attr = $(this).attr("id");
                state[attr] = $(this).val();
            })
    	    $(this).css("display", "none")
        }
    })
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= tabs.length) {
      // ... the form gets submitted:
      
      return false;
    }  
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
    let valid = true;
  // This function deals with validation of the form fields
  $(".tab").each(function(i){
    if(currentTab == i){
        $(this).find(".required").each(function(i){
            switch ($(this).attr("id")) {
                case "phone":
                    if(typeof(Number($(this).val())) !== 'number' || $(this).val().length < 11){
                        valid  = false;
                        $(this).addClass("invalid");
                        let attr = $(this).attr("id");
                        $(".errorField").each(function(){
                            if($(this).attr("errorField") == attr){
                                $(this).css("display", "block");
                            }
                        });
                    }else{
                        $(this).removeClass("invalid");
                        let attr = $(this).attr("id");
                        $(".errorField").each(function(){
                            if($(this).attr("errorField") == attr){
                                $(this).css("display", "none");
                            }
                        });
        
                    }
                    break;
                default:
                    if($(this).val().length < 1){
                        valid  = false;
                        $(this).addClass("invalid");
                        let attr = $(this).attr("id");
                        $(".errorField").each(function(){
                            if($(this).attr("errorField") == attr){
                                $(this).css("display", "block");
                            }
                        });
                    }else{
                        $(this).removeClass("invalid");
                      let attr = $(this).attr("id");
                      $(".errorField").each(function(){
                        if($(this).attr("errorField") == attr){
                            $(this).css("display", "none");
                        }
                      });
                    }
            }
        })
    }
  })
  if (valid) {
    $(".step").each(function(i){
        if (i == currentTab){
            $(this).addClass("finish");
        }
    })
  }
  return valid; // return the valid status
  
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}