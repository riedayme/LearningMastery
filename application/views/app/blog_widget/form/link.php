<div class="c-field u-mb-medium">
    <label><input value="active" name="<?php echo $widget['id'] ?>[status]" type="radio" <?php echo (!empty($widget['data']['status'])) ? ($widget['data']['status'] == 'active') ? 'checked' : '' : 'checked'?>>Active</label>
    <label><input value="nonactive" name="<?php echo $widget['id'] ?>[status]" type="radio" <?php echo (!empty($widget['data']['status'])) ? ($widget['data']['status'] == 'nonactive') ? 'checked' : '' : '' ?>>NonActive</label>
</div>

<div class="c-field u-mb-small">
    <label class="c-field__label">Title : </label>
    <input required="" value="<?php echo $widget['data']['title'] ?>" class="c-input" name="<?php echo $widget['id'] ?>[title]" id="title" type="text" placeholder="title">
</div>

<div class="row master-linking_<?php echo $widget['id'] ?>">

    <div class="u-mb-small col-md-12">
        <label class="c-field__label">Link : </label>
        <button type="button" class='c-btn c-btn--info u-ml-auto' onclick="add_link(<?php echo $widget['id'] ?>)"><i class="fa fa-plus-circle fa-2x"></i></button>
    </div>

    <?php  
    if ($widget['data']['content']) {
        foreach ($widget['data']['content'] as $link) {
            ?>

            <div class="c-field u-mb-small col-md-5 <?php echo $link['text'] ?>">
                <input required="" value="<?php echo $link['text']  ?>" class="c-input" name="<?php echo $widget['id'] ?>[link][text][]" id="<?php echo 'footer_content_text' ?>" type="text" placeholder="<?php echo 'footer_content_text' ?>">
            </div>

            <div class="c-field u-mb-small col-md-5 <?php echo $link['text'] ?>">
                <input required="" value="<?php echo $link['url']  ?>" class="c-input" name="<?php echo $widget['id'] ?>[link][url][]" id="<?php echo 'footer_content_url' ?>" type="text" placeholder="<?php echo 'footer_content_url' ?>">
            </div>

            <div class="c-field u-mb-small col-md-2 <?php echo $link['text'] ?>">
                <button tabindex="0" type="button" class='c-btn c-btn--danger' onclick="remove_link('<?php echo $link['text'] ?>')"><i class="fa fa-minus-circle fa-2x"></i></button>
            </div>

            <?php
        }
    }
    ?>

</div>

<input name="<?php echo $widget['id'] ?>[id]" type="hidden" value="<?php echo $widget['id']  ?>">
<input name="<?php echo $widget['id'] ?>[type]" type="hidden" value="<?php echo $widget['type']  ?>">