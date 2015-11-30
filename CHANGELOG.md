CHANGELOG
=========

This changelog references the relevant changes (bug and security fixes) done in 1.x versions.

To get the diff for a specific change, go to https://github.com/joomlatools/joomlatools-platform/commit/xxx where xxx is the change hash.
To view the diff between two versions, go to https://github.com/joomlatools/joomlatools-platform/compare/v1.0.0...v1.0.1

## 1.0.1 (2015-11-13)

### Fixed

* Fixed Session fixation vulnerability [#253](https://github.com/joomlatools/joomlatools-platform/issues/253)
* Fixed Security issues in Joomla v3.4.5 [#249](https://github.com/joomlatools/joomlatools-platform/issues/249)
* Fixed Undefined variable $im when editing plugin [#242](https://github.com/joomlatools/joomlatools-platform/issues/242)
* Fixed Menu manager cannot find the view manifest [#241](https://github.com/joomlatools/joomlatools-platform/issues/241)
* Fixed Fix event dispatching inconsistencies [#164](https://github.com/joomlatools/joomlatools-platform/issues/164)

### Changed

* Disable anonymous sessions [#251](https://github.com/joomlatools/joomlatools-platform/issues/251)
* Move legacy libraries into separate repo [#258](https://github.com/joomlatools/joomlatools-platform/issues/258)
* Improve administrator menu [#248](https://github.com/joomlatools/joomlatools-platform/issues/248)
* Do not load .env file in production [#246](https://github.com/joomlatools/joomlatools-platform/issues/246)

### Removed

* Remove debug plugin [#263](https://github.com/joomlatools/joomlatools-platform/pull/263)

## 1.0.0 (2015-09-01)

### Added

* Added Restructure codebase [#118](https://github.com/joomlatools/joomlatools-platform/pull/118)
* Added Set default parameters after component installation [#233](https://github.com/joomlatools/joomlatools-platform/pull/233)
* Added Legacy support [#228](https://github.com/joomlatools/joomlatools-platform/pull/228)
* Added Added composer create-project installer [#229](https://github.com/joomlatools/joomlatools-platform/pull/229)
* Added Do not create admin menu item if the component has no admin functionality [#216](https://github.com/joomlatools/joomlatools-platform/pull/216)
* Added Store config in the environment [#162](https://github.com/joomlatools/joomlatools-platform/pull/162)
* Added Use composer [#120](https://github.com/joomlatools/joomlatools-platform/pull/120)

### Fixed

* Fixed JTableAsset::rebuild() fails [#204](https://github.com/joomlatools/joomlatools-platform/pull/204)
* Fixed If display_errors is FALSE exception messages are still printed to the screen [#168](https://github.com/joomlatools/joomlatools-platform/pull/168)
* Fixed Use MyISAM engine for users_sessions table [#223](https://github.com/joomlatools/joomlatools-platform/pull/223)

### Changed

* Change license to GPLv3 [#201](https://github.com/joomlatools/joomlatools-platform/pull/201)
* Move the categories extension to the [platform-categories] repo [#209](https://github.com/joomlatools/joomlatools-platform/pull/209)
* Move the search extension to the [platform-search] repo [#195](https://github.com/joomlatools/joomlatools-platform/pull/195)
* Move the content extension to the [platform-content] repo [#180](https://github.com/joomlatools/joomlatools-platform/pull/180)
* Move the contenthistory extension to the [platform-content] repo [#189](https://github.com/joomlatools/joomlatools-platform/pull/189)
* Move the tags extension to the [platform-content] repo [#176](https://github.com/joomlatools/joomlatools-platform/pull/176)
* Move the media extension to the [platform-media] repo [#174](https://github.com/joomlatools/joomlatools-platform/pull/174)
* Move the finder extension to the [platform-finder] repo [#170](https://github.com/joomlatools/joomlatools-platform/pull/170)
* Rename 'template_styles' table to 'templates' [#225](https://github.com/joomlatools/joomlatools-platform/pull/225)
* Rename user related database tables [#221](https://github.com/joomlatools/joomlatools-platform/pull/221)
* Rename 'associations' table to 'languages_associations' [#218](https://github.com/joomlatools/joomlatools-platform/pull/218)
* Do not store the 'mediaVersion' in the database [#197](https://github.com/joomlatools/joomlatools-platform/pull/197)
* Do not log a warning if a component cannot be loaded [#180](https://github.com/joomlatools/joomlatools-platform/pull/180)
* Move language files into (extension)/language directory [#178](https://github.com/joomlatools/joomlatools-platform/pull/178)
* Move admin "my profile" functionality into com_users [#154](https://github.com/joomlatools/joomlatools-platform/pull/154)
* Move admin login functionality into com_user [#153](https://github.com/joomlatools/joomlatools-platform/pull/153)
* Change generator tag [#151](https://github.com/joomlatools/joomlatools-platform/pull/151)

### Removed

* Remove PHP5.5 compatibility [#124](https://github.com/joomlatools/joomlatools-platform/pull/124)
* Remove mod_multilangstatus [#213](https://github.com/joomlatools/joomlatools-platform/pull/213)
* Remove mod_footer [#86](https://github.com/joomlatools/joomlatools-platform/pull/86)
* Remove mod_users_latest [#107](https://github.com/joomlatools/joomlatools-platform/pull/107)
* Remove mod_related_items [#84](https://github.com/joomlatools/joomlatools-platform/pull/84)
* Remove mod_version [#63](https://github.com/joomlatools/joomlatools-platform/pull/63)
* Remove mod_random_image [#49](https://github.com/joomlatools/joomlatools-platform/pull/49)
* Remove mod_stats and mod_stats_admin [#47](https://github.com/joomlatools/joomlatools-platform/pull/47)
* Remove mod_whosonline [#45](https://github.com/joomlatools/joomlatools-platform/pull/45)
* Remove mod_syndicate [#43](https://github.com/joomlatools/joomlatools-platform/pull/43)
* Remove tpl_beez3 [#41](https://github.com/joomlatools/joomlatools-platform/pull/41)
* Remove tpl_hathor [#24](https://github.com/joomlatools/joomlatools-platform/pull/24)
* Remove plg_system_languagecode [#211](https://github.com/joomlatools/joomlatools-platform/pull/211)
* Remove plg_content_emailcloak [#207](https://github.com/joomlatools/joomlatools-platform/pull/207)
* Remove plg_captcha_recaptcha [#98](https://github.com/joomlatools/joomlatools-platform/pull/98)
* Remove plg_authentication_ldap [#60](https://github.com/joomlatools/joomlatools-platform/pull/60)
* Remove plg_authentication_gmail [#58](https://github.com/joomlatools/joomlatools-platform/pull/58)
* Remove plg_system_cache [#57](https://github.com/joomlatools/joomlatools-platform/pull/57)
* Remove plg_content_vote [#55](https://github.com/joomlatools/joomlatools-platform/pull/55)
* Remove plg_system_p3p [#53](https://github.com/joomlatools/joomlatools-platform/pull/53)
* Remove com_ajax [#34](https://github.com/joomlatools/joomlatools-platform/pull/34)
* Remove com_massmail [#32](https://github.com/joomlatools/joomlatools-platform/pull/32)
* Remove com_mailto [#30](https://github.com/joomlatools/joomlatools-platform/pull/30)
* Remove com_wrapper [#28](https://github.com/joomlatools/joomlatools-platform/pull/28)
* Remove com_joomlaupdate [#26](https://github.com/joomlatools/joomlatools-platform/pull/26)
* Remove com_postinstall [#25](https://github.com/joomlatools/joomlatools-platform/pull/25)
* Remove com_messages [#22](https://github.com/joomlatools/joomlatools-platform/pull/22)
* Remove com_newsfeeds [#21](https://github.com/joomlatools/joomlatools-platform/pull/21)
* Remove com_contacts [#20](https://github.com/joomlatools/joomlatools-platform/pull/20)
* Remove com_banners [#17](https://github.com/joomlatools/joomlatools-platform/pull/17)
* Remove com_redirect [#16](https://github.com/joomlatools/joomlatools-platform/pull/16)
* Remove Library - phputf8 [#144](https://github.com/joomlatools/joomlatools-platform/pull/144)
* Remove Library - FOF library [#94](https://github.com/joomlatools/joomlatools-platform/pull/94)
* Remove Library - JOauth1 and 2 [#90](https://github.com/joomlatools/joomlatools-platform/pull/90)
* Remove Library - JApplicationDaemon [#82](https://github.com/joomlatools/joomlatools-platform/pull/82)
* Remove Library - JOpenstreetmap [#80](https://github.com/joomlatools/joomlatools-platform/pull/80)
* Remove Library - JMediawiki [#78](https://github.com/joomlatools/joomlatools-platform/pull/78)
* Remove Library - JLinkedin [#76](https://github.com/joomlatools/joomlatools-platform/pull/76)
* Remove Library - JGoogle [#74](https://github.com/joomlatools/joomlatools-platform/pull/74)
* Remove Library - JGithub [#72](https://github.com/joomlatools/joomlatools-platform/pull/72)
* Remove Library - JFacebook [#70](https://github.com/joomlatools/joomlatools-platform/pull/70)
* Remove Library - JTwitter [#68](https://github.com/joomlatools/joomlatools-platform/pull/68)
* Remove Library - JClientLdap [#61](https://github.com/joomlatools/joomlatools-platform/pull/61)
* Remove Library - SimplePie [#39](https://github.com/joomlatools/joomlatools-platform/pull/39)
* Remove codemirror editor [#134](https://github.com/joomlatools/joomlatools-platform/pull/134)
* Remove /tests folder [#172](https://github.com/joomlatools/joomlatools-platform/pull/172)
* Remove /build folder [#115](https://github.com/joomlatools/joomlatools-platform/pull/115)
* Remove /installation folder [#113](https://github.com/joomlatools/joomlatools-platform/pull/113)
* Remove sample data  [#19](https://github.com/joomlatools/joomlatools-platform/pull/19)
* Remove sample data images [#193](https://github.com/joomlatools/joomlatools-platform/pull/193)
* Remove tag id to titles logic in JDocumentRendererHead [#192](https://github.com/joomlatools/joomlatools-platform/pull/192)
* Remove versioning support from com_categories [#186](https://github.com/joomlatools/joomlatools-platform/pull/186)
* Remove tag support from com_categories [#184](https://github.com/joomlatools/joomlatools-platform/pull/184)
* Remove partially implemented tags support from com_users [#182](https://github.com/joomlatools/joomlatools-platform/pull/182)
* Remove search term logging functionality [#51](https://github.com/joomlatools/joomlatools-platform/pull/51)
* Remove template edit functionality [#110](https://github.com/joomlatools/joomlatools-platform/pull/110)
* Remove the language override functionality [#105](https://github.com/joomlatools/joomlatools-platform/pull/105)
* Remove the extension installer functionality [#101](https://github.com/joomlatools/joomlatools-platform/pull/101)
* Remove Mass Mail and User Notes functionality [#100](https://github.com/joomlatools/joomlatools-platform/pull/100)
* Remove system info view from com_admin [#99](https://github.com/joomlatools/joomlatools-platform/pull/99)
* Remove finder CLI script. Use [joomlatools-console v1.4] [#167](https://github.com/joomlatools/joomlatools-platform/pull/167)
* Remove com_checkin. Use [joomlatools-console v1.4] [#141](https://github.com/joomlatools/joomlatools-platform/pull/141)
* Remove com_cache. Use [joomlatools-console v1.4] [#138](https://github.com/joomlatools/joomlatools-platform/pull/138)
* Remove com_config from the site application [#160](https://github.com/joomlatools/joomlatools-platform/pull/160)
* Remove global configuration user interface [#152](https://github.com/joomlatools/joomlatools-platform/pull/152)
* Remove 'Text Filter' config settings [#158](https://github.com/joomlatools/joomlatools-platform/pull/158)
* Remove offline config settings [#146](https://github.com/joomlatools/joomlatools-platform/pull/146)
* Remove the 'root_user' config setting[#157](https://github.com/joomlatools/joomlatools-platform/pull/157)
* Remove proxy config setting [#132](https://github.com/joomlatools/joomlatools-platform/pull/132)
* Remove gzip config setting [#130](https://github.com/joomlatools/joomlatools-platform/pull/130)
* Remove error_reporting config setting [#128](https://github.com/joomlatools/joomlatools-platform/pull/128)
* Remove FTP config settings [#117](https://github.com/joomlatools/joomlatools-platform/pull/117)
* Remove $_PROFILER global [#127](https://github.com/joomlatools/joomlatools-platform/pull/127)
* Remove less compiler and generatecss build cli command [#92](https://github.com/joomlatools/joomlatools-platform/pull/92)
* Remove two factor authentication implementation [#66](https://github.com/joomlatools/joomlatools-platform/pull/66)
* Remove keychain cli command and related library [#37](https://github.com/joomlatools/joomlatools-platform/pull/37)
* Remove help [#35](https://github.com/joomlatools/joomlatools-platform/pull/35)
* Remove index.html files and add .gitignore for empty directories [#88](https://github.com/joomlatools/joomlatools-platform/pull/88)
 
[platform-categories]: https://github.com/joomlatools/joomlatools-platform-categories
[platform-search]: https://github.com/joomlatools/joomlatools-platform-search
[platform-content]: https://github.com/joomlatools/joomlatools-platform-content
[platform-media]: https://github.com/joomlatools/joomlatools-platform-media
[platform-finder]: https://github.com/joomlatools/joomlatools-platform-finder

[joomlatools-console v1.4]: https://github.com/joomlatools/joomlatools-console/releases/tag/v1.4.0

