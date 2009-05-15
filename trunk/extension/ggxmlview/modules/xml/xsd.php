<?php
/**
 * Generates an xsd file for all the content classes present in this eZ Publish instance
 *
 * @version $Id: $
 * @author Gaetano Giunta
 * @copyright (c) 2008,2009 G. Giunta
 * @license code licensed under the GPL License: see README
 */

/// fecth all classes definitions
$classes = eZContentClass::fetchAllClasses();

/// feed them to the template
$tpl = templateInit();
$tpl->setVariable( "classes", $classes );

$Result = array();
$Result['pagelayout'] = 'xml_pagelayout.tpl';
$Result['content'] = $tpl->fetch( "design:class/xml_classlist.tpl" );

header('Content-type: text/xml');

?>
