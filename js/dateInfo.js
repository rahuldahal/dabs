(() => {

  const doctorElement = document.querySelector("#doctor");
  doctorElement.addEventListener("change", (e) =>
    handleDoctorChange(e.currentTarget) 
  );

  async function handleDoctorChange(e) {
    const { value } = e;
    console.log(value);
    try {
      const res = await fetch(`/dabs/api/date.php?doctorId=${value}`);
      const dates = await res.json();

      // populateDateSelection(dates);
    } catch (error) {
      console.log(error);
    }
  }

  // function populateDateSelection(dates) {
  //   if (dates.length === 0) {
  //     return;
  //   }

  //   const dateSelectionElement = document.querySelector("#date");

  //   const defaultOption = document.querySelector("#date option");
  //   dateSelectionElement.removeChild(defaultOption);

  //   dates.forEach((date) => {
  //     const {date} = date;

  //     const optionElement = document.createElement("option");
  //     optionElement.setAttribute("value", `${date}`);
  //     optionElement.innerText = `${date}`;

  //     dateSelectionElement.appendChild(optionElement);
  //   });

  //   dateSelectionElement.removeAttribute("disabled");
  // }
})();
