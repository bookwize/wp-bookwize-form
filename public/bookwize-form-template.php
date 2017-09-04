<?php
/**
 * Created by PhpStorm.
 * User: araksya.kantikyan
 * Date: 2/6/2016
 * Time: 2:21 μμ
 */
?>
<style type="text/css">
    <?php if(!empty($bwf_input_color)): ?>
    .reservation .fields__item, .reservation-form .form__input {
        background-color: <?php echo $bwf_input_color;?>;
    }

    <?php endif;?>
    <?php if(!empty($bwf_button_color)): ?>
    .reservation .field__item-button--plus, .reservation .field__item-button--minus {
        background: <?php echo $bwf_button_color; ?>;
    }

    .reservation .field__item-button--plus:hover, .reservation .field__item-button--minus:hover {
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
        color: <?php echo $bwf_text_color; ?>
    }

    .reservation .list {
        color: <?php echo $bwf_text_color; ?>
    }

    <?php endif;?>
    <?php if(!empty($bwf_text_label_color)): ?>
    .reservation .field__item-label {
        color: <?php echo $bwf_text_label_color; ?>
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
<?php if (!empty($bwf_custom_style)): ?>
    <style type="text/css">
        <?php echo $bwf_custom_style; ?>
    </style>
<?php endif; ?>
<?php

$useragent = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
    $bwf_hotel_url = $bwf_hotel_url . '/mobile';
}


?>
<form action="<?php echo $bwf_hotel_url; ?>" method="get" name="reservation-form"
      class="sidebar__form reservation-form reservation" data-reservation-form
      data-key="<?php echo $bwf_api_key; ?>"
      data-id="<?php echo $bwf_hotel_id; ?>" data-vertical="<?php if (!empty($bwf_horizontal)) {
    echo '1';
} else {
    echo 'false';
} ?>">
    <div class="fields__wrapper"  style="background-color:<?php if (!empty($bwf_background_color)) { echo $bwf_background_color;} ?>">
        <div class="fields__item">
            <div class="form__field form__field--date">
                <label for="check-in" class="field__item-label">
                    <?php echo __('Check-in', 'bookwize-form'); ?>
                </label>
                <input type="text" id="check-in" name="ci" class="form__input check-in-datepicker"
                       data-date="check-in" autocomplete="off" readonly="true"
                       placeholder="<?php echo __('Check-in', 'bookwize-form'); ?>"/>
            </div>
        </div>

        <div class="fields__item">
            <div class="form__field form__field--date">
                <label for="check-out" class="field__item-label">
                    <?php echo __('Check-out', 'bookwize-form'); ?>
                </label>
                <input type="text" id="check-out" name="co" class="form__input check-out-datepicker"
                       data-date="check-out" autocomplete="off" readonly="true"
                       placeholder="<?php echo __('Check-out', 'bookwize-form'); ?>"/>
            </div>
        </div>

        <?php
        echo bwf_render('partials/bookwize-guest-types');
        ?>

        <div class="fields__item field__item" data-field-item id="board"
             data-enable="<?php if (!empty($bwf_board) && ($bwf_board === '1' || $bwf_board === 'true')) {
                 echo 'true';
             } else {
                 echo 'false';
             } ?>">
            <label for="board" class="field__item-label">
                <?php echo __('Board', 'bookwize-form'); ?>
            </label>
            <select name="board" class="board"></select>
        </div>
        <div class="fields__item field__item" data-field-item id="couponCode"
             data-enable="<?php if (!empty($bwf_promo_code) && ($bwf_promo_code === '1' || $bwf_promo_code === 'true')) {
                 echo 'true';
             } else {
                 echo 'false';
             } ?>">
            <label for="couponCode" class="field__item-label">
                <?php echo __('Coupon Code', 'bookwize-form'); ?>
            </label>
            <input type="text" name="couponCode" value=""
                   placeholder="<?php echo __('Coupon Code', 'bookwize-form'); ?>">
        </div>
        <input type="hidden" name="r" data-guests/>
		 <input type="hidden" name="lang" value="" class="lang"/>
        <input type="hidden" name="linkerParam" value="" class="linkerParam"/>
        <div class="form__input__container">
            <input type="submit" class="form__submit" value="<?php echo __('Book Now', 'bookwize-form'); ?>"/>
        </div>
    </div>
</form>