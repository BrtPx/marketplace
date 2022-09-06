<section class="shoping_cart">
        <div class="container-fluid">
            <div class="row">
                <div class="main_cart_sec">
                    <div class="top_pagination_link">
                        <div class="links_page">
                            <ul id="pagination_links">
                                <li class="links"><a href="#" class="highlight_link_p">Cart</a></li>
                                <li class="links"><img src="<?= base_url()?>assets/img/arrow.svg" alt=""></li>
                                <li class="links"><a href="#" class="normal_link">Infortmation</a></li>
                                <li class="links"><img src="<?= base_url()?>assets/img/arrow.svg" alt=""></li>
                                <li class="links"><a href="#" class="normal_link">Shipping</a></li>
                                <li class="links"><img src="<?= base_url()?>assets/img/arrow.svg" alt=""></li>
                                <li class="links"><a href="#" class="normal_link">Payment</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="page_title">
                        <h2>Shopping Cart</h2>
                    </div>
                    <?php if($this->cart->total() != 0):?>
                        <div class="table_sec" id="loadcart">
                            <div class="main_table_sec">
                                <div class="table_row">
                                    <div class="table_title_1 product_1"></div>
                                    <div class="table_title_1 product_2"></div>
                                    <div class="table_title_1 product_3">product</div>
                                    <div class="table_title_1 unit_price_4">unit price</div>
                                    <div class="table_title_1 quantity_5">quantity</div>
                                    <div class="table_title_1 sub_total_6">sub total</div>
                                </div>

                                <div class="table_1" id="cartdata">
                                    <?php foreach($cartcontents['cart'] as $cart):?>
                                    <div class="table_row_outer">
                                        <div class="table_img">
                                            <div class="table_row_inner">
                                            <?php echo '<button onclick="removeFromCart(\''.$cart['rowid'].'\')" class="click_remove"></button>'?>
                                                
                                                <div class="table_1_img">
                                                    <img src="<?= imagebaseURL.$cart['options']['Image'] ?>" width="80" alt="">
                                                </div>
                                            </div>
                                            <div class="table_row_inner">
                                                <div class="table_data_title_1">
                                                    <p class="table_data_title_responsive">Product</p>
                                                    <p class="table_data_desc"><?= $cart['name']?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table_data">
                                            <div class="table_row_inner">
                                                <div class="table_data_title_1">
                                                    <p class="table_data_title_responsive">Unit Price</p>
                                                    <p class="table_data_desc"><?= 'KES '.number_format($cart['price']); ?></p>
                                                </div>
                                            </div>
                                            <div class="table_row_inner">
                                                <div class="table_row_inner_button">
                                                    <p class="table_data_title_responsive">Quantity</p>
                                                    <div class="cart_button_plus_minus_1">
                                                        <span class="minus_1" onclick="decrementCartItems(<?php echo' \''.$cart['rowid'].'\'' ?>)">-</span>
                                                        <input type="number" class="input_inc_dec" min="1" value="<?= $cart['qty'] ?>">
                                                        <span class="plus_1" onclick="incrementCartItem(<?php echo' \''.$cart['rowid'].'\'' ?>)">+</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table_row_inner">
                                                <div class="table_data_title_1">
                                                    <p class="table_data_title_responsive">Sub Total</p>
                                                    <p class="table_data_desc"><?= 'KES '.number_format($cart['subtotal']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ;?>
                                </div>
                            </div>
                        </div>
                        <div class="total_price_payment_checkout" id="totalpricepayment">
                            <div class="total_price">
                                <div class="update_btn_block">
                                    <button class="update_button"><a href="#">Update cart</a></button>
                                </div>
                                <div class="sub_total">
                                    <div class="sub_left">
                                        <p>Subtotal</p>
                                    </div>
                                    <div class="sub_right_price">
                                        <p id="subtotal"><?= 'KES '.number_format($cartcontents['cartTotal']); ?></p>
                                    </div>
                                </div>
                                <div class="delivery_note_sec">
                                    <div class="charge_sec">
                                        <div class="right_charge">
                                            <p>Delivery Charges</p>
                                        </div>
                                        <div class="left_charge">
                                            <img src="<?= base_url()?>assets/img/warn.svg" alt="">
                                        </div>
                                    </div>
                                    <div class="delivery_para">
                                        <p>Shipping, taxes, and discounts codes calculated at checkout. Orders will be processed in KES.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="payment_checkout">
                                <div class="text_total_price">
                                    <div class="price_total_div">
                                        <p>Order total</p>
                                    </div>
                                    <div class="price_total_div">
                                        <p id="total"><?= 'KES '.number_format($cartcontents['cartTotal']); ?></p>
                                    </div>
                                </div>
                                <div class="button_checkout_price">
                                    <div class="order_total_left">
                                        <button id="continueshopping" class="continue_shopping">Continue Shopping</button>
                                    </div>
                                    <div class="checkout_right">
                                        <button class="proceed_checkout" id="proceedcheckout">Proceed to Checkout</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php else: ?>
                            <div class="bg-white" style="border-radius: 0 0 5px 5px;">
                                <div class="" id=""
                                style="padding: 50px 60px; text-align: center; margin-bottom: 20px;">
                                <img src="<?= base_url('assets/img/shopping-cart.png') ?>" title="patazone cart icon" width="100" />
                                <h4 class="text-danger">
                                    Cart is Empty!
                                </h4>
                                <p>Your shopping items will appear here... click <a href="<?= base_url(''); ?>">Here</a> to start
                                    shopping.</p>
                            </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- THIS IS SECTION 3 AND THIS DESIGN IS SIMILLER SECTION 6 -->
    <?php if($products):?>
    <section class="grid_section_6">
        <div class="container-fluid">
            <div class="heading_counter_sec_wrapper section_6_buttons">
                <div class="heading_section_5">
                    <h4 class="me-auto">You Might also be interested in</h4>
                </div>
            </div>
            
            <div class="grid_items_section_6 carousel_1 owl-carousel owl-theme">
                
                <!--  -->
                <?php foreach($products['essensials']  as $products):?>
                    <div class="grid_item_5 item">
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
                                <div class="grid_item_button_5">
                                    <input type="hidden" id="productID" value="<?= $products->id?>">
                                    <input type="hidden" id="productQuantity" value="1">
                                    <!-- <button class="btn_item_5" onclick="addGeneralCart(event,<?= $products->id?>)" ><a href="javascript:;">Add to Cart</a></button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </section>
    <?php endif; ?>
    <!-- END SECTION 3 -->

    <?php $this->load->view('common/scroll-nav');?>