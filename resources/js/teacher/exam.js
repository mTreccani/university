const startDate = document.getElementById("start_date");
const endDate = document.getElementById("end_date");
const date = document.getElementById("date");

setMinDate(startDate.value, endDate);
setMinDate(endDate.value, date, 16);

startDate.addEventListener("change", function() {
    setMinDate(startDate.value, endDate);
});

endDate.addEventListener("change", function() {
    setMinDate(endDate.value, date, 16);
});

function setMinDate(date, dateToSet, slice = 10) {
    if (!date) {
        return;
    }
    const minDate = new Date(date);
    minDate.setDate(minDate.getDate() + 1);
    dateToSet.min = minDate.toISOString().slice(0, slice);
}
