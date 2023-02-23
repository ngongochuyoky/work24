// library js slide
 
$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
  	loop:true,
  	autoplay: true,
  	lazyLoad: true,
  	opacity: [0,1],
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
  });
});

// xu ly lick active contac
 // var arr_item = document.querySelectorAll('.contact .item');
 //    for(var i = 0; i <= arr_item.length; i++) {
 //      arr_item[i].onclick = function () {
 //        this.classList.add('active');
 //      }
 //    }

// xử lý click form search in slide_banner;
 $('.js-example-basic-single').select2();


