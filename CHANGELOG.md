CHANGELOG
=========

This changelog references the relevant changes (bug and security fixes) done in 1.x versions.

To get the diff for a specific change, go to https://github.com/joomlatools/joomla-platform/commit/xxx where xxx is the change hash.
To view the diff between two versions, go to https://github.com/joomlatools/joomla-platform/compare/v1.0.0...v1.0.1

* 1.0.0 (2015-09-01)
 * Added - Initial release
 * Added [#233] : Set default parameters after component installation
 * Added [#228] : Legacy support
 * Added [#229] : Added composer create-project installer
 * Added [#216] : Do not create admin menu item if the component has no admin functionality
 * Added [#162] : Store config in the environment
 * Added [#120] : Use composer
 * Fixed [#204] : JTableAsset::rebuild() fails
 * Fixed [#168] : If display_errors is FALSE exception messages are still printed to the screen
 * Fixed [#223] : Use MyISAM engine for users_sessions table
 * Changed [#201] : Change license to GPLv3
 * Changed [#209] : Move the categories extension to the [joomla-platform-categories] repo
 * Changed [#195] : Move the search extension to the [joomla-platform-search] repo
 * Changed [#180] : Move the content extension to the [joomla–platform-content] repo
 * Changed [#189] : Move the contenthistory extension to the [joomla–platform-content] repo
 * Changed [#176] : Move the tags extension to the [joomla–platform-content] repo
 * Changed [#174] : Move the media extension to the [joomla–platform-media] repo
 * Changed [#170] : Move the finder extension to the [joomla–platform-finder] repo
 * Changed [#225] : Rename 'template_styles' table to 'templates' 
 * Changed [#221] : Rename user related database tables 
 * Changed [#218] : Rename 'associations' table to 'languages_associations'
 * Changed [#197] : Do not store the 'mediaVersion' in the database
 * Changed [#180] : Do not log a warning if a component cannot be loaded
 * Changed [#178] : Move language files into (extension)/language directory
 * Changed [#154] : Move admin "my profile" functionality into com_users
 * Changed [#153] : Move admin login functionality into com_user
 * Changed [#151] : Change generator tag
 * Removed [#124] : Remove PHP5.5 compatibility
 * Removed [#213] : mod_multilangstatus
 * Removed [#86]  : mod_footer
 * Removed [#107] : mod_users_latest
 * Removed [#84]  : mod_related_items
 * Removed [#63]  : mod_version
 * Removed [#49]  : mod_random_image
 * Removed [#47]  : mod_stats and mod_stats_admin
 * Removed [#45]  : mod_whosonline
 * Removed [#43]  : mod_syndicate
 * Removed [#41]  : tpl_beez3
 * Removed [#24]  : tpl_hathor
 * Removed [#211] : plg_system_languagecode
 * Removed [#207] : plg_content_emailcloak
 * Removed [#98]  : plg_captcha_recaptcha
 * Removed [#58]  : plg_authentication_gmail
 * Removed [#57]  : plg_system_cache
 * Removed [#55]  : plg_content_vote
 * Removed [#53]  : plg_system_p3p
 * Removed [#34]  : com_ajax
 * Removed [#32]  : com_massmail
 * Removed [#30]  : com_mailto
 * Removed [#28]  : com_wrapper
 * Removed [#26]  : com_joomlaupdate
 * Removed [#25]  : com_postinstall 
 * Removed [#22]  : com_messages
 * Removed [#21]  : com_newsfeeds
 * Removed [#20]  : com_contacts
 * Removed [#17]  : com_banners
 * Removed [#16]  : com_redirect
 * Removed [#144] : Library - phputf8 
 * Removed [#94]  : Library - FOF library
 * Removed [#90]  : Library - JOauth1 and 2 
 * Removed [#82]  : Library - JApplicationDaemon
 * Removed [#80]  : Library - JOpenstreetmap
 * Removed [#78]  : Library - JMediawiki
 * Removed [#76]  : Library - JLinkedin 
 * Removed [#74]  : Library - JGoogle
 * Removed [#72]  : Library - JGithub
 * Removed [#70]  : Library - JFacebook
 * Removed [#68]  : Library - JTwitter
 * Removed [#61]  : Library - JClientLdap
 * Removed [#39]  : Library - SimplePie
 * Removed [#134] : Remove codemirror editor
 * Removed [#172] : Remove /tests folder
 * Removed [#115] : Remove /build folder
 * Removed [#113] : Remove /installation folder
 * Removed [#19]  : Remove sample data 
 * Removed [#193] : Remove sample data images
 * Removed [#192] : Remove tag id to titles logic in JDocumentRendererHead
 * Removed [#186] : Remove versioning support from com_categories
 * Removed [#184] : Remove tag support from com_categories
 * Removed [#182] : Remove partially implemented tags support from com_users
 * Removed [#51]  : Remove search term logging functionality
 * Removed [#110] : Remove template edit functionality
 * Removed [#105] : Remove the language override functionality
 * Removed [#101] : Remove the extension installer functionality 
 * Removed [#100] : Removed Mass Mail and User Notes functionality
 * Removed [#99]  : Remove system info view from com_admin
 * Removed [#167] : Remove finder CLI script. Use [joomla-console v1.4]
 * Removed [#141] : Remove com_checkin. Use [joomla-console v1.4]
 * Removed [#138] : Remove com_cache. Use [joomla-console v1.4]
 * Removed [#160] : Remove com_config from the site application
 * Removed [#152] : Remove global configuration user interface
 * Removed [#158] : Remove 'Text Filter' config settings
 * Removed [#146] : Remove offline config settings
 * Removed [#157] : Remove the 'root_user' config setting
 * Removed [#132] : Remove proxy config setting
 * Removed [#130] : Remove gzip config setting
 * Removed [#128] : Remove error_reporting config setting
 * Removed [#117] : Remove FTP config settings
 * Removed [#127] : Remove $_PROFILER global
 * Removed [#92]  : Remove less compiler and generatecss build cli command
 * Removed [#66]  : Remove two factor authentication implementation
 * Removed [#37]  : Remove keychain cli command and related library
 * Removed [#35]  : Remove help
 * Removed [#88]  : Remove index.html files and add .gitignore for empty directories
 
[joomla-platform-categories]: https://github.com/joomlatools/joomla-platform-categories
[joomla-platform-search]: https://github.com/joomlatools/joomla-platform-search
[joomla–platform-content]: https://github.com/joomlatools/joomla-platform-content
[joomla–platform-media]: https://github.com/joomlatools/joomla-platform-media
[joomla–platform-finder]: https://github.com/joomlatools/joomla-platform-finder

[joomla-console v1.4]: https://github.com/joomlatools/joomla-console/releases/tag/v1.4.0

[#233]:  https://github.com/joomlatools/joomla-platform/pull/233
[#228]: https://github.com/joomlatools/joomla-platform/pull/228
[#229]: https://github.com/joomlatools/joomla-platform/pull/229
[#216]: https://github.com/joomlatools/joomla-platform/pull/216
[#162]: https://github.com/joomlatools/joomla-platform/pull/162
[#120]: https://github.com/joomlatools/joomla-platform/pull/120
[#204]: https://github.com/joomlatools/joomla-platform/pull/204 
[#168]: https://github.com/joomlatools/joomla-platform/pull/168
[#223]: https://github.com/joomlatools/joomla-platform/pull/223
[#201]: https://github.com/joomlatools/joomla-platform/pull/201
[#209]: https://github.com/joomlatools/joomla-platform/pull/209
[#195]: https://github.com/joomlatools/joomla-platform/pull/195
[#180]: https://github.com/joomlatools/joomla-platform/pull/180
[#189]: https://github.com/joomlatools/joomla-platform/pull/189
[#176]: https://github.com/joomlatools/joomla-platform/pull/176
[#174]: https://github.com/joomlatools/joomla-platform/pull/174
[#170]: https://github.com/joomlatools/joomla-platform/pull/170
[#225]: https://github.com/joomlatools/joomla-platform/pull/225
[#221]: https://github.com/joomlatools/joomla-platform/pull/221
[#218]: https://github.com/joomlatools/joomla-platform/pull/218
[#197]: https://github.com/joomlatools/joomla-platform/pull/197
[#180]: https://github.com/joomlatools/joomla-platform/pull/180
[#178]: https://github.com/joomlatools/joomla-platform/pull/178
[#154]: https://github.com/joomlatools/joomla-platform/pull/154
[#153]: https://github.com/joomlatools/joomla-platform/pull/153
[#151]: https://github.com/joomlatools/joomla-platform/pull/151
[#124]: https://github.com/joomlatools/joomla-platform/pull/124
[#213]: https://github.com/joomlatools/joomla-platform/pull/213
[#86]: https://github.com/joomlatools/joomla-platform/pull/86
[#107]: https://github.com/joomlatools/joomla-platform/pull/107
[#84]: https://github.com/joomlatools/joomla-platform/pull/84
[#63]: https://github.com/joomlatools/joomla-platform/pull/63
[#49]: https://github.com/joomlatools/joomla-platform/pull/49
[#47]: https://github.com/joomlatools/joomla-platform/pull/47
[#45]: https://github.com/joomlatools/joomla-platform/pull/45
[#43]: https://github.com/joomlatools/joomla-platform/pull/43
[#41]: https://github.com/joomlatools/joomla-platform/pull/41
[#24]: https://github.com/joomlatools/joomla-platform/pull/24
[#211]: https://github.com/joomlatools/joomla-platform/pull/211
[#207]: https://github.com/joomlatools/joomla-platform/pull/207
[#98]: https://github.com/joomlatools/joomla-platform/pull/98
[#58]: https://github.com/joomlatools/joomla-platform/pull/58
[#57]: https://github.com/joomlatools/joomla-platform/pull/57
[#55]: https://github.com/joomlatools/joomla-platform/pull/55
[#53]: https://github.com/joomlatools/joomla-platform/pull/53
[#34]: https://github.com/joomlatools/joomla-platform/pull/34
[#32]: https://github.com/joomlatools/joomla-platform/pull/32
[#30]: https://github.com/joomlatools/joomla-platform/pull/30
[#28]: https://github.com/joomlatools/joomla-platform/pull/28
[#26]: https://github.com/joomlatools/joomla-platform/pull/26
[#25]: https://github.com/joomlatools/joomla-platform/pull/25
[#22]: https://github.com/joomlatools/joomla-platform/pull/22
[#21]: https://github.com/joomlatools/joomla-platform/pull/21
[#20]: https://github.com/joomlatools/joomla-platform/pull/20
[#17]: https://github.com/joomlatools/joomla-platform/pull/17
[#16]: https://github.com/joomlatools/joomla-platform/pull/16
[#144]: https://github.com/joomlatools/joomla-platform/pull/144
[#94]: https://github.com/joomlatools/joomla-platform/pull/94
[#90]: https://github.com/joomlatools/joomla-platform/pull/90
[#82]: https://github.com/joomlatools/joomla-platform/pull/82
[#80]: https://github.com/joomlatools/joomla-platform/pull/80
[#78]: https://github.com/joomlatools/joomla-platform/pull/78
[#76]: https://github.com/joomlatools/joomla-platform/pull/76
[#74]: https://github.com/joomlatools/joomla-platform/pull/74
[#72]: https://github.com/joomlatools/joomla-platform/pull/72
[#70]: https://github.com/joomlatools/joomla-platform/pull/70
[#68]: https://github.com/joomlatools/joomla-platform/pull/68
[#61]: https://github.com/joomlatools/joomla-platform/pull/61
[#39]: https://github.com/joomlatools/joomla-platform/pull/39
[#134]: https://github.com/joomlatools/joomla-platform/pull/134
[#172]: https://github.com/joomlatools/joomla-platform/pull/172
[#115]: https://github.com/joomlatools/joomla-platform/pull/115
[#113]: https://github.com/joomlatools/joomla-platform/pull/113
[#19]: https://github.com/joomlatools/joomla-platform/pull/19
[#193]: https://github.com/joomlatools/joomla-platform/pull/193
[#192]: https://github.com/joomlatools/joomla-platform/pull/192
[#186]: https://github.com/joomlatools/joomla-platform/pull/186
[#184]: https://github.com/joomlatools/joomla-platform/pull/184
[#182]: https://github.com/joomlatools/joomla-platform/pull/182
[#51]: https://github.com/joomlatools/joomla-platform/pull/51
[#110]: https://github.com/joomlatools/joomla-platform/pull/110
[#105]: https://github.com/joomlatools/joomla-platform/pull/105
[#101]: https://github.com/joomlatools/joomla-platform/pull/101
[#100]: https://github.com/joomlatools/joomla-platform/pull/100
[#99]: https://github.com/joomlatools/joomla-platform/pull/99
[#167]: https://github.com/joomlatools/joomla-platform/pull/167
[#141]: https://github.com/joomlatools/joomla-platform/pull/141
[#138]: https://github.com/joomlatools/joomla-platform/pull/138
[#160]: https://github.com/joomlatools/joomla-platform/pull/160
[#152]: https://github.com/joomlatools/joomla-platform/pull/152
[#158]: https://github.com/joomlatools/joomla-platform/pull/158
[#146]: https://github.com/joomlatools/joomla-platform/pull/146
[#157]: https://github.com/joomlatools/joomla-platform/pull/157
[#132]: https://github.com/joomlatools/joomla-platform/pull/132
[#130]: https://github.com/joomlatools/joomla-platform/pull/130
[#128]: https://github.com/joomlatools/joomla-platform/pull/128
[#117]: https://github.com/joomlatools/joomla-platform/pull/117
[#127]: https://github.com/joomlatools/joomla-platform/pull/127
[#92]: https://github.com/joomlatools/joomla-platform/pull/92
[#66]: https://github.com/joomlatools/joomla-platform/pull/66
[#37]: https://github.com/joomlatools/joomla-platform/pull/37
[#35]: https://github.com/joomlatools/joomla-platform/pull/35
[#88]: https://github.com/joomlatools/joomla-platform/pull/88