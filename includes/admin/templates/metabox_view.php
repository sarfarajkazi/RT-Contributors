<ul id="rtc_list">
    <?php
    if ($contributors) {
        foreach ($contributors as $key => $value) {
            $selected = $disabled = "";
            if ($author_id == $value->ID) {
                $selected = "checked";
                $disabled = "disabled";
            } elseif (!empty($selected_contributors) && in_array($value->ID, $selected_contributors)) {
                $selected = "checked";
            }
            ?>
            <li>        
                <label>
                    <input value="<?php esc_attr_e($value->ID) ?>" type="checkbox" name="post_authors[]" <?php esc_attr_e($selected . " " . $disabled) ?>>
                    <?php esc_html_e(ucwords($value->display_name) . " ($value->user_login)") ?>
                </label>
            </li>
            <?php
        }
    } else {
        ?>
        <h4><?php esc_html_e("No authors found!", 'rt-contributors') ?></h4>
        <small><?php esc_html_e("Please add new authors from Users->Add New.", 'rt-contributors') ?></small>
        <?php
    }
    ?>
</ul>
<?php
wp_nonce_field('save_author_options', 'rtc_author_options');
?>