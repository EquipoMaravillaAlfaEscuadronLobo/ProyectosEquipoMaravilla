$.validator.setDefaults({
    submitHandler: function () {
       
        document.getElementById('registrarE').value="ok";    
        document.frmEditoriales.submit();
        
        
    }
});

$(document).ready(function () {
     $("#frmEditoriales").validate({
        rules: {
            nombree_edit: {
                required: true,
                minlength: 3
            },
            telefonoe_edit: {
                required: true,
                minlength: 3
            },
            email_edit: {
                required: true
            },
            direccion_edit: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            nombree_edit: {
                required: "Por favor ingrese el nombre",
                minlength: "El titulo debe de tener por lo menos 3 caracteres"
            },
            apellido: {
                required: "Por favor ingrese el apellido",
                minlength: "El apellido debe de tener por lo menos 3 caracteres"
            },
            direccion_edit: {
                required: "Por favor ingrese la direccion",
                minlength: "ingrese una direccion real"
            },
            bio1: {
                required: "Por favor seleccione la biografia"
            },
            cantidad: {
                required: "Por favor ingrese la cantidad"
            },
            editorial: {
                required: "Por favor eliga la editorial"
            },
            fecha_nac: {
                required: "Por favor ingrese la fecha de nacimiento"
            },
            nameSexo: {
                required: "Seleccione un campo"
            },
            email_edit: {
                required: "Por favor ingrese un correo"
            },
            nameDui: {
                minlength: "ingrese un dui valido",
                required: "ingrese un dui valido"
            },
            nameUser : {
                required: "ingrese un nombre de usuario ",
                minlength: "debe de poseer por lo menos 6 caracteres "
            },
            telefonoe_edit:{
               required: "favor ingrese su teléfono",
                minlength: "ingrese un numero telefónico valido"
            },
            NameNivel :{
                required: "Seleccione un Nivel"
            },
            NameNombreX :{
                required: "Seleccione un Nivel"
            }
            
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");

            // Add `has-feedback` class to the parent div.form-group
            // in order to add icons to inputs
            element.parents(".col-sm-5").addClass("has-feedback");

            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                error.insertAfter(element);
            }

            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if (!element.next("span")[ 0 ]) {
                $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
            }
        },
        success: function (label, element) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            if (!$(element).next("span")[ 0 ]) {
                $("<span class='glyphicon glyphicon-ok form-control-feedback'></span>").insertAfter($(element));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
            $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
            $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
        }
    });
    
    ////////////////////////////////////////////////////////este es para los formularios de edicion
    
     
    
    
    
});