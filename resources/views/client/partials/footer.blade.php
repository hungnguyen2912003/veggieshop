<!-- FEATURE AREA START ( Feature - 3) -->
<div class="ltn__feature-area before-bg-bottom-2 mb--30--- plr--5">
    @include('client.partials.feature')
</div>
<!-- FEATURE AREA END -->

<footer class="ltn__footer-area">
    <div class="footer-top-area section-bg-1 plr--5">
        <div class="container-fluid">
            <div class="row">
                <!-- Thông tin giới thiệu -->
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-about-widget">
                        <div class="footer-logo">
                            <div class="site-logo">
                                <img src="{{ asset('assets/client/img/logo.png') }}" alt="Logo">
                            </div>
                        </div>
                        <p>VeggieShop – cửa hàng chuyên cung cấp rau củ quả tươi ngon, an toàn và chất lượng cao, được chọn lọc kỹ lưỡng từ các nông trại sạch.</p>
                        <div class="footer-address">
                            <ul>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-placeholder"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p>Nha Trang, Khánh Hòa, Việt Nam</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-call"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="tel:+84987654321">+84 987 654 321</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-mail"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="mailto:veggieshop@gmail.com">veggieshop@gmail.com</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="ltn__social-media mt-20">
                            <ul>
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Cột 2: Thông tin công ty -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Công ty</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="about.html">Giới thiệu</a></li>
                                <li><a href="blog.html">Tin tức</a></li>
                                <li><a href="shop.html">Tất cả sản phẩm</a></li>
                                <li><a href="locations.html">Bản đồ cửa hàng</a></li>
                                <li><a href="faq.html">Câu hỏi thường gặp</a></li>
                                <li><a href="contact.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Cột 3: Dịch vụ -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Dịch vụ</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="order-tracking.html">Theo dõi đơn hàng</a></li>
                                <li><a href="wishlist.html">Danh sách yêu thích</a></li>
                                <li><a href="login.html">Đăng nhập</a></li>
                                <li><a href="account.html">Tài khoản của tôi</a></li>
                                <li><a href="about.html">Điều khoản & Chính sách</a></li>
                                <li><a href="about.html">Ưu đãi khuyến mãi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Cột 4: Chăm sóc khách hàng -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Chăm sóc khách hàng</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="login.html">Đăng nhập</a></li>
                                <li><a href="account.html">Tài khoản của tôi</a></li>
                                <li><a href="wishlist.html">Danh sách yêu thích</a></li>
                                <li><a href="order-tracking.html">Theo dõi đơn hàng</a></li>
                                <li><a href="faq.html">Câu hỏi thường gặp</a></li>
                                <li><a href="contact.html">Liên hệ hỗ trợ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Cột 5: Newsletter -->
                <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                    <div class="footer-widget footer-newsletter-widget">
                        <h4 class="footer-title">Đăng ký nhận tin</h4>
                        <p>Đăng ký để nhận thông tin khuyến mãi và sản phẩm mới nhất qua email mỗi tuần.</p>
                        <div class="footer-newsletter">
                            <form action="#">
                                <input type="email" name="email" placeholder="Nhập email của bạn*">
                                <div class="btn-wrapper">
                                    <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                                </div>
                            </form>
                        </div>
                        <h5 class="mt-30">Phương thức thanh toán</h5>
                        <img src="{{ asset('assets/client/img/icons/payment-4.png') }}" alt="Phương thức thanh toán">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="ltn__copyright-area ltn__copyright-2 section-bg-2 ltn__border-top-2--- plr--5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="ltn__copyright-design clearfix">
                        <p>Bản quyền &copy; <span class="current-year"></span> VeggieShop. Mọi quyền được bảo lưu.</p>
                    </div>
                </div>
                <div class="col-md-6 col-12 align-self-center">
                    <div class="ltn__copyright-menu text-right text-end">
                        <ul>
                            <li><a href="#">Điều khoản & Dịch vụ</a></li>
                            <li><a href="#">Khiếu nại</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
