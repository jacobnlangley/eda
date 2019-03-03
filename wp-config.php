<?php
# Database Configuration
define( 'DB_NAME', 'wp_edatl' );
define( 'DB_USER', 'edatl' );
define( 'DB_PASSWORD', '8Xth9gcsN3ezw4xDmI1G' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '^mqA4h-2Pj}olh.Ib+3&nf-W&s^p[`e>Ch<l0p=VarBAg,`pjOi-I3x8`0ge]ei}');
define('SECURE_AUTH_KEY',  'Q+/%o]Z+<4)40<U=9{WpqHtX-EH*uFOaC^_/n7&J>dIayYF2t3J--&~++, #<gk5');
define('LOGGED_IN_KEY',    '$;lVX217`.fuNl0+Y1zB#>!Jf?M)b??,<qQ}5V6v157tyYHw.$E1+W}gKT*pVg~%');
define('NONCE_KEY',        '.`Kh&UV~7TPsa)`LwrVz+:o-]3L|T7x[wZc-bY+vgYLS V7x/-L-a37O.EzJ|qUk');
define('AUTH_SALT',        '&waBNZlVav=wr.kHsM=7[kMaT5&y0yf|F,l}$RR+D,3W~5nWw{0eiLUplrMLzy9-');
define('SECURE_AUTH_SALT', '>@I#=reT)KV7Ofk5|p.*rj7u<Y{`1cT@TrX%}cqd]y-K(+;{!76B}B(>q65J?5[r');
define('LOGGED_IN_SALT',   ';j+G$k{l@+D(~,=EpTtjTZ`cdBh-IvS_5Q1_OHQ(Yj^dM`tb~<d}A2GsS9G$fz#a');
define('NONCE_SALT',       'An@Xg_F?>TU|gV,P^|D$@:Y bi6i(0(,wNPj+7pZwy)DT;Y.}cp+?+T>`K`U$CtZ');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'edatl' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', 'b79e52ac8765a369f50815b218db510f69c3bf04' );

define( 'WPE_CLUSTER_ID', '120207' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'edatl.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-120207', );

$wpe_special_ips=array ( 0 => '104.196.111.249', );

$wpe_ec_servers=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );


# WP Engine ID


# WP Engine Settings







# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
