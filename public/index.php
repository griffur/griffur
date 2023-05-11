<?php
//to access config.php file
require_once str_replace($_SERVER['HTTP_HOST']."/public", "", $_SERVER['DOCUMENT_ROOT']).'sources.'.$_SERVER['HTTP_HOST'].'/vendor/config.php';

if(!ONLINE){
  $whoops = new \Whoops\Run;
  $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
  $whoops->register();
}


$router = new \Root\App\Router('../pages/',[
  'Token' => '[0-9A-Za-z]{7}',
  'BILL_NUMBER' => '[0-9]{10}',
]);

$router
  //SITE
  ->both('/','site/home','home')
  ->both('/a-propos-de-griffur','site/about','about')
  ->both('/nos-services','site/services','services')
  ->both('/nos-creations','site/creations','creations')
  ->both('/notre-equipe','site/team','team')
  ->both('/nous-contacter','site/contact','contact')

  // Packs
  ->both('/nos-packs','site/packs','packs')

  ->both('/packs/[cv|entreprise|logo|maintenance|site-internet|identite-visuelle:service_name]','site/packs/packs','pack')
  ->both('/packs/site-internet/[one-page|vitrine|e-commerce:type]','site/packs/packs','packs-site')

  // Packs site internet
  // ->both('/packs/sites-internet','site/packs/packs-sites-internet','packs-site-internet')
  //->both('/packs/site-internet/[one-page|vitrine|e-commerce:type]','site/packs/packs-site-internet-type','packs-site-internet-type')
  // ->both('/packs/site-internet/maintenance','site/packs/packs-maintenance','packs-maintenance')


  // Packs



  // Welcome
  ->both('/bienvenue','welcome','welcome')

  //Stats
  ->both('/visitors/click','/admin/stats/visitors_click_on','click')
  ->both('/visitors/come','/admin/stats/visitors_come_from','come')

  //Old link, delete when current visitcard (qrcode) is finish
  ->both('/qrcode','/admin/stats/visitors_come_from','qrcode')

  //Admin
  ->both('/admin','/admin/login','login_admin')
  ->both('/admin/forgot','admin/forgot','forgot_admin')
  ->both('/reset/password/[*:token]','admin/resetpassword','reset_password_admin')

  //rules
  //->both('/conditions-generales-utilisation','/rules/cgu','cgu')
  ->both('/politique-de-confidentialite','/rules/pdc','pdc')
  ->both('/mentions-legales','/rules/ml','ml')

  //divers
  ->both('/thanks','site/thanks','thanks')

  //errorPages
  ->both('/error/404','/error/404','404')
  ->both('/error/db','/error/dberror','dberror')

  ->both('/maintenance','/error/maintenance','maintenance')

  ->run();
