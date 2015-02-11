<?php

/**
 * Escape user input.
 *
 * @param string $text
 * @return string
 */
function e($text) {
    return htmlentities($text, ENT_HTML5 | ENT_QUOTES, "UTF-8");
}
