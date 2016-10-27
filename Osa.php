<?php

if ( ! defined( 'MEDIAWIKI' ) ) die( "This is an extension to the MediaWiki package and cannot be run standalone." );

$wgExtensionCredits['skin'][] = array(
	'path'        => __FILE__,
	'name'        => 'OsaSkin',
	'url'         => 'https://shapebootstrap.net/item/1524925-acme-free-responsive-corporate-template/comments',
	'author'      => 'cosmic, 김동동, 2DU, 코코아',
	'description' => '오사위키의 기본테마입니다.',
        'license-name' => "FREE LICENSE",
        'version' => 'Release',
);

$wgValidSkinNames['osaskin'] = 'OsaSkin';
$wgAutoloadClasses['SkinOsa'] = __DIR__ . '/OsaSkin.php';


$skinDirParts = explode( DIRECTORY_SEPARATOR, __DIR__ );
$skinDir = array_pop( $skinDirParts );

$wgResourceModules['skins.osaskin'] = array(
	'styles' => array(
		$skinDir . '/css/bootstrap.min.css'            => array( 'media' => 'all' ),
		$skinDir . '/css/theme.css'            => array( 'media' => 'all' ),
		$skinDir . '/css/bootstrap-reset.css'            => array( 'media' => 'all' ),
		$skinDir . '/css/style.css'            => array( 'media' => 'all' ),
		$skinDir . '/css/style-responsive.css'            => array( 'media' => 'all' ),
	),
	'scripts' => array(
		$skinDir . '/js/jquery.min.js',
		$skinDir . '/js/bootstrap.min.js',
		$skinDir . '/js/adsbygoogle.js',
		$skinDir . '/js/Gadget-ReferenceTooltips-ko.js',
		$skinDir . '/js/R-18_NoAD.js',
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath'  => &$GLOBALS['wgStyleDirectory'],
);
 
