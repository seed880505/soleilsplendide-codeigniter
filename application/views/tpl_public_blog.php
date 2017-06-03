<div class="page_body">

    <div class="body_left_part">

        <!-- MAIN PASSAGE -->
        <div class="body_block SS_block_design passage_content">
            <article>
                <div class="main_title">
                    <h2>
                        <?php /** @var $main home/blog */
                        echo $main["title"]; ?>
                    </h2>
                </div>

                <div class="main_author">
                    By <a href="https://plus.google.com/109593651906573905145?rel=author" rel="author"
                          target="_blank"><?php echo $main["username"]; ?></a> @<?php echo $main["createtime"]; ?>
                </div>

                <div class="main_content">
                    <?php echo $main["content"]; ?>
                </div>
            </article>
        </div>
        <!-- ___END___MAIN PASSAGE -->

        <!-- LIST COMMENTS -->
        <div class="body_block SS_block_design">
            <table id="table_list_comment" class="table_list_comment_style">

                <?php if (isset($main["comments"])): ?>
                <thead>
                <tr>
                    <th colspan="2"><?php echo count($main["comments"]); ?>&nbsp;COMMENTS</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($main["comments"] as $key => $value): ?>
                    <tr class="border_bottom">
                        <td>
                            <img class="avatar"
                                 src="<?php echo "http://www.gravatar.com/avatar/" . $value['mail_hash'] . "?s=60"; ?>">
                        </td>
                        <td>
                            <div class="comment_content"><?php echo $value["comment_content"]; ?></div>

                            <div class="SS_mini_gray comment_summary">
                                <?php if ($value['comment_website'] != ''): ?>
                                    <span>By <a target="_blank"
                                                href="<?php echo $value['comment_website']; ?>"><?php echo $value["comment_name"]; ?></a></span>
                                <?php else: ?>
                                    <span>By <?php echo $value["comment_name"]; ?></span>
                                <?php endif ?>

                                <span>@ <?php echo date('F jS, Y  H:i', strtotime($value["createtime"])); ?></span><span
                                    id="reply_comment" class="reply_comment_style"
                                    data-name="<?php echo $value["comment_name"]; ?>">Reply</span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

                <?php else: ?>
                <thead>
                <tr>
                    <th colspan="2">0 COMMENTS</th>
                </tr>
                </thead>
                <tbody>
                <?php endif ?>

                <!--Template comment-->
                <tr class="border_bottom">
                    <td>
                        <!--<img class="avatar" src="#">-->
                    </td>
                    <td>
                        <div class="comment_content"></div>
                        <div class="SS_mini_gray comment_summary"></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- ___EOF___LIST COMMENTS -->


        <!-- TAKE COMMENTS -->
        <div id="leave_comment" class="body_block SS_block_design">
            <table class="table_leave_comment">

                <tr>
                    <th colspan="2">LEAVE A REPLY</th>
                </tr>

                <tr>
                    <td><input type="text" name="comment_name" id="comment_name" value=""></td>
                    <td><label class="words" for="comment_name">Name</label>
                        <span class="SS_mini_gray">&nbsp;(required)</span>&nbsp;
                        <span class="error" id="error_name"></span>
                    </td>
                </tr>

                <tr>
                    <td><input type="text" name="comment_mail" id="comment_mail" value=""></td>
                    <td><label class="words" for="comment_mail">Mail</label>
                        <span class="SS_mini_gray">&nbsp;(required)</span>&nbsp;
                        <span class="error" id="error_mail"></span>
                    </td>
                </tr>

                <tr>
                    <td><input type="text" name="comment_website" id="comment_website" value=""></td>
                    <td><label class="words" for="comment_website">Website</label></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <textarea name="comment_textarea" id="comment_textarea"></textarea>
                        <label class="words" for="comment_textarea">Comment</label><span
                            class="SS_mini_gray">&nbsp;(required)</span>
                        <br><span class="error" id="error_textarea"></span>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button id="comment_button">submit comment</button>
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><input type="hidden" id="comment_passage_id" value="<?php echo $main['id']; ?>">
                    </td>
                </tr>


            </table>
        </div>
        <!-- ___EOF___TAKE COMMENTS -->


    </div>


    <div class="body_right_part">


        <div id="passage_menu" class="sidebar_block SS_block_design">
            <div class="list_title">
                Latest posts
            </div>
            <div>
                <?php
                /** @var $list_5 home/blog */
                foreach ($list_5 as $key => $value) {
                    ?>
                    <div class="list_content"><a
                            href="<?php echo site_url('blog/index/' . $value['id'] . ''); ?>"><?php echo $value['title'] ?></a>
                    </div>
                <?
                }
                ?>
            </div>
        </div>
    </div>

    <div class="SS_clear"></div>


</div>

<link rel="stylesheet" type="text/css"
      href="<?php echo base_url("includes/syntaxhighlighter/styles/shCore.css"); ?>"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url("includes/syntaxhighlighter/styles/shThemeMidnight.css"); ?>"/>
<script type="text/javascript"
        src="<?php echo base_url("includes/syntaxhighlighter/scripts/shCore.js"); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url("includes/syntaxhighlighter/scripts/shBrushCss.js"); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url("includes/syntaxhighlighter/scripts/shBrushJScript.js"); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url("includes/syntaxhighlighter/scripts/shBrushXml.js"); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url("includes/syntaxhighlighter/scripts/shBrushPhp.js"); ?>"></script>
<!--  <script type="text/javascript"
          src="<?php /*echo base_url("includes/syntaxhighlighter/scripts/shAutoloader.js"); */ ?>"></script>-->

<!-- AddThis Smart Layers -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50127ec75eaef793"></script>

<script type="text/javascript"
        src="<?php echo base_url("includes/javascripts/events/event-public-blog.js"); ?>"></script>
