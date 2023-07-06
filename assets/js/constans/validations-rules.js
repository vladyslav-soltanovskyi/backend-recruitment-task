export const validationRules = {
  firstName: {
    regex: /\w+/,
    message: 'First Name is required!'
  },
  lastName: {
    regex: /\w+/,
    message: 'Last Name is required!'
  },
  username: {
    regex: /\w+/,
    message: 'Username Name is required!'
  },
  email: {
    regex: /\S+@\S+\.\S+/,
    message: 'Email is invalid!'
  },
  street: {
    regex: /\w+/,
    message: 'Street is required!'
  },
  zipcode: {
    regex: /^[0-9]{5}(?:-[0-9]{4})?$/,
    message: 'Zip Code is invalid!'
  },
  city: {
    regex: /\w+/,
    message: 'First Name is required!'
  },
  phone: {
    regex: /^(?:\+?1[-. ]?)?\(?([2-9][0-8][0-9])\)?[-. ]?([2-9][0-9]{2})[-. ]?([0-9]{4})$/,
    message: 'Phone is invalid!'
  },
  extension: {
    regex: /^(x\d{0,6})?$/,
    message: 'Extension is invalid!'
  },
  companyName: {
    regex: /\w+/,
    message: 'Company Name is required!'
  },
};