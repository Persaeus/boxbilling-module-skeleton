<?php

namespace Box\Mod\Skeleton;

class Service extends AbstractService
{
     public static function onBeforeAdminCreateClient()
     {
          return self::hook();
     }
}
