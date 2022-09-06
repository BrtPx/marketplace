
// _____________________

// mouseover & mouseleave (toggle-d) =>

// a_event 

// let a_event = document.querySelectorAll(".a_event");
// let slide_toggle = document.querySelector("#toggle_slide");

// for(let i = 0;i < a_event.length;i++){
//     a_event[i].addEventListener("mouseleave", () => {
//         slide_toggle.classList.remove("slide_active_d");
//     });
//     a_event[i].onclick=(e)=>{
//         e.stopPropagation()
//         slide_toggle.classList.add("slide_active_d");
//     }
//     a_event[i].onmouseenter=(e)=>{
//         e.stopPropagation()
//         slide_toggle.classList.add("slide_active_d");
//     }
// }

// do not repeat your self


let a_meganav = document.querySelectorAll(".a_meganav");
let a_event = document.querySelectorAll(".a_event");
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


// mouseover & mouseleave (toggle-p) =>

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

// _____________________

filterSelection1("all")
function filterSelection1(c) {
  var x, i;
  x = document.getElementsByClassName("column_filter_class");
  if (c == "") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i].parentNode, "show");
    if (x[i].className.indexOf(c) > -1){
		w3AddClass(x[i].parentNode, "show");
	}else{
		w3AddClass(x[i].parentNode, "cloned");
	}
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

// Add btn_design_sec_5_active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn_design_sec_5");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("btn_design_sec_5_active");
    current[0].className = current[0].className.replace(" btn_design_sec_5_active", "");
    this.className += " btn_design_sec_5_active";
  });
}



filterSelection2("all")
function filterSelection2(c) {
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
  
// Add btn_design_sec_5_active class to the current button (highlight it)
var myBtnContainerWrapper = document.getElementById("myBtnContainerWrapper");
var btns = myBtnContainerWrapper.getElementsByClassName("btn_design_sec_8");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("btn_design_sec_8_active");
    current[0].className = current[0].className.replace(" btn_design_sec_8_active", "");
    this.className += " btn_design_sec_8_active";
  });
}


window.addEventListener("scroll", (e) => {
    let nav_scroll = document.getElementById("nav_scroll");
    let footer_offset = document.querySelector(".footer-bottom");
    // console.log(window.scrollY + 150, footer_offset.offsetTop)

    if(window.scrollY + 200 >= nav_scroll.offsetTop){
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

// countdown timer

var countDownDate = new Date("Feb 28, 2022 15:37:25").getTime();
var x = setInterval(function() {
  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.querySelector(".hours").innerHTML = hours;
  document.querySelector(".minits").innerHTML = minutes;
  document.querySelector(".secns").innerHTML = seconds;
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.querySelector(".hours").innerHTML = 0;
    document.querySelector(".minits").innerHTML = 0;
    document.querySelector(".secns").innerHTML = 0;
    }
}, 1000);


function loadSlideCategories(categorylocation){
    window.location.href = categorylocation;
}


