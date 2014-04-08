<?php

function upgrade_module_2_5($module)
{
	$module_path = $module->getLocalPath();
	$img_folder_path = $module->getLocalPath().'img';

	if (!Tools::file_exists_cache($img_folder_path))
		mkdir($img_folder_path);

	$files = scandir($module->getLocalPath());

	foreach ($files as $file)
	{
		if (strncmp($file, 'homepage_logo', 13) == 0)
		{
			copy($module_path.$file, $img_folder_path.DIRECTORY_SEPARATOR.$file);
			unlink($module_path.$file);
		}
	}

	Tools::clearCache(Context::getContext()->smarty, $module->getTemplatePath('editorial.tpl'));
	return true;
}