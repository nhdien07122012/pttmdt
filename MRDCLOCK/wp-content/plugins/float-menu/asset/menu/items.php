<?php if ( ! defined( 'ABSPATH' ) ) exit;
	add_thickbox();	
	include( ABSPATH . "wp-admin/includes/plugin-install.php" );
	global $tabs, $tab, $paged, $type, $term;
	$tabs = array();
	$tab = "search";
	$per_page = 30;
	$args = array
	(
	"user"=> "wpcalc",
	"page" => $paged,
	"per_page" => $per_page,
	"fields" => array( "last_updated" => true, "icons" => true, "active_installs" => true ),
	"locale" => get_locale(),
	);
	$item = get_transient( 'wow_estore_plugins');
	if ($item == false){
		$args = apply_filters( "install_plugins_table_api_args_$tab", $args );
		$api = plugins_api( "query_plugins", $args );	
		$item = $api->plugins;
		set_transient( 'wow_estore_plugins', $item, 604800 );
	}	
	
	$url = 'https://wow-estore.com/item-preview/items.php';
	$request_args = array(
		'method'      => 'POST',
		'timeout'     => 20,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking'    => true,
		'headers'     => array(
		'content-type' => 'application/json'
		),
		'body'        => '',
	);		
	$request = wp_remote_post( $url, $request_args );
	$wow_slugs = unserialize($request['body']);
	
	
	
	
	$plugins_allowedtags = array(
	'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
	'abbr' => array( 'title' => array() ), 'acronym' => array( 'title' => array() ),
	'code' => array(), 'pre' => array(), 'em' => array(), 'strong' => array(),
	'div' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
	'p' => array(), 'ul' => array(), 'ol' => array(), 'li' => array(),
	'h1' => array(), 'h2' => array(), 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(),
	'img' => array( 'src' => array(), 'class' => array(), 'alt' => array() )
	);
?>
<form id="plugin-filter" method="post">
	
	<p style="padding-bottom: 5px;margin-bottom:30px;"><span class="dashicons dashicons-megaphone"></span>&nbsp;&nbsp; Several plugins below is free and you can install it and hopefully useful. Enjoy it</p>
	<div class="wp-list-table widefat plugin-install">		
		<?php
			foreach ( ( array ) $item as $plugin ) {
				if ( is_object( $plugin ) ) {
					$plugin = ( array ) $plugin;
				}
				$title = wp_kses( $plugin['name'], $plugins_allowedtags );
				// Remove any HTML from the description.
				$description = strip_tags( $plugin['short_description'] );
				$version = wp_kses( $plugin['version'], $plugins_allowedtags );
				$name = strip_tags( $title . ' ' . $version );
				$author = wp_kses( $plugin['author'], $plugins_allowedtags );
				if ( ! empty( $author ) ) {
					$author = ' <cite>' . sprintf( __( 'By %s' ), $author ) . '</cite>';
				}
				$action_links = array();
				if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
					$status = install_plugin_install_status( $plugin );
					switch ( $status['status'] ) {
						case 'install':
						if ( $status['url'] ) {
							/* translators: 1: Plugin name and version. */
							$action_links[] = '<a class="install-now button-secondary wow-button-install" href="' . $status['url'] . '" aria-label="' . esc_attr( sprintf( __( 'Install %s now' ), $name ) ) . '">' . __( 'Install Now' ) . '</a>';
						}
						break;
						case 'update_available':
						if ( $status['url'] ) {
							/* translators: 1: Plugin name and version */
							$action_links[] = '<a class="button wow-button-update" href="' . $status['url'] . '" aria-label="' . esc_attr( sprintf( __( 'Update %s now' ), $name ) ) . '">' . __( 'Update Now' ) . '</a>';
						}
						break;
						case 'latest_installed':
						case 'newer_installed':
						$action_links[] = '<span class="button button-disabled" title="' . esc_attr__( 'This plugin is already installed and is up to date' ) . ' ">' . _x( 'Installed', 'plugin' ) . '</span>';
						break;
					}
				}
				$details_link   = self_admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=' . $plugin['slug'] .
				'&amp;TB_iframe=true&amp;width=750&amp;height=550' );
				/* translators: 1: Plugin name and version. */
				$action_links[] = '<a href="' . esc_url( $details_link ) . '" class="thickbox" aria-label="' . esc_attr( sprintf( __( 'More information about %s' ), $name ) ) . '" data-title="' . esc_attr( $name ) . '">' . __( 'More Details' ) . '</a>';
				if ( !empty( $plugin['icons']['svg'] ) ) {
					$plugin_icon_url = $plugin['icons']['svg'];
					} elseif ( !empty( $plugin['icons']['2x'] ) ) {
					$plugin_icon_url = $plugin['icons']['2x'];
					} elseif ( !empty( $plugin['icons']['1x'] ) ) {
					$plugin_icon_url = $plugin['icons']['1x'];
					} else {
					$plugin_icon_url = $plugin['icons']['default'];
				}
				/**
					* Filter the install action links for a plugin.
					*
					* @since 2.7.0
					*
					* @param array $action_links An array of plugin action hyperlinks. Defaults are links to Details and Install Now.
					* @param array $plugin       The plugin currently being listed.
				*/
				$action_links = apply_filters( 'plugin_install_action_links', $action_links, $plugin );
			?>
			<div class="plugin-card">
				<div class="plugin-card-top">							
					
					<div class="name column-name">
						<h3><a href="<?php echo esc_url( $details_link ); ?>" class="thickbox"><?php echo $title; ?> <img src="<?php echo esc_attr( $plugin_icon_url ) ?>" class="plugin-icon" /> </a></h3>
					</div>
					
					<div class="action-links">
						<ul class="plugin-action-buttons">								
							<?php 
								foreach ($wow_slugs as $slug => $slug_pro ){
									if($plugin["slug"] == $slug){
										echo '<li><a class="button-pro" aria-label="PRO VERSION" href="https://wow-estore.com/item/'.$slug_pro.'/" target="_blank">PRO VERSION</a></li>';
									}								
								}								
							?>
							<li><?php echo $action_links[0]; ?></li>
							<li><?php echo $action_links[1]; ?></li>
						</ul>
						
					</div>
					
					<div class="desc column-description">
						<p><?php echo $description; ?></p>
						<p class="authors"><?php echo $author; ?></p>			
					</div>
				</div>
				
				<div class="plugin-card-bottom">
					<div class="vers column-rating">
						<?php wp_star_rating( array( 'rating' => $plugin['rating'], 'type' => 'percent', 'number' => $plugin['num_ratings'] ) ); ?>
						<span class="num-ratings" aria-hidden="true">(<?php echo number_format_i18n( $plugin['num_ratings'] ); ?>)</span>
					</div>
					<div class="column-updated">
						<strong><?php _e( 'Last Updated:' ); ?></strong> <span title="<?php echo esc_attr( $plugin['last_updated'] ); ?>">
							<?php printf( __( '%s ago' ), human_time_diff( strtotime( $plugin['last_updated'] ) ) ); ?>
						</span>
					</div>
					<div class="column-downloaded">
						<?php
							if ( $plugin['active_installs'] >= 1000000 ) {
								$active_installs_text = _x( '1+ Million', 'Active plugin installs' );
								} elseif ( 0 == $plugin['active_installs'] ) {
								$active_installs_text = _x( 'Less Than 10', 'Active plugin installs' );
								} else {
								$active_installs_text = number_format_i18n( $plugin['active_installs'] ) . '+';
							}
							printf( __( '%s Active Installs' ), $active_installs_text );
						?>
					</div>
					<div class="column-compatibility">
						<?php
							if ( ! empty( $plugin['tested'] ) && version_compare( substr( $GLOBALS['wp_version'], 0, strlen( $plugin['tested'] ) ), $plugin['tested'], '>' ) ) {
								echo '<span class="compatibility-untested">' . __( 'Untested with your version of WordPress' ) . '</span>';
								} elseif ( ! empty( $plugin['requires'] ) && version_compare( substr( $GLOBALS['wp_version'], 0, strlen( $plugin['requires'] ) ), $plugin['requires'], '<' ) ) {
								echo '<span class="compatibility-incompatible">' . __( '<strong>Incompatible</strong> with your version of WordPress' ) . '</span>';
								} else {
								echo '<span class="compatibility-compatible">' . __( '<strong>Compatible</strong> with your version of WordPress' ) . '</span>';
							}
						?>
					</div>
				</div>
			</div>
			<?php
			}
		?>
	</div>   
</form> 		