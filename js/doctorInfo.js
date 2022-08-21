(() => {
  const specializationElement = document.querySelector("#specialization");
  const dateElement = document.querySelector("#date");
  const doctorElement = document.querySelector("#doctor");
  const slotSelectionElement = document.querySelector("#slot");
  const reasonElement = document.querySelector("#reason");

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

  async function handleDateChange(dateElement){ 
    const { value: date } = dateElement;

    const { error } = validateDate(date);
    if (error) {
      return alert(error); // TODO: implement flash message :D
    }

    const { value:doctorId } = doctorElement;

    try {
      const res = await fetch(
        `/dabs/api/timeSlots.php?doctorId=${doctorId}&date=${date}`
      );
      const timeSlots = await res.json();
      console.log(timeSlots);
      populateTimeSlots(timeSlots);

    } catch (error) {
      console.log(error);
    }
   }

  function populateDoctorSelection(doctors) {
    if (doctors.length === 0) {
      return;
    }

    const doctorSelectionElement = document.querySelector("#doctor");

    // const defaultOption = document.querySelector("#doctor option");
    // doctorSelectionElement.removeChild(defaultOption);

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

  function populateTimeSlots({availableSlots}) {
    if (availableSlots.length === 0) {
      return;
    }

    const slotSelectionElement = document.querySelector("#slot");

    // const defaultOption = document.querySelector("#slot option");
    // slotSelectionElement.removeChild(defaultOption);

    availableSlots.forEach((slot) => {
      const optionElement = document.createElement("option"); 
      optionElement.setAttribute("value", `${slot}`);
      optionElement.innerText = `${slot}`;

      slotSelectionElement.appendChild(optionElement);
    });

    slotSelectionElement.removeAttribute("disabled");
  }
  
  slotSelectionElement.addEventListener('change', async e=>{
    reasonElement.removeAttribute("disabled");    
  })
})();

