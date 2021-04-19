<div class="filter_money sidebar_box_wrap">
    <div class="sidebar_item_box_header_mobile open_popup_filter d_flex align_items_center">
        <span class="title">Khoảng giá</span>
        <i class="fa" aria-hidden="true"></i>
    </div>
    <div class="sidebar_item_box_header">
        <h4 class="title">KHOẢNG GIÁ</h4>
    </div>
    <div class="mask">
        <a href="" class="close_popup_filter position_absolute">Đóng</a>
    </div>
    <div class="sidebar_item_box_body">
        <div class="filter_body">
            <ul class="list_filter">
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=0_100k{$sortUrl}"); }} ?>" title="Dưới 100k" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='0' && $priceArr[1] == "100k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>Dưới 100k</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=100k_200k{$sortUrl}"); }} ?>" title="Từ 100k đến 200k" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='100k' && $priceArr[1] == "200k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>100K - 200K</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=200k_500k{$sortUrl}"); }} ?>" title="Từ 200k đến 500k" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='200k' && $priceArr[1] == "500k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>200K - 500K</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=500k_1000k{$sortUrl}"); }} ?>" title="Từ 200k đến 1tr" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='500k' && $priceArr[1] == "1000k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>500K - 1 triệu</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=1000k_2000k{$sortUrl}"); }} ?>" title="Từ 1tr đến 2tr" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='1000k' && $priceArr[1] == "2000k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>1 triệu - 2 triệu</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=2000k_3000k{$sortUrl}"); }} ?>" title="Từ 2tr đến 3tr" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='2000k' && $priceArr[1] == "3000k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>2 triệu - 3 triệu</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=3000k_5000k{$sortUrl}"); }} ?>" title="Từ 3tr đến 5tr" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='3000k' && $priceArr[1] == "5000k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>3 triệu - 5 triệu</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=5000k_8000k{$sortUrl}"); }} ?>" title="Từ 5tr đến 8tr" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='5000k' && $priceArr[1] == "8000k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>5 triệu - 8 triệu</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="chk_price_8" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=8000k_15000k{$sortUrl}"); }} ?>" title="Từ 8tr đến 15tr" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='8000k' && $priceArr[1] == "15000k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" id="chk_price_8" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>8 triệu - 15 triệu</span>
                        </a>
                    </label>
                </li>
                <li class="filter_item">
                    <label for="" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}/price=15000k_100000000k{$sortUrl}"); }} ?>" title="Trên 8tr" class="filter_link">
                            <input <?php {{
                                /*----------------------------------------------------------------*/
                                echo $priceArr[0]=='15000k' && $priceArr[1] == "100000000k" ? "checked" : null;
                                /*----------------------------------------------------------------*/
                            }} ?> type="checkbox" value="1" class="d_none">
                            <span title="" class="filter_chek"></span>
                            <span>Trên 15 triệu</span>
                        </a>
                    </label>
                </li>
            </ul>
            <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}{$sortUrl}"); }} ?>" class="clearFilter">Làm mới</a>
        </div>
    </div>
</div>