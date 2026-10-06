const form = document.querySelector('form');
const email = document.getElementById('email');
const emailConfirmation = document.getElementById('email_confirmation');
const dateBirth = document.getElementById('date_birth');
const password = document.getElementById('user_password');
const passwordConfirmation = document.getElementById('user_password_confirmation');

function formValidation(event) {
    let isValid = true;

    document.querySelectorAll('.error-message').forEach(span => span.textContent = '');

    if (email.value !== emailConfirmation.value) {
        document.getElementById('email-confirmation-error').textContent = 'Os e-mails não são iguais!';
        isValid = false;
    }

    if (dateBirth.value) {
        const birthDate = new Date(dateBirth.value + 'T00:00:00');
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if ((year - birthYear) >= 100) {
            document.getElementById('date_birth-error').textContent = 'A idade precisa ser menor que 100 anos!';
            isValid = false;
        }
    }

    if (password.value.length < 6) {
        document.getElementById('password-error').textContent = 'A senha tem que ter no mínimo 6 caracteres!';
        isValid = false;
    }

    if (password.value !== passwordConfirmation.value) {
        document.getElementById('password-confirmation-error').textContent = 'As senhas não estão iguais!';
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
}

form.addEventListener('submit', formValidation);