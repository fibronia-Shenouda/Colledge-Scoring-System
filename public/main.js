document.addEventListener("DOMContentLoaded", function () {
    // Events array
    var events = [];
    // Get all add generated buttons
    var buttons = document.querySelectorAll(".btn-add");
    // Events details page
    var countElement = document.getElementById("count");
    // Join competition button
    var join = document.getElementById("join");

    // Add events in details page
    buttons.forEach(function (button) {
        button.addEventListener("click", function () {
            var selectedBtn = this;
            var btnId = selectedBtn.id;
            var isSelected = selectedBtn.classList.contains("selected");

            // Toggle selection state
            if (!isSelected) {
                selectedBtn.classList.add("selected");
                events.push(btnId);
                updateCount(1); // Increment count
            } else {
                selectedBtn.classList.remove("selected");
                let elementToRemove = btnId; // Element value you want to remove
                events = events.filter((item) => item !== elementToRemove);
                updateCount(-1); // Decrement count
            }
        });
    });

    // Update the events number in details page
    function updateCount(change) {
        var count = parseInt(countElement.textContent) + change;
        countElement.textContent = count >= 0 ? count : 0;
        join.onclick = function () {
            document.getElementById("counterValue").value = count;
            document.getElementById("events").value = events.join(",");
        };
    }
});
