<footer id="footer" class="footer hidden">
            <div class="social">
                <div class="p-4 d-flex flex-md-wrap justify-content-between">
                    <div>
                        <i class="las la-copyright"></i> 2023 The Orphanage all rights reserved | 806 000 5000 | info@theorphanagehub.org | PO BOX 1403, Lagos, NG.
                    </div>
                    <div>
                        <a href="#" target="_blank" rel="noopener noreferrer">
                            <i class="lab la-facebook-f mr-2"></i>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer">
                            <i class="lab la-instagram mr-2"></i>
                        </a>
                        <a href="#" target="_blank" rel="noopener noreferrer">
                            <i class="lab la-twitter"></i>
                        </a>
                    </div>
                </div>
                <p class="ml-2" style="font-size: 12px; line-height: 12px; margin-bottom: 0">
                    Image by <a href="https://www.freepik.com/free-photo/african-kid-learning-class_13106457.htm#query=black%20children&position=4&from_view=search&track=sph" target="_blank">Freepik</a>
                </p>
            </div>
            
        </footer><!-- site-footer -->
        
    </div><!-- #wrapper -->
    <script src="<?=base_url('public/js/registration_form.js')?>"></script>
    <script src="<?=base_url('public/js/login_form.js')?>"></script>
    <script src="<?=base_url('public/js/admin_login.js')?>"></script>
    <script src="<?=base_url('public/js/payment_donation.js')?>"></script>
    <!-- ================================================The Animation Script====================================== -->
    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting){
                    entry.target.classList.add("show");
                }
                else{
                    entry.target.classList.remove("show");
                }
            });
        });

        const hiddenElements = document.querySelectorAll(".hidden");
        hiddenElements.forEach(element => observer.observe(element));
    </script>
</body>

</html>