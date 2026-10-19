<?php
// Escape output for safe display in HTML
function e($v): string {
    return htmlspecialchars((string)$v, ENT_QUOTES, "UTF-8");
}
