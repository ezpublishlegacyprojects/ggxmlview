<?php
/**
 * Template operators useful for xml generation (and other non-html content)
 *
 * @version $Id: $
 * @author Gaetano Giunta
 * @copyright (c) 2008 G. Giunta
 * @license code licensed under the GPL License: see README
 */

class ggXmlTplOperators
{

    function operatorList()
    {
        return array( 'washxml', 'washxmlcomment', 'washxmlcdata', 'httpcharset' );
    }

    function namedParameterPerOperator()
    {
        return false;
    }

    function modify( $tpl, $operatorName, $operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            case 'washxml':
            {
                $operatorValue = str_replace( array( '&', '"', "'", '<', '>' ), array( '&amp;', '&quot;', '&apos;', '&lt;', '&gt;' ), $operatorValue );
            } break;
            case 'washxmlcomment':
            {
                // in xml comments the -- string is not permitted
                $operatorValue = str_replace( '--', '_-', $operatorValue );
            } break;
            case 'washxmlcdata':
            {
                /// @todo
            } break;
			case 'httpcharset':
			{
			    $operatorValue = eZTextCodec::httpCharset();
			}
        }
    }
}

?>