(() => {
  //   const specializationOptions = Array.from(
  //     document.querySelectorAll("#specialization option")
  //   );
  //   const specializations = specializationOptions.map((option) => option.value);

  //   console.log(specializations);

  const specializationElement = document.querySelector("#specialization");
  const dateElement = document.querySelector("#date"); // TODO: handle onChange here as well!
  specializationElement.addEventListener("change", (e) =>
    handleSpecializationChange(e.currentTarget)
  );

  async function handleSpecializationChange(e) {
    const { value } = e;
    const { value: date } = dateElement;

    const { error } = validateDate(date);
    if (error) {
      return alert(error); // TODO: implement flash message :D
    }

    try {
      const res = await fetch(
        `/dabs/api/doctors.php?specialization=${value}&date=${date}`
      );
      const doctors = await res.json();

      populateDoctorSelection(doctors);
    } catch (error) {
      console.log(error);
    }
  }

  function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result.toISOString().split("T")[0];
  }

  function validateDate(chosenDate) {
    const today = new Date().toISOString().split("T")[0];

    if (chosenDate.valueOf() < today.valueOf()) {
      return { error: "The appointment date cannot be at the past" };
    }

    const afterSixDays = addDays(today, 6);

    if (chosenDate > afterSixDays) {
      return { error: "The appointment date must be within 6 days from today" };
    }

    return {};
  }

  function populateDoctorSelection(doctors) {
    if (doctors.length === 0) {
      return;
    }

    const doctorSelectionElement = document.querySelector("#doctor");

    const defaultOption = document.querySelector("#doctor option");
    doctorSelectionElement.removeChild(defaultOption);

    doctors.forEach((doctor) => {
      const { doctorId, firstName, middleName, lastName } = doctor;

      const optionElement = document.createElement("option");
      optionElement.setAttribute("value", `${doctorId}`);
      optionElement.setAttribute("class", "capitalize");
      optionElement.innerText = `${firstName} ${middleName} ${lastName}`;

      doctorSelectionElement.appendChild(optionElement);
    });

    doctorSelectionElement.removeAttribute("disabled");
  }
})();
