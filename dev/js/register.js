$(document).ready(function() {
    let currentStep = 1;
    const totalStep = $('.register-step').length;
    $('.next').click(function() {
        if (currentStep < totalStep) {
            switch(currentStep) {
                case 1:
                    if(!$("#nombre").val() || !$("#apellido").val() || !$("#cumpleanos").val() || !($("#cumpleanos").val())) {
                        Swal.fire({
                            title: "Campos Vacíos",
                            text: "Todos los campos son obligatorios.",
                            icon: "warning"
                        });
                        return;
                    }else{
                        let birthDate = new Date($("#cumpleanos").val());
                        let today = new Date();
                        let age = today.getFullYear() - birthDate.getFullYear();
                        let monthDifference = today.getMonth() - birthDate.getMonth();
                        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                            age--;
                        }
                        if (age < 18) {
                            Swal.fire({
                                title: "Edad Insuficiente",
                                text: "Debes ser mayor de 18 años para registrarte.",
                                icon: "error"
                            });
                            return;
                        }
                    }
                    break;
                case 2:
                    let email = $("#email").val();
                    let carnet = $("#carnet").val();
                    if(!email || !carnet) {
                        Swal.fire({
                            title: "Campos Vacíos",
                            text: "Todos los campos son obligatorios.",
                            icon: "warning"
                        });
                        return;

                    }else{
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(email)) {
                            Swal.fire({
                                title: "Correo Inválido",
                                text: "Por favor, ingresa un correo electrónico válido.",
                                icon: "error"
                            });
                            return;
                        }
                        const carnetPattern = /^[0-9]/;
                        if (!carnetPattern.test(carnet)) {
                            Swal.fire({
                                title: "Cédula Inválida",
                                text: "Por favor, ingresa una cédula de identidad válida.",
                                icon: "error"
                            });
                            return;
                        }else if(carnet.length < 7 || carnet.length > 8) {
                            Swal.fire({
                                title: "Cédula Inválida",
                                text: "La cédula de identidad debe tener entre 7 y 8 dígitos.",
                                icon: "error"
                            });
                            return;
                        }
                    }
                    if(!validateEmail(email)) {
                        Swal.fire({
                            title: "Correo Inválido",
                            text: "Por favor, ingresa un correo electrónico válido.",
                            icon: "error"
                        });
                        return;
                    }
                    if(!validateCarnet(carnet)) {
                        Swal.fire({
                            title: "Cédula Inválida",
                            text: "Por favor, ingresa una cédula de identidad válida.",
                            icon: "error"
                        });
                        return;
                    }
                    break;

                case 3:
                   
                    break;
                // Agrega más casos si tienes más pasos y necesitas validaciones específicas
            }
            $(`.register-step[data-step="${currentStep}"]`).hide();
            currentStep++;
            $(`.register-step[data-step="${currentStep}"]`).css('display', 'flex');
        }
        if (currentStep === 2){
            let usernames = $("#nombre").val()+" "+$("#apellido").val();
            $("#textdp").html("Bueno <strong>"+usernames+"</strong>. Ahora configuremos tu acceso a la plataforma.");
        }
    })

    $('.return').click(function() {
        if (currentStep > 1) {
            $(`.register-step[data-step="${currentStep}"]`).hide();
            currentStep--;
            $(`.register-step[data-step="${currentStep}"]`).css('display', 'flex');
        }
        })

    $("#nombre, #apellido").on("input", function () {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
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
                $('.register-step-confirmation').css('display', 'flex');
                Swal.fire({
                            title: "Código Enviado",
                            text: "Por favor, revisa tu correo para el código de verificación.",
                            icon: "success"
                        });
                
            }
        }
    })
});

function validateEmail(email) {
    return true
}

function validateCarnet(carnet) {
    return true
}