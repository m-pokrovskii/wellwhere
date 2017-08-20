<?php
  $payment_link = page_link_by_file('page-payment-step-2.php')
 ?>
<form
  data-redirect="<?php echo $payment_link ?>"
  data-add-basket-form action="<?php echo $payment_link ?>"
  method="POST"
  class="PriceBlock">
  <div class="ui sticky">
    <div class="PriceBlock__title">
      Notre offre
    </div>
    <div class="PriceBlock__price-list">
      <input type="hidden" name="gym_id" value="<?php echo $post->ID ?>">
      <?php if ( have_rows('gym_tickets') ): ?>
        <?php $i = 0 ?>
        <?php while ( have_rows('gym_tickets') ) : the_row() ?>
          <?php
            $ticket_title = get_sub_field('gym_ticket_title');
            $ticket_price = get_sub_field('gym_ticket_price');
            $ticket_value = get_sub_field('gym_ticket_value');
            $ticket_period = get_sub_field('gym_ticket_period');
            $ticket_available_for = get_sub_field('gym_ticket_available_for');
           ?>
          <div class="PriceBlock__row">
            <div class="PriceBlock__ticket ui radio checkbox">
              <input
                type="radio"
                name="ticket_id"
                value="<?php echo $i ?>"
                <?php if ($i === 0): ?>
                  <?php echo 'checked' ?>
                <?php endif; ?>>
              <label for="ticket-<?php echo $i ?>">
                <?php echo $ticket_title; ?>
              </label>
            </div>
            <div class="PriceBlock__price">
              <?php _e("CHF") ?> <?php echo $ticket_price; ?>
            </div>
          </div>
          <?php $i++ ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <div class="PriceBlock__buy-button">
      <button data-add-basket type="submit" class="PriceBlock__button">Choisir ce Pass</button>
    </div>
  </div>
</form>
