<style>
    .info-box {
        display: block;
        min-height: 90px;
        background: #f0f3f5;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        border-radius: 2px;
        margin-bottom: 15px;
    }

    .info-box-icon {
        border-top-left-radius: 2px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 2px;
        display: block;
        float: left;
        height: 90px;
        width: 90px;
        text-align: center;
        font-size: 45px;
        line-height: 90px;
        background: rgba(0, 0, 0, 0.2);
        color: white;
    }

    .info-box-content {
        padding: 5px 10px;
        margin-left: 90px;
    }

    .info-box-text {
        display: block;
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-transform: uppercase;
    }

    .info-box-number {
        display: block;
        font-weight: bold;
        font-size: 18px;
    }
</style>

<section class="row d-flex justify-content-center mt-3">
    <a class="col-md-6 col-lg-3 text-dark" href="{{ route('admin.user_extra.index') }}" style="text-decoration:none">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-address-card"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Registered Users</span>
                <span class="info-box-number">{{ count($users) }}</span>
            </div>
        </div>
        <!-- /.info-box -->
    </a>
    <!-- /.col -->
    <a class="col-md-6 col-lg-3 text-dark" href="{{ route('admin.supplier.index') }}" style="text-decoration:none">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-anchor"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Suppliers</span>
                <span class="info-box-number">{{ count($suppliers) }}</span>
            </div>
        </div>
        <!-- /.info-box -->
    </a>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <a class="col-md-6 col-lg-3 text-dark" href="{{ route('admin.user_extra.index') }}" style="text-decoration:none">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-hourglass-half"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Customers</span>
                <span class="info-box-number">300</span>
            </div>
        </div>
        <!-- /.info-box -->
    </a>
    <!-- /.col -->
</section>