<?php

/**
 * Samba global settings view.
 *
 * @category   apps
 * @package    samba
 * @subpackage views
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/samba/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.  
//  
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('base');
$this->lang->load('samba');
$this->lang->load('samba_common');

///////////////////////////////////////////////////////////////////////////////
// Form handler
///////////////////////////////////////////////////////////////////////////////

if ($form_type === 'edit') {
    $read_only = FALSE;
    $buttons = array(
        form_submit_update('submit', 'high'),
        anchor_cancel('/app/samba/settings')
    );
} else {
    $read_only = TRUE;
    $buttons = array(
        anchor_edit('/app/samba/settings/edit')
    );
}

if ($ad_mode) {
    $netbios_read_only = TRUE;
} else {
    $netbios_read_only = $read_only;
}

///////////////////////////////////////////////////////////////////////////////
// Form
///////////////////////////////////////////////////////////////////////////////

echo form_open('samba/settings/edit');
echo form_header(lang('base_settings'));

echo field_input('netbios', $netbios, lang('samba_common_server_name'), $netbios_read_only);
echo field_input('comment', $comment, lang('samba_common_server_comment'), $read_only);
if ($show_printing)
    echo field_dropdown('printing', $printing_options, $printing, lang('samba_common_printing'), $read_only);
echo field_toggle_enable_disable('homes', $homes, lang('samba_common_home_directories'), $read_only);
echo field_toggle_enable_disable('win10_support', $win10_support, lang('samba_common_windows_10_support'), $read_only);
echo field_toggle_enable_disable('wins_support', $wins_support, lang('samba_common_wins_support'), $read_only);
echo field_input('wins_server', $wins_server, lang('samba_common_wins_server'), $read_only);

echo field_button_set($buttons);

echo form_footer();
echo form_close();

///////////////////////////////////////////////////////////////////////////////
// Infobox
///////////////////////////////////////////////////////////////////////////////

if ($ad_mode && ($form_type === 'edit')) {
    echo infobox_highlight(
        lang('samba_common_active_directory_connector_mode'),
        lang('samba_common_active_directory_connector_mode_help') . 
        "<p align='center'>" . anchor_custom('/app/active_directory/edit', lang('samba_common_reconnect_to_active_directory'))
    );
}
