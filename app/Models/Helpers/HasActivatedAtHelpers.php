<?php

namespace App\Models\Helpers;

use Carbon\Carbon;

trait HasActivatedAtHelpers
{
    /**
     * Set activated flag.
     *
     * @return $this
     */
    public function setActivatedFlag()
    {
        $this->setAttribute('activated_at', Carbon::now());

        return $this;
    }

    /**
     * Unset activated flag.
     *
     * @return $this
     */
    public function unsetActivatedFlag()
    {
        $this->setAttribute('activated_at', null);

        return $this;
    }

    /**
     * If model is activated.
     *
     * @return bool
     */
    public function isActivated(): bool
    {
        return ! is_null($this->getAttributeValue('activated_at'));
    }

    /**
     * If model is not activated.
     *
     * @return bool
     */
    public function isNotActivated(): bool
    {
        return ! $this->isActivated();
    }

    /**
     * Activate model.
     *
     * @return void
     */
    public function activate()
    {
        $this->update([
            'activated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Deactivate from model.
     *
     * @return void
     */
    public function deactivate()
    {
        $this->update([
            'activated_at' => null,
        ]);
    }
}
