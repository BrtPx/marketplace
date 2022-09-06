
    $('#passwordchng').on('click', (()=>{
        let currentpass = $('#b_pass').val();
        let newpass = $('#m_pass').val();
        let confirmpass = $('#e_pass').val();

        let data = {
            'currentpass':currentpass,
            'newpass': newpass,
            'confirmpass': confirmpass
        }

        $.ajax({
            url: url + 'auth/changePassword',
            dataType: 'json',
            method: 'post',
            data: data,
            beforeSend: (()=>{

            }),
            success: ((res)=>{
                if(res.response == 'success'){
                    Command:toastr['success'](res.message)
                }

                if(res.response == 'error'){
                    Command:toastr['error'](res.message)
                }

                if(res.currentPass_error){
                    $('#currentpass').html(res.currentPass_error)
                    $('#b_pass').css("border", "1px solid red").focus()
                    setTimeout(function() {
                        $('#currentpass').fadeOut()
                    }, 5000)
                }
                if(res.newPass_error){
                    $('#newpass').html(res.newPass_error)
                    $('#m_pass').css("border", "1px solid red").focus()
                    setTimeout(function() {
                        $('#newpass').fadeOut()
                    }, 5000)
                }
                if(res.confPass_error){
                    $('#confirmpass').html(res.confPass_error)
                    $('#e_pass').css("border", "1px solid red").focus()
                    setTimeout(function() {
                        $('#confirmpass').fadeOut()
                    }, 5000)
                }
            }),
            error: ((error)=>{

            })
        })
    }))
