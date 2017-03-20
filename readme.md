# Laradic Development Project

The structure for my PHP projects is a bit complicated.  Here's the gist of it.

- The `production` directory contains directories of Laravel installations for my production sites.

- The `projects` directory cotnains development environments.

- Projects in `projects` use `wikimedia/composer-merge-plugin` to in include all dependencies for its workbench
  packages into the project's `composer.json`. So it works like `require`, it also autoloads the workbench packages its `autoload`.

- Projects in `projects` sometimes use custom repositories to symlink another project's workbench packages.

```
- php
  - production
    - la.radic.nl (laravel 5.x)
      - composer.json
    - codex-project.ninja (laravel 5.x)
      - composer.json
    - etc...
    
  - projects
    - laradic (laravel 5.x)
      - app, bootstrap, config, resources, public, storage, etc.
      - workbench
        - laradic
          - annotation-scanner
            - composer.json
          - assets
          - config
          - console
          - dependency-sorter
          - filesystem
          - git
          - icon-generator
          - idea
          - php-build-tools
          - service-provider
          - support
          - testing
          - workbench 
      - composer.json
    - codex (laravel 5.x)
      - app, bootstrap, config, resources, public, storage, etc.
        - workbench
          - codex
            - core
                - composer.json
            - composer-installers
            - addon-phpdoc
            - addon-*
      - composer.json
    - etc..
```

### php/projects/laradic/composer.json

```json
{
    "extra": {
        "merge-plugin": {
            "include": [
                "workbench/laradic/support/composer.json",
                "workbench/laradic/assets/composer.json",
                "workbench/laradic/testing/composer.json",
                "workbench/laradic/annotation-scanner/composer.json",
                "workbench/laradic/console/composer.json",
                "workbench/laradic/icon-generator/composer.json",
                "workbench/laradic/idea/composer.json",
                "workbench/laradic/filesystem/composer.json",
                "workbench/laradic/service-provider/composer.json",
                "workbench/laradic/dependency-sorter/composer.json",
            ]
        }
    },
    "replace": {
        "laradic/support": "*",
        "laradic/testing": "*",
        "laradic/phing": "*",
        "laradic/filesystem": "*",
        "laradic/annotation-scanner": "*",
        "laradic/console": "*",
        "laradic/git": "*",
        "laradic/idea": "*",
        "laradic/assets": "*",
        "laradic/icon-generator": "*",
        "laradic/service-provider": "*",
        "laradic/dependency-sorter": "*",
    }
}
```


### php/projects/codex/composer.json
```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../laradic/workbench/laradic/*"
        },
        {
            "type": "path",
            "url": "../laradic/workbench/radic/*"
        },
        {
            "type": "path",
            "url": "workbench/codex/composer-plugin"
        },
        {
            "type": "path",
            "url": "workbench/codex/addon-phpdoc"
        }
    ],
    "require": {
        "php": ">=5.5.9",
        "laravel/framework": "5.3.*",
        "wikimedia/composer-merge-plugin": "~1.3",
        
        // not using require-dev because this as is a dev project entirely
        "barryvdh/laravel-debugbar": "~2.1",
        "barryvdh/laravel-ide-helper": "~2.1",
        
        
        "codex/core": "2.0.*",
        // because the repository pointing to the workbench of this project
        // these will be symlinked in the vendor folder
        "codex/composer-plugin": "2.0.*",
        "codex/addon-phpdoc": "2.0.*",
        
        // because the repository pointing to the workbench of 
        // the 'laradic' dev project, these packages will be symlinked
        // in the vendor folder.
        "laradic/console": "~1.0",
        "laradic/icon-generator": "~1.0",
        "laradic/idea": "~1.0",
        "laradic/testing": "~1.0",

    },
    "replace": {
        "codex/core": "*"
    },
    "extra": {
        "merge-plugin": {
            "include": [
                "workbench/codex/core/composer.json"
            ]
        }
    }
}
```