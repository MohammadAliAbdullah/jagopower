$(document).ready(function() {
    $(document).on('click', '.category_checkbox', function () {

        var ids = [];

        var counter = 0;
        $('#catFilters').empty();
        $('.category_checkbox').each(function () {
            if ($(this).is(":checked")) {
                ids.push($(this).attr('value'));
                $('#catFilters').append(`<div class="alert fade show alert-color _add-secon" role="alert"> ${$(this).attr('attr-name')}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> </div>`);
                counter++;
            }
        });

        $('._t-item').text('(' + ids.length + ' items)');

        if (counter == 0) {
            $('.filter_data').empty();
            $('.filter_data').append('No Data Found');
        } else {
            fetchCauseAgainstCategory(ids);
        }
    });
});

function fetchCauseAgainstCategory(id) {

    $('.filter_data').empty();

    $.ajax({
        type: 'GET',
        url: 'shopss/' + id,
        success: function (response) {
            var response = JSON.parse(response);
            console.log(response);

            if (response.length == 0) {
                $('.filter_data').append('No Data Found');
            } else {
                response.forEach(element => {
                    $('.filter_data').append(`<div href="#" class="col-lg-4 col-md-6 col-sm-6 col-xs-12 r_Causes IMGsize">
                      
                            <div class="img_thumb">
                            <div class="h-causeIMG">
                                <img src="${element.img}" alt="" />
                                </div>
                           
                            </div>
                            <h3>${element.cat_title}</h3>
                      
                    </div>`);
                });
            }
        }
    });
}