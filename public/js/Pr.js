// ==========================================
// GourmetGo Profile Page JavaScript
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    // Buttons
    const editBtn = document.querySelector(".edit-btn");
    const saveBtn = document.querySelector(".save-btn");
    const cancelBtn = document.querySelector(".cancel-btn");

    // Switches
    const switches = document.querySelectorAll(".switch input");    

    // -----------------------------
    // Save Button
    // -----------------------------

    if (saveBtn) {

        saveBtn.addEventListener("click", function () {

            alert("Profile Saved Successfully!");

        });

    }

    // -----------------------------
    // Cancel Button
    // -----------------------------

    if (cancelBtn) {

        cancelBtn.addEventListener("click", function () {

            if(confirm("Cancel all changes?")){

                location.reload();

            }

        });

    }

    // -----------------------------
    // Toggle Switch
    // -----------------------------

    switches.forEach(function(toggle){

        toggle.addEventListener("change", function(){

            if(this.checked){

                console.log("Enabled");

            }else{

                console.log("Disabled");

            }

        });

    });

});


document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const modal = document.getElementById("editModal");

    const openButton =
        document.getElementById("openEditProfile");

    const closeButton =
        document.getElementById("closeEditProfile");

    const cancelButton =
        document.getElementById("modalCancel");

    const form =
        document.getElementById("editProfileForm");

    const profileImageInput =
        document.getElementById("profileImageInput");

    const editProfileImage =
        document.getElementById("editProfileImage");

    const mainProfileImage =
        document.getElementById("mainProfileImage");

    const toast =
        document.getElementById("toast");


    /* =====================================================
       OPEN MODAL
    ===================================================== */

    openButton.addEventListener("click", function () {

        modal.classList.add("show");

        document.body.style.overflow = "hidden";

    });


    /* =====================================================
       CLOSE MODAL
    ===================================================== */

    function closeModal() {

        modal.classList.remove("show");

        document.body.style.overflow = "";

    }


    closeButton.addEventListener(
        "click",
        closeModal
    );

    cancelButton.addEventListener(
        "click",
        closeModal
    );


    /* =====================================================
       CLOSE WHEN CLICKING OUTSIDE
    ===================================================== */

    modal.addEventListener("click", function (event) {

        if (event.target === modal) {

            closeModal();

        }

    });


    /* =====================================================
       ESC KEY
    ===================================================== */

    document.addEventListener("keydown", function (event) {

        if (
            event.key === "Escape" &&
            modal.classList.contains("show")
        ) {

            closeModal();

        }

    });


    /* =====================================================
       PROFILE IMAGE PREVIEW
    ===================================================== */

    profileImageInput.addEventListener(
        "change",
        function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            /* Maximum 2MB */

            if (file.size > 2 * 1024 * 1024) {

                alert(
                    "Profile image must be less than 2MB."
                );

                profileImageInput.value = "";

                return;
            }


            /* Check image */

            if (!file.type.startsWith("image/")) {

                alert(
                    "Please select a valid image."
                );

                profileImageInput.value = "";

                return;
            }


            const reader =
                new FileReader();

            reader.onload = function (e) {

                editProfileImage.src =
                    e.target.result;

            };

            reader.readAsDataURL(file);

        }
    );


    /* =====================================================
       SAVE PROFILE
    ===================================================== */

    form.addEventListener(
        "submit",
        function (event) {

            event.preventDefault();


            /* Get values */

            const name =
                document.getElementById("editName")
                    .value.trim();

            const dob =
                document.getElementById("editDob")
                    .value;

            const gender =
                document.getElementById("editGender")
                    .value;

            const email =
                document.getElementById("editEmail")
                    .value.trim();

            const phone =
                document.getElementById("editPhone")
                    .value.trim();

            const address =
                document.getElementById("editAddress")
                    .value.trim();


            /* =================================================
               VALIDATION
            ================================================= */

            if (name === "") {

                alert("Please enter your full name.");

                return;

            }


            if (email === "") {

                alert("Please enter your email address.");

                return;

            }


            if (phone === "") {

                alert("Please enter your phone number.");

                return;

            }


            /* =================================================
               UPDATE PROFILE HEADER
            ================================================= */

            document.getElementById(
                "profileName"
            ).textContent = name;


            document.getElementById(
                "topProfileName"
            ).textContent = name;


            document.getElementById(
                "profileEmail"
            ).textContent = email;


            document.getElementById(
                "profilePhone"
            ).textContent = phone;


            /* =================================================
               UPDATE PERSONAL INFORMATION
            ================================================= */

            document.getElementById(
                "infoName"
            ).textContent = name;


            document.getElementById(
                "infoEmail"
            ).textContent = email;


            document.getElementById(
                "infoPhone"
            ).textContent = phone;


            document.getElementById(
                "infoGender"
            ).textContent = gender;


            /* =================================================
               DATE FORMAT
            ================================================= */

            if (dob) {

                const date =
                    new Date(dob);

                const day =
                    String(
                        date.getDate()
                    ).padStart(2, "0");

                const month =
                    String(
                        date.getMonth() + 1
                    ).padStart(2, "0");

                const year =
                    date.getFullYear();

                document.getElementById(
                    "infoDob"
                ).textContent =
                    `${day}/${month}/${year}`;

            }


            /* =================================================
               ADDRESS
            ================================================= */

            document.getElementById(
                "infoAddress"
            ).textContent =
                address || "Not provided";


            /* =================================================
               PROFILE IMAGE
            ================================================= */

            if (
                editProfileImage.src &&
                editProfileImage.src !== ""
            ) {

                mainProfileImage.src =
                    editProfileImage.src;

                const smallProfile =
                    document.querySelector(
                        ".profile-small img"
                    );

                if (smallProfile) {

                    smallProfile.src =
                        editProfileImage.src;

                }

            }


            /* =================================================
               CLOSE MODAL
            ================================================= */

            closeModal();


            /* =================================================
               SHOW SUCCESS MESSAGE
            ================================================= */

            showToast();

        }
    );


    /* =====================================================
       TOAST FUNCTION
    ===================================================== */

    function showToast() {

        toast.classList.add("show");

        setTimeout(function () {

            toast.classList.remove("show");

        }, 3000);

    }


    /* =====================================================
       CANCEL CHANGES BUTTON
    ===================================================== */

    const pageCancel =
        document.getElementById(
            "cancelChanges"
        );

    pageCancel.addEventListener(
        "click",
        function () {

            location.reload();

        }
    );

});