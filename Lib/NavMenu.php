<?php

namespace MicromvcExt\Lib;

class NavMenu {

	protected $text;
	protected $url;
	protected $tag;
	protected $_attributes = array( );
	protected $_linkAttributes = array( );
	protected $items = array( );

	/**
	 * Create a new menu or menu item
	 * 
	 * @param string $text The text for a menu item
	 * @param string $url The url a menu item should link to
	 * @param string $tag The tag a menu item should be wrapped in
	 * @param array $attributes Attributes for the wrapper element
	 * @param array $linkAttributes Attributes for the link element
	 */
	function __construct( $text = null, $url = null, $tag = 'ul', array $attributes = null, array $linkAttributes = null )
	{
		$this->text = $text;
		$this->url = $url;
		$this->tag = $tag;
		if( $attributes )
		{
			$this->_attributes = $attributes;
		}
		if( $linkAttributes )
		{
			$this->_linkAttributes = $linkAttributes;
		}
	}

	/**
	 * Create a new item in the current menu.
	 * 
	 * After creating a new menu item you can add a link to the menu item by using the
	 * link method on the returned object:
	 * 
	 * $menu = new NavMenu();
	 * $menu->item('Home')->link('/');
	 * 
	 * Add a submenu to an item using the menu method on the returned object.
	 * 
	 * $submenu = $menu->item('Foo')->menu();
	 * $submenu->item('Bar')->link('/bar');
	 * $submenu->item('Bat')->link('/bat');
	 * $submenu->item('Baz')->link('/baz');
	 * 
	 * @param string $text Text for the nw menu item
	 * @param array $attributes New menu item's attributes (wrapper tag)
	 * @return \MicromvcExt\Lib\NavMenu The new menu item
	 */
	function item( $text, array $attributes = null )
	{
		$item = new NavMenu( $text, null, 'li', $attributes );
		$items[] = $item;
		return $item;
	}

	/**
	 * Add a link to a menu item.
	 * 
	 * Will return without adding the link if no text exists on the current item.
	 * 
	 * @param string $url The url to add
	 * @param array $attributes The link's attributes
	 * @return \MicromvcExt\Lib\NavMenu The nav menu item
	 */
	function link( $url, array $attributes = null )
	{
		if( !$this->text )
		{
			return $this;
		}
		$this->url = $url;
		if( $attributes )
		{
			$this->_linkAttributes = $attributes;
		}
		return $this;
	}

	/**
	 * Add a submenu to the current menu item.
	 * @param array $attributes
	 * @return \MicromvcExt\Lib\NavMenu 
	 */
	function menu( array $attributes = null )
	{
		$item = new NavMenu( null, null, 'ul', $attributes );
		$items[] = $item;
		return $item;
	}

	/**
	 * Add or remove attributes to/from the wrapper element.
	 * 
	 * Pass a value of null to unset all attributes.
	 * 
	 * @param array $attributes The attributes to add; null to remove all attributes.
	 * @return \MicromvcExt\Lib\NavMenu The current nav menu item
	 */
	function attributes( array $attributes = null )
	{
		if( $attributes )
		{
			$this->_attributes = array_merge( $this->_attributes, $attributes );
		}
		else
		{
			$this->_attributes = array( );
		}
		return $this;
	}

	/**
	 * Add or remove attributes to/from the link element.
	 * 
	 * Pass a value of null to unset all attributes.
	 * 
	 * @param array $attributes The attributes to add; null to remove all attributes.
	 * @return \MicromvcExt\Lib\NavMenu The current nav menu item
	 */
	function linkAttributes( array $attributes = null )
	{
		if( $attributes )
		{
			$this->_linkAttributes = array_merge( $this->_linkAttributes, $attributes );
		}
		else
		{
			$this->_linkAttributes = array( );
		}
		return $this;
	}

	/**
	 * Render the nav menu
	 * 
	 * @return string The completed nav menu.
	 */
	protected function renderItem()
	{
		$content = '';
		if( $this->url && $this->text )
		{
			$content .= \Core\HTML::link( $this->url, $this->text, $this->_linkAttributes );
		}
		elseif( $this->text )
		{
			$content .= $this->text;
		}
		if( $this->items )
		{
			foreach( $this->items as $item )
			{
				if( $item instanceof NavMenu )
				{
					$content .= $item->renderItem();
				}
			}
		}
		$content = \Core\HTML::tag( $this->tag, $content, $this->_attributes );
		return $content;
	}

	/**
	 * Return the nav menu as a string.
	 * 
	 * @return string The nav menu
	 */
	function __toString()
	{
		return $this->renderItem();
	}

}
