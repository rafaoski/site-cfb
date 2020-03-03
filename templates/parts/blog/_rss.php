<?php namespace ProcessWire;

$rss = modules()->get("MarkupRSS");
$rss->title = setting('recent-posts');
$rss->description = setting('in-blog');
$rss->render(page()->children("limit=12"));

