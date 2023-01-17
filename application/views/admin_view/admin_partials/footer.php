</div>
</div>
<script>
    $(document).ready(function(){
        // document.getElementById("leftSidenav").style.width = "250px";
        let state = false;
        $("#menu-icon").click(function(){
            let width = $(window).width();
            console.log(width);
            if (width <= 750) state = true;
            if (state){
                if (width <= 750){
                    console.log("KKKKKk")
                    document.getElementById("leftSidenav").style.width = "100%";
                }
                else{
                    console.log("nnnnnnnnk")
                    document.getElementById("leftSidenav").style.width = "250px";
                    document.getElementById("main").style.marginLeft = "243px";
                }
                state = false;
            }
            else{
                document.getElementById("leftSidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
                state = true;
            }
        })

        $(".closebtn").click(function(){
            document.getElementById("leftSidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            state = true;
        })



    })
function toggleShowNav() {
    
}

</script>
<script src="<?=base_url('public/js/calendar.js')?>"></script>
   
</body>
</html> 
