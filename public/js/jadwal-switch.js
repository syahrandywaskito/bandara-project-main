const headerJadwal = document.querySelector("#header-jadwal");
const departure = document.querySelector("#jadwal-departure");
const arrival = document.querySelector("#jadwal-arrival");
const btnDeparture = document.querySelector("#btn-departure");
const btnArrival = document.querySelector("#btn-arrival");

btnDeparture.addEventListener("click", function () {
    if (departure.classList.contains("hidden")) {
        departure.classList.remove("hidden");
        arrival.classList.add("hidden");
        headerJadwal.innerHTML = "Departure";
    }
});

btnArrival.addEventListener("click", function () {
    if (arrival.classList.contains("hidden")) {
        arrival.classList.remove("hidden");
        departure.classList.add("hidden");
        headerJadwal.innerHTML = "Arrival";
    }
});
