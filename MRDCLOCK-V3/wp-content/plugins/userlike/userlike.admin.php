<?php if(!$in_userlike) exit; ?>
            <div class="wrap">
                <?php screen_icon() ?>
                <h2><?php _e('Userlike', 'userlike') ?></h2>
                <div class="metabox-holder meta-box-sortables ui-sortable pointer">
                    <div class="postbox" style="float:left;width:30em;margin-right:20px;width:500px;">
                        <h3 class="hndle"><span><?php _e('Userlike Settings', 'userlike') ?></span></h3>
                        <div class="inside" style="padding: 0 10px">
                            <p style="text-align:center"><a href="https://www.userlike.com/" title="Userlike"><img src="<?php echo $plugin_dir; ?>userlike.png" alt="Userlike" /></a></p>
                            <form method="post" action="options.php">
                                <?php settings_fields('userlike'); ?>
                                <p>
                                    <label for="userlike_secret"><?php echo __('Your Userlike Secret', 'userlike') ?></label><br />

                                    <input type="text" name="userlike_secret" value="<?php echo get_option('userlike_secret'); ?>" style="width:100%" />
                                </p>
                                <p class="submit">
                                    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
                                    <input type="button" class="button-secondary" value="Help!" onClick="userlikeStartChat(); return false;" />
                                </p>
                            </form>

                            <p style="color:#999239;background-color:#ffffe0;font-size:smaller;padding:0.4em 0.6em !important;border:1px solid #e6db55;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px"><?php printf(__('Don&rsquo;t have an Userlike account? No problem! %1$sRegister for an Userlike account%2$sRegister for an Userlike account!%3$s', 'userlike'), '<a href="https://www.userlike.com/register" title="', '">', '</a>') ?></p>
                        </div>
                    </div>
                </div>
            </div>

<script async src="https://userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/e118d28e7fa94a93584ba07132ca899a564554b1d11087dca1140c47e4860b87.js"></script>
