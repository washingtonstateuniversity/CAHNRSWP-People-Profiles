<div class="cwp-table-row">
	<div class="cwp-table-cell profile-image">
    	<img src="<?php echo sanitize_text_field( $photo ) ?>" />
    </div>
    <div class="cwp-table-cell profile-contact">
    	<h3><?php echo sanitize_text_field( $first_name ) ?> <?php echo sanitize_text_field( $last_name ) ?></h3>
        <ul>
        	<li><?php echo $position_title ?></li>
            <li><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></li>
            <li><?php echo $phone ?></li>
            <li><?php echo $office ?></li>
        </ul>
    </div>
    <?php if ( ! empty( $atts['bio'] ) ):?>
    <div class="cwp-table-cell profile-bio">
    	<?php switch( $atts['bio'] ){
			case 'department':
			
				$bio = ( isset( $person->bio_department ) ) ? $person->bio_department : '';
				echo $bio;
				break;
		} ?>
    </div>
    <?php endif ?>
</div>