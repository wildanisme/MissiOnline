<style>
    ol.list-setting-sections {
        list-style: none;
        margin: 0;
        padding: 0;
    }


    li.item-setting-sections {
        line-height: 20px;
    }

    li.item-setting-sections .card,
    li.item-setting-sections.dd-item .card {
        margin-bottom: 10px;
    }


    li.item-setting-sections .card .card-header .card-title,
    li.item-setting-sections.dd-item .card .card-header .card-title {
        font-size: 15px;
    }

    .dd-dragel>li.item-setting-sections.dd-item .card .card-header,
    .dd-dragel>li.item-setting-sections.dd-item .card,
    ol.list-setting-sections li .card .card-header,
    ol.list-setting-sections li .card {
        border-radius: 0;
    }

    .dd-dragel>li.item-setting-sections.dd-item .dd-handle {
        margin: 0;
        border-radius: 0;
        height: 100%;
    }

    ol.list-setting-sections li .dd-handle {
        margin: 0;
        border-radius: 0;
        height: auto;
        cursor: move;
        padding: 5px;
        font-weight: normal;
    }

    .dd-dragel>li.item-setting-sections.dd-item .dd-handle,
    ol.list-setting-sections li.dd-item .dd-handle {
        float: left;
        padding: 10px;
        font-size: 15px;
        line-height: 1.5em;
    }

    #setting-sections .widget-active .card-body .title-active {
        margin-bottom: 10px;
        border-bottom: 1px solid #17a2b8;
        color: #17a2b8;
        font-size: 20px;
    }

    #setting-sections .widget-available .card-body .title-available {
        margin-bottom: 10px;
        border-bottom: 1px solid #343a40;
        color: #343a40;
        font-size: 20px;
    }
</style>
<?php

$get_kategori_dropdown = isset($get_kategori_dropdown) ? $get_kategori_dropdown : array();
$get_playlist_dropdown = isset($get_playlist_dropdown) ? $get_playlist_dropdown : array();
$get_album_dropdown = isset($get_album_dropdown) ? $get_album_dropdown : array();
$get_iklan_home_dropdown = isset($get_iklan_home_dropdown) ? $get_iklan_home_dropdown : array();

$group_setting_sections = array(
    1 => array('id' => 'Atas (Fullwidth)', 'sections' => (isset($get_setting_sections_1) ? $get_setting_sections_1 : array())),
    2 => array('id' => 'Tengah + Sidebar', 'sections' => (isset($get_setting_sections_2) ? $get_setting_sections_2 : array())),
    3 => array('id' => 'Bawah (Fullwidth)', 'sections' => (isset($get_setting_sections_3) ? $get_setting_sections_3 : array())),
);

?>
<div class="card mt-4" style="min-height:450px" id="setting-sections">
    <div class="card-header bg-info">
        <h3 class="card-title py-1">
            Setting Homepage
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="card widget-available">
                    <div class="card-body">
                        <div class="title-available">
                            Sections Tersedia
                        </div>
                        <div>
                            <ol class="list-setting-sections">
                                <?php if ($sections) { ?>
                                    <?php
                                    $wi = 0;
                                    foreach ($sections as $section_key => $section_name) {
                                    ?>

                                        <li class="item-setting-sections">
                                            <div class="card ">
                                                <div class="card-header ">
                                                    <div class="card-title">
                                                        <?php echo $section_name; ?>
                                                    </div>
                                                    <div class="card-tools">
                                                        <button id="dropdownId" type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-plus-circle"></i> Tambahkan
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                                            <a class="setting-sections-widget-add dropdown-item" data-id="<?php echo $section_key; ?>" data-name="<?php echo $section_name; ?>" data-target="1" href="#">Homepage <?php echo $group_setting_sections[1]['id']; ?> </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="setting-sections-widget-add dropdown-item" data-id="<?php echo $section_key; ?>" data-name="<?php echo $section_name; ?>" data-target="2" href="#">Homepage <?php echo $group_setting_sections[2]['id']; ?> </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="setting-sections-widget-add dropdown-item" data-id="<?php echo $section_key; ?>" data-name="<?php echo $section_name; ?>" data-target="3" href="#">Homepage <?php echo $group_setting_sections[3]['id']; ?> </a>
                                                        </div>
                                                    </div>
                                                    <div class="card-body form-template d-none">
                                                        <?php
                                                        switch ($section_key) {
                                                            case 'section_iklan_home':
                                                                oktober20_control_section_iklan_home($wi, $section_key, array(), $get_iklan_home_dropdown);
                                                                break;
                                                            case 'section_gallery':
                                                                oktober20_control_section_gallery($wi, $section_key, array(), $get_album_dropdown);
                                                                break;
                                                            case 'section_video':
                                                                oktober20_control_section_video($wi, $section_key, array(), $get_playlist_dropdown);
                                                                break;
                                                            case 'section_tulisan_per_kategori':
                                                                oktober20_control_section_tulisan_per_kategori($wi, $section_key, array(), $get_kategori_dropdown);
                                                                break;
                                                            default:
                                                                oktober20_control_sections($wi, $section_key, array());
                                                                break;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                        </li>
                                <?php
                                        $wi++;
                                    }
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card widget-active">
                    <?php echo form_open($this->uri->segment(1) . "/oktober20", array('class' => ' form-horizontal')); ?>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($group_setting_sections as $sections_i => $get_setting_sections) { ?>
                                <div class="col-md-12">
                                    <div class="title-active">
                                        Homepage #<?php echo $get_setting_sections['id']; ?>
                                    </div>
                                    <div class="dd-<?php echo $sections_i; ?>" id="setting-sections-active-<?php echo $sections_i; ?>">
                                        <ol class="dd-list list-setting-sections">
                                            <?php if ($get_setting_sections['sections']) { ?>
                                                <?php foreach ($get_setting_sections['sections'] as $i => $section_active) {
                                                    $id = key($section_active);
                                                ?>

                                                    <li class="item-setting-sections dd-item" data-id="<?php echo $id; ?>">
                                                        <div class="dd-handle">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </div>
                                                        <div class="card collapsed-card">
                                                            <div class="card-header bg-info">
                                                                <div class="card-title">
                                                                    <?php if (!empty($section_active[$id]['judul'])) { ?>
                                                                        <?php echo $sections[$id] . ' : "' . word_limiter($section_active[$id]['judul'], 2) . '"'; ?>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <?php echo $sections[$id]; ?>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                    <button data-target="<?php echo $sections_i; ?>" type="button" class="setting-sections-widget-remove btn btn-tool ">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php
                                                                $param_name = 'setting_sections_' . $sections_i;
                                                                switch ($id) {
                                                                    case 'section_iklan_home':
                                                                        oktober20_control_section_iklan_home(
                                                                            $i,
                                                                            $id,
                                                                            $get_setting_sections['sections'],
                                                                            $get_iklan_home_dropdown,
                                                                            $param_name
                                                                        );
                                                                        break;
                                                                    case 'section_gallery':
                                                                        oktober20_control_section_gallery(
                                                                            $i,
                                                                            $id,
                                                                            $get_setting_sections['sections'],
                                                                            $get_album_dropdown,
                                                                            $param_name
                                                                        );
                                                                        break;
                                                                    case 'section_video':
                                                                        oktober20_control_section_video(
                                                                            $i,
                                                                            $id,
                                                                            $get_setting_sections['sections'],
                                                                            $get_playlist_dropdown,
                                                                            $param_name
                                                                        );
                                                                        break;
                                                                    case 'section_tulisan_per_kategori':
                                                                        oktober20_control_section_tulisan_per_kategori(
                                                                            $i,
                                                                            $id,
                                                                            $get_setting_sections['sections'],
                                                                            $get_kategori_dropdown,
                                                                            $param_name
                                                                        );
                                                                        break;
                                                                    default:
                                                                        oktober20_control_sections(
                                                                            $i,
                                                                            $id,
                                                                            $get_setting_sections['sections'],
                                                                            $param_name
                                                                        );
                                                                        break;
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ol>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-info" type="submit" name="set_group_setting_sections">Update</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="callout callout-info">
    <h5>Info</h5>
    <ul>
        <li>Untuk menampilkan Section pada Homepage(Halaman Utama), klik tombol "Tambahkan"</li>
        <li>Klik tombol "Update" untuk simpan konfigurasi</li>
    </ul>
</div>
<script>
    $(function() {
        // untuk sortlable nested sidebar
        $('#setting-sections-active-1').nestable({
            rootClass: 'dd-1',
            group: 'sections-1',
            maxDepth: 1
        }).on('change', function(e) {
            reIndexListSections('1');
        });

        $('#setting-sections-active-2').nestable({
            rootClass: 'dd-2',
            group: 'sections-2',
            maxDepth: 1
        }).on('change', function(e) {
            reIndexListSections('2');
        });

        $('#setting-sections-active-3').nestable({
            rootClass: 'dd-3',
            group: 'sections-3',
            maxDepth: 1
        }).on('change', function(e) {
            reIndexListSections('3');
        });

        $(document).on('click', '.setting-sections-widget-add', function(e) {
            e.preventDefault();
            var widgetKey = $(this).data('id');
            var widgetName = $(this).data('name');
            var targetIndexId = $(this).data('target');
            var itemContext = $(this).closest('li.item-setting-sections');
            var widgetFormElement = $('.form-template', itemContext).html();

            var createElementList = '<li class="item-setting-sections dd-item" data-id="' + widgetKey + '">' +
                '<div class="dd-handle">' +
                '<i class="fa fa-arrows-alt"></i>' +
                '</div>' +
                '<div class="card collapsed-card">' +
                '<div class="card-header  bg-info">' +
                '<div class="card-title">' +
                widgetName +
                '</div>' +
                '<div class="card-tools">' +
                '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>' +
                '<button type="button" class="setting-sections-widget-remove btn btn-tool"><i class="fas fa-trash-alt"></i></button>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                widgetFormElement +
                '</div>' +
                '</div>' +
                '</li>';
            $('#setting-sections-active-' + targetIndexId + ' .list-setting-sections').append(createElementList);
            reIndexListSections(targetIndexId);
        });

        $(document).on('click', '.setting-sections-widget-remove', function(e) {
            e.preventDefault();
            $(this).closest('li.item-setting-sections').remove();
            var targetIndexId = $(this).data('target');
            reIndexListSections(targetIndexId);
        });

        var reIndexListSections = function(targetIndexId) {
            // reindex element
            $('#setting-sections-active-' + targetIndexId + ' .list-setting-sections').find('li.item-setting-sections').each(function(i) {
                var indexElement = i;
                var listContext = $(this);
                var widgetKey = $(this).data('id');
                $('.form-group', listContext).find('input,select,textarea').each(function() {
                    if ($(this).data('multiple') === 'Y') {
                        $(this).attr('name', 'setting_sections_' + targetIndexId + '[' + indexElement + '][' + widgetKey + '][' + $(this).data('name') + '][]');
                    } else {
                        $(this).attr('name', 'setting_sections_' + targetIndexId + '[' + indexElement + '][' + widgetKey + '][' + $(this).data('name') + ']');
                    }
                });

            });
        }

    });
</script>