document.addEventListener("DOMContentLoaded", function () {
    const table = document.getElementById("usersTable");

    table.addEventListener("click", function (e) {
        if (e.target.classList.contains("toggle-btn")) {
            const button = e.target;
            const id = button.getAttribute("data-id");

            button.disabled = true;

            fetch("toggle.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + encodeURIComponent(id)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.getElementById("row-" + data.id);
                        const statusCell = row.querySelector(".status-cell");
                        statusCell.textContent = data.status;
                    } else {
                        alert("خطأ: " + data.error);
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    alert("حدث خطأ أثناء الاتصال بالسيرفر");
                })
                .finally(() => {
                    button.disabled = false;
                });
        }
    });
});
