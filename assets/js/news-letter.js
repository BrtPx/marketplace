// Send Newsletter email via modal
$(document).on("submit", "#newsletterEmailsModal", function(e) {
    e.preventDefault()
    const url = $(this).attr('action')
    const email = $("#subscribeSrEmailModal").val()
    const data = {
        new_user: email
    }

    // Ajax call for sending data to server
    $.post(url, data, function(response) {
        const data = JSON.parse(response)
        if (data.response == 'success') {
            $('#submitEmailNewsletters').css({
                'background': 'green',
                'color': 'white'
            }).text('Success (Thank You)')
            $("#newsletterEmailsModal")[0].reset()
            $("#newsletter_error").html(`<p style="color:#32CD32;">${data.message}</p>`)
        } else if (data.response == 'error') {
            $("#newsletter_error").html(`<p style="color:#ee0000;">${data.message}</p>`);
            $('#submitEmailNewsletters').css({
                'background': 'red',
                'color': 'white'
            }).text('Error (Sorry!)')
        }

        if (data.emailValidation_error) {
            $("#newsletter_error").html(`<p style="color:#ee0000;">${data.emailValidation_error}</p>`)
            $('#submitEmailNewsletters').css({
                'background': 'red',
                'color': 'white'
            }).text('Error (Sorry!)')
            Command: toastr['error'](data.emailValidation_error)
        }
    })
});

// Function for sending newsletter emails
$(document).on("submit", "#newsletterEmails", function(e) {
    e.preventDefault()
    const url = $(this).attr('action')
    const email = $("#subscribeSrEmailz").val()
    const data = {
        new_user: email
    }

    // Ajax call for sending data to server
    $.post(url, data, function(response) {
        const data = JSON.parse(response)
        if (data.response == 'success') {
            $('#subscribeButton').css({
                'background': 'green',
                'color': 'white'
            }).text('Success (Thank You)')
            $("#newsletterEmails")[0].reset()
			 setTimeout(() => {
				 $('#subscribeButton').css({
                'background': '#b92227',
                'color': 'white'
            }).text('Subscribe')
                
            }, 3000)
            Command: toastr['success'](data.message)
            
        } else if (data.response == 'error') {
           
            Command: toastr['error'](data.message)
            $('#subscribeButton').css({
                'background': 'red',
                'color': 'white'
            }).text('Invalid')
			setTimeout(() => {
				 $('#subscribeButton').css({
                'background': '#b92227',
                'color': 'white'
            }).text('Subscribe')
				}, 3000)
            
        }

        if (data.emailValidation_error) {
            $('#subscribeButton').css({
                'background': 'red',
                'color': 'white'
            }).text('Invalid')
			 setTimeout(() => {
				 $('#subscribeButton').css({
                'background': '#b92227',
                'color': 'white'
            }).text('Subscribe')
				 }, 3000)
           
            Command: toastr['error'](data.emailValidation_error)
           
        }
    })
});

//Function for sending customer emails (help center form )
$(document).on('click', '#customerMessageForm', function(e){
    e.preventDefault()
    const url = $("#customerSendMailURL").val()
    const firstName = $('#customerMsgFirstName').val()
    const lastName = $('#customerMsgLastName').val()
    const email = $('#customerMsgEmail').val()
    const subject = $('#customerMsgSubject').val()
    const message = $('#customerMsgMessage').val()
    const formData = {
        f_name: firstName,
        l_name: lastName,
        email: email,
        subject: subject,
        message: message
    }
    $.post(url, formData, function(response){
        const data = JSON.parse(response)
        if(data.response == 'success'){
            $('#customerEmailCenter')[0].reset()
            // Success message
            $(".emailCenterSuccess_msg").html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${data.message}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `)
 
             Command: toastr['success'](data.message)
        } else if(data.response == 'error'){
            // Error message
    
             Command: toastr['error'](data.message)
        }

        if(data.nameOne_error){
            $('#firstName_error').text(data.nameOne_error)
        }

        if(data.nameTwo_error){
            $('#lastName_error').text(data.nameTwo_error)
        }

        if(data.email_error){
            $('#email_error').text(data.email_error)
        }

        if(data.subject_error){
            $('#customerSubject_error').text(data.subject_error)
        }

        if(data.message_error){
            $('#message_error').text(data.message_error)
        }
    })
})
