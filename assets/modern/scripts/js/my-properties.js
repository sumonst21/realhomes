jQuery( function( $ ) {

	$( document ).ready( function() {

		"use strict";

		$( '.delete' ).click( function( e ) {
			e.preventDefault();

			var link = $( this );
			var link_parent = link.parent();
			var confirm_span = link_parent.find( '.confirmation' );

			link.addClass( 'hide' );
			confirm_span.removeClass( 'hide' );

		} );

		$( '.cancel' ).click( function( e ) {
			e.preventDefault();

			var link = $( this );
			var link_wrap = link.parent();
			var link_parent = link.parents( '.rh_my-property__controls' );
			var link_delete = link_parent.find( '.delete' );

			link_wrap.addClass( 'hide' );
			link_delete.removeClass( 'hide' );

		} );
	} );

} ); // EOF.
