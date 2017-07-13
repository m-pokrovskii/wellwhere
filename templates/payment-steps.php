<?php
	global $post;
	$steps = array(
		'step_1' => array (
			'template' => 'page-payment-step-1.php',
			'number' => '1',
			'desc' => 'identification',
		),
		'step_2' => array (
			'template' => 'page-payment-step-2.php',
			'number' => '2',
			'desc' => 'mode de paiement',
		),
		'step_3' => array (
			'template' => 'page-payment-step-3.php',
			'number' => '3',
			'desc' => 'confirmation',
		),
	);
 ?>
<div class="PaymentSteps">
	<?php foreach ($steps as $key => $step): ?>
		<a
			href="<?php echo page_link_by_file($step['template']) ?>"
			class="PaymentSteps__step <?php the_active_step($step['template'], $post) ?>" >
			<div class="PaymentSteps__step-number"><?php echo $step['number'] ?></div>
			<div class="PaymentSteps__step-desc"><?php echo $step['desc'] ?></div>
		</a>
	<?php endforeach; ?>
</div>
