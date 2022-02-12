<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
    <form method="POST" enctype="multipart/form-data">

        <div class="col-12 col-xl-6 offset-xl-3 u-mv-small">

            <?php $this->load->view('app/_layouts/alert'); ?>

            <div class="c-card c-card--responsive u-p-zero">
                <div class="c-card__header o-line">   
                    <h5 class="c-card__title">  
                        <?php  echo $title; ?>
                    </h5>     
                    <?php if (!empty($user)): ?>
                        <input type="hidden" name="id" value="<?php echo (!empty($user['id']) ? $user['id'] : '') ?>">
                    <?php endif ?>  

                    <button class="c-btn c-btn--info c-btn--custom" type="submit">
                        <i class="fa fa-save"></i>
                    </button>
                </div>
                <div class="c-card__body">   

                    <div class="u-text-center u-mb-medium">
                        <div class="c-avatar c-avatar--xlarge u-inline-block">
                            <img class="c-avatar__img" src="<?php echo (!empty($user['photo']) ?  base_url('storage/uploads/user/photo/'.$user['photo']) : base_url('storage/uploads/user/photo/default.png')) ?>" alt="<?php echo $this->session->userdata('username') ?>">
                        </div>

                        <div class="row">
                            <div class="col-10 col-md-4 col-sm-6 offset-md-4 offset-sm-3 offset-1">
                                <label class="c-field__label">                              
                                    <?php echo $this->lang->line('change_photo') ?>
                                </label>
                                <input type="hidden" name="photo_old" value="<?php echo (!empty($user['photo'])) ? $user['photo'] : '' ?>" class="c-input">
                                <input name="photo" class="c-input" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label">username</label>
                        <input required="" name="username" class="c-input" type="text" value="<?php echo (!empty($user['username'])) ? (!empty(set_value('username')) ? set_value('username') : $user['username'] ) : set_value('username') ?>"/>
                        <?php echo form_error('username', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label">email</label>
                        <input <?php echo ($this->session->userdata('app_grade') == 'Instructor') ? 'readonly' : '' ?> required="" name="email" class="c-input" type="email" value="<?php echo (!empty($user['email'])) ? (!empty(set_value('email')) ? set_value('email') : $user['email'] ) : set_value('email') ?>"/>
                        <?php if (!empty($user)): ?>
                            <small class="u-text-mute">
                            <?php echo $this->lang->line('note_email') ?>
                            </small>
                        <?php endif ?>
                        <?php echo form_error('email', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?>
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label">no_handphone</label>
                        <input required="" name="no_handphone" class="c-input" type="number" value="<?php echo (!empty($user['no_handphone'])) ? (!empty(set_value('no_handphone')) ? set_value('no_handphone') : $user['no_handphone'] ) : set_value('no_handphone') ?>"/>
                        <?php echo form_error('no_handphone', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
                    </div>

                    <div class="u-mb-small">
                        <label class="c-field__label">New Password</label>
                        <div class="c-field has-addon-right">
                            <input autocomplete="new-password" id='new_password' name="new_password" class="c-input" type="password">
                            <button tabindex="-1" type="button" class="c-field__addon" onclick="toggle('new_password',this)">
                                <i class="fa fa-eye-slash"></i>
                            </button>
                        </div>
                        <?php if (!empty($user)): ?>
                            <small class="u-text-mute">
                                <?php echo $this->lang->line('note_password') ?>
                            </small>
                        <?php endif ?>
                        <?php echo form_error('new_password', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
                    </div>


                    <div class="c-field u-mb-small">
                        <label class="c-field__label">headline</label>
                        <input required="" name="headline" class="c-input" type="text" value="<?php echo (!empty($user['headline'])) ? (!empty(set_value('headline')) ? set_value('headline') : $user['headline'] ) : set_value('headline') ?>"/>
                        <?php echo form_error('headline', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
                    </div>

                    <?php if ($this->session->userdata('app_grade') != 'Instructor'): ?>
                        <?php if (empty($user) OR !empty($user) AND $user['grade'] != 'App'): ?>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label">grade : </label>
                                <select required="" name="grade" class="c-select select2" data-placeholder='select'>
                                    <option value=""></option>
                                    <option <?php echo (!empty($user['grade']) AND $user['grade'] == 'User') ? 'selected' : ''; ?> value="User">User</option>
                                    <option <?php echo (!empty($user['grade']) AND $user['grade'] == 'Instructor') ? 'selected' : ''; ?> value="Instructor">Instructor</option>
                                </select>
                            </div>

                            <div class="c-toggle u-mb-small">
                                <div class="c-toggle__btn <?php echo (!empty($user['status'])) ? ($user['status'] == 'Active') ? 'is-active' : '' : 'is-active'?>">
                                    <label class="c-toggle__label" for="Active">
                                        <input value="Active" class="c-toggle__input" id="Active" name="status" type="radio" <?php echo (!empty($user['status'])) ? ($user['status'] == 'Active') ? 'checked' : '' : 'checked'?>>Active
                                    </label>
                                </div>

                                <div class="c-toggle__btn <?php echo (!empty($user['status'])) ? ($user['status'] == 'Blocked') ? 'is-active' : '' : ''?>">
                                    <label class="c-toggle__label" for="Blocked">
                                        <input value="Blocked" class="c-toggle__input" id="Blocked" name="status" type="radio" <?php echo (!empty($user['status'])) ? ($user['status'] == 'Blocked') ? 'checked' : '' : '' ?>>Blocked
                                    </label>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>

                </div>
            </div>

        </div>

    </form>
</div>

<?php $this->load->view('app/_layouts/footer'); ?>