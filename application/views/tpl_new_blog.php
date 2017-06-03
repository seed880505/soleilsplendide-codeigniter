<div class="page_body">

    <!-- OF COURSE YOU NEED TO ADAPT ACTION TO WHAT PAGE YOU WANT TO LOAD WHEN HITTING "SAVE" -->
    <div class="rich_editor_style">

        <!--Buttons-->
        <div class="buttons_panel">
            <input class="new_blog_button" data-type="publish" type="button" value="Save and publish">
            <input class="new_blog_button" data-type="draft" type="button" value="Save to drafts">
        </div>


        <!--  JQUERY UI TABS -->
        <div id="new_blog_tabs" class="editor_panel">
            <ul>
                <li><a href="#tabs-1">Title</a></li>
                <li><a href="#tabs-2">Content</a></li>
            </ul>

            <div id="tabs-1">
                <label>
                    Title of the article:
                    <textarea cols="70" placeholder="Please write your title here"
                              id="blog_title"><?php if (isset($blog_data)) echo $blog_data['title']; ?></textarea>
                </label>
            </div>

            <div id="tabs-2">
                <label>
                    Content of the article:
                    <textarea placeholder="Please write your content here" id="blog_content"></textarea>
                </label>
            </div>

        </div>
    </div>


    <input type="hidden" id="blog_id" data-id="<?php if (isset($blog_data)) echo $blog_data['id']; ?>">

</div>

<?php
if (isset($blog_data)) {
    ?>
    <script>
        SOLEIL.Global.blogContent = '<?php if (isset($blog_data)) echo $blog_data['content']; ?>';
    </script>
<?php
}
?>

<script type="text/javascript" src="<?php echo base_url("includes/tinymce/tinymce.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("includes/javascripts/events/event-new-blog.js"); ?>"></script>
