<?php

    $listProd_recently_viewedResult = !empty(Cookie::get("prod_recently_viewed")) ? json_decode(Cookie::get("prod_recently_viewed"), true) : [];
    $listProd_recently_viewed = [];

    foreach ( $listProd_recently_viewedResult as $resultItem ) {
        $listProd_recently_viewed[] = $resultItem;
    }

    $temp = [];

    for ( $i = 0 ; $i < count($listProd_recently_viewed) - 1 ; $i++ ) {
        for( $j = $i + 1 ; $j < count($listProd_recently_viewed) ; $j ++ ) {
            if ( $listProd_recently_viewed[$i]['timeViewed'] < $listProd_recently_viewed[$j]['timeViewed'] ) {
                $temp                         = $listProd_recently_viewed[$i];
                $listProd_recently_viewed[$i] = $listProd_recently_viewed[$j];
                $listProd_recently_viewed[$j] = $temp;
            }
        }
    }

    $listProd_recently_viewed_recomment = [];

    if ( count($listProd_recently_viewed) > 4 ) {
        for ( $k = 0 ; $k < 4 ; $k++ ) {
            $listProd_recently_viewed_recomment[] = $listProd_recently_viewed[$k];
        }
    } else {
        $listProd_recently_viewed_recomment = $listProd_recently_viewed;
    }

?>
<?php if( !empty( $listProd_recently_viewed_recomment ) ) : ?>
 <div class="adsProd_recomment">
    <a href="" style="display: inline-block;color: #0674b7;font-size: .9rem;margin-left: 5px;font-family: 'tienitnhabep-mainFont-Light';">
        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
        <span>Sản phẩm bạn vừa xem</span>
    </a>
    <div class="ads_prod_box" style="display: flex; flex-wrap: wrap;">
        <?php foreach ( $listProd_recently_viewed_recomment as $prodViewedRecommentItem ) : ?>
        <div class="ads_prod_item" style="flex: 0 0 50%; max-width: 50%; padding: 5px;">
            <a href="<?php {{ echo Config::getBaseUrlClient("{$prodViewedRecommentItem['prod_seoUrl']}-p{$prodViewedRecommentItem['prod_id']}.html"); }} ?>" class="ads_prod_link" style="display: flex;">
                <div class="ads_prod_img" style="flex: 0 0 40%; max-width: 40%;">
                    <span class="thumbNail">
                        <img class="full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($prodViewedRecommentItem['prod_avatar']); }} ?>" alt="<?php {{ echo $prodViewedRecommentItem['prod_name']; }} ?>">
                    </span>
                </div>
                <div class="ads_prod_info" style="flex: 0 0 60%; max-width: 60%; padding-left: 10px; border-bottom: 1px solid #d8d8d8; padding-bottom: 10px;">
                    <span class="ads_prod_info_name" style="color: #333;margin-bottom: 5px;font-size: 1.2rem;font-family: 'tienitnhabep-mainFont-Light';display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;"><?php {{ echo $prodViewedRecommentItem['prod_name']; }} ?></span>
                    <strong class="ads_prod_info_price" style="color: #000;"><?php {{ echo Format::formatCurrency( $prodViewedRecommentItem['prod_price'] ); }} ?></strong>
                    <span class="ads_btn d_flex justify_content_center align_items_center" style="float: right; font-size: 1.4rem; border-radius: 100%;width: 40px; height: 40px; border: 1px solid #d8d8d8;">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<style>
    @media screen and (min-width: 320px) {
        .adsProd_recomment {
            display: none;
        }
     }
    @media screen and (min-width: 600px) {
        .adsProd_recomment {
            display: block;
        }
    }
</style>
<?php endif; ?>