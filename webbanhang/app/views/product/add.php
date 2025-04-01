<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded" style="background-color: #ffffff;">
        <h1 class="text-center mb-4" style="color: #333333;">Thêm sản phẩm mới</h1>

        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Form thêm sản phẩm -->
        <form id="add-product-form">
            <div class="row mb-3">
                <!-- Cột bên trái: Tên sản phẩm, Mô tả, Giá -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label" style="color: #333333;">Tên sản phẩm:</label>
                        <input type="text" id="name" name="name" class="form-control" style="border-radius: 12px; background-color: #f6f6f6; color: #555;" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label" style="color: #333333;">Mô tả:</label>
                        <textarea id="description" name="description" class="form-control" style="border-radius: 12px; background-color: #f6f6f6; color: #555;" rows="6" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label" style="color: #333333;">Giá:</label>
                        <input type="number" id="price" name="price" class="form-control" style="border-radius: 12px; background-color: #f6f6f6; color: #555;" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label" style="color: #333333;">Danh mục:</label>
                        <select id="category_id" name="category_id" class="form-select" style="border-radius: 12px; background-color: #f6f6f6; color: #555;" required>
                            <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id; ?>"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Cột bên phải: Hình ảnh và nút -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label" style="color: #333333;">Hình ảnh:</label>
                        <input type="file" id="image" name="image" class="form-control" onchange="previewImage(event)" style="border-radius: 12px; background-color: #f6f6f6; color: #555;">
                        <!-- Chỗ để hiển thị ảnh preview -->
                        <div id="image-preview-container" class="mt-2">
                            <img id="image-preview" src="" alt="Preview Image" class="img-fluid d-none" style="max-width: 100%; height: auto; border-radius: 12px; border: 1px solid #ddd;">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-success w-48" style="background-color: #4CAF50; border: none; border-radius: 12px; transition: all 0.3s; padding: 10px 20px;">Thêm sản phẩm</button>
                        <a href="/webbanhang/Product/list" class="btn btn-secondary w-48" style="background-color: #6c757d; border: none; border-radius: 12px; transition: all 0.3s; padding: 10px 20px;">Quay lại danh sách sản phẩm</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- Thêm một số style tùy chỉnh -->
<style>
    /* Tạo khung bao quanh form */
    .card {
        background-color: #ffffff; /* Màu trắng sạch sẽ */
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* Tăng khoảng cách giữa các trường input */
    .form-label {
        font-weight: bold;
        color: #333333; /* Màu chữ tối */
    }

    .form-control {
        border-radius: 12px;
        background-color: #f6f6f6; /* Màu nền sáng nhẹ */
        color: #555; /* Màu chữ tối hơn */
        padding: 10px;
    }

    /* Hiệu ứng hover cho các nút */
    .btn {
        border-radius: 12px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #45a049; /* Màu xanh lá sáng hơn khi hover */
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(72, 163, 78, 0.3);
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Màu xám sáng khi hover */
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(92, 99, 105, 0.3);
    }

    /* Đảm bảo các nút có khoảng cách khi trên màn hình nhỏ */
    .w-48 {
        width: 48%;
    }

    @media (max-width: 768px) {
        .w-48 {
            width: 100%;
            margin-top: 10px;
        }
    }

    /* Hiệu ứng khi có ảnh preview */
    #image-preview-container {
        display: none;
    }

    #image-preview {
        border-radius: 12px;
        border: 1px solid #ddd;
    }
</style>

<!-- Thêm script JavaScript để preview hình ảnh -->
<script>
    function previewImage(event) {
        var reader = new FileReader();
        var imagePreview = document.getElementById('image-preview');
        var previewContainer = document.getElementById('image-preview-container');

        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.classList.remove('d-none'); // Hiển thị ảnh
            previewContainer.style.display = 'block'; // Hiển thị container ảnh preview
        }

        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('/webbanhang/api/category')
    .then(response => response.json())
    .then(data => {
        const categorySelect = document.getElementById('category_id');
        data.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            categorySelect.appendChild(option);
        });
    });

    document.getElementById('add-product-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const jsonData = {};
        
        formData.forEach((value, key) => {
            if (key === "image") {
                jsonData[key] = value.name; // Chỉ lấy tên của file ảnh
            } else {
                jsonData[key] = value;
            }
        });
        
        fetch('/webbanhang/api/product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Product created successfully') {
                location.href = '/webbanhang/Product';
            } else {
                alert('Thêm sản phẩm thất bại');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Lỗi: Không thể gửi dữ liệu đến máy chủ.');
        });
    });
});

</script>
