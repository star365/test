<?php  
	if( _hui('footer_brand_s') ){
		_moloader('mo_footer_brand', false);
	}
?>

<footer class="footer">
	<div class="container">
		<?php if( _hui('flinks_s') && _hui('flinks_cat') && ((_hui('flinks_home_s')&&is_home()) || (!_hui('flinks_home_s'))) ){ ?>
			<div class="flinks">
				<?php 
					wp_list_bookmarks(array(
						'category'         => _hui('flinks_cat'),
						'category_orderby' => 'slug',
						'category_order'   => 'ASC',
						'orderby'          => 'rating',
						'order'            => 'DESC',
						'show_description' => false,
						'between'          => '',
						'title_before'     => '<strong>',
    					'title_after'      => '</strong>',
						'category_before'  => '',
						'category_after'   => ''
					));
				?>
			</div>
		<?php } ?>
		<?php if( _hui('fcode') ){ ?>
			<div class="fcode">
				<?php echo _hui('fcode') ?>
			</div>
		<?php } ?>
		<p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url() ?>"><?php echo get_bloginfo('name') ?></a> &nbsp; <?php echo _hui('footer_seo') ?></p>
		<?php echo _hui('trackcode') ?>
	</div>
</footer>

<?php if( (is_single() && _hui('post_rewards_s')) && ( _hui('post_rewards_alipay') || _hui('post_rewards_wechat') ) ){ ?>
	<div class="rewards-popover-mask" data-event="rewards-close"></div>
	<div class="rewards-popover">
		<h3><?php echo _hui('post_rewards_title') ?></h3>
		<?php if( _hui('post_rewards_alipay') ){ ?>
		<div class="rewards-popover-item">
			<h4>支付宝扫一扫打赏</h4>
			<img src="<?php echo _hui('post_rewards_alipay') ?>">
		</div>
		<?php } ?>
		<?php if( _hui('post_rewards_wechat') ){ ?>
		<div class="rewards-popover-item">
			<h4>微信扫一扫打赏</h4>
			<img src="<?php echo _hui('post_rewards_wechat') ?>">
		</div>
		<?php } ?>
		<span class="rewards-popover-close" data-event="rewards-close"><i class="fa fa-close"></i></span>
	</div>
<?php } ?>

<?php  
	$roll = '';
	if( is_home() && _hui('sideroll_index_s') ){
		$roll = _hui('sideroll_index');
	}else if( (is_category() || is_tag() || is_search()) && _hui('sideroll_list_s') ){
		$roll = _hui('sideroll_list');
	}else if( is_single() && _hui('sideroll_post_s') ){
		$roll = _hui('sideroll_post');
	}
	if( $roll ){
		$roll = json_encode(explode(' ', $roll));
	}else{
		$roll = json_encode(array());
	}

	_moloader('mo_get_user_rp');
?>
<script>
window.jsui={
	www: '<?php echo home_url() ?>',
	uri: '<?php echo get_stylesheet_directory_uri() ?>',
	ver: '<?php echo THEME_VERSION ?>',
	roll: <?php echo $roll ?>,
	ajaxpager: '<?php echo _hui("ajaxpager") ?>',
	url_rp: '<?php echo mo_get_user_rp() ?>',
	qq_id: '<?php echo _hui('fqq_s') ? _hui('fqq_id') : '' ?>',
	qq_tip: '<?php echo _hui('fqq_s') ? _hui('fqq_tip') : '' ?>'
};
</script>
<?php wp_footer(); ?>

<ul class="m-navbar">
<?php if( is_user_logged_in() ): global $current_user; ?>
	<?php _moloader('mo_get_user_page', false) ?>
	<li id="signup-loader" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="<?php echo mo_get_user_page() ?>" style="text-align: center;"><?php echo _get_the_avatar($user_id=$current_user->ID, $user_email=$current_user->user_email, true); ?>
		<p style="margin-top: 8px;"><?php echo $current_user->display_name ?></p></a>
	</li>
<?php elseif( _hui('user_page_s') ): ?>
	<li id="signin-loader" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="javascript:;" class="signin-loader"><img src="https://secure.gravatar.com/avatar/" class="avatar avatar-100" height="50" width="50">&nbsp; &nbsp;登录 / 注册</a></li>
<?php endif; ?>

<?php _the_menu('nav') ?>
<?php if( !is_search() && ((_hui('pc_search')&&!wp_is_mobile()) || (_hui('m_search')&&wp_is_mobile())) ){ ?>
	<li class="navto-search"><a href="javascript:;" class="search-show active"><i class="fa fa-search"></i></a></li>
<?php } ?>

<?php if( is_super_admin() ){ ?>
	<li id="signin-loader" class="menu-item menu-item-type-custom menu-item-object-custom"><a target="_blank" href="<?php echo site_url('/wp-admin/') ?>"><i class="fa fa-home"></i>后台管理</a></li>
<?php } ?>
</ul>
</body>
</html>