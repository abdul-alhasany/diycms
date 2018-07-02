~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                       TinyMCE Plugin: Language Switcher
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


1) What is it?
2) How to install it?
3) License
4) Author


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
1) What is it?
      The Language Switcher is a TinyMCE plugin that adds a control to the
      TinyMCE WYSIWYG-editor that allows you to switch the language of
      TinyMCE (used for the controls etc.).


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
2) How to install it?
      Easy!
      Just copy the langswitch folder to the "plugins" folder of your TinyMCE
      installation and activate the plugin:
            tinyMCE.init({
                  //...
                  plugins:                'langswitch',
                  langswitch_languages:   'de=Deutsch,en=Englisch'
            });
      As you've seen there's a "langswitch_languages" directive.
      Add all languages that you would like to be selectable to this list.
      The languages have to be installed to work - I think you know that but I
      mentioned just for the case...


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
3) License
      The Language Switcher plugin is licensed under the New BSD license.


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
4) Author
      The plugin is developed by actra.development.
      For bug reports, "thank you"-emails and other things please contact us by
      the following contact details:
            actra.development
            Owner: Gabriel Schuster
            Stuttgarter Strasse 82
            70825 Korntal-Muenchingen
            Web:   http://www.actra.de/velopment
            eMail: info@actra.de