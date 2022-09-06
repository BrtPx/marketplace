<?php $this->load->view('common/header2'); ?>
<section id="box-2-slider">
        <div class="heading_section_2">
            <?php if($offer == 'flash_sale'):?>
            <h4>Flash Sale</h4>
            <?php endif; ?>

            <?php if($offer == 'special_offer'):?>
            <h4>Products on special offer</h4>
            <?php endif; ?>

            <?php if($offer == 'best_sale'):?>
            <h4>Best selling products</h4>
            <?php endif; ?>
        </div>
        
    </section>

    <?php $this->load->view('common/scroll-nav');?>

    <!-- START SECTION 7 -->
    <?php if(!empty($products)):
        ?>
    <section class="grid_section_7">
        <div class="container-fluid">
            <div class="wrap-sec-7">
                
                <div class="row" id="post-data">
                   <?php $this->load->view('products/results/offers', $products); ?>
                </div>
                <div class="ajax-load text-center m-auto" style="display:none">
                    <p><img src="<?= base_url('assets/img/loader.gif');?>" width="50">Loading More products</p>
                </div>
            </div>
        </div>
    </section>
    <?php else:?>
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
    <?php endif; $this->load->view('common/footer'); ?>
    <!-- END SECTION 7 -->
