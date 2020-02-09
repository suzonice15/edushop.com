function orderItem(product_main_category, product_id, product_type, product_name, product_price)
{
    var VariationDatabase = {};
    /*fbq('track', 'AddToCart');*/

    swal({
        title: "Just give us your mobile number",
        icon: "info",
        buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "",
                closeModal: true,
            },
            confirm: {
                text: "Place Order",
                value: true,
                visible: true,
                className: "mobile_order_place",
                closeModal: false
            }
        },
        content: {
            element: "input",
            attributes: {
                placeholder: "Type your mobile number",
                type: "text",
            },
        }
    })

    jQuery( ".mobile_order_place" ).click(function()
    {
        var mobileNumber = jQuery(".swal-content__input").val();
        swal.close();

        /*
        https://larrybd.info/blog/bangladeshi-mobile-number-validation/
        http://larrybd.info/demo_files/bd_mobile_validation/
        var regex = new RegExp("(^[+]{1}[8]{2}[01]{1}[0-9]{9}|^[8]{2}[01]{1}[0-9]{9}|^[01]{2}[0-9]{9})$");

        if ( !regex.test(value) ) {
            return false;
        }*/

        if(!mobileNumber.match(/(^(\+8801|8801|01|008801))[3-9]{1}(\d){8}$/))
        {
            swal({
                title: "Invalid Mobile Number",
                icon: "error"
            });
        }
        else
        {
            swal("Please wait, we are working on your order", {
                buttons: false,
            });

            /*fbq('track', 'initiatecheckout', {
                content_name: product_name,
                content_ids: [product_id],
                content_type: 'product',
                value: product_price,
                currency: 'BDT'
            });*/

            var d = new Date();
            var p_variation_id = 0;

            if(product_type == "variable")
            {
                jQuery("table.variations select").each(function()
                {
                    var product_variationsInfo = variations_form;//JSON.parse(jQuery(".variations_form").attr("data-product_variations"));

                    jQuery.each(product_variationsInfo, function(i, item)
                    {
                        jQuery.each(item.attributes, function(item_attributes_i, item_attributes_item)
                        {
                            if (typeof VariationDatabase[item_attributes_i] === 'undefined') {
                                VariationDatabase[item_attributes_i] = {};
                            }

                            if (typeof VariationDatabase[item_attributes_i][item_attributes_item] === 'undefined') {
                                VariationDatabase[item_attributes_i][item_attributes_item] = {};
                            }

                            VariationDatabase[item_attributes_i][item_attributes_item] = item.variation_id
                        });
                    });
                });

                jQuery("table.variations select").each(function()
                {
                    p_variation_id = VariationDatabase[jQuery(this).attr("name")][jQuery(this).val()]
                    //p_variation_id[jQuery(this).attr("name")] = jQuery(this).val();
                });
            }

            if(product_type == "variable" && (p_variation_id === null || p_variation_id === undefined || p_variation_id === '' || p_variation_id === 0))
            {
                p_variation_id = 0;
                /*swal.close();
                swal(
                    'Oops...',
                    'You Have to Select A Size.',
                    'error'
                )
                return;*/
            }

            jQuery.ajax({
                type: "POST",
                url: (websiteURL+"op/addPending?time="+(d.getTime())),
                data: { mobile_number: mobileNumber, product_id: product_id, product_ids: JSON.stringify([{"id":product_id, "qty":1, "name":product_name}]), product_type: product_type, variation_id: p_variation_id},
                dataType: 'json',
                success: function(msg)
                {
                    swal.close();
					swal("à¦†à¦ªà¦¨à¦¾à¦° à¦…à¦°à§à¦¡à¦¾à¦°à¦Ÿà¦¿ à¦¨à¦¿à¦¶à§à¦šà¦¿à¦¤ à¦¹à§Ÿà§‡à¦›à§‡, à¦§à¦¨à§à¦¯à¦¬à¦¾à¦¦à¥¤", "à¦¬à¦¿à¦¸à§à¦¤à¦¾à¦°à¦¿à¦¤ à¦œà¦¾à¦¨à¦¤à§‡ à¦†à¦®à¦°à¦¾ à¦†à¦ªà¦¨à¦¾à¦•à§‡ à¦«à§‹à¦¨ à¦•à¦°à¦¬à§‹", "success");
                    //validate_mobile(product_main_category, product_id, product_type, product_name, product_price, mobileNumber);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    swal.close()
                    swal(
                        'Oops...',
                        XMLHttpRequest.responseJSON.error_message,
                        'error'
                    )
                }
            });
        }
    });
}

function validate_mobile(product_main_category, product_id, product_type, product_name, product_price, mobileNumber)
{
    swal({
        title: "Just one step more",
        text: "We send a verification code to your mobile, please enter the code here.",
        icon: "info",
        buttons: {
            confirm: {
                text: "Submit",
                value: true,
                visible: true,
                className: "verification_code_place",
                closeModal: false
            }
        },
        content: {
            element: "input",
            attributes: {
                placeholder: "Verification Code",
                type: "text"
            },
        }
    })


    jQuery( ".verification_code_place" ).click(function()
    {
        var validation_code = jQuery(".swal-content__input").val();
        //swal.close();

        if(validation_code.length<4)
        {
            swal({
                title: "Invalid Verification Code",
                icon: "error",
                buttons: {
                    confirm: {
                        text: "Try Again",
                        value: true,
                        visible: true,
                        className: "validate_mobile_again",
                        closeModal: false
                    }
                }
            });

            jQuery( ".validate_mobile_again" ).click(function()
            {
                validate_mobile(product_main_category, product_id, product_type, product_name, product_price, mobileNumber);
            })
        }
        else
        {
            swal("Please wait, for a while", {
                buttons: false,
            });

            /*fbq('track', 'Purchase', {
                content_name: product_name,
                content_ids: [product_id],
                content_type: 'product',
                value: product_price,
                currency: 'BDT'
            });*/

            var d = new Date();

            jQuery.ajax({
                type: "POST",
                url: (websiteURL+"op/Confirm?validation=true&time="+(d.getTime())),
                data: {mobile_number: mobileNumber, validation_code: validation_code},
                dataType: 'json',
                success: function(msg)
                {
                    swal.close();
                    swal("See, how easy it is?", "Order have been placed", "success");

                    gtag('event', 'purchase', {
                        "transaction_id": new Date().valueOf(),
                        "affiliation": "BdeshiShop.Com",
                        "value": product_price,
                        "currency": "INR",
                        "tax": 0.0,
                        "shipping": 0,
                        "items": [
                            {
                                "id": product_id,
                                "name": product_name,
                                "list_name": product_name,
                                "brand": "BdeshiShop.Com",
                                "category": product_main_category,
                                "quantity": 1,
                                "price": product_price
                            }
                        ]
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    swal({
                        title: XMLHttpRequest.responseJSON.error_message,
                        icon: "error",
                        buttons: {
                            confirm: {
                                text: "Try Again",
                                value: true,
                                visible: true,
                                className: "validate_mobile_again",
                                closeModal: false
                            }
                        }
                    });

                    jQuery( ".validate_mobile_again" ).click(function()
                    {
                        validate_mobile(product_main_category, product_id, product_type, product_name, product_price, mobileNumber);
                    })
                }
            });
        }
    });
}


function trackOrder()
{
    if($("#mobileNuberTotrack").val().trim().length === 0)
    {
        swal({
            title: "Just give us your mobile number",
            icon: "info",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Track",
                    value: true,
                    visible: true,
                    className: "mobile_order_place",
                    closeModal: false
                }
            },
            content: {
                element: "input",
                attributes: {
                    placeholder: "Type your mobile number",
                    type: "text",
                },
            }
        })

        jQuery( ".mobile_order_place" ).click(function()
        {
            var mobileNumber = jQuery(".swal-content__input").val();
            swal.close();

            if(mobileNumber.length<10)
            {
                swal({
                    title: "Invalid Mobile Number",
                    icon: "error"
                });
            }
            else
            {
                swal("Please wait, we are working on your request", {
                    buttons: false,
                });

                var d = new Date();

                jQuery.ajax({
                    type: "POST",
                    url: (websiteURL+"track_u?time="+(d.getTime())),
                    data: { mobile_number: mobileNumber},
                    dataType: 'json',
                    success: function(msg)
                    {
                        swal.close();
                        window.location.href = websiteURL+'track';
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        swal.close()
                        swal(
                            'Oops...',
                            XMLHttpRequest.responseJSON.error_message,
                            'error'
                        )
                    }
                });
            }
        });
    }
    else
    {
        var d = new Date();

        jQuery.ajax({
            type: "POST",
            url: (websiteURL+"track_u?time="+(d.getTime())),
            data: { mobile_number: $("#mobileNuberTotrack").val()},
            dataType: 'json',
            success: function(msg)
            {
                window.location.href = websiteURL+'track';
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                swal(
                    'Oops...',
                    XMLHttpRequest.responseJSON.error_message,
                    'error'
                )
            }
        });
    }
}
