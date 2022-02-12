<header style="background: #fff">
	<div class="container-fluid">
		<div class="row">

			<div class="col-12 u-pv-small c-navbar">

				
				<a class="c-nav__link u-text-bold u-mr-auto" href="<?php echo (!empty($this->session->userdata('user')) ? base_url('user/courses') : base_url('courses-detail/'.$this->uri->segment(2)) ) ?>">
					<i class="fa fa-arrow-left u-mr-xsmall"></i>
					<span class="u-hidden-down@desktop"><?php echo $this->lang->line('back') ?></span>
				</a>

				<h1 class="u-h4 navbar__title u-text-bold u-p-zero">
					<?php echo $courses['title']; ?> 
				</h1>

				<div class="u-ml-auto"></div>
				<?php if (!empty($this->session->userdata('user'))): ?>
					<button class="c-btn c-btn--info u-text-center btn-review" type="button" id='modal-create' data-toggle="modal" data-target="#modal" data-id='<?php echo $courses['id'] ?>' data-action='<?php echo base_url('user/review/read') ?>'>
						<?php echo $this->lang->line('give_review') ?>
					</button>
				<?php endif ?>


			</div>

		</div>
	</div>
</header>
