
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

function changeCaptcha1(url) {
    var date = new Date();
    var captcha_time = date.getTime();
    $(".imgCaptcha").attr({
        src: url + '/libraries/jquery/ajax_captcha/create_image.php?' + captcha_time
    });
}

function changeCaptcha2(el) {
    var date = new Date();
    var captcha_time = date.getTime();
    $(".imgCaptcha").attr({
        src: el.getAttribute('data-url') + '/libraries/jquery/ajax_captcha/create_image.php?' + captcha_time
    });
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
                    changeCaptcha1(url);
                } else {
                    valid("txtCaptcha_" + type + id);
                    saveDSKH(myForm, id, type, url, lang);
                    resetForm(myForm, id, type, url);
                    $(myModal).modal('hide')
                }
            }
        });
    }
}

function resetForm(formId, id, type, url) {
    $(formId + " " + "#name_" + type + id).val('');
    $(formId + " " + "#company_" + type + id).val('');
    $(formId + " " + "#address_" + type + id).val('');
    $(formId + " " + "#city_" + type + id).val('');
    $(formId + " " + "#email_" + type + id).val('');
    $(formId + " " + "#phone_" + type + id).val('');
    $(formId + " " + "#message_" + type + id).val('');
    $(formId + " " + "#txtCaptcha_" + type + id).val('');
    changeCaptcha1(url);
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

function closeModal2(el) {
    $('div.label_error').remove();
    let myModal = "#" + el.getAttribute('data-modal-id')
    $(myModal).modal('hide')
}