<?php

return [

    /* Site */
    'sitename'     => 'Joomlatools Platform',
    'editor'       => 'tinymce',
    'captcha'      => '0',
    'list_limit'   => '20',
    'frontediting' => 0,

    /* User */
    'access'     => '1',

    /* Server */
    'force_ssl'  => '0',

    /* Database */
    'dbtype'     => 'mysqli',

    /* Locale */
	'offset'     => 'UTC',

    /* Session */
	'lifetime'        => '15',
	'session_handler' => 'database',

	/* Mail */
    'mailer'    => 'mail',
	'mailfrom'  => '',
    'fromname'  => '',
    'sendmail'  => '/usr/sbin/sendmail',
    'smtpauth'  => '0',
    'smtpuser'  => '',
    'smtppass'  => '',
    'smtphost'  => 'localhost',

	/* Cache */
	'caching'       => 0,
	'cachetime'     => '15',
	'cache_handler' => 'file',

	/* Debug */
    'debug'      => '0',
	'debug_lang' => '0',

    /* SEO */
	'sef'          => '1',
	'sef_rewrite'  => '0',
	'sef_suffix'   => '0',
	'unicodeslugs' => '0',

	/* Feed */
    'feed_limit'   => 10,
    'feed_email'   => 'author',

    /* Session autostart */
    'session_autostart' => false
];
