CHANGELOG
=========

This changelog references the relevant changes (bug and security fixes) done in 1.x versions.

To get the diff for a specific change, go to https://github.com/joomlatools/joomlatools-platform/commit/xxx where xxx is the change hash.
To view the diff between two versions, go to https://github.com/joomlatools/joomlatools-platform/compare/v1.0.0...v1.0.1

## 2.0.1 (2018-10-03)

## Fixed

* Fix uninstall method for components [#362](https://github.com/joomlatools/joomlatools-platform/issues/362)

## 2.0.0 (2018-05-08)

### Added

* New administrator template [#260](https://github.com/joomlatools/joomlatools-platform/issues/260)
* Include Phinx migrations from extensions [#318](https://github.com/joomlatools/joomlatools-platform/issues/318)
* Make chosen look like Bootstrap input [#286](https://github.com/joomlatools/joomlatools-platform/issues/286)
* Enable sef_advance_link by default [#344](https://github.com/joomlatools/joomlatools-platform/issues/344)
* Create 404 re-direct plugin [#346](https://github.com/joomlatools/joomlatools-platform/issues/346)

### Removed

* Remove the default logo in elysio template parameter [#350](https://github.com/joomlatools/joomlatools-platform/issues/350)

### Changed

* Upgrade to Joomla 3.6.5 [#315](https://github.com/joomlatools/joomlatools-platform/issues/315)
* Disable frontend editing by default [#339](https://github.com/joomlatools/joomlatools-platform/issues/339)
* Redesign administrator template to Joomlatools UI [#319](https://github.com/joomlatools/joomlatools-platform/issues/319)
* Improve 404 redirect plugin [#353](https://github.com/joomlatools/joomlatools-platform/issues/353)
* Set PHP7 as minimal requirement [#322](https://github.com/joomlatools/joomlatools-platform/issues/322)
* Prepare 2.0.0 Release [#242](https://github.com/joomlatools/joomlatools-platform/issues/342)

### Fixed

* Users cannot login to administrator [#320](https://github.com/joomlatools/joomlatools-platform/issues/320)
* Fix the session creation in enqueueMessage() [#317](https://github.com/joomlatools/joomlatools-platform/issues/317)
* Fix "Require Password Reset" [#314](https://github.com/joomlatools/joomlatools-platform/issues/314)
* Checkbox / toolbar issue [#285](https://github.com/joomlatools/joomlatools-platform/issues/285)
* Fix tinymce editor media path [#327](https://github.com/joomlatools/joomlatools-platform/issues/327)
* Fix time-out error [#329](https://github.com/joomlatools/joomlatools-platform/issues/329)
* Changing author name not working in articles [#332](https://github.com/joomlatools/joomlatools-platform/issues/332)
* Fix language override filename [#334](https://github.com/joomlatools/joomlatools-platform/issues/334)
* JOOMLA_CACHE requires integer value [#336](https://github.com/joomlatools/joomlatools-platform/issues/336)
* Batch process failed [#348](https://github.com/joomlatools/joomlatools-platform/issues/348)
* Fix error page in backend template [#357](https://github.com/joomlatools/joomlatools-platform/issues/357)
* Fix sortable behaviour [#287](https://github.com/joomlatools/joomlatools-platform/issues/287)

## 1.0.4 (2016-03-08)

### Fixed

* Ported security fixes from Joomla v3.4.6 - v3.4.8 [#297](https://github.com/joomlatools/joomlatools-platform/issues/297)
* Fixed PHP7 compatibility [#247](https://github.com/joomlatools/joomlatools-platform/issues/247)
* Fixed language cookie path [#303](https://github.com/joomlatools/joomlatools-platform/issues/303)

### Changed

* Refactored error handling [#165](https://github.com/joomlatools/joomlatools-platform/issues/165)

## 1.0.3 (2016-02-01)

### Fixed 

* Keep JVERSION compatible with Joomla [#290](https://github.com/joomlatools/joomlatools-platform/issues/290)
* Gitignore ignores lib/libraries/joomla/log [#289](https://github.com/joomlatools/joomlatools-platform/issues/289)

### Added

* Added missing authors to COPYRIGHT.md [#284](https://github.com/joomlatools/joomlatools-platform/issues/284)

## 1.0.2 (2015-11-30)

### Added

* Added JOOMLATOOLS_PLATFORM define [#273](https://github.com/joomlatools/joomlatools-platform/issues/273)
* Added COPYRIGHT.md file [#282](https://github.com/joomlatools/joomlatools-platform/issues/282)

### Fixed 

* Fixed Declaration of JMail::addAttachment() should be compatible with PHPMailer::addAttachment() [#266](https://github.com/joomlatools/joomlatools-platform/issues/266)

### Changed

* Require phpdotenv 2.1.0 release [#278](https://github.com/joomlatools/joomlatools-platform/issues/276)
* Renamed repository [#278](https://github.com/joomlatools/joomlatools-platform/issues/278)

## 1.0.1 (2015-11-13)

### Fixed

* Fixed Session fixation vulnerability [#253](https://github.com/joomlatools/joomlatools-platform/issues/253)
* Fixed Security issues in Joomla v3.4.5 [#249](https://github.com/joomlatools/joomlatools-platform/issues/249)
* Fixed Undefined variable $im when editing plugin [#242](https://github.com/joomlatools/joomlatools-platform/issues/242)
* Fixed Menu manager cannot find the view manifest [#241](https://github.com/joomlatools/joomlatools-platform/issues/241)
* Fixed Fix event dispatching inconsistencies [#164](https://github.com/joomlatools/joomlatools-platform/issues/164)

### Changed

* Disabled anonymous sessions [#251](https://github.com/joomlatools/joomlatools-platform/issues/251)
* Moved legacy libraries into separate repo [#258](https://github.com/joomlatools/joomlatools-platform/issues/258)
* Improved administrator menu [#248](https://github.com/joomlatools/joomlatools-platform/issues/248)
* Do not load .env file in production [#246](https://github.com/joomlatools/joomlatools-platform/issues/246)

### Removed

* Removed debug plugin [#263](https://github.com/joomlatools/joomlatools-platform/pull/263)

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

* Changed license to GPLv3 [#201](https://github.com/joomlatools/joomlatools-platform/pull/201)
* Moved the categories extension to the [platform-categories] repo [#209](https://github.com/joomlatools/joomlatools-platform/pull/209)
* Moved the search extension to the [platform-search] repo [#195](https://github.com/joomlatools/joomlatools-platform/pull/195)
* Moved the content extension to the [platform-content] repo [#180](https://github.com/joomlatools/joomlatools-platform/pull/180)
* Moved the contenthistory extension to the [platform-content] repo [#189](https://github.com/joomlatools/joomlatools-platform/pull/189)
* Moved the tags extension to the [platform-content] repo [#176](https://github.com/joomlatools/joomlatools-platform/pull/176)
* Moved the media extension to the [platform-media] repo [#174](https://github.com/joomlatools/joomlatools-platform/pull/174)
* Moved the finder extension to the [platform-finder] repo [#170](https://github.com/joomlatools/joomlatools-platform/pull/170)
* Renamed 'template_styles' table to 'templates' [#225](https://github.com/joomlatools/joomlatools-platform/pull/225)
* Renamed user related database tables [#221](https://github.com/joomlatools/joomlatools-platform/pull/221)
* Renamed 'associations' table to 'languages_associations' [#218](https://github.com/joomlatools/joomlatools-platform/pull/218)
* Do not store the 'mediaVersion' in the database [#197](https://github.com/joomlatools/joomlatools-platform/pull/197)
* Do not log a warning if a component cannot be loaded [#180](https://github.com/joomlatools/joomlatools-platform/pull/180)
* Moved language files into (extension)/language directory [#178](https://github.com/joomlatools/joomlatools-platform/pull/178)
* Moved admin "my profile" functionality into com_users [#154](https://github.com/joomlatools/joomlatools-platform/pull/154)
* Moved admin login functionality into com_user [#153](https://github.com/joomlatools/joomlatools-platform/pull/153)
* Changed generator tag [#151](https://github.com/joomlatools/joomlatools-platform/pull/151)

### Removed

* Removed PHP5.5 compatibility [#124](https://github.com/joomlatools/joomlatools-platform/pull/124)
* Removed mod_multilangstatus [#213](https://github.com/joomlatools/joomlatools-platform/pull/213)
* Removed mod_footer [#86](https://github.com/joomlatools/joomlatools-platform/pull/86)
* Removed mod_users_latest [#107](https://github.com/joomlatools/joomlatools-platform/pull/107)
* Removed mod_related_items [#84](https://github.com/joomlatools/joomlatools-platform/pull/84)
* Removed mod_version [#63](https://github.com/joomlatools/joomlatools-platform/pull/63)
* Removed mod_random_image [#49](https://github.com/joomlatools/joomlatools-platform/pull/49)
* Removed mod_stats and mod_stats_admin [#47](https://github.com/joomlatools/joomlatools-platform/pull/47)
* Removed mod_whosonline [#45](https://github.com/joomlatools/joomlatools-platform/pull/45)
* Removed mod_syndicate [#43](https://github.com/joomlatools/joomlatools-platform/pull/43)
* Removed tpl_beez3 [#41](https://github.com/joomlatools/joomlatools-platform/pull/41)
* Removed tpl_hathor [#24](https://github.com/joomlatools/joomlatools-platform/pull/24)
* Removed plg_system_languagecode [#211](https://github.com/joomlatools/joomlatools-platform/pull/211)
* Removed plg_content_emailcloak [#207](https://github.com/joomlatools/joomlatools-platform/pull/207)
* Removed plg_captcha_recaptcha [#98](https://github.com/joomlatools/joomlatools-platform/pull/98)
* Removed plg_authentication_ldap [#60](https://github.com/joomlatools/joomlatools-platform/pull/60)
* Removed plg_authentication_gmail [#58](https://github.com/joomlatools/joomlatools-platform/pull/58)
* Removed plg_system_cache [#57](https://github.com/joomlatools/joomlatools-platform/pull/57)
* Removed plg_content_vote [#55](https://github.com/joomlatools/joomlatools-platform/pull/55)
* Removed plg_system_p3p [#53](https://github.com/joomlatools/joomlatools-platform/pull/53)
* Removed com_ajax [#34](https://github.com/joomlatools/joomlatools-platform/pull/34)
* Removed com_massmail [#32](https://github.com/joomlatools/joomlatools-platform/pull/32)
* Removed com_mailto [#30](https://github.com/joomlatools/joomlatools-platform/pull/30)
* Removed com_wrapper [#28](https://github.com/joomlatools/joomlatools-platform/pull/28)
* Removed com_joomlaupdate [#26](https://github.com/joomlatools/joomlatools-platform/pull/26)
* Removed com_postinstall [#25](https://github.com/joomlatools/joomlatools-platform/pull/25)
* Removed com_messages [#22](https://github.com/joomlatools/joomlatools-platform/pull/22)
* Removed com_newsfeeds [#21](https://github.com/joomlatools/joomlatools-platform/pull/21)
* Removed com_contacts [#20](https://github.com/joomlatools/joomlatools-platform/pull/20)
* Removed com_banners [#17](https://github.com/joomlatools/joomlatools-platform/pull/17)
* Removed com_redirect [#16](https://github.com/joomlatools/joomlatools-platform/pull/16)
* Removed Library - phputf8 [#144](https://github.com/joomlatools/joomlatools-platform/pull/144)
* Removed Library - FOF library [#94](https://github.com/joomlatools/joomlatools-platform/pull/94)
* Removed Library - JOauth1 and 2 [#90](https://github.com/joomlatools/joomlatools-platform/pull/90)
* Removed Library - JApplicationDaemon [#82](https://github.com/joomlatools/joomlatools-platform/pull/82)
* Removed Library - JOpenstreetmap [#80](https://github.com/joomlatools/joomlatools-platform/pull/80)
* Removed Library - JMediawiki [#78](https://github.com/joomlatools/joomlatools-platform/pull/78)
* Removed Library - JLinkedin [#76](https://github.com/joomlatools/joomlatools-platform/pull/76)
* Removed Library - JGoogle [#74](https://github.com/joomlatools/joomlatools-platform/pull/74)
* Removed Library - JGithub [#72](https://github.com/joomlatools/joomlatools-platform/pull/72)
* Removed Library - JFacebook [#70](https://github.com/joomlatools/joomlatools-platform/pull/70)
* Removed Library - JTwitter [#68](https://github.com/joomlatools/joomlatools-platform/pull/68)
* Removed Library - JClientLdap [#61](https://github.com/joomlatools/joomlatools-platform/pull/61)
* Removed Library - SimplePie [#39](https://github.com/joomlatools/joomlatools-platform/pull/39)
* Removed codemirror editor [#134](https://github.com/joomlatools/joomlatools-platform/pull/134)
* Removed /tests folder [#172](https://github.com/joomlatools/joomlatools-platform/pull/172)
* Removed /build folder [#115](https://github.com/joomlatools/joomlatools-platform/pull/115)
* Removed /installation folder [#113](https://github.com/joomlatools/joomlatools-platform/pull/113)
* Removed sample data  [#19](https://github.com/joomlatools/joomlatools-platform/pull/19)
* Removed sample data images [#193](https://github.com/joomlatools/joomlatools-platform/pull/193)
* Removed tag id to titles logic in JDocumentRendererHead [#192](https://github.com/joomlatools/joomlatools-platform/pull/192)
* Removed versioning support from com_categories [#186](https://github.com/joomlatools/joomlatools-platform/pull/186)
* Removed tag support from com_categories [#184](https://github.com/joomlatools/joomlatools-platform/pull/184)
* Removed partially implemented tags support from com_users [#182](https://github.com/joomlatools/joomlatools-platform/pull/182)
* Removed search term logging functionality [#51](https://github.com/joomlatools/joomlatools-platform/pull/51)
* Removed template edit functionality [#110](https://github.com/joomlatools/joomlatools-platform/pull/110)
* Removed the language override functionality [#105](https://github.com/joomlatools/joomlatools-platform/pull/105)
* Removed the extension installer functionality [#101](https://github.com/joomlatools/joomlatools-platform/pull/101)
* Removed Mass Mail and User Notes functionality [#100](https://github.com/joomlatools/joomlatools-platform/pull/100)
* Removed system info view from com_admin [#99](https://github.com/joomlatools/joomlatools-platform/pull/99)
* Removed finder CLI script. Use [joomlatools-console v1.4] [#167](https://github.com/joomlatools/joomlatools-platform/pull/167)
* Removed com_checkin. Use [joomlatools-console v1.4] [#141](https://github.com/joomlatools/joomlatools-platform/pull/141)
* Removed com_cache. Use [joomlatools-console v1.4] [#138](https://github.com/joomlatools/joomlatools-platform/pull/138)
* Removed com_config from the site application [#160](https://github.com/joomlatools/joomlatools-platform/pull/160)
* Removed global configuration user interface [#152](https://github.com/joomlatools/joomlatools-platform/pull/152)
* Removed 'Text Filter' config settings [#158](https://github.com/joomlatools/joomlatools-platform/pull/158)
* Removed offline config settings [#146](https://github.com/joomlatools/joomlatools-platform/pull/146)
* Removed the 'root_user' config setting[#157](https://github.com/joomlatools/joomlatools-platform/pull/157)
* Removed proxy config setting [#132](https://github.com/joomlatools/joomlatools-platform/pull/132)
* Removed gzip config setting [#130](https://github.com/joomlatools/joomlatools-platform/pull/130)
* Removed error_reporting config setting [#128](https://github.com/joomlatools/joomlatools-platform/pull/128)
* Removed FTP config settings [#117](https://github.com/joomlatools/joomlatools-platform/pull/117)
* Removed $_PROFILER global [#127](https://github.com/joomlatools/joomlatools-platform/pull/127)
* Removed less compiler and generatecss build cli command [#92](https://github.com/joomlatools/joomlatools-platform/pull/92)
* Removed two factor authentication implementation [#66](https://github.com/joomlatools/joomlatools-platform/pull/66)
* Removed keychain cli command and related library [#37](https://github.com/joomlatools/joomlatools-platform/pull/37)
* Removed help [#35](https://github.com/joomlatools/joomlatools-platform/pull/35)
* Removed index.html files and add .gitignore for empty directories [#88](https://github.com/joomlatools/joomlatools-platform/pull/88)
 
[platform-categories]: https://github.com/joomlatools/joomlatools-platform-categories
[platform-search]: https://github.com/joomlatools/joomlatools-platform-search
[platform-content]: https://github.com/joomlatools/joomlatools-platform-content
[platform-media]: https://github.com/joomlatools/joomlatools-platform-media
[platform-finder]: https://github.com/joomlatools/joomlatools-platform-finder

[joomlatools-console v1.4]: https://github.com/joomlatools/joomlatools-console/releases/tag/v1.4.0