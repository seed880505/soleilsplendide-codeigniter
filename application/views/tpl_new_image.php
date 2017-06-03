<div class="page_body">


    <div id="upload">
        <table id="upload">
            <tr>
                <td>Upload File</td>
            </tr>
            <tr>
                <td>
                    <?php
                    if (isset($result_file)) {
                        if ($result_file) {
                            echo "<span style='color:blue;'>Your file was successfully uploaded!</span>";
                        } else {
                            echo "<span style='color:red;'>" . $error . "</span>";
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo form_open_multipart('file/do_upload_file'); ?>

                    <input type="file" name="userfile" size="20"/>

                    <br/><br/>

                    <input type="submit" value="confirm uploading file"/>

                    </form>
                </td>
            </tr>
        </table>
    </div>


    <div id="upload">
        <table id="upload">
            <tr>
                <td>Upload Image</td>
            </tr>
            <tr>
                <td>
                    <?php
                    if (isset($result_image)) {
                        if ($result_image) {
                            echo "<span style='color:blue;'>Your image was successfully uploaded!</span>";
                        } else {
                            echo "<span style='color:red;'>" . $error . "</span>";
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo form_open_multipart('file/do_upload_image'); ?>

                    <input type="file" name="userfile" size="20"/>

                    <br/><br/>

                    <input type="submit" value="confirm uploading image"/>

                    </form>
                </td>
            </tr>
        </table>
    </div>


    <div id="upload">
        <table id="upload">
            <tr>
                <td>Upload Image for Profile photos</td>
            </tr>
            <tr>
                <td>
                    <?php
                    if (isset($result_profile_image)) {
                        if ($result_profile_image) {
                            echo "<span style='color:blue;'>Your image was successfully uploaded!</span>";
                        } else {
                            echo "<span style='color:red;'>" . $error . "</span>";
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo form_open_multipart('file/do_upload_profile_image/'); ?>

                    <input type="file" name="userfile" size="20"/>

                    <br/><br/>

                    <input type="submit" value="confirm uploading image"/>

                    </form>
                </td>
            </tr>
        </table>
    </div>


</div>