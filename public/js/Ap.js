console.log('CraveBite loaded');

// ======================================
// Food Delivery Admin Panel
// ======================================

document.addEventListener("DOMContentLoaded", function () {

    const addFoodBtn = document.getElementById("addFoodBtn");
    const foodModal = document.getElementById("foodModal");
    const closeModal = document.getElementById("closeModal");
    const cancelBtn = document.getElementById("cancelBtn");

    // Open Modal
    if (addFoodBtn) {
        addFoodBtn.addEventListener("click", function () {
            foodModal.classList.add("show");
            document.body.style.overflow = "hidden";
        });
    }

    // Close Modal (X Button)
    if (closeModal) {
        closeModal.addEventListener("click", function () {
            closePopup();
        });
    }

    // Close Modal (Cancel Button)
    if (cancelBtn) {
        cancelBtn.addEventListener("click", function () {
            closePopup();
        });
    }

    // Click Outside Modal
    window.addEventListener("click", function (e) {

        if (e.target === foodModal) {
            closePopup();
        }

    });

    // ESC Key
    document.addEventListener("keydown", function (e) {

        if (e.key === "Escape") {
            closePopup();
        }

    });

    // Close Function
    function closePopup() {

        foodModal.classList.remove("show");
        document.body.style.overflow = "auto";

    }

});



document.addEventListener("DOMContentLoaded", function () {


    /* =====================================================
       ELEMENTS
    ====================================================== */

    const modal =
        document.getElementById("foodModal");

    const addFoodBtn =
        document.getElementById("addFoodBtn");

    const closeModal =
        document.getElementById("closeModal");

    const cancelBtn =
        document.getElementById("cancelBtn");

    const foodForm =
        document.getElementById("foodForm");

    const modalTitle =
        document.getElementById("modalTitle");

    const modalSubtitle =
        document.getElementById("modalSubtitle");

    const saveFoodBtn =
        document.getElementById("saveFoodBtn");

    const editingRow =
        document.getElementById("editingRow");

    const foodName =
        document.getElementById("foodName");

    const foodCategory =
        document.getElementById("foodCategory");

    const foodPrice =
        document.getElementById("foodPrice");

    const foodDescription =
        document.getElementById("foodDescription");

    const foodImage =
        document.getElementById("foodImage");

    const imagePreview =
        document.getElementById("imagePreview");

    const uploadContent =
        document.getElementById("uploadContent");

    const uploadBox =
        document.getElementById("uploadBox");

    const toast =
        document.getElementById("toast");

    const toastMessage =
        document.getElementById("toastMessage");

    const searchInput =
        document.getElementById("searchInput");


    /* =====================================================
       OPEN MODAL
    ====================================================== */

    function openModal() {

        modal.classList.add("show");

        document.body.style.overflow = "hidden";

    }


    /* =====================================================
       CLOSE MODAL
    ====================================================== */

    function hideModal() {

        modal.classList.remove("show");

        document.body.style.overflow = "";

    }


    /* =====================================================
       ADD FOOD
    ====================================================== */

    addFoodBtn.addEventListener(
        "click",
        function () {

            resetForm();

            modalTitle.textContent =
                "Add New Food Item";

            modalSubtitle.textContent =
                "Add a new item to your restaurant menu.";

            saveFoodBtn.innerHTML =
                '<i class="fa-solid fa-check"></i> Save Food Item';

            editingRow.value = "";

            openModal();

            setTimeout(function () {
                foodName.focus();
            }, 200);

        }
    );


    /* =====================================================
       EDIT FOOD
    ====================================================== */

    document
        .querySelectorAll(".edit-food")
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function () {

                    const row =
                        button.closest(".food-row");


                    /* Get existing values */

                    const name =
                        row.dataset.name;

                    const category =
                        row.dataset.category;

                    const price =
                        row.dataset.price;

                    const status =
                        row.dataset.status;

                    const description =
                        row.dataset.description;

                    const image =
                        row.dataset.image;


                    /* Put values inside form */

                    foodName.value =
                        name;

                    foodCategory.value =
                        category;

                    foodPrice.value =
                        price;

                    foodDescription.value =
                        description;


                    /* Availability */

                    const radio =
                        document.querySelector(
                            `input[name="status"][value="${status}"]`
                        );

                    if (radio) {
                        radio.checked = true;
                    }


                    /* Existing image */

                    if (image) {

                        imagePreview.src =
                            image;

                        imagePreview.style.display =
                            "block";

                        uploadContent.style.display =
                            "none";

                    }


                    /* Save row reference */

                    editingRow.value =
                        Array.from(
                            document.querySelectorAll(
                                ".food-row"
                            )
                        ).indexOf(row);


                    /* Change modal */

                    modalTitle.textContent =
                        "Edit Food Item";

                    modalSubtitle.textContent =
                        "Update the selected food item.";

                    saveFoodBtn.innerHTML =
                        '<i class="fa-solid fa-check"></i> Update Food Item';


                    openModal();

                }
            );

        });


    /* =====================================================
       SAVE / UPDATE FOOD
    ====================================================== */

    foodForm.addEventListener(
        "submit",
        function (event) {

            event.preventDefault();


            /* Get values */

            const name =
                foodName.value.trim();

            const category =
                foodCategory.value;

            const price =
                foodPrice.value;

            const description =
                foodDescription.value.trim();

            const status =
                document.querySelector(
                    'input[name="status"]:checked'
                ).value;


            /* Validation */

            if (name === "") {

                alert(
                    "Please enter food name."
                );

                return;

            }


            if (category === "") {

                alert(
                    "Please select category."
                );

                return;

            }


            if (price === "" || Number(price) < 0) {

                alert(
                    "Please enter a valid price."
                );

                return;

            }


            /* =================================================
               EDIT EXISTING ROW
            ================================================== */

            if (editingRow.value !== "") {

                const rows =
                    document.querySelectorAll(
                        ".food-row"
                    );

                const row =
                    rows[
                        Number(editingRow.value)
                    ];


                /* Update data */

                row.dataset.name =
                    name;

                row.dataset.category =
                    category;

                row.dataset.price =
                    price;

                row.dataset.status =
                    status;

                row.dataset.description =
                    description;


                /* Update table */

                const cells =
                    row.querySelectorAll("td");


                /* Food name */

                cells[0]
                    .querySelector("strong")
                    .textContent = name;


                /* Food description */

                cells[0]
                    .querySelector("small")
                    .textContent =
                    description ||
                    "Food item";


                /* Category */

                cells[1].textContent =
                    category;


                /* Price */

                cells[2].textContent =
                    "$" +
                    Number(price)
                        .toFixed(2);


                /* Status */

                const statusElement =
                    cells[3]
                        .querySelector(".status");


                statusElement.textContent =
                    status;

                statusElement.className =
                    "status " +
                    (
                        status === "Available"
                            ? "available"
                            : "unavailable"
                    );


                /* New image */

                if (
                    imagePreview.style.display !==
                    "none" &&
                    imagePreview.src
                ) {

                    const image =
                        row.querySelector(
                            ".food-info img"
                        );

                    image.src =
                        imagePreview.src;

                    row.dataset.image =
                        imagePreview.src;

                }


                showToast(
                    "Food item updated successfully."
                );

            }


            /* =================================================
               ADD NEW ROW
            ================================================== */

            else {

                const tbody =
                    document.getElementById(
                        "foodTableBody"
                    );


                const row =
                    document.createElement("tr");


                row.className =
                    "food-row";


                let image =
                    "{{ asset('food/default.jpg') }}";


                if (
                    imagePreview.src &&
                    imagePreview.style.display !==
                    "none"
                ) {

                    image =
                        imagePreview.src;

                }


                row.dataset.name =
                    name;

                row.dataset.category =
                    category;

                row.dataset.price =
                    price;

                row.dataset.status =
                    status;

                row.dataset.description =
                    description;

                row.dataset.image =
                    image;


                row.innerHTML = `

                    <td>

                        <div class="food-info">

                            <img
                                src="${image}"
                                alt="${name}"
                            >

                            <div>

                                <strong>
                                    ${name}
                                </strong>

                                <small>
                                    ${description || "Food item"}
                                </small>

                            </div>

                        </div>

                    </td>


                    <td>
                        ${category}
                    </td>


                    <td>
                        $${Number(price).toFixed(2)}
                    </td>


                    <td>

                        <span class="status ${
                            status === "Available"
                                ? "available"
                                : "unavailable"
                        }">

                            ${status}

                        </span>

                    </td>


                    <td>

                        <div class="action-buttons">

                            <button
                                type="button"
                                class="edit-food"
                                title="Edit">

                                <i class="fa-solid fa-pen"></i>

                            </button>


                            <button
                                type="button"
                                class="delete-food"
                                title="Delete">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </div>

                    </td>

                `;


                tbody.appendChild(row);


                /* Add event listeners */

                addRowEvents(row);


                showToast(
                    "Food item added successfully."
                );

            }


            /* Close */

            hideModal();

            resetForm();

        }
    );


    /* =====================================================
       ADD EVENTS TO NEW ROW
    ====================================================== */

    function addRowEvents(row) {

        const editButton =
            row.querySelector(".edit-food");

        const deleteButton =
            row.querySelector(".delete-food");


        /* Edit */

        editButton.addEventListener(
            "click",
            function () {

                const name =
                    row.dataset.name;

                const category =
                    row.dataset.category;

                const price =
                    row.dataset.price;

                const status =
                    row.dataset.status;

                const description =
                    row.dataset.description;

                const image =
                    row.dataset.image;


                foodName.value =
                    name;

                foodCategory.value =
                    category;

                foodPrice.value =
                    price;

                foodDescription.value =
                    description;


                const radio =
                    document.querySelector(
                        `input[name="status"][value="${status}"]`
                    );

                if (radio) {
                    radio.checked = true;
                }


                if (image) {

                    imagePreview.src =
                        image;

                    imagePreview.style.display =
                        "block";

                    uploadContent.style.display =
                        "none";

                }


                const rows =
                    Array.from(
                        document.querySelectorAll(
                            ".food-row"
                        )
                    );

                editingRow.value =
                    rows.indexOf(row);


                modalTitle.textContent =
                    "Edit Food Item";

                modalSubtitle.textContent =
                    "Update the selected food item.";

                saveFoodBtn.innerHTML =
                    '<i class="fa-solid fa-check"></i> Update Food Item';


                openModal();

            }
        );


        /* Delete */

        deleteButton.addEventListener(
            "click",
            function () {

                const name =
                    row.dataset.name;


                const confirmDelete =
                    confirm(
                        `Are you sure you want to delete "${name}"?`
                    );


                if (!confirmDelete) {
                    return;
                }


                row.remove();


                updateFoodCount();


                showToast(
                    "Food item deleted successfully."
                );

            }
        );

    }


    /* =====================================================
       DELETE EXISTING ITEMS
    ====================================================== */

    document
        .querySelectorAll(".delete-food")
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function () {

                    const row =
                        button.closest(".food-row");

                    const name =
                        row.dataset.name;


                    const confirmDelete =
                        confirm(
                            `Are you sure you want to delete "${name}"?`
                        );


                    if (!confirmDelete) {
                        return;
                    }


                    row.remove();


                    updateFoodCount();


                    showToast(
                        "Food item deleted successfully."
                    );

                }
            );

        });


    /* =====================================================
       IMAGE PREVIEW
    ====================================================== */

    foodImage.addEventListener(
        "change",
        function () {

            const file =
                this.files[0];


            if (!file) {
                return;
            }


            /* Maximum 2MB */

            if (
                file.size >
                2 * 1024 * 1024
            ) {

                alert(
                    "Image must be less than 2MB."
                );

                this.value = "";

                return;

            }


            /* Check image */

            if (
                !file.type.startsWith("image/")
            ) {

                alert(
                    "Please select an image file."
                );

                this.value = "";

                return;

            }


            const reader =
                new FileReader();


            reader.onload =
                function (event) {

                    imagePreview.src =
                        event.target.result;

                    imagePreview.style.display =
                        "block";

                    uploadContent.style.display =
                        "none";

                };


            reader.readAsDataURL(file);

        }
    );


    /* =====================================================
       CLOSE
    ====================================================== */

    closeModal.addEventListener(
        "click",
        hideModal
    );


    cancelBtn.addEventListener(
        "click",
        hideModal
    );


    /* Click outside */

    modal.addEventListener(
        "click",
        function (event) {

            if (
                event.target === modal
            ) {

                hideModal();

            }

        }
    );


    /* Escape */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                modal.classList.contains("show")
            ) {

                hideModal();

            }

        }
    );


    /* =====================================================
       RESET FORM
    ====================================================== */

    function resetForm() {

        foodForm.reset();

        editingRow.value = "";

        imagePreview.src = "";

        imagePreview.style.display =
            "none";

        uploadContent.style.display =
            "block";

        document.querySelector(
            'input[name="status"][value="Available"]'
        ).checked = true;

    }


    /* =====================================================
       SEARCH
    ====================================================== */

    searchInput.addEventListener(
        "input",
        function () {

            const search =
                this.value
                    .toLowerCase()
                    .trim();


            const rows =
                document.querySelectorAll(
                    ".food-row"
                );


            rows.forEach(function (row) {

                const name =
                    row.dataset.name
                        .toLowerCase();

                const category =
                    row.dataset.category
                        .toLowerCase();

                const description =
                    row.dataset.description
                        .toLowerCase();


                if (
                    name.includes(search) ||
                    category.includes(search) ||
                    description.includes(search)
                ) {

                    row.style.display = "";

                } else {

                    row.style.display =
                        "none";

                }

            });

        }
    );


    /* =====================================================
       UPDATE FOOD COUNT
    ====================================================== */

    function updateFoodCount() {

        const count =
            document.querySelectorAll(
                ".food-row"
            ).length;

        document.getElementById(
            "foodCount"
        ).textContent = count;

    }


    /* =====================================================
       TOAST
    ====================================================== */

    function showToast(message) {

        toastMessage.textContent =
            message;

        toast.classList.add("show");


        setTimeout(function () {

            toast.classList.remove("show");

        }, 3000);

    }

});