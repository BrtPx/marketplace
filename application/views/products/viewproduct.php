

<?php
if($product):
$images = $this->db->get_where('ptz_multipleimgs', array('product_id' => $product->id))->result();
$category_name = $this->db->get_where('ptz_categories', array('id' => $product->category_id))->row()->category_name;
$related_products = $this->db->get_where('ptz_products', array('sub_subcategory_id' => $product->sub_subcategory_id))->result();

?>

  <div class="wrap_bg">
        <div class="nav_after_header">
            <ul>
                <li><a href="<?= base_url(); ?>">Home</a></li><span><i class="fas fa-chevron-right"></i></span>
                <li><a href="#"><?= $category_name; ?></a></li><span><i class="fas fa-chevron-right"></i></span>
                <li><a href="#" class="a_active"><?= $product->product_title; ?></a></li>
            </ul>
        </div>
        <!-- nav_after_header -->
        <div class="product_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 product_left">
                        <div class="gallery-parent">
                            <div class="swiper-container gallery-top">
                                <div class="swiper-wrapper">
                                    <?php if(!empty($images)):?>
                                    <?php foreach($images as $image):?>
                                        <div class="swiper-slide easyzoom easyzoom--overlay product_img">
                                            <a class="product-left-img" href="<?= imagebaseURL.$image->img_url; ?>">
                                                <img src="<?= imagebaseURL.$image->img_url; ?>" alt="" />
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                        <div class="swiper-slide easyzoom easyzoom--overlay product_img">
                                            <a class="product-left-img" href="">
                                                <img src="<?= imagebaseURL.$product->product_thumbnail; ?>" alt="" />
                                            </a>
                                        </div>
                                    <?php endif; ?>
   
                                </div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next swiper-button-white btn_arrow_p"></div>
                                <div class="swiper-button-prev swiper-button-white btn_arrow_p"></div>
                            </div>
                            <?php if(!empty($images)):?>
                            <div class="swiper-container gallery-thumbs">
                                <div class="swiper-wrapper">
                                    <?php foreach($images as $image):?>
                                        <div class="swiper-slide product-left-img">
                                            <img src="<?= imagebaseURL.$image->img_url; ?>" alt="" />
                                        </div>
                                    <?php endforeach; ?>
                                    
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 product_right py-5">
                        <div>
                        <?php if ($product->discount_price != null) :
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount / $product->selling_price) * 100; ?>
                            <?php if ($product->product_qty == 0 ):?>
                                <span class="price_discount" style="background-color: #B92227 !important;">Out of stock</span>
                            <?php else: ?>
                                <span class="price_discount"><?= '-' . round($discount) . '%'; ?></span>
                            <?php endif; ?>
                            <?php endif; ?>
                            <h3 class="product_h"><?= substr($product->product_title, 0, 45) . '...'; ?></h3>
                            <?php if($product->discount_price != null):?>
                            <div class="product_price">
                                <h3><?= 'KES '.number_format($product->discount_price) ;?></h3> <h4><del><?= 'KES '.number_format($product->selling_price) ;?></del></h4>
                            </div>
                            <?php endif; ?>
                            <div class="product_code">
                                <p>SKU#: <?= $product->product_sku ;?></p>
                            </div>
                            <div class="product_desc">
                                <p><?= $product->short_description ;?> </p>
                            </div>
                            <?php if($product->product_color != null):?>
                            <div class="product_color">
                                <h6>Color</h6>
                                <div>
                                    <span class="p_color_white btn_slide_p color_active"></span>
                                    <span class="p_color_red btn_slide_p"></span>
                                    <span class="p_color_green btn_slide_p"></span>
                                    <span class="p_color_cyan btn_slide_p"></span>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($product->product_size != null):?>
                            <div class="product_size">
                                <h6 class="mt-4">Size</h6>
                                <div>
                                    <span class="product_size btn_size btn_size_active">S</span>
                                    <span class="product_size btn_size">M</span>
                                    <span class="product_size btn_size">L</span>
                                    <span class="product_size btn_size">XL</span>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="product_quantity">
                                <h6 class="mb-0">Quantity</h6>
                                <div>
                                    <span class="minus_inc inc"><i class="fas fa-minus"></i></span>
                                    <input class="input_inc_dec" type="text" name="" id="productQuantity" value="1">
                                    <span class="plus_inc inc"><i class="fas fa-plus"></i></span>
                                </div>
                            </div>
                            <div class="product_btn">
                                <div class="btn_wrap">
                                    <div>
                                        <input type="hidden" id="productID" value="<?= $product->id ;?>">
                                        <a href="#" class="btn btn_add addtocart" data-bs-toggle="modal" data-bs-target="#addCards">
                                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                            <span class="sr-only">Loading...</span>BUY NOW</a>
                                    </div>
                                    <!-- <div>
                                        <a href="#" class="btn btn_buy">ADD TO BUY</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('common/scroll-nav'); ?>

    <!-- section 2 end here  -->

    <section class="review_specifications">
        <div class="container-fluid">
            <div class="main_content_rev_spec">
                <div id="myBtnContainer" class="filter_buttons">
                    <?php if($product->long_description):?>
                    <button class="btn_fil filter_button_item active_a" onclick="filterSelection('filter_description')">Description</button>
                    <?php endif; ?>
                    <?php if($product->product_specification):?>
                    <button class="btn_fil filter_button_item" onclick="filterSelection('filter_specification')">Specifications</button>
                    <?php endif; ?>
                    <button class="btn_fil filter_button_item" onclick="filterSelection('filter_review')">Reviews <span id="total_review" class="reviwes_no"></span></button>
                </div>
                <?php if($product->long_description):?>
                <div class="filter_description all_hide">
                    <div class="specification_description">
                        <div class="details">
                            <?= $product->long_description; ?>
                        </div>                          
                    </div>
                    
                </div>
                <?php endif; ?>
                <?php if($product->product_specification):?>
                <div class="filter_specification all_hide">
                    <div class="specification_description">
                        <div class="details">
                            <?= $product->product_specification; ?>
                        </div>                            
                    </div>
                </div>
                <?php endif; ?>
                <div class="filter_review all_hide">
                    <div class="review_section">
                        <h6 class="wrapper_heading">Reviews</h6>
                        <div class="review_wrapper">
                            <div class="review_description">
                                <div class="reviews_wrapper_sec">
                                    <div class="total_ratings">
                                    <input type="hidden" name="getReviews" id="getReviews"value="<?= base_url('home/get_review_data/' . $product->id); ?>">
                                        <div class="total_rating_points">
                                            <p class="point">
                                                <span id="average_rating">
                                                </span>
                                            </p>
                                            <div class="mb-3">
                                                <i class="fas fa-star star-light submit_star mr-1"></i>
                                                <i class="fas fa-star star-light submit_star mr-1"></i>
                                                <i class="fas fa-star star-light submit_star mr-1"></i>
                                                <i class="fas fa-star star-light submit_star mr-1"></i>
                                                <i class="fas fa-star star-light submit_star mr-1"></i>
                                            </div>
                                            <p class="reviews_length">Reviews <span id="total_review"></span></p>
                                        </div>
                                    </div>
                                    <div class="customer_ratings">
                                        <div class="rating_stars_review">
                                            <p class="rating_star_length">5</p>
                                            <div class="progress progress_bar_rating">
                                                <div class="progress-ba rev_progress_background" id="five_star_progress" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="rating_percentage"id="total_five_star_review">20%</p>
                                        </div>
                                        <div class="rating_stars_review">
                                            <p class="rating_star_length">4</p>
                                            <div class="progress progress_bar_rating">
                                                <div class="progress-ba rev_progress_background" id="four_star_progress" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="rating_percentage"id="total_four_star_review">40%</p>
                                        </div>
                                        <div class="rating_stars_review">
                                            <p class="rating_star_length">3</p>
                                            <div class="progress progress_bar_rating">
                                                <div class="progress-ba rev_progress_background" id="three_star_progress" role="progressbar" style="width: 13%" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="rating_percentage"id="total_three_star_review">13%</p>
                                        </div>
                                        <div class="rating_stars_review">
                                            <p class="rating_star_length">2</p>
                                            <div class="progress progress_bar_rating">
                                                <div class="progress-ba rev_progress_background" id="two_star_progress" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="rating_percentage"id="total_two_star_review">10%</p>
                                        </div>
                                        <div class="rating_stars_review">
                                            <p class="rating_star_length">1</p>
                                            <div class="progress progress_bar_rating">
                                                <div class="progress-ba rev_progress_background" id="one_star_progress" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="rating_percentage"id="total_one_star_review">10%</p>
                                        </div>
                                    </div>
    
                                    <div class="review_text_button">
                                        <p class="review_text_heading">Review this product.</p>
                                        <p class="review_text_desc">Share your thoughts with other customers.</p>
                                        
                                    </div>
                                    <!-- star rating -->
                                    <div>
                                        <form id="form_review" action="<?= base_url('home/reviews/' . $product->id); ?>">
                                            <div class="row">
                                                <!-- rating -->
                                                <h6>Add a Rating</h6>
                                                <div id="ratingMessage"></div>
                                                <div class="rating-component">
                                                    <div class="status-msg">
                                                        <label>
                                                            <input class="rating_msg" type="hidden" name="rating_msg"
                                                                value=""/>
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <div class="stars-box">
                                                            <i class="star fa fa-star" title="1 star"
                                                                data-message="Poor"
                                                                data-value="1"></i>
                                                            <i class="star fa fa-star" title="2 stars"
                                                                data-message="Too bad"
                                                                data-value="2"></i>
                                                            <i class="star fa fa-star" title="3 stars"
                                                                data-message="Average quality"
                                                                data-value="3"></i>
                                                            <i class="star fa fa-star" title="4 stars"
                                                                data-message="Nice Recomendable" 
                                                                data-value="4"></i>
                                                            <i class="star fa fa-star" title="5 stars"
                                                                data-message="very good quality" 
                                                                data-value="5"></i>
                                                        </div>
                                                    </div> 
                                                    <div>
                                                    <div class="starrate">
                                                    <label>
                                                        <input class="ratevalue" type="hidden" id="rate_value"
                                                            name="rate_value" value="" />
                                                    </label>
                                                    </div>
                                                    </div> 
                                                </div>
                                                <!--review -->
                                                <div>
                                                    <h6>Add a Review</h6>
                                                <textarea class="form-control mb-5" rows="3" id="user_review" name="user_review"data-msg="Please enter your message." data-error-class="u-has-error"data-success-class="u-has-success"placeholder="Write something about this product"></textarea>
                                                </div>
                                                <div class="class="review_text_button mt-3">
                                                    <input type="submit" class="submit btn write_review_btn" value="Submit Review">   
                                                </div>

                                            </div>
                                        </form>
                                    </div>                
                                </div>
                            </div>                         
                            
                            <div class="customers_review">
                                <!-- Review -->
                                <div class="border-bottom border-color-1 pb-3 mb-3">
                                    <!-- Review Rating -->
                                    <div class="" id="userContentReviews"></div>
                                </div>
                                <!-- End Review -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(!empty($related_products)):?>
        <section class="slider_products">
            <div class="container-fluid">
                <div class="heading_counter_sec_wrapper section_6_buttons">
                    <div class="heading_section_5">
                        <h4 class="me-auto">Customers who bought this also bought</h4>
                    </div>
                </div>

                <div class="grid_items_section_slider carousel_1 owl-carousel owl-theme">
                    
                    <!--  -->
                    <?php foreach($related_products as $products):?>
                    <div class="grid_item_5 item column_filter_class babycare freshfood beverages beauty">
                    <?php if ($products->discount_price != null) :
                            $amount = $products->selling_price - $products->discount_price;
                            $discount = ($amount / $products->selling_price) * 100; ?>
                        <div class="offer_5">
                            <p><?= '-' . round($discount) . '%'; ?></p>
                        </div>
                        <?php endif; ?>
                        <div class="grid_item_img_5">
                        <?php echo'<img style="cursor:pointer;" id="produImage" onclick="viewProductImage(\''.$products->slug.'\', \''.$products->product_id.'\')" src="'.imagebaseURL.$products->product_thumbnail.'" alt="">';?>
                        </div>
                        <div class="grid_item_content_6">
                            <div class="product_title_5">
                                <p class="grid_img_5_title"><a href="<?= base_url($products->slug)?>"><?= substr($products->product_title, 0, 30).'...'; ?></a></p>
                            </div>
                            <div class="wrap_p_b">
                                <?php if($products->discount_price){
                                        echo '<p class="current_price_5"> KES ' .number_format($products->discount_price).'</p>';
                                        echo '<p class="previouse_price_5"> KES '.number_format($products->selling_price).'</p>';
                                    }else{
                                        echo '<p class="current_price_5"> KES '.number_format($products->selling_price).'</p>';
                                    }
                                    ?>
                                <!-- <div class="grid_item_button_5">
                                    <button class="btn_item_5 addtocart"><a href="#">Add to Cart</a></button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>
    <?php endif; endif; ?>
