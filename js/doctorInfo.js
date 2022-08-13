(() => {
  const specializationElement = document.querySelector("#specialization");
  const dateElement = document.querySelector("#date"); // TODO: handle onChange here as well!
  const doctorElement = document.querySelector("#doctor");

  specializationElement.addEventListener("change", (e) =>
    handleSpecializationChange(e.currentTarget) 
  );

dateElement.addEventListener("change", e => 
  handleDateChange(e.currentTarget)
);

  async function handleSpecializationChange(specializationElement) {
    const { value } = specializationElement;

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

  function handleDateChange(dateElement){ 
    const { value: date } = dateElement;

    const { error } = validateDate(date);
    if (error) {
      return alert(error); // TODO: implement flash message :D
    }
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

  doctorElement.addEventListener('change', async e=>{
    const { value:doctorId } = e;

    try {
      const res = await fetch(
        `/dabs/api/timeSlots.php?doctorId=${doctorId}`
      );
      const timeSlots = await res.json();
      console.log(timeSlots);

    } catch (error) {
      console.log(error);
    }
  })
})();

