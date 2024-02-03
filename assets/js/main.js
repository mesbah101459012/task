//register ajax sending Post request 

$(document).on('submit','#registerForm',(function(e){

    e.preventDefault();


    let url="./handlers/handleRegister.php";
    console.log(url);

    $.ajax({
        type:"post",
        url: url,
        data:$(this).serialize(),
        dataType:'JSON',
     
        success: function(data){
            console.log(data);

            if(data.registered)
            {
                window.location.href=data.redirect;
            }
            $('#Errs').empty();
           for(err of data)
           {
            

                $('#Errs').append(

                    `
                        <p class='px-3 py-1 m-0' >-${err}</p>
                    `
                )
           }

          


        }

    })

}))

//logInForm ajax sending Post request 

$(document).on('submit','#loginForm',(function(e){

    e.preventDefault();


    let url="./handlers/handleLogin.php";

    $.ajax({
        type:"post",
        url: url,
        data:$(this).serialize(),
        dataType:'JSON',
     
        success: function(data){
            console.log(data);

            if(data.loggedin)
            {
                window.location.href=data.redirect;
            }
            $('#loginErrs').empty();
           for(err of data)
           {
            

                $('#loginErrs').append(

                    `
                        <p class='px-3 py-1 m-0' >-${err}</p>
                    `
                )
           }

          


        }

    })

}))


//reset password ajax sending Post request  to send reset mail

$(document).on('submit','#resetPasswordForm',(function(e){

    e.preventDefault();


    let url="./handlers/resetPass.php";

    $.ajax({
        type:"post",
        url: url,
        data:$(this).serialize(),
        dataType:'JSON',
     
        success: function(data){
            console.log(data);

            if(data.success)
            {
                $('#resetPassErrs').empty();
                $('#successMsg').empty();
                $('#successMsg').append(

                    `
                        <p class='p-3 m-0' >${data.successMsg}</p>
                    `
                )
            }
            else{
            $('#resetPassErrs').empty();
           for(err of data)
           {
            

                $('#resetPassErrs').append(

                    `
                        <p class='px-3 py-1 m-0' >-${err}</p>
                    `
                )
           }

        }


        }

    })

}))

//reset password  sending ajax Post request 

$(document).on('submit','#resetPassword',(function(e){

    e.preventDefault();


    let url="../../handlers/handleResetPass.php";

    $.ajax({
        type:"post",
        url: url,
        data:$(this).serialize(),
        dataType:'JSON',
     
        success: function(data){
            console.log(data);

            if(data.success)
            {
                $('#resetPassErrs').empty();
                $('#successMsg').empty();
                $('#successMsg').append(

                    `
                        <p class='p-3 m-0' >${data.successMsg}</p>
                    `
                )
                setTimeout(function () {
                    window.location.href= "http://localhost/task"; // the redirect goes here
            
                    },5000); // 5 seconds
            }
            else{
            $('#resetPassErrs').empty();
           for(err of data)
           {
            

                $('#resetPassErrs').append(

                    `
                        <p class='px-3 py-1 m-0' >-${err}</p>
                    `
                )
           }

        }


        }

    })

}))