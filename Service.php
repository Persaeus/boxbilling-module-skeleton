<?php

namespace Box\Mod\Skeleton;

class Service
{
     public static function onBeforeAdminCreateClient(\Box_Event $event)
     {
          /**
           * @var string $status
           * @var string $email
           * @var string $first_name
           * @var string $last_name
           * @var string $company
           * @var string $address_1
           * @var string $address_2
           * @var string $city
           * @var string $state
           * @var string $country
           * @var string $postcode
           * @var string $postcode
           * @var string $phone_cc
           * @var string $phone
           * @var string $currency
           * @var string $password
           */
          extract($event->getParameters());
     }
}
