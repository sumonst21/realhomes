<?php
/**
 * This file loads other files containing various functions used in this theme
 *
 * @package RH
 */

/**
 * Design variations related functions
 *
 * @since 2.7.0
 */
if ( file_exists( INSPIRY_FRAMEWORK . 'functions/design-variations-handler.php' ) ) {
	require_once INSPIRY_FRAMEWORK . 'functions/design-variations-handler.php';
}

// Header functions.
require_once INSPIRY_FRAMEWORK . 'functions/header.php';

// Basic functions.
require_once INSPIRY_FRAMEWORK . 'functions/basic.php';

// Pagination functions.
require_once INSPIRY_FRAMEWORK . 'functions/pagination.php';

// Price functions.
require_once INSPIRY_FRAMEWORK . 'functions/price.php';

// Real Estate functions.
require_once INSPIRY_FRAMEWORK . 'functions/real-estate.php';

// Real Estate Search Functions.
require_once INSPIRY_FRAMEWORK . 'functions/real-estate-search.php';

// Home related functions.
require_once INSPIRY_FRAMEWORK . 'functions/home.php';

// Breadcrumbs functions.
require_once INSPIRY_FRAMEWORK . 'functions/breadcrumbs.php';

// Users / Members related functions.
require_once INSPIRY_FRAMEWORK . 'functions/member.php';

// Property submit and edit.
require_once INSPIRY_FRAMEWORK . 'functions/submit-edit.php';

// Favorites functions.
require_once INSPIRY_FRAMEWORK . 'functions/favorites.php';

// Contact form handlers.
require_once INSPIRY_FRAMEWORK . 'functions/contact-form-handlers.php';

// Property submit handler.
require_once INSPIRY_FRAMEWORK . 'functions/property-submit-handler.php';

// Edit profile handler.
require_once INSPIRY_FRAMEWORK . 'functions/edit-profile-handler.php';

// Theme's custom comment.
require_once INSPIRY_FRAMEWORK . 'functions/theme-comment.php';

// Currency switcher.
require_once INSPIRY_FRAMEWORK . 'functions/currency-switcher.php';

// Demo import functions.
require_once INSPIRY_FRAMEWORK . 'functions/demo-import.php';

// Compare functions.
require_once INSPIRY_FRAMEWORK . 'functions/compare.php';

// Compare functions.
require_once INSPIRY_FRAMEWORK . 'functions/property-custom-fields.php';

// If inspiry-memberships plugin is active then include this file.
if ( class_exists( 'IMS_Functions' ) ) {
	// Memberships functions.
	require_once INSPIRY_FRAMEWORK . 'functions/membership.php';
}

// Property Rating functions.
require_once INSPIRY_FRAMEWORK . 'functions/property-ratings.php';

// If realhomes-vacation-rentals plugin is activated and enabled from its settings
if( inspiry_is_rvr_enabled() ) {
	// Realhomes Vacation Rentals Search Functions.
	require_once INSPIRY_FRAMEWORK . 'functions/rvr-search.php';
}