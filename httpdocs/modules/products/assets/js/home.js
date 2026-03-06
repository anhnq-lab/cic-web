$(document).ready(function () {
    $('body,html').animate({scrollTop:0}, 0);

    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        if (coll[i].classList.contains("collapsible-active")) {
            var content = coll[i].nextElementSibling;
            content.style.maxHeight = content.scrollHeight + 20 + "px";
            setSeeMore(content.id);
        }
        coll[i].addEventListener("click", function () {
            this.classList.toggle("collapsible-active");
            var content = this.nextElementSibling;
            if (!this.classList.contains("collapsible-active")) {
                removeSeeMore(content.id);
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + 20 + "px";
                setSeeMore(content.id);
            }
        });
    }

    $(".btn_search").click(function () {
        val1 = $('#input2').val();
        // if (val1) {
        link = $('#input2').attr("data-url");
        key = $('#input2').attr("data-key");

        loadData(link + "&&" + key + "&&" + val1 + "&&" + val1);

    });
    $('#input2').keypress(function (e) {
        if (e.which == 13) {
            val1 = $('#input2').val();
            // if (val1) {
            link = $('#input2').attr("data-url");
            key = $('#input2').attr("data-key");

            loadData(link + "&&" + key + "&&" + val1 + "&&" + val1);
        }
    });

    $("#sort-a-z-btn").click(function () {
        link = $(this).attr("data-url");
        loadData(link + "&&" + 'order' + "&&" + "a_z" + "&&" + "Sort By A-Z");
    });

    let url = $('#section-product-list').attr("data-url");
    $.ajax({
        type: "GET",
        url: url + window.location.search,
        success: function (result) {
            $('#products-list-content').html(result);
            $('#product_count').html($('#product-list').attr('data-count'));
        }
    });

    $('ul#filter-tags li').click(function () {
        let param = $(this).attr("data-param");
        let name = param.split('&&')[1];
        let value = param.split('&&')[2];
        loadData(param);
        $('#checkbox-' + name + "-" + value).prop('checked', !$('#checkbox-' + name + "-" + value).prop('checked'));
    });
    // update hits
    setTimeout(function () {
        var product_id = $('#product_id').val();
        $.get(root + "index.php?module=products&view=product&task=update_hits&raw=1", {
            id: product_id
        }, function (status) {
        });
    }, 3000);

});
$(".clickmore").click(function () {

    var id = $(this).attr("data-id");

    var less = $(this).attr("data-class");


    if (less == 1) {

        $("#" + id).height("auto");

        $(this).html("Thu gọn");

        $(this).removeAttr("data-class");

    } else {

        var height = $("#" + id).attr("data-height");

        $("#" + id).height(height);

        $(this).html("Xem thông tin đầy đủ");

        $(this).attr("data-class", "1");
    }
});


$("#gach1").bind("click", function () {
    $('html, body').animate({
        scrollTop: $(".a-z").offset().top - $(".utility-content").height() - 130
    }, 1000);
});

function changeCaptcha1() {
    var date = new Date();
    var captcha_time = date.getTime();
    $(".imgCaptcha").attr({
        src: 'libraries/jquery/ajax_captcha/create_image.php?' + captcha_time
    });
}

function changeCaptcha2(el) {
    var date = new Date();
    var captcha_time = date.getTime();
    $(".imgCaptcha").attr({
        src: el.getAttribute('data-url') + '/libraries/jquery/ajax_captcha/create_image.php?' + captcha_time
    });
}

function setSeeMore(id, height) {
    var $listElements = $("#" + id + " label");
    if ($listElements.length > 10) {
        $listElements.hide();
        $listElements.filter(":lt(10)").show();
        $("#" + id).append("<label style='margin-left: 8px' class='see-more'><span>XEM THÊM</span><span class='less'>ẨN BỚT</span></label>");

        $("#" + id).find("label.see-more").click(function () {
            console.log($(this));
            $(this).siblings(":gt(9)").toggle("slow");
            $(this).find("span").toggle();
        });
    }

}

function removeSeeMore(id) {
    var $listElements = $("#" + id + " label");
    $listElements.show();
    $("#" + id + " label.see-more").remove();
}

function loadData(param) {
    let url = param.split('&&')[0]
    let name = param.split('&&')[1];
    let value = param.split('&&')[2];
    let label = param.split('&&')[3];

    let urlSearchParams = new URLSearchParams(window.location.search.substring(1));
    if (name === 'key') {
        value === null || value.trim() !== '' ? urlSearchParams.set(name, value) : urlSearchParams.delete(name)
    } else if (name === 'order') {
        if (urlSearchParams.has(name) && urlSearchParams.get(name) === 'a_z') {
            urlSearchParams.delete(name);
            $('#sort-a-z').removeClass('sort-active')
        } else {
            urlSearchParams.set(name, 'a_z');
            $('#sort-a-z').addClass('sort-active')
        }
    } else {
        if (urlSearchParams.has(name)) {
            let values = urlSearchParams.get(name).split(",");
            if (values.includes(value)) {
                values = values.filter(v => v !== value)
                values.length === 0 ? urlSearchParams.delete(name) : urlSearchParams.set(name, values.join(","))
                // Remove tag cho nay
                removeFilterTag(name, value)
            } else {
                urlSearchParams.set(name, urlSearchParams.get(name) + "," + value)
                // Them tag cho nay
                addFilterTag(url, name, value, label)
            }
        } else {
            urlSearchParams.set(name, value)
            // Them tag cho nay
            addFilterTag(url, name, value, label)
        }
    }

    const params = Array.from(urlSearchParams).length > 0 ? `?${decodeURIComponent(urlSearchParams.toString())}` : ''
    $.ajax({
        type: "GET",
        url: `${url}${params}`,
        success: function (result) {
            window.history.replaceState({}, '', `${location.pathname}${params}`);
            $('#products-list-content').html(result);
            $('#product_count').html($('#product-list').attr('data-count'));
        }
    });
}

function addFilterTag(url, name, value, label) {
    let id = `product-${name}-${value}`
    $('#filter-tags').append(`<li id=${id} data-param="${url}&&${name}&&${value}&&${label}"><span>${label}</span> <button type="button">x</button></li>`);
    $('#filter-tags' + " " + "#" + id).click(function () {
        let param = $(this).attr("data-param");
        loadData(param);
        $('#checkbox-' + name + "-" + value).prop('checked', !$('#checkbox-' + name + "-" + value).prop('checked'))
    })
}

function removeFilterTag(name, value) {
    let id = `#product-${name}-${value}`
    $('#filter-tags' + ' ' + id).remove();
}


function checkFormsubmit(id, type) {

    $('div.label_error').remove();
    if (!notEmpty("name_" + type + id, "Vui lòng cung cấp tên")) {
        return false;
    }
    if (!notValue("city_" + type + id, "Vui lòng cung cấp tỉnh/thành phố")) {
        return false;
    }
    if (!notEmpty("email_" + type + id, "Vui lòng cung cấp email")) {
        return false;
    }
    if (!emailValidator("email_" + type + id, "Email không hợp lệ")) {
        return false;
    }
    if (!notEmpty("phone_" + type + id, "Vui lòng cung cấp số điện thoại")) {
        return false;
    }
    if (!isPhone("phone_" + type + id, "Số điện thoại không hợp lệ")) {
        return false;
    }
    if (!lengthRestriction("phone_" + type + id, "10", "12", "Số điện thoại phải là 10-12 số")) {
        return false;
    }
    // if (!notValue("version_" + type + id, alert_info1[10])) {
    //     return false;
    // }
    if (!notEmpty("txtCaptcha_" + type + id, "Vui lòng nhập capcha"))
        return false;
    return true;
}

function submitForm(el) {
    let url = el.getAttribute('data-base-url');
    let lang = el.getAttribute('data-lang');
    let myForm = "#" + el.getAttribute('data-form-id');
    let myModal = "#" + el.getAttribute('data-modal-id');
    let id = el.getAttribute('data-id');
    let type = el.getAttribute('data-type');
    if (checkFormsubmit(id, type)) {
        $.ajax({
            url: url + "/index.php?module=users&task=ajax_check_captcha&raw=1",
            data: {txtCaptcha: $('#' + "txtCaptcha_" + type + id).val()},
            dataType: "text",
            async: false,
            success: function (data) {
                if (data === '0') {
                    invalid("txtCaptcha_" + type + id, 'Captcha là không chính xác.');
                    changeCaptcha1();
                } else {
                    valid("txtCaptcha_" + type + id);
                    saveDSKH(myForm, id, type, url, lang);
                    resetForm(myForm, id, type);
                    $(myModal).modal('hide')
                }
            }
        });
    }
}

function resetForm(formId, id, type) {
    $(formId + " " + "#name_" + type + id).val('');
    $(formId + " " + "#company_" + type + id).val('');
    $(formId + " " + "#address_" + type + id).val('');
    $(formId + " " + "#city_" + type + id).val('');
    $(formId + " " + "#email_" + type + id).val('');
    $(formId + " " + "#phone_" + type + id).val('');
    $(formId + " " + "#message_" + type + id).val('');
    $(formId + " " + "#txtCaptcha_" + type + id).val('');
    changeCaptcha1();
}

function saveDSKH(formId, id, type, url, lang) {
    let name = $(formId + " " + "#name_" + type + id).val();
    let company = $(formId + " " + "#company_" + type + id).val();
    let address = $(formId + " " + "#address_" + type + id).val();
    let city = $(formId + " " + "#city_" + type + id).val();
    let email = $(formId + " " + "#email_" + type + id).val();
    let phone = $(formId + " " + "#phone_" + type + id).val();
    let message = $(formId + " " + "#message_" + type + id).val();
    let products_name = $(formId + " " + "#products_name_" + type + id).val();
    var formData = {
        name: name,
        company: company,
        address: address,
        city: city,
        email: email,
        phone: phone,
        message: message,
        software: products_name,
        lang: lang
    }

    $.ajax({
        url: url + "/index.php?module=contact&view=contact&task=save_dskh2&raw=1",
        data: formData,
        type: "POST",
        success: function (data) {
            alert("Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất")
        }
    })
}

function closeModal(el) {
    $('div.label_error').remove();
    let myModal = "#" + el.getAttribute('data-modal-id')
    $(myModal).modal('hide')
}

