<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wordpress');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'n4n>1+jJMtewNz_J_+Wc+bFH$0VQGJP}xVqMYJX0NkcTLfCt[iO5Pqt+^,oHMet4');
define('SECURE_AUTH_KEY',  ']D|G74 N@BW)we5@w8_`vyaLPW.8?taU8s`cl(9c?:hn2kK5S,-n%VjfP%bqBu`#');
define('LOGGED_IN_KEY',    'C0Ks))b[QIp>!<[q!a|#pz gv}e`SWQV1P<GmK9<vtcvON{E[elniZwAyuVfRxn ');
define('NONCE_KEY',        '.j@ jfN8A=}U+%w]r(zmg5`oUjc.R1}X]~]HrK5J2{:~w%:WX8x@MbK$F-Wl}qHg');
define('AUTH_SALT',        'rqZ`unaX?qR(h<JIfIU:xU7S#|Mfh5K;9h3rIK?#G m7TgSs9]:!x,$wu,=YDqIx');
define('SECURE_AUTH_SALT', 'm*Jw%Mz=X4q8]Nlq7E*PtA:[-Oev;+Tmtc7Txf#i:=A-_iPyW1Iy>Q7+.9.bbL7o');
define('LOGGED_IN_SALT',   ')$T]y|K7Nim_dgJJi}o0T;<A*(T1eWAtS_b{XTx-d!uF%P{n_4qW;ml]P!uh>K0C');
define('NONCE_SALT',       'vdp(RqEkNkF+,]QAhQyk*f^iX9wd,RRYgk5Xm@3?W.PeX0wt?$<~:#rZ%msE=i)r');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
