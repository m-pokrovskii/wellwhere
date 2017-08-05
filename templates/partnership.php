<div class="PartnershipPage">
  <div data-check-pass class="PartnershipValidator">
    <div class="PartnershipValidator__title">
      Valider le Pass
    </div>
    <div class="PartnershipValidator__desc">
      entrez le code present sur le pass du client dans la barre ci-dessous:
    </div>
    <form data-check-pass-form action="" class="ui form PartnershipValidator__form">
      <div class="ui inline field">
        <div class="ui action input">
          <input
            class="PartnershipValidator__input-text"
            name="partnership_validator_pass"
            id="partnership-validator-pass"
            type="password"
            placeholder="p.ex.:0K98jO387"
          >
          <button class="ui button PartnershipValidator__input-submit" type="submit"><?php _e('Valider >') ?></button>
        </div>
      </div>
      <div class="PartnershipValidator__form-message">
        <div class="ui message mini error"></div>
      </div>
    </form>
  </div>
  <div data-check-pass-valid class="PartnershipValidator -valid">
    <div class="PartnershipValidator__title">
      Pass validé!
    </div>
    <div class="PartnershipValidator__info">
      <div class="PartnershipValidator__info-title">Informations:</div>
      <div class="PartnershipValidator__info-text">
        <p class="PartnershipValidator__info-name">Nom: 
          <span class="PartnershipValidator__holder"></span>
        </p>
        <p class="PartnershipValidator__info-entries">Entrées restantes: 
          <span class="PartnershipValidator__entries-remain"></span>
        </p>
        <p class="PartnershipValidator__info-expire-date">Date Expire: 
          <span class="PartnershipValidator__expire-date"></span>
        </p>
      </div>
    </div>
  </div>
  <div data-check-pass-expire class="PartnershipValidator -expire">
    <div class="PartnershipValidator__title">
      Passe expirée!
    </div>
    <div class="PartnershipValidator__info">
      <div class="PartnershipValidator__info-title">Informations:</div>
      <div class="PartnershipValidator__info-text">
        <p class="PartnershipValidator__info-name">Nom: 
          <span class="PartnershipValidator__holder"></span>
        </p>
        <p class="PartnershipValidator__info-entries">Entrées restantes: 
          <span class="PartnershipValidator__entries-remain"></span>
        </p>
        <p class="PartnershipValidator__info-expire-date">Date Expire: 
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
        Comment valider un Pass ?
      </div>
      <div class="PartnershipHelp__list">
        <div class="PartnershipHelp__item">
          <div class="PartnershipHelp__item-title">
            1. Lorem ipsum
          </div>
          <div class="PartnershipHelp__item-desc">
            At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri, miraberis numquam antea visus summatem virum tenuem te sic enixius observantem, ut paeniteat ob haec bona tamquam praecipua non vidisse ante decennium Romam.
          </div>
        </div>
        <div class="PartnershipHelp__item">
          <div class="PartnershipHelp__item-title">
            2. Lorem ipsum
          </div>
          <div class="PartnershipHelp__item-desc">
            At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri, miraberis numquam antea visus summatem virum tenuem te sic enixius observantem, ut paeniteat ob haec bona tamquam praecipua non vidisse ante decennium Romam.
          </div>
        </div>
      </div>
    </div>
    <div class="PartnershipContact">
      <div class="PartnershipContact__title">
        Contact
      </div>
      <div class="PartnershipContact__desc">
        At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris.
      </div>
      <div class="PartnershipContact__contacts">
        <div class="PartnershipContact__row">
          <div class="PartnershipContact__contacts-title">
            Support Wellwhere
          </div>
          <div class="PartnershipContact__contacts-desc">
            Du lundi au vendredi
          </div>
        </div>
        <div class="PartnershipContact__row -phone">
          <div class="PartnershipContact__label">
            par téléphone
          </div>
          <div class="PartnershipContact__contact-data">
            +41 21 837 76 46
          </div>
        </div>
        <div class="PartnershipContact__row -email">
          <div class="PartnershipContact__label">
            ou par email
          </div>
          <div class="PartnershipContact__contact-data">
            support@wellwhere.com
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
