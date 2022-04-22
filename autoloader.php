<?php

spl_autoload_register( function ( $class ) {
	if ( 0 !== strpos( $class, 'SSP_Transcripts' ) ) {
		return;
	}

	$file_path = explode( '\\', $class );

	$file_path[0] = 'php/classes'; //replace the main application namespace with the main folder path

	foreach ( $file_path as $k => $v ) {
		$v               = mb_strtolower( str_replace( '_', '-', $v ) );
		$file_path[ $k ] = $v;
	}

	$file_name = end( $file_path );

	if ( false !== array_search( 'interfaces', $file_path ) ) {
		$file_name = 'interface-' . $file_name . '.php';
	} elseif ( false !== array_search( 'traits', $file_path ) ) {
		$file_name = 'trait-' . $file_name . '.php';
	} else {
		$file_name = 'class-' . $file_name . '.php';
	}

	$file_path[ count( $file_path ) - 1 ] = $file_name;

	$fully_qualified_path = trailingslashit( __DIR__ ) . implode( '/', $file_path );

	if ( file_exists( $fully_qualified_path ) ) {
		include_once $fully_qualified_path;
	}
} );
