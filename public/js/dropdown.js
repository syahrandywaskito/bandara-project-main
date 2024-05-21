// * Button
const btnDrHeader = document.querySelector("#btn-dropdown-header");
const btnDrFooter = document.querySelector("#btn-dropdown-footer");

// * Body Dropdown
const drHeader  = document.querySelector("#dropdown-header");
const drFooter  = document.querySelector("#dropdown-footer");

btnDrHeader.addEventListener("click", (e) => {
  drHeader.classList.toggle("hidden");
  e.stopPropagation();
});

document.addEventListener('click', (e) => {
  if (e.target.closest(drHeader)) return;

  drHeader.classList.add('hidden');
});

btnDrFooter.addEventListener("click", function () {
  drFooter.classList.toggle("hidden");
});