
  function toggleDocumentSides(value) {
    const cedulaFields = document.getElementById('cedula-fields');
    const passportField = document.getElementById('pasaporte-field');

    if (value === 'cedula') {
      cedulaFields.style.display = 'flex';
      passportField.style.display = 'none';
    } else if (value === 'pasaporte') {
      cedulaFields.style.display = 'none';
      passportField.style.display = 'flex';
    } else {
      cedulaFields.style.display = 'none';
      passportField.style.display = 'none';
    }
  }

document.getElementById("start-verification").addEventListener("click", function(){
  document.getElementById("verification-container").style.display = "none"
  document.getElementById("verification-form-container").style.display = "flex"
})

document.getElementById("back-to-profile").addEventListener("click",function(){
  window.location.href = "./index.php"
})
