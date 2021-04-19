$(function() {
    let timeoutValue = undefined;
    let searchConfig = {
        "searchWrapper": "body",
        "searchRecommentBox" : ".RecommentSearch_action_listCustomer",
        "searchSpaceAppend": ".RecommentSearch_action_listCustomer .list",
        "searchRecommentItem" : ".RecommentSearch_action_listCustomer .list .item",
        "optionSearch": "[name='searchType']",
        "searchInput": ".page_action_item.search input[name='searchStr']",
        "searchForm": ".page_action_item.search .search_module",
        "searchButton": ".page_action_item.search name='searchBtn'",
        "searchTitle": ".RecommentSearch_action_listCustomer .title span"
    }

    searchByFullname();

    function searchByFullname() {
        let data = {
            "placeholder" : "Nhập tên khách hàng",
            "title" : "Danh sách khách hàng",
            "fieldName" : "customer_fullname",
            "ajaxUrl" : "Customer/LoadListCustomerByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch( data['ajaxUrl'], data['fieldName'] );
    }

    function searchByEmail() {
        let data = {
            "placeholder" : "Nhập email khách hàng",
            "title" : "Danh sách email",
            "fieldName" : "customer_email",
            "ajaxUrl" : "Customer/LoadListCustomerByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch( data['ajaxUrl'], data['fieldName'] );
    }

    function searchByPhone() {
        let data = {
            "placeholder" : "Nhập SĐT khách hàng",
            "title" : "Danh sách SĐT",
            "fieldName" : "customer_phone",
            "ajaxUrl" : "Customer/LoadListCustomerByField"
        }
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch( data['ajaxUrl'], data['fieldName'] );
    }

    function loadDataSearchByOptionSearch( ajaxUrl, fieldName ) {
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: {
                fieldName : fieldName
            },
            dataType: "json",
            success: (data) => {
                appendDataByOptionSearch(data['listData'], fieldName);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }

    function appendDataByOptionSearch(listData, fieldName)
    {
        let htmls = listData.map(function(dataItem) {
            return `<li class="item">${dataItem[fieldName]}</li>`;
        });
        $(searchConfig['searchSpaceAppend']).html(htmls.join(" "));
    }

    // change option search
    $(searchConfig['searchWrapper']).delegate(searchConfig['optionSearch'], "change", function() {
        let optionSearchCurrent = $(this).val();
        $(searchConfig['searchInput']).val('');
        switch(optionSearchCurrent)
        {
            case "customer_fullname" : {
                searchByFullname();
                break;
            }
            case "customer_email" : {
                searchByEmail();
                break;
            }
            case "customer_phone" : {
                searchByPhone();
                break;
            }
        }
    });

    // Focus input search
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchInput'], "focus", function() {
        $(searchConfig['searchRecommentBox']).stop().fadeIn(0);
    });
    // Blur input search
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchInput'], "blur", function() {
        clearTimeout(timeoutValue);
        timeoutValue = setTimeout(function() {
            $(searchConfig['searchRecommentBox']).stop().fadeOut(0);
        }, 500);
    });

    // Keyup input search (search recomment)
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchInput'], "keyup", function() {
        let $searchValue = $(this).val();
        let $fieldName  = $(searchConfig['optionSearch']).val();
        let ajaxUrl = "Customer/searchRecommentByFile";
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: {
                searchValue: $searchValue,
                fieldName: $fieldName
            },
            dataType: "json",
            success: (data) => {
                appendDataByOptionSearch(data['searchData'], $fieldName);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    });
    // Click recomment item
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchRecommentItem'], "click", function() {
        let textNode = $(this).text();
        $(searchConfig['searchInput']).val(textNode);
    });
    // Search action submit
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchForm'], "submit", function() {
        let searchStr    = $(searchConfig['searchInput']).val();
        let searchOption = $(searchConfig['optionSearch']).val();
        let urlCurrent = `Customer/index/desc/all/1/${searchOption}/`;
        $.ajax({
            url: "Ajax/cusomizeUrlSearch",
            method: "POST",
            data: {
                searchStr: searchStr
            },
            dataType: "json",
            success: (data) => {
                let urlNew = urlCurrent+data['urlSearch'];
                window.location.replace(urlNew);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });


});