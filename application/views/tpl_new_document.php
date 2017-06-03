<div class="page_body">


    <!-- OF COURSE YOU NEED TO ADAPT ACTION TO WHAT PAGE YOU WANT TO LOAD WHEN HITTING "SAVE" -->
    <div class="rich_editor_style">
        <form method="post" action="<?php echo site_url('file/save_file'); ?>">

            <input id="publish" type="button" value="Save and publish"/>
            <input id="draft" type="button" value="Save to drafts"/>
            <input type="hidden" name="direction" value="">
            <!--  JQUERY UI TABS -->
            <div id="tabs">

                <ul>
                    <li><a href="#tabs-1">File</a></li>

                </ul>

                <div id="tabs-1">
                    <div id='title_blog'>
                        New file:
                    </div>
                    <textarea name="content" style="width:100%;height:900px"></textarea>
                </div>

            </div>

        </form>
    </div>


</div>


<script type="text/javascript" src="<?php echo base_url("includes/tinymce/jscripts/tiny_mce/tiny_mce.js"); ?>"></script>
<script type="text/javascript"
        src="<?php echo base_url("includes/javascripts/events/event-new-document.js"); ?>"></script>
