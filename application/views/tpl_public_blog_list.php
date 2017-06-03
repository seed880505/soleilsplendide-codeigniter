<div class="page_body SS_bg_design">

    <div class="search_blog_total SS_info_success"><?php echo $all_count; ?>&nbsp;&nbsp;&nbsp;&nbsp;Results</div>

    <div class="search_blog_result">
        <table id="table_list_blogs" class="table_list_blogs_style">
            <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php if (is_array($list_articles['articles'])) : ?>
                <?php foreach ($list_articles['articles'] as $key => $value): ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url('blog/index/' . $value['id'] . ''); ?>"><?php echo $value["title"] ?></a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('blog/index/' . $value['id'] . ''); ?>"><?php echo $value["content"] ?></a>
                        </td>
                        <td><?php echo $value["createtime"] ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript"
        src="<?php echo base_url("includes/javascripts/events/event-public-blog-list.js"); ?>"></script>
