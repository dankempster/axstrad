Simple modles to hold content.

# Axstrad/Content

__namespace:__ Axstrad\Component\Content;

# Features

 - Various content related models & traits
    - Copy
    - Article
 - Provides ORM mapping in YAML format config/orm


# Installation

## Update composer.json
```
"require": {
    ...
    "axstrad/content": "0.1.*"
}
```

# Symfony Framework Usage
Add the mapping info to the DoctrineBundle
```
# ./app/config/config.yml

# Doctrine Configuration
doctrine:
    # ...other doctrine config...
    orm:
        # ...other orm config...
        mappings:
            axstrad_content:
                type: yml
                prefix: Axstrad\Component\Content\Orm
                dir: "%kernel.root_dir%/../vendor/axstrad/content/config/Orm"
                alias: AxstradContent
                is_bundle: false
```
