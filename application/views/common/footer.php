<footer>
    <div class="container-fluid">
        <div class="footer-wrap">
            <div class="footer-child-1">
                <h6 class="footer-h6">Quick Services</h6>
                <ul class="footer-ul">
                    <li><a href="<?= base_url('checkout') ?>">Checkout</a></li>
                    <li><a href="<?= base_url('/shopping/cart') ?>">Shopping Cart</a></li>
                    <!--<li><a href="#">Wish List</a></li> -->
                    <!--<li><a href="#">Redeem Voucher</a></li>-->
                </ul>
            </div>
            <!-- 1 -->
            <div class="footer-child-1">
                <h6 class="footer-h6">Customer Service</h6>
                <ul class="footer-ul">
                    <li><a href="<?= base_url('help-center'); ?>">Help Center</a></li>
                    <li><a href="<?= base_url('returns_policy'); ?>">Return Policy</a></li>
                    <li><a href="<?= base_url('about_us') ?>">About Us</a></li>
                    <li><a href="<?= base_url('store-location') ?>">Find us on Map</a></li>
                    <li><a href="<?= base_url('privacy-cookies_policy') ?>">Privacy & Cookies policy</a></li>
                    <li><a href="<?= base_url('faq') ?>">FAQs</a></li>
                </ul>
            </div>
            <!-- 2 -->
            <div class="footer-child-1">
                <h6 class="footer-h6">My Services</h6>
                <ul class="footer-ul">
                    <?php if ($this->session->userdata('user_login') == 1) : ?>
                        <li><a href="<?= base_url('customer/account/index'); ?>">My Account</a></li>
                    <?php else : ?>
                        <li><a href="<?= base_url('account-login'); ?>">Sign In</a></li>
                        <li><a href="<?= base_url('create-an-account'); ?>">Create Account</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- 3 -->
            <div class="footer-child-2">
                <h6 class="footer-h6">Subscribe</h6>
                <ul class="footer-ul">
                    <li>
                        <form class="footer-form" id="newsletterEmails" action="<?= base_url('home/get_newsletter_emails'); ?>">
                            <input type="text" placeholder="Email Address" id="subscribeSrEmailz" autocomplete="off">
                            <button type="submit" class="btn btn-footer" id="subscribeButton">Subscribe</button>
                        </form>
                    </li>
                    <li>
                        <p class="footer-p-1">Subscribe to our newsletter to get updates on our latest offers!</p>
                    </li>
                    <li>
                        <h5 class="footer-p-2">Payment Methods</h5>
                    </li>
                    <li>
                        <ul class="sub-ul-footer">
                            <li><a href="#"><img src="<?= base_url() ?>assets/img/mpesa-seeklogo.com 1.svg" alt=""></a></li>
                            <li><a href="#"><img src="<?= base_url() ?>assets/img/319.svg" alt=""></a></li>
                            <li><a href="#"><img src="<?= base_url() ?>assets/img/Group.svg" alt=""></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- 3 -->
        </div>
    </div>
</footer>
<div class="footer-bottom">
    <?php $whiteLogo = $this->db->get('ptz_white_logo')->row(1)->logo_image; ?>
    <div class="container-fluid">
        <div class="footer-wrap-bottom">
            <div id="logo-bottom">
                <img src="<?= imagebaseURL . $whiteLogo ?>" alt="">
            </div>
            <div class="wrap-copy">
                <p>Copyright &copy; Patazon, Inc All Rights Reserved.</p>
            </div>
            <ul class="footer-bottom-icon">
                <li><a href="https://www.linkedin.com/company/patazone/" target="blank"><i class="fab fa-linkedin-in"></i></a></li>
                <li><a href="https://www.facebook.com/111096821253156/" target="blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="https://twitter.com/patazon1?s=11" target="blank"><i class="fab fa-twitter"></i></a></li>

                <li><a href="https://instagram.com/pata.zon?utm_medium=copy_link" target="blank"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<?php $this->load->view('common/homesliders/cart-modal'); ?>
<?php $this->load->view('common/homesliders/modals'); ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url() ?>assets/js/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>assets/js/owl.js"></script>
<!-- bootstrap js link -->


<?php if ($title != 'Buy now Pay later' && $title != 'Patazone|Lipalater Register') : ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').select2({

            });

        });
    </script>
<?php endif; ?>

<script src="<?= base_url() ?>assets/js/news-letter.js"></script>
<script src="<?= base_url() ?>assets/js/srch.js"></script>
<script src="<?= base_url() ?>assets/js/toastr.min.js"></script>
<script>
    window.addEventListener("load", function() {

        // $(".hero-child-2").css("visibility", "visible");
        $(".tab-content").css("visibility", "visible");
        // $(".loading").css("visibility", "hidden");
        // $(".shine").css("visibility", "hidden");
        // $("div").removeClass("shine");
        $("div").removeClass("skeleton");
        $("div").removeClass("skeleton-text");
        // $("div").removeClass("loadi");
    })
</script>
<script>
    var url = '<?= base_url() ?>'
    var endpoint = 'https://sellercenter.patazone.co.ke/'
    var session_redirect = '<?= $this->session->userdata('redirect-url') ?>'
    var redirect = session_redirect ? '<?= $this->session->userdata('redirect-url') ?>' : '<?= base_url() ?>'
    var phoneNumber = '<?php echo $this->session->userdata('phone') ?>'
    var cartTotal = '<?php echo $this->cart->total() ?>'
    var loginStatus = '<?= $this->session->userdata('user_login'); ?>'
    var title = '<?= $title; ?>'

    $('#logo').on('click', () => {
        window.location.href = url;
    })

    <?php if ($this->session->flashdata('warning') != '') : ?>
        Command: toastr['warning']('<?= $this->session->flashdata('warning'); ?>')
        // Command: toastr["success"]("<?php echo $this->session->flashdata('success'); ?>")
    <?php endif; ?>
</script>
<?php if ($title == 'View product') : ?>
    <script src="<?= base_url() ?>assets/js/swiper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/easyzoom.js"></script>
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    <script src="<?= base_url() ?>assets/js/product2.js"></script>
<?php endif; ?>
<!-- owl slider cdn js link -->
<?php if ($title == 'Welcome to patazone') : ?>
    <script src="<?= base_url() ?>assets/js/app.js"></script>
<?php endif; ?>
<?php if ($title == 'shop' || $title == 'Search results' || $title == 'Products') : ?>
    <script src="<?= base_url() ?>assets/js/groceries.js"></script>
<?php endif; ?>
<?php if ($title == 'Buy now Pay later' || $title == 'Patazone|Lipalater Register') : ?>
    <script src="<?= base_url(); ?>assets/js/buyplt.js"></script>
    <script src="<?= base_url() ?>assets/js/groceries.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php endif; ?>
<?php if ($title == 'My cart') : ?>
    <script src="<?= base_url() ?>assets/js/cart.js"></script>
<?php endif; ?>
<?php if ($title == 'My Patazone Account' || $title == 'My Orders' || $title == 'Change Password') : ?>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/r-2.2.9/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cart.js"></script>
    <script src="<?= base_url() ?>assets/js/user_orders.js"></script>
    <script>
        function getOrderDetails(urlendpoint) {
            window.location.href = urlendpoint
        }
    </script>

<?php endif; ?>
<?php if ($title == 'Change Password') : ?>
    <script src="<?= base_url() ?>assets/js/user_orders.js"></script>
<?php endif; ?>

<?php if ($title == 'FAQ`s Page' || $title == 'Privacy & Cookies Page') : ?>
    <script src="<?= base_url() ?>assets/js/cart.js"></script>
    <script src="<?= base_url() ?>assets/js/az.js"></script>
<?php endif; ?>

<?php if ($title == 'Welcome Please Login' || $title == 'Create Your Account & Shop With Confidence.') : ?>
    <script src="<?= base_url() ?>assets/js/create_account.js"></script>
<?php endif; ?>

<?php if ($title == 'Checkout Page' || $title == 'Guest Checkout' || $title == 'Order success Page') : ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery.payform.min.js"></script>
    <script src="<?= base_url() ?>assets/js/checkout.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if ($this->session->userdata('user_login') == 1) :
        if ($address) :
    ?>

            <script>
                var region = '<?= $address->region; ?>'
            </script>
    <?php endif;
    endif; ?>
<?php endif; ?>
<!-- curtom js link -->
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
</body>

<!-- accordion script -->

</html>