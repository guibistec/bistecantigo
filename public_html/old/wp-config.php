<?php
define('WP_MEMORY_LIMIT', '128M');
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'bdbistec');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'bdbistec');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'hdteggd6');

/** nome do host do MySQL */
define('DB_HOST', 'bdbistec.mysql.dbaas.com.br');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~{||$7?h(-Oi7RQ/6iUDh6s]Wbnc+7y6I:/u@;SmG8(_YLf]&rg4#jE=Q!-Wl?l(');
define('SECURE_AUTH_KEY',  'OftZhWK>)r|,#VX!&.I?DaV)Tb&*/5.{oxW4_M1fhnFxWw;,|&GvdL|^^jU G+[O');
define('LOGGED_IN_KEY',    'Gf<wpOUsN,J/U=.@HKEG<X!;WUQnu<9h7[Yw&7}OBO}_qE2QegD-$]^NK#Q7S hP');
define('NONCE_KEY',        'D^iz+(gO{>0l;V^KsKbThHr!T).|}_bSV h9<]e%7UGXU)&k*|!@rURwxr-egL+,');
define('AUTH_SALT',        'v)>m-W<6t|i-G?]SE$+Cvpq_]?=TDw]N|:Tl:n+4[|^X-YZ#Ny1yPhYS`uAk(#db');
define('SECURE_AUTH_SALT', 'RRDo?g8jv6b`&U*_hw>C=&3q,OnNU]a/tKX.%G<nD#F&kY;e?=MUyV~-vXZNZbO3');
define('LOGGED_IN_SALT',   '~O!1..jn1ANO||n|JH7I~sY+1KBm]>Dfx=z+,$JB,f%n%Dk!<sbT/.!ux+p!H(G5');
define('NONCE_SALT',       'bz=H5:|NExY-A~Xv|e{A[,jWuI{8i-~QcdARk4qPNi6g2tJO]#nv<|qEV8Q:>-?E');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
