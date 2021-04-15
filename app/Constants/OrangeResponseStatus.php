<?php
namespace App\Constants;

final class OrangeResponseStatus
{
  const Success          = 0;
  const AlreadySubscribe   = 1;
  const NotSubscribed    = 2;
  const NotAllowed       = 5;
  const NoBalance        = 6;
  const Technicalproblem = 31;


  public static function getList()
  {
      return [
          self::Success           => trans('Success'),
          self::AlreadySubscribe   => trans('You Are Already Subscribe'),
          self::NotSubscribed     => trans('You Are Not Subscribe'),
          self::NotAllowed        => trans('Not Allowed'),
          self::NoBalance         => trans('No Balance'),
          self::Technicalproblem  => trans('Technical Problem'),
      ];
  }

  /**
   * Method getLabel
   *
   * @param int $key
   *
   * @return string
   */
  public static function getLabel($key)
  {
      return array_key_exists($key, self::getList()) ? self::getList()[$key] : trans("there are error ");
  }
}

