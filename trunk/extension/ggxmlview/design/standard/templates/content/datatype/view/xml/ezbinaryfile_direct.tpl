{* DO NOT EDIT THIS FILE! Use an override template instead. *}
<{$attribute.contentclass_attribute_identifier} datatypestring="{$attribute.data_type_string|washxml}">
<a href={$attribute.content.filepath|ezroot}>{$attribute.content.original_filename|washxml}</a>
<size>{$attribute.content.filesize|si( byte )}</size>
</{$attribute.contentclass_attribute_identifier}>