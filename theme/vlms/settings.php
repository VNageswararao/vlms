<?php
// This file is part of Ranking block for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme vlms block settings file
 *
 * @package    theme_vlms
 * @copyright  2017 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingvlms', get_string('configtitle', 'theme_vlms'));

    /*
    * ----------------------
    * General settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_vlms_general', get_string('generalsettings', 'theme_vlms'));

    // Logo file setting.
    $name = 'theme_vlms/logo';
    $title = get_string('logo', 'theme_vlms');
    $description = get_string('logodesc', 'theme_vlms');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Favicon setting.
    $name = 'theme_vlms/favicon';
    $title = get_string('favicon', 'theme_vlms');
    $description = get_string('favicondesc', 'theme_vlms');
    $opts = array('accepted_types' => array('.ico'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset.
    $name = 'theme_vlms/preset';
    $title = get_string('preset', 'theme_vlms');
    $description = get_string('preset_desc', 'theme_vlms');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_vlms', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_vlms/presetfiles';
    $title = get_string('presetfiles', 'theme_vlms');
    $description = get_string('presetfiles_desc', 'theme_vlms');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Login page background image.
    $name = 'theme_vlms/loginbgimg';
    $title = get_string('loginbgimg', 'theme_vlms');
    $description = get_string('loginbgimg_desc', 'theme_vlms');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbgimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_vlms/brandcolor';
    $title = get_string('brandcolor', 'theme_vlms');
    $description = get_string('brandcolor_desc', 'theme_vlms');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-header-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_vlms/navbarheadercolor';
    $title = get_string('navbarheadercolor', 'theme_vlms');
    $description = get_string('navbarheadercolor_desc', 'theme_vlms');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-bg.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_vlms/navbarbg';
    $title = get_string('navbarbg', 'theme_vlms');
    $description = get_string('navbarbg_desc', 'theme_vlms');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-bg-hover.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_vlms/navbarbghover';
    $title = get_string('navbarbghover', 'theme_vlms');
    $description = get_string('navbarbghover_desc', 'theme_vlms');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Course format option.
    $name = 'theme_vlms/coursepresentation';
    $title = get_string('coursepresentation', 'theme_vlms');
    $description = get_string('coursepresentationdesc', 'theme_vlms');
    $options = [];
    $options[1] = get_string('coursedefault', 'theme_vlms');
    $options[2] = get_string('coursecover', 'theme_vlms');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_vlms/courselistview';
    $title = get_string('courselistview', 'theme_vlms');
    $description = get_string('courselistviewdesc', 'theme_vlms');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    /*
    * ----------------------
    * Advanced settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_vlms_advanced', get_string('advancedsettings', 'theme_vlms'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_vlms/scsspre',
        get_string('rawscsspre', 'theme_vlms'), get_string('rawscsspre_desc', 'theme_vlms'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_vlms/scss', get_string('rawscss', 'theme_vlms'),
        get_string('rawscss_desc', 'theme_vlms'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Google analytics block.
    $name = 'theme_vlms/googleanalytics';
    $title = get_string('googleanalytics', 'theme_vlms');
    $description = get_string('googleanalyticsdesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    /*
    * -----------------------
    * Frontpage settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_vlms_frontpage', get_string('frontpagesettings', 'theme_vlms'));

    // Disable bottom footer.
    $name = 'theme_vlms/disablefrontpageloginbox';
    $title = get_string('disablefrontpageloginbox', 'theme_vlms');
    $description = get_string('disablefrontpageloginboxdesc', 'theme_vlms');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Disable teachers from cards.
    $name = 'theme_vlms/disableteacherspic';
    $title = get_string('disableteacherspic', 'theme_vlms');
    $description = get_string('disableteacherspicdesc', 'theme_vlms');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Headerimg file setting.
    $name = 'theme_vlms/headerimg';
    $title = get_string('headerimg', 'theme_vlms');
    $description = get_string('headerimgdesc', 'theme_vlms');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannerheading.
    $name = 'theme_vlms/bannerheading';
    $title = get_string('bannerheading', 'theme_vlms');
    $description = get_string('bannerheadingdesc', 'theme_vlms');
    $default = 'Perfect Learning System';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannercontent.
    $name = 'theme_vlms/bannercontent';
    $title = get_string('bannercontent', 'theme_vlms');
    $description = get_string('bannercontentdesc', 'theme_vlms');
    $default = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_vlms/displaymarketingbox';
    $title = get_string('displaymarketingbox', 'theme_vlms');
    $description = get_string('displaymarketingboxdesc', 'theme_vlms');
    $default = 1;
    $choices = array(0 => 'No', 1 => 'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    // Marketing1icon.
    $name = 'theme_vlms/marketing1icon';
    $title = get_string('marketing1icon', 'theme_vlms');
    $description = get_string('marketing1icondesc', 'theme_vlms');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1heading.
    $name = 'theme_vlms/marketing1heading';
    $title = get_string('marketing1heading', 'theme_vlms');
    $description = get_string('marketing1headingdesc', 'theme_vlms');
    $default = 'We host';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1subheading.
    $name = 'theme_vlms/marketing1subheading';
    $title = get_string('marketing1subheading', 'theme_vlms');
    $description = get_string('marketing1subheadingdesc', 'theme_vlms');
    $default = 'your MOODLE';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1content.
    $name = 'theme_vlms/marketing1content';
    $title = get_string('marketing1content', 'theme_vlms');
    $description = get_string('marketing1contentdesc', 'theme_vlms');
    $default = 'Moodle hosting in a powerful cloud infrastructure';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1url.
    $name = 'theme_vlms/marketing1url';
    $title = get_string('marketing1url', 'theme_vlms');
    $description = get_string('marketing1urldesc', 'theme_vlms');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2icon.
    $name = 'theme_vlms/marketing2icon';
    $title = get_string('marketing2icon', 'theme_vlms');
    $description = get_string('marketing2icondesc', 'theme_vlms');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2heading.
    $name = 'theme_vlms/marketing2heading';
    $title = get_string('marketing2heading', 'theme_vlms');
    $description = get_string('marketing2headingdesc', 'theme_vlms');
    $default = 'Consulting';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2subheading.
    $name = 'theme_vlms/marketing2subheading';
    $title = get_string('marketing2subheading', 'theme_vlms');
    $description = get_string('marketing2subheadingdesc', 'theme_vlms');
    $default = 'for your company';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2content.
    $name = 'theme_vlms/marketing2content';
    $title = get_string('marketing2content', 'theme_vlms');
    $description = get_string('marketing2contentdesc', 'theme_vlms');
    $default = 'Moodle consulting and training for you';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2url.
    $name = 'theme_vlms/marketing2url';
    $title = get_string('marketing2url', 'theme_vlms');
    $description = get_string('marketing2urldesc', 'theme_vlms');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3icon.
    $name = 'theme_vlms/marketing3icon';
    $title = get_string('marketing3icon', 'theme_vlms');
    $description = get_string('marketing3icondesc', 'theme_vlms');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3heading.
    $name = 'theme_vlms/marketing3heading';
    $title = get_string('marketing3heading', 'theme_vlms');
    $description = get_string('marketing3headingdesc', 'theme_vlms');
    $default = 'Development';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3subheading.
    $name = 'theme_vlms/marketing3subheading';
    $title = get_string('marketing3subheading', 'theme_vlms');
    $description = get_string('marketing3subheadingdesc', 'theme_vlms');
    $default = 'themes and plugins';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3content.
    $name = 'theme_vlms/marketing3content';
    $title = get_string('marketing3content', 'theme_vlms');
    $description = get_string('marketing3contentdesc', 'theme_vlms');
    $default = 'We develop themes and plugins as your desires';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3url.
    $name = 'theme_vlms/marketing3url';
    $title = get_string('marketing3url', 'theme_vlms');
    $description = get_string('marketing3urldesc', 'theme_vlms');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4icon.
    $name = 'theme_vlms/marketing4icon';
    $title = get_string('marketing4icon', 'theme_vlms');
    $description = get_string('marketing4icondesc', 'theme_vlms');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing4icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4heading.
    $name = 'theme_vlms/marketing4heading';
    $title = get_string('marketing4heading', 'theme_vlms');
    $description = get_string('marketing4headingdesc', 'theme_vlms');
    $default = 'Support';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4subheading.
    $name = 'theme_vlms/marketing4subheading';
    $title = get_string('marketing4subheading', 'theme_vlms');
    $description = get_string('marketing4subheadingdesc', 'theme_vlms');
    $default = 'we give you answers';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4content.
    $name = 'theme_vlms/marketing4content';
    $title = get_string('marketing4content', 'theme_vlms');
    $description = get_string('marketing4contentdesc', 'theme_vlms');
    $default = 'MOODLE specialized support';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4url.
    $name = 'theme_vlms/marketing4url';
    $title = get_string('marketing4url', 'theme_vlms');
    $description = get_string('marketing4urldesc', 'theme_vlms');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Enable or disable Slideshow settings.
    $name = 'theme_vlms/sliderenabled';
    $title = get_string('sliderenabled', 'theme_vlms');
    $description = get_string('sliderenableddesc', 'theme_vlms');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Enable slideshow on frontpage guest page.
    $name = 'theme_vlms/sliderfrontpage';
    $title = get_string('sliderfrontpage', 'theme_vlms');
    $description = get_string('sliderfrontpagedesc', 'theme_vlms');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_vlms/slidercount';
    $title = get_string('slidercount', 'theme_vlms');
    $description = get_string('slidercountdesc', 'theme_vlms');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 13; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $slidercount = get_config('theme_vlms', 'slidercount');

    if (!$slidercount) {
        $slidercount = 1;
    }

    for ($sliderindex = 1; $sliderindex <= $slidercount; $sliderindex++) {
        $fileid = 'sliderimage' . $sliderindex;
        $name = 'theme_vlms/sliderimage' . $sliderindex;
        $title = get_string('sliderimage', 'theme_vlms');
        $description = get_string('sliderimagedesc', 'theme_vlms');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_vlms/slidertitle' . $sliderindex;
        $title = get_string('slidertitle', 'theme_vlms');
        $description = get_string('slidertitledesc', 'theme_vlms');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);

        $name = 'theme_vlms/slidercap' . $sliderindex;
        $title = get_string('slidercaption', 'theme_vlms');
        $description = get_string('slidercaptiondesc', 'theme_vlms');
        $default = '';
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);
    }

    // Enable or disable Slideshow settings.
    $name = 'theme_vlms/numbersfrontpage';
    $title = get_string('numbersfrontpage', 'theme_vlms');
    $description = get_string('numbersfrontpagedesc', 'theme_vlms');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Enable sponsors on frontpage guest page.
    $name = 'theme_vlms/sponsorsfrontpage';
    $title = get_string('sponsorsfrontpage', 'theme_vlms');
    $description = get_string('sponsorsfrontpagedesc', 'theme_vlms');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_vlms/sponsorstitle';
    $title = get_string('sponsorstitle', 'theme_vlms');
    $description = get_string('sponsorstitledesc', 'theme_vlms');
    $default = get_string('sponsorstitledefault', 'theme_vlms');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_vlms/sponsorssubtitle';
    $title = get_string('sponsorssubtitle', 'theme_vlms');
    $description = get_string('sponsorssubtitledesc', 'theme_vlms');
    $default = get_string('sponsorssubtitledefault', 'theme_vlms');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_vlms/sponsorscount';
    $title = get_string('sponsorscount', 'theme_vlms');
    $description = get_string('sponsorscountdesc', 'theme_vlms');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 5; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $sponsorscount = get_config('theme_vlms', 'sponsorscount');

    if (!$sponsorscount) {
        $sponsorscount = 1;
    }

    for ($sponsorsindex = 1; $sponsorsindex <= $sponsorscount; $sponsorsindex++) {
        $fileid = 'sponsorsimage' . $sponsorsindex;
        $name = 'theme_vlms/sponsorsimage' . $sponsorsindex;
        $title = get_string('sponsorsimage', 'theme_vlms');
        $description = get_string('sponsorsimagedesc', 'theme_vlms');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_vlms/sponsorsurl' . $sponsorsindex;
        $title = get_string('sponsorsurl', 'theme_vlms');
        $description = get_string('sponsorsurldesc', 'theme_vlms');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);
    }

    // Enable clients on frontpage guest page.
    $name = 'theme_vlms/clientsfrontpage';
    $title = get_string('clientsfrontpage', 'theme_vlms');
    $description = get_string('clientsfrontpagedesc', 'theme_vlms');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_vlms/clientstitle';
    $title = get_string('clientstitle', 'theme_vlms');
    $description = get_string('clientstitledesc', 'theme_vlms');
    $default = get_string('clientstitledefault', 'theme_vlms');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_vlms/clientssubtitle';
    $title = get_string('clientssubtitle', 'theme_vlms');
    $description = get_string('clientssubtitledesc', 'theme_vlms');
    $default = get_string('clientssubtitledefault', 'theme_vlms');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_vlms/clientscount';
    $title = get_string('clientscount', 'theme_vlms');
    $description = get_string('clientscountdesc', 'theme_vlms');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 5; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $clientscount = get_config('theme_vlms', 'clientscount');

    if (!$clientscount) {
        $clientscount = 1;
    }

    for ($clientsindex = 1; $clientsindex <= $clientscount; $clientsindex++) {
        $fileid = 'clientsimage' . $clientsindex;
        $name = 'theme_vlms/clientsimage' . $clientsindex;
        $title = get_string('clientsimage', 'theme_vlms');
        $description = get_string('clientsimagedesc', 'theme_vlms');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_vlms/clientsurl' . $clientsindex;
        $title = get_string('clientsurl', 'theme_vlms');
        $description = get_string('clientsurldesc', 'theme_vlms');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);
    }

    $settings->add($page);

    /*
    * --------------------
    * Footer settings tab
    * --------------------
    */
    $page = new admin_settingpage('theme_vlms_footer', get_string('footersettings', 'theme_vlms'));

    $name = 'theme_vlms/getintouchcontent';
    $title = get_string('getintouchcontent', 'theme_vlms');
    $description = get_string('getintouchcontentdesc', 'theme_vlms');
    $default = 'Conecti.me';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Website.
    $name = 'theme_vlms/website';
    $title = get_string('website', 'theme_vlms');
    $description = get_string('websitedesc', 'theme_vlms');
    $default = 'http://conecti.me';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mobile.
    $name = 'theme_vlms/mobile';
    $title = get_string('mobile', 'theme_vlms');
    $description = get_string('mobiledesc', 'theme_vlms');
    $default = 'Mobile : +55 (98) 00123-45678';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mail.
    $name = 'theme_vlms/mail';
    $title = get_string('mail', 'theme_vlms');
    $description = get_string('maildesc', 'theme_vlms');
    $default = 'willianmano@conecti.me';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Facebook url setting.
    $name = 'theme_vlms/facebook';
    $title = get_string('facebook', 'theme_vlms');
    $description = get_string('facebookdesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Twitter url setting.
    $name = 'theme_vlms/twitter';
    $title = get_string('twitter', 'theme_vlms');
    $description = get_string('twitterdesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Linkdin url setting.
    $name = 'theme_vlms/linkedin';
    $title = get_string('linkedin', 'theme_vlms');
    $description = get_string('linkedindesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Youtube url setting.
    $name = 'theme_vlms/youtube';
    $title = get_string('youtube', 'theme_vlms');
    $description = get_string('youtubedesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Instagram url setting.
    $name = 'theme_vlms/instagram';
    $title = get_string('instagram', 'theme_vlms');
    $description = get_string('instagramdesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Whatsapp url setting.
    $name = 'theme_vlms/whatsapp';
    $title = get_string('whatsapp', 'theme_vlms');
    $description = get_string('whatsappdesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Top footer background image.
    $name = 'theme_vlms/topfooterimg';
    $title = get_string('topfooterimg', 'theme_vlms');
    $description = get_string('topfooterimgdesc', 'theme_vlms');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'topfooterimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // Forum page.
    $settingpage = new admin_settingpage('theme_vlms_forum', get_string('forumsettings', 'theme_vlms'));

    $settingpage->add(new admin_setting_heading('theme_vlms_forumheading', null,
            format_text(get_string('forumsettingsdesc', 'theme_vlms'), FORMAT_MARKDOWN)));

    // Enable custom template.
    $name = 'theme_vlms/forumcustomtemplate';
    $title = get_string('forumcustomtemplate', 'theme_vlms');
    $description = get_string('forumcustomtemplatedesc', 'theme_vlms');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settingpage->add($setting);

    // Header setting.
    $name = 'theme_vlms/forumhtmlemailheader';
    $title = get_string('forumhtmlemailheader', 'theme_vlms');
    $description = get_string('forumhtmlemailheaderdesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settingpage->add($setting);

    // Footer setting.
    $name = 'theme_vlms/forumhtmlemailfooter';
    $title = get_string('forumhtmlemailfooter', 'theme_vlms');
    $description = get_string('forumhtmlemailfooterdesc', 'theme_vlms');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settingpage->add($setting);

    $settings->add($settingpage);
}
