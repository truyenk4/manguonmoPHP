<?php include 'app/views/shares/header.php'; ?>


<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <img src="/webbanhang/public/images/SEA_iPhone_15_Pro_Sep23_Web_Banner_Pre-Avail_1280x457_FFH-BuyNow_2.jpg" class="img-fluid" alt="Banner">
        </div>
    </div>
</div>
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách sản phẩm</h1>

<!-- Thanh chứa nút "Thêm sản phẩm" và Dropdown danh mục -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
    

    <!-- Bộ lọc danh mục -->
    <form method="GET" action="/webbanhang/Product" class="form-inline">
        <?php
        if (!isset($categories)) {
            $categoryModel = new CategoryModel((new Database())->getConnection());
            $categories = $categoryModel->getCategories();
        }
        ?>
        <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">

        <label for="category" class="mr-2 font-weight-bold">Danh mục:</label>

        <select name="category" id="category" class="form-control" style="width: 250px; border-radius: 12px;" onchange="this.form.submit()">
            <option value="">-- Tất cả --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->id; ?>" 
                    <?php echo (isset($_GET['category']) && $_GET['category'] == $category->id) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
    <?php if (SessionHelper::isAdmin()): ?>
        <a href="/webbanhang/Product/add" class="btn btn-success">Thêm sản phẩm mới</a>
    <?php endif; ?>
</div>



    <div class="row row-cols-1 row-cols-md-4 g-4" id = "product-list">
        
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<style>

    .col-12 
    {
        display: block;'
        align-items: center;
        justify-content: space-around;
        margin-bottom: 20px;
    }
    .col-12 img {
        width: 1400px;
        height: 350px;
        object-fit: cover;
        margin-bottom: 10px;
    }
    /* Hiệu ứng phóng to khi di chuột vào card sản phẩm */
    .product-card {
        transition: transform 0.3s ease; /* Thời gian chuyển động */
    }

    .product-card:hover {
        transform: scale(1.05); /* Phóng to 1.005 lần */
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('/webbanhang/api/product')
    .then(response => response.json())
    .then(data => {
        const productList = document.getElementById('product-list');
        data.forEach(product => {
            const productItem = document.createElement('li');
            //productItem.className = 'list-group-item';
            productItem.innerHTML = `
                <div class="col">
                    <a href="/webbanhang/Product/show/${product.id}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm border-light rounded product-card">
                            <div class="card-img-container" style="width: 100%; height: 200px; overflow: hidden;">
                                ${product.image ? 
                                    `<img src="/webbanhang/${product.image}" class="card-img-top" alt="Product Image" style="width: 100%; height: 100%; object-fit: cover;">` : 
                                    `<div style="width: 100%; height: 100%; background-color: #f0f0f0; display: flex; justify-content: center; align-items: center; color: #ccc; text-align: center;">
                                        <span>Không có hình ảnh</span>
                                    </div>`
                                }
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    ${product.name}
                                </h5>
                                <p><strong>Giá:</strong> ${new Intl.NumberFormat('vi-VN').format(product.price)} VND</p>
                                <p><strong>Danh mục:</strong> ${product.category_name}</p>
                                <div class="d-flex justify-content-between">
                                    ${product.isAdmin ? 
                                        `<a href="/webbanhang/Product/edit/${product.id}" class="btn btn-warning btn-sm">Sửa</a>
                                        <a href="/webbanhang/Product/delete/${product.id}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>` : ''
                                    }
                                    <a href="/webbanhang/Product/addToCart/${product.id}" class="btn btn-primary btn-sm">Thêm vào giỏ</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            `;
            productList.appendChild(productItem);
        });
    });
});

function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        fetch(`/webbanhang/api/product/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Product deleted successfully') {
                location.reload();
            } else {
                alert('Xóa sản phẩm thất bại');
            }
        });
    }
}
</script>
