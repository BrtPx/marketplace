<?php
$this->load->view('templates/header');

// Track logged in user shopping
if ($this->session->userdata('user_login') === 1) {
    $userid = $this->session->userdata('user_id');
    $recentProducts = $this->db->select('*')->where(['user_id' => $userid, 'soft_delete' => 0])->order_by('date_created', 'DESC')->get('ptz_productstatistics')->result();
}

// Track unlogged in user shopping acctivity
if (array_key_exists('recently_viewed', $_COOKIE)) {
    // ...
    $cookieGet = get_cookie('recently_viewed');
    $cookieRes = unserialize($cookieGet);
    $productCount = count($cookieRes);
    // $productIDs = implode("','", $cookieRes);
    
    $recentInCookies = $this->db->select('*')->from('ptz_products')->where_in('id', $cookieRes)->get()->result();
}
?>

<!-- breadcrumb -->
<div class="bg-gray-13 bg-md-transparent">
    <div class="container">
        <!-- breadcrumb -->
        <div class="my-md-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?= base_url(); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">My Cart</li>
                </ol>
            </nav>
        </div>
        <!-- End breadcrumb -->
    </div>
</div>
<!-- End breadcrumb -->

<div class="container">
    <div id="cartPageProducts"></div>

    <!-- ======== CART IS EMPTY MESSAGE ======== -->
    <!-- <div id="cartPageProductsEmpty"></div> -->

    <?php if (!empty($recentProducts)): ?>
    <div class="bg-gray-7 my-2 pb-5 p-sm-0" style="border-radius: 15px 15px 0 0;">
        <div class="container">
            <div class="row">
                <div class="p-3 d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0"
                    style="border-radius: 15px 15px 0 0;width:100%;background: #a7a7a7;">
                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22"
                        style="color: #ffffff !important;">Recently viewed</h3>
                        <a class="d-block text-gray-24" href="<?= base_url('shop'); ?>" style="color: #ffffff !important;font-size: 20px;">Continue Shopping <i class="ec ec-arrow-right-categproes"></i></a>
                </div>

                <div class="col-md-12 col-lg-12 col-wd-12">
                    <div class="">
                        <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-2 pt-2 px-1"
                            data-slides-show="6" data-slides-scroll="2" data-responsive='[{
                                "breakpoint": 1400,
                                "settings": {
                                    "slidesToShow": 4
                                }
                                }, {
                                    "breakpoint": 1200,
                                    "settings": {
                                    "slidesToShow": 3
                                    }
                                }, {
                                "breakpoint": 992,
                                "settings": {
                                    "slidesToShow": 2
                                }
                                }, {
                                "breakpoint": 768,
                                "settings": {
                                    "slidesToShow": 2
                                }
                                }, {
                                "breakpoint": 554,
                                "settings": {
                                    "slidesToShow": 2
                                }
                                }]'>
                            <?php
                                foreach ($recentProducts as $row) :
                                $recentlyViewed = $this->db->get_where('ptz_products', array('id' => $row->product_id))->result();
                                foreach ($recentlyViewed as $item):
                            ?>
                            <div class="js-slide products-group">
                                <div class="product-item mx-1 remove-divider">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white px-wd-4 p-2 p-md-2">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2">
                                                    <?php if ($item->discount_price != null) :
                                                            $amount = $item->selling_price - $item->discount_price;
                                                            $discount = ($amount / $item->selling_price) * 100;

                                                            // Check if ita a lipalater product
                                                        if (!empty($item->is_lipalater)):
                                                            echo '
                                                            <a href="javascript:;" class="font-size-12 text-gray-5 ml-0">
                                                                <img src="'.base_url('uploads/lipalater.png').'" alt=""
                                                                    width="100">
                                                            </a>
                                                            ';
                                                        else:
                                                                                    ?>
                                                    <a href="javascript:;" class="font-size-12 text-gray-5 ml-0">
                                                        <span
                                                            style="background: #f3a282; color: #ffffff; font-size: 0.95rem; padding: 3px; border-radius: 3px; font-weight: 500;">
                                                            <?= (round($discount) > 0) ? '-' . round($discount) . '%' : '-1%'; ?>
                                                        </span>
                                                    </a>
                                                
                                                    <?php endif; endif; ?>
                                                </div>
                                                <div class="mb-2" onclick="markProductAsViewed(<?= $item->id ?>)">
                                                    <a href="<?= empty($item->is_lipalater) ? base_url('product/' . base64_encode($item->id) . '/' . $item->slug) : base_url('view-lipa-later/' . base64_encode($item->id) . '/' . $item->slug); ?>"
                                                        class="d-block text-center">
                                                        <img class="img-fluid"
                                                            src="<?= product_thumbnail . $item->product_thumbnail; ?>"
                                                            alt="Image Description">
                                                    </a>
                                                </div>
                                                <h5 class="mb-1 product-item__title">
                                                    <a href="<?= empty($item->is_lipalater) ? base_url('product/' . base64_encode($item->id) . '/' . $item->slug) : base_url('view-lipa-later/' . base64_encode($item->id) . '/' . $item->slug); ?>"
                                                        class="text-black font-weight-bold"
                                                        style="font-weight: 400 ! important; color: black ! important;">
                                                        <?= $item->product_title; ?>
                                                    </a>
                                                </h5>
                                                <div class="flex-center-between mb-1">
                                                    <?php if (!empty($item->is_lipalater)):
                                                    $costPrice = $item->cost_price;
                                                    $percentage = $item->percentage/100;
                                                    $lipalaterPrice = ($costPrice * $percentage) + $costPrice;
                                                    ?>
                                                    <div class="prodcut-price">
                                                        <ins class="font-size-15 text-red text-decoration-none d-block mt-3">
                                                            <?= 'Ksh.' . number_format($lipalaterPrice); ?>
                                                        </ins>
                                                    </div>
                                                <?php else: ?>
                                                <div class="prodcut-price">
                                                    <?php if ($item->discount_price != null) : ?>
                                                    <del class="font-size-16 text-gray-9 d-block">
                                                        <?= 'Ksh.' . number_format($item->selling_price); ?>
                                                    </del>
                                                    <ins class="font-size-20 text-red text-decoration-none d-block">
                                                        <?= 'Ksh.' . number_format($item->discount_price); ?>
                                                    </ins>
                                                    <?php else : ?>
                                                    <ins class="font-size-20 text-red text-decoration-none d-block mt-3">
                                                        <?= 'Ksh.' . number_format($item->selling_price); ?>
                                                    </ins>
                                                    <?php endif; ?>
                                                </div>

                                                <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                endforeach;
                                endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($recentInCookies)): ?>
    <div class="bg-gray-7 my-3 pb-5 p-sm-0" style="border-radius: 5px 5px 0 0;">
        <div class="container">
            <div class="row">
                <div class="p-2 d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0"
                    style="border-radius: 5px 5px 0 0;width:100%;background: #a7a7a7;">
                    <h3 class="ml-3 font-size-22"
                        style="color: #ffffff !important;">Recently viewed</h3>
                        <a class="d-block text-gray-24 mr-2" href="javascript:;" style="color: #ffffff !important;font-size: 20px;"><?= '('.$productCount.') Products'; ?></a>
                </div>

                <div class="col-md-12 col-lg-12 col-wd-12">
                    <div class="">
                        <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble py-2 px-1"
                            data-slides-show="6" data-slides-scroll="2" data-responsive='[{
                                "breakpoint": 1400,
                                "settings": {
                                    "slidesToShow": 4
                                }
                                }, {
                                    "breakpoint": 1200,
                                    "settings": {
                                    "slidesToShow": 3
                                    }
                                }, {
                                "breakpoint": 992,
                                "settings": {
                                    "slidesToShow": 2
                                }
                                }, {
                                "breakpoint": 768,
                                "settings": {
                                    "slidesToShow": 2
                                }
                                }, {
                                "breakpoint": 554,
                                "settings": {
                                    "slidesToShow": 2
                                }
                                }]'>
                            <?php foreach ($recentInCookies as $item) : ?>
                            <div class="js-slide products-group">
                                <div class="product-item mx-1 remove-divider">
                                    <div class="product-item__outer h-100 px-wd-4 p-2 bg-white">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2">
                                                <?php if ($item->discount_price != null) :
                                                        $amount = $item->selling_price - $item->discount_price;
                                                        $discount = ($amount / $item->selling_price) * 100;

                                                        // Check if ita a lipalater product
                                                    if (!empty($item->is_lipalater)):
                                                        echo '
                                                        <a href="javascript:;" class="font-size-12 text-gray-5 ml-0">
                                                            <img src="'.base_url('uploads/lipalater.png').'" alt=""
                                                                width="100">
                                                        </a>
                                                        ';
                                                    else:
                                                                                ?>
                                                <a href="javascript:;" class="font-size-12 text-gray-5 ml-0">
                                                    <span
                                                        style="background: #f3a282; color: #ffffff; font-size: 0.95rem; padding: 3px; border-radius: 3px; font-weight: 500;">
                                                        <?= (round($discount) > 0) ? '-' . round($discount) . '%' : '-1%'; ?>
                                                    </span>
                                                </a>
                                            
                                                <?php endif; endif; ?>
                                            </div>
                                            <div class="mb-2" onclick="markProductAsViewed(<?= $item->id ?>)">
                                                <a href="<?= empty($item->is_lipalater) ? base_url('product/' . base64_encode($item->id) . '/' . $item->slug) : base_url('view-lipa-later/' . base64_encode($item->id) . '/' . $item->slug); ?>"
                                                    class="d-block text-center">
                                                    <img class="img-fluid"
                                                        src="<?= product_thumbnail . $item->product_thumbnail; ?>"
                                                        alt="Image Description">
                                                </a>
                                            </div>
                                            <h5 class="mb-1 product-item__title">
                                                <a href="<?= empty($item->is_lipalater) ? base_url('product/' . base64_encode($item->id) . '/' . $item->slug) : base_url('view-lipa-later/' . base64_encode($item->id) . '/' . $item->slug); ?>"
                                                    class="text-black"
                                                    style="font-size: 16px ! important; color: black ! important;">
                                                    <?= substr($item->product_title,0,35).'...'; ?>
                                                </a>
                                            </h5>
                                            <div class="flex-center-between mb-1">
                                                <?php if (!empty($item->is_lipalater)):
                                                $costPrice = $item->cost_price;
                                                $percentage = $item->percentage/100;
                                                $lipalaterPrice = ($costPrice * $percentage) + $costPrice;
                                                ?>
                                                <div class="prodcut-price">
                                                    <ins class="font-size-20 text-bold text-red text-decoration-none d-block mt-3">
                                                        <?= 'Ksh.' . number_format($lipalaterPrice); ?> <span style="cursor: pointer;" onclick="launchLipalaterModal(<?= $item->id?>)"><i class="fas fa-question-circle ml-1"></i></span>
                                                    </ins>
                                                </div>
                                            <?php else: ?>
                                            <div class="prodcut-price">
                                                <?php if ($item->discount_price != null) : ?>
                                                <del class="font-size-16 text-gray-9 d-block" style="font-weight: 500;">
                                                    <?= 'Ksh.' . number_format($item->selling_price); ?>
                                                </del>
                                                <ins class="font-size-20 text-red text-decoration-none d-block" style="font-weight: 500;">
                                                    <?= 'Ksh.' . number_format($item->discount_price); ?>
                                                </ins>
                                                <?php else : ?>
                                                <ins class="font-size-20 text-red text-decoration-none d-block mt-3" style="font-weight: 500;">
                                                    <?= 'Ksh.' . number_format($item->selling_price); ?>
                                                </ins>
                                                <?php endif; ?>
                                            </div>

                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
</div>


<?php $this->load->view('templates/footer'); ?>