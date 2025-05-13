<div class="col-md-3 col-lg-2 p-3 bg-body-tertiary min-vh-100 border-end">
    <h5 class="mb-4">Admin Panel</h5>
    <a href="#" class="btn btn-outline-primary w-100 sidebar-btn"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.category.index') }}" class="btn btn-outline-info w-100 sidebar-btn"><i class="bi bi-box-seam"></i> Category </a>
    <a href="#" class="btn btn-outline-success w-100 sidebar-btn"><i class="bi bi-box-seam"></i> Products</a>
    <a href="{{ route('admin.brand.index') }}" class="btn btn-outline-primary w-100 sidebar-btn"><i class="bi bi-receipt-cutoff"></i> Brands</a>
    <a href="" class="btn btn-outline-warning w-100 sidebar-btn"><i class="bi bi-receipt-cutoff"></i> Orders</a>
    <a href="{{ route('admin.user.index') }}" class="btn btn-outline-info w-100 sidebar-btn"><i class="bi bi-people"></i>Administration  List</a>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-warning w-100 sidebar-btn"><i class="bi bi-box-seam"></i> Roles </a>
    <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-success w-100 sidebar-btn"><i class="bi bi-box-seam"></i> permission</a>
</div>
