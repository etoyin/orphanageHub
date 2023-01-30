$(document).ready(function(){

        // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");

        dropZoneElement.addEventListener('click', (e) => {
            inputElement.click();
        })
        inputElement.addEventListener('change', () => {
            if(inputElement.files.length){
                fileInput = inputElement.files;
                console.log(inputElement.files);
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




    const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'blog_images_upload');
      
        xhr.upload.onprogress = (e) => {
          progress(e.loaded / e.total * 100);
        };
      
        xhr.onload = () => {
          if (xhr.status === 403) {
            reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
            return;
          }
      
          if (xhr.status < 200 || xhr.status >= 300) {
            reject('HTTP Error: ' + xhr.status);
            return;
          }
      
          const json = JSON.parse(xhr.responseText);
      
          if (!json || typeof json.location != 'string') {
            reject('Invalid JSON: ' + xhr.responseText);
            return;
          }
      
          resolve(json.location);
        };
      
        xhr.onerror = () => {
          reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };
      
        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    });

    $('textarea#editorjs').tinymce({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
          { value: 'First.Name', title: 'First Name' },
          { value: 'Email', title: 'Email' },
        ],
        images_upload_handler: example_image_upload_handler
      });

      let fileInput;
    $("#save").click(function(e){
        e.preventDefault();
        let value = $("textarea#editorjs").val();
        let cat = $("#category").val();
        let title = $("#title").val();
        let catSta = false;
        let valueSta = false;
        let featuredImageSta = false;
        let titleSta = false;
        if (value.length < 10){
            $("#text-error").css("display", "block");
            valueSta = false;
        }
        else{
            $("#text-error").css("display", "none");
            valueSta = true;
        }

        if (cat.length < 1){
            $("#cat-error").css("display", "block");
            catSta = false;
        }
        else{
            $("#cat-error").css("display", "none");
            catSta = true;
        }

        if (title.length < 1){
            $(".title-error").css("display", "block");
            titleSta = false;
        }
        else{
            $(".title-error").css("display", "none");
            titleSta = true;
        }

        if(fileInput && fileInput.length){
            let file = fileInput[0];
            fileSize = Math.round((file.size / 1024));
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            console.log(file);
            if (fileSize > 6000){
                $(".image-error").css("display", "block").text("File Size too large, upload file less than 5mb!!!");
                featuredImageSta = false;
            } else if (!allowedExtensions.exec(file.name)){
                $(".image-error").css("display", "block").text("Uploaded file must be an image!!!");
                featuredImageSta = false;
            }else{
                $(".image-error").css("display", "none");
                featuredImageSta = true;

            }           
            
        }else{
            $(".image-error").css("display", "block");
            featuredImageSta = true;
        }

        if (catSta && valueSta){
            $(".overlay-pin").css("display", "block");
            console.log(cat);
        }


        // $("#display").html(value)
    })


    $("#submit_blog_post").click(function(e){
        e.preventDefault();
        let pin = $("#pin").val();

        if(pin.length < 4){
            $(".pin_error").css("display", "block");
        }else{
            $(".pin_error").css("display", "none");
            $("#post_blog").submit();
        }
    })



})