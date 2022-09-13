<?php
include('../includes/header.php');
?>
</head>

<body>
  <main class="wrapper signup">
    <form name="patientSignupForm" class="patientSignupForm">

      <h2 class="signupTitle">Sign Up</h2>

      <div class="fields multiStepForm">
        <div class="steps">
          <div data-step="one">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" value="Hari" required />
            <small class="message" data-message=""></small>

            <label for="middleName">Middle Name</label>
            <input type="text" id="middleName" name="middleName" value="Prasad" />
            <small class="message" data-message=""></small>

            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" value="Bastola" required />
            <small class="message" data-message=""></small>
          </div>

          <div data-step="two">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="others">Others</option>
            </select>
            <small class="message" data-message=""></small>

            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" />
            <small class="message" data-message=""></small>

            <label for="bloodGroup">Blood Group</label>
            <select name="bloodGroup" id="bloodGroup">
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
            </select>
            <small class="message" data-message=""></small>

            <label for="maritalStatus">Marital Status</label>
            <select name="maritalStatus" id="maritalStatus">
              <option value="single">single</option>
              <option value="married">married</option>
              <option value="divorced">divorced</option>
            </select>
            <small class="message" data-message=""></small>
          </div>

          <div data-step="three">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="name@domain.com" required>
            <small class="message" data-message=""></small>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="password" required />
            <small class="message" data-message=""></small>
          </div>

          <div data-step="four">
            <label for="address">Address</label>
            <input type="address" id="address" name="address" value="Biratnagar" required>
            <small class="message" data-message=""></small>

            <label for="telephone">Telephone</label>
            <input type="tel" id="telephone" name="telephone" value="telephone" required />
            <small class="message" data-message=""></small>
          </div>
        </div>

        <!-- <button data-button-action="previous">Previous</button>
                        <button data-button-action="next">Next</button> -->

        <!-- <input type="submit" name="patientSignupDetails" value="Sign Up" /> -->
        <button type="submit">Sign Up</button>
      </div>
    </form>
  </main>
  <script>
    const form = document.querySelector("[name=patientSignupForm]");

    form.addEventListener("submit", async e => {
      e.preventDefault();
      const {
        firstName,
        middleName,
        lastName,
        gender,
        dob,
        bloodGroup,
        maritalStatus,
        email,
        password,
        address,
        telephone
      } = form;

      const formFields = {
        firstName,
        middleName,
        lastName,
        gender,
        dob,
        bloodGroup,
        maritalStatus,
        email,
        password,
        address,
        telephone
      }

      const data = {};

      for (const key in formFields) {
        data[key] = formFields[key].value;
      }

      const res = await fetch("/dabs/api/patientSignupValidation.php", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });
      const responseData = await res.json();
      const {
        errors
      } = responseData; // destructuring "errors" JSON response from the server

      // show error message underneath the respective field
      for (const key in errors) {
        // select the corresponding sibling [data-message] element
        const messageElement = document.querySelector(`[name="${key}"] + [data-message]`);
        messageElement.dataset.message = errors[key];
        messageElement.classList.add("shake");

        // remove the error message when user starts to change the value
        const errorMessageField = document.querySelector(`[name="${key}"]`);
        errorMessageField.addEventListener('click', removeErrorMessage);

        function removeErrorMessage(e) {
          messageElement.dataset.message = "";
          messageElement.classList.remove("shake");
        }
      }
    })
  </script>
</body>

</html>