
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

