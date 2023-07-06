import { validationRules } from './constans/validations-rules.js';
import { http } from './helpers/http.js';

const initCreateUserPage = () => {
  const createUserForm = document.querySelector('.form');
  const inputs = document.querySelectorAll('.text-field__input');
  const btn = document.querySelector('.button');
  const errors = {};

  const checkTextField = (value, fieldName) => {
    const rule = validationRules[fieldName];
    const textField = createUserForm[fieldName];
    const fieldMessage = textField.nextElementSibling;
    
    fieldMessage.textContent = '';
    textField.classList.remove('text-field__input_invalid');
    delete errors[fieldName];

    if (!rule.regex.test(value)) {
      fieldMessage.textContent = rule.message;
      textField.classList.add('text-field__input_invalid');
      errors[fieldName] = rule.message;
    }
  }
  
  const handleInput = (e) => {
    const { value, name } = e.target;
    checkTextField(value, name);
  }

  const handleSubmit = (e) => {
    e.preventDefault();
    const form = e.target;

    const data = Object.fromEntries(
      new FormData(form)
    );

    for (const fieldName in data) {  
      checkTextField(data[fieldName], fieldName);
    }
    
    if (!Object.keys(errors).length) {
      btn.disabled = true;
      
      http.post('/users', data)
        .then(() => form.reset())
        .finally(() => {
          btn.removeAttribute('disabled');
        });
    }
  }
  

  inputs.forEach(input => input.addEventListener('input', handleInput));
  createUserForm.addEventListener('submit', handleSubmit);
}

document.addEventListener('DOMContentLoaded', initCreateUserPage);