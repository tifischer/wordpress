<?php
/**
 * Social icons
 *
 * @package marine
 * @since marine 1.0
 */
?>
<ul class="social-media">
    <?php
    $active_social_icons = ot_get_option('active_social_items');;?>
    <?php
    $social_icons_arr = array(
        'facebook' => 'facebook_url',
        'skype' => 'skype_username',
        'twitter' => 'twitter_url',
        'google' => 'google_plus_url',
        'vimeo'=>'vimeo_url',
        'linkedin' => 'linkedin_url',
        'instagram'=>'instagram_url'
    );
    foreach ($social_icons_arr as $social_icon=>$url):?>

        <?php if (is_array($active_social_icons) && in_array($social_icon, $active_social_icons)) : ?>
            <li><a target="_blank" href="<?php echo ot_get_option($url); ?>"><i class="icon-<?php echo $social_icon; ?>"></i></a>
            </li> <?php endif; ?>

    <?php endforeach; ?>
</ul>