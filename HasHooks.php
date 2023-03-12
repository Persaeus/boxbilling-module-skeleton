<?php

namespace Box\Mod\Skeleton;

trait HasHooks
{
    protected static function hook()
    {
        /**
         * @var string $function
         * @var array $args
         */
        extract(debug_backtrace(limit: 2)[1]);

        /** @var \Box_Event */
        $event = $args[0];

        /** @var array */
        $parameters = $event->getParameters();

        return static::notify($function, $parameters);
    }

    protected static function notify(string $hook, array $parameters)
    {
        $url = getenv('BOXBILLING_HOOK_NOTIFY_URL');
        $token = getenv('BOXBILLING_HOOK_NOTIFY_TOKEN');

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "Authorization: Bearer $token"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(compact('hook') + $parameters));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $result = curl_exec($ch);

        curl_close($ch);

        try {
            json_decode($result, flags: JSON_THROW_ON_ERROR);
        } catch (\Throwable $th) {
            throw new \Exception("Notify failed for hook '$hook'", 1);
        }
    }
}
