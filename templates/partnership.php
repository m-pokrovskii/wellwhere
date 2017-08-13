<div class="PartnershipPage">
  <div data-check-pass class="PartnershipValidator">
    <div class="PartnershipValidator__title">
      <?php _e('Valider le Pass') ?>
    </div>
    <div class="PartnershipValidator__desc">
      <?php _e('entrez le code present sur le pass du client dans la barre ci-dessous:') ?>
    </div>
    <form data-check-pass-form action="" class="ui form PartnershipValidator__form">
      <div class="ui field">
        <label for=""><?php _e('Ticket Pass') ?></label>
        <input
          class="PartnershipValidator__input-text"
          name="partnership_validator_pass"
          id="partnership-validator-pass"
          type="password"
          placeholder="<?php _e("p.ex.:0K98jO387") ?>"
        >
      </div>
      <div class="ui field">
        <label for=""><?php _e('Gym Pass') ?></label>
        <input
          class="PartnershipValidator__input-text"
          name="partnership_gym_pass"
          id="partnership-gym-pass"
          type="password"
          placeholder="<?php _e('Gym Password') ?>"
        >
      </div>
      <div class="PartnershipValidator__form-message ui message mini error"></div>
      <button class="ui button PartnershipValidator__input-submit" type="submit"><?php _e('Valider >') ?></button>
    </form>
  </div>
  <div data-check-pass-valid class="PartnershipValidator -valid">
    <div class="PartnershipValidator__title">
      Pass validé!
    </div>
    <div class="PartnershipValidator__info">
      <div class="PartnershipValidator__info-title"><?php _e("Informations: ") ?></div>
      <div class="PartnershipValidator__info-text">
        <p class="PartnershipValidator__info-name"><?php _e("Nom: ") ?>
          <span class="PartnershipValidator__holder"></span>
        </p>
        <p class="PartnershipValidator__info-entries"><?php _e("Entrées restantes: ") ?>
          <span class="PartnershipValidator__entries-remain"></span>
        </p>
        <p class="PartnershipValidator__info-expire-date"><?php _e("Date d'expiration: ") ?>
          <span class="PartnershipValidator__expire-date"></span>
        </p>
      </div>
    </div>
  </div>
  <div data-check-pass-expire class="PartnershipValidator -expire">
    <div class="PartnershipValidator__title">
      <?php _e("Passe expirée!") ?>
    </div>
    <div class="PartnershipValidator__info">
      <div class="PartnershipValidator__info-title"><?php _e("Informations:") ?></div>
      <div class="PartnershipValidator__info-text">
        <p class="PartnershipValidator__info-name"><?php _("Nom: ") ?>
          <span class="PartnershipValidator__holder"></span>
        </p>
        <p class="PartnershipValidator__info-entries"><?php _e("Entrées restantes: ") ?>
          <span class="PartnershipValidator__entries-remain"></span>
        </p>
        <p class="PartnershipValidator__info-expire-date"><?php _e("Date d'expiration: ") ?>
          <span class="PartnershipValidator__expire-date"></span>
        </p>
      </div>
    </div>
  </div>
  <div data-check-pass-no-found class="PartnershipValidator -no-found">
    <div class="PartnershipValidator__title">
      <?php _e('No found') ?>
    </div>
  </div>
  <div class="PartnershipPage__content">
    <div class="PartnershipHelp">
      <div class="PartnershipHelp__title">
        <?php _e("Comment valider un Pass ?") ?>
      </div>
      <div class="PartnershipHelp__list">
        <div class="PartnershipHelp__item">
          <div class="PartnershipHelp__item-title">
            <?php _e("1. Lorem ipsum") ?>
          </div>
          <div class="PartnershipHelp__item-desc">
            <?php _e("At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri, miraberis numquam antea visus summatem virum tenuem te sic enixius observantem, ut paeniteat ob haec bona tamquam praecipua non vidisse ante decennium Romam.") ?>
          </div>
        </div>
        <div class="PartnershipHelp__item">
          <div class="PartnershipHelp__item-title">
            <?php _e("2. Lorem ipsum") ?>
          </div>
          <div class="PartnershipHelp__item-desc">
            <?php _e("At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri, miraberis numquam antea visus summatem virum tenuem te sic enixius observantem, ut paeniteat ob haec bona tamquam praecipua non vidisse ante decennium Romam.") ?>
          </div>
        </div>
      </div>
    </div>
    <div class="PartnershipContact">
      <div class="PartnershipContact__title">
        <?php _e("Contact") ?>
      </div>
      <div class="PartnershipContact__desc">
        <?php _e("At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris.") ?>
      </div>
      <div class="PartnershipContact__contacts">
        <div class="PartnershipContact__row">
          <div class="PartnershipContact__contacts-title">
            <?php _e("Support Wellwhere") ?>
          </div>
          <div class="PartnershipContact__contacts-desc">
            <?php _e("Du lundi au vendredi") ?>
          </div>
        </div>
        <div class="PartnershipContact__row -phone">
          <div class="PartnershipContact__label">
            <?php _e("par téléphone") ?>
          </div>
          <div class="PartnershipContact__contact-data">
            <?php _e("+41 21 837 76 46") ?>
          </div>
        </div>
        <div class="PartnershipContact__row -email">
          <div class="PartnershipContact__label">
            <?php _e("ou par email") ?>
          </div>
          <div class="PartnershipContact__contact-data">
            <?php _e("support@wellwhere.com") ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
