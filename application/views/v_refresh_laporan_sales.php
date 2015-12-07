<?php
if (count($penjualan_sales) == 0) {
    ?>
    <h4>Tidak Terdapat Data!</h4>
    <?php
} else {
    foreach ($penjualan_sales as $row):
        ?>
        <address>
            <strong>Nama SPG: </strong> <?php echo $row->nama ?><br>
            <strong>Nama Produk: </strong> <?php echo $row->namaBarang ?><br>
            <strong>Jumlah Terjual: </strong> <?php echo $row->jumlah ?>pcs<br>
            <strong>Pendapatan SPG: </strong> Rp.<?php echo number_format($row->hargaJual, 0, ',', '.') ?>,-<br>
            <strong>Komisi: </strong> <?php
            foreach ($komisi as $kom) {
                if ($kom->IDSales == $row->IDSales && $kom->IDBarang == $row->IDBarang) {
                    echo "Rp." . number_format($kom->komisi, 0, ',', '.') . ",-";
                }
            }
            ?> <br>
        </address>
        <a href="<?php echo base_url() ?>index.php/Laporan/ubah_penjualan_sales/<?php echo $row->IDPenjualan ?>" class="btn btn-info siku">Ubah</a><br>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <?php
    endforeach;
}
?>