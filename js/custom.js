$(document).ready(function(){
    $('.news-list-view-home.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        dots:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

    
    //Ouvre le menu déroulant de niveau 1
    $('#mainnavigation a.dropdown-toggle:not(.openChild)').click(function (e) {
        e.preventDefault();
        if (!$(this).hasClass('show')){
            $('#mainnavigation a.dropdown-toggle.show').dropdown('toggle')
        }
        $(this).dropdown('toggle');
    });
    
    //Ferme le menu
    $('#mainnavigation button.closeMenu').click(function () {
        $('#mainnavigation a.dropdown-toggle.show').dropdown('toggle');
    });

    if(window.innerWidth < 991){
        //Ouvre le menu déroulant de niveau 2
        $('#mainnavigation a.dropdown-toggle.openChild').click(function (e) {
            e.preventDefault();
            if (!$(this).hasClass('show')){
                $('#mainnavigation a.dropdown-toggle.openChild.show').dropdown('toggle')
            }
            $(this).dropdown('toggle');
        });

        //Retourne sur le menu
        $("#mainnavigation .returnMenu").click(function () {
            $('#mainnavigation a.dropdown-toggle.show').dropdown('toggle');
        });
        //Retourne sur le parent
        $("#mainnavigation .returnParent").click(function () {
            $('#mainnavigation a.dropdown-toggle.openChild.show').dropdown('toggle');
        });

        //Ferme le menu
        $('.rightPartResponsive .navbar-toggler').click(function () {
            $('#mainnavigation a.dropdown-toggle.show').dropdown('toggle');
        });

    }

    //
    // Scroll to top
    //
    $('.scroll-top').on('click', function() {
        $(this).blur();
    });
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 300) {
            $('.scroll-top').addClass('scroll-top-visible');
        } else {
            $('.scroll-top').removeClass('scroll-top-visible');
        }
    });
});