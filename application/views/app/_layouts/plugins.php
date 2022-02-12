<?php defined('BASEPATH') or exit('No direct script access allowed');  ?>

<?php if (!empty($onbeforeunload)): ?>
    <script src="<?php echo base_url('storage/assets/app/js/plugins/onbeforeunload.js') ?>"></script>
<?php endif ?>

<?php if (!empty($datatable)): ?>
    <script src="<?php echo base_url('storage/assets/app/js/plugins/mydatatables.js') ?>"></script>
    <script>
        datatables_serverside(<?php echo trim($datatables_data) ?>);
    </script>
<?php endif ?>

<?php if (!empty($page_view_country)): ?>
    <script src="<?php echo base_url('storage/assets/app/js/plugins/jvm.js') ?>"></script>
    <script>
        jvector_map(<?php echo $page_view_country ?>);
    </script>
<?php endif ?>

<?php if (!empty($statistic_chart_js)): ?>
    <script src="<?php echo base_url('storage/assets/app/js/plugins/chart.js') ?>"></script>
    <script>
        statistic_chart_js(<?php echo $statistic_chart_js_label ?>,<?php echo $statistic_chart_js_data ?>);
    </script>
<?php endif ?>

<?php if (!empty($datetimepicker)): ?>
    <link rel="stylesheet" href="<?php echo base_url('storage/plugins-f/jquery-datetimepicker/jquery.datetimepicker.min.css') ?>">
    <script src="<?php echo base_url('storage/plugins-f/jquery-datetimepicker/jquery.datetimepicker.full.min.js') ?>"></script>
    <script>
        jQuery.datetimepicker.setLocale('id');
        jQuery('#datetimepicker').datetimepicker({
            format: 'Y-m-d H:i',
        });
    </script>
<?php endif?>

<?php if (!empty($ckeditor)): ?>
    <style>
    .cke_maximized .cke_toolbar_break {
        display: inline-block;
    }
    .cke_bottom {
        padding: 15px 0 0;
    }
</style>
<script src="<?php echo base_url('storage/plugins-f/ckeditor/ckeditor.js') ?>"></script>
<script>
        let //ck_contentsCs = <?php echo base_url(CSS_POST) ?>,
        ck_filebrowserBrowseUr = "<?php echo base_url(PATH_FILE_MANAGER."?type=1&relative_url=0&editor=ckeditor&multiple=0&akey=".$this->session->userdata('key')) ?>",
        ck_filebrowserImageBrowseUr = "<?php echo base_url(PATH_FILE_MANAGER."?type=1&relative_url=0&editor=ckeditor&multiple=0&akey=".$this->session->userdata('key')) ?>",
        ck_filebrowserImageBrowseLinkUr = "<?php echo base_url(PATH_FILE_MANAGER."?type=1&relative_url=0&editor=ckeditor&multiple=0&akey=".$this->session->userdata('key')) ?>";
    </script>
    <script src="<?php echo base_url('storage/assets/app/js/plugins/ckeditor.js') ?>"></script>
<?php endif ?>

<?php if (!empty($codemirror)): ?>
    <link rel="stylesheet" href="<?php echo base_url('storage/plugins-f') ?>/codemirror/lib/codemirror.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('storage/plugins-f') ?>/codemirror/theme/github.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/display/fullscreen.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/hint/show-hint.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/dialog/dialog.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/scroll/simplescrollbars.css" type="text/css"/>

    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/lib/codemirror.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/fold/xml-fold.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/edit/matchtags.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/edit/closetag.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/edit/closebrackets.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/selection/active-line.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/display/fullscreen.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/hint/show-hint.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/hint/xml-hint.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/hint/html-hint.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/dialog/dialog.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/search/searchcursor.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/search/search.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/addon/scroll/simplescrollbars.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/mode/clike/clike.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/mode/css/css.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/mode/javascript/javascript.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/mode/php/php.js"></script>
    <script src="<?php echo base_url('storage/plugins-f') ?>/codemirror/mode/xml/xml.js"></script>

    <script src="<?php echo base_url('storage/assets/app/js/plugins/codemirror.js') ?>"></script>
<?php endif ?>


<?php if (!empty($dragula)): ?>
    <link href="<?php echo base_url('storage/plugins-f') ?>/dragula/dragula.min.css" rel="stylesheet">
    <script src="<?php echo base_url('storage/plugins-f') ?>/dragula/dragula.min.js"></script>
    <!-- Init Dragula -->
    <script type="text/javascript">

        $(".btn-lesson-sort").click(function(){

            var id = $(this).data('id');
            var section_id = 'lesson-list-' + id;            

            var containerArray = [section_id];
            var itemArray = [];
            var itemJSON;
            for(var i = 0; i < containerArray.length; i++) {
                $('#'+containerArray[i]).each(function () {
                    $(this).find('.draggable-item-' + id).each(function() {
                        itemArray.push(this.id);
                    });
                });
            }

            itemJSON = JSON.stringify(itemArray);
            console.log(itemJSON); 

            $(".input-lesson-order-" + id).val(itemArray);    

            $("#form-lesson-sort-" + id).submit(); 
        });    

        $("#btn-section-sort").click(function(){        

            var containerArray = ['section-list'];
            var itemArray = [];
            var itemJSON;
            for(var i = 0; i < containerArray.length; i++) {
                $('#'+containerArray[i]).each(function () {
                    $(this).find('.draggable-item').each(function() {
                        itemArray.push(this.id);
                    });
                });
            }

            itemJSON = JSON.stringify(itemArray);
            console.log(itemJSON); 

            $(".input-section-order").val(itemArray);    

            $("#form-section-sort").submit(); 
        });

        ! function(r) {
            "use strict";
            var a = function() {
                this.$body = r("body")
            };
            a.prototype.init = function() {
                r('[data-plugin="dragula"]').each(function() {
                    var a = r(this).data("containers"),
                    t = [];
                    if (a)
                        for (var n = 0; n < a.length; n++) t.push(r("#" + a[n])[0]);
                            else t = [r(this)[0]];
                        var i = r(this).data("handleclass");
                        i ? dragula(t, {
                            moves: function(a, t, n) {
                                return n.classList.contains(i)
                            }
                        }) : dragula(t)
                    })
            }, r.Dragula = new a, r.Dragula.Constructor = a
        }(window.jQuery),
        function(a) {
            "use strict";
            window.jQuery.Dragula.init()
        }();
    </script>
<?php endif ?>

<?php if (!empty($fontawesomepicker)): ?>    
    <link href="<?php echo base_url('storage/plugins-f') ?>/font-awesome-iconpicker/simple-iconpicker.min.css" rel="stylesheet">
    <script src="<?php echo base_url('storage/plugins-f') ?>/font-awesome-iconpicker/simple-iconpicker.min.js"></script>
    <script type="text/javascript">
        $('.icon-picker').iconpicker(".icon-picker");
    </script>
<?php endif ?>