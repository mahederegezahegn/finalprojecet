const menuToggle = document.querySelector(".menu-toggle");
const nav = document.querySelector(".nav");

menuToggle.addEventListener("click", () => {
  menuToggle.classList.toggle("menu-open");
  nav.classList.toggle("nav-open");
});


// Intersection Observer API for animations
const boxes = document.querySelectorAll(".box");

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("animate");
    }
  });
});

boxes.forEach((box) => {
  observer.observe(box);
});


const home = document.querySelector(".home");
const images = ["https://example.com/image1.jpg", 
"https://example.com/image2.jpg"];
let index = 0;

setInterval(() => {
  index = (index + 1) % images.length;
  home.classList.add("change-bg");
  setTimeout(() => {
    home.style.backgroundImage = `url('${images[index]}')`;
    home.classList.remove("change-bg");
  }, 500);
}, 5000);












// Get form elements
const usernameInput = document.getElementById("username");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const repeatPasswordInput = document.getElementById("repeatPassword");
const signupButton = document.getElementById("signupButton");

// Get error elements
const usernameError = document.getElementById("usernameError");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");
const repeatPasswordError = document.getElementById("repeatPasswordError");

// Set regex patterns for validation
const usernamePattern = /^[a-zA-Z0-9_-]{4,16}$/;
const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

// Function to check if field is empty
function checkEmpty(field, errorElement, errorMessage) {
  if (field.value.trim() === "") {
    errorElement.innerText = errorMessage;
    return true;
  } else {
    errorElement.innerText = "";
    return false;
  }
}

// Function to check if field matches pattern
function checkPattern(field, errorElement, errorMessage, pattern) {
  if (!pattern.test(field.value)) {
    errorElement.innerText = errorMessage;
    return true;
  } else {
    errorElement.innerText = "";
    return false;
  }
}

// Function to check if passwords match
function checkPasswordsMatch(password, repeatPassword, errorElement, errorMessage) {
  if (password.value !== repeatPassword.value) {
    errorElement.innerText = errorMessage;
    return true;
  } else {
    errorElement.innerText = "";
    return false;
  }
}

// Function to validate form fields and enable/disable button
function validateForm() {
  const isUsernameEmpty = checkEmpty(usernameInput, usernameError, "Username is required");
  const isUsernameInvalid = checkPattern(usernameInput, usernameError, "Username must be 4-16 characters and can only contain letters, numbers, hyphens, and underscores", usernamePattern);
  const isEmailEmpty = checkEmpty(emailInput, emailError, "Email is required");
  const isEmailInvalid = checkPattern(emailInput, emailError, "Invalid email address", emailPattern);
  const isPasswordEmpty = checkEmpty(passwordInput, passwordError, "Password is required");
  const isPasswordInvalid = checkPattern(passwordInput, passwordError, "Password must be at least 8 characters and must contain at least one uppercase letter, one lowercase letter, and one number", passwordPattern);
  const doPasswordsMatch = !checkPasswordsMatch(passwordInput, repeatPasswordInput, repeatPasswordError, "Passwords do not match");

  if (!isUsernameEmpty && !isUsernameInvalid && !isEmailEmpty && !isEmailInvalid && !isPasswordEmpty && !isPasswordInvalid && doPasswordsMatch) {
    signupButton.disabled = false;
  } else {
    signupButton.disabled = true;
  }
}

// Add event listeners to form fields
usernameInput.addEventListener("input", validateForm);
emailInput.addEventListener("input", validateForm);
passwordInput.addEventListener("input", validateForm);
repeatPasswordInput.addEventListener("input", validateForm);





const menutoggle = document.querySelector('.menu-toggle');
const header = document.querySelector('.header');

menutoggle.addEventListener('click', function() {
  header.classList.toggle('menu-open');}
  );




