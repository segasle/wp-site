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
define( 'DB_NAME', 'wordpress' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'OwZa+oPnqS4{jBi}@{-3x)T8u|9(A5vVA+)k,}~TV!t6Gy_K)WN;pq;S<D]&][M{' );
define( 'SECURE_AUTH_KEY',  'x4bA~?|501EVZaKIxie w^=4BH8 PI6KUR!Twm07JDJA1(hzZLMQo(l4x/4+sxVW' );
define( 'LOGGED_IN_KEY',    '68s`A@VvU)CHw+,AmK8xArO*bjyvo<` 1G;yKidO(vj/$P6E]%8n~*R5|cU0X{V5' );
define( 'NONCE_KEY',        ':^ ldY%5[+MmE]!w}/sMe?YrCN>8|1!7=7#0Su9p tfm[Wm6-tBNqp,iquj=^%Wc' );
define( 'AUTH_SALT',        ' %5)qXJ6B!G;uGJZ6c8K)kw6<DZntPq522vwF* X8o:60?);.z~|5>|qnB/~,$Q2' );
define( 'SECURE_AUTH_SALT', 'Oy.l-pK*G{}*A/zlx1F0[Y(RDk{31VjhgK&2 {WZ8{LOY8_[|O-hB{2*;vaqbx1k' );
define( 'LOGGED_IN_SALT',   'G/%j!z <dP{7oN%SA^UdL F-x.h:?+}4QgamS-+YV%k;cM,OW;ukVNZY)Jomp2z&' );
define( 'NONCE_SALT',       '{RuSzDi#U],CkS#uu+fC*YnL*M&,b-w=T0VdU(y=arL}1Vvk~-3Lm.E=7Y`*`I=,' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
