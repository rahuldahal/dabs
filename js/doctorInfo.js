(() => {
  //   const specializationOptions = Array.from(
  //     document.querySelectorAll("#specialization option")
  //   );
  //   const specializations = specializationOptions.map((option) => option.value);

  //   console.log(specializations);

  const specializationElement = document.querySelector("#specialization");
  specializationElement.addEventListener("change", (e) =>
    handleSpecializationChange(e.currentTarget)
  );

  async function handleSpecializationChange(e) {
    const { value } = e;

    try {
      const res = await fetch(`/dabs/api/doctors.php?specialization=${value}`);
      const doctors = await res.json();

      populateDoctorSelection(doctors);
    } catch (error) {
      console.log(error);
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
})();
