<?php /*

# we have to provide a new tpl operator for xml washing
[TemplateSettings]
ExtensionAutoloadPath[]=ggxmlview

# we only provide xml templates inside the "standard" design file hierarchy,
# so we have to make sure it is enabled.
# NB: "standard" is the default fallback design in site.ini, so un less removed
# in override/site.ini.append.php or a siteaccess site.ini it should be on
[DesignSettings]
AdditionalSiteDesignList[]=standard

*/ ?>
