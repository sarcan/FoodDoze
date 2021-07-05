// AddEventListener Button #send
document.getElementById('contactform').addEventListener('submit', validateForm);

// Formularvalidierung
function validateForm(e) {
    e.preventDefault();

    if (document.querySelector('form span')) {
        document.querySelectorAll('form span').forEach((element) => {
          element.remove();
        });
    }

    let data = {}
    let validationErrors = {}

    data.nachname = document.querySelector("#nachname").value;
    data.vorname = document.querySelector("#vorname").value;
    data.email = document.querySelector("#email").value;
    data.message = document.querySelector("#message").value;
    data.checkbox = document.querySelector("#agree");
    // console.table(data);

    // Validierung Nachname
    if (!data.nachname) {
        validationErrors.nachname = "Bitte gebe hier deinen Nachnamen an."
    } else {
        let nachnameRegExp = /[0-9.!#$%&'+/=?^_`{|}~-]/;
    
        if (nachnameRegExp.test(data.nachname)) {
          console.error('Ungültige Zeichen' + data.nachname);
          validationErrors.nachname =
            'Bitte verwende keine Zahlen oder Sonderzeichen.'
        } else {
          console.info('Nachname: ' + data.nachname)
        }
    }

    // Validierung Vorname
    if (!data.vorname) {
        validationErrors.vorname = "Bitte gebe hier deinen Vornamen an."
    } else {
        let vornameRegExp = /[0-9.!#$%&'+/=?^_`{|}~-]/;
    
        if (vornameRegExp.test(data.vorname)) {
          console.error('Ungültige Zeichen' + data.vorname);
          validationErrors.vorname =
            'Bitte verwende keine Zahlen oder Sonderzeichen.'
        } else {
          console.info('Vorname: ' + data.vorname)
        }
    }

    // Validierung Email
    if (!data.email) {
        console.error('No email' + data.email)
        validationErrors.email = 'Bitte gib eine gültige Email-Adresse an.'
      } else {
        console.info('Email: ' + data.email)
        let emailRegExp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        // Test if email is an email
        if (!emailRegExp.test(data.email)) {
          // email is not a match
          validationErrors.email = 'Bitte verwende keine Zahlen oder Sonderzeichen.'
        } else {
          console.info('Email is valid')
        }
    }

    // Validierung Nachricht
    if (!data.message) {
        console.error('Keine Nachricht' + data.message)
        validationErrors.message = 'Bitte gib hier deine Nachricht an.'
      } else {
        console.info('Nachricht:' + data.message)
        if (data.message.length < 10) {
          validationErrors.message = 'Nicht genügend Zeichen (mindestens 10 Zeichen).'
        } else {
          console.info('Nachricht hat genügend Zeichen')
        }
    }

    // Validierung Checkbox
    if (checkbox.checked == false) {
        console.error('Bitte akzeptiere unsere AGBs.')
        validationErrors.checkbox = 'Bitte akzeptiere unsere AGBs.'
    } else {
        console.info('Der Nutzer hat die Datenschutz- und Nutzungsbedingungen akzeptiert')
    }

    // If there are errors
    if (Object.keys(validationErrors).length > 0) {
        // Display Error messages
        displayErrors(validationErrors)
    } else {
        // Send Form to backend
        console.log('sending form data')
        e.target.submit();
    }
}

// Fehlermeldungen
function displayErrors(validationErrors) {
    // Nachname
    if (validationErrors.nachname) {
      const errorContainer = document.createElement('span')
      errorContainer.innerHTML = validationErrors.nachname
      document.querySelector('#nachname').before(errorContainer)
    }

    // Vorname
    if (validationErrors.vorname) {
      const errorContainer = document.createElement('span')
      errorContainer.innerHTML = validationErrors.vorname
      document.querySelector('#vorname').before(errorContainer)
    }
  
    // Email
    if (validationErrors.email) {
      const errorContainer = document.createElement('span')
      errorContainer.innerHTML = validationErrors.email
      document.querySelector('#email').before(errorContainer)
    }

    // Nachricht
    if (validationErrors.message) {
      const errorContainer = document.createElement('span')
      errorContainer.innerHTML = validationErrors.message
      document.querySelector('textarea').before(errorContainer)
    }
  
    // Checkbox
    if (validationErrors.checkbox) {
      const errorContainer = document.createElement('span')
      errorContainer.innerHTML = validationErrors.checkbox
      document.querySelector('#agree').before(errorContainer)
    }
}