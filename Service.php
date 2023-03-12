<?php

namespace Box\Mod\Skeleton;

class Service
{
     use HasHooks;

     public static function onBeforeAdminCreateClient()
     {
          return self::hook();
     }
}
