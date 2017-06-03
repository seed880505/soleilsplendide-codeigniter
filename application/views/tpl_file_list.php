<?php
function _format_bytes($a_bytes)
{
    if ($a_bytes < 1024) {
        return $a_bytes . ' B';
    } elseif ($a_bytes < 1048576) {
        return round($a_bytes / 1024, 0) . ' KiB';
    } elseif ($a_bytes < 1073741824) {
        return round($a_bytes / 1048576, 0) . ' MiB';
    } elseif ($a_bytes < 1099511627776) {
        return round($a_bytes / 1073741824, 2) . ' GiB';
    } elseif ($a_bytes < 1125899906842624) {
        return round($a_bytes / 1099511627776, 2) . ' TiB';
    } elseif ($a_bytes < 1152921504606846976) {
        return round($a_bytes / 1125899906842624, 2) . ' PiB';
    } elseif ($a_bytes < 1180591620717411303424) {
        return round($a_bytes / 1152921504606846976, 2) . ' EiB';
    } elseif ($a_bytes < 1208925819614629174706176) {
        return round($a_bytes / 1180591620717411303424, 2) . ' ZiB';
    } else {
        return round($a_bytes / 1208925819614629174706176, 2) . ' YiB';
    }
}

?>

<div class="page_body">

<div id="uploaded_files">
    <div id="conponent_title"><h3>Uploaded Files</h3></div>
    <table id="list_files">
        <thead>
        <tr>
            <th>Name</th>
            <th>Preview</th>
            <th>Link</th>
            <th>Delete</th>
            <th>Rename</th>
            <th>Download</th>
            <th>Size</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $counter = 0; ?>
        <?php foreach ($files as $key => $value): ?>
            <?php $counter++; ?>
            <tr>
                <td>
                    <?php echo $value["name"] ?>
                </td>
                <td>
                    <a target="_blank"
                       href="<?php echo base_url() . 'uploads/files/' . $value['name'] ?>">Preview</a>
                </td>
                <td>
                    <input id="item_link" style="width:70px;" type="text"
                           value="<?php echo base_url() . 'uploads/files/' . $value['name'] ?>"/>
                </td>
                <td>
                    <input type="button" id="delete_item" value="Delete" filetype="file"
                           filename="<?php echo $value['name']; ?>">
                </td>
                <td>
                    <input type="button" id="rename_file" value="Rename" fileclickcount="<?php echo $counter ?>">

                    <input style="display:none;" type="text" placeholder='Name'
                           filenamecount="<?php echo $counter ?>">
                    <input style="display:none;" type="button" id="confirm_rename_item" value="Confirm"
                           filetype="file" filename="<?php echo $value['name']; ?>"
                           filecount="<?php echo $counter ?>">
                </td>
                <td>
                    <form id="file<?php echo $counter ?>"
                          action="<?php echo site_url('file/download_file') ?>" method="POST">
                        <input type="button" id="download_item" value="Download"
                               downloadcount="file<?php echo $counter ?>">
                        <input type="hidden" name="filetype" value="file">
                        <input type="hidden" name="filename" value="<?php echo $value['name']; ?>">
                    </form>
                </td>
                <td>
                    <?php echo _format_bytes($value["size"]) ?>
                </td>
                <td>
                    <?php echo date("Y-m-d H:i:s", $value["date"]) ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>


<div id="uploaded_files">
    <div id="conponent_title"><h3>Uploaded Images</h3></div>
    <table id="list_images">
        <thead>
        <tr>
            <th>Image</th>
            <th>Preview</th>
            <th>Link</th>
            <th>Delete</th>
            <th>Rename</th>
            <th>Download</th>
            <th>Size</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $counter = 0; ?>
        <?php foreach ($images as $key => $value): ?>
            <?php $counter++; ?>
            <tr>
                <td>
                    <img width="80px" height="80px"
                         src="<?php echo base_url() . 'uploads/images/' . $value['name'] ?>">
                    <br>
                    <?php echo $value["name"] ?>
                </td>
                <td>
                    <a target="_blank"
                       href="<?php echo base_url() . 'uploads/images/' . $value['name'] ?>">Preview</a>
                </td>
                <td>
                    <input id="item_link" style="width:70px;" type="text"
                           value="<?php echo base_url() . 'uploads/images/' . $value['name'] ?>"/>
                </td>
                <td>
                    <input type="button" id="delete_item" value="Delete" filetype="image"
                           filename="<?php echo $value['name']; ?>">
                </td>
                <td>
                    <input type="button" id="rename_image" value="Rename" clickcount="<?php echo $counter ?>">

                    <input style="display:none;" type="text" placeholder='Name' namecount="<?php echo $counter ?>">
                    <input style="display:none;" type="button" id="confirm_rename_item" value="Confirm"
                           filetype="image" filename="<?php echo $value['name']; ?>" count="<?php echo $counter ?>">
                </td>
                <td>
                    <form id="image<?php echo $counter ?>"
                          action="<?php echo site_url('file/download_file') ?>" method="POST">
                        <input type="button" id="download_item" value="Download"
                               downloadcount="image<?php echo $counter ?>">
                        <input type="hidden" name="filetype" value="image">
                        <input type="hidden" name="filename" value="<?php echo $value['name']; ?>">
                    </form>
                </td>
                <td>
                    <?php echo _format_bytes($value["size"]) ?>
                </td>
                <td>
                    <?php echo date("Y-m-d H:i:s", $value["date"]) ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>


</div>


<div id="uploaded_files">
    <div id="conponent_title"><h3>Uploaded Profile Photos</h3></div>
    <table id="list_profile_photos">
        <thead>
        <tr>
            <th>Image</th>
            <th>Preview</th>
            <th>Link</th>
            <th>Delete</th>
            <th>Rename</th>
            <th>Download</th>
            <th>Size</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <?php $counter = 0; ?>
        <?php foreach ($profile_photos as $key => $value): ?>
            <?php $counter++; ?>
            <tr>
                <td>
                    <img width="80px" height="80px"
                         src="<?php echo base_url() . 'uploads/profile/' . $value['name'] ?>">
                    <br>
                    <?php echo $value["name"] ?>
                </td>
                <td>
                    <a target="_blank"
                       href="<?php echo base_url() . 'uploads/profile/' . $value['name'] ?>">Preview</a>
                </td>
                <td>
                    <input id="item_link" style="width:70px;" type="text"
                           value="<?php echo base_url() . 'uploads/profile/' . $value['name'] ?>"/>
                </td>
                <td>
                    <input type="button" id="delete_item" value="Delete" filetype="profile"
                           filename="<?php echo $value['name']; ?>">
                </td>
                <td>
                    <input type="button" id="rename_profile" value="Rename"
                           profileclickcount="<?php echo $counter ?>">

                    <input style="display:none;" type="text" placeholder='Name'
                           profilenamecount="<?php echo $counter ?>">
                    <input style="display:none;" type="button" id="confirm_rename_item" value="Confirm"
                           filetype="profile" filename="<?php echo $value['name']; ?>"
                           profilecount="<?php echo $counter ?>">
                </td>
                <td>
                    <form id="profile<?php echo $counter ?>"
                          action="<?php echo site_url('file/download_file') ?>" method="POST">
                        <input type="button" id="download_item" value="Download"
                               downloadcount="profile<?php echo $counter ?>">
                        <input type="hidden" name="filetype" value="profile">
                        <input type="hidden" name="filename" value="<?php echo $value['name']; ?>">
                    </form>
                </td>
                <td>
                    <?php echo _format_bytes($value["size"]) ?>
                </td>
                <td>
                    <?php echo date("Y-m-d H:i:s", $value["date"]) ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>


</div>


</div>


<script type="text/javascript" src="<?php echo base_url("includes/javascripts/events/event-file-list.js"); ?>"></script>
