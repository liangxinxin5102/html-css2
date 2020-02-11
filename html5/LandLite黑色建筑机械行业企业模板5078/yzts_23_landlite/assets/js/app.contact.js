$(document).ready(function () {
    init_FormValidator();
    CaptchaHandler();

    $("#btn-Send").click(function () {
        var txtName = $('#txtName');
        var txtEmail = $('#txtEmail');
        var txtMessage = $('#txtMessage');

        if ($('#form-contact-us').valid()) {
            var ajaxRequest = $.ajax({
                url: 'handlers/contact.php',
                type: "POST",
                data: { formType: 'contact', txtName: txtName.val(), txtEmail: txtEmail.val(), txtMessage: txtMessage.val(), txtMailTo: '' },
                beforeSend: function () {
                    $("#btn-Send").button('loading');
                }
            });

            ajaxRequest.fail(
            function (data) {
                var $message = '<i class="icon-times-circle"></i> ' + data.responseText;
                $("#contact-form-message").addClass("alert alert-danger");
                $("#contact-form-message").html($message);
                $("#btn-Send").button('reset');
            });

            ajaxRequest.done(
            function (response) {
                var $message = '<i class="icon-check-circle"></i> ' + response;
                $("#contact-form-message").addClass("alert alert-success");
                $("#contact-form-message").html($message);
            });

            ajaxRequest.always(
                function () {
                    $("#btn-Send").button('reset');
                    $("#form-contact-us")[0].reset();
                }
            );
        }
    });
});

function CaptchaHandler() {
    var array_vals = new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    var array_operators = new Array('+', '+');
    var index = parseInt(Math.random() * 10);
    index = (index == 0) ? index : (index - 1);
    var hidden_val_1 = array_vals[index];
    index = parseInt(Math.random() * 10);
    index = (index == 0) ? index : (index - 1);
    var hidden_val_2 = array_vals[index];
    index = parseInt(Math.random() * 10) % 2;
    var hidden_operator = array_operators[index];
    var result = 0;
    switch (hidden_operator) {
        case '*':
            result = hidden_val_1 * hidden_val_2;
            break;
        default:
            result = hidden_val_1 + hidden_val_2;
            break;
    }

    jQuery('label[for="txtCaptcha"]').html('<strong>What is ' + hidden_val_1 + ' ' + hidden_operator + ' ' + hidden_val_2 + ' = ?</strong>');

    var txtCaptchaResult = '<input type="hidden" id="txtCaptchaResult" />';
    jQuery("body").append(txtCaptchaResult);
    jQuery("#txtCaptchaResult").val(result);
}

function init_FormValidator() {
    $('#form-contact-us').validate({
        rules: {
            txtCaptcha: {
                equalTo: '#txtCaptchaResult'
            }
        },
        messages: {
            txtName: '<i class="icon-remove-sign"></i> required.',
            txtEmail: {
                required: '<i class="icon-remove-sign"></i> required.',
                email: '<i class="icon-info-sign"></i> invalid.'
            },
            txtMessage: '<i class="icon-remove-sign"></i> required.',
            txtCaptcha: {
                required: '<i class="icon-remove-sign"></i> required.',
                equalTo: '<i class="icon-remove-sign"></i> wrong.'
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            $('<div class="clearfix"></div>').insertBefore(error);
            $('<div class="clearfix"></div>').insertAfter(error);
            error.css({ left: element.position().left + (element.width() - error.width()), top: element.position().top + 8, position: 'absolute', 'z-index': 900 });
        },
        invalidHandler: function (event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
            } else {
            }
        }
    });
}