<?php $this->load->view('common/header2');
if (!empty($products)) : ?>
    <section id="box-2-slider" style="margin-top: 2% !important;">
        <div class="heading_section_2 ">
            <?php if ($searchword) {
                echo '<h4>Search results for ' . $searchword . '</h4>';
            } else {
                echo '<h4>Search results</h4>';
            }

            ?>
        </div>
    </section>
    <?php $this->load->view('common/scroll-nav'); ?>

    <!-- START SECTION 7 -->

    <section class="grid_section_7">
        <div class="container-fluid">
            <div class="wrap-sec-7">

                <div class="row" id="post-data">
                    <?php $this->load->view('products/results/search_results', $products) ?>


                    <h4>Related Products</h4>
                </div>

                <!-- scroll loader -->

                <div class="ajax-load text-center m-auto" style="display:none">
                    <p><img src="<?= base_url('assets/img/loader.gif'); ?>" width="50">Loading More products</p>
                </div>
                <!-- Calls and empty search even when commented -->
                <!-- <div class="pagination">
                    <!-- <a href=base_url('home/search') ?>\" class="next">Next</a> -->
                <!-- </div> -->
            </div>
        </div>
    </section>
<?php else : ?>
    <section id="box-2-slider" style="margin-top: 2% !important;">
        <div class="row">

            <div class="main_cart_sec ">
                <div class="bg-white" style="border-radius: 0 0 5px 5px;">
                    <div class="" id="" style="padding: 50px 60px; text-align: center; margin-bottom: 20px;">
                        <img src="<?= base_url('assets/img/productnotfound.webp') ?>" title="patazone cart icon" width="100" />
                        <h4 class="text-danger">
                            <?php if ($searchword) {
                                echo 'No search results found for ' . $searchword;
                            }

                            ?>
                        </h4>
                        <p>The item you are looking for is not available... click <a style="text-decoration: none; color: #B92227; font-weight: bolder;" href="<?= base_url(''); ?>">Here</a> to continue
                            shopping.</p>
                    </div>

                </div>
            </div>
    </section>
<?php endif;
$this->load->view('common/footer'); ?>
<!-- END SECTION 7 -->