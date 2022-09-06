let color = document.querySelectorAll(".btn_slide_p");
for(let i = 0;i < color.length;i++){
    color[i].addEventListener("click", (e)=> {
        let color_ac = document.querySelectorAll(".color_active");
        color_ac[0].className = color_ac[0].className.replace(" color_active", "");
        e.target.className += " color_active";
    })     
}

// let size = document.querySelectorAll(".btn_size");
// for(let i = 0;i < color.length;i++){
//     size[i].addEventListener("click", (e)=> {
//         let color_ac = document.querySelectorAll(".btn_size_active");
//         color_ac[0].className = color_ac[0].className.replace(" btn_size_active", "");
//         e.target.className += " btn_size_active";
//     })     
// }

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

filterSelection("filter_description")
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


// Function for selecting stars for rating
$(".rating-component .star")
    .on("mouseover", function() {
        var onStar = parseInt($(this).data("value"), 10); //
        $(this)
            .parent()
            .children("i.star")
            .each(function(e) {
                if (e < onStar) {
                    $(this).addClass("hover text-warning");
                } else {
                    $(this).removeClass("hover text-warning");
                }
            });
    })
    .on("mouseout", function() {
        $(this)
            .parent()
            .children("i.star")
            .each(function(e) {
                $(this).removeClass("hover text-warning");
            });
    });

$(".rating-component .stars-box .star").on("click", function() {
    var onStar = parseInt($(this).data("value"), 10);
    var stars = $(this).parent().children("i.star");
    var ratingMessage = $(this).data("message");

    var msg = "";
    if (onStar > 1) {
        msg = onStar;
    } else {
        msg = onStar;
    }
    $(".rating-component .starrate .ratevalue").val(msg);

    $(".fa-smile-wink").show();

    $(".button-box .done").show();

    if (onStar === 5) {
        $(".button-box .done").removeAttr("disabled");
    } else {
        $(".button-box .done").attr("disabled", "true");
    }

    for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass("selected");
    }

    for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass("selected");
    }

    $(".status-msg .rating_msg").val(ratingMessage);
    $(".status-msg").html(ratingMessage);
    $("[data-tag-set]").hide();
    $("[data-tag-set=" + onStar + "]").show();
});


// function for submiting reviews
$(document).on("submit", "#form_review", function (e) {
	e.preventDefault();
	let url = $(this).attr("action");

	let userReview = $("#user_review").val();
	let userRating = $("#rate_value").val();
	let data = {
		user_review: userReview,
		user_rating: userRating,
	};

	if (userRating == "") {
		$("#ratingMessage").html(`
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				Please select a rating to continue.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		`);
		Command: toastr["error"]("Please select a rating to continue.");
	} else if (userReview == "") {
		$("#user_review").css("border", "1px solid red").focus();
		$("#ratingMessage").html(`
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				Review field cannot be empty. Pleas enter your review.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		`);
		Command: toastr["error"]("Review field cannot be empty");
	} else {
		$.ajax({
			url: url,
			method: "POST",
			dataType: "JSON",
			data: data,
			success: function (data) {
				if (data.response === "success") {
					load_rating_data();
					$("#form_review")[0].reset();
					$("#ratingMessage").html(`
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							${data.message}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					`);
					Commands: toastr["success"](data.message);
					setTimeout(function() {
						window.location.reload();
					}, 3000)
				} else if (data.response == "info") {
					$("#ratingMessage").html(`
						<div class="alert alert-info alert-dismissible fade show" role="alert">
							${data.message}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					`);
					Command: toastr["info"](data.message);
				} else if (data.response == "error") {
					$("#ratingMessage").html(`
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							${data.message}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					`);
					Command: toastr["error"](data.message);
				}

				if (data.response == "warning") {
					$("#ratingMessage").html(`
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							${data.message}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					`);
					Command: toastr["warning"](data.message);
				}
			},
			error: function (error) {
				// console.log(error);
			},
		});
	}
});

// Function for loading user Ratings
function load_rating_data() {
	{
		const url = $("#getReviews").val();

		$.ajax({
			url: url,
			method: "post",
			dataType: "JSON",
			success: function (data) {
				// console.log(data);
				$("#average_rating").text(data.average_rating);
				$("#total_review").text(data.total_review);
				$("#productTotal_review").text(data.total_review);

				// Rating stars on rating page.
				let star_count = "";
				$(".submit_star").each(function () {
					star_count++;
					if (Math.ceil(data.average_rating) >= star_count) {
						$(this).addClass("text-warning");
						$(this).removeClass("star-light");
					}

					$("#total_five_star_review").text(data.fiveStarReview);

					$("#total_four_star_review").text(data.fourStarReview);

					$("#total_three_star_review").text(data.threeStarReview);

					$("#total_two_star_review").text(data.twoStarReview);

					$("#total_one_star_review").text(data.oneStarReview);

					// Five star progress bar
					$("#five_star_progress").css(
						"width",
						(data.fiveStarReview / data.total_review) * 100 + "%"
					);

					// Foure star progres bar bar
					$("#four_star_progress").css(
						"width",
						(data.fourStarReview / data.total_review) * 100 + "%"
					);

					// Three star progress bar
					$("#three_star_progress").css(
						"width",
						(data.threeStarReview / data.total_review) * 100 + "%"
					);

					// Two star progress bar
					$("#two_star_progress").css(
						"width",
						(data.twoStarReview / data.total_review) * 100 + "%"
					);

					// One star progress bar
					$("#one_star_progress").css(
						"width",
						(data.oneStarReview / data.total_review) * 100 + "%"
					);

					if (data.reviewData.length > 0) {
						var html = "";
						$.each(data.reviewData, function (key, value) {
							html += `
							<hr>
								<div class="rev_content">
									<div class="cus_name_rev">
										<p class="cutomer_name">${value.customerName}</p>
										<p class="rev_date">${timeSince(
											new Date(value.datetime))}
										</p>
										<p class="stars_rating_rev">
											${(function () {
												var starating = ""
												if (value.rating == 5){
													starating = ` <div class="mb-3">
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
												</div>`
												}if (value.rating == 4){
													starating = ` <div class="mb-3">
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
												</div>`
												} if (value.rating == 3){
													starating = ` <div class="mb-3">
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
												</div>`
												} if (value.rating == 2){
													starating = ` <div class="mb-3">
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
												</div>`
												}if (value.rating == 1){
													starating = ` <div class="mb-3">
													<i class="fas fa-star text-warning mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
													<i class="fas fa-star star-light mr-1"></i>
												</div>`
												}
												return  starating;
											})()}
										</p>
										<p class="customer_title">Verified Purchase</p>
									</div>
									<div class="cus_desc_rev">
										<p class="customer_rev_content_desc"> ${value.user_review}</p>
									</div>
								</div> 
						`;
						});

						$("#userContentReviews").html(html);
					} else {
						$("#userContentReviews").html(`
						<hr>
							<p class="text-gray-90 mb-2 text-center">Be the first to review this product.</p>
						`);
					}
				});
			},
		});
	}
}
load_rating_data();

function timeSince(date) {
	var seconds = Math.floor((new Date() - date) / 1000);

	var interval = seconds / 31536000;

	if (interval > 1) {
		return Math.floor(interval) + " years ago";
	}
	interval = seconds / 2592000;
	if (interval > 1) {
		return Math.floor(interval) + " months ago";
	}
	interval = seconds / 86400;
	if (interval > 1) {
		return Math.floor(interval) + " days ago";
	}
	interval = seconds / 3600;
	if (interval > 1) {
		return Math.floor(interval) + " hours ago";
	}
	interval = seconds / 60;
	if (interval > 1) {
		return Math.floor(interval) + " minutes ago";
	}
	return Math.floor(seconds) + " seconds ago";
}