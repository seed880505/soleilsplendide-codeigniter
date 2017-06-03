<div class="page_body">

    <div class="body_left_part">
        <div id="leave_comment" class="body_block SS_block_design">
            <table class="table_leave_comment">
                <tr>
                    <th colspan="2">Contact Me</th>
                </tr>
                <tr>
                    <td><input type="text" name="comment_name" id="comment_name" value=""></td>
                    <td><label class="words" for="comment_name">Name</label><span
                            class="SS_mini_gray">&nbsp;(required)</span>&nbsp;<span class="error"
                                                                                    id="error_name"></span>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" name="comment_mail" id="comment_mail" value=""></td>
                    <td><label class="words" for="comment_mail">Mail</label><span
                            class="SS_mini_gray">&nbsp;(required)</span>&nbsp;<span class="error"
                                                                                    id="error_mail"></span>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" name="comment_website" id="comment_website" value=""></td>
                    <td><label class="words" for="comment_website">Website</label></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="comment_textarea" id="comment_textarea"></textarea>
                        <label class="words" for="comment_textarea">Message</label><span
                            class="SS_mini_gray">&nbsp;(required)</span>
                        <br><span class="error" id="error_textarea"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button id="comment_button">send message</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="body_right_part">

        <div id="contact-me-slider" class="contact_me_profile">
            <?php if (isset($images)): ?>
                <?php foreach ($images as $key => $value): ?>
                    <div><img src="<?php echo base_url() . 'uploads/profile/' . $value['name']; ?>"></div>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <div class="contact_me_text_profile">
            <h4>Chenglong GUO</h4>

            <p>Student of Engineer school (EFREI) in south Paris.<br>

            Graduated from Beijing University of Technology.<br>

            Born in city MudanJiang of China.</p>

            <p><a class="contact_me_cv" target="_blank" href="http://www.linkedin.com/pub/chenglong-guo/27/52a/61b">Curriculum
                    Vitae</a></p>
        </div>
    </div>


    <div class="SS_clear"></div>
</div>

<script type="text/javascript"
        src="<?php echo base_url("includes/javascripts/events/event-contact-me.js"); ?>"></script>
