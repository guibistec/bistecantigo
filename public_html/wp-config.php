<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'wp_bistec');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'wp_bistec');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'pYi3pM!M75VxWP');

/** Nome do host do MySQL */
define('DB_HOST', 'wp_bistec.mysql.dbaas.com.br');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'p<QfCsdO!,a&<6I=j*L)k#n``^am*+{d&!PL>MuC~gt+a,a?o_S1:caHf8L@=Jn0');
define('SECURE_AUTH_KEY',  'KB2lX7XycthHR[,O8>DM:MY$?UU$*ZYyV3n.kN=UW/W}CR!LH<X]|Bkg*6xqjGJe');
define('LOGGED_IN_KEY',    '8<Ti$=@R@5t}UX.kVlAv&A|nQYu`B6K(V@R zpLm!aDEVZ1*mYa,kzb5lKMj:^%M');
define('NONCE_KEY',        'ZFaVWW%FOIkp*}7LOZJ13E$^/*~ebp]as!!VkdgKobj%r@1t|_MjDLU 9uUk%;SA');
define('AUTH_SALT',        '7y }mcWsq{5wGeBLb__Ma`3ks23yD;vh$gL-Rk!}gNlA@,{;}uR5B79ro*~DW qa');
define('SECURE_AUTH_SALT', '7dV/whzYW7xe_Q.,p[vCdmi6bhRQ$?B]eBT1y`>?Z{ET`;6lHsp8$%UG!DHRy_QF');
define('LOGGED_IN_SALT',   'us94~mj()_*aU[6-(</B050H~Qt/uX:o,AhsiZy$FxX+WMf[Buw+/6LY(ivYSUr0');
define('NONCE_SALT',       'U)_1; P[`o}s-?Vfto(O>iR1Y!m_e@@G~527CYBwRkayRG*O1;Q_A+72[|.N4}@!');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
