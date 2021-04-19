<?php
    $videoGroup = new VideoController;
    $listVideoGroup = $videoGroup->getListVideoGroupInToday();
?>
<?php if(!empty($listVideoGroup)) : ?>
    <?php foreach($listVideoGroup as $videoGroupItem) : ?>
        <section class="container_sc_item_wrap container">
            <div class="home_video container_space container_bg_sc">
                <div class="container_sc_header">
                    <h2 class="sc_header_title"><?php {{ echo $videoGroupItem['videoGroup_name']; }} ?></h2>
                </div>
                <div class="container_sc_body">
                    <div class="video_about_prod_wrap grid_row">
                        <div class="video_intro grid_column_12 grid_column_lg_6">
                            <div class="video_intro_box h_100 w_100">
                                <iframe width="100" height="100" src="<?php {{ echo $videoGroupItem['video_iframe']; }} ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="video_list grid_column_12 grid_column_lg_6">
                            <div class="video_list_box grid_row">
                                <?php if(!empty($videoGroupItem['prod_video_1'])) : ?>
                                    <div class="video_box_item grid_column_6">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$videoGroupItem['prod_video_1']['prod_seoUrl']}-p{$videoGroupItem['prod_video_1']['prod_id']}.html"); }} ?>" class="video_view_link w_100 h_100">
                                            <div class="box_img position_relative">
                                                <img class="img img_cover full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($videoGroupItem['prod_video_1']['prod_avatar']); }} ?>" alt="<?php {{ echo $videoGroupItem['prod_video_1']['prod_name']; }} ?>">
                                                <i class="icon fa fa-play position_absolute" aria-hidden="true"></i>
                                            </div>
                                            <h4 class="box_title"><?php {{ echo $videoGroupItem['prod_video_1']['prod_name']; }} ?></h4>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($videoGroupItem['prod_video_2'])) : ?>
                                    <div class="video_box_item grid_column_6">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$videoGroupItem['prod_video_2']['prod_seoUrl']}-p{$videoGroupItem['prod_video_2']['prod_id']}.html"); }} ?>" class="video_view_link w_100 h_100">
                                            <div class="box_img position_relative">
                                                <img class="img img_cover full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($videoGroupItem['prod_video_2']['prod_avatar']); }} ?>" alt="<?php {{ echo $videoGroupItem['prod_video_2']['prod_name']; }} ?>">
                                                <i class="icon fa fa-play position_absolute" aria-hidden="true"></i>
                                            </div>
                                            <h4 class="box_title"><?php {{ echo $videoGroupItem['prod_video_2']['prod_name']; }} ?></h4>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($videoGroupItem['prod_video_3'])) : ?>
                                    <div class="video_box_item grid_column_6">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$videoGroupItem['prod_video_3']['prod_seoUrl']}-p{$videoGroupItem['prod_video_3']['prod_id']}.html"); }} ?>" class="video_view_link w_100 h_100">
                                            <div class="box_img position_relative">
                                                <img class="img img_cover full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($videoGroupItem['prod_video_3']['prod_avatar']); }} ?>" alt="<?php {{ echo $videoGroupItem['prod_video_3']['prod_name']; }} ?>">
                                                <i class="icon fa fa-play position_absolute" aria-hidden="true"></i>
                                            </div>
                                            <h4 class="box_title"><?php {{ echo $videoGroupItem['prod_video_3']['prod_name']; }} ?></h4>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($videoGroupItem['prod_video_4'])) : ?>
                                    <div class="video_box_item grid_column_6">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$videoGroupItem['prod_video_4']['prod_seoUrl']}-p{$videoGroupItem['prod_video_4']['prod_id']}.html"); }} ?>" class="video_view_link w_100 h_100">
                                            <div class="box_img position_relative">
                                                <img class="img img_cover full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($videoGroupItem['prod_video_4']['prod_avatar']); }} ?>" alt="<?php {{ echo $videoGroupItem['prod_video_4']['prod_name']; }} ?>">
                                                <i class="icon fa fa-play position_absolute" aria-hidden="true"></i>
                                            </div>
                                            <h4 class="box_title"><?php {{ echo $videoGroupItem['prod_video_4']['prod_name']; }} ?></h4>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="news_list grid_column_12">
                            <div class="news_list_wrap">
                                <a href="" class="news_item"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
<?php endif; ?>