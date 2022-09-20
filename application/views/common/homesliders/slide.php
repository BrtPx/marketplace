<div class="hero-child-2">
    <div class="slicker-for hero-slider">
        <?php foreach ($slidebunners['sliderImages'] as $slideImaxges) :
            $categoryname = $this->db->get_where('ptz_categories', array('id' => $slideImaxges->category_id))->row()->category_name;
            echo '<div class="item hero-slide skeleton" onclick="loadSlideCategories(\'' . base_url('store/' . $categoryname . '/' . base64_encode($slideImaxges->category_id)) . '\')" style="background: url(' . imagebaseURL . $slideImaxges->slider_image . ') no-repeat;background-size: cover; cursor: pointer;">
            </div>';
        ?>

        <?php endforeach; ?>
        <!-- 1 -->
    </div>
</div>
<!-- 2 -->
<div class="hero-child-3">
    <div>
        <?php foreach ($slidebunners['bunners'] as $slideImaxges) :
        ?>

            <div class="hero-3-box skeleton" style="background: url('<?= imagebaseURL . $slideImaxges->image ?>') no-repeat; background-size: cover; position: relative;">
            </div>
        <?php endforeach; ?>
    </div>
    <!-- 3 -->
</div>