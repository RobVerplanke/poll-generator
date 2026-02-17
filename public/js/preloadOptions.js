// Min. amount of option inputfields shown
const PRELOAD_OPTIONS = 3;

// Max. amount of option inputfields allowed to add
const MAX_OPTIONS = 6;

// Remove poll option from form
function removePollOption() {
  console.log('Clicked remove');
}

// If needed, add an extra poll option on the create page
function addPollOptions() {
  // Select the options container and count the amount of inputfields
  let pollOptionsContainer = document.querySelector('.form-option-container');
  let CurrentAmountOfOptions = pollOptionsContainer.childElementCount + 1;

  // As long as the amount of inputfields is below the maximum
  if (CurrentAmountOfOptions < MAX_OPTIONS + 1) {
    // Create new option
    let newOption = document.createElement('div');
    newOption.setAttribute('id', `form-option${CurrentAmountOfOptions}`);

    // Fill new option with a label and an inputfield
    newOption.innerHTML = `
      <label for="options${CurrentAmountOfOptions}">Option ${CurrentAmountOfOptions}</label>
      <input type="text" name="options[]" id="option${CurrentAmountOfOptions}" placeholder="Poll option...">
      <button type="button" class="btn removePollBtn"> - </button>
      `;

    // Add new option to the form
    pollOptionsContainer.appendChild(newOption);

    newOption.addEventListener('click', removePollOption());
  }
}

// Preload input fields on the create page
function preloadPollOptions() {
  // Select the target div container
  let pollOptionsContainer = document.querySelector('.form-option-container');

  // Create a new label and inputfield
  for (let i = 0; i < PRELOAD_OPTIONS; i++) {
    let newOption = document.createElement('div');

    // Template for new option field
    newOption.innerHTML = `
          <label for="options${i + 1} ">Option ${i + 1}</label>
          <input type="text" name="options[]" id="option${i + 1}" placeholder="Poll option...">
        `;

    // Add new inputfield to the form
    pollOptionsContainer.appendChild(newOption);
  }
}

// Execute on load
preloadPollOptions();
