<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-2">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="footer_widget">
                        <img src="assets/img/logo.png" width="60" class="img-footer small mb-2 rounded" alt="" />

                        <div class="address mt-3">
                            At ZIVE, we believe fashion is not just about looking good - it's about feeling good. Rooted in the philosophy of "Wear the Comfort", ZIVE blends timeless elegance with everyday ease, delivering fashion that fits seamlessly into your lifestyle.
                        </div>
                        <div class="address mt-3">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#"><i class="lni lni-facebook-filled"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="lni lni-instagram-filled"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://wa.me/9952467399"><i class="fab fa-whatsapp"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="lni lni-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                    <div class="footer_widget">
                        <h4 class="widget_title">Quick Links</h4>
                        <ul class="footer-menu">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="services.php">Services</a></li>
                            <li><a href="testimonial.php">Testimonial</a></li>
                            <!-- <li><a href="pay.php">Pay Now</a></li> -->
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="footer_widget">
                        <h4 class="widget_title">Contact Us</h4>
                        <ul class="footer-menu">
                            <li style="max-width: none;">
                                <a class="text-white" href="https://maps.app.goo.gl/smRZ3pCgHuMBCEAi7?g_st=iw"><i class="lni lni-pin"></i> D23, Ahuja haven, Nanjundapuram Road, Ramanathapuram, Coimbatore - 641045</a>
                            </li>
                            <li style="max-width: none;">
                                <a class="text-white" href="mailto:zivewearthecomfort@gmail.com"><i class="lni lni-envelope me-2"></i>Zivewearthecomfort@gmail.com</a>
                            </li>
                            <li style="max-width: none;">
                                <a class="text-white" href="tel:9952467399"><i class="lni lni-phone"></i> +91 9952 467 399</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="footer_widget">
                        <h4 class="widget_title">Reach Us</h4>
                        <div class="foot-news-last">
                            <div class="footer-payment d-flex flex-wrap">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3437.246320676955!2d76.99869439999999!3d10.991660399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba859e7dbcc6abf%3A0x6f9d0233b784ac7a!2sAhuja%20Haven!5e1!3m2!1sen!2sin!4v1748083960671!5m2!1sen!2sin" style="border: 0; width: -webkit-fill-available; height: -webkit-fill-available;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <p class="mb-0">Designed and Developed by <a href="https://trymywebsites.com/">Trymywebsites</a>.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->

<!-- Cart -->
<style>
    .cart-item:hover {
        background-color: #f8f9fa !important;
        transition: background 0.3s ease;
    }
    .cart-img-wrapper img {
        transition: transform 0.2s ease;
    }
    .cart-img-wrapper:hover img {
        transform: scale(1.05);
    }
</style>
<div id="Cart" class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display: none; right: 0;">
    <div class="rightMenu-scroll">
        <div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
            <h4 class="fs-md mb-0">Products List</h4>
            <button onclick="document.getElementById('Cart').style.display='none'" class="close_slide"><i class="ti-close"></i></button>
        </div>

        <div class="right-ch-sideBar">
            <div id="CartItems" class="cart_select_items py-2"></div>

            <div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
                <h6 class="mb-0">Subtotal</h6>
                <h3 id="CartSubtotal" class="mb-0">₹0</h3>
            </div>

            <div class="cart_action px-3 py-3">
                <button type="button" id="checkoutBtn" class="btn btn-dark w-100">Order Now</button>
            </div>
        </div>
    </div>
</div>


<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/ion.rangeSlider.min.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/slider-bg.js"></script>
<script src="assets/js/lightbox.js"></script>
<script src="assets/js/smoothproducts.js"></script>
<script src="assets/js/snackbar.min.js"></script>
<script src="assets/js/jQuery.style.switcher.js"></script>
<script src="assets/js/custom.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->

<script>
function openWishlist() {
    document.getElementById("Wishlist").style.display = "block";
}
function closeWishlist() {
    document.getElementById("Wishlist").style.display = "none";
}
</script>

<script>
function openCart() {
    document.getElementById("Cart").style.display = "block";
}
function closeCart() {
    document.getElementById("Cart").style.display = "none";
}
</script>

<script>
function openSearch() {
    document.getElementById("Search").style.display = "block";
}
function closeSearch() {
    document.getElementById("Search").style.display = "none";
}
</script>

<a href="https://wa.me/919952467399" class="whatsapp_float" target="_blank"> <i class="fab fa-whatsapp whatsapp-icon"></i></a>

<script src="assets/js/shopping-cart.js"></script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module">
    import Toastify from 'https://cdn.jsdelivr.net/npm/toastify-js/+esm';

    async function loadSdk() {
        if (window.JuspayCheckout) return true;
        return new Promise(resolve => {
            const s = document.createElement('script');
            s.src = 'https://web-sdk.smartgateway.hdfcbank.com/checkout.js';
            s.onload = () => resolve(true);
            s.onerror = () => resolve(false);
            document.head.appendChild(s);
        });
    }

    async function startCheckout(e) {
        e?.preventDefault();
        const btn = document.getElementById('checkoutBtn');
        if (btn) btn.disabled = true;

        try {
            const r = await fetch('libs/api/checkout_api.php', { method: 'POST' });
            const raw = await r.text();
            const data = JSON.parse(raw);

            if (!data.ok) return await Swal.fire('Error', data.msg, 'error');

            const sdkLoaded = await loadSdk();
            const p = data.payload;

            const fallback = () => {
                if (p.paymentLink) location.href = p.paymentLink;
                else Swal.fire('Error', 'Unable to load payment page.', 'error');
            };

            if (sdkLoaded && window.JuspayCheckout) {
                window.JuspayCheckout.open({
                    paymentSession: p.sdkPayload?.paymentSession ?? p.sdkPayload,
                    merchantId: p.sdkPayload?.merchantId ?? undefined,
                    amount: (p.amount / 100).toFixed(2),
                }, async result => {
                    if (result.status === 'SUCCESS') {
                        const vr = await fetch('libs/api/payment_verify_api.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: new URLSearchParams({ order_id: data.orderId })
                        });
                        const out = await vr.json();
                        if (out.ok) {
                            await Swal.fire('Payment Successful', 'Thank you for your purchase!', 'success');
                            location.href = 'thankyou.php?order_id=' + data.orderId;
                        } else {
                            Swal.fire('Verification failed', out.msg, 'error');
                        }
                    } else if (result.status === 'CANCELLED') {
                        Toastify({ text: 'Payment cancelled', duration: 3000, backgroundColor: '#f44336' }).showToast();
                    } else {
                        Swal.fire('Payment Failed', result.message || 'Please try again', 'error');
                    }
                });
            } else fallback();
        } catch (err) {
            console.error(err);
            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
        } finally {
            if (btn) btn.disabled = false;
        }
    }

    document.getElementById('checkoutBtn')?.addEventListener('click', startCheckout);
</script>