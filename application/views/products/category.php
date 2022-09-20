<?php $this->load->view('common/header2'); ?>
<section id="box-2-slider">
    <?php if ($display == 0 || $display == 2) : ?>
        <div class="heading_section_2">
            <h4>Sub Categories</h4>
        </div>
    <?php else : ?>
        <div class="heading_section_2">
            <h4>Best selling Brands</h4>
        </div>
    <?php endif; ?>
    <?php if ($display == 0 || $display == 2) : ?>
        <div class="box-2-child slicker-for 3-slides">
            <?php foreach ($subcategories as $sub) : ?>
                <div class="item box-2-1 box-2" style="background: url(<?= imagebaseURL . $sub->subcategory_image ?>) no-repeat; background-size: cover; background-position: right center;">
                    <div>
                        <h6><?= $sub->subcategory_name ?></h6>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php else : ?>
        <div class="box-2-child slicker-for 4-slides">
            <?php foreach ($subcategories as $sub) : ?>
                <div class="item box-2-1 box-2" style="background: url(<?= imagebaseURL . $sub->subsub_category_image ?>) no-repeat; background-size: cover; background-position: right center;">
                    <div>
                        <h6><?= $sub->sub_subcategory_name ?></h6>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>
</section>

<?php $this->load->view('common/scroll-nav'); ?>

<!-- section 2 end here  -->

<!-- THIS IS SECTION 3 AND THIS DESIGN IS SIMILLER SECTION 6 -->
<?php if ($display != 2) : ?>
    <?php if (!empty($produstsoffer)) : ?>

        <section class="grid_section_6">
            <div class="container-fluid">
                <div class="heading_counter_sec_wrapper section_6_buttons">
                    <div class="heading_section_5">
                        <h4 class="me-auto">Products On Offer</h4>
                        <a href="#">View All</a>
                    </div>
                </div>

                <div class="grid_items_section_6 slicker-for 5-slides">

                    <!--  -->
                    <?php foreach ($produstsoffer as $offerproducts) : if ($offerproducts->product_qty != 0) : ?>
                            <div class="grid_item_5 item column_filter_class babycare freshfood beverages beauty">
                                <?php if ($offerproducts->discount_price != null) :
                                    $amount = $offerproducts->selling_price - $offerproducts->discount_price;
                                    $discount = ($amount / $offerproducts->selling_price) * 100; ?>
                                    <div class="offer_5">
                                        <p><?= '-' . round($discount) . '%'; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="grid_item_img_5">
                                    <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $offerproducts->slug . '\', \'' . $offerproducts->product_id . '\')" src="' . imagebaseURL . $offerproducts->product_thumbnail . '" alt="">'; ?>
                                </div>
                                <div class="grid_item_content_6">
                                    <div class="product_title_5">
                                        <p class="grid_img_5_title"><a href="<?= base_url($offerproducts->slug) ?>"><?= substr($offerproducts->product_title, 0, 30) . '...'; ?></a></p>
                                    </div>
                                    <div class="wrap_p_b">
                                        <div class="price_prev_current_5">
                                            <?php if ($offerproducts->discount_price) {
                                                echo '<p class="current_price_5"> KES ' . number_format($offerproducts->discount_price) . '</p>';
                                                echo '<p class="previouse_price_5"> KES ' . number_format($offerproducts->selling_price) . '</p>';
                                            } else {
                                                echo '<p class="current_price_5"> KES ' . number_format($offerproducts->selling_price) . '</p>';
                                            }
                                            ?>

                                        </div>
                                        <div class="grid_item_button_5">
                                            <input type="hidden" id="productQuantity" value="1">
                                            <?php echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $offerproducts->id . ')" ><a href="#">Add to Cart</a></button>'; ?>
                                            <!-- <button class="btn_item_5"><a href="#">Add to Cart</a></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endif;
                    endforeach; ?>


                </div>
            </div>
        </section>
        <!-- END SECTION 3 -->
    <?php endif; ?>
<?php else : ?>
    <?php if (!empty($fashionProducts['menDivProducts'])) : ?>

        <section class="grid_section_6">
            <div class="container-fluid">
                <div class="heading_counter_sec_wrapper section_6_buttons">
                    <div class="heading_section_5">
                        <h4 class="me-auto">Men's Fashion</h4>
                        <!-- <a href="#">View All</a> -->
                    </div>
                </div>

                <div class="grid_items_section_6 carousel_1 owl-carousel owl-theme">

                    <!--  -->
                    <?php foreach ($fashionProducts['menDivProducts'] as $offerproducts) : if ($offerproducts->product_qty != 0) : ?>
                            <div class="grid_item_5 item column_filter_class babycare freshfood beverages beauty">
                                <?php if ($offerproducts->discount_price != null) :
                                    $amount = $offerproducts->selling_price - $offerproducts->discount_price;
                                    $discount = ($amount / $offerproducts->selling_price) * 100; ?>
                                    <div class="offer_5">
                                        <p><?= '-' . round($discount) . '%'; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="grid_item_img_5">
                                    <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $offerproducts->slug . '\', \'' . $offerproducts->product_id . '\')" src="' . imagebaseURL . $offerproducts->product_thumbnail . '" alt="">'; ?>
                                </div>
                                <div class="grid_item_content_6">
                                    <div class="product_title_5">
                                        <p class="grid_img_5_title"><a href="<?= base_url($offerproducts->slug) ?>"><?= substr($offerproducts->product_title, 0, 30) . '...'; ?></a></p>
                                    </div>
                                    <div class="wrap_p_b">
                                        <div class="price_prev_current_5">
                                            <?php if ($offerproducts->discount_price) {
                                                echo '<p class="current_price_5"> KES ' . number_format($offerproducts->discount_price) . '</p>';
                                                echo '<p class="previouse_price_5"> KES ' . number_format($offerproducts->selling_price) . '</p>';
                                            } else {
                                                echo '<p class="current_price_5"> KES ' . number_format($offerproducts->selling_price) . '</p>';
                                            }
                                            ?>

                                        </div>
                                        <div class="grid_item_button_5">
                                            <input type="hidden" id="productQuantity" value="1">
                                            <?php echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $offerproducts->id . ')" ><a href="#">Add to Cart</a></button>'; ?>
                                            <!-- <button class="btn_item_5"><a href="#">Add to Cart</a></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endif;
                    endforeach; ?>


                </div>
            </div>
        </section>
        <!-- END SECTION 3 -->
    <?php endif; ?>
<?php endif; ?>

<!-- START SECTION 4 -->
<?php if ($display != 2) : ?>
    <?php if ($display == 1) : if ($subcategory) : ?>
            <section class="grid_section_slide_4">
                <div class="container-fluid">
                    <div class="wrap-section-4">
                        <?php foreach ($subcategory as $subcategory) : ?>
                            <div class="box-sec-4 box-4-md">
                                <img src="<?= imagebaseURL . $subcategory->subcategory_image ?>" alt="">
                                <h5><?= $subcategory->subcategory_name; ?></h5>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php else : ?>
        <section class="grid_section_slide_4">
            <div class="container-fluid">
                <div class="wrap-section-4">
                    <?php foreach ($subcategory as $subcategory) : ?>
                        <div class="box-sec-4 box-4-md">
                            <img src="<?= imagebaseURL . $subcategory->subsub_category_image; ?>" alt="">
                            <h5><?= $subcategory->sub_subcategory_name; ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php endif;
endif; ?>
<!-- END SECTION 4 -->
<!-- START SECTION 4 -->
<?php if ($display == 2) : if (!empty($fashion['menDiv'])) : ?>
        <section class="grid_section_slide_4">
            <div class="container-fluid">
                <div class="wrap-section-4">
                    <?php foreach ($fashion['menDiv'] as $subcategory) : ?>
                        <div class="box-sec-4 box-4-md">
                            <img src="<?= imagebaseURL . $subcategory->subsub_category_image ?>" alt="">
                            <h5><?= $subcategory->sub_subcategory_name; ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php endif;
endif; ?>
<!-- END SECTION 4 -->
<?php if ($display == 2) : if (!empty($fashionProducts['ladiesDivProducts'])) : ?>

        <section class="grid_section_6">
            <div class="container-fluid">
                <div class="heading_counter_sec_wrapper section_6_buttons">
                    <div class="heading_section_5">
                        <h4 class="me-auto">Women's Fashion</h4>
                        <!-- <a href="#">View All</a> -->
                    </div>
                </div>

                <div class="grid_items_section_6 carousel_1 owl-carousel owl-theme">

                    <!--  -->
                    <?php foreach ($fashionProducts['ladiesDivProducts'] as $offerproducts) : if ($offerproducts->product_qty != 0) : ?>
                            <div class="grid_item_5 item column_filter_class babycare freshfood beverages beauty">
                                <?php if ($offerproducts->discount_price != null) :
                                    $amount = $offerproducts->selling_price - $offerproducts->discount_price;
                                    $discount = ($amount / $offerproducts->selling_price) * 100; ?>
                                    <div class="offer_5">
                                        <p><?= '-' . round($discount) . '%'; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="grid_item_img_5">
                                    <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $offerproducts->slug . '\', \'' . $offerproducts->product_id . '\')" src="' . imagebaseURL . $offerproducts->product_thumbnail . '" alt="">'; ?>
                                </div>
                                <div class="grid_item_content_6">
                                    <div class="product_title_5">
                                        <p class="grid_img_5_title"><a href="<?= base_url($offerproducts->slug) ?>"><?= substr($offerproducts->product_title, 0, 30) . '...'; ?></a></p>
                                    </div>
                                    <div class="wrap_p_b">
                                        <div class="price_prev_current_5">
                                            <?php if ($offerproducts->discount_price) {
                                                echo '<p class="current_price_5"> KES ' . number_format($offerproducts->discount_price) . '</p>';
                                                echo '<p class="previouse_price_5"> KES ' . number_format($offerproducts->selling_price) . '</p>';
                                            } else {
                                                echo '<p class="current_price_5"> KES ' . number_format($offerproducts->selling_price) . '</p>';
                                            }
                                            ?>

                                        </div>
                                        <div class="grid_item_button_5">
                                            <input type="hidden" id="productQuantity" value="1">
                                            <?php echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $offerproducts->id . ')" ><a href="#">Add to Cart</a></button>'; ?>
                                            <!-- <button class="btn_item_5"><a href="#">Add to Cart</a></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endif;
                    endforeach; ?>


                </div>
            </div>
        </section>
        <!-- END SECTION 3 -->
<?php endif;
endif; ?>
<?php if ($display == 2) : if (!empty($fashion['ladiesDiv'])) : ?>
        <section class="grid_section_slide_4">
            <div class="container-fluid">
                <div class="wrap-section-4">
                    <?php foreach ($fashion['ladiesDiv'] as $subcategory) : ?>
                        <div class="box-sec-4 box-4-md">
                            <img src="<?= imagebaseURL . $subcategory->subsub_category_image ?>" alt="">
                            <h5><?= $subcategory->sub_subcategory_name; ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php endif;
endif; ?>
<!-- END SECTION 4 -->

<?php if ($display == 2) : if (!empty($fashionProducts['kidsDivProducts'])) : ?>

        <section class="grid_section_6">
            <div class="container-fluid">
                <div class="heading_counter_sec_wrapper section_6_buttons">
                    <div class="heading_section_5">
                        <h4 class="me-auto">Kids Fashion</h4>
                        <!-- <a href="#">View All</a> -->
                    </div>
                </div>

                <div class="grid_items_section_6 carousel_1 owl-carousel owl-theme">

                    <!--  -->
                    <?php foreach ($fashionProducts['kidsDivProducts'] as $offerproducts) : if ($offerproducts->product_qty != 0) : ?>
                            <div class="grid_item_5 item column_filter_class babycare freshfood beverages beauty">
                                <?php if ($offerproducts->discount_price != null) :
                                    $amount = $offerproducts->selling_price - $offerproducts->discount_price;
                                    $discount = ($amount / $offerproducts->selling_price) * 100; ?>
                                    <div class="offer_5">
                                        <p><?= '-' . round($discount) . '%'; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="grid_item_img_5">
                                    <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $offerproducts->slug . '\', \'' . $offerproducts->product_id . '\')" src="' . imagebaseURL . $offerproducts->product_thumbnail . '" alt="">'; ?>
                                </div>
                                <div class="grid_item_content_6">
                                    <div class="product_title_5">
                                        <p class="grid_img_5_title"><a href="<?= base_url($offerproducts->slug) ?>"><?= substr($offerproducts->product_title, 0, 30) . '...'; ?></a></p>
                                    </div>
                                    <div class="wrap_p_b">
                                        <div class="price_prev_current_5">
                                            <?php if ($offerproducts->discount_price) {
                                                echo '<p class="current_price_5"> KES ' . number_format($offerproducts->discount_price) . '</p>';
                                                echo '<p class="previouse_price_5"> KES ' . number_format($offerproducts->selling_price) . '</p>';
                                            } else {
                                                echo '<p class="current_price_5"> KES ' . number_format($offerproducts->selling_price) . '</p>';
                                            }
                                            ?>

                                        </div>
                                        <div class="grid_item_button_5">
                                            <input type="hidden" id="productQuantity" value="1">
                                            <?php echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $offerproducts->id . ')" ><a href="#">Add to Cart</a></button>'; ?>
                                            <!-- <button class="btn_item_5"><a href="#">Add to Cart</a></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endif;
                    endforeach; ?>


                </div>
            </div>
        </section>
        <!-- END SECTION 3 -->
<?php endif;
endif; ?>
<?php if ($display == 2) : if (!empty($fashion['kidsDiv'])) : ?>
        <section class="grid_section_slide_4">
            <div class="container-fluid">
                <div class="wrap-section-4">
                    <?php foreach ($fashion['kidsDiv'] as $subcategory) : ?>
                        <div class="box-sec-4 box-4-md">
                            <img src="<?= imagebaseURL . $subcategory->subsub_category_image ?>" alt="">
                            <h5><?= $subcategory->sub_subcategory_name; ?></h5>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php endif;
endif; ?>
<!-- START SECTION 7 -->
<?php if (!empty($products)) :
?>
    <section class="grid_section_7">
        <div class="container-fluid">
            <div class="wrap-sec-7">

                <div class="row" id="post-data">
                    <?php $this->load->view('products/results/category_results', $products) ?>
                </div>
                <div class="ajax-load text-center m-auto" style="display:none">
                    <p><img src="<?= base_url('assets/img/loader.gif'); ?>" width="50">Loading More products</p>
                </div>
            </div>
        </div>
    </section>
<?php endif;
$this->load->view('common/footer'); ?>
<!-- END SECTION 7 -->