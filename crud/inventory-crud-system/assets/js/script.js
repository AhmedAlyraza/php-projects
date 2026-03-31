console.log("App Loaded");

document.addEventListener("DOMContentLoaded", function () {

    // EDIT MODAL
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    document.querySelectorAll(".editBtn").forEach(btn => {
        btn.addEventListener("click", function () {

            document.getElementById("edit-id").value = this.dataset.id;
            document.getElementById("edit-name").value = this.dataset.name;
            document.getElementById("edit-description").value = this.dataset.description;
            document.getElementById("edit-price").value = this.dataset.price;
            document.getElementById("edit-category").value = this.dataset.category;
            document.getElementById("edit-quantity").value = this.dataset.quantity;

            document.getElementById("edit-old-image").value = this.dataset.image;
            document.getElementById("edit-old-gallery").value = this.dataset.gallery;

            document.getElementById("edit-preview").src = this.dataset.image;

            let galleryDiv = document.getElementById("edit-gallery-preview");
            galleryDiv.innerHTML = "";

            let gallery = JSON.parse(this.dataset.gallery || "[]");

            gallery.forEach(img => {
                let image = document.createElement("img");
                image.src = img;
                image.style.width = "50px";
                image.style.margin = "5px";
                galleryDiv.appendChild(image);
            });

            editModal.show();
        });
    });

    // ADD MODAL
    const addModal = new bootstrap.Modal(document.getElementById('addModal'));

    document.getElementById("addProductBtn").addEventListener("click", function () {
        addModal.show();
    });

});