<section class="content-header">
    <h1>
        Items
        <small>Data Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Items</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $this->view('message') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?= ucfirst($page) ?> item</h3>
            <div class="pull-right">
                <a href="<?= site_url('item') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"> Back</i>
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="<?= site_url('item/process') ?>" method="post">
                        <div class="form-group">
                            <label>Barcode *</label>
                            <!-- untuk yang input type hidden name id ini digunakan untuk input bagian id -->
                            <input type="hidden" name="id" value="<?= $row->item_id ?>">
                            <input type="text" name="barcode" value="<?= $row->barcode ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="product_name">Product Name *</label>
                            <input type="text" name="product_name" id="product_name" value="<?= $row->name ?>" class="form-control" required>
                        </div>

                        <!-- Berikut ini adalah salah satu cara untuk bikin dropdown dengan looping data -->
                        <!-- Hubungannya tetep sama Item.php -->
                        <!-- Di sana udah ada pemanggilan model dan pengambilan datanya -->
                        <div class="form-group">
                            <label>Category *</label>
                            <select name="category" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($category->result() as $key => $data) { ?>
                                    <option value="<?= $data->category_id ?>" <?= $data->category_id == $row->category_id ? 'selected' : null ?>><?= $data->name ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Nah, jadi di sini tinggal echo aja, gausah bikin <select> -->
                        <!-- Karena loopingnya udah ada di Item.php, di sini tinggal panggil aja yg di bagian $data = array() -->
                        <!-- tinggal panggil deh yg bagian unit -->
                        <div class="form-group">
                            <label>Unit *</label>
                            <?php echo form_dropdown(
                                'unit',
                                $unit,
                                $selectedunit,
                                ['class' => 'form-control', 'required' => 'required']
                            ) ?>
                        </div>

                        <div class="form-group">
                            <label>Price *</label>
                            <input type="number" name="price" value="<?= $row->price ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat"><i class="fa fa-paper-plane"> Save</i></button>
                            <button type="reset" class="btn btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>