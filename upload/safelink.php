<?php
/***************************************************************************
MyBB SafeLink
Copyright 2011-2016, fizz (http://community.mybb.com/user-36020.html)
Copyright 2022, Travis Newton (https://nightfox.tech)
Version 1.3.5
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
****************************************************************************/


define("IN_MYBB", 1);
define('THIS_SCRIPT', 'safelink.php');

require_once("./global.php");

if(!$lang->safelink)
	$lang->load("safelink");

// Add link in breadcrumb
add_breadcrumb($lang->safelink, "safelink.php");
if($mybb->settings['safelink_enabled'] == 1)
{
	if($mybb->input['url'])
	{
		
		if(!filter_var($mybb->input['url'], FILTER_VALIDATE_URL))
		{
			$error = $lang->sl_badurl;
		}
		else
		{
			$v = substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "safelink.php?url=")); // these 2 lines filter out the url to continue to
			$url = str_replace('safelink.php?url=', '', $v); // only problem with these is it will replace all occurrencesof 'safelink.php?url=' in the url, and I don't know how to fix this (preg_replace perhaps?)
			$group = $mybb->user['usergroup'];
			$groups = explode(",", $mybb->settings['safelink_groups']);
			$excludes = explode("\n", $mybb->settings['safelink_urls']);
			foreach($excludes as $exclude)
			{
				if(!preg_match("#^".trim($exclude)."+[\d\w]*#i", $url) && !in_array($group, $groups)) // not an excluded site, go to safelink page and link intended URL
				{
					$warning = $lang->sl_warning;
					$continue = $lang->sl_continue;
				}
				else // site excluded from safelink OR user is in excluded usergroup
				{
					header("location:$url");
				}
			}
		}
	}
	else
	{
		$error = $lang->sl_nourl;
	}
}
else
{
	$error = $lang->sl_disabled;
}
eval("\$safelink = \"".$templates->get("safelink")."\";");

output_page($safelink);

exit;
?>