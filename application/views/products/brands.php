<?php $this->load->view('common/header2'); ?>
<section id="box-2-slider">
    <div class="heading_section_2">
        <h4><?= 'Search results for ' . $brandname . ' Products'; ?></h4>
    </div>

</section>

<?php $this->load->view('common/scroll-nav') ?>

<!-- section 2 end here  -->

<!-- THIS IS SECTION 3 AND THIS DESIGN IS SIMILLER SECTION 6 -->
<?php
$counts = count($produstsoffer);
if ($counts >= 6) :

    if (!empty($produstsoffer)) : ?>

        <section class="grid_section_6">
            <div class="container-fluid">
                <div class="heading_counter_sec_wrapper section_6_buttons">
                    <div class="heading_section_5">
                        <h4 class="me-auto">Products On Offer</h4>
                        <a href="#">View All</a>
                    </div>
                </div>

                <div class="grid_items_section_6 carousel_1 owl-carousel owl-theme">

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
                    <p><img src="<?= base_url('assets/img/loader.gif'); ?>" width="50"> Loading More products</p>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="grid_section_7" style="margin-top: 2% !important;">
        <div class="row">
            <div class="main_cart_sec ">
                <div class="bg-white" style="border-radius: 0 0 5px 5px;">
                    <div class="" id="" style="padding: 50px 60px; text-align: center; margin-bottom: 20px;">
                        <img src="<?= base_url('assets/img/productnotfound.webp') ?>" title="patazone cart icon" width="100" />
                        <h4 class="text-danger">Opps!</h4>
                        <p>No items found... click <a style="text-decoration: none; color: #B92227; font-weight: bolder;" href="<?= base_url(''); ?>">Here</a> to continue
                            shopping.</p>
                    </div>

                </div>
            </div>
    </section>
<?php endif;
$this->load->view('common/footer'); ?>
<!-- END SECTION 7 -->