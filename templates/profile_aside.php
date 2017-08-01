<?php 
	$curruser       = wp_get_current_user();
	$avatar_url     = get_avatar_url( $curruser->ID );
	$image_path     = get_stylesheet_directory_uri() . "/assets";
	$user_avatar_id = get_user_meta( $curruser->ID, 'avatar_id', true );
	$user_avatar    = wp_get_attachment_image_src( $user_avatar_id, 'user-avatar' );
?>

<div class="ProfilePage__aside">
	<div class="Profile__user-meta">
		<div class="Profile__avatar" style="background-image: url(<?php echo $user_avatar[0] ?>);">
			<div class="Profile__avatar-hover">
				<a class="Profile__avatar-change" href="#">
					<label for="ProfileUploadForm__image" class="ProfileUploadForm__image-label">
						<img src="<?php echo $image_path ?>/img/icon-gear.png" alt="">
						<input
						class="ProfileUploadForm__image"
						type="file"
						multiple=false
						id="ProfileUploadForm__image"
						accept= ".jpg, .jpeg, .png"
						name="profile_upload_avatar">
					</label>
				</a>
				<a data-profile-avatar-delete class="Profile__avatar-delete" href="#">
					<img src="<?php echo $image_path ?>/img/icon-trash.png" alt="">
				</a>
			</div>
		</div>
		<div data-profile-avatar-message class="ProfileAvatarMessage ui message error mini"></div>
		<div class="Profile__user-name">
			<?php echo "$curruser->first_name $curruser->last_name" ?>
		</div>
		<div class="Profile__user-desc">
			<?php _e('Membre depuis le', 'wellwhere') ?>
			<?php echo date_format ( date_create( $curruser->user_registered ), "d.m.Y") ?>
		</div>
	</div>
	<ul class="Profile__menu ProfileMenu">
		<li><a class="active" href="#profile">Profil</a></li>
		<li><a href="#pass">Pass</a></li>
		<li><a href="#comments">Commentaires</a></li>
		<li><a href="#favorites">Favorits</a></li>
	</ul>
</div>