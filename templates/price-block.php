<form action="<?php echo get_permalink(83) ?>" class="PriceBlock">
  <div class="ui sticky">
    <div class="PriceBlock__title">
      Notre offre
    </div>
    <div class="PriceBlock__price-list">
      <input type="hidden" name="gym_id" value="<?php echo $post->ID ?>">
      <?php if ( have_rows('gym_tickets') ): ?>
        <?php while ( have_rows('gym_tickets') ) : the_row() ?>
          <?php
            $i++;
            $ticket_title = get_sub_field('gym_ticket_title');
            $ticket_price = get_sub_field('gym_ticket_price');
           ?>
          <div class="PriceBlock__row">
            <div class="PriceBlock__ticket ui radio checkbox">
              <input
                type="radio"
                name="ticket_id"
                value="<?php echo $i ?>"
                <?php if ($i === 1): ?>
                  <?php echo 'checked' ?>
                <?php endif; ?>>
              <label for="ticket-<?php echo $i ?>">
                <?php echo $ticket_title; ?>
              </label>
            </div>
            <div class="PriceBlock__price">
              CHF <?php echo $ticket_price; ?>.-
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <div class="PriceBlock__buy-button">
      <button type="submit" class="PriceBlock__button">Choisir ce Pass</button>
    </div>
  </div>
</form>
