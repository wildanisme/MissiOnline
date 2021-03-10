<?php echo form_open($this->uri->segment(1)."/goodnews",array( 'class'=> 'form-horizontal pt-4' )) ;?>

    <?php
         $get_mode = isset($get_mode) ? $get_mode : '';
         $get_tagline = isset($get_tagline) ? $get_tagline : array();  
         $get_iklan_atas_dropdown = isset($get_iklan_atas_dropdown) ? $get_iklan_atas_dropdown : array();  
    ?>
    <div class="card" style="min-height:450px">
        <div class="card-header bg-info">
            <h3 class="card-title py-1">
                Konfigurasi
            </h3>
        </div>
        <div class="card-body"> 
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    Tagline Website
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tagline[text]" value="<?php echo $get_tagline['text'];?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                   Tampilkan Tagline Di Header
                </label>
                <div class="col-sm-6">
                    <select name="tagline[header]" class="form-control">
                         <option value="0"  <?php echo ($get_tagline['header'] == '0') ? 'selected="selected"' : '';?>>Tidak</option>
                         <option value="1"  <?php echo ($get_tagline['header'] == '1') ? 'selected="selected"' : '';?>>Ya</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                   Tampilkan Tagline Di Footer
                </label>
                <div class="col-sm-6">
                    <select name="tagline[footer]" class="form-control">
                         <option value="0"  <?php echo ($get_tagline['footer'] == '0') ? 'selected="selected"' : '';?>>Tidak</option>
                         <option value="1"  <?php echo ($get_tagline['footer'] == '1') ? 'selected="selected"' : '';?>>Ya</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                   Iklan Atas/Logo
                </label>
                <div class="col-sm-6">
                    <select name="iklan_logo" class="form-control">
                        <option value=""  <?php echo ($get_iklan_logo == '') ? 'selected="selected"' : '';?>> -- Pilih -- </option> 
                        <option value="semua-acak"  <?php echo ($get_iklan_logo == 'semua-acak') ? 'selected="selected"' : '';?>>Semua (Singgle & Acak)</option>
                        <?php 
                            foreach($get_iklan_atas_dropdown as $iklan_atas) {
                                ?>
                                <option value="<?php echo $iklan_atas['id'];?>" 
                                     <?php echo ($get_iklan_logo == $iklan_atas['id']) ? 'selected="selected"' : '';?>>
                                        <?php echo $iklan_atas['nama'];?>
                                    </option>
                                <?php
                            }
                        ?>
                    </select> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                   Iklan Atas/Header
                </label>
                <div class="col-sm-6">
                    <select name="iklan_header" class="form-control">
                        <option value=""  <?php echo ($get_iklan_header == '') ? 'selected="selected"' : '';?>> -- Pilih -- </option>
                        <option value="semua"  <?php echo ($get_iklan_header == 'semua') ? 'selected="selected"' : '';?>>Semua (List)</option>
                        <option value="semua-acak"  <?php echo ($get_iklan_header == 'semua-acak') ? 'selected="selected"' : '';?>>Semua (Singgle & Acak)</option>
                        <?php 
                            foreach($get_iklan_atas_dropdown as $iklan_atas) {
                                ?>
                                <option value="<?php echo $iklan_atas['id'];?>" 
                                     <?php echo ($get_iklan_header == $iklan_atas['id']) ? 'selected="selected"' : '';?>>
                                        <?php echo $iklan_atas['nama'];?>
                                    </option>
                                <?php
                            }
                        ?>
                    </select>
                    <div class="checkbox-group">
                        <input type="checkbox"  
                            name="iklan_header_semua_halaman"
                            <?php echo ($get_iklan_header_semua_halaman == '1' ?  'checked="checked"' : '');?>
                            value="1" 
                            >
                        Tampilkan di semua halaman
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                   Tampilkan Breaking News
                </label>
                <div class="col-sm-6">
                    <select name="breaking_news" class="form-control">
                         <option value="0"  <?php echo ($get_breaking_news == '0') ? 'selected="selected"' : '';?>>Tidak</option>
                         <option value="1"  <?php echo ($get_breaking_news == '1') ? 'selected="selected"' : '';?>>Ya</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    Tombol "Back To Top"
                </label>
                <div class="col-sm-6">
                    <select name="btn_back_to_top" class="form-control">
                         <option value="0"  <?php echo ($get_btn_back_to_top == '0') ? 'selected="selected"' : '';?>>Sembunyikan</option>
                         <option value="1"  <?php echo ($get_btn_back_to_top == '1') ? 'selected="selected"' : '';?>>Tampilkan</option>
                    </select>
                </div>
            </div> 
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    Header Embeded Code
                </label>
                <div class="col-sm-6">
                    <textarea  name="header_embeded_code" rows="5" class="form-control"><?php echo $get_header_embeded_code;?></textarea> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    Footer Embeded Code
                </label>
                <div class="col-sm-6">
                    <textarea  name="footer_embeded_code" rows="5" class="form-control"><?php echo $get_footer_embeded_code;?></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-info" type="submit" name="set_config">Update</button>
        </div>
    </div>
<?php echo form_close();?>
<div class="callout callout-info">
    <h5>Info</h5>
    <ul> 
        <li>Tagline Website untuk tagline/slogan website.</li>
        <li>Iklan Atas/Logo untuk mengatur visibiliti iklan pada area logo.</li>
        <li>Iklan Atas/Header untuk mengatur visibiliti iklan atas/header.</li>
        <li>Tampilkan Breaking News untuk mengatur visibiliti breaking news.</li>
        <li>Tombol "Back To Top" , untuk menampilkan / sembunyikan tombol scroll back to top pojok kanan bawah.</li>
        <li>"Embeded Code" header/footer untuk keperluan integrasi dengan service diluar website (misal: widget chat, google captcha, fb pixel, dll).</li>
    </ul>
</div>