<?php
/**
 * Template operators useful for xml generation (and other non-html content)
 *
 * @version $Id$
 * @author Gaetano Giunta
 * @copyright (c) 2008-2010 G. Giunta
 * @license code licensed under the GPL License: see README
 */

class ggXmlTplOperators
{

    static $operators = array(
        'washxml' => array(),
        'washxmlcomment' => array(),
        'washxmlcdata' => array(),
        'httpcharset' => array(),
        'httpheader' => array(),
        'to_array' => array(
            'level' => array(
                'type' => 'int',
                'required' => false,
                'default' => 2
            ),
            'attributes' => array(
                'type' => 'array',
                'required' => false,
                'default' => array()
            )
        )
    );

    function operatorList()
    {
        return array_keys( self::$operators );
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return self::$operators;
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
            } break;
            case 'httpheader':
            {
                header( $operatorValue );
                $operatorValue = '';
            } break;
            case 'to_array':
                //eZDebug::writeDebug(var_export($operatorParameters, true));
                $operatorValue = self::to_array( $operatorValue, $namedParameters['level'], $namedParameters['attributes'] );
                eZDebug::writeDebug(var_export($operatorValue, true));
            break;
        }
    }

    /**
     * Recursive conversion of values to array format.
     * It recognizes ezpersistentobject descendants, and only converts their
     * attributes, not their members.
     * @param integer $depth max recursion depth
     * @param array $attributes a filter on object attributes / array keys to serialize
     */
    static function to_array( $obj, $depth=2, $attributes=array() )
    {
        if ( ( is_object( $obj ) || is_array( $obj ) ) && $depth < 1 )
        {
            return null;
        }

        if ( is_object( $obj ) && method_exists( $obj, "attributes" ) && method_exists( $obj, "attribute" ) )
        {
            // 'template object' (should be an ancestor of ezpo)
            $out = array();
            foreach( $obj->attributes() as $key )
            {
                if ( count( $attributes ) === 0 || in_array( $key, $attributes ) )
                {
                    $out[$key] = self::to_array( $obj->attribute( $key ), $depth-1 );
                }
            }
        }
        else if ( is_array( $obj ) || is_object( $obj ) )
        {
            $out = array();
            foreach( $obj as $key => $val )
            {
                if ( count( $attributes ) === 0 || in_array( $key, $attributes ) )
                {
                    $out[$key] = self::to_array( $val, $depth-1 );
                }
            }
        }
        else
        {
            // not an object: do a simple dump
            $out = $obj;
        }
        return $out;
    }

}

?>