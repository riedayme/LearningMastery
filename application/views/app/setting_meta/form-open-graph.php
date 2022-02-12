<div class="c-field u-mb-small col-md-6">
    <label class="c-field__label">Recent open_graph_default_image : </label>
    <img style="width: 120px" src="<?php echo base_url('storage/uploads/site/thumbnail/'.$meta['open_graph']['default_image']) ?>" alt="open_graph_default_image">
</div>

<div class="c-field u-mb-small col-md-6">
    <label class="c-field__label">New open_graph_default_image (optional) : </label>
    <input type="hidden" name="<?php echo 'open_graph_default_image' ?>_old" value="<?php echo $meta['open_graph']['default_image'] ?>">
    <input class="c-input" name="<?php echo 'open_graph_default_image' ?>" type="file">
</div>                          

<div class="c-field u-mb-small col-md-12">
    <label class="c-field__label">open_graph_app_id : </label>
    <input class="c-input" name="<?php echo 'open_graph_app_id' ?>" type="text" value="<?php echo $meta['open_graph']['app_id'] ?>">
</div>      

<div class="c-field u-mb-small col-md-12">
    <label class="c-field__label">open_graph_publisher : </label>
    <input class="c-input" name="<?php echo 'open_graph_publisher' ?>" type="text" value="<?php echo $meta['open_graph']['publisher'] ?>">
</div>      

<div class="c-field u-mb-small col-md-12">
    <label class="c-field__label">open_graph_author : </label>
    <input class="c-input" name="<?php echo 'open_graph_author' ?>" type="text" value="<?php echo $meta['open_graph']['author'] ?>">
</div>      
