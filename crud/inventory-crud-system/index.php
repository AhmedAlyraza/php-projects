<?php
require __DIR__ . '/config/db.php';
include 'includes/header.php';
?>




<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Products</h2>
    <button class="btn btn-success" id="addProductBtn">+ Add Product</button>
</div>

<table class="table table-hover shadow rounded">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Gallery</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        <?php
        $result = $conn->query("SELECT * FROM protable");

        while ($row = $result->fetch_assoc()):
            ?>

            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>

                <td>
                    <img src="<?= $row['image'] ?>" width="50">
                </td>

                <td>
                    <div class="d-flex flex-wrap gap-2">
                        <?php
                        $gallery = json_decode($row['gallery'], true);
                        if ($gallery):
                            foreach ($gallery as $img):
                                ?>
                                <img src="<?= $img ?>" class="gallery-img">
                            <?php endforeach; endif; ?>
                    </div>
                </td>


                <td>
                    <button class="btn btn-warning btn-sm editBtn" data-id="<?= $row['id'] ?>"
                        data-name="<?= $row['name'] ?>" data-description="<?= $row['description'] ?>"
                        data-price="<?= $row['price'] ?>" data-category="<?= $row['category'] ?>"
                        data-quantity="<?= $row['quantity'] ?>" data-image="<?= $row['image'] ?>"
                        data-gallery='<?= $row['gallery'] ?>'>
                        Edit
                    </button>

                    <a href="actions/delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>

            </tr>

        <?php endwhile; ?>

</table>


<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <form action="actions/update.php" method="POST" enctype="multipart/form-data" class="modal-content">

            <div class="modal-header">
                <h5>Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" name="id" id="edit-id">
                <input type="hidden" name="old_image" id="edit-old-image">
                <input type="hidden" name="old_gallery" id="edit-old-gallery">

                <input class="form-control mb-2" name="name" id="edit-name">
                <textarea class="form-control mb-2" name="description" id="edit-description"></textarea>
                <input class="form-control mb-2" name="price" type="number" id="edit-price">
                <input class="form-control mb-2" name="category" id="edit-category">
                <input class="form-control mb-2" name="quantity" type="number" id="edit-quantity">

                <img id="edit-preview" width="80">

                <input class="form-control mt-2" type="file" name="image">

                <div id="edit-gallery-preview"></div>

                <input class="form-control mt-2" type="file" name="gallery[]" multiple>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
            </div>

        </form>
    </div>
</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <form action="actions/insert.php" method="POST" enctype="multipart/form-data" class="modal-content">

            <div class="modal-header">
                <h5>Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-2">
                    <label>Name</label>
                    <input class="form-control" name="name" required>
                </div>

                <div class="mb-2">
                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <div class="mb-2">
                    <label>Price</label>
                    <input class="form-control" name="price" type="number">
                </div>

                <div class="mb-2">
                    <label>Category</label>
                    <input class="form-control" name="category">
                </div>

                <div class="mb-2">
                    <label>Quantity</label>
                    <input class="form-control" name="quantity" type="number">
                </div>

                <div class="mb-2">
                    <label>Image</label>
                    <input class="form-control" type="file" name="image">
                </div>

                <div class="mb-2">
                    <label>Gallery</label>
                    <input class="form-control" type="file" name="gallery[]" multiple>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-success w-100">Add Product</button>
            </div>

        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>