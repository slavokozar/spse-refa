<?php

function url_params($replace = [])
{
    return array_merge(request()->query(), request()->route()->parameters(), $replace);
}
