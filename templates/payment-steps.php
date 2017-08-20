<?php
	global $post;
	$was_active = false;
	$steps = array(
		'step_1' => array (
			'template' => 'page-payment-step-2.php',
			'number' => '1',
			'desc' => __("mode de paiement"),
		),
		'step_2' => array (
			'template' => 'page-payment-step-3.php',
			'number' => '2',
			'desc' => __("confirmation"),
		),
	);
 ?>
<div class="PaymentSteps">
	<?php foreach ($steps as $key => $step): ?>
		<?php if ( is_active_step( $step['template'], $post ) ): ?>
			<?php $was_active = true; ?>
		<?php endif ?>
		<div class="PaymentSteps__step <?php the_active_step($step['template'], $post) ?>" >
			<?php if ( $was_active === false ): ?>
				<a href="<?php echo page_link_by_file($step['template']) ?>" class="PaymentSteps__step-number"><?php echo $step['number'] ?></a>	
			<?php else: ?>
				<div class="PaymentSteps__step-number"><?php echo $step['number'] ?></div>
			<?php endif ?>
			<div class="PaymentSteps__step-desc"><?php echo $step['desc'] ?></div>
		</div>
	<?php endforeach; ?>
</div>
