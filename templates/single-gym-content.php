<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="SinglePage__content-container">
  <div class="SignlePage__headline ui sticky">
      <div class="SignlePage__headline-title">
        <?php the_title() ?>
      </div>
      <div class="SinglePage__headling-meta">
        <div class="SinglePage__headling-meta-address">
          <?php
            $zips = wp_get_post_terms($post->ID, 'zip');
            $zip = $zips[0];
          ?>
          <?php echo $zip->name ?>
        </div>
        <div class="GymRating SinglePage__headling-meta-rating ui rating" data-rating="4" data-max-rating="5"></div>
      </div>
  </div>
  <div class="SignlePage__columns_container">
    <div class="SignlePage__sidebar -left">
      <ul class="ContentMenu ui sticky">
        <li><a href="#description">Description</a></li>
        <li><a href="#photos">Photos</a></li>
        <li><a href="#details">Horaires</a></li>
        <li><a href="#map">Plan</a></li>
        <li><a href="#comments">Commentaires (21)</a></li>
      </ul>
    </div>
    <div class="SignlePage__sidebar -center">
      <?php get_template_part('templates/price-block') ?>
      <div class="SingleMainContent">
        <div class="ui accordion">
          <div class="active title">
            Description
          </div>
          <div id="description" class="active content">
            <div class="SingleMainContent__description">
              <?php the_content() ?>
            </div>
          </div>
          <div class="active title">
            Photos
          </div>
          <div id="photos" class="active content">
            <?php get_template_part('templates/single-gym-gallery') ?>
          </div>
          <div class="active title">
            Horaires
          </div>
          <div id="details" class="active content">
            <div class="SingleMainContent__additional-details">
              <p>Lundi-Vendredi: <?php echo get_field('gym_date_monday_friday') ?></p>
              <p>Samedi: <?php echo get_field('gym_date_saturday') ?></p>
              <p>Dimanche: <?php echo get_field('gym_date_sunday') ?></p>
            </div>
          </div>
          <div class="active title">
            Plan
          </div>
          <div id="map" class="active content">
            <?php get_template_part('templates/single-map'); ?>
          </div>
          <div class="active title last">
            Commentaires
          </div>
          <div id="comments" class="active content">
              <div class="SingleMainContent__comments Comments">
              <div class="Comments__header">
                <div class="Comments__comments-amount">21 Commentaires</div>
                <div class="GymRating Comments__ratings ui rating star"></div>
              </div>
              <div class="Comments__body">
                <div class="Comment Comments__item">
                  <div class="Comment__meta">
                    <div class="Comment__avatar" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/assets/img/comment-avatar.png)"></div>
                    <div class="Comment__name">Marie M.</div>
                  </div>
                  <div class="Comment__body">
                    <div class="Comment__title">
                      Un Staff motivé et une bonne énérgie
                    </div>
                    <div data-show-more class="Comment__description">
                      <div class="Comment__description-short">
                        <p>Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?</p>
                        <p>
                          Circa hos dies Lollianus primae lanuginis adulescens, Lampadi filius ex praefecto, exploratius causam Maximino spectante, convictus codicem noxiarum artium nondum per aetatem firmato consilio descripsisse, exulque mittendus, ut sperabatur, patris inpulsu provocavit ad principem, et iussus ad eius comitatum duci, de fumo, ut aiunt, in flammam traditus Phalangio Baeticae consulari cecidit funesti carnificis manu...
                          <a class="Comment__read-more" data-show-more-link href="#">Lire plus.</a>
                        </p>
                      </div>
                      <div class="Comment__description-long">
                        <p>Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?</p>
                        <p>
                          Circa hos dies Lollianus primae lanuginis adulescens, Lampadi filius ex praefecto, exploratius causam Maximino spectante, convictus codicem noxiarum artium nondum per aetatem firmato consilio descripsisse, exulque mittendus, ut sperabatur, patris inpulsu provocavit ad principem, et iussus ad eius comitatum duci, de fumo, ut aiunt, in flammam traditus Phalangio Baeticae consulari cecidit funesti carnificis manu...
                        </p>
                        <p>
                          Circa hos dies Lollianus primae lanuginis adulescens, Lampadi filius ex praefecto, exploratius causam Maximino spectante, convictus codicem noxiarum artium nondum per aetatem firmato consilio descripsisse, exulque mittendus, ut sperabatur, patris inpulsu provocavit ad principem, et iussus ad eius comitatum duci, de fumo, ut aiunt, in flammam traditus Phalangio Baeticae consulari cecidit funesti carnificis manu...
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="Comment Comments__item">
                  <div class="Comment__meta">
                    <div class="Comment__avatar" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/assets/img/comment-avatar.png)"></div>
                    <div class="Comment__name">Marie M.</div>
                  </div>
                  <div class="Comment__body">
                    <div class="Comment__title">
                      Un Staff motivé et une bonne énérgie
                    </div>
                    <div class="Comment__description">
                      <p>Quam ob rem id primum videamus, si placet, quatenus amor in amicitia progredi debeat. Numne, si Coriolanus habuit amicos, ferre contra patriam arma illi cum Coriolano debuerunt? num Vecellinum amici regnum adpetentem, num Maelium debuerunt iuvare?</p>

                      <p>
                        Circa hos dies Lollianus primae lanuginis adulescens, Lampadi filius ex praefecto, exploratius causam Maximino spectante, convictus codicem noxiarum artium nondum per aetatem firmato consilio descripsisse, exulque mittendus, ut sperabatur, patris inpulsu provocavit ad principem, et iussus ad eius comitatum duci, de fumo, ut aiunt, in flammam traditus Phalangio Baeticae consulari cecidit funesti carnificis manu...
                      </p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="Comments__load-more">
                <span class="Comments__load-more-text">Plus anciens</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
