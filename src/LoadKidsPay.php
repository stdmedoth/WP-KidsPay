<?php

if( !defined('ABSPATH')){
  die(ERRO_ABSPATH);
}

require_once __DIR__ . '/kp-vars.php';
require_once __DIR__ . '/class-kp-instalacao.php';
require_once __DIR__ . '/class-kp-desinstalacao.php';
require_once __DIR__ . '/kp-menu-pages.php';

require_once __DIR__ . '/kp-html-sources.php';
require_once __DIR__ . '/kp-cad-pages-displays.php';
require_once __DIR__ . '/kp-rel-pages-displays.php';
require_once __DIR__ . '/kp-crd-pages-displays.php';
require_once __DIR__ . '/kp-tools-pages-displays.php';

require_once __DIR__ . '/class-kp-elems.php';

require_once __DIR__ . '/class-kp-clientes.php';
require_once __DIR__ . '/class-kp-clientes-list.php';

require_once __DIR__ . '/class-kp-compras.php';
require_once __DIR__ . '/class-kp-compras-list.php';

require_once __DIR__ . '/class-kp-produtos.php';
require_once __DIR__ . '/class-kp-produtos-list.php';
require_once __DIR__ . '/class-kp-produtos-widgets.php';

require_once __DIR__ . '/class-kp-creditos.php';
require_once __DIR__ . '/class-kp-creditos-list.php';

require_once __DIR__ . '/class-kp-restricoes.php';
require_once __DIR__ . '/class-kp-restricoes-list.php';

require_once __DIR__ . '/kp-graphs-sources.php';
require_once __DIR__ . '/class-kp-tools.php';

require_once __DIR__ . '/class-kp-notificacoes.php';

//require_once __DIR__ . '/api/pagseguro/pagamento.php';

require_once __DIR__ . '/class-kp-plugin.php';
