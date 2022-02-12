<div class="c-field u-mb-small col-md-6">
    <label class="c-field__label">Recent twitter_card_default_image : </label>
    <img style="width: 120px" src="<?php echo base_url('storage/uploads/site/thumbnail/'.$meta['twitter_card']['default_image']) ?>" alt="twitter_card_default_image">
</div>

<div class="c-field u-mb-small col-md-6">
    <label class="c-field__label">New twitter_card_default_image (optional) : </label>
    <input type="hidden" name="twitter_card_default_image_old" value="<?php echo $meta['twitter_card']['default_image'] ?>">
    <input class="c-input" name="twitter_card_default_image" id="twitter_card_default_image" type="file">
</div>                              

<div class="c-field u-mb-small col-md-12">
    <label class="c-field__label">twitter_card_publisher : </label>
    <input class="c-input" name="twitter_card_publisher" type="text" value="<?php echo $meta['twitter_card']['publisher'] ?>">
</div>      