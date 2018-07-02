/**
 * 
 * @package TinyMCE Language Switcher
 * 
 * @author Gabriel Schuster <info@actra.de>
 * @copyright Copyright 2009, actra.development, Korntal-Muenchingen
 * @license http://www.actra.de/velopment/opensource/licenses/new-bsd.html New BDS License
 * 
 * Contact details:
 *       actra.development
 *       Owner: Gabriel Schuster
 *       Stuttgarter Strasse 82
 *       70825 Korntal-Muenchingen
 *       Web:   http://www.actra.de/velopment
 *       eMail: info@actra.de
 * 
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *                               NEW BSD LICENSE                              
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * 
 * 
 * Copyright (c) 2009, actra.development
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *    - Redistributions of source code must retain the above copyright notice,
 *      this list of conditions and the following disclaimer.
 *    - Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the
 *      documentation and / or other materials provided with the
 *      distribution.
 *    - Neither the name of actra.development nor the names of its
 *      contributors may be used to endorse or promote products derived from
 *      this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 * 
 */


(function() {
      tinymce.create('tinymce.plugins.LanguageSwitcher', {
            getInfo:       function() {
                  return {
                        longname:  'LanguageSwitcher',
                        author:    'actra.development',
                        authorurl: 'http://www.actra.de/velopment/',
                        infourl:   'http://www.actra.de/velopment/opensource/tinymce-langswitch.html',
                        version:    tinymce.majorVersion + "." + tinymce.minorVersion
                  };
            },
            createControl: function(n, cm) {
                  switch (n) {
                        case 'languageselection':
                              var mlb = cm.createListBox(
                                    'languageselection',
                                    {
                                          title:    'Language Switcher',
                                          onselect: function(v) {
                                                tinyMCE.activeEditor.settings.language = v;
                                                currentSettings                        = tinyMCE.activeEditor.settings;
                                                tinyMCE.activeEditor.remove();
                                                tinyMCE.init(currentSettings);
                                                if(currentSettings.theme && currentSettings.theme.length) {
                                                      tinymce.ThemeManager.requireLangPack(currentSettings.theme);
                                                }
                                          }
                                    }
                              );
                              
                              var languages = tinyMCE.activeEditor.getParam('langswitch_languages', false);
                              if(languages.length) {
                                    var hasLanguages = 0;
                                    var selLanguage  = 0;
                                    var posLanguage  = 0;
                                    var pairs        = languages.split(/,/);
                                    
                                    for(i = 0; i < pairs.length; i++) {
                                          var pair = pairs[i].split(/=/);
                                          if(pair[0] && pair[0].length && pair[1] && pair[1].length) {
                                                if(tinyMCE.activeEditor.settings.language == pair[0]) {
                                                      selLanguage = posLanguage;
                                                }
                                                
                                                mlb.add(pair[1], pair[0]);
                                                hasLanguages = 1;
                                                posLanguage++;
                                          }
                                    }
                                    
                                    if(hasLanguages == 1) {
                                          mlb.selectByIndex(selLanguage);
                                          
                                          return mlb;
                                    }
                              }
                              
                              return null;
                  }
            
                  return null;
            }
      });
      
      // Register plugin
      tinymce.PluginManager.add('langswitch', tinymce.plugins.LanguageSwitcher);
})();