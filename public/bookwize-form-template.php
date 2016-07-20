<?php
/**
 * Created by PhpStorm.
 * User: araksya.kantikyan
 * Date: 2/6/2016
 * Time: 2:21 μμ
 */
?>
<style>
    <?php if(!empty($bwf_input_color)): ?>
    .reservation .fields__item, .reservation-form .form__input {
        background-color: <?php echo $bwf_input_color;?>;
    }
    <?php endif;?>
    <?php if(!empty($bwf_button_color)): ?>
    .reservation  .field__item-button--plus, .reservation  .field__item-button--minus {
        background: <?php echo $bwf_button_color; ?>;
    }
    .reservation  .field__item-button--plus:hover, .reservation  .field__item-button--minus:hover {
        background: <?php echo $bwf_button_color; ?>;
        opacity: 0.5;
    }
    <?php endif; ?>
    <?php if(!empty($bwf_small_edition) && ($bwf_small_edition === '1' || $bwf_small_edition === 'true')) :?>
    .reservation .field__item {
        display: none !important;
    }
    <?php endif;?>
    <?php if(!empty($bwf_text_color)): ?>
    .reservation-form .form__input {
        color:<?php echo $bwf_text_color; ?>
    }
    .reservation .list {
        color:<?php echo $bwf_text_color; ?>
    }
    <?php endif;?>
    <?php if(!empty($bwf_text_label_color)): ?>
    .reservation .field__item-label {
        color:<?php echo $bwf_text_label_color; ?>
    }
    <?php endif;?>
    <?php if(!empty($bwf_submit_button_color)): ?>
    .reservation .form__submit {
        background: <?php echo $bwf_submit_button_color; ?>;
    }
    .reservation .form__submit:hover {
        background: <?php echo $bwf_submit_button_color; ?>;
        opacity: 0.5;
    }
    <?php endif;?>

</style>
<?php if(!empty($bwf_custom_style)): ?>
<style>
<?php echo $bwf_custom_style; ?>
</style>
<?php endif;?>
<form action="<?php echo $bwf_hotel_url; ?>" method="get" name="reservation-form" target="_blank"
      class="sidebar__form reservation-form reservation" data-reservation-form
      data-key="<?php echo $bwf_api_key;  ?>"
      data-id="<?php echo $bwf_hotel_id; ?>" style="background-color:<?php if (!empty($bwf_background_color)) {
    echo $bwf_background_color;
} ?>">
    <div class="fields__wrapper">

        <div class="fields__item">
            <div class="form__field form__field--date">
                <label for="check-in" class="field__item-label">
                    <?php echo __('Check-in', 'bookwize-form'); ?>
                </label>
                <input type="text" id="check-in" name="ci" class="form__input check-in-datepicker"
                       data-date="check-in" autocomplete="off" readonly="true" />
            </div>
        </div>

        <div class="fields__item">
            <div class="form__field form__field--date">
                <label for="check-out" class="field__item-label">
                    <?php echo __('Check-out', 'bookwize-form'); ?>
                </label>
                <input type="text" id="check-out" name="co" class="form__input check-out-datepicker"
                       data-date="check-out" autocomplete="off" readonly="true" />
            </div>
        </div>
        <div class="fields__item field__item" data-field-item id="adult">
            <label for="adults" class="field__item-label">
                <?php echo __('Adults', 'bookwize-form'); ?>
            </label>
            <div class="list">
                <a class="field__item-button field__item-button--minus" data-button="minus"></a>
                <span class="value"></span>
                <a class="field__item-button field__item-button--plus" data-button="plus"></a>
            </div>
        </div>
        <div class="fields__item field__item" data-field-item id="children-0">
            <label for="children" class="field__item-label">
                <?php _e('Children', 'bookwize-form'); ?>
            </label>
            <label for="children" class="field__item-side-label">
            </label>
            <div class="list">
                <a class="field__item-button field__item-button--minus" data-button="minus"></a>
                <span class="value"></span>
                <a class="field__item-button field__item-button--plus" data-button="plus"></a>
            </div>
        </div>
        <div class="fields__item field__item" data-field-item id="children-1">
            <label for="children" class="field__item-label">
                <?php _e('Children', 'bookwize-form'); ?>
            </label>
            <label for="children" class="field__item-side-label">
            </label>
            <div class="list">
                <a class="field__item-button field__item-button--minus" data-button="minus"></a>
                <span class="value"></span>
                <a class="field__item-button field__item-button--plus" data-button="plus"></a>
            </div>
        </div>
        <div class="fields__item field__item" data-field-item id="children-2">
            <label for="children" class="field__item-label">
                <?php _e('Children', 'bookwize-form'); ?>
            </label>
            <label for="children" class="field__item-side-label">
            </label>
            <div class="list">
                <a class="field__item-button field__item-button--minus" data-button="minus"></a>
                <span class="value"></span>
                <a class="field__item-button field__item-button--plus" data-button="plus"></a>
            </div>
        </div>
        <div class="fields__item field__item" data-field-item id="infants">
            <label for="infants" class="field__item-label">
                <?php echo __('Infants', 'bookwize-form'); ?>
            </label>
            <label for="children" class="field__item-side-label">
            </label>
            <div class="list">
                <a class="field__item-button field__item-button--minus" data-button="minus"></a>
                <span class="value"></span>
                <a class="field__item-button field__item-button--plus" data-button="plus"></a>
            </div>
        </div>
        <input type="hidden" name="r" data-guests/>
        <div class="form__input__container">
            <input type="submit" class="form__submit" value="<?php echo __('Book Now', 'bookwize-form'); ?>"/>
        </div>
    </div>
</form>