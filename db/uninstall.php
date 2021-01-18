<?php
// This file is part of Moodle - http://moodle.org/
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
 * Code that is executed before the tables and data are dropped during the plugin uninstallation.
 *
 * @package     block_zoomwebinarhost
 * @category    upgrade
 * @copyright   2020 zoomwebinarhost
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Custom uninstallation procedure.
 */
function xmldb_block_zoomwebinarhost_uninstall()
{
    global $DB;

    $dbman = $DB->get_manager();

    $plugintable = get_string('plugintable', 'block_zoomwebinarhost');

    $table = new xmldb_table($plugintable);

    if ($dbman->table_exists($table)) {
        $dbman->drop_table($table, $continue=true, $feedback=true);
    }
}
