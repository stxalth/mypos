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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Barcode Generator <i class="fa fa-barcode"></i></h3>
            <div class="pull-right">
                <a href="<?= site_url('item') ?>" class="btn btn-warning btn-flat btn-sm">
                    <i class="fa fa-undo"> Back</i>
                </a>
            </div>
        </div>
        <div class="box-body">
            <?php
            $generator = new Picqer\Barcode\BarcodeGeneratorPNG(); //ini ada garis merah-merah, diabaikan aja. Tetep bisa jalan.
            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '"style="width: 200px;">';
            ?>
            <br>
            <?= $row->barcode ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">QR-Code Generator <i class="fa fa-qrcode"></i></h3>
        </div>
        <div class="box-body">
            <?php

            use Endroid\QrCode\Encoding\Encoding;
            use Endroid\QrCode\QrCode;
            use Endroid\QrCode\Writer\PngWriter;

            $writer = new PngWriter();

            // Create QR code
            $qrCode = QrCode::create('Data')
                ->setEncoding(new Encoding('UTF-8'))
                ->setSize(300)
                ->setMargin(10);

            $result = $writer->write($qrCode);
            $result->saveToFile('uploads/qr-code/item-' . $row->item_id . '.png');
            ?>
            <img src="<?= base_url('uploads/qr-code/item-' . $row->item_id . '.png') ?>" style="width: 200px;">
            <br>
            <?= $row->barcode ?>
        </div>
    </div>

</section>