<select class="form-control siku" id='lokasi' onchange="changeLokasi('lokasi')">
    <?php foreach ($info_lokasis as $info_lokasi): ?>                                    
        <option value='<?php echo $info_lokasi->id_lokasi ?>'><?php echo $info_lokasi->desa; ?></option>
    <?php endforeach; ?>
</select>