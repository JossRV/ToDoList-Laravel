<?php

namespace App\Actions\Users;

use App\Actions\AbstractAction;
use App\Library\ActionResult;

class CreateUserAction extends AbstractAction
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        return ActionResult::success('Executed CreateUserAction successfully');
    }
}
