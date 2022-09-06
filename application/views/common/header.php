<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $favicon = $this->db->get('ptz_favicon')->row(0)->favicon_image;
    $mainLogo = $this->db->get('ptz_patazonlogo')->row(1)->logo_image;
    $topAdvert = $this->db->get_where('ptz_bunners', array('type' => 'TopHeader'))->row()->image;
    ?>
    <title><?= $title; ?></title>
    <!-- <link href="https://code.jquery.com/jquery-3.4.1.min.js"> -->
    <link href="<?= base_url() ?>assets/js/owlcarousel/owl.carousel.min.js">
    <!-- preload load intensive images -->
    <link rel=preload as=image href="<?= imagebaseURL . $topAdvert; ?>">
    <?php foreach ($slidebunners['bunners'] as $slideImaxges) :
    ?>
        <link rel=preload as=image href="<?= imagebaseURL . $slideImaxges->image ?>">
    <?php endforeach; ?>

    <?php foreach ($slidebunners['sliderImages'] as $slideImaxges) :
    ?>
        <link rel=preload as=image href="<?= imagebaseURL . $slideImaxges->slider_image ?>">
    <?php endforeach; ?>
    <link rel="shortcut icon" href="<?= imagebaseURL . $favicon; ?>">
    <!-- <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- <script src="<?= base_url() ?>assets/js/jquery-3.5.1.min.js"></script> -->
    <!-- jquery cdn link -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- font family rubik -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <!-- font awesome cdn link  -->

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/> -->

    <!-- <link rel="preload" as="style" onload="this.rel='stylesheet'" href="<?= base_url() ?>assets/css/owlstyle.css"> -->
    <link rel="preload" as="style" onload="this.rel='stylesheet'" href="<?= base_url() ?>assets/css/owlcarousel/owl.carousel.css">
    <link rel="preload" as="style" onload="this.rel='stylesheet'" href="<?= base_url() ?>assets/css/owlcarousel/owl.carousel.min.css">
    <link rel="preload" as="style" onload="this.rel='stylesheet'" href="<?= base_url() ?>assets/css/owlcarousel/owl.theme.default.min.css">

    <!-- owl slider cdn links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- bootstrap cdn link -->

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive/responsive.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/az.css">
    <!-- custom cdn links -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-213653324-1"></script> -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-213653324-1');
    </script>
</head>

<body>
    <?php if ($topAdvert) : ?>

        <img src="<?= imagebaseURL . $topAdvert; ?>" alt="leaderboard" style="width: 100% !important;height: 100% !important;" />
        <!-- <img src="<?= base_url() ?>assets/img/leaderboard.gif" alt="leaderboard" style="width: 100% !important;height: 100% !important;" /> -->
    <?php endif; ?>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
    <div class="elfsight-app-1b28ae8d-f8b3-4477-b044-878300e7810c"></div>
    <header>
        <div class="header-top">
            <div class="header-top-child">
                <div id="logo" style="cursor: pointer;">
                    <div id="humburger" class="toggle-p">
                        <img src="<?= base_url() ?>assets/img/hamburger.svg" alt="">
                    </div>
                    <img id="logo" src="<?= imagebaseURL . $mainLogo; ?>" alt="">
                </div>
                <!-- logo -->
                <!-- Search -->
                <form class="input-top-wrap" action="<?= base_url('shop/products/search') ?>">
                    <input type="text" id="searchProducts" name="searchProducts" placeholder="Search products, brands and categories" autocomplete="off">
                    <ul class="list-group links_clazz" id="searchResult" style="list-style:none; display:flex;flex-direction:column;padding-left:0;margin-bottom:0; width: inherit !important; margin-top: 5px !important; z-index: 100; max-height: 400px; overflow-y:auto; cursor:pointer; position:absolute;"></ul>
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div class="wrap-icon-top">
                    <?php if ($this->session->userdata('user_login') == 1) : ?>
                        <div class="icon-1">
                            <a href="javascript:;">
                                <div class="useraccounts">
                                    <svg width="33" height="31" viewBox="0 0 33 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M28.4863 21.6228C24.9324 16.7996 14.9305 10.0471 3.35479 21.6228C1.57781 24.4152 -0.909961 30 3.35479 30C7.61954 30 22.3939 30 29.2479 30C30.2633 29.2384 31.9895 27.2584 30.771 25.4306" stroke="black" stroke-width="2" stroke-linecap="round" />
                                        <circle cx="16.2313" cy="7.61562" r="6.61562" stroke="black" stroke-width="2" />
                                    </svg>
                                </div>
                                <div>
                                    <span id="signout">Sign Out</span> <br> <span id="myaccount">My Account</span>
                                </div>

                            </a>
                        </div>
                        <?php else : if ($title != 'Welcome Please Login' || $title != 'Create Your Account & Shop With Confidence.') : ?>
                            <div class="icon-1">
                                <a href="javascript:;">
                                    <div class="useraccounts">
                                        <svg width="33" height="31" viewBox="0 0 33 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M28.4863 21.6228C24.9324 16.7996 14.9305 10.0471 3.35479 21.6228C1.57781 24.4152 -0.909961 30 3.35479 30C7.61954 30 22.3939 30 29.2479 30C30.2633 29.2384 31.9895 27.2584 30.771 25.4306" stroke="black" stroke-width="2" stroke-linecap="round" />
                                            <circle cx="16.2313" cy="7.61562" r="6.61562" stroke="black" stroke-width="2" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span id="signin">Sign In</span> <br> <span id="createaccount">Create Account</span>
                                    </div>
                                </a>
                            </div>
                    <?php endif;
                    endif; ?>
                    <!-- 1 -->
                    <div class="icon-1">
                        <a href="<?= base_url('shopping/cart/') ?>">
                            <div>

                                <svg width="42" height="43" viewBox="0 0 42 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.3658 24.9998C20.9783 24.9998 19.5 24.4332 19.5 24.1664C19.5 16.3257 19.7705 10.9809 15.6609 10.9809C11.4843 10.9809 11.5366 16.1657 11.5366 24.5831C11.5366 24.8499 10.6558 24.9998 10.2683 24.9998C9.88077 24.9998 9 24.4332 9 24.1664C9 15.0949 10.2978 9.99976 15.6561 9.99976C21.5119 9.99976 21.9999 16.9626 21.9999 24.1664C22.0047 24.4418 21.7533 24.9998 21.3658 24.9998Z" fill="black" />
                                    <path d="M15.3062 23.1836H18.4913C18.4955 23.7937 18.8648 24.2274 19.2208 24.4644C19.5836 24.7059 20.0258 24.8206 20.4621 24.8206C20.903 24.8206 21.3452 24.7022 21.7059 24.4605C22.0563 24.2257 22.4287 23.7936 22.4329 23.1836H29.4545L26.6874 42H15.3062H3.92493L1.15781 23.1836H8.17935C8.18355 23.7937 8.55285 24.2274 8.90887 24.4644C9.27164 24.7059 9.71378 24.8206 10.1502 24.8206C10.591 24.8206 11.0332 24.7022 11.394 24.4605C11.7443 24.2257 12.1167 23.7936 12.121 23.1836H15.3062Z" stroke="black" stroke-width="2" />
                                </svg>
                                <span class="cart-total"><?= count($this->cart->contents()); ?></span>
                            </div>
                            <div>
                                My Cart <br>
                                <span id="crt" style="color: #ff3030; font-weight: bold;"> <?php echo 'KES ' . number_format($this->cart->total()); ?> </span>
                            </div>
                        </a>
                    </div>
                    <!-- 2 -->
                </div>
            </div>
            <!-- Search -->
            <form class="input-top-bottom" action="<?= base_url('home/search') ?>">
                <input type="text" id="mobileSearch" name="searchProducts" placeholder="Search products, brands and categories" autocomplete="false">
                <ul class="list-group links_clazz" id="searchResultz" style="list-style:none; display:flex;flex-direction:column;padding-left:0;margin-bottom:0; width: inherit !important; margin-top: 5px !important; z-index: 100; max-height: 200px; overflow-y:auto; cursor:pointer; position:absolute;"></ul>
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div id="hero">
            <!-- sub nav 1 -->
            <?php foreach ($categories as $key => $cate) :
                $subcategory = $this->db->get_where('ptz_subcategories', array('category_id' => $cate->id, 'is_major' => 1))->result();

            ?>
                <div id="toggle_slide" class="toggle-slide a_meganav a_event_child_<?= $key; ?>">
                    <div> <?php foreach ($subcategory as $sub) :
                                $sub_subcategories = $this->db->get_where('ptz_subsubcategories', array('subcategory_id' => $sub->id))->result();
                            ?>
                            <div class="toggle-child-box">
                                <div class="toggle-child-box-top">
                                    <h6 id="subcate"><?= $sub->subcategory_name; ?></h6>
                                </div>
                                <ul class="toggle-child-box-bottom">
                                    <?php foreach ($sub_subcategories as $subsub) : ?>
                                        <li><a href="<?= base_url('shop/' . $subsub->sub_subcategory_name . '/' . base64_encode($subsub->id)); ?>"><?= $subsub->sub_subcategory_name ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                        <?php if ($cate->id == 1 || $cate->id == 2 || $cate->id == 4) :
                            $brands = $this->db->limit(6)->order_by('rand()')->get_where('ptz_brands', array('category_id' => $cate->id))->result();
                        ?>
                            <div class="toggle-child-box">
                                <div class="toggle-child-box-top">
                                    <h6 id="subcate">Best Selling Brands</h6>
                                </div>
                                <ul class="toggle-child-box-bottom">
                                    <?php foreach ($brands as $brand) : ?>
                                        <li><a href="<?= base_url('brand/mlptz-' . $brand->slug . '-shop' . '/' . base64_encode($brand->id)) ?>"><?= $brand->brand_title; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>

            <!-- slide on left -->
            <div class="hero-child">
                <div class="hero-child-1">
                    <div>
                        <div class="hero-child-1-top">
                            <div class="hero-toggle toggle-d">
                                <img src="<?= base_url() ?>assets/img/hamburger.svg" alt="">
                            </div>
                            <h6 class="mb-0">Browse Categories</h6>
                        </div>
                        <ul class="hero-ul" id="hero-url" style="max-height: 390px; overflow-y:auto; cursor:pointer;">
                            <?php foreach ($categories as $key => $result) : ?>
                                <li><a href="<?= base_url('store/' . $result->category_name . '/' . base64_encode($result->id)) ?>" id="getcateid" cate="<?= $result->id ?>" class="a_event a_event_<?= $key; ?>"><img src="https://sellercenter.patazone.co.ke/<?= $result->category_image; ?>" alt="" width="25"> <?= $result->category_name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- 1 -->
                <?php
                if ($title == 'Welcome to patazone') {
                    $this->load->view('common/homesliders/slide');
                }
                ?>
            </div>
        </div>
    </header>