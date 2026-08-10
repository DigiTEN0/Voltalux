<?php
/**
 * Admin & login branding.
 *
 * Turns the WordPress back-end into a branded Voltalux environment: a custom
 * login screen, a welcome dashboard panel with quick links and support details,
 * a branded admin footer and subtle brand accents. This is what makes the
 * back-end feel like a bespoke, professionally delivered site rather than a
 * default WordPress install.
 *
 * @package Voltalux
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve the brand logo URL (falls back to the theme default).
 */
function voltalux_admin_logo_url() {
	return voltalux_option( 'logo_url', VOLTALUX_DEFAULT_LOGO );
}

/* -------------------------------------------------------------------------
 * Login screen — dark, on-brand, with the Voltalux logo.
 * ---------------------------------------------------------------------- */

add_action(
	'login_enqueue_scripts',
	function () {
		$logo  = esc_url( voltalux_admin_logo_url() );
		$green = '#059a41';
		?>
		<style id="voltalux-login">
			body.login {
				background: #0A0B0D;
				background-image:
					radial-gradient( 120% 120% at 78% -10%, rgba(5,154,65,.18) 0%, rgba(5,154,65,0) 46% ),
					radial-gradient( 90% 90% at 0% 100%, rgba(5,154,65,.10) 0%, rgba(5,154,65,0) 50% );
				color: #E9EAEC;
				font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
			}
			.login h1 a {
				background-image: url('<?php echo $logo; // phpcs:ignore ?>');
				background-size: contain;
				background-position: center;
				width: 220px;
				height: 68px;
				margin-bottom: 8px;
			}
			.login form {
				background: #17191C;
				border: 1px solid rgba(255,255,255,.10);
				border-radius: 16px;
				box-shadow: 0 30px 70px -32px rgba(0,0,0,.7);
				padding: 26px 24px 24px;
			}
			.login form label { color: #B9BDC2; font-size: 14px; }
			.login input[type=text],
			.login input[type=password] {
				background: #0f1114;
				border: 1px solid rgba(255,255,255,.14);
				border-radius: 10px;
				color: #fff;
				padding: 10px 12px;
			}
			.login input[type=text]:focus,
			.login input[type=password]:focus {
				border-color: <?php echo $green; ?>;
				box-shadow: 0 0 0 2px rgba(5,154,65,.35);
				outline: 0;
			}
			.wp-core-ui .button-primary {
				background: <?php echo $green; ?>;
				border-color: <?php echo $green; ?>;
				border-radius: 999px;
				text-shadow: none;
				box-shadow: none;
				font-weight: 600;
				padding: 4px 20px;
			}
			.wp-core-ui .button-primary:hover { background: #04863a; border-color: #04863a; }
			.login #nav a, .login #backtoblog a { color: #9AA0A6 !important; }
			.login #nav a:hover, .login #backtoblog a:hover { color: #fff !important; }
			.login .message, .login .success { border-left-color: <?php echo $green; ?>; }
			.login form .input, .login input.password-input { font-size: 16px; }
			.login #login_error { border-left-color: #e2483d; }
			.login .privacy-policy-page-link { display: none; }
			.login .wp-pwd .wp-hide-pw {
				background: #0f1114;
				border-color: rgba(255,255,255,.14);
				color: #9AA0A6;
			}
			.login .wp-pwd .wp-hide-pw:hover { color: #fff; }
			.login .wp-pwd .wp-hide-pw .dashicons { color: inherit; }
			.login .dashicons { color: #9AA0A6; }
		</style>
		<?php
	}
);

// Logo links to the site, not to wordpress.org.
add_filter( 'login_headerurl', function () { return home_url( '/' ); } );
add_filter( 'login_headertext', function () { return get_bloginfo( 'name' ); } );

/* -------------------------------------------------------------------------
 * Dashboard — a branded welcome panel (first thing the client sees).
 * ---------------------------------------------------------------------- */

add_action(
	'wp_dashboard_setup',
	function () {
		wp_add_dashboard_widget(
			'voltalux_welcome',
			__( 'Welkom bij je Voltalux-website', 'voltalux' ),
			'voltalux_dashboard_welcome_widget',
			null,
			null,
			'normal',
			'high'
		);
	}
);

/**
 * Render the welcome dashboard widget.
 */
function voltalux_dashboard_welcome_widget() {
	$pages_url = admin_url( 'edit.php?post_type=page' );
	$posts_url = admin_url( 'edit.php' );
	$media_url = admin_url( 'upload.php' );
	$menu_url  = admin_url( 'nav-menus.php' );
	$custo_url = admin_url( 'customize.php' );
	$support   = 'info@digiten.nl';
	?>
	<div class="voltalux-welcome">
		<p style="font-size:14px;line-height:1.6;margin:0 0 14px;color:#3c434a;">
			<?php esc_html_e( 'Dit is het beheer van je website. Hieronder vind je snel de plekken waar je zelf teksten, foto’s en pagina’s aanpast.', 'voltalux' ); ?>
		</p>
		<div class="voltalux-welcome__grid" style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
			<a class="button" href="<?php echo esc_url( $pages_url ); ?>" style="text-align:left;height:auto;padding:10px 12px;">
				<strong><?php esc_html_e( 'Pagina’s bewerken', 'voltalux' ); ?></strong><br>
				<span style="color:#646970;font-size:12px;"><?php esc_html_e( 'Teksten & inhoud aanpassen', 'voltalux' ); ?></span>
			</a>
			<a class="button" href="<?php echo esc_url( $posts_url ); ?>" style="text-align:left;height:auto;padding:10px 12px;">
				<strong><?php esc_html_e( 'Blog / nieuws', 'voltalux' ); ?></strong><br>
				<span style="color:#646970;font-size:12px;"><?php esc_html_e( 'Artikelen schrijven', 'voltalux' ); ?></span>
			</a>
			<a class="button" href="<?php echo esc_url( $media_url ); ?>" style="text-align:left;height:auto;padding:10px 12px;">
				<strong><?php esc_html_e( 'Media', 'voltalux' ); ?></strong><br>
				<span style="color:#646970;font-size:12px;"><?php esc_html_e( 'Foto’s uploaden', 'voltalux' ); ?></span>
			</a>
			<a class="button" href="<?php echo esc_url( $custo_url ); ?>" style="text-align:left;height:auto;padding:10px 12px;">
				<strong><?php esc_html_e( 'Thema-instellingen', 'voltalux' ); ?></strong><br>
				<span style="color:#646970;font-size:12px;"><?php esc_html_e( 'Logo, telefoon, CTA’s', 'voltalux' ); ?></span>
			</a>
		</div>
		<p style="margin:16px 0 0;padding-top:14px;border-top:1px solid #e0e0e0;font-size:13px;color:#646970;">
			<?php
			printf(
				/* translators: %s: support e-mail address. */
				esc_html__( 'Ondersteuning nodig? Neem contact op met DigiTEN via %s — wij helpen je graag verder.', 'voltalux' ),
				'<a href="mailto:' . esc_attr( $support ) . '">' . esc_html( $support ) . '</a>'
			);
			?>
		</p>
	</div>
	<style>
		#voltalux_welcome .inside { margin: 0; padding: 12px; }
		#voltalux_welcome h2.hndle { background: #0A0B0D; color: #fff; border-radius: 0; }
		#voltalux_welcome .voltalux-welcome__grid .button:hover { border-color: #059a41; color: #04863a; }
	</style>
	<?php
}

/* -------------------------------------------------------------------------
 * Admin footer + subtle brand accents.
 * ---------------------------------------------------------------------- */

add_filter(
	'admin_footer_text',
	function () {
		return sprintf(
			/* translators: %s: agency name/link. */
			esc_html__( 'Website ontwikkeld en onderhouden door %s', 'voltalux' ),
			'<a href="https://digiten.nl" target="_blank" rel="noopener" style="font-weight:600;">DigiTEN</a>'
		);
	}
);

// Replace the WordPress version string in the admin footer with the theme version.
add_filter(
	'update_footer',
	function () {
		return 'Voltalux ' . ( defined( 'VOLTALUX_VERSION' ) ? VOLTALUX_VERSION : '' );
	},
	11
);

// A subtle green accent inside wp-admin so it feels part of the brand.
add_action(
	'admin_head',
	function () {
		?>
		<style id="voltalux-admin-accent">
			#voltalux_welcome .button { text-decoration: none; }
		</style>
		<?php
	}
);
