<?php
/*
Plugin Name: TCUsers
Plugin URI: http://wordpress.org/extend/plugins/tcusers/
Description: Insert TopCoder users from editor
Version: 1.0.1
Author: d2nx
Author URI: http://d2nx.ru
*/

/*	Copyright 2009	d2nx	(email : 6alliapumob@gmail.com)

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation; either version 2 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA	02110-1301	USA
*/

class tcusers
{
	var $color_to_css_class = array (
		'orange' => 'coderTextOrange',
		'red'    => 'coderTextRed',
		'yellow' => 'coderTextYellow',
		'blue'   => 'coderTextBlue',
		'green'  => 'coderTextGreen',
		'gray'   => 'coderTextGray',
		'white'  => 'coderTextWhite',
		'black'  => 'coderTextBlack'
	);

	function tcusers()
	{
		if ( function_exists ('add_shortcode') ) {
			add_shortcode('tcuser', array (&$this, 'user_shortcode') );
			add_filter( 'mce_buttons_3', array (&$this, 'mce_buttons') );
			add_filter( 'mce_external_plugins', array (&$this, 'mce_external_plugins') );	
			add_action( 'wp_head', array(&$this, 'stylesheet') );
		}
	}
	
	function stylesheet () 
	{
		$stylesheet_url = $this->safe_plugins_url ('/tcusers/css/style.css');
		echo "<link href='$stylesheet_url' type='text/css' rel='stylesheet' />";
	}

	function user_shortcode ( $atts, $content = null )
	{
		if ( $content == null )	return "";
		
		extract( shortcode_atts ( array('color' => 'black' ), $atts ) );

		$css_class = isset ($this->color_to_css_class[$color])
		                    ? $this->color_to_css_class[$color]
												: 'coderTextBlack';

		return "<a href='http://topcoder.com/tc?module=SimpleSearch&amp;ha=$content' class='$css_class'>$content</a>";
	}

	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function mce_external_plugins($plugin_array) 
	{
		$plugin_array['tcusers'] = $this->safe_plugins_url ('/tcusers/js/editor_plugin.js');
		return $plugin_array;
	}
	
	function mce_buttons($buttons)
	{
		array_push($buttons, 'tcusers');
		return $buttons;
	}
	
	function safe_plugins_url ( $path )
	{
		return function_exists ('plugins_url') 
					 ? plugins_url($path) 
					 : get_option('siteurl') . '/wp-content/plugins' . $path;
	}
}

$tcusers = new tcusers();

?>