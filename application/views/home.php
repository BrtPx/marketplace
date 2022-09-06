<?php $this->load->view('common/scroll-nav'); ?>

<!-- end header -->
<section id="box-2-slider">
    <div class="box-2-child show_nav_cus owl-carousel owl-theme">
        <div class="item box-2-1 box-2 skeleton">

        </div>
        <div class="item box-2-2 box-2 skeleton">

        </div>
        <div class="item box-2-3 box-2 skeleton">

        </div>
        <div class="item box-2-4 box-2 skeleton">

        </div>
        <div class="item box-2-5 box-2 skeleton">

        </div>
    </div>
</section>

<!-- section 2 end here  -->

<!-- THIS IS SECTION 3 AND THIS DESIGN IS SIMILLER SECTION 6 -->

<?php if (!empty($products['essensials'])) : ?>
    <section class="grid_section_6">
        <div class="container-fluid">
            <div class=" heading_counter_sec_wrapper section_6_buttons">
                <div class="heading_section_5">
                    <h2>Top Deals</h2>
                    <a href="<?= base_url('essentials/Supermarket') ?>">View All</a>
                </div>
                <div class="counter_section_wrapper_6">
                    <div id="myBtnContainer">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#Essentialall">All</a>
                            </li>

                            <!-- <?php foreach ($products['subcategoryProducts'] as $productTab) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Essentials<?= $productTab->id ?>"><?= $productTab->subcategory_name; ?></a>
                                </li>
                            <?php endforeach ?> -->

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tab panes -->
            <div class="tab-wrapper">
                <div class="tab-content">
                    <div class="tab-pane container active" id="Essentialall">
                        <div class="grid_items_section_5 carousel_3 owl-carousel owl-theme">
                            <!--  -->
                            <?php foreach ($products['essensials'] as $ess) :
                                $dubcategory_name = $this->db->get_where('ptz_subcategories', array('id' => $ess->subcategory_id))->row()->subcategory_name;
                            ?>

                                <div class="grid_item_5 item column_filter_class all 1_cat_<?= $ess->subcategory_id ?>">
                                    <?php if ($ess->discount_price != null) :
                                        $amount = $ess->selling_price - $ess->discount_price;
                                        if ($ess->selling_price > 0) {

                                            $discount = ($amount / $ess->selling_price) * 100;
                                        }

                                    ?>
                                        <div class="offer_5 skeleton">
                                            <p><?= '-' . round($discount) . '%'; ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="grid_item_img_5">
                                        <?php echo '<img class="skeleton" style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" src="' . imagebaseURL . $ess->product_thumbnail . '" alt="">'; ?> </div>
                                    <div class="grid_item_content_6">
                                        <div class="product_title_5 ">

                                            <p class="grid_img_5_title"><a href="<?= base_url('/' . $ess->slug) ?>"> <?= substr($ess->product_title, 0, 30) . '...'; ?></a></p>
                                        </div>
                                        <div class="wrap_p_b">
                                            <div class="price_prev_current_5 ">
                                                <?php
                                                if ($ess->discount_price) {
                                                    echo '<p class="current_price_5">KES ' . number_format($ess->discount_price) . '</p>';
                                                    echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                                } else {
                                                    echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                                }
                                                ?>
                                            </div>
                                            <div class="grid_item_button_5 ">
                                                <input type="hidden" id="productQuantity" value="1">
                                                <?php
                                                if ($ess->product_size || $ess->product_color) {
                                                    echo '<button class="btn_item_5" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" ><a href="javascript:;">Select options</a></button>';
                                                } else {
                                                    echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $ess->id . ')" ><a href="#">Add to Cart</a></button>';
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <!-- <?php foreach ($products['subcategoryProducts'] as $productTab) :
                                $sucategoryproducts = $this->db->limit(8)->order_by('rand()')->get_where('ptz_products', array('subcategory_id' => $productTab->id, 'is_varified' => 'yes'))->result();

                            ?>
                        <div class="tab-pane container fade" id="Essentials<?= $productTab->id ?>">
                            <div class="grid_items_section_5 carousel_3 owl-carousel owl-theme">
                                <?php foreach ($sucategoryproducts as $ess) : ?>
                                    <div class="grid_item_5 item column_filter_class all 1_cat_<?= $ess->subcategory_id ?>">
                                        <?php if ($ess->discount_price != null) :
                                            $amount = $ess->selling_price - $ess->discount_price;

                                            if ($ess->selling_price > 0) {
                                                echo $ess->selling_price;
                                                $discount = ($amount / $ess->selling_price) * 100;
                                            }

                                        ?>
                                            <div class="offer_5 skeleton">
                                                <p><?= '-' . round($discount) . '%'; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="grid_item_img_5 skeleton">
                                            <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" src="' . imagebaseURL . $ess->product_thumbnail . '" alt="">'; ?> </div>
                                        <div class="grid_item_content_6">
                                            <div class="product_title_5">

                                                <p class="grid_img_5_title"><a href="<?= base_url('/' . $ess->slug) ?>"> <?= substr($ess->product_title, 0, 30) . '...'; ?></a></p>
                                            </div>
                                            <div class="wrap_p_b">
                                                <div class="price_prev_current_5">
                                                    <?php
                                                    if ($ess->discount_price) {
                                                        echo '<p class="current_price_5">KES ' . number_format($ess->discount_price) . '</p>';
                                                        echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                                    } else {
                                                        echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="grid_item_button_5">
                                                    <input type="hidden" id="productQuantity" value="1">
                                                    <?php
                                                    if ($ess->product_size || $ess->product_color) {
                                                        echo '<button class="btn_item_5" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" ><a href="javascript:;">Select options</a></button>';
                                                    } else {
                                                        echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $ess->id . ')" ><a href="#">Add to Cart</a></button>';
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?> -->

                </div>
            </div>





            <!-- <div class="grid_items_section_6 carousel_1 owl-carousel owl-theme">
                
                <?php foreach ($products['subcategoryProducts'] as $productTab) :
                    $sucategoryproducts = $this->db->limit(8)->order_by('rand()')->get_where('ptz_products', array('subcategory_id' => $productTab->id))->result();
                    foreach ($sucategoryproducts as $ess) :
                ?>
                <div class="grid_item_5 item column_filter_class all 1_cat_<?= $ess->subcategory_id ?>">
                        <?php if ($ess->discount_price != null) :
                            $amount = $ess->selling_price - $ess->discount_price;
                            if ($ess->selling_price  > 0) {

                                $discount = ($amount / $ess->selling_price) * 100;
                            }
                        ?>
                    <div class="offer_5">
                        <p><?= '-' . round($discount) . '%'; ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="grid_item_img_5">
                    <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" src="' . imagebaseURL . $ess->product_thumbnail . '" alt="">'; ?>                    </div>
                    <div class="grid_item_content_6">
                        <? ?>
                        <div class="product_title_5">
                        <?= $ess->subcategory_id ?>
                            <p class="grid_img_5_title"><a href="<?= base_url('/' . $ess->slug) ?>"> <?= substr($ess->product_title, 0, 30) . '...'; ?></a></p>
                        </div>
                        <div class="wrap_p_b">
                            <div class="price_prev_current_5">
                            <?php
                            if ($ess->discount_price) {
                                echo '<p class="current_price_5">KES ' . number_format($ess->discount_price) . '</p>';
                                echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                            } else {
                                echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                            }
                            ?>
                            </div>
                            <div class="grid_item_button_5">
                                <input type="hidden" id="productQuantity" value="1">
                                <?php
                                if ($ess->product_size || $ess->product_color) {
                                    echo '<button class="btn_item_5" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" ><a href="javascript:;">Select options</a></button>';
                                } else {
                                    echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $ess->id . ')" ><a href="#">Add to Cart</a></button>';
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach;
                endforeach; ?>
            </div> -->
        </div>

    </section>
<?php endif; ?>
<!-- END SECTION 3 -->

<!-- START SECTION 4 -->
<?php if (!empty($brands)) : ?>
    <section class="grid_section_slide_4">
        <div class="container-fluid">
            <div class="heading_section_4">
                <h2>Featured Brands</h2>
            </div>
            <div class="grid_items_section_5 show_nav_cus carousel_2 owl-carousel ">
                <?php foreach ($brands as $brand) :
                    echo '<div class="grid_item_4 item skeleton" onclick="loadSlideCategories(\'' . base_url('brand/mlptz-' . $brand->slug . '-shop' . '/' . base64_encode($brand->id)) . '\')" style="cursor: pointer;" >
                            <img src="' . imagebaseURL . $brand->brand_image . '" alt="">
                            <div class="para_grid_text">
                            <p class="grid_img_7_title"><a href="' . base_url('brand/mlptz-' . $brand->slug . '-shop' . '/' . base64_encode($brand->id)) . '">' . $brand->brand_title . '</a></p>
                            </div>
                        </div>';

                ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- END SECTION 4 -->

<!-- START SECTION 5 -->
<?php if (!empty($products['flashsale'])) : ?>
    <section class="grid_section_5">
        <div class="container-fluid">
            <div class="heading_counter_sec_wrapper">
                <div class="heading_section_5">
                    <h2>Daily Flash Sale</h2>
                    <a href="<?= base_url('products/flash_sale') ?>">View All</a>
                </div>
                <div class="counter_section_wrapper_5">
                    <div class="counter_text_5">
                        <p>Hurry Up! Offer ends in:</p>
                    </div>
                    <div class="main_counter_section_5">
                        <div class="time">
                            <p><span class="hours">16</span> Hours</p>
                        </div>
                        <div class="time">
                            <p><span class="minits">23</span> Mins</p>
                        </div>
                        <div class="time">
                            <p><span class="secns">33</span> Secs</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Section -->
            <div class="tab-wrapper">
                <div class="tab-content">
                    <div class="grid_items_section_5 carousel_3 owl-carousel owl-theme">
                        <?php foreach ($products['flashsale'] as $ess) : ?>
                            <div class="grid_item_5 item">
                                <?php if ($ess->discount_price != null) :
                                    $amount = $ess->selling_price - $ess->discount_price;
                                    if ($ess->selling_price > 0) {
                                        $discount = ($amount / $ess->selling_price) * 100;
                                    }
                                ?>
                                    <div class="offer_5 skeleton">
                                        <p><?= '-' . round($discount) . '%'; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="grid_item_img_5 skeleton">
                                    <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" src="' . imagebaseURL . $ess->product_thumbnail . '" width="200" height="200" alt="">'; ?>
                                </div>
                                <div class="grid_item_content_6">
                                    <div class="product_title_5">
                                        <p class="grid_img_5_title"><a href="<?= base_url('/' . $ess->slug) ?>"><?= substr($ess->product_title, 0, 30) . '...'; ?></a></p>
                                    </div>
                                    <div class="wrap_p_b">
                                        <div class="price_prev_current_5">
                                            <?php
                                            if ($ess->discount_price) {
                                                echo '<p class="current_price_5">KES ' . number_format($ess->discount_price) . '</p>';
                                                echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                            } else {
                                                echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="grid_item_button_5">
                                            <?php
                                            if ($ess->product_size || $ess->product_color) {
                                                echo '<button class="btn_item_5" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" ><a href="javascript:;">Select options</a></button>';
                                            } else {
                                                echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $ess->id . ')" ><a href="#">Add to Cart</a></button>';
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
    </section>
<?php endif; ?>
<!-- END SECTION 5 -->

<!-- THIS IS SECTION 6 -->
<?php if (!empty($products['offer_products'])) : ?>
    <section class="grid_section_5">
        <div class="container-fluid">
            <div class="heading_counter_sec_wrapper">
                <div class="heading_section_5">
                    <h2>Product Offer</h2>
                    <a href="<?= base_url('products/special_offer') ?>">View All</a>
                </div>
                <div class="counter_section_wrapper_5">

                </div>
            </div>

            <!-- Grid Section -->
            <div class="tab-wrapper">
                <div class="tab-content">
                    <div class="grid_items_section_5 carousel_4 owl-carousel owl-theme">
                        <?php foreach ($products['offer_products'] as $ess) : ?>
                            <div class="grid_item_5 item">
                                <?php if ($ess->discount_price != null) :
                                    $amount = $ess->selling_price - $ess->discount_price;
                                    if ($ess->selling_price > 0) {
                                        $discount = ($amount / $ess->selling_price) * 100;
                                    }
                                ?>
                                    <div class="offer_5 skeleton">
                                        <p><?= '-' . round($discount) . '%'; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="grid_item_img_5 skeleton">
                                    <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" src="' . imagebaseURL . $ess->product_thumbnail . '" width="200" height="200" alt="">'; ?>
                                </div>
                                <div class="grid_item_content_6">
                                    <div class="product_title_5">
                                        <p class="grid_img_5_title"><a href="<?= base_url('/' . $ess->slug) ?>"><?= substr($ess->product_title, 0, 30) . '...'; ?></a></p>
                                    </div>
                                    <div class="wrap_p_b">
                                        <div class="price_prev_current_5">
                                            <?php
                                            if ($ess->discount_price) {
                                                echo '<p class="current_price_5">KES ' . number_format($ess->discount_price) . '</p>';
                                                echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                            } else {
                                                echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="grid_item_button_5">
                                            <?php
                                            if ($ess->product_size || $ess->product_color) {
                                                echo '<button class="btn_item_5" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" ><a href="javascript:;">Select options</a></button>';
                                            } else {
                                                echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $ess->id . ')" ><a href="#">Add to Cart</a></button>';
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
    </section>
<?php endif; ?>
<!-- END SECTION 6 -->

<!-- START SECTION 7 -->
<section class="grid_section_7">
    <div class="container-fluid">
        <div class="heading_counter_sec_wrapper">
            <div class="heading_section_5">
                <h2>Browse By category</h2>
            </div>
        </div>
        <div class="grid_items_section_7 carousel_5 owl-carousel owl-theme">
            <?php foreach ($categories as $category) :
                echo '<div class="grid_item_7 item" onclick="loadSlideCategories(\'' . base_url('store/' . $category->category_name . '/' . base64_encode($category->id)) . '\')" >
                            <div class="grid_item_img_7 skeleton">
                                <img src="' . imagebaseURL . $category->category_thumbnail . '" width="50" height="50" alt="">
                            </div>
                            <div class="product_title_7">
                                <p class="grid_img_7_title"><a href="' . base_url('store/' . $category->category_name . '/' . base64_encode($category->id)) . '">' . $category->category_name . '</a></p>
                            </div>
                        </div>';

            ?>

            <?php endforeach; ?>

        </div>
    </div>
</section>
<!-- END SECTION 7 -->

<!-- START SECTION 8 -->
<?php if (!empty($products['best_sale'])) : ?>
    <section class="grid_section_5">
        <div class="container-fluid">
            <div class="heading_counter_sec_wrapper">
                <div class="heading_section_5">
                    <h2>Best Selling Products</h2>
                    <a href="<?= base_url('products/best_sale') ?>">View All</a>
                </div>
                <div class="counter_section_wrapper_5">

                </div>
            </div>

            <!-- Grid Section -->
            <div class="tab-wrapper">
                <div class="tab-content">
                    <div class="grid_items_section_5 carousel_6 owl-carousel owl-theme">
                        <?php foreach ($products['best_sale'] as $ess) : ?>
                            <div class="grid_item_5 item">
                                <?php if ($ess->discount_price != null) :
                                    $amount = $ess->selling_price - $ess->discount_price;
                                    if ($ess->selling_price > 0) {
                                        $discount = ($amount / $ess->selling_price) * 100;
                                    }
                                ?>
                                    <div class="offer_5 skeleton">
                                        <p><?= '-' . round($discount) . '%'; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="grid_item_img_5 skeleton">
                                    <?php echo '<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" src="' . imagebaseURL . $ess->product_thumbnail . '" width="200" height="200" alt="">'; ?>
                                </div>
                                <div class="grid_item_content_6">
                                    <div class="product_title_5">
                                        <p class="grid_img_5_title"><a href="<?= base_url('/' . $ess->slug) ?>"><?= substr($ess->product_title, 0, 30) . '...'; ?></a></p>
                                    </div>
                                    <div class="wrap_p_b">
                                        <div class="price_prev_current_5">
                                            <?php
                                            if ($ess->discount_price) {
                                                echo '<p class="current_price_5">KES ' . number_format($ess->discount_price) . '</p>';
                                                echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                            } else {
                                                echo '<p class="previouse_price_5">KES ' . number_format($ess->selling_price) . '</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="grid_item_button_5">
                                            <?php
                                            if ($ess->product_size || $ess->product_color) {
                                                echo '<button class="btn_item_5" onclick="viewProductImage(\'' . $ess->slug . '\', \'' . $ess->product_id . '\')" ><a href="javascript:;">Select options</a></button>';
                                            } else {
                                                echo '<button class="btn_item_5" onclick="addGeneralCart(event, ' . $ess->id . ')" ><a href="#">Add to Cart</a></button>';
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
    </section>
<?php endif; ?>

<!-- END SECTION 8 -->