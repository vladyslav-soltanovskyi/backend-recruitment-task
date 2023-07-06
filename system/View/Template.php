<?php

namespace System\View;

class Template
{
	public static function render(string $pathToTemplate, array $vars = []): string
	{
		extract($vars);
		ob_start();
		include ($pathToTemplate);
		return ob_get_clean();
	}
}
