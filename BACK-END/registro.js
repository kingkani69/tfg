$(document).ready(function() {
    $('#miFormulario').on('submit', function(event) {
        event.preventDefault(); // Evita el envío tradicional

        var formData = {
            Nombre: $('#Nombre').val(),
            Direccion: $('#Direccion').val(),
            Telefono: $('#Telefono').val(),
            Correo_Electronico: $('#Correo_Electronico').val(),
            Password: $('#Password').val() // Incluimos la contraseña
        };

        $.ajax({
            type: 'POST',
            url: 'registro.php',
            data: formData, // Enviamos como datos de formulario normales
            dataType: 'json',
            success: function(response) {
                $('#resultado').text(response.message);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                $('#resultado').text('Error en el registro');
            }
        });
    });
});

