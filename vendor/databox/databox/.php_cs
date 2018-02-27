<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__);

$fixers = [
	'blankline_after_open_tag',	'double_arrow_multiline_whitespaces', 'extra_empty_lines', 'new_with_braces', 'no_blank_lines_after_class_opening', 'no_empty_lines_after_phpdocs', 'phpdoc_params', 'phpdoc_scalar', 'remove_leading_slash_use', 'remove_lines_between_uses', 'return', 'self_accessor', 'single_blank_line_before_namespace', 'single_quote', 'spaces_cast', 'unused_use', 'align_double_arrow', 'align_equals', 'concat_with_spaces', 'newline_after_open_tag', 'no_blank_lines_before_namespace', 'ordered_use', 'phpdoc_order', 'short_array_syntax', 'strict'
];

return Symfony\CS\Config\Config::create()
    ->setUsingCache(true)
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers($fixers)
    ->finder($finder);
