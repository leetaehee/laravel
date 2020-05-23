<?php
/**
 * Created by PhpStorm.
 * User: developerleetaehee
 * Date: 2020-05-23
 * Time: 17:12
 */

namespace App;

trait EtagTrait
{
    public function etag(\Illuminate\Database\Eloquent\Model $model, $cacheKey = null)
    {
        $etag = '';

        if ($model->usesTimestamps()) {
            $etag .= $model->updated_at->timestamp;
        }

        return md5($etag.$cacheKey);
    }

    protected function etags($collection, $cacheKey = null)
    {
        $etag = '';

        foreach ($collection as $instance) {
            $etag .= $this->etag($instance);
        }


        return md5($etag.$cacheKey);
    }
}