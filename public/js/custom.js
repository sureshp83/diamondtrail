$(document).ready(function (e) {
    var Padding = $('footer').height() +  parseInt(40);;
    $('body').css('padding-bottom', Padding);

    $(window).resize(function(){
        var Padding = $('footer').height() +  parseInt(40);;
        $('body').css('padding-bottom', Padding);
    });

    /* Js For Header Search */
    $('.search-block img').click(function () {
    $('.search-box').fadeToggle( "slow", "linear" );
   });

    /* Js For Header Search */
    $('.profile-block').click(function () {
        $('.login-menu').fadeToggle( "slow", "linear" );
        $(this).toggleClass('rotate-arrow');
    });


    /* Js For Responsive Scroll Table dashboard */
    /*$('#dashboard .table-box tbody').scroll(function(e) {
        $('#dashboard .table-box .table').removeClass('scroll-table');
        $(this).parent().addClass('scroll-table');

        $('#dashboard .table-box .scroll-table thead').css("left", - $(".table-box .scroll-table tbody").scrollLeft());
        $('#dashboard .table-box .scroll-table thead th:nth-child(1)').css("left", $(".table-box .scroll-table tbody").scrollLeft());
        $('#dashboard .table-box .scroll-table tbody td:nth-child(1)').css("left", $(".table-box .scroll-table tbody").scrollLeft());
    });

    $('#compare_diamonds .table-box-two tbody').scroll(function(e) {

        $('#compare_diamonds .table-box-two .table').removeClass('scroll-table');
        $(this).parent().addClass('scroll-table');

        $('#compare_diamonds .table-box-two .scroll-table thead').css("left", - $(".table-box-two .scroll-table tbody").scrollLeft());
        $('#compare_diamonds .table-box-two .scroll-table thead th:nth-child(1)').css("left", $(".table-box-two .scroll-table tbody").scrollLeft());
        $('#compare_diamonds .table-box-two .scroll-table tbody td:nth-child(1)').css("left", $(".table-box-two .scroll-table tbody").scrollLeft());
    });*/

    /* Js For Multi Select */
    $('.multiSelect').multiselect({
        // includeSelectAllOption: true
    });

    /* Js For Hide Images On Delete */
    $('.delete-image').click(function () {
        $(this).parent().parent().fadeOut('slow');
    });

    /* Date Picker */
    $('.datepicker').datepicker('setDate', 'now');

    $("#shapeFilter").click(function(){
        $("#shapeFilter ul").toggle();
        $("#shapeFilter").toggleClass('rotate-arrow');
    });


    $(window).bind("load resize",function (event) {
        console.log($(".filtered-data").width());
        $("#myTable").width($(".filtered-data").width());
        $('.sidebar-sticky').removeAttr("style");
        $('.filter-header').removeAttr("style");

        if ($(window).width() > 991 ) {
            /*Sidebar Parent Width*/
            var sidebar_width = $('.sidebar-sticky').parent().width();
            $('.sidebar-sticky').css('width', sidebar_width);

            /*Fix Header Select Box*/
            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();

                if (scroll > 50) {
                    $('.filter-header').addClass('filter-top-fixed');
                    var DivWidth = $('.filter-header').parent().width();
                    var offset = $('.filter-header').parent().offset();
                    $('.filter-header').css('width', DivWidth);
                    $('.filter-header').css('left', offset.left);
                }

                if (scroll < 50) {
                    $('.filter-header').removeClass('filter-top-fixed');
                }
            });
        }
    });
});