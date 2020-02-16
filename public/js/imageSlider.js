$(function() {
    let item = $(this).children().length;

    $('.owl-carousel').owlCarousel({
        items: 5,
        margin:10,
        center:true,    
        nav : true,
        responsive: {
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });
    console.log(item);
});
