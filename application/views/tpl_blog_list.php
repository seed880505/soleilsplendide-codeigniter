<div class="page_body SS_bg_design">

    <div class="search_blog_total SS_info_success"><?php echo $all_count; ?>&nbsp;&nbsp;&nbsp;&nbsp;Results</div>

    <div class="search_blog_result">
        <table id="list_table" class="table_list_blogs_style">
            <thead>
            <tr>
                <th>Operation</th>
                <th>Title</th>
                <th>Content</th>
                <th>Status</th>
                <th>Create Date</th>
                <th>Last Modified</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($list_articles)) {
                foreach ($list_articles['articles'] as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <select class="user_operation" data-article="<?php echo $key ?>">
                                <option value="">--choose--</option>

                                <?php if ($value['status'] == "draft"): ?>
                                    <option value="publish">Publish</option>
                                <?php elseif ($value['status'] == "publish"): ?>
                                    <option value="draft">Draft</option>
                                <?php endif ?>

                                <option value="edit">Edit</option>
                                <option value="delete">Delete</option>
                            </select>
                        </td>
                        <td><a target="_blank"
                               href="<?php echo site_url('blog/index/' . $value['id'] . ''); ?>"><?php echo $value['title'] ?>
                        </td>
                        <td><a target="_blank"
                               href="<?php echo site_url('blog/index/' . $value['id'] . ''); ?>"><?php echo $value['content'] ?>
                        </td>
                        <td><?php echo $value['status'] ?></td>
                        <td><?php echo $value['createtime'] ?></td>
                        <td><?php echo $value['lastmodifiedtime'] ?></td>
                    </tr>
                <?
                }
            } ?>

            </tbody>
        </table>
    </div>


</div>


<script type="text/javascript" src="<?php echo base_url("includes/javascripts/events/event-blog-list.js"); ?>"></script>
