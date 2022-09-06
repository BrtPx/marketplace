let state = false;

function toggle() {
    if(state) {
        document.getElementById("password").setAttribute("type", "password");
        document.querySelector('.svg_class_color').classList.remove("svg_class_color_active");
        state = false;
    }else{
        document.getElementById("password").setAttribute("type", "text");
        document.querySelector('.svg_class_color').classList.add("svg_class_color_active");
        state = true;
    }
}
function toggle2() {
    if(state) {
        document.getElementById("confirmpassword").setAttribute("type", "password");
        document.querySelector('.svg_class_color').classList.remove("svg_class_color_active");
        state = false;
    }else{
        document.getElementById("confirmpassword").setAttribute("type", "text");
        document.querySelector('.svg_class_color').classList.add("svg_class_color_active");
        state = true;
    }
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

document.querySelector(".input_create_account").addEventListener("click", () => {
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

// User registration script in ajax
$(document).ready(function() {
    $('#registerForm').on('submit', function(e){
        e.preventDefault();
        const endpoint =$(this).attr("action");

        var firstname = $("input[name='firstname']").val();
        var lastname = $("input[name='lastname']").val();
        var email = $("input[name='email']").val();
        var phone = $("input[name='phone']").val();
        var password = $("input[name='password']").val();
        var confirmpassword = $("input[name='confirmpassword']").val()
        var data = {
            firstname: firstname,
            lastname: lastname,
            email: email,
            phone: phone,
            password: password,
            confirmpassword:confirmpassword
        }            
            $.ajax({
                url: endpoint,
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function(data){
                    if(data.firstName_error){
                        Command: toastr['error'](data.firstName_error)
                        $("input[name=firstname]").css('border','1px solid red').focus();
                    }
                    if(data.lastName_error){
                        Command: toastr['error'](data.lastName_error)
                        $("input[name=lastname]").css('border','1px solid red').focus();
                    }
                    if(data.email_error){
                        Command: toastr['error'](data.email_error)
                        $("input[name=email]").css('border','1px solid red').focus();
                    }
                    if(data.phone_error){
                        Command: toastr['error'](data.phone_error)
                        $("input[name=phone]").css('border','1px solid red').focus();
                    }
                    if(data.password_error){
                        Command: toastr['error'](data.password_error)
                        $("input[name=password]").css('border','1px solid red').focus();
                    }
                    if(data.confirmpassword_error){
                        Command: toastr['error'](data.confirmpassword_error)
                        $("input[name=confirmpassword]").css('border','1px solid red').focus();
                    }
                    
                    if(data.response == 'success'){
                      (data.message == 'success')
                        Command: toastr['success']('Registration successful.')
                      setTimeout(function() {
                          window.location.reload();
                          window.location.href= url;
                      }, 3000)
                    }
                    else{
                        if(data.response == 'error'){

                            Command: toastr['error']('Something went wrong |Please try again later.')
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000)
                        }
                    }
                }

            })
       
    })
})

// user login script  
$(document).ready(function() {
    $("#loginForm").on('submit', function(e) {
        e.preventDefault()
        const email = $("#user_email").val()
        const password = $("#user_password").val()
        const data = {
            email: email,
            password: password
        }
        $.post((url + 'auth/login_user'), data, function(response) {
            const data = JSON.parse(response)
            // Display success messages if there are any
            if (data.response == 'success') {
                $("#loginForm")[0].reset()
                $("#successMessage").text(data.message).css({
                    'display': 'block'
                })
                // Redirect to user to there Relevant page
                setTimeout(function() {
                    window.location.href = redirect
                }, 3000)
                // Display errors if there are any
            } else if (data.response == 'error') {
                $("#errorMessage").text(data.message).css({
                    'display': 'block'
                }).fadeOut(5000)
            }
        })
    })
})
