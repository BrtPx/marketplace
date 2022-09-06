let color = document.querySelectorAll(".btn_slide_p");
for(let i = 0;i < color.length;i++){
    color[i].addEventListener("click", (e)=> {
        let color_ac = document.querySelectorAll(".color_active");
        color_ac[0].className = color_ac[0].className.replace(" color_active", "");
        e.target.className += " color_active";
    })     
}

let size = document.querySelectorAll(".btn_size");
for(let i = 0;i < color.length;i++){
    size[i].addEventListener("click", (e)=> {
        let color_ac = document.querySelectorAll(".btn_size_active");
        color_ac[0].className = color_ac[0].className.replace(" btn_size_active", "");
        e.target.className += " btn_size_active";
    })     
}

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

document.querySelector(".wrap_bg").addEventListener("click", () => {
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



window.addEventListener("scroll", (e) => {
    let nav_scroll = document.querySelector(".product_right");
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


// BUTTON INC/DEC
let plus = document.querySelector(".plus_inc");
let minus = document.querySelector(".minus_inc");
let inputVal = document.querySelector(".input_inc_dec");



plus.addEventListener("click", (e) => {
    inputVal.value++;
});

minus.addEventListener("click", (e) => {
    if(inputVal.value > 0) {
        inputVal.value--;
    }
});

filterSelection("filter_specification")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("all_hide");
  if (c == "") c = "";
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


// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn_fil");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active_a");
    current[0].className = current[0].className.replace(" active_a", "");
    this.className += " active_a";
  });
}


$('.carousel_1').owlCarousel({
  loop:true,
  nav: true,
  dots:false,
  margin:10,
  autoplay:true,
  responsive:{
      0:{
          items:2,
          nav:false
      },
      600:{
          items:2,
          nav:false
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


// product modal

