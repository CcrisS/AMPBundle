# AMP Bundle

Para instalar el bundle `AMPBundle` agrega las siguientes líneas al archivo `composer.json` del proyecto.

`composer.json`

```
{
    ...
    
    "repositories": [
        {"type": "git", "url": "https://install_user:v8v,ieQGedHD@git.srv.vocento.in/scm/git/voc_AMPBundle.git"}
    ],
    
    ...
    
    "require": {
        "vocento/amp-bundle": "1.0"
    },
    
    ...
}
```

Una vez modificado el archivo `composer.json`, ejecuta el siguiente comando en la consola.

```
$ composer update vocento/amp-bundle
```
