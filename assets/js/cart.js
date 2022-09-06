$('.carousel_1').owlCarousel({
    loop:true,
    nav: true,
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

// let toggle_p = document.querySelector(".toggle-p");

// toggle_p.addEventListener("click", () => {
//     let slide = document.querySelector("#toggle_slide");
//     slide.classList.toggle("slide_active_p");
// });


// a_event 

let a_event = document.querySelectorAll(".a_event");
let slide_toggle = document.querySelector("#toggle_slide");

for(let i = 0;i < a_event.length;i++){
    a_event[i].addEventListener("mouseleave", () => {
        slide_toggle.classList.remove("slide_active_d");
    });
    a_event[i].onclick=(e)=>{
        e.stopPropagation()
        slide_toggle.classList.add("slide_active_d");
    }
    a_event[i].onmouseenter=(e)=>{
        e.stopPropagation()
        slide_toggle.classList.add("slide_active_d");
    }
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

if(title == 'My cart'){
    document.querySelector(".shoping_cart").addEventListener("click", () => {
        slide.classList.remove("hero-child-1_active");
    });
}

// when you mouseenter

let toggle_slide = document.querySelector("#toggle_slide");
toggle_slide.addEventListener("mouseenter", () => {
    toggle_slide.classList.add("slide_active_d_hover")
});
toggle_slide.addEventListener("mouseleave", () => {
    toggle_slide.classList.remove("slide_active_d_hover")
});

// 


// window.addEventListener("scroll", (e) => {
//     let nav_scroll = document.querySelector(".total_price_payment_checkout");
//     let footer_offset = document.querySelector(".footer-bottom");

//     if(window.scrollY + 550 >= nav_scroll.offsetTop){
//         document.querySelector(".scroll-nav-ul").classList.add("nav_fixed_middle");
//         document.querySelector(".scroll-nav-ul li a").classList.add("transition-1");
//         document.querySelector(".path-normal").classList.add("transition-1");
//         document.querySelector(".path-normal-1").classList.add("transition-1");
//     }else if(window.scrollY <= nav_scroll.offsetTop){
//         document.querySelector(".scroll-nav-ul").classList.remove("nav_fixed_middle");
//         document.querySelector(".scroll-nav-ul li a").classList.remove("transition-1");
//         document.querySelector(".path-normal").classList.remove("transition-1");
//         document.querySelector(".path-normal-1").classList.remove("transition-1");
//     }
//     if(window.scrollY + 550 >= footer_offset.offsetTop){
//         document.querySelector(".scroll-nav-ul").classList.remove("nav_fixed_middle");
//         document.querySelector(".scroll-nav-ul li a").classList.remove("transition-1");
//         document.querySelector(".path-normal").classList.remove("transition-1");
//         document.querySelector(".path-normal-1").classList.remove("transition-1");
//     }
// });


// BUTTON INC/DEC
let plus = document.querySelectorAll(".plus_1");
let minus = document.querySelectorAll(".minus_1");
let inputVal = document.querySelectorAll(".input_inc_dec");



for(let i = 0;i<plus.length;i++){
    plus[i].addEventListener("click", (e) => {
        let prevElemInput = e.target.previousElementSibling;
        prevElemInput.value++;
    });
}


for(let i = 0;i<minus.length;i++){
    minus[i].addEventListener("click", (e) => {
        let prevElemInput = e.target.nextElementSibling;
        if(prevElemInput.value > 0) {
            prevElemInput.value--;
        }
    });
}