<div class="page_body">

    <div class="index_content_style">

        <!--slide carousel-->
        <div id="slick-carousel" class="index_content_slide">
            <div><a target="_blank" href="http://www.sencha.com"><img src="<?php echo base_url("uploads/index/extjs.png"); ?>"></a></div>
            <div><a target="_blank" href="http://www.appcelerator.com/"><img src="<?php echo base_url("uploads/index/titanium.png"); ?>"></a></div>
        </div>

        <!--List of posts-->
        <?php
        if (isset($list_articles)) {
            foreach ($list_articles as $value) {
                ?>
                <article class="index_block_style">
                    <div class="index_block_title">
                        <a href="<?php echo site_url("blog/index/" . $value["id"]); ?>"><?php echo $value["title"]; ?></a>
                    </div>
                    <div class="index_block_author"><?php echo date("F j, Y", strtotime($value["createtime"])); ?> By
                        <a href="https://plus.google.com/109593651906573905145?rel=author" rel="author" target="_blank">Chenglong
                            GUO</a>
                    </div>
                    <div class="index_block_text"><?php echo $value["content"]; ?></div>
                    <div class="index_block_gradient"></div>
                    <div class="index_block_read_more">
                        <a href="<?php echo site_url("blog/index/" . $value["id"]); ?>">Read article&nbsp;&rarr;</a>
                    </div>
                </article>
            <?php
            }
        }
        ?>

    </div>

    <div class="index_right_style">

        <!--Favorite video-->
        <div class="index_right_block favorite_video">
            <!--
            1. Please be sure to give a different id to each different play lists.
            2. Don"t forget to set the "sv_playlist" class!
            -->
            <div id="index-playlist" class="sv_playlist">
                <div class="video_wrap">
                    <video id="video1" data-youtube-id="JWWMmxyKOR0" data-settings="autoresize:fit;">
                        Your browser does not support the audio element.
                    </video>
                </div>
                <div class="video_wrap">
                    <video id="video2" data-youtube-id="wQMr2RwWUj4" data-settings="autoresize:fit;">
                        Your browser does not support the audio element.
                    </video>
                </div>
                <ul class="thumbs">
                    <li id="thumbnail_video1">
                        <a href="">
                            <img alt="" src="http://img.youtube.com/vi/JWWMmxyKOR0/default.jpg" />
                            <span class="play" />
                        </a>
                    </li>
                    <li id="thumbnail_video2">
                        <a href="">
                            <img alt="" src="http://img.youtube.com/vi/wQMr2RwWUj4/default.jpg" />
                            <span class="play" />
                        </a>
                    </li>
                </ul>
                <div class="SS_clear"></div>
            </div>
        </div>

        <!--Most popular posts-->
        <div class="index_right_block most_popular_post">
            <ul class="index_right_list">
                <?php
                if (isset($most_popular_articles)) {
                    foreach ($most_popular_articles as $value) {
                        ?>
                        <li class="index_right_listItem"><?php echo $value["title"] ?></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </div>

        <!--Latest posts-->
        <div class="index_right_block latest_post">
            <ul class="index_right_list">
                <?php
                if (isset($latest_articles)) {
                    foreach ($latest_articles as $value) {
                        ?>
                        <li class="index_right_listItem"><?php echo $value["title"] ?></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="SS_clear"></div>

</div>

<script type="text/javascript" src="<?php echo base_url("includes/javascripts/events/event-index.js"); ?>"></script>
