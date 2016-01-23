<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/usr/local/var/www/nginxRoot/com.FromGithub/greenhomeland/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define("FS_METHOD","direct");

define("FS_CHMOD_DIR", 0777);

define("FS_CHMOD_FILE", 0777);


// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'greenhomeland');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', '');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[B5oLS9=RKo= {*EKltte%xnkY_x-k S-zamD7Rg?|OHb%^h}0c6zZ)l26%,__yj');
define('SECURE_AUTH_KEY',  '5|kg]?&3#+-mD(.NGNoGccVogu~%45%lGm)$S]xOTdkUr&d%]$tm3PQ2TJ!d^-d$');
define('LOGGED_IN_KEY',    '#:mmzPD<B&T!W0B)Ngu%/NX|kU?./>JcF0fG9*B6(ZZ-|ia?tk0^MLMe_eFCeW]!');
define('NONCE_KEY',        ';rm_a0nRpyGsX$c{,t:YQ[ U/4^|CZl[nce?z${k+|-GlmV+m<B|(:dHW(@>cJSU');
define('AUTH_SALT',        'aj!mc7VcA]IKF zvXOMd+_?#(p%w3=Np?G#F@64@7--!A^Ho[U[$Z`O|k^},t6/x');
define('SECURE_AUTH_SALT', ')H-oQ97XdS1v6|IqD>I6-Z1A|yJ82q|[7>.us%?/-Wj<,Wom[Sqb`jLs,gc=oe6,');
define('LOGGED_IN_SALT',   ' 2Tz->WioHvSRQV&%9ZDbM*1-smdvO*P|Mg%7qm14C%tH27SYcSZ%-K|oi|3EG>X');
define('NONCE_SALT',       ',kCHb?p7RC|x|.Ca-p&U|B/H|kWa5@OWj}s>_<WKm-@|9A3,gLt;;|lSI(y`{Hrg');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
