const approveActionElements = document.querySelectorAll("#updateToApproved");
const declineActionElements = document.querySelectorAll("#updateToDeclined");
const statusElements = document.querySelectorAll("#appointmentStatus");
let target;

let approveArray = Array.from(approveActionElements);
let declineArray = Array.from(declineActionElements);
let statusArray = Array.from(statusElements);

statusArray.forEach(statusElement => {
    target = statusElement.getAttribute('value')
    if(target != "Pending"){
        approveArray.forEach(approveElement => {
            approveElement.setAttribute("disabled", "");
        })
        declineArray.forEach(declineElement => {
            declineElement.setAttribute("disabled", "");            
        })
        console.log(target);
    }
})

// console.log(approveActionElement); 
// console.log(declineActionElement);
// console.log(statusElement); 