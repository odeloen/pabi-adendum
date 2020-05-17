<?php

namespace App\Ods\Elearning\Common\Modifier;

abstract class ActionModifier {
    const Unmodified = null;
    const Created = 0;
    const Updated = 1;
    const Deleted = -1;
}
