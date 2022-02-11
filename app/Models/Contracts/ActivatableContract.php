<?php

namespace App\Models\Contracts;

interface ActivatableContract
{
    /**
     * Activate model.
     *
     * @return void
     */
    public function activate();

    /**
     * Deactivate model.
     *
     * @return void
     */
    public function deactivate();

    /**
     * If model is activated.
     *
     * @return bool
     */
    public function isActivated(): bool;
}
