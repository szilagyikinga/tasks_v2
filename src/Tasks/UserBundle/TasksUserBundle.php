<?php

namespace Tasks\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TasksUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
