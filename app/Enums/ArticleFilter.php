<?php

namespace App\Enums;

enum ArticleFilter: string
{
    case Published = 'published';
    case Trashed = 'trashed';
}
