<?php /*

# we have to provide a new tpl operator for xml washing
[TemplateSettings]
ExtensionAutoloadPath[]=ggxmlview

# we only provide xml templates inside the "standard" design file hierarchy,
# so we have to make sure it is enabled.
# NB: "standard" is the default fallback design in site.ini, so unless removed
# in override/site.ini.append.php or a siteaccess site.ini it should be on
[DesignSettings]
AdditionalSiteDesignList[]=standard

[ContentSettings]
# A list of viewmodes which will be cached. We add xml and json to the default list
# (unfortuantely this parameter is not an array but a string, so we cannot just append to it)
#CachedViewModes=full;sitemap;pdf;search;xml;json
# A list of view modes whise caches will always be cleared when publishing content
# (unfortuantely this parameter is not an array but a string, so we cannot just append to it)
#ComplexDisplayViewModes=sitemap;xml;json

*/ ?>
