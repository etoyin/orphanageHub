$(".ok").click(function(){
    $(".overlay_success, .overlay_error").css("width", "0");    
})
$(".hideOverlay").click(function(){
    $(".overlay_upload_images").css("display", "none");
})


// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener('click', (e) => {
        inputElement.click();
    })
    inputElement.addEventListener('change', () => {
        if(inputElement.files.length){
            fileInput = inputElement.files;
            // console.log(inputElement.files[0].width);
            updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
    })

    dropZoneElement.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over")
    });
    ["dragleave", "dragend"].map((type) => {
        dropZoneElement.addEventListener(type, (e) => {
            dropZoneElement.classList.remove("drop-zone--over")
        });
    })

    dropZoneElement.addEventListener('drop', (e) => {
        e.preventDefault();

        if(e.dataTransfer.files.length){
            // let inputElement = $(this);
            inputElement.files = e.dataTransfer.files;
            fileInput = inputElement.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("drop-zone--over");
    });
})

function updateThumbnail(dropZoneElement, file){
        
    let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");


    //first time remove the prompt from div
    if(dropZoneElement.querySelector(".drop-zone__prompt")){
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
    }
    // first time there's no thumbnail element so we create it
    if(!thumbnailElement){
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("drop-zone__thumb");
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    if(file.type.startsWith("image/")){
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = function(){
            thumbnailElement.style.backgroundImage = `url("${reader.result}")`;
        }
    }
    else{
        $(".drop-zone__thumb").css("background-image", null)
    }
}


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
let state = {};
let fileInput;
let imgFile;
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
var _URL = window.URL || window.webkitURL;
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
        fd.append('country', state.country);
        fd.append('image', fileInput[0]);
        
        // function pageRedirect() {
        //   window.location.replace('/');
        // }
        $("#regForm").submit();
      
        // fetch('regSubmit', {
        //   method: 'POST',
        //   body: fd,
        // })
        // .then(response => {
        //   return response.json();
        // })
        // .then(res => {
        //     console.log(res);
        //   if(res.status == 1){
        //     $(".overlay_loader").css("display", "none");
        //     $(".overlay_success").css("width", "100%");
        //   }else{
        //     $(".overlay_loader").css("display", "none");
        //     $("#errorMessage").text(res.message);
        //     $(".overlay_error").css("width", "100%");
        //     // alert("Your email address might have been used for registration before")
        //   }
        // })
        // .then(() => {
        //     $(".overlay_loader").css("display", "none");
        // })
      }

})



$("#nextBtn, .nextFormSlide").click(function(){
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
                case "profilePicture":
                    var file, img; 
                    var dimension = {};
                    let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                    if(fileInput && fileInput.length){
                        file = fileInput[0];
                        fileSize = Math.round((file.size / 1024));
                        console.log(file);
                        img = new Image();
                        var objectUrl = _URL.createObjectURL(file);
                        img.onload = function () {
                            // alert(this.width + " " + this.height);
                            dimension.width = this.width;
                            dimension.height = this.height;
                            _URL.revokeObjectURL(objectUrl);
                        };
                        img.src = objectUrl;
                        if (dimension.width/dimension.height < 1.3){
                            valid  = false;
                            $(this).addClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).text("Error!!! Your picture should be in landscape form!");
                                    $(this).css("display", "block");
                                }
                            });
                        }else if (fileSize > 16000){
                            valid  = false;
                            $(this).addClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).text("Error!!! Your picture is too large, upload a file below 15mb!");
                                    $(this).css("display", "block");
                                }
                            });
                        }else if (fileSize < 500){
                            valid  = false;
                            $(this).addClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).text("Error!!! Your picture is too small, upload a file above 500kb!");
                                    $(this).css("display", "block");
                                }
                            });
                        } else if (!allowedExtensions.exec(file.name)){
                            valid  = false;
                            $(this).addClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).text("Error!!! Your file must be a picture!");
                                    $(this).css("display", "block");
                                }
                            });
                        }                        
                        else{
                            valid  = true;
                            $(this).removeClass("invalid");
                            let attr = $(this).attr("id");
                            $(".errorField").each(function(){
                                if($(this).attr("errorField") == attr){
                                    $(this).css("display", "none");
                                }
                            });
                        }
                    }
                    else{
                        // console.log("kgkgk");
                        valid  = false;
                        $(this).addClass("invalid");
                        let attr = $(this).attr("id");
                        $(".errorField").each(function(){
                            if($(this).attr("errorField") == attr){
                                $(this).css("display", "block");
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