document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("login.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Inicio de sesión exitoso");
            window.location.href = "registro.html"; // Redirige a la página de inicio
        } else {
            alert(data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});
