$('.hero-slider').owlCarousel({
    loop:true,
    nav: true,
    margin:0,
    autoplay:true,
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

// 1
$('.box-2-child').owlCarousel({
    loop:false,
    nav: true,
    dots: false,
    rtl:true,
    margin:0,
    autoplay:true,
    responsive:{
        0:{items:1},500:{items:1},600:{items:2},700:{items:2},800:{items:3},900:{items:3},1000:{items:4},1100:{items:4},1200:{items:4},1300:{items:5}
    }
});

// slider 1

$('.carousel_1').owlCarousel({
    loop:false,
    nav: true,
    dots:false,
    margin:10,
    autoplay:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        700:{
            items:3
        },
        1000:{
            items:4
        },
        1200:{
            items:4
        },
        1300:{
            items:6
        },
        1400:{
            items:6
        }
    }
});

$('.carousel_2').owlCarousel({
    loop:false,
    nav: true,
    dots:false,
    margin:10,
    autoplay:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        700:{
            items:3
        },
        1000:{
            items:4
        },
        1200:{
            items:4
        },
        1300:{
            items:6
        },
        1400:{
            items:6
        }
    }
});

$('.carousel_3').owlCarousel({
    loop:false,
    nav: true,
    dots:false,
    margin:10,
    autoplay:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        700:{
            items:3
        },
        1000:{
            items:4
        },
        1200:{
            items:4
        },
        1300:{
            items:6
        },
        1400:{
            items:6
        }
    }
});

$('.carousel_4').owlCarousel({
    loop:false,
    nav: true,
    dots:false,
    margin:10,
    autoplay:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        700:{
            items:3
        },
        1000:{
            items:4
        },
        1200:{
            items:4
        },
        1300:{
            items:6
        },
        1400:{
            items:6
        }
    }
});

$('.carousel_5').owlCarousel({
    loop:false,
    nav: true,
    dots:false,
    margin:10,
    autoplay:true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        700:{
            items:3
        },
        1000:{
            items:4
        },
        1200:{
            items:4
        },
        1300:{
            items:6
        },
        1400:{
            items:6
        }
    }
});

// a_event 

let a_event = document.querySelectorAll(".a_event");
let a_meganav = document.querySelectorAll(".a_meganav");
let slide_toggle = document.querySelector("#toggle_slide");


for(let i = 0;i < a_event.length;i++){
    // onmouseleave
    onmouseleave(i)
    
    // onclick
    onclick(i)

    // onhover
    onhover(i)

    a_meganav[i].addEventListener("mouseenter", (e)=> {
            e.target.classList.add("slide_active_d_hover");
    })

    a_meganav[i].addEventListener("mouseleave", (e)=> {
            e.target.classList.remove("slide_active_d_hover");
    })

}

function onhover(num){
    a_event[num].onmouseenter=(e)=>{
        e.stopPropagation()
        
        if(a_event[num].classList.contains("a_event_"+num)){
            for(let i = 0;i < a_meganav.length;i++){
                if(a_meganav[i].classList.contains("a_event_child_"+num)){
                    a_meganav[i].classList.add("slide_active_d");
                }
            }
        }
    }
}

function onclick(num){
    a_event[num].onclick=(e)=>{
        e.stopPropagation()
        
        if(a_event[num].classList.contains("a_event_"+num)){
            for(let i = 0;i < a_meganav.length;i++){
                if(a_meganav[i].classList.contains("a_event_child_"+num)){
                    a_meganav[i].classList.add("slide_active_d");
                }
            }
        }
    }
}

function onmouseleave(num){
    a_event[num].addEventListener("mouseleave", ()=> {
        if(a_event[num].classList.contains("a_event_"+num)){
            for(let i = 0;i < a_meganav.length;i++){
                if(a_meganav[i].classList.contains("a_event_child_"+num)){
                    a_meganav[i].classList.remove("slide_active_d");
                }
            }
        }
    });
}

// a

let toggle_p = document.querySelector(".toggle-p");
let toggle_p2 = document.querySelector(".toggle-p2");
let slide = document.querySelector(".hero-child-1");

toggle_p.onclick=(e)=>{
    e.stopPropagation()
    slide.classList.toggle("hero-child-1_active");
}
toggle_p.onmouseenter=(e)=>{
    e.stopPropagation()
    slide.classList.add("hero-child-1_active");
}

document.querySelector("header").addEventListener("click", () => {
    slide.classList.remove("hero-child-1_active");
});

// when you mouseenter

let toggle_slide = document.querySelector("#toggle_slide");
toggle_slide.addEventListener("mouseenter", () => {
    toggle_slide.classList.add("slide_active_d_hover")
});
toggle_slide.addEventListener("mouseleave", () => {
    toggle_slide.classList.remove("slide_active_d_hover")
});

// 


filterSelection1("all")
function filterSelection1(c) {
  var x, i;
  x = document.getElementsByClassName("column_filter_class");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
      if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
    }
  }
  
  function w3RemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
      while (arr1.indexOf(arr2[i]) > -1) {
        arr1.splice(arr1.indexOf(arr2[i]), 1);     
      }
    }
    element.className = arr1.join(" ");
}


window.addEventListener("scroll", (e) => {
    let nav_scroll = document.querySelector("#box-2-slider");
    let footer_offset = document.querySelector(".footer-bottom");

    if(window.scrollY + 100 >= nav_scroll.offsetTop){
        document.querySelector(".scroll-nav-ul").classList.add("nav_fixed_middle");
        document.querySelector(".scroll-nav-ul li a").classList.add("transition-1");
        document.querySelector(".path-normal").classList.add("transition-1");
        document.querySelector(".path-normal-1").classList.add("transition-1");
    }else if(window.scrollY <= nav_scroll.offsetTop){
        document.querySelector(".scroll-nav-ul").classList.remove("nav_fixed_middle");
        document.querySelector(".scroll-nav-ul li a").classList.remove("transition-1");
        document.querySelector(".path-normal").classList.remove("transition-1");
        document.querySelector(".path-normal-1").classList.remove("transition-1");
    }
    if(window.scrollY + 550 >= footer_offset.offsetTop){
        document.querySelector(".scroll-nav-ul").classList.remove("nav_fixed_middle");
        document.querySelector(".scroll-nav-ul li a").classList.remove("transition-1");
        document.querySelector(".path-normal").classList.remove("transition-1");
        document.querySelector(".path-normal-1").classList.remove("transition-1");
    }
});

