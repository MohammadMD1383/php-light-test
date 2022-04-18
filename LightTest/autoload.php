<?php
spl_autoload_register(fn(string $str) => require_once str_replace("\\", "/", $str) . ".php");
