/**
 * Checks if the length of a string is greater than a specified minimum length.
 * @param {string} string - The string to check the length of.
 * @param {number} minLength - The minimum length the string should have.
 * @returns {boolean} - Returns true if the trimmed string's length is greater than the specified number, false otherwise.
 */
export function isStringLengthGreaterThan(string, minLength) {
  return string.trim().length >= minLength;
}

/**
 * Tests a string against a regular expression.
 *
 * @param {RegExp} regEx - The regular expression to test against.
 * @param {string} str - The string to be tested.
 * @returns {boolean} - Returns `true` if the string matches the regular expression, otherwise `false`.
 * @throws {TypeError} - Throws a TypeError if the first argument is not a RegExp or the second argument is not a string.
 */
export function isStringMatchRegEx(regEx, str) {
  if (!(regEx instanceof RegExp)) {
    throw new TypeError("The first argument must be a regular expression.");
  }
  if (typeof str !== "string") {
    throw new TypeError("The second argument must be a string.");
  }
  return regEx.test(str);
}

/**
 * Updates the appearance of an input field and manages the display of a message.
 * 
 * This function modifies the outline of the specified input field, sets the display 
 * and color properties of a message container, and updates the text content of the message.
 * 
 * @param {HTMLInputElement} field - The input field to be styled.
 * @param {string} displayProperty - The CSS display property for the message container (e.g., 'block' or 'none').
 * @param {HTMLElement} messageTextContainer - The container element for the message text.
 * @param {string} message - The message to be displayed in the container.
 * @param {string} [color='black'] - The color of the message text. Defaults to 'black'.
 * @param {string} [outline='none'] - The CSS outline property for the input field. Defaults to 'none'.
 */
export function controlField(
  field,
  displayProperty,
  messageTextContainer,
  message,
  color = "black",
  outline = "none"
) {
  field.style.outline = outline;
  messageTextContainer.style.color = color;
  messageTextContainer.style.display = displayProperty;
  messageTextContainer.textContent = message;
}


/**
 * ensure password length is greather or equale to 5 ans password and confirm passwod match
 * @param {Array<HTMLInputElement>} passwordInputsFields - passwords inputs
 * @returns {boolean} return true if both of two conditions are true
 */
export function passwordsFieldValid(passwordInputsFields) {
  // check if password length is greather or equal to 5
  const areAllFieldsValid = passwordInputsFields.every(field => isStringLengthGreaterThan(field.value, 5));

  // check if passwords match
  const arePasswordsIdentical = passwordInputsFields[0].value === passwordInputsFields[1].value;

  return areAllFieldsValid && arePasswordsIdentical;
}

/**
 * 
 * @param {Array<HTMLInputElement>} fullNameAndAdress - firstname, lastname and address
 * @returns {boolean} return true if firstname, lastname and address are all field and the length is greather or eqaul to the minimum length
 */
export function fullNameAndAdressValid(fullNameAndAdress) {
  return fullNameAndAdress.every(field => {
    const minLength = parseInt(field.getAttribute("data-minLength"), 10);
    return isStringLengthGreaterThan(field.value, minLength);
  });
}

