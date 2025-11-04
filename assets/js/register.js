$(document).ready(function() {
    let emailValid = false;
    let carnetValid = false;
   
    $("#nombre, #apellido").on("input", function () {
        // this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
    });

    $("#carnet, #telefono, #otroCampo").on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);
    });

    $("#finish").on("click", function() {
        if(currentStep === totalStep) {
            if(!$("#nombre").val() || !$("#apellido").val() || !$("#cumpleanos").val() || !($("#cumpleanos").val()) || !$("#email").val() || !$("#carnet").val()) {
                location.reload();
                return;
            }else{
                fetch('/autenticarse/generateOTP')
        .then(response => response.json())
        .then(data=>{
            if(data.valid){
                 $('.register-step-confirmation').css('display', 'flex');
                Swal.fire({
                            title: "Código Enviado",
                            text: "Por favor, revisa tu correo para el código de verificación.",
                            icon: "success"
                });
                $("#finish").hide();
                $("#register").show();
            }else{
                Swal.fire({
                            title: "Error",
                            text: "Hubo un problema al enviar el código. Intenta nuevamente más tarde.",
                            icon: "error"
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });  
            }
        }
    })
    $("#register").on("click", function() {
        const nombre = $("#nombre").val().trim();
        const apellido = $("#apellido").val().trim();
        const cumpleanos = $("#cumpleanos").val().trim();
        const email = $("#email").val().trim();
        const carnet = $("#carnet").val().trim();
        const type_dni = $("#tipo-dni").val();
        const codeotp = $("#opt").val().trim();
        const namestest= /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/

        if(!nombre || !apellido || !cumpleanos || !email || !carnet || !type_dni) {
            Swal.fire({
            title: "Error",
            text: "Todos los campos son obligatorios.",
            icon: "error"
            });
            return;
        }
        if(!namestest.test(nombre) || !namestest.test(apellido)) {
            Swal.fire({
            title: "Error",
            text: "El nombre y apellido solo deben contener letras.",
            icon: "error"
            });
            return;
        }

        if(!emailValid) {
            Swal.fire({
            title: "Error",
            text: "El correo electrónico no es válido o ya está en uso.",
            icon: "error"
            });
            return;
        }
        if(!carnetValid) {
            Swal.fire({
            title: "Error",
            text: "El número de cédula no es válido o ya está en uso.",
            icon: "error"
            });
            return;
        }
        
        let FormDatare = new FormData(document.getElementById("register-form"));
        fetch("/autenticarse/registerUser", {
            method: "POST",
            body: FormDatare
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(!data.valid) {
                Swal.fire({
                    title: "Error",
                    text: data.message,
                    icon: "error"
                });
            }else if(data.valid) {
                Swal.fire({
                    title: "Registro Exitoso",
                    text: "Tu registro ha sido completado con éxito.",
                    icon: "success"
                })
            }
        })

    });

    // $("#register").on("click", function() {
    //     let otp = $("#codeotp").val();
    //     if(!otp) {
    //         Swal.fire({
    //             title: "Código Vacío",
    //             text: "Por favor, ingresa el código de verificación enviado a tu correo.",
    //             icon: "warning"
    //         });
    //         return;
    //     }
    //     let FormDatare = new FormData(document.getElementById("register-form"));
    //     fetch("/autenticarse/confirmOTP", {
    //         method: "POST",
    //         body: FormDatare
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log(data);
    //         if(data.valid) {
    //             Swal.fire({
    //                 title: "Registro Exitoso",
    //                 text: "Tu registro ha sido completado con éxito.",
    //                 icon: "success"
    //             });
    //         } else {
    //             Swal.fire({
    //                 title: "Error",
    //                 text: data.message,
    //                 icon: "error"
    //             });
    //         }
    //         console.log(data);
    //     })
    //     .catch(error => {
    //         console.error("Error:", error);
    //     });
    // })

    //Validaciones correo y cedula
    $("#carnet").on("blur", async function() {
        let carnet = $(this).val();
        if(carnet.length >= 7 && carnet.length <= 8) {
            let typedni = $('#tipo-dni').val();
            if( await validateCarnet(typedni,carnet)){
                $(this).removeClass("input-error").addClass("input-success");
                carnetValid = true;
            }else{
                $(this).removeClass("input-success").addClass("input-error"); 
                carnetValid = false;
            }
        }
    })

    $("#email").on("blur", async function() {
        let email = $(this).val();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailPattern.test(email)) {
            var prueba = await validateEmail(email)
            // console.log(prueba)
            if(prueba){
                $(this).removeClass("input-error").addClass("input-success");
                emailValid = true;
            }else{  
                $(this).removeClass("input-success").addClass("input-error");
                emailValid = false;
            }
        }else{
            // console.log("correo invalido");
        }
    });
});

async function validateEmail(emailu) {
    let FormData3 = new FormData();
    FormData3.append('email', emailu);
    try {
         const response = await  fetch(`/autenticarse/vld3m41l`, {
            method: 'POST',
            body: FormData3
        })
        const data = await response.json()
        //  console.log(data)
        if (data.valid) {
            return true;
        } else {
            return false;
        }   
    } catch (error) {
        console.log('Error', error);
        return false;   
    }
}

async function validateCarnet(type_dni,carnet) {
    let FormData2 = new FormData();
    FormData2.append('type_dni', type_dni);
    FormData2.append('dni', carnet);
    try {
        const responde = await fetch(`/autenticarse/vldc4rnt`, {
        method: 'POST',
        body: FormData2
    })
    const data = await responde.json();
    if (data.valid) {
        return true;
    } else {
        return false;
    }
    } catch (error) {
        
    }
    
}