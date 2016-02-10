$(document).ready(function($) {
    var currentRequest = null;
    $(".collection").hide();
    $(".location").keyup(function() {
        element = $(this);
        id = element.attr('id');
        collection_id = id + "_collection";
        city = element.val().trim();
        console.log("city",city);	
        if (city.length > 2) {
            currentRequest = $.ajax({
                url: getLoctions.replace(/__city__/g, city),
                type: 'post',
                dataType: 'json',
                data: {
                    city: city
                },
                beforeSend: function() {
                    if (currentRequest != null) {
                        currentRequest.abort();
                    }
                }
            }).done(function(a) {
            	console.log(a);
                if (a.hasOwnProperty('message')) {
                    Materialize.toast(a.message, 3000);
                } else {
                    collection = $("#" + collection_id);
                    collection.empty();
                    collection.show();
                    console.log(collection);
                    if (a.predictions.length > 0) {
                        $.each(a.predictions, function(index, val) {
                            template = "<a class='collection-item city-options' id='__id__'>__city__</a>";
                            template = template.replace(/__city__/, val.description);
                            template = template.replace(/__id__/, val.id);
                            collection.append(template);
                        });
                    }
                }
            }).fail(function(a) {console.log(a)}).always(function() {});
        }
    });
    $(document).on('click', "a.city-options", function(e) {
        e.preventDefault();
        option = $(this).attr('id');
        text = $(this).text();
        inp = $(this).parent().parent().find("input.location");
        inp_hidden = $(this).parent().parent().find("input.location_id");
        inp.val(text);
        inp_hidden.val(option);
        $(".collection").empty();
        $(".collection").hide();
    });
});