// Min. amount of option inputfields shown
const PRELOAD_OPTIONS = 2;

// Max. amount of option inputfields allowed to add
const MAX_OPTIONS = 6;

// Keeps track of the amount of poll options on the page
let optionCounter = PRELOAD_OPTIONS;

// Remove poll option from form
function removePollOption(event) {
  event.target.parentElement.remove();
}

// If needed, add an extra poll option on the create page
function addPollOptions(option, showRemoveBtn = true) {
  // Select the options container and count the amount of inputfields
  let pollOptionsContainer = document.querySelector('.form-option-container');
  let CurrentAmountOfOptions = pollOptionsContainer.childElementCount + 1;

  // As long as the amount of inputfields is below the maximum
  if (CurrentAmountOfOptions < MAX_OPTIONS + 1) {
    // Update options counter
    optionCounter++;

    // Create new input line (contains a label, inputfield, and a substract button)
    let newOption = document.createElement('div');
    newOption.setAttribute('id', `form-option${CurrentAmountOfOptions}`);

    // Fill new option with a label and an inputfield
    newOption.innerHTML = `
      <label for="options${optionCounter}">Option</label>
      <input type="text" name="options[]" id="option${optionCounter}" value="${option || ''}" placeholder="Poll option...">
    `;

    // Create new substract button, only for addidional options
    if (showRemoveBtn) {
      let substractBtn = document.createElement('button');
      substractBtn.setAttribute('class', 'btn');
      substractBtn.setAttribute('type', 'button');
      substractBtn.innerHTML = '-';
      newOption.appendChild(substractBtn);

      // Remove input line after clicking on the substract button
      substractBtn.addEventListener('click', removePollOption);
    }

    // Add new input line to the form
    pollOptionsContainer.appendChild(newOption);
  }
}

// Preload input fields on the create page
function preloadPollOptions() {
  const oldOptions = window.oldOptions || [];

  if (oldOptions.length > 0) {
    // Load all old option values
    oldOptions.forEach((option) => {
      addPollOptions(option, false);
    });
  } else {
    // Add empty input fields
    for (let i = 0; i < PRELOAD_OPTIONS; i++) {
      addPollOptions('', false);
    }
  }
}

// Execute on load
preloadPollOptions();
